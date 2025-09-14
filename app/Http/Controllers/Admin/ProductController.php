<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected array $middleware = [
        'auth',
        'admin',
    ];

    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('model_number', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $products = $query->latest()->paginate(15);
        $categories = Category::active()->ordered()->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::active()->ordered()->get();
        return view('admin.products.create',[
            'categories' => $categories
        ]);
    }    
    
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $request->slug ?: Str::slug($data['name']);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('products', 'public');
        }

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            $gallery = [];
            foreach ($request->file('gallery_images') as $file) {
                $gallery[] = $file->store('products/gallery', 'public');
            }
            $data['gallery_images'] = $gallery;
        }

        // Handle documents
        if ($request->hasFile('documents')) {
            $documents = [];
            foreach ($request->file('documents') as $file) {
                $documents[] = $file->store('products/documents', 'public');
            }
            $data['documents'] = $documents;
        }

        // Handle specifications JSON
        if ($data['specifications']) {
            $json = json_decode($data['specifications'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $data['specifications'] = $json;
            }
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $product->load('category');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::active()->ordered()->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['slug'] = $request->slug ?: Str::slug($data['name']);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            if ($product->featured_image) {
                Storage::disk('public')->delete($product->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('products', 'public');
        } elseif ($request->has('remove_featured_image') && $product->featured_image) {
            Storage::disk('public')->delete($product->featured_image);
            $data['featured_image'] = null;
        }

        // Handle gallery images
        $currentGallery = $product->gallery_images ?: [];
        
        // Remove selected images
        if ($request->has('remove_gallery_images')) {
            foreach ($request->remove_gallery_images as $index) {
                if (isset($currentGallery[$index])) {
                    Storage::disk('public')->delete($currentGallery[$index]);
                    unset($currentGallery[$index]);
                }
            }
            $currentGallery = array_values($currentGallery); // Re-index array
        }

        // Add new images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $currentGallery[] = $file->store('products/gallery', 'public');
            }
        }
        
        $data['gallery_images'] = $currentGallery;

        // Handle documents
        $currentDocuments = $product->documents ?: [];
        
        // Remove selected documents
        if ($request->has('remove_documents')) {
            foreach ($request->remove_documents as $index) {
                if (isset($currentDocuments[$index])) {
                    Storage::disk('public')->delete($currentDocuments[$index]);
                    unset($currentDocuments[$index]);
                }
            }
            $currentDocuments = array_values($currentDocuments); // Re-index array
        }

        // Add new documents
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $currentDocuments[] = $file->store('products/documents', 'public');
            }
        }
        
        $data['documents'] = $currentDocuments;

        // Handle specifications JSON
        if ($data['specifications']) {
            $json = json_decode($data['specifications'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $data['specifications'] = $json;
            }
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }    public function destroy(Product $product)
    {
        // Delete associated files
        if ($product->featured_image) {
            Storage::disk('public')->delete($product->featured_image);
        }
        if ($product->gallery_images) {
            foreach ($product->gallery_images as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        if ($product->documents) {
            foreach ($product->documents as $document) {
                Storage::disk('public')->delete($document);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function toggleStatus(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);
        
        $status = $product->is_active ? 'activated' : 'deactivated';
        return response()->json(['message' => "Product {$status} successfully."]);
    }

    public function toggleFeatured(Product $product)
    {
        $product->update(['is_featured' => !$product->is_featured]);
        
        $status = $product->is_featured ? 'featured' : 'unfeatured';
        return response()->json(['message' => "Product {$status} successfully."]);
    }
}

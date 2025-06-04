<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends BaseController
{
    public function index(Request $request)
    {
        $query = Product::with(['category']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        if ($request->filled('featured')) {
            $query->where('is_featured', $request->featured === '1');
        }

        $products = $query->ordered()->paginate(15);
        $categories = ProductCategory::active()->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = ProductCategory::active()->ordered()->get();
        $industries = Industry::active()->ordered()->get();

        return view('admin.products.create', compact('categories', 'industries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
            'technical_details' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'industries' => 'nullable|array',
            'industries.*' => 'exists:industries,id',
            'sort_order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $data = $request->except(['images', 'banner_image', 'industries']);
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Handle multiple images upload
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('products', 'public');
            }
            $data['images'] = $imagePaths;
        }

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request->file('banner_image')->store('products/banners', 'public');
        }

        $product = Product::create($data);

        // Attach industries
        if ($request->filled('industries')) {
            $product->industries()->sync($request->industries);
        }

        return $this->successResponse(
            'Product created successfully!',
            'admin.products.index'
        );
    }

    public function show(Product $product)
    {
        $product->load(['category', 'industries', 'inquiries' => function($query) {
            $query->latest()->take(5);
        }]);

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::active()->ordered()->get();
        $industries = Industry::active()->ordered()->get();
        $product->load('industries');

        return view('admin.products.edit', compact('product', 'categories', 'industries'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
            'technical_details' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'industries' => 'nullable|array',
            'industries.*' => 'exists:industries,id',
            'sort_order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $data = $request->except(['images', 'banner_image', 'industries', 'remove_images']);

        // Handle image removal
        if ($request->filled('remove_images')) {
            $currentImages = $product->images ?? [];
            $removeImages = $request->remove_images;
            
            foreach ($removeImages as $imageToRemove) {
                if (in_array($imageToRemove, $currentImages)) {
                    Storage::disk('public')->delete($imageToRemove);
                    $currentImages = array_diff($currentImages, [$imageToRemove]);
                }
            }
            $data['images'] = array_values($currentImages);
        }

        // Handle new images upload
        if ($request->hasFile('images')) {
            $newImagePaths = [];
            foreach ($request->file('images') as $image) {
                $newImagePaths[] = $image->store('products', 'public');
            }
            $existingImages = $data['images'] ?? $product->images ?? [];
            $data['images'] = array_merge($existingImages, $newImagePaths);
        }

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            // Delete old banner image
            if ($product->banner_image) {
                Storage::disk('public')->delete($product->banner_image);
            }
            $data['banner_image'] = $request->file('banner_image')->store('products/banners', 'public');
        }

        $product->update($data);

        // Sync industries
        if ($request->has('industries')) {
            $product->industries()->sync($request->industries ?? []);
        }

        return $this->successResponse(
            'Product updated successfully!',
            'admin.products.index'
        );
    }

    public function destroy(Product $product)
    {
        // Delete images
        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        if ($product->banner_image) {
            Storage::disk('public')->delete($product->banner_image);
        }

        // Detach industries
        $product->industries()->detach();

        $product->delete();

        return $this->successResponse('Product deleted successfully!');
    }

    public function toggleStatus(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);

        $status = $product->is_active ? 'activated' : 'deactivated';
        return $this->successResponse("Product {$status} successfully!");
    }

    public function toggleFeatured(Product $product)
    {
        $product->update(['is_featured' => !$product->is_featured]);

        $status = $product->is_featured ? 'marked as featured' : 'removed from featured';
        return $this->successResponse("Product {$status} successfully!");
    }
}
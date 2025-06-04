<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductCategoryController extends BaseController
{
    public function index(Request $request)
    {
        $query = ProductCategory::withCount('products');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $categories = $query->ordered()->paginate(15);

        return view('admin.product-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.product-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:product_categories,slug',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category = ProductCategory::create($data);

        return $this->successResponse(
            'Product category created successfully!',
            'admin.product-categories.index'
        );
    }

    public function show(ProductCategory $productCategory)
    {
        $productCategory->load(['products' => function($query) {
            $query->latest()->take(10);
        }]);

        return view('admin.product-categories.show', compact('productCategory'));
    }

    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product-categories.edit', compact('productCategory'));
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:product_categories,slug,' . $productCategory->id,
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($productCategory->image) {
                Storage::disk('public')->delete($productCategory->image);
            }
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $productCategory->update($data);

        return $this->successResponse(
            'Product category updated successfully!',
            'admin.product-categories.index'
        );
    }

    public function destroy(ProductCategory $productCategory)
    {
        // Check if category has products
        if ($productCategory->products()->exists()) {
            return $this->errorResponse(
                'Cannot delete category with existing products. Please move or delete products first.'
            );
        }

        // Delete image
        if ($productCategory->image) {
            Storage::disk('public')->delete($productCategory->image);
        }

        $productCategory->delete();

        return $this->successResponse('Product category deleted successfully!');
    }

    public function toggleStatus(ProductCategory $productCategory)
    {
        $productCategory->update(['is_active' => !$productCategory->is_active]);

        $status = $productCategory->is_active ? 'activated' : 'deactivated';
        return $this->successResponse("Category {$status} successfully!");
    }
}
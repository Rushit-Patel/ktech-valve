<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    protected array $middleware = [
        'auth',
        'admin',
    ];

    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $categories = $query->ordered()->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }
    public function create()
    {
        $categories = Category::active()->orderBy('sort_order')->get();
        return view('admin.categories.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5242880',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ], [
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, webp.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);

        $data = $request->all();
        $data['slug'] = $request->slug ?: Str::slug($data['name']);
        $data['is_active'] = $request->has('is_active');

        // Handle image upload
        if ($request->hasFile('image')) {
            try {
                $file = $request->file('image');
                $fileName = time() . '_' . Str::slug($data['name']) . '.' . $file->getClientOriginalExtension();
                $data['image'] = $file->storeAs('categories', $fileName, 'public');

            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['image' => 'Failed to upload image. Please try again.']);
            }
        }

        try {
            Category::create($data);

            return redirect()->route('admin.categories.index')
                ->with('success', 'Category created successfully.');

        } catch (\Exception $e) {
            // If creation fails and we uploaded an image, clean it up
            if (isset($data['image'])) {
                Storage::disk('public')->delete($data['image']);
            }

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create category. Please try again.']);
        }
    }

    public function show(Category $category)
    {
        $category->load('products');
        return view('admin.categories.show', compact('category'));
    }
    public function edit(Category $category)
    {
        $categories = Category::active()->where('id', '!=', $category->id)->orderBy('sort_order')->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5242880',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ], [
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, webp.',
            'image.max' => 'The image may not be greater than 2MB.',
        ]);

        $data = $request->all();
        $data['slug'] = $request->slug ?: Str::slug($data['name']);
        $data['is_active'] = $request->has('is_active');

        // Handle image upload
        if ($request->hasFile('image')) {
            try {
                // Delete old image if exists
                if ($category->image) {
                    Storage::disk('public')->delete($category->image);
                }

                // Store new image with proper naming
                $file = $request->file('image');
                $fileName = time() . '_' . Str::slug($data['name']) . '.' . $file->getClientOriginalExtension();
                $data['image'] = $file->storeAs('categories', $fileName, 'public');

            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['image' => 'Failed to upload image. Please try again.']);
            }
        } elseif ($request->has('remove_image') && $category->image) {
            // Remove existing image
            Storage::disk('public')->delete($category->image);
            $data['image'] = null;
        }

        try {
            $category->update($data);

            return redirect()->route('admin.categories.index')
                ->with('success', 'Category updated successfully.');

        } catch (\Exception $e) {
            // If update fails and we uploaded a new image, clean it up
            if (isset($data['image']) && $data['image'] !== $category->image) {
                Storage::disk('public')->delete($data['image']);
            }

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update category. Please try again.']);
        }
    }

    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Cannot delete category with existing products.');
        }

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    public function toggleStatus(Category $category)
    {
        $category->update(['is_active' => !$category->is_active]);

        $status = $category->is_active ? 'activated' : 'deactivated';
        return response()->json(['message' => "Category {$status} successfully."]);
    }
}

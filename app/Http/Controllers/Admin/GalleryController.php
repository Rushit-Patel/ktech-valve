<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends BaseController
{
    public function index(Request $request)
    {
        $query = Gallery::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $galleries = $query->ordered()->paginate(20);
        $categories = Gallery::getCategories();

        return view('admin.galleries.index', compact('galleries', 'categories'));
    }

    public function create()
    {
        $categories = Gallery::getCategories();
        return view('admin.galleries.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        Gallery::create($data);

        return $this->successResponse(
            'Gallery item created successfully!',
            'admin.galleries.index'
        );
    }

    public function show(Gallery $gallery)
    {
        return view('admin.galleries.show', compact('gallery'));
    }

    public function edit(Gallery $gallery)
    {
        $categories = Gallery::getCategories();
        return view('admin.galleries.edit', compact('gallery', 'categories'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);

        return $this->successResponse(
            'Gallery item updated successfully!',
            'admin.galleries.index'
        );
    }

    public function destroy(Gallery $gallery)
    {
        // Delete image
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return $this->successResponse('Gallery item deleted successfully!');
    }

    public function toggleStatus(Gallery $gallery)
    {
        $gallery->update(['is_active' => !$gallery->is_active]);

        $status = $gallery->is_active ? 'activated' : 'deactivated';
        return $this->successResponse("Gallery item {$status} successfully!");
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'galleries' => 'required|array',
            'galleries.*' => 'exists:galleries,id'
        ]);

        $galleries = Gallery::whereIn('id', $request->galleries)->get();

        foreach ($galleries as $gallery) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $gallery->delete();
        }

        return $this->successResponse('Selected gallery items deleted successfully!');
    }
}
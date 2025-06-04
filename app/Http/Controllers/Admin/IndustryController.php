<?php

namespace App\Http\Controllers\Admin;

use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class IndustryController extends BaseController
{
    public function index(Request $request)
    {
        $query = Industry::withCount('products');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $industries = $query->ordered()->paginate(15);

        return view('admin.industries.index', compact('industries'));
    }

    public function create()
    {
        return view('admin.industries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:industries,slug',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:1024',
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
            $data['image'] = $request->file('image')->store('industries', 'public');
        }

        // Handle icon upload
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('industries/icons', 'public');
        }

        Industry::create($data);

        return $this->successResponse(
            'Industry created successfully!',
            'admin.industries.index'
        );
    }

    public function show(Industry $industry)
    {
        $industry->load(['products' => function($query) {
            $query->active()->latest()->take(10);
        }]);

        return view('admin.industries.show', compact('industry'));
    }

    public function edit(Industry $industry)
    {
        return view('admin.industries.edit', compact('industry'));
    }

    public function update(Request $request, Industry $industry)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:industries,slug,' . $industry->id,
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:1024',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($industry->image) {
                Storage::disk('public')->delete($industry->image);
            }
            $data['image'] = $request->file('image')->store('industries', 'public');
        }

        // Handle icon upload
        if ($request->hasFile('icon')) {
            if ($industry->icon) {
                Storage::disk('public')->delete($industry->icon);
            }
            $data['icon'] = $request->file('icon')->store('industries/icons', 'public');
        }

        $industry->update($data);

        return $this->successResponse(
            'Industry updated successfully!',
            'admin.industries.index'
        );
    }

    public function destroy(Industry $industry)
    {
        // Delete images
        if ($industry->image) {
            Storage::disk('public')->delete($industry->image);
        }

        if ($industry->icon) {
            Storage::disk('public')->delete($industry->icon);
        }

        // Detach products
        $industry->products()->detach();

        $industry->delete();

        return $this->successResponse('Industry deleted successfully!');
    }

    public function toggleStatus(Industry $industry)
    {
        $industry->update(['is_active' => !$industry->is_active]);

        $status = $industry->is_active ? 'activated' : 'deactivated';
        return $this->successResponse("Industry {$status} successfully!");
    }
}
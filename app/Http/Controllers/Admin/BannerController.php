<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    protected array $middleware = [
        'auth',
        'admin',
    ];

    public function index(Request $request)
    {
        $query = Banner::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $banners = $query->orderBy('sort_order')->paginate(15);

        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'link_text' => 'nullable|string|max:100',
            'link_url' => 'nullable|url|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ], [
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, webp.',
            'image.max' => 'The image may not be greater than 5MB.',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Handle image upload
        if ($request->hasFile('image')) {
            try {
                $file = $request->file('image');
                $fileName = time() . '_' . Str::slug($data['title']) . '.' . $file->getClientOriginalExtension();
                $data['image'] = $file->storeAs('banners', $fileName, 'public');
                
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['image' => 'Failed to upload image. Please try again.']);
            }
        }

        try {
            Banner::create($data);

            return redirect()->route('admin.banners.index')
                ->with('success', 'Banner created successfully.');
                
        } catch (\Exception $e) {
            // If creation fails and we uploaded an image, clean it up
            if (isset($data['image'])) {
                Storage::disk('public')->delete($data['image']);
            }
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create banner. Please try again.']);
        }
    }

    public function show(Banner $banner)
    {
        return view('admin.banners.show', compact('banner'));
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'link_text' => 'nullable|string|max:100',
            'link_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ], [
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, webp.',
            'image.max' => 'The image may not be greater than 5MB.',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Handle image upload
        if ($request->hasFile('image')) {
            try {
                // Delete old image if exists
                if ($banner->image) {
                    Storage::disk('public')->delete($banner->image);
                }
                
                // Store new image with proper naming
                $file = $request->file('image');
                $fileName = time() . '_' . Str::slug($data['title']) . '.' . $file->getClientOriginalExtension();
                $data['image'] = $file->storeAs('banners', $fileName, 'public');
                
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['image' => 'Failed to upload image. Please try again.']);
            }
        } elseif ($request->has('remove_image') && $banner->image) {
            // Remove existing image
            Storage::disk('public')->delete($banner->image);
            $data['image'] = null;
        }

        try {
            $banner->update($data);
            
            return redirect()->route('admin.banners.index')
                ->with('success', 'Banner updated successfully.');
                
        } catch (\Exception $e) {
            // If update fails and we uploaded a new image, clean it up
            if (isset($data['image']) && $data['image'] !== $banner->image) {
                Storage::disk('public')->delete($data['image']);
            }
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update banner. Please try again.']);
        }
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner deleted successfully.');
    }

    public function toggleStatus(Banner $banner)
    {
        $banner->update(['is_active' => !$banner->is_active]);
        
        $status = $banner->is_active ? 'activated' : 'deactivated';
        return response()->json(['message' => "Banner {$status} successfully."]);
    }
}

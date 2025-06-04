<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends BaseController
{
    /**
     * Display the gallery
     */
    public function index(Request $request)
    {
        // Set SEO data for gallery
        $this->setSeoData('gallery', null, [
            'title' => 'Photo Gallery - K Tech Valves Manufacturing Facility',
            'description' => 'Explore our state-of-the-art manufacturing facility, quality control processes, and product showcase through our comprehensive photo gallery.',
            'keywords' => 'valve manufacturing facility, factory photos, production gallery, K Tech Valves gallery'
        ]);

        $query = Gallery::active();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        $galleries = $query->ordered()->paginate(24)->withQueryString();

        // Get all categories for filter
        $categories = Gallery::getCategories();

        // Get featured gallery items for hero section
        $featuredGalleries = Gallery::active()
            ->where('category', 'featured')
            ->ordered()
            ->take(6)
            ->get();

        return view('frontend.gallery.index', compact(
            'galleries',
            'categories',
            'featuredGalleries'
        ));
    }

    /**
     * Get gallery items by category (AJAX)
     */
    public function getByCategory(Request $request)
    {
        $category = $request->get('category');
        
        $query = Gallery::active();
        
        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        $galleries = $query->ordered()->take(20)->get();

        return response()->json([
            'success' => true,
            'galleries' => $galleries->map(function($gallery) {
                return [
                    'id' => $gallery->id,
                    'title' => $gallery->title,
                    'image_url' => $gallery->image_url,
                    'thumbnail_url' => $gallery->thumbnail_url,
                    'description' => $gallery->description,
                    'category' => $gallery->category
                ];
            })
        ]);
    }

    /**
     * Display single gallery item (for lightbox/modal)
     */
    public function show(Gallery $gallery)
    {
        if (!$gallery->is_active) {
            abort(404);
        }

        return response()->json([
            'success' => true,
            'gallery' => [
                'id' => $gallery->id,
                'title' => $gallery->title,
                'image_url' => $gallery->image_url,
                'description' => $gallery->description,
                'category' => $gallery->category
            ]
        ]);
    }
}
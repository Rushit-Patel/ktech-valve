<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Industry;
use App\Models\Product;
use App\Services\SeoService;
use Illuminate\Http\Request;

class IndustryController extends BaseController
{
    /**
     * Display all industries
     */
    public function index()
    {
        // Set SEO data for industries index
        $this->setSeoData('industries', null, [
            'title' => 'Industries We Serve - Industrial Valve Solutions | K Tech Valves',
            'description' => 'Providing specialized valve solutions for various industries including oil & gas, chemical processing, water treatment, power generation and more.',
            'keywords' => 'industrial valve solutions, oil gas valves, chemical processing valves, water treatment valves'
        ]);

        $industries = Industry::active()
            ->withCount(['activeProducts'])
            ->orderBy('sort_order')
            ->get();

        // Get featured products across all industries
        $featuredProducts = Product::featured()
            ->active()
            ->with(['category', 'industries'])
            ->take(8)
            ->get();

        return view('frontend.industries.index', compact('industries', 'featuredProducts'));
    }

    /**
     * Display a specific industry
     */
    public function show(Industry $industry, Request $request)
    {
        // Set SEO data for industry page
        $this->setSeoData('industry', $industry->slug, [
            'title' => $industry->meta_title,
            'description' => $industry->meta_description,
            'keywords' => $industry->meta_keywords
        ]);

        // Get products for this industry
        $query = $industry->activeProducts()->with('category');

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Search within industry products
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('short_description', 'like', "%{$searchTerm}%");
            });
        }

        $products = $query->orderBy('is_featured', 'desc')
                         ->orderBy('sort_order')
                         ->paginate(12)
                         ->withQueryString();

        // Get categories that have products in this industry
        $categories = \App\Models\ProductCategory::active()
            ->whereHas('products', function($q) use ($industry) {
                $q->whereHas('industries', function($subQ) use ($industry) {
                    $subQ->where('industries.id', $industry->id);
                });
            })
            ->withCount(['products' => function($q) use ($industry) {
                $q->whereHas('industries', function($subQ) use ($industry) {
                    $subQ->where('industries.id', $industry->id);
                });
            }])
            ->orderBy('name')
            ->get();

        // Get related industries
        $relatedIndustries = Industry::active()
            ->where('id', '!=', $industry->id)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        // Get featured products for this industry
        $featuredProducts = $industry->activeProducts()
            ->where('is_featured', true)
            ->with('category')
            ->take(6)
            ->get();

        return view('frontend.industries.show', compact(
            'industry',
            'products',
            'categories',
            'relatedIndustries',
            'featuredProducts'
        ));
    }

    /**
     * Get products by industry (AJAX)
     */
    public function getProducts(Industry $industry, Request $request)
    {
        $query = $industry->activeProducts()->with('category');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->orderBy('is_featured', 'desc')
                         ->orderBy('sort_order')
                         ->get();

        return response()->json([
            'success' => true,
            'products' => $products->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'short_description' => $product->short_description,
                    'image_url' => $product->main_image_url,
                    'category' => $product->category->name,
                    'url' => route('products.show', $product->slug)
                ];
            })
        ]);
    }
}
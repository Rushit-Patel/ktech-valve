<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Industry;
use App\Models\BlogPost;
use App\Models\Page;
use Illuminate\Http\Request;

class SearchController extends BaseController
{
    /**
     * Global search functionality
     */
    public function index(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:2|max:100'
        ]);

        $searchTerm = $request->q;

        // Set SEO data for search results
        $this->setSeoData('search', null, [
            'title' => "Search Results for '{$searchTerm}' | K Tech Valves",
            'description' => "Search results for '{$searchTerm}' on K Tech Valves website. Find products, services, and information.",
            'keywords' => "search results, {$searchTerm}, K Tech Valves"
        ]);

        // Search products
        $products = Product::active()
            ->with('category')
            ->where(function($query) use ($searchTerm) {
                $query->where('name', 'like', "%{$searchTerm}%")
                      ->orWhere('short_description', 'like', "%{$searchTerm}%")
                      ->orWhere('description', 'like', "%{$searchTerm}%");
            })
            ->orderBy('is_featured', 'desc')
            ->take(10)
            ->get();

        // Search categories
        $categories = ProductCategory::active()
            ->where(function($query) use ($searchTerm) {
                $query->where('name', 'like', "%{$searchTerm}%")
                      ->orWhere('description', 'like', "%{$searchTerm}%");
            })
            ->take(5)
            ->get();

        // Search industries
        $industries = Industry::active()
            ->where(function($query) use ($searchTerm) {
                $query->where('name', 'like', "%{$searchTerm}%")
                      ->orWhere('description', 'like', "%{$searchTerm}%");
            })
            ->take(5)
            ->get();

        // Search blog posts
        $blogPosts = BlogPost::published()
            ->where(function($query) use ($searchTerm) {
                $query->where('title', 'like', "%{$searchTerm}%")
                      ->orWhere('excerpt', 'like', "%{$searchTerm}%")
                      ->orWhere('content', 'like', "%{$searchTerm}%");
            })
            ->latest('published_at')
            ->take(5)
            ->get();

        // Search pages
        $pages = Page::active()
            ->where(function($query) use ($searchTerm) {
                $query->where('title', 'like', "%{$searchTerm}%")
                      ->orWhere('content', 'like', "%{$searchTerm}%");
            })
            ->take(5)
            ->get();

        $totalResults = $products->count() + $categories->count() + 
                       $industries->count() + $blogPosts->count() + $pages->count();

        return view('frontend.search.results', compact(
            'searchTerm',
            'products',
            'categories',
            'industries',
            'blogPosts',
            'pages',
            'totalResults'
        ));
    }

    /**
     * AJAX search suggestions
     */
    public function suggestions(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:2|max:50'
        ]);

        $searchTerm = $request->q;

        // Get product suggestions
        $productSuggestions = Product::active()
            ->where('name', 'like', "%{$searchTerm}%")
            ->orderBy('is_featured', 'desc')
            ->take(5)
            ->get(['id', 'name', 'slug'])
            ->map(function($product) {
                return [
                    'type' => 'product',
                    'title' => $product->name,
                    'url' => route('products.show', $product->slug)
                ];
            });

        // Get category suggestions
        $categorySuggestions = ProductCategory::active()
            ->where('name', 'like', "%{$searchTerm}%")
            ->take(3)
            ->get(['id', 'name', 'slug'])
            ->map(function($category) {
                return [
                    'type' => 'category',
                    'title' => $category->name,
                    'url' => route('products.category', $category->slug)
                ];
            });

        $suggestions = $productSuggestions->concat($categorySuggestions);

        return response()->json([
            'success' => true,
            'suggestions' => $suggestions->take(8)->values()
        ]);
    }
}
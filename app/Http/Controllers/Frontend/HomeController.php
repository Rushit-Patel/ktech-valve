<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Industry;
use App\Models\Certification;
use App\Models\Client;
use App\Models\Testimonial;
use App\Models\BlogPost;
use App\Services\SeoService;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    /**
     * Display the homepage
     */
    public function index()
    {
        // Set SEO data for homepage
        $this->setSeoData('homepage', null, [
            'title' => 'K Tech Valves - Leading Industrial Valve Manufacturer',
            'description' => 'Manufacturer of high-quality butterfly valves, ball valves, check valves & more. Serving industries with reliable valve solutions since years.',
            'keywords' => 'industrial valves, butterfly valve, ball valve, check valve, valve manufacturer, K Tech Valves'
        ]);

        // Get homepage data
        $data = [
            // Featured products for hero section
            'featuredProducts' => Product::featured()
                ->active()
                ->with('category')
                ->orderBy('sort_order')
                ->take(8)
                ->get(),

            // Product categories for "Our Range" section
            'categories' => ProductCategory::active()
                ->withCount(['activeProducts'])
                ->orderBy('sort_order')
                ->take(6)
                ->get(),

            // Industries we serve
            'industries' => Industry::active()
                ->orderBy('sort_order')
                ->take(6)
                ->get(),

            // Certifications
            'certifications' => Certification::active()
                ->valid()
                ->orderBy('sort_order')
                ->take(4)
                ->get(),

            // Featured clients
            'clients' => Client::active()
                ->featured()
                ->orderBy('sort_order')
                ->take(12)
                ->get(),

            // Testimonials
            'testimonials' => Testimonial::active()
                ->featured()
                ->orderBy('sort_order')
                ->take(6)
                ->get(),

            // Latest blog posts/news
            'latestPosts' => BlogPost::published()
                ->with('author')
                ->latest('published_at')
                ->take(3)
                ->get(),

            // Statistics for counter section
            'stats' => [
                'total_products' => Product::active()->count(),
                'industries_served' => Industry::active()->count(),
                'years_experience' => now()->year - 2010, // Adjust base year as needed
                'satisfied_clients' => Client::active()->count(),
            ]
        ];

        // Generate organization schema markup
        $organizationSchema = SeoService::generateOrganizationSchema();

        return view('frontend.home', array_merge($data, [
            'schemaMarkup' => $organizationSchema
        ]));
    }

    /**
     * Handle AJAX requests for homepage data
     */
    public function getProductsByCategory(Request $request)
    {
        $categoryId = $request->get('category_id');
        
        $products = Product::active()
            ->where('category_id', $categoryId)
            ->with('category')
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        return response()->json([
            'success' => true,
            'products' => $products->map(function ($product) {
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

    /**
     * Handle newsletter subscription
     */
    public function subscribeNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255'
        ]);

        // Here you can implement newsletter subscription logic
        // For example, save to database, send to email service, etc.
        
        return $this->successResponse('Thank you for subscribing to our newsletter!');
    }
}
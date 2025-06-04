<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Industry;
use App\Models\BlogPost;
use App\Models\Page;
use Illuminate\Http\Request;

class SitemapController extends BaseController
{
    /**
     * Generate XML sitemap
     */
    public function index()
    {
        $urls = collect();

        // Add homepage
        $urls->push([
            'url' => route('home'),
            'lastmod' => now()->toDateString(),
            'changefreq' => 'daily',
            'priority' => '1.0'
        ]);

        // Add static pages
        $staticPages = [
            ['route' => 'products.index', 'priority' => '0.9'],
            ['route' => 'industries.index', 'priority' => '0.8'],
            ['route' => 'about', 'priority' => '0.7'],
            ['route' => 'certifications', 'priority' => '0.6'],
            ['route' => 'gallery', 'priority' => '0.6'],
            ['route' => 'contact', 'priority' => '0.8'],
            ['route' => 'blog.index', 'priority' => '0.7'],
        ];

        foreach ($staticPages as $page) {
            $urls->push([
                'url' => route($page['route']),
                'lastmod' => now()->toDateString(),
                'changefreq' => 'weekly',
                'priority' => $page['priority']
            ]);
        }

        // Add product categories
        ProductCategory::active()->get()->each(function($category) use ($urls) {
            $urls->push([
                'url' => route('products.category', $category->slug),
                'lastmod' => $category->updated_at->toDateString(),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ]);
        });

        // Add products
        Product::active()->get()->each(function($product) use ($urls) {
            $urls->push([
                'url' => route('products.show', $product->slug),
                'lastmod' => $product->updated_at->toDateString(),
                'changefreq' => 'monthly',
                'priority' => $product->is_featured ? '0.9' : '0.7'
            ]);
        });

        // Add industries
        Industry::active()->get()->each(function($industry) use ($urls) {
            $urls->push([
                'url' => route('industries.show', $industry->slug),
                'lastmod' => $industry->updated_at->toDateString(),
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ]);
        });

        // Add blog posts
        BlogPost::published()->get()->each(function($post) use ($urls) {
            $urls->push([
                'url' => route('blog.show', $post->slug),
                'lastmod' => $post->updated_at->toDateString(),
                'changefreq' => 'monthly',
                'priority' => '0.6'
            ]);
        });

        // Add custom pages
        Page::active()->get()->each(function($page) use ($urls) {
            $urls->push([
                'url' => route('pages.show', $page->slug),
                'lastmod' => $page->updated_at->toDateString(),
                'changefreq' => 'monthly',
                'priority' => '0.5'
            ]);
        });

        return response()->view('frontend.sitemap.xml', compact('urls'))
                        ->header('Content-Type', 'text/xml');
    }

    /**
     * Generate robots.txt
     */
    public function robots()
    {
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /login\n";
        $content .= "Disallow: /register\n";
        $content .= "\n";
        $content .= "Sitemap: " . route('sitemap') . "\n";

        return response($content)->header('Content-Type', 'text/plain');
    }
}
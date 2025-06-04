<?php

namespace App\Http\Controllers\Frontend;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    /**
     * Display blog posts
     */
    public function index(Request $request)
    {
        // Set SEO data for blog index
        $this->setSeoData('blog', null, [
            'title' => 'Blog & News - K Tech Valves | Industry Insights',
            'description' => 'Stay updated with the latest news, industry insights, technical articles, and updates from K Tech Valves.',
            'keywords' => 'valve industry news, technical articles, industrial valve insights, K Tech Valves blog'
        ]);

        $query = BlogPost::published()->with('author');

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('excerpt', 'like', "%{$searchTerm}%")
                  ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }

        // Filter by tag
        if ($request->filled('tag')) {
            $query->whereJsonContains('tags', $request->tag);
        }

        $posts = $query->latest('published_at')->paginate(12)->withQueryString();

        // Get categories for filter
        $categories = BlogPost::published()
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category')
            ->filter()
            ->sort()
            ->values();

        // Get popular tags
        $popularTags = BlogPost::published()
            ->whereNotNull('tags')
            ->get()
            ->pluck('tags')
            ->flatten()
            ->countBy()
            ->sortDesc()
            ->take(10)
            ->keys();

        // Get featured posts
        $featuredPosts = BlogPost::published()
            ->where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('frontend.blog.index', compact(
            'posts',
            'categories',
            'popularTags',
            'featuredPosts'
        ));
    }

    /**
     * Display a specific blog post
     */
    public function show(BlogPost $blogPost)
    {
        // Check if post is published
        if ($blogPost->status !== 'published' || $blogPost->published_at > now()) {
            abort(404);
        }

        // Set SEO data for blog post
        $this->setSeoData('blog_post', $blogPost->slug, [
            'title' => $blogPost->meta_title,
            'description' => $blogPost->meta_description,
            'keywords' => $blogPost->meta_keywords
        ]);

        $blogPost->load('author');

        // Get related posts
        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $blogPost->id)
            ->where(function($query) use ($blogPost) {
                if ($blogPost->category) {
                    $query->where('category', $blogPost->category);
                }
                if ($blogPost->tags) {
                    foreach ($blogPost->tags as $tag) {
                        $query->orWhereJsonContains('tags', $tag);
                    }
                }
            })
            ->latest('published_at')
            ->take(4)
            ->get();

        // Generate article schema markup
        $schemaMarkup = [
            "@context" => "https://schema.org",
            "@type" => "Article",
            "headline" => $blogPost->title,
            "description" => $blogPost->excerpt,
            "image" => $blogPost->featured_image_url,
            "author" => [
                "@type" => "Person",
                "name" => $blogPost->author->name ?? 'K Tech Valves'
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => "K Tech Valves",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => asset('images/logo.png')
                ]
            ],
            "datePublished" => $blogPost->published_at->toISOString(),
            "dateModified" => $blogPost->updated_at->toISOString()
        ];

        return view('frontend.blog.show', compact(
            'blogPost',
            'relatedPosts',
            'schemaMarkup'
        ));
    }

    /**
     * Get posts by category (AJAX)
     */
    public function getByCategory(Request $request)
    {
        $category = $request->get('category');
        
        $query = BlogPost::published()->with('author');
        
        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        $posts = $query->latest('published_at')->take(12)->get();

        return response()->json([
            'success' => true,
            'posts' => $posts->map(function($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'excerpt' => $post->excerpt,
                    'featured_image_url' => $post->featured_image_url,
                    'published_at' => $post->published_at->format('M d, Y'),
                    'reading_time' => $post->reading_time,
                    'author' => $post->author->name ?? 'K Tech Valves',
                    'url' => route('blog.show', $post->slug)
                ];
            })
        ]);
    }
}
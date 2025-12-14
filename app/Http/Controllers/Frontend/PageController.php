<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Gallery;
use App\Models\Industry;
use App\Models\Certification;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $page = Page::where('slug', 'about')->active()->first();
        
        if (!$page) {
            $page = (object) [
                'title' => 'About Us',
                'content' => 'About us content will be managed from admin panel.',
                'sections' => []
            ];
        }

        return view('frontend.about', compact('page'));
    }    public function gallery(Request $request)
    {
        // Get dynamic content from admin settings
        $heroData = [
            'title' => \App\Models\SiteSetting::get('gallery_hero_title', 'Our Gallery'),
            'subtitle' => \App\Models\SiteSetting::get('gallery_hero_subtitle', 'Explore our state-of-the-art manufacturing facility and see the precision that goes into every valve we produce.'),
            'background_image' => \App\Models\SiteSetting::get('gallery_hero_background', ''),
        ];

        $settings = [
            'images_per_page' => \App\Models\SiteSetting::get('gallery_images_per_page', 12),
            'show_categories' => \App\Models\SiteSetting::get('gallery_show_categories', true),
            'enable_lightbox' => \App\Models\SiteSetting::get('gallery_enable_lightbox', true),
            'show_image_info' => \App\Models\SiteSetting::get('gallery_show_image_info', true),
        ];

        $query = Gallery::active();

        if ($request->filled('category')) {
            $query->category($request->category);
        }

        $galleries = $query->ordered()->paginate($settings['images_per_page']);
        
        $categories = Gallery::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view('frontend.gallery', compact('galleries', 'categories', 'heroData', 'settings'));
    }

    public function industries()
    {
        $industries = Industry::active()->ordered()->get();
        
        $page = Page::where('slug', 'industries')->active()->first();

        return view('frontend.industries', compact('industries', 'page'));
    }

    public function certifications()
    {
        $certifications = Certification::active()->valid()->ordered()->get();
        
        $page = Page::where('slug', 'certifications')->active()->first();

        return view('frontend.certifications', compact('certifications', 'page'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'newsletter' => 'boolean'
        ]);

        // Create inquiry record
        \App\Models\Inquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'subject' => $request->subject,
            'message' => $request->message,
            'source' => 'Contact Form',
            'status' => 'new',
            'priority' => 'medium'
        ]);

        return redirect()->route('contact')->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}

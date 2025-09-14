<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\Industry;
use App\Models\Certification;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomepageController extends Controller
{
    public function index()
    {
        $sections = [
            'about_company' => $this->getAboutCompanyData(),
            'why_choose' => $this->getWhyChooseData(),
            'featured_products' => $this->getFeaturedProductsData(),
            'certifications' => $this->getCertificationsData(),
        ];

        $stats = [
            'banners_count' => Banner::active()->count(),
            'products_count' => Product::active()->count(),
            'categories_count' => Category::active()->count(),
            'industries_count' => Industry::active()->count(),
            'clients_count' => Client::active()->count(),
            'certifications_count' => Certification::active()->count(),
        ];

        return view('admin.homepage.index', compact('sections', 'stats'));
    }

    public function updateSection(Request $request, $section)
    {
        $validSections = ['about_company', 'why_choose', 'featured_products', 'certifications'];
        
        if (!in_array($section, $validSections)) {
            return redirect()->back()->with('error', 'Invalid section');
        }

        $method = 'update' . ucfirst(str_replace('_', '', $section)) . 'Section';
        
        if (method_exists($this, $method)) {
            return $this->$method($request);
        }

        return redirect()->back()->with('error', 'Section handler not found');
    }

    private function updateAboutcompanySection(Request $request)
    {
        $request->validate([
            'about_title' => 'required|string|max:255',
            'about_content' => 'required|string',
            'about_features' => 'array',
            'about_features.*.title' => 'required|string|max:255',
            'about_features.*.description' => 'required|string',
        ]);

        SiteSetting::updateOrCreate(
            ['key' => 'homepage_about_title'],
            [
                'value' => $request->about_title,
                'type' => 'text',
                'group' => 'homepage',
                'label' => 'About Section Title',
                'description' => 'Title for the about company section on homepage'
            ]
        );

        SiteSetting::updateOrCreate(
            ['key' => 'homepage_about_content'],
            [
                'value' => $request->about_content,
                'type' => 'textarea',
                'group' => 'homepage',
                'label' => 'About Section Content',
                'description' => 'Content for the about company section on homepage'
            ]
        );

        if ($request->about_features) {
            SiteSetting::updateOrCreate(
                ['key' => 'homepage_about_features'],
                [
                    'value' => json_encode($request->about_features),
                    'type' => 'json',
                    'group' => 'homepage',
                    'label' => 'About Section Features',
                    'description' => 'Features list for about section'
                ]
            );
        }

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'About Company section updated successfully!');
    }

    private function updateWhychooseSection(Request $request)
    {
        $request->validate([
            'why_choose_title' => 'required|string|max:255',
            'why_choose_subtitle' => 'nullable|string',
            'why_choose_points' => 'array',
            'why_choose_points.*.title' => 'required|string|max:255',
            'why_choose_points.*.description' => 'required|string',
            'why_choose_points.*.icon' => 'nullable|string',
        ]);

        SiteSetting::updateOrCreate(
            ['key' => 'homepage_why_choose_title'],
            [
                'value' => $request->why_choose_title,
                'type' => 'text',
                'group' => 'homepage',
                'label' => 'Why Choose Title',
                'description' => 'Title for the why choose section'
            ]
        );

        SiteSetting::updateOrCreate(
            ['key' => 'homepage_why_choose_subtitle'],
            [
                'value' => $request->why_choose_subtitle,
                'type' => 'textarea',
                'group' => 'homepage',
                'label' => 'Why Choose Subtitle',
                'description' => 'Subtitle for the why choose section'
            ]
        );

        SiteSetting::updateOrCreate(
            ['key' => 'why_choose_points'],
            [
                'value' => json_encode($request->why_choose_points),
                'type' => 'json',
                'group' => 'homepage',
                'label' => 'Why Choose Points',
                'description' => 'List of why choose points with titles, descriptions, and icons'
            ]
        );

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Why Choose section updated successfully!');
    }

    private function updateFeaturedproductsSection(Request $request)
    {
        $request->validate([
            'show_featured_products' => 'boolean',
            'featured_products_title' => 'required|string|max:255',
            'featured_products_subtitle' => 'nullable|string',
            'featured_products_count' => 'required|integer|min:1|max:20',
        ]);

        SiteSetting::updateOrCreate(
            ['key' => 'homepage_show_featured_products'],
            [
                'value' => $request->has('show_featured_products') ? '1' : '0',
                'type' => 'boolean',
                'group' => 'homepage',
                'label' => 'Show Featured Products Section',
                'description' => 'Toggle featured products section visibility'
            ]
        );

        SiteSetting::updateOrCreate(
            ['key' => 'homepage_featured_products_title'],
            [
                'value' => $request->featured_products_title,
                'type' => 'text',
                'group' => 'homepage',
                'label' => 'Featured Products Title',
                'description' => 'Title for the featured products section'
            ]
        );

        SiteSetting::updateOrCreate(
            ['key' => 'homepage_featured_products_subtitle'],
            [
                'value' => $request->featured_products_subtitle,
                'type' => 'textarea',
                'group' => 'homepage',
                'label' => 'Featured Products Subtitle',
                'description' => 'Subtitle for the featured products section'
            ]
        );

        SiteSetting::updateOrCreate(
            ['key' => 'homepage_featured_products_count'],
            [
                'value' => $request->featured_products_count,
                'type' => 'number',
                'group' => 'homepage',
                'label' => 'Featured Products Count',
                'description' => 'Maximum number of featured products to display'
            ]
        );

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Featured Products section updated successfully!');
    }

    private function updateCertificationsSection(Request $request)
    {
        $request->validate([
            'show_certifications' => 'boolean',
            'certifications_title' => 'required|string|max:255',
            'certifications_subtitle' => 'nullable|string',
            'certifications_count' => 'required|integer|min:1|max:20',
        ]);

        SiteSetting::updateOrCreate(
            ['key' => 'homepage_show_certifications'],
            [
                'value' => $request->has('show_certifications') ? '1' : '0',
                'type' => 'boolean',
                'group' => 'homepage',
                'label' => 'Show Certifications Section',
                'description' => 'Toggle certifications section visibility'
            ]
        );

        SiteSetting::updateOrCreate(
            ['key' => 'homepage_certifications_title'],
            [
                'value' => $request->certifications_title,
                'type' => 'text',
                'group' => 'homepage',
                'label' => 'Certifications Title',
                'description' => 'Title for the certifications section'
            ]
        );

        SiteSetting::updateOrCreate(
            ['key' => 'homepage_certifications_subtitle'],
            [
                'value' => $request->certifications_subtitle,
                'type' => 'textarea',
                'group' => 'homepage',
                'label' => 'Certifications Subtitle',
                'description' => 'Subtitle for the certifications section'
            ]
        );

        SiteSetting::updateOrCreate(
            ['key' => 'homepage_certifications_count'],
            [
                'value' => $request->certifications_count,
                'type' => 'number',
                'group' => 'homepage',
                'label' => 'Certifications Count',
                'description' => 'Maximum number of certifications to display'
            ]
        );

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Certifications section updated successfully!');
    }

    private function getAboutCompanyData()
    {
        return [
            'title' => SiteSetting::get('homepage_about_title', 'About K-Tech Valves'),
            'content' => SiteSetting::get('homepage_about_content', 'Leading manufacturer of high-quality industrial valves for diverse applications worldwide.'),
            'features' => json_decode(SiteSetting::get('homepage_about_features', '[]'), true) ?: [],
        ];
    }

    private function getWhyChooseData()
    {
        return [
            'title' => SiteSetting::get('homepage_why_choose_title', 'Why Choose K-Tech Valves?'),
            'subtitle' => SiteSetting::get('homepage_why_choose_subtitle', 'Discover what sets us apart in the valve manufacturing industry and why customers trust us worldwide.'),
            'points' => json_decode(SiteSetting::get('why_choose_points', '[]'), true) ?: [],
        ];
    }

    private function getFeaturedProductsData()
    {
        return [
            'show_section' => SiteSetting::get('homepage_show_featured_products', true),
            'title' => SiteSetting::get('homepage_featured_products_title', 'Featured Products'),
            'subtitle' => SiteSetting::get('homepage_featured_products_subtitle', 'Discover our most popular valve solutions trusted by industry leaders worldwide.'),
            'max_products' => SiteSetting::get('homepage_featured_products_count', 8),
        ];
    }

    private function getCertificationsData()
    {
        return [
            'show_section' => SiteSetting::get('homepage_show_certifications', true),
            'title' => SiteSetting::get('homepage_certifications_title', 'Our Certifications'),
            'subtitle' => SiteSetting::get('homepage_certifications_subtitle', 'K-Tech Valves maintains the highest industry standards through rigorous certification processes and quality management systems.'),
            'max_certifications' => SiteSetting::get('homepage_certifications_count', 8),
        ];
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\Gallery;
use App\Models\Industry;
use App\Models\Certification;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageManagementController extends Controller
{
    public function aboutUs()
    {
        $sections = [
            'hero' => $this->getAboutHeroData(),
            'mission_vision' => $this->getMissionVisionData(),
            'history' => $this->getHistoryData(),
            'team' => $this->getTeamData(),
            'values' => $this->getValuesData(),
        ];

        $stats = [
            'industries_count' => Industry::active()->count(),
            'clients_count' => Client::active()->count(),
            'certifications_count' => Certification::active()->count(),
        ];

        return view('admin.pages.about-us', compact('sections', 'stats'));
    }

    public function gallery()
    {
        $sections = [
            'hero' => $this->getGalleryHeroData(),
            'settings' => $this->getGallerySettingsData(),
        ];

        $stats = [
            'total_images' => Gallery::active()->count(),
            'categories_count' => Gallery::select('category')->distinct()->count(),
            'featured_count' => Gallery::active()->where('is_featured', true)->count(),
        ];

        $categories = Gallery::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->filter();

        return view('admin.pages.gallery', compact('sections', 'stats', 'categories'));
    }

    public function industries()
    {
        $sections = [
            'hero' => $this->getIndustriesHeroData(),
            'intro' => $this->getIndustriesIntroData(),
        ];

        $stats = [
            'total_industries' => Industry::active()->count(),
            'featured_count' => Industry::active()->where('is_featured', true)->count(),
        ];

        return view('admin.pages.industries', compact('sections', 'stats'));
    }

    public function certifications()
    {
        $sections = [
            'hero' => $this->getCertificationsHeroData(),
            'intro' => $this->getCertificationsIntroData(),
            'quality' => $this->getQualityData(),
        ];

        $stats = [
            'total_certifications' => Certification::active()->count(),
            'valid_count' => Certification::active()->valid()->count(),
            'expired_count' => Certification::active()->where('valid_until', '<', now())->count(),
        ];

        return view('admin.pages.certifications', compact('sections', 'stats'));
    }

    public function contact()
    {
        $sections = [
            'hero' => $this->getContactHeroData(),
            'info' => $this->getContactInfoData(),
            'form' => $this->getContactFormData(),
        ];

        return view('admin.pages.contact', compact('sections'));
    }

    public function updateSection(Request $request, $page, $section)
    {
        $validPages = ['about-us', 'gallery', 'industries', 'certifications', 'contact'];
        
        if (!in_array($page, $validPages)) {
            return redirect()->back()->with('error', 'Invalid page');
        }

        $method = 'update' . ucfirst(str_replace('-', '', $page)) . ucfirst($section) . 'Section';
        
        if (method_exists($this, $method)) {
            return $this->$method($request);
        }

        return redirect()->back()->with('error', 'Section handler not found');
    }

    // About Us Data Methods
    private function getAboutHeroData()
    {
        return [
            'title' => SiteSetting::get('about_hero_title', 'About K-Tech Valves'),
            'subtitle' => SiteSetting::get('about_hero_subtitle', 'Leading the valve manufacturing industry with innovation, quality, and reliability for over two decades.'),
            'background_image' => SiteSetting::get('about_hero_background', ''),
        ];
    }

    private function getMissionVisionData()
    {
        return [
            'mission_title' => SiteSetting::get('about_mission_title', 'Our Mission'),
            'mission_content' => SiteSetting::get('about_mission_content', 'To provide superior valve solutions that exceed industry standards and customer expectations.'),
            'vision_title' => SiteSetting::get('about_vision_title', 'Our Vision'),
            'vision_content' => SiteSetting::get('about_vision_content', 'To be the global leader in valve technology and innovation.'),
        ];
    }

    private function getHistoryData()
    {
        return [
            'title' => SiteSetting::get('about_history_title', 'Our History'),
            'content' => SiteSetting::get('about_history_content', 'Founded with a vision to revolutionize the valve industry...'),
            'milestones' => json_decode(SiteSetting::get('about_history_milestones', '[]'), true) ?: [],
        ];
    }

    private function getTeamData()
    {
        return [
            'title' => SiteSetting::get('about_team_title', 'Our Team'),
            'content' => SiteSetting::get('about_team_content', 'Our experienced professionals are the backbone of our success.'),
        ];
    }

    private function getValuesData()
    {
        return [
            'title' => SiteSetting::get('about_values_title', 'Our Values'),
            'values' => json_decode(SiteSetting::get('about_values_list', '[]'), true) ?: [],
        ];
    }

    // Gallery Data Methods
    private function getGalleryHeroData()
    {
        return [
            'title' => SiteSetting::get('gallery_hero_title', 'Our Gallery'),
            'subtitle' => SiteSetting::get('gallery_hero_subtitle', 'Explore our state-of-the-art manufacturing facilities and product showcase.'),
        ];
    }

    private function getGallerySettingsData()
    {
        return [
            'images_per_page' => SiteSetting::get('gallery_images_per_page', 12),
            'show_categories' => SiteSetting::get('gallery_show_categories', true),
            'enable_lightbox' => SiteSetting::get('gallery_enable_lightbox', true),
        ];
    }

    // Industries Data Methods
    private function getIndustriesHeroData()
    {
        return [
            'title' => SiteSetting::get('industries_hero_title', 'Industries We Serve'),
            'subtitle' => SiteSetting::get('industries_hero_subtitle', 'Providing specialized valve solutions across diverse industries worldwide.'),
        ];
    }

    private function getIndustriesIntroData()
    {
        return [
            'title' => SiteSetting::get('industries_intro_title', 'Comprehensive Industry Solutions'),
            'content' => SiteSetting::get('industries_intro_content', 'Our valves serve critical applications across multiple industries...'),
        ];
    }

    // Certifications Data Methods
    private function getCertificationsHeroData()
    {
        return [
            'title' => SiteSetting::get('certifications_hero_title', 'Our Certifications'),
            'subtitle' => SiteSetting::get('certifications_hero_subtitle', 'Maintaining the highest industry standards through rigorous certification processes.'),
        ];
    }

    private function getCertificationsIntroData()
    {
        return [
            'title' => SiteSetting::get('certifications_intro_title', 'Quality Assurance'),
            'content' => SiteSetting::get('certifications_intro_content', 'Our commitment to quality is demonstrated through our comprehensive certifications...'),
        ];
    }

    private function getQualityData()
    {
        return [
            'title' => SiteSetting::get('certifications_quality_title', 'Quality Management System'),
            'content' => SiteSetting::get('certifications_quality_content', 'Our quality management system ensures consistent excellence...'),
        ];
    }

    // Contact Data Methods
    private function getContactHeroData()
    {
        return [
            'title' => SiteSetting::get('contact_hero_title', 'Contact Us'),
            'subtitle' => SiteSetting::get('contact_hero_subtitle', 'Get in touch with our team of valve specialists for expert consultation and support.'),
        ];
    }

    private function getContactInfoData()
    {
        return [
            'address_title' => SiteSetting::get('contact_address_title', 'Visit Our Facility'),
            'phone_title' => SiteSetting::get('contact_phone_title', 'Call Us'),
            'email_title' => SiteSetting::get('contact_email_title', 'Email Us'),
            'hours_title' => SiteSetting::get('contact_hours_title', 'Business Hours'),
        ];
    }

    private function getContactFormData()
    {
        return [
            'title' => SiteSetting::get('contact_form_title', 'Send us a Message'),
            'subtitle' => SiteSetting::get('contact_form_subtitle', 'Fill out the form below and our team will get back to you within 24 hours.'),
        ];
    }

    // Update Methods (sample implementation - you can expand these)
    private function updateAboutusheroSection(Request $request)
    {
        $request->validate([
            'about_hero_title' => 'required|string|max:255',
            'about_hero_subtitle' => 'required|string',
            'about_hero_background' => 'nullable|string',
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_hero_title'], [
            'value' => $request->about_hero_title,
            'type' => 'text',
            'group' => 'about',
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_hero_subtitle'], [
            'value' => $request->about_hero_subtitle,
            'type' => 'textarea',
            'group' => 'about',
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_hero_background'], [
            'value' => $request->about_hero_background,
            'type' => 'text',
            'group' => 'about',
        ]);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'About Us hero section updated successfully!');
    }

    // Add more update methods as needed...
}

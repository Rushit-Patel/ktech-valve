<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page;
use App\Models\Certification;
use App\Models\Testimonial;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends BaseController
{
    /**
     * Display the about us page
     */
    public function about()
    {
        // Set SEO data for about page
        $this->setSeoData('about', null, [
            'title' => 'About K Tech Valves - Leading Industrial Valve Manufacturer',
            'description' => 'Learn about K Tech Valves, a leading manufacturer of industrial valves with years of expertise, commitment to quality, and dedication to customer satisfaction.',
            'keywords' => 'about K Tech Valves, valve manufacturer, company history, industrial valve expertise'
        ]);

        // Get about page content
        $aboutPage = Page::active()->where('slug', 'about-us')->first();

        // Get company statistics
        $stats = [
            'years_experience' => now()->year - 2010, // Adjust base year
            'products_manufactured' => '500+',
            'industries_served' => \App\Models\Industry::active()->count(),
            'satisfied_clients' => Client::active()->count(),
            'certifications' => Certification::active()->valid()->count()
        ];

        // Get team members (users with specific roles)
        $teamMembers = User::active()
            ->whereIn('role', ['super_admin', 'admin'])
            ->take(6)
            ->get();

        // Get testimonials
        $testimonials = Testimonial::active()
            ->featured()
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        // Get certifications
        $certifications = Certification::active()
            ->valid()
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        return view('frontend.pages.about', compact(
            'aboutPage',
            'stats',
            'teamMembers',
            'testimonials',
            'certifications'
        ));
    }

    /**
     * Display the certifications page
     */
    public function certifications()
    {
        // Set SEO data for certifications page
        $this->setSeoData('certifications', null, [
            'title' => 'Quality Certifications - K Tech Valves',
            'description' => 'View our quality certifications and accreditations that demonstrate our commitment to manufacturing excellence and international standards.',
            'keywords' => 'quality certifications, ISO certification, valve quality standards, manufacturing certifications'
        ]);

        $certifications = Certification::active()
            ->orderBy('sort_order')
            ->orderBy('issued_date', 'desc')
            ->paginate(12);

        // Group certifications by type/category if needed
        $certificationsByType = $certifications->getCollection()->groupBy(function($cert) {
            return $cert->issued_by ?: 'Other';
        });

        return view('frontend.pages.certifications', compact('certifications', 'certificationsByType'));
    }

    /**
     * Display any static page by slug
     */
    public function show($slug)
    {
        $page = Page::active()->where('slug', $slug)->firstOrFail();

        // Set SEO data for the page
        $this->setSeoData('page', $page->slug, [
            'title' => $page->meta_title,
            'description' => $page->meta_description,
            'keywords' => $page->meta_keywords
        ]);

        return view('frontend.pages.show', compact('page'));
    }

    /**
     * Display quality policy page
     */
    public function qualityPolicy()
    {
        $page = Page::active()->where('slug', 'quality-policy')->first();

        // Set SEO data
        $this->setSeoData('quality_policy', null, [
            'title' => 'Quality Policy - K Tech Valves',
            'description' => 'Our comprehensive quality policy outlines our commitment to manufacturing excellence and customer satisfaction.',
            'keywords' => 'quality policy, manufacturing standards, quality assurance, valve quality'
        ]);

        // Get related certifications
        $certifications = Certification::active()
            ->valid()
            ->take(6)
            ->get();

        return view('frontend.pages.quality-policy', compact('page', 'certifications'));
    }

    /**
     * Display privacy policy page
     */
    public function privacyPolicy()
    {
        $page = Page::active()->where('slug', 'privacy-policy')->first();

        $this->setSeoData('privacy_policy', null, [
            'title' => 'Privacy Policy - K Tech Valves',
            'description' => 'Read our privacy policy to understand how we collect, use, and protect your personal information.',
            'keywords' => 'privacy policy, data protection, personal information'
        ]);

        return view('frontend.pages.privacy-policy', compact('page'));
    }

    /**
     * Display terms and conditions page
     */
    public function termsConditions()
    {
        $page = Page::active()->where('slug', 'terms-conditions')->first();

        $this->setSeoData('terms_conditions', null, [
            'title' => 'Terms & Conditions - K Tech Valves',
            'description' => 'Read our terms and conditions for using our website and services.',
            'keywords' => 'terms conditions, website terms, service terms'
        ]);

        return view('frontend.pages.terms-conditions', compact('page'));
    }
}
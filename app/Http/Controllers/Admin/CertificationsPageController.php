<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CertificationsPageController extends Controller
{
    public function index()
    {
        $sections = [
            'hero' => $this->getHeroData(),
            'intro' => $this->getIntroData(),
            'quality' => $this->getQualityData(),
        ];

        $stats = [
            'total_certifications' => Certification::active()->count(),
            'valid_count' => Certification::active()->valid()->count(),
            'expired_count' => Certification::active()->where('valid_until', '<', now())->count(),
        ];

        return view('admin.certifications-page.index', compact('sections', 'stats'));
    }

    public function updateSection(Request $request, $section)
    {
        $validSections = ['hero', 'intro', 'quality'];
        
        if (!in_array($section, $validSections)) {
            return redirect()->back()->with('error', 'Invalid section');
        }

        $method = 'update' . ucfirst($section) . 'Section';
        
        if (method_exists($this, $method)) {
            return $this->$method($request);
        }

        return redirect()->back()->with('error', 'Section handler not found');
    }

    private function getHeroData()
    {
        return [
            'title' => SiteSetting::get('certifications_hero_title', 'Our Certifications'),
            'subtitle' => SiteSetting::get('certifications_hero_subtitle', 'Maintaining the highest industry standards through rigorous certification processes and quality management systems.'),
            'background_image' => SiteSetting::get('certifications_hero_background', ''),
        ];
    }

    private function getIntroData()
    {
        return [
            'title' => SiteSetting::get('certifications_intro_title', 'Quality Assurance'),
            'content' => SiteSetting::get('certifications_intro_content', 'Our commitment to quality is demonstrated through our comprehensive certifications and adherence to international standards.'),
        ];
    }

    private function getQualityData()
    {
        return [
            'title' => SiteSetting::get('certifications_quality_title', 'Quality Management System'),
            'content' => SiteSetting::get('certifications_quality_content', 'Our quality management system ensures consistent excellence in every aspect of our operations, from design to delivery.'),
        ];
    }

    private function updateHeroSection(Request $request)
    {
        $request->validate([
            'certifications_hero_title' => 'required|string|max:255',
            'certifications_hero_subtitle' => 'required|string',
            'certifications_hero_background' => 'nullable|string',
        ]);

        SiteSetting::updateOrCreate(['key' => 'certifications_hero_title'], [
            'value' => $request->certifications_hero_title,
            'type' => 'text',
            'group' => 'certifications',
        ]);

        SiteSetting::updateOrCreate(['key' => 'certifications_hero_subtitle'], [
            'value' => $request->certifications_hero_subtitle,
            'type' => 'textarea',
            'group' => 'certifications',
        ]);

        SiteSetting::updateOrCreate(['key' => 'certifications_hero_background'], [
            'value' => $request->certifications_hero_background,
            'type' => 'text',
            'group' => 'certifications',
        ]);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Certifications hero section updated successfully!');
    }

    private function updateIntroSection(Request $request)
    {
        $request->validate([
            'certifications_intro_title' => 'required|string|max:255',
            'certifications_intro_content' => 'required|string',
        ]);

        SiteSetting::updateOrCreate(['key' => 'certifications_intro_title'], [
            'value' => $request->certifications_intro_title,
            'type' => 'text',
            'group' => 'certifications',
        ]);

        SiteSetting::updateOrCreate(['key' => 'certifications_intro_content'], [
            'value' => $request->certifications_intro_content,
            'type' => 'textarea',
            'group' => 'certifications',
        ]);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Certifications introduction section updated successfully!');
    }

    private function updateQualitySection(Request $request)
    {
        $request->validate([
            'certifications_quality_title' => 'required|string|max:255',
            'certifications_quality_content' => 'required|string',
        ]);

        SiteSetting::updateOrCreate(['key' => 'certifications_quality_title'], [
            'value' => $request->certifications_quality_title,
            'type' => 'text',
            'group' => 'certifications',
        ]);

        SiteSetting::updateOrCreate(['key' => 'certifications_quality_content'], [
            'value' => $request->certifications_quality_content,
            'type' => 'textarea',
            'group' => 'certifications',
        ]);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Quality management section updated successfully!');
    }
}

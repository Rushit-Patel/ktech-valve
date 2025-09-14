<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndustriesPageController extends Controller
{
    public function index()
    {
        $sections = [
            'hero' => $this->getHeroData(),
            'intro' => $this->getIntroData(),
            'expertise' => $this->getExpertiseData(),
        ];

        $stats = [
            'total_industries' => Industry::active()->count(),
            'featured_count' => Industry::active()->where('is_featured', true)->count(),
            'years_experience' => SiteSetting::get('company_experience_years', 25),
        ];

        return view('admin.industries-page.index', compact('sections', 'stats'));
    }

    public function updateSection(Request $request, $section)
    {
        $validSections = ['hero', 'intro', 'expertise'];
        
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
            'title' => SiteSetting::get('industries_hero_title', 'Industries We Serve'),
            'subtitle' => SiteSetting::get('industries_hero_subtitle', 'Providing specialized valve solutions across diverse industries worldwide.'),
            'background_image' => SiteSetting::get('industries_hero_background', ''),
        ];
    }

    private function getIntroData()
    {
        return [
            'title' => SiteSetting::get('industries_intro_title', 'Comprehensive Industry Solutions'),
            'content' => SiteSetting::get('industries_intro_content', 'Our valves serve critical applications across multiple industries, from oil and gas to pharmaceuticals, ensuring reliable performance in the most demanding environments.'),
        ];
    }

    private function getExpertiseData()
    {
        return [
            'title' => SiteSetting::get('industries_expertise_title', 'Our Industry Expertise'),
            'content' => SiteSetting::get('industries_expertise_content', 'With decades of experience, we understand the unique challenges each industry faces and provide tailored solutions.'),
        ];
    }

    private function updateHeroSection(Request $request)
    {
        $request->validate([
            'industries_hero_title' => 'required|string|max:255',
            'industries_hero_subtitle' => 'required|string',
            'industries_hero_background' => 'nullable|string',
        ]);

        SiteSetting::updateOrCreate(['key' => 'industries_hero_title'], [
            'value' => $request->industries_hero_title,
            'type' => 'text',
            'group' => 'industries',
        ]);

        SiteSetting::updateOrCreate(['key' => 'industries_hero_subtitle'], [
            'value' => $request->industries_hero_subtitle,
            'type' => 'textarea',
            'group' => 'industries',
        ]);

        SiteSetting::updateOrCreate(['key' => 'industries_hero_background'], [
            'value' => $request->industries_hero_background,
            'type' => 'text',
            'group' => 'industries',
        ]);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Industries hero section updated successfully!');
    }

    private function updateIntroSection(Request $request)
    {
        $request->validate([
            'industries_intro_title' => 'required|string|max:255',
            'industries_intro_content' => 'required|string',
        ]);

        SiteSetting::updateOrCreate(['key' => 'industries_intro_title'], [
            'value' => $request->industries_intro_title,
            'type' => 'text',
            'group' => 'industries',
        ]);

        SiteSetting::updateOrCreate(['key' => 'industries_intro_content'], [
            'value' => $request->industries_intro_content,
            'type' => 'textarea',
            'group' => 'industries',
        ]);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Industries introduction section updated successfully!');
    }

    private function updateExpertiseSection(Request $request)
    {
        $request->validate([
            'industries_expertise_title' => 'required|string|max:255',
            'industries_expertise_content' => 'required|string',
        ]);

        SiteSetting::updateOrCreate(['key' => 'industries_expertise_title'], [
            'value' => $request->industries_expertise_title,
            'type' => 'text',
            'group' => 'industries',
        ]);

        SiteSetting::updateOrCreate(['key' => 'industries_expertise_content'], [
            'value' => $request->industries_expertise_content,
            'type' => 'textarea',
            'group' => 'industries',
        ]);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Industries expertise section updated successfully!');
    }
}

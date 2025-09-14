<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AboutPageController extends Controller
{
    public function index()
    {
        $sections = [
            'hero' => $this->getHeroData(),
            'mission_vision' => $this->getMissionVisionData(),
            'history' => $this->getHistoryData(),
            'values' => $this->getValuesData(),
        ];

        $stats = [
            'years_experience' => SiteSetting::get('company_experience_years', 25),
            'countries_served' => SiteSetting::get('about_countries_served', 50),
            'satisfied_clients' => SiteSetting::get('about_satisfied_clients', 1000),
        ];

        return view('admin.about-page.index', compact('sections', 'stats'));
    }

    public function updateSection(Request $request, $section)
    {
        $validSections = ['hero', 'mission-vision', 'history', 'values'];
        
        if (!in_array($section, $validSections)) {
            return redirect()->back()->with('error', 'Invalid section');
        }

        $method = 'update' . ucfirst(str_replace('-', '', $section)) . 'Section';
        
        if (method_exists($this, $method)) {
            return $this->$method($request);
        }

        return redirect()->back()->with('error', 'Section handler not found');
    }    private function getHeroData()
    {
        return [
            'title' => SiteSetting::get('about_hero_title', 'About K-Tech Valves'),
            'subtitle' => SiteSetting::get('about_hero_subtitle', 'Leading the valve manufacturing industry with innovation, quality, and reliability for over two decades.'),
            'description' => SiteSetting::get('about_hero_description', ''),
            'background_image' => SiteSetting::get('about_hero_background', ''),
        ];
    }    private function getMissionVisionData()
    {
        return [
            'mission_title' => SiteSetting::get('about_mission_title', 'Our Mission'),
            'mission_description' => SiteSetting::get('about_mission_content', 'To provide superior valve solutions that exceed industry standards and customer expectations.'),
            'vision_title' => SiteSetting::get('about_vision_title', 'Our Vision'),
            'vision_description' => SiteSetting::get('about_vision_content', 'To be the global leader in valve technology and innovation.'),
        ];
    }    private function getHistoryData()
    {
        return [
            'title' => SiteSetting::get('about_history_title', 'Our History'),
            'description' => SiteSetting::get('about_history_description', 'Founded with a vision to revolutionize the valve industry...'),
            'founded_year' => SiteSetting::get('about_history_founded_year', '1999'),
        ];
    }

    private function getValuesData()
    {
        return [
            'title' => SiteSetting::get('about_values_title', 'Our Core Values'),
            'description' => SiteSetting::get('about_values_description', 'The principles that guide everything we do'),
            'value_1_title' => SiteSetting::get('about_values_value_1_title', 'Quality'),
            'value_1_description' => SiteSetting::get('about_values_value_1_description', 'We never compromise on quality'),
            'value_2_title' => SiteSetting::get('about_values_value_2_title', 'Innovation'),
            'value_2_description' => SiteSetting::get('about_values_value_2_description', 'We constantly innovate'),
            'value_3_title' => SiteSetting::get('about_values_value_3_title', 'Reliability'),
            'value_3_description' => SiteSetting::get('about_values_value_3_description', 'Our products are reliable'),
        ];
    }private function updateHeroSection(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
            'description' => 'nullable|string',
            'background_image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        // Handle file upload if present
        $backgroundImage = SiteSetting::get('about_hero_background', '');
        if ($request->hasFile('background_image')) {
            $file = $request->file('background_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('settings', $fileName, 'public');
            $backgroundImage = $filePath;
        }

        SiteSetting::updateOrCreate(['key' => 'about_hero_title'], [
            'value' => $request->title,
            'type' => 'text',
            'group' => 'about',
            'label' => 'About Hero Title',
            'description' => 'Main title for the about page hero section'
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_hero_subtitle'], [
            'value' => $request->subtitle,
            'type' => 'textarea',
            'group' => 'about',
            'label' => 'About Hero Subtitle',
            'description' => 'Subtitle for the about page hero section'
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_hero_description'], [
            'value' => $request->description,
            'type' => 'textarea',
            'group' => 'about',
            'label' => 'About Hero Description',
            'description' => 'Description for the about page hero section'
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_hero_background'], [
            'value' => $backgroundImage,
            'type' => 'text',
            'group' => 'about',
            'label' => 'About Hero Background Image',
            'description' => 'Background image URL for the about page hero section'
        ]);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'About hero section updated successfully!');
    }    private function updateMissionvisionSection(Request $request)
    {
        $request->validate([
            'mission_title' => 'required|string|max:255',
            'mission_description' => 'required|string',
            'vision_title' => 'required|string|max:255',
            'vision_description' => 'required|string',
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_mission_title'], [
            'value' => $request->mission_title,
            'type' => 'text',
            'group' => 'about',
            'label' => 'Mission Title',
            'description' => 'Title for the mission section'
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_mission_content'], [
            'value' => $request->mission_description,
            'type' => 'textarea',
            'group' => 'about',
            'label' => 'Mission Content',
            'description' => 'Content for the mission section'
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_vision_title'], [
            'value' => $request->vision_title,
            'type' => 'text',
            'group' => 'about',
            'label' => 'Vision Title',
            'description' => 'Title for the vision section'
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_vision_content'], [
            'value' => $request->vision_description,
            'type' => 'textarea',
            'group' => 'about',
            'label' => 'Vision Content',
            'description' => 'Content for the vision section'
        ]);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Mission & Vision section updated successfully!');
    }

    private function updateHistorySection(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'founded_year' => 'required|integer|min:1800|max:' . date('Y'),
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_history_title'], [
            'value' => $request->title,
            'type' => 'text',
            'group' => 'about',
            'label' => 'History Title',
            'description' => 'Title for the history section'
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_history_description'], [
            'value' => $request->description,
            'type' => 'textarea',
            'group' => 'about',
            'label' => 'History Description',
            'description' => 'Description for the history section'
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_history_founded_year'], [
            'value' => $request->founded_year,
            'type' => 'text',
            'group' => 'about',
            'label' => 'Founded Year',
            'description' => 'Year the company was founded'
        ]);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Company History section updated successfully!');
    }

    private function updateValuesSection(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'value_1_title' => 'required|string|max:255',
            'value_1_description' => 'required|string',
            'value_2_title' => 'required|string|max:255',
            'value_2_description' => 'required|string',
            'value_3_title' => 'required|string|max:255',
            'value_3_description' => 'required|string',
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_values_title'], [
            'value' => $request->title,
            'type' => 'text',
            'group' => 'about',
            'label' => 'Values Title',
            'description' => 'Title for the values section'
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_values_description'], [
            'value' => $request->description,
            'type' => 'textarea',
            'group' => 'about',
            'label' => 'Values Description',
            'description' => 'Description for the values section'
        ]);

        // Value 1
        SiteSetting::updateOrCreate(['key' => 'about_values_value_1_title'], [
            'value' => $request->value_1_title,
            'type' => 'text',
            'group' => 'about',
            'label' => 'Value 1 Title',
            'description' => 'Title for the first value'
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_values_value_1_description'], [
            'value' => $request->value_1_description,
            'type' => 'textarea',
            'group' => 'about',
            'label' => 'Value 1 Description',
            'description' => 'Description for the first value'
        ]);

        // Value 2
        SiteSetting::updateOrCreate(['key' => 'about_values_value_2_title'], [
            'value' => $request->value_2_title,
            'type' => 'text',
            'group' => 'about',
            'label' => 'Value 2 Title',
            'description' => 'Title for the second value'
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_values_value_2_description'], [
            'value' => $request->value_2_description,
            'type' => 'textarea',
            'group' => 'about',
            'label' => 'Value 2 Description',
            'description' => 'Description for the second value'
        ]);

        // Value 3
        SiteSetting::updateOrCreate(['key' => 'about_values_value_3_title'], [
            'value' => $request->value_3_title,
            'type' => 'text',
            'group' => 'about',
            'label' => 'Value 3 Title',
            'description' => 'Title for the third value'
        ]);

        SiteSetting::updateOrCreate(['key' => 'about_values_value_3_description'], [
            'value' => $request->value_3_description,
            'type' => 'textarea',
            'group' => 'about',
            'label' => 'Value 3 Description',
            'description' => 'Description for the third value'
        ]);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Company Values section updated successfully!');
    }
}

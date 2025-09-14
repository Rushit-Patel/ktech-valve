<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Helpers\SiteHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {        $request->validate([
            // Company Information
            'company_name' => 'required|string|max:255',
            'company_tagline' => 'nullable|string|max:255',
            'company_description' => 'nullable|string',
            'company_experience_years' => 'nullable|integer|min:1|max:100',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            // Contact Information
            'contact_phone' => 'nullable|string|max:50',
            'contact_email' => 'nullable|email|max:255',
            'contact_address' => 'nullable|string',
            'contact_province' => 'nullable|string|max:255',
            'contact_business_hours' => 'nullable|string|max:255',
            'contact_response_time' => 'nullable|string|max:255',

            // Social Media
            'social_facebook' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',

            // About Content
            'about_story_title' => 'nullable|string|max:255',
            'about_story_content' => 'nullable|string',
            'about_mission' => 'nullable|string',
            'about_vision' => 'nullable|string',

            // Home Page Content
            'home_contact_title' => 'nullable|string|max:255',
            'home_contact_subtitle' => 'nullable|string',
            'home_contact_description' => 'nullable|string',
            'home_clients_intro' => 'nullable|string',

            // Button Texts
            'btn_explore_products' => 'nullable|string|max:100',
            'btn_get_quote' => 'nullable|string|max:100',
            'btn_contact_us' => 'nullable|string|max:100',

            // SEO Settings
            'seo_default_title' => 'nullable|string|max:255',
            'seo_default_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',

            // Footer Settings
            'footer_about_text' => 'nullable|string',
            'footer_copyright' => 'nullable|string|max:255',

            // Form Settings
            'form_success_message' => 'nullable|string',
            'form_newsletter_text' => 'nullable|string',

            // Why Choose Points (JSON array)
            'why_choose_points' => 'nullable|array',
            'why_choose_points.*' => 'string|max:255'
        ]);        // Handle why choose points
        $whyChoosePoints = $request->input('why_choose_points', []);
        $whyChoosePoints = array_filter($whyChoosePoints); // Remove empty values        // Handle file uploads
        if ($request->hasFile('company_logo')) {
            // Delete old logo if exists
            $currentLogo = SiteSetting::where('key', 'company_logo')->first();
            if ($currentLogo && $currentLogo->value && Storage::disk('public')->exists($currentLogo->value)) {
                Storage::disk('public')->delete($currentLogo->value);
            }
            
            // Store new logo
            $logoPath = $request->file('company_logo')->store('settings/logos', 'public');
            SiteSetting::updateOrCreate(
                ['key' => 'company_logo'],
                [
                    'value' => $logoPath,
                    'type' => 'image',
                    'group' => 'company',
                    'label' => 'Company Logo',
                    'description' => 'Company logo displayed in header and footer (recommended size: 200x60px)'
                ]
            );
        }

        // Update all other settings
        $settingsData = $request->except(['_token', '_method', 'why_choose_points', 'company_logo']);
        
        // Add the JSON field
        $settingsData['why_choose_points'] = json_encode(array_values($whyChoosePoints));

        // Define settings metadata
        $settingsMetadata = [
            // Company Information
            'company_name' => ['type' => 'text', 'group' => 'company', 'label' => 'Company Name', 'description' => 'Official company name'],
            'company_tagline' => ['type' => 'text', 'group' => 'company', 'label' => 'Company Tagline', 'description' => 'Short tagline or slogan'],
            'company_description' => ['type' => 'textarea', 'group' => 'company', 'label' => 'Company Description', 'description' => 'Main company description'],
            'company_experience_years' => ['type' => 'number', 'group' => 'company', 'label' => 'Years of Experience', 'description' => 'Number of years in business'],
            
            // Contact Information
            'contact_phone' => ['type' => 'text', 'group' => 'contact', 'label' => 'Phone Number', 'description' => 'Main contact phone number'],
            'contact_email' => ['type' => 'email', 'group' => 'contact', 'label' => 'Email Address', 'description' => 'Main contact email address'],
            'contact_address' => ['type' => 'textarea', 'group' => 'contact', 'label' => 'Address', 'description' => 'Complete business address'],
            'contact_province' => ['type' => 'text', 'group' => 'contact', 'label' => 'Province/State', 'description' => 'Province or state location'],
            'contact_business_hours' => ['type' => 'text', 'group' => 'contact', 'label' => 'Business Hours', 'description' => 'Operating hours information'],
            'contact_response_time' => ['type' => 'text', 'group' => 'contact', 'label' => 'Response Time', 'description' => 'Expected response time'],
            
            // Social Media
            'social_facebook' => ['type' => 'url', 'group' => 'social', 'label' => 'Facebook URL', 'description' => 'Facebook page URL'],
            'social_linkedin' => ['type' => 'url', 'group' => 'social', 'label' => 'LinkedIn URL', 'description' => 'LinkedIn company page URL'],
            'social_twitter' => ['type' => 'url', 'group' => 'social', 'label' => 'Twitter URL', 'description' => 'Twitter profile URL'],
            'social_youtube' => ['type' => 'url', 'group' => 'social', 'label' => 'YouTube URL', 'description' => 'YouTube channel URL'],
            
            // About Content
            'about_story_title' => ['type' => 'text', 'group' => 'about', 'label' => 'Story Title', 'description' => 'Title for company story section'],
            'about_story_content' => ['type' => 'textarea', 'group' => 'about', 'label' => 'Story Content', 'description' => 'Company story content'],
            'about_mission' => ['type' => 'textarea', 'group' => 'about', 'label' => 'Mission Statement', 'description' => 'Company mission statement'],
            'about_vision' => ['type' => 'textarea', 'group' => 'about', 'label' => 'Vision Statement', 'description' => 'Company vision statement'],
            
            // Home Page Content
            'home_contact_title' => ['type' => 'text', 'group' => 'homepage', 'label' => 'Contact Section Title', 'description' => 'Title for homepage contact section'],
            'why_choose_points' => ['type' => 'json', 'group' => 'homepage', 'label' => 'Why Choose Points', 'description' => 'Points highlighting why customers should choose the company'],
            
            // SEO Settings
            'seo_default_title' => ['type' => 'text', 'group' => 'seo', 'label' => 'Default Page Title', 'description' => 'Default title for pages without specific titles'],
            'seo_default_description' => ['type' => 'textarea', 'group' => 'seo', 'label' => 'Default Meta Description', 'description' => 'Default meta description for pages'],
            'seo_keywords' => ['type' => 'textarea', 'group' => 'seo', 'label' => 'SEO Keywords', 'description' => 'Default SEO keywords'],
        ];

        foreach ($settingsData as $key => $value) {
            if ($value !== null) {
                $metadata = $settingsMetadata[$key] ?? [
                    'type' => 'text',
                    'group' => 'general',
                    'label' => ucwords(str_replace('_', ' ', $key)),
                    'description' => 'Setting for ' . str_replace('_', ' ', $key)
                ];
                
                SiteSetting::updateOrCreate(
                    ['key' => $key],
                    array_merge(['value' => $value], $metadata)
                );
            }
        }

        // Clear cache
        SiteHelper::clearCache();

        return redirect()->route('admin.settings.index')
                        ->with('success', 'Settings updated successfully!');
    }

    public function removeFile(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
        ]);

        $setting = SiteSetting::where('key', $request->key)->first();
        
        if ($setting && $setting->value) {
            // Delete the file from storage
            if (Storage::disk('public')->exists($setting->value)) {
                Storage::disk('public')->delete($setting->value);
            }
            
            // Clear the setting value
            $setting->update(['value' => null]);
            
            // Clear cache
            SiteHelper::clearCache();
        }

        return response()->json(['success' => true]);
    }
}
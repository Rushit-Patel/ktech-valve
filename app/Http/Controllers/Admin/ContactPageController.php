<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ContactPageController extends Controller
{
    public function index()
    {
        $sections = [
            'hero' => $this->getHeroData(),
            'info' => $this->getInfoData(),
            'form' => $this->getFormData(),
            'map' => $this->getMapData(),
        ];

        return view('admin.contact-page.index', compact('sections'));
    }

    public function updateSection(Request $request, $section)
    {
        $validSections = ['hero', 'info', 'form', 'map'];
        
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
            'title' => SiteSetting::get('contact_hero_title', 'Contact Us'),
            'subtitle' => SiteSetting::get('contact_hero_subtitle', 'Get in touch with our team of valve specialists for expert consultation and support.'),
            'background_image' => SiteSetting::get('contact_hero_background', ''),
        ];
    }

    private function getInfoData()
    {
        return [
            'address_title' => SiteSetting::get('contact_address_title', 'Visit Our Facility'),
            'phone_title' => SiteSetting::get('contact_phone_title', 'Call Us'),
            'email_title' => SiteSetting::get('contact_email_title', 'Email Us'),
            'hours_title' => SiteSetting::get('contact_hours_title', 'Business Hours'),
            'response_message' => SiteSetting::get('contact_response_message', 'We typically respond within 24 hours'),
        ];
    }

    private function getFormData()
    {
        return [
            'title' => SiteSetting::get('contact_form_title', 'Send us a Message'),
            'subtitle' => SiteSetting::get('contact_form_subtitle', 'Fill out the form below and our team will get back to you within 24 hours.'),
            'success_message' => SiteSetting::get('contact_form_success_message', 'Thank you for your message! We will get back to you soon.'),
            'show_company_field' => SiteSetting::get('contact_form_show_company', true),
            'show_phone_field' => SiteSetting::get('contact_form_show_phone', true),
        ];
    }

    private function getMapData()
    {
        return [
            'show_map' => SiteSetting::get('contact_show_map', true),
            'map_embed_url' => SiteSetting::get('contact_map_embed_url', ''),
            'map_title' => SiteSetting::get('contact_map_title', 'Find Us'),
        ];
    }

    private function updateHeroSection(Request $request)
    {
        $request->validate([
            'contact_hero_title' => 'required|string|max:255',
            'contact_hero_subtitle' => 'required|string',
            'contact_hero_background' => 'nullable|string',
        ]);

        SiteSetting::updateOrCreate(['key' => 'contact_hero_title'], [
            'value' => $request->contact_hero_title,
            'type' => 'text',
            'group' => 'contact',
        ]);

        SiteSetting::updateOrCreate(['key' => 'contact_hero_subtitle'], [
            'value' => $request->contact_hero_subtitle,
            'type' => 'textarea',
            'group' => 'contact',
        ]);

        SiteSetting::updateOrCreate(['key' => 'contact_hero_background'], [
            'value' => $request->contact_hero_background,
            'type' => 'text',
            'group' => 'contact',
        ]);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Contact hero section updated successfully!');
    }

    private function updateFormSection(Request $request)
    {
        $request->validate([
            'contact_form_title' => 'required|string|max:255',
            'contact_form_subtitle' => 'required|string',
            'contact_form_success_message' => 'required|string',
            'contact_form_show_company' => 'boolean',
            'contact_form_show_phone' => 'boolean',
        ]);

        SiteSetting::updateOrCreate(['key' => 'contact_form_title'], [
            'value' => $request->contact_form_title,
            'type' => 'text',
            'group' => 'contact',
        ]);

        SiteSetting::updateOrCreate(['key' => 'contact_form_subtitle'], [
            'value' => $request->contact_form_subtitle,
            'type' => 'textarea',
            'group' => 'contact',
        ]);

        SiteSetting::updateOrCreate(['key' => 'contact_form_success_message'], [
            'value' => $request->contact_form_success_message,
            'type' => 'text',
            'group' => 'contact',
        ]);

        SiteSetting::updateOrCreate(['key' => 'contact_form_show_company'], [
            'value' => $request->has('contact_form_show_company') ? '1' : '0',
            'type' => 'boolean',
            'group' => 'contact',
        ]);

        SiteSetting::updateOrCreate(['key' => 'contact_form_show_phone'], [
            'value' => $request->has('contact_form_show_phone') ? '1' : '0',
            'type' => 'boolean',
            'group' => 'contact',
        ]);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Contact form section updated successfully!');
    }
}

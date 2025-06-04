<?php

namespace Database\Seeders;

use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;

class WebsiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'site_name', 'value' => 'K Tech Valves', 'type' => 'text', 'group' => 'general', 'label' => 'Site Name'],
            ['key' => 'site_tagline', 'value' => 'Leading Industrial Valve Manufacturer', 'type' => 'text', 'group' => 'general', 'label' => 'Site Tagline'],
            ['key' => 'site_logo', 'value' => 'logo.png', 'type' => 'image', 'group' => 'general', 'label' => 'Site Logo'],
            ['key' => 'favicon', 'value' => 'favicon.ico', 'type' => 'image', 'group' => 'general', 'label' => 'Favicon'],
            
            // Contact Settings
            ['key' => 'contact_email', 'value' => 'info@ktechvalves.com', 'type' => 'text', 'group' => 'contact', 'label' => 'Contact Email'],
            ['key' => 'contact_phone', 'value' => '+91-XXXXXXXXXX', 'type' => 'text', 'group' => 'contact', 'label' => 'Contact Phone'],
            ['key' => 'contact_address', 'value' => 'Industrial Area, City, State, Country', 'type' => 'textarea', 'group' => 'contact', 'label' => 'Contact Address'],
            
            // SEO Settings
            ['key' => 'default_meta_title', 'value' => 'K Tech Valves - Industrial Valve Manufacturer', 'type' => 'text', 'group' => 'seo', 'label' => 'Default Meta Title'],
            ['key' => 'default_meta_description', 'value' => 'Leading manufacturer of industrial valves including butterfly valves, ball valves, check valves and more.', 'type' => 'textarea', 'group' => 'seo', 'label' => 'Default Meta Description'],
            ['key' => 'google_analytics_id', 'value' => '', 'type' => 'text', 'group' => 'seo', 'label' => 'Google Analytics ID'],
            
            // Social Media
            ['key' => 'facebook_url', 'value' => '', 'type' => 'text', 'group' => 'social', 'label' => 'Facebook URL'],
            ['key' => 'twitter_url', 'value' => '', 'type' => 'text', 'group' => 'social', 'label' => 'Twitter URL'],
            ['key' => 'linkedin_url', 'value' => '', 'type' => 'text', 'group' => 'social', 'label' => 'LinkedIn URL'],
            ['key' => 'youtube_url', 'value' => '', 'type' => 'text', 'group' => 'social', 'label' => 'YouTube URL'],
        ];

        foreach ($settings as $setting) {
            WebsiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
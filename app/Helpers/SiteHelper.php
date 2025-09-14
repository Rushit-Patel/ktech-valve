<?php

namespace App\Helpers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SiteHelper
{
    /**
     * Get a site setting value
     */
    public static function get($key, $default = null)
    {
        return Cache::remember("site_setting_{$key}", 3600, function () use ($key, $default) {
            return SiteSetting::get($key, $default);
        });
    }

    /**
     * Get multiple site settings by group
     */
    public static function getByGroup($group)
    {
        return Cache::remember("site_settings_group_{$group}", 3600, function () use ($group) {
            return SiteSetting::where('group', $group)->pluck('value', 'key')->toArray();
        });
    }

    /**
     * Get all contact information
     */
    public static function getContactInfo()
    {
        return self::getByGroup('contact');
    }

    /**
     * Get all social media links
     */
    public static function getSocialLinks()
    {
        $social = self::getByGroup('social');
        return array_filter($social); // Remove empty values
    }

    /**
     * Get company information
     */
    public static function getCompanyInfo()
    {
        return self::getByGroup('company');
    }

    /**
     * Get about page content
     */
    public static function getAboutContent()
    {
        $about = self::getByGroup('about');
        // Decode JSON fields
        if (isset($about['why_choose_points'])) {
            $about['why_choose_points'] = json_decode($about['why_choose_points'], true);
        }
        return $about;
    }

    /**
     * Get home page content
     */
    public static function getHomeContent()
    {
        return self::getByGroup('home');
    }

    /**
     * Get button texts
     */
    public static function getButtonTexts()
    {
        return self::getByGroup('buttons');
    }

    /**
     * Get SEO settings
     */
    public static function getSeoSettings()
    {
        return self::getByGroup('seo');
    }

    /**
     * Get footer settings
     */
    public static function getFooterSettings()
    {
        return self::getByGroup('footer');
    }

    /**
     * Get form settings
     */
    public static function getFormSettings()
    {
        return self::getByGroup('forms');
    }

    /**
     * Clear site settings cache
     */
    public static function clearCache()
    {
        $groups = ['contact', 'social', 'company', 'about', 'home', 'buttons', 'seo', 'footer', 'forms'];
        
        foreach ($groups as $group) {
            Cache::forget("site_settings_group_{$group}");
        }

        // Also clear individual setting caches
        $settings = SiteSetting::all();
        foreach ($settings as $setting) {
            Cache::forget("site_setting_{$setting->key}");
        }
    }

    /**
     * Get company name with fallback
     */
    public static function getCompanyName()
    {
        return self::get('company_name', 'K-Tech Valves');
    }

    /**
     * Get years of experience with "+" suffix
     */
    public static function getExperienceYears()
    {
        $years = self::get('company_experience_years', '25');
        return $years . '+';
    }

    /**
     * Get formatted phone number
     */
    public static function getPhone()
    {
        return self::get('contact_phone', '+1 (555) 123-4567');
    }

    /**
     * Get formatted email
     */
    public static function getEmail()
    {
        return self::get('contact_email', 'info@ktechvalves.com');
    }

    /**
     * Get formatted address
     */
    public static function getAddress()
    {
        return self::get('contact_address', '123 Industrial Ave, Manufacturing City, MC 12345');
    }

    /**
     * Get province/state
     */
    public static function getProvince()
    {
        return self::get('contact_province', 'Ontario');
    }

    /**
     * Get full address with province
     */
    public static function getFullAddress()
    {
        $address = self::getAddress();
        $province = self::getProvince();
        
        if ($province) {
            return $address . ', ' . $province;
        }
        
        return $address;
    }

    /**
     * Get company logo URL
     */
    public static function getLogo()
    {
        $logoPath = self::get('company_logo', '');
        if ($logoPath) {
            return asset('storage/' . $logoPath);
        }
        return null;
    }    /**
     * Check if company logo exists
     */
    public static function hasLogo()
    {
        $logoPath = self::get('company_logo', '');
        return !empty($logoPath) && $logoPath !== '';
    }
}

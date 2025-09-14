<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GalleryPageController extends Controller
{
    public function index()
    {
        $sections = [
            'hero' => $this->getHeroData(),
            'settings' => $this->getSettingsData(),
            'categories' => $this->getCategoriesData(),
        ];

        $stats = [
            'total_images' => Gallery::active()->count(),
            'categories_count' => Gallery::select('category')->distinct()->whereNotNull('category')->count(),
            'featured_count' => Gallery::active()->where('is_featured', true)->count(),
        ];

        $categories = Gallery::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->filter();

        return view('admin.gallery-page.index', compact('sections', 'stats', 'categories'));
    }

    public function updateSection(Request $request, $section)
    {
        $validSections = ['hero', 'settings', 'categories'];
        
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
            'title' => SiteSetting::get('gallery_hero_title', 'Our Gallery'),
            'subtitle' => SiteSetting::get('gallery_hero_subtitle', 'Explore our state-of-the-art manufacturing facilities and product showcase.'),
            'background_image' => SiteSetting::get('gallery_hero_background', ''),
        ];
    }

    private function getSettingsData()
    {
        return [
            'images_per_page' => SiteSetting::get('gallery_images_per_page', 12),
            'show_categories' => SiteSetting::get('gallery_show_categories', true),
            'enable_lightbox' => SiteSetting::get('gallery_enable_lightbox', true),
            'show_image_info' => SiteSetting::get('gallery_show_image_info', true),
        ];
    }

    private function getCategoriesData()
    {
        return [
            'intro_title' => SiteSetting::get('gallery_categories_title', 'Browse by Category'),
            'intro_content' => SiteSetting::get('gallery_categories_content', 'Our gallery is organized into categories to help you find exactly what you\'re looking for.'),
        ];
    }

    private function updateHeroSection(Request $request)
    {
        $request->validate([
            'gallery_hero_title' => 'required|string|max:255',
            'gallery_hero_subtitle' => 'required|string',
            'gallery_hero_background' => 'nullable|string',
        ]);

        SiteSetting::updateOrCreate(['key' => 'gallery_hero_title'], [
            'value' => $request->gallery_hero_title,
            'type' => 'text',
            'group' => 'gallery',
        ]);

        SiteSetting::updateOrCreate(['key' => 'gallery_hero_subtitle'], [
            'value' => $request->gallery_hero_subtitle,
            'type' => 'textarea',
            'group' => 'gallery',
        ]);

        SiteSetting::updateOrCreate(['key' => 'gallery_hero_background'], [
            'value' => $request->gallery_hero_background,
            'type' => 'text',
            'group' => 'gallery',
        ]);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Gallery hero section updated successfully!');
    }

    private function updateSettingsSection(Request $request)
    {
        $request->validate([
            'gallery_images_per_page' => 'required|integer|min:6|max:50',
            'gallery_show_categories' => 'boolean',
            'gallery_enable_lightbox' => 'boolean',
            'gallery_show_image_info' => 'boolean',
        ]);

        SiteSetting::updateOrCreate(['key' => 'gallery_images_per_page'], [
            'value' => $request->gallery_images_per_page,
            'type' => 'number',
            'group' => 'gallery',
        ]);

        SiteSetting::updateOrCreate(['key' => 'gallery_show_categories'], [
            'value' => $request->has('gallery_show_categories') ? '1' : '0',
            'type' => 'boolean',
            'group' => 'gallery',
        ]);

        SiteSetting::updateOrCreate(['key' => 'gallery_enable_lightbox'], [
            'value' => $request->has('gallery_enable_lightbox') ? '1' : '0',
            'type' => 'boolean',
            'group' => 'gallery',
        ]);

        SiteSetting::updateOrCreate(['key' => 'gallery_show_image_info'], [
            'value' => $request->has('gallery_show_image_info') ? '1' : '0',
            'type' => 'boolean',
            'group' => 'gallery',
        ]);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Gallery settings updated successfully!');
    }
}

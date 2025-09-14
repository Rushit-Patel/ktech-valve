<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductDetailPageController extends Controller
{
    public function index()
    {
        $sections = [
            'layout' => $this->getLayoutData(),
            'features' => $this->getFeaturesData(),
            'specifications' => $this->getSpecificationsData(),
            'inquiry' => $this->getInquiryData(),
        ];        $stats = [
            'total_products' => Product::active()->count(),
            'products_with_images' => Product::active()->whereNotNull('gallery_images')->where('gallery_images', '!=', '[]')->count(),
            'products_with_specs' => Product::active()->whereNotNull('technical_specifications')->where('technical_specifications', '!=', '[]')->count(),
        ];

        return view('admin.product-detail-page.index', compact('sections', 'stats'));
    }

    public function updateSection(Request $request, $section)
    {
        $validSections = ['layout', 'features', 'specifications', 'inquiry'];
        
        if (!in_array($section, $validSections)) {
            return redirect()->back()->with('error', 'Invalid section');
        }

        $method = 'update' . ucfirst($section) . 'Section';
        
        if (method_exists($this, $method)) {
            return $this->$method($request);
        }

        return redirect()->back()->with('error', 'Section handler not found');
    }

    private function getLayoutData()
    {
        return [
            'show_breadcrumbs' => SiteSetting::get('product_detail_show_breadcrumbs', true),
            'show_category_link' => SiteSetting::get('product_detail_show_category_link', true),
            'show_related_products' => SiteSetting::get('product_detail_show_related_products', true),
            'related_products_count' => SiteSetting::get('product_detail_related_count', 4),
            'enable_image_zoom' => SiteSetting::get('product_detail_enable_zoom', true),
            'show_social_share' => SiteSetting::get('product_detail_show_social_share', true),
        ];
    }

    private function getFeaturesData()
    {
        return [
            'features_title' => SiteSetting::get('product_detail_features_title', 'Key Features'),
            'features_description' => SiteSetting::get('product_detail_features_description', 'Discover the advanced features that make our valves industry-leading solutions.'),
            'show_features_icons' => SiteSetting::get('product_detail_show_features_icons', true),
            'features_layout' => SiteSetting::get('product_detail_features_layout', 'grid'), // grid or list
        ];
    }

    private function getSpecificationsData()
    {
        return [
            'specs_title' => SiteSetting::get('product_detail_specs_title', 'Technical Specifications'),
            'specs_description' => SiteSetting::get('product_detail_specs_description', 'Detailed technical specifications and dimensions.'),
            'show_specs_table' => SiteSetting::get('product_detail_show_specs_table', true),
            'show_datasheet_download' => SiteSetting::get('product_detail_show_datasheet_download', true),
            'datasheet_text' => SiteSetting::get('product_detail_datasheet_text', 'Download Technical Datasheet'),
        ];
    }

    private function getInquiryData()
    {
        return [
            'inquiry_title' => SiteSetting::get('product_detail_inquiry_title', 'Request Quote'),
            'inquiry_subtitle' => SiteSetting::get('product_detail_inquiry_subtitle', 'Get personalized pricing and technical support for this product'),
            'inquiry_button_text' => SiteSetting::get('product_detail_inquiry_button_text', 'Request Quote'),
            'show_inquiry_form' => SiteSetting::get('product_detail_show_inquiry_form', true),
            'inquiry_success_message' => SiteSetting::get('product_detail_inquiry_success_message', 'Thank you for your inquiry. We will contact you soon.'),
        ];
    }

    private function updateLayoutSection(Request $request)
    {
        $request->validate([
            'show_breadcrumbs' => 'boolean',
            'show_category_link' => 'boolean',
            'show_related_products' => 'boolean',
            'related_products_count' => 'required|integer|min:1|max:12',
            'enable_image_zoom' => 'boolean',
            'show_social_share' => 'boolean',
        ]);

        SiteSetting::set('product_detail_show_breadcrumbs', $request->has('show_breadcrumbs'));
        SiteSetting::set('product_detail_show_category_link', $request->has('show_category_link'));
        SiteSetting::set('product_detail_show_related_products', $request->has('show_related_products'));
        SiteSetting::set('product_detail_related_count', $request->related_products_count);
        SiteSetting::set('product_detail_enable_zoom', $request->has('enable_image_zoom'));
        SiteSetting::set('product_detail_show_social_share', $request->has('show_social_share'));

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Layout settings updated successfully');
    }

    private function updateFeaturesSection(Request $request)
    {
        $request->validate([
            'features_title' => 'required|string|max:255',
            'features_description' => 'required|string',
            'show_features_icons' => 'boolean',
            'features_layout' => 'required|in:grid,list',
        ]);

        SiteSetting::set('product_detail_features_title', $request->features_title);
        SiteSetting::set('product_detail_features_description', $request->features_description);
        SiteSetting::set('product_detail_show_features_icons', $request->has('show_features_icons'));
        SiteSetting::set('product_detail_features_layout', $request->features_layout);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Features section updated successfully');
    }

    private function updateSpecificationsSection(Request $request)
    {
        $request->validate([
            'specs_title' => 'required|string|max:255',
            'specs_description' => 'required|string',
            'show_specs_table' => 'boolean',
            'show_datasheet_download' => 'boolean',
            'datasheet_text' => 'required|string|max:255',
        ]);

        SiteSetting::set('product_detail_specs_title', $request->specs_title);
        SiteSetting::set('product_detail_specs_description', $request->specs_description);
        SiteSetting::set('product_detail_show_specs_table', $request->has('show_specs_table'));
        SiteSetting::set('product_detail_show_datasheet_download', $request->has('show_datasheet_download'));
        SiteSetting::set('product_detail_datasheet_text', $request->datasheet_text);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Specifications section updated successfully');
    }

    private function updateInquirySection(Request $request)
    {
        $request->validate([
            'inquiry_title' => 'required|string|max:255',
            'inquiry_subtitle' => 'required|string',
            'inquiry_button_text' => 'required|string|max:100',
            'show_inquiry_form' => 'boolean',
            'inquiry_success_message' => 'required|string',
        ]);

        SiteSetting::set('product_detail_inquiry_title', $request->inquiry_title);
        SiteSetting::set('product_detail_inquiry_subtitle', $request->inquiry_subtitle);
        SiteSetting::set('product_detail_inquiry_button_text', $request->inquiry_button_text);
        SiteSetting::set('product_detail_show_inquiry_form', $request->has('show_inquiry_form'));
        SiteSetting::set('product_detail_inquiry_success_message', $request->inquiry_success_message);

        Cache::forget('site_settings');
        
        return redirect()->back()->with('success', 'Inquiry section updated successfully');
    }
}

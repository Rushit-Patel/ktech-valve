<?php

namespace App\Http\Controllers\Admin;

use App\Models\SeoSetting;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Page;
use App\Models\Industry;
use Illuminate\Http\Request;

class SeoController extends BaseController
{
    public function index(Request $request)
    {
        $query = SeoSetting::query();

        if ($request->filled('page_type')) {
            $query->where('page_type', $request->page_type);
        }

        $seoSettings = $query->latest()->paginate(15);

        $pageTypes = [
            'homepage' => 'Homepage',
            'product' => 'Product Pages',
            'product_category' => 'Category Pages',
            'page' => 'Static Pages',
            'industry' => 'Industry Pages',
            'contact' => 'Contact Page',
            'about' => 'About Page',
            'gallery' => 'Gallery Page'
        ];

        return view('admin.seo.index', compact('seoSettings', 'pageTypes'));
    }

    public function create(Request $request)
    {
        $pageType = $request->get('page_type');
        $pageIdentifier = $request->get('page_identifier');

        $pageTypes = [
            'homepage' => 'Homepage',
            'product' => 'Product Pages',
            'product_category' => 'Category Pages',
            'page' => 'Static Pages',
            'industry' => 'Industry Pages',
            'contact' => 'Contact Page',
            'about' => 'About Page',
            'gallery' => 'Gallery Page'
        ];

        // Get available items based on page type
        $availableItems = $this->getAvailableItems($pageType);

        return view('admin.seo.create', compact('pageTypes', 'availableItems', 'pageType', 'pageIdentifier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_type' => 'required|string|max:100',
            'page_identifier' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'canonical_url' => 'nullable|url',
            'robots_meta' => 'nullable|string|max:100',
            'schema_markup' => 'nullable|json'
        ]);

        $data = $request->all();

        // Check for existing SEO setting
        $existing = SeoSetting::where('page_type', $data['page_type'])
            ->where('page_identifier', $data['page_identifier'])
            ->first();

        if ($existing) {
            return $this->errorResponse(
                'SEO settings already exist for this page. Please edit the existing settings instead.'
            );
        }

        // Handle OG image upload
        if ($request->hasFile('og_image')) {
            $data['og_image'] = $request->file('og_image')->store('seo', 'public');
        }

        // Parse schema markup if provided
        if ($request->filled('schema_markup')) {
            $schemaMarkup = json_decode($request->schema_markup, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->errorResponse('Invalid JSON format for schema markup.');
            }
            $data['schema_markup'] = $schemaMarkup;
        }

        SeoSetting::create($data);

        return $this->successResponse(
            'SEO settings created successfully!',
            'admin.seo.index'
        );
    }

    public function edit(SeoSetting $seoSetting)
    {
        $pageTypes = [
            'homepage' => 'Homepage',
            'product' => 'Product Pages',
            'product_category' => 'Category Pages',
            'page' => 'Static Pages',
            'industry' => 'Industry Pages',
            'contact' => 'Contact Page',
            'about' => 'About Page',
            'gallery' => 'Gallery Page'
        ];

        $availableItems = $this->getAvailableItems($seoSetting->page_type);

        return view('admin.seo.edit', compact('seoSetting', 'pageTypes', 'availableItems'));
    }

    public function update(Request $request, SeoSetting $seoSetting)
    {
        $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:500',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'canonical_url' => 'nullable|url',
            'robots_meta' => 'nullable|string|max:100',
            'schema_markup' => 'nullable|json'
        ]);

        $data = $request->except('og_image');

        // Handle OG image upload
        if ($request->hasFile('og_image')) {
            if ($seoSetting->og_image) {
                Storage::disk('public')->delete($seoSetting->og_image);
            }
            $data['og_image'] = $request->file('og_image')->store('seo', 'public');
        }

        // Parse schema markup if provided
        if ($request->filled('schema_markup')) {
            $schemaMarkup = json_decode($request->schema_markup, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->errorResponse('Invalid JSON format for schema markup.');
            }
            $data['schema_markup'] = $schemaMarkup;
        }

        $seoSetting->update($data);

        return $this->successResponse(
            'SEO settings updated successfully!',
            'admin.seo.index'
        );
    }

    public function destroy(SeoSetting $seoSetting)
    {
        if ($seoSetting->og_image) {
            Storage::disk('public')->delete($seoSetting->og_image);
        }

        $seoSetting->delete();

        return $this->successResponse('SEO settings deleted successfully!');
    }

    private function getAvailableItems($pageType)
    {
        switch ($pageType) {
            case 'product':
                return Product::active()->orderBy('name')->get(['id', 'name', 'slug']);
            case 'product_category':
                return ProductCategory::active()->orderBy('name')->get(['id', 'name', 'slug']);
            case 'page':
                return Page::active()->orderBy('title')->get(['id', 'title', 'slug']);
            case 'industry':
                return Industry::active()->orderBy('name')->get(['id', 'name', 'slug']);
            default:
                return collect();
        }
    }

    public function getItemsByPageType(Request $request)
    {
        $pageType = $request->get('page_type');
        $items = $this->getAvailableItems($pageType);

        return response()->json($items);
    }
}
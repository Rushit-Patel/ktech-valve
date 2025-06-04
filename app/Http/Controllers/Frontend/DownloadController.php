<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Download;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends BaseController
{
    /**
     * Display downloads page
     */
    public function index(Request $request)
    {
        // Set SEO data for downloads page
        $this->setSeoData('downloads', null, [
            'title' => 'Downloads - Product Catalogs & Technical Documentation | K Tech Valves',
            'description' => 'Download product catalogs, technical specifications, certificates, and documentation for K Tech Valves industrial valve products.',
            'keywords' => 'valve catalogs, technical documentation, product specifications, certificates download'
        ]);

        $query = Download::active()->public();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by product
        if ($request->filled('product')) {
            $query->where('product_id', $request->product);
        }

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        $downloads = $query->latest()->paginate(20)->withQueryString();

        // Get categories for filter
        $categories = Download::active()
            ->public()
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category')
            ->filter()
            ->sort()
            ->values();

        // Get products for filter
        $products = Product::active()
            ->whereHas('downloads')
            ->orderBy('name')
            ->get(['id', 'name']);

        // Get featured downloads
        $featuredDownloads = Download::active()
            ->public()
            ->where('category', 'catalog')
            ->orderBy('download_count', 'desc')
            ->take(6)
            ->get();

        return view('frontend.downloads.index', compact(
            'downloads',
            'categories',
            'products',
            'featuredDownloads'
        ));
    }

    /**
     * Handle file download
     */
    public function download(Download $download)
    {
        // Check if download is active and public
        if (!$download->is_active || !$download->is_public) {
            abort(404);
        }

        // Check if file exists
        if (!Storage::disk('public')->exists($download->file_path)) {
            abort(404, 'File not found');
        }

        // Increment download count
        $download->incrementDownloadCount();

        // Get file path
        $filePath = Storage::disk('public')->path($download->file_path);

        // Return file download response
        return response()->download($filePath, $download->file_name);
    }

    /**
     * Get downloads by category (AJAX)
     */
    public function getByCategory(Request $request)
    {
        $category = $request->get('category');
        
        $query = Download::active()->public();
        
        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        $downloads = $query->latest()->take(20)->get();

        return response()->json([
            'success' => true,
            'downloads' => $downloads->map(function($download) {
                return [
                    'id' => $download->id,
                    'title' => $download->title,
                    'description' => $download->description,
                    'file_type' => $download->file_type,
                    'file_size' => $download->formatted_file_size,
                    'download_count' => $download->download_count,
                    'file_icon' => $download->file_icon,
                    'download_url' => route('downloads.download', $download->id)
                ];
            })
        ]);
    }
}
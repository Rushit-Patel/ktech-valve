<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Inquiry;
use App\Models\BlogPost;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::active()->count(),
            'featured_products' => Product::featured()->count(),
            'total_categories' => ProductCategory::count(),
            'total_inquiries' => Inquiry::count(),
            'new_inquiries' => Inquiry::new()->count(),
            'recent_inquiries' => Inquiry::recent()->count(),
            'total_blog_posts' => BlogPost::count(),
            'published_posts' => BlogPost::published()->count(),
            'total_users' => User::count(),
            'active_users' => User::active()->count(),
        ];

        // Recent activities
        $recentInquiries = Inquiry::with('product')
            ->latest()
            ->take(5)
            ->get();

        $recentProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        // Monthly inquiry stats
        $monthlyInquiries = Inquiry::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        // Fill missing months with 0
        $inquiryChartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $inquiryChartData[] = $monthlyInquiries[$i] ?? 0;
        }

        // Popular products by inquiries
        $popularProducts = Product::withCount('inquiries')
            ->orderBy('inquiries_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentInquiries',
            'recentProducts',
            'inquiryChartData',
            'popularProducts'
        ));
    }
}
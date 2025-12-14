<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Inquiry;
use App\Models\User;
use App\Models\Banner;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected array $middleware = [
        'auth',
        'admin',
    ];

    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::active()->count(),
            'total_categories' => Category::count(),
            'total_inquiries' => Inquiry::count(),
            'new_inquiries' => Inquiry::where('status', 'new')->count(),
            'total_users' => User::count(),
            'active_banners' => Banner::active()->count(),
        ];

        $recent_inquiries = Inquiry::with('product')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $featured_products = Product::featured()
            ->active()
            ->with('category')
            ->limit(6)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_inquiries', 'featured_products'));
    }
}

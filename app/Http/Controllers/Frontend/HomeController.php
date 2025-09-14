<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\Industry;
use App\Models\Certification;
use App\Models\Client;
use App\Models\Gallery;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class HomeController extends Controller
{    public function index()
    {
        $categories = Category::active()->orderBy('sort_order')->take(6)->get();
        $featuredProducts = Product::active()->take(8)->get();
        $banners = Banner::active()->orderBy('sort_order')->get();
        $industries = Industry::active()->orderBy('sort_order')->take(10)->get();
        $clients = Client::active()->take(8)->get();
        $galleries = Gallery::active()->take(6)->get();
        $certifications = Certification::active()->orderBy('sort_order')->take(8)->get();
        
        // Statistics
        $totalProducts = Product::active()->count();
        $totalCategories = Category::active()->count();
        $totalInquiries = Inquiry::count();
        $totalClients = Client::active()->count();
        
        // Create stats array for template
        $stats = [
            'total_products' => $totalProducts,
            'total_clients' => $totalClients,
            'total_industries' => Industry::active()->count(),
            'total_categories' => $totalCategories,
        ];
        
        return view('frontend.home', compact(
            'categories',
            'featuredProducts', 
            'banners',
            'industries',
            'clients',
            'galleries',
            'certifications',
            'stats',
            'totalProducts',
            'totalCategories',
            'totalInquiries',
            'totalClients'
        ));
    }

    public function submitInquiry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        Inquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'company' => $request->company,
            'phone' => $request->phone,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Thank you for your inquiry. We will get back to you soon!');
    }
}

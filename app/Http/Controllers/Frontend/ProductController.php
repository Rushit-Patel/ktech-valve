<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::active()->with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->ordered()->paginate(12);
        $categories = Category::active()->ordered()->get();

        return view('frontend.products.index', compact('products', 'categories'));
    }

    public function category(Category $category)
    {
        $products = Product::active()
            ->where('category_id', $category->id)
            ->with('category')
            ->ordered()
            ->paginate(12);

        $categories = Category::active()->ordered()->get();

        return view('frontend.products.category', compact('products', 'category', 'categories'));
    }    public function show(Product $product)
    {
        $product->load('category');
        
        $similar_products = $product->getSimilarProducts();
        
        // Ensure technical_specifications is properly cast to array
        $technical_specs = $product->technical_specifications;
        if (!is_array($technical_specs)) {
            $technical_specs = [];
        }
        
        // Ensure features is properly cast to array
        $features = $product->features;
        if (!is_array($features)) {
            $features = [];
        }
        
        // Ensure applications is properly cast to array
        $applications = $product->applications;
        if (!is_array($applications)) {
            $applications = [];
        }

        return view('frontend.products.show', compact(
            'product',
            'similar_products',
            'technical_specs',
            'features',
            'applications'
        ));
    }public function inquiry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'product_id' => 'nullable|exists:products,id',
            'request_cad' => 'nullable|boolean',
            'urgent_quote' => 'nullable|boolean',
            'newsletter' => 'nullable|boolean',
        ]);

        // Create inquiry with additional metadata
        $inquiryData = $request->only([
            'name', 'email', 'phone', 'company', 'subject', 'message', 'product_id'
        ]);
        
        // Add metadata for additional options
        $inquiryData['metadata'] = [
            'request_cad' => $request->boolean('request_cad'),
            'urgent_quote' => $request->boolean('urgent_quote'),
            'newsletter_signup' => $request->boolean('newsletter'),
            'source' => 'Product Detail Page',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ];
        
        $inquiryData['status'] = 'new';
        $inquiryData['priority'] = $request->boolean('urgent_quote') ? 'high' : 'medium';

        Inquiry::create($inquiryData);

        return back()->with('success', 'Thank you for your inquiry. We will get back to you soon!');
    }
}

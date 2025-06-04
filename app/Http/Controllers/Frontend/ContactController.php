<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Inquiry;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Mail\InquiryNotificationMail;

class ContactController extends BaseController
{
    /**
     * Display the contact page
     */
    public function index()
    {
        // Set SEO data for contact page
        $this->setSeoData('contact', null, [
            'title' => 'Contact Us - K Tech Valves | Get in Touch',
            'description' => 'Contact K Tech Valves for industrial valve solutions. Get expert advice, request quotes, and connect with our technical team.',
            'keywords' => 'contact K Tech Valves, valve inquiry, technical support, request quote'
        ]);

        // Get products for inquiry form dropdown
        $categories = ProductCategory::active()
            ->with(['activeProducts' => function($query) {
                $query->orderBy('name');
            }])
            ->orderBy('name')
            ->get();

        return view('frontend.contact.index', compact('categories'));
    }

    /**
     * Handle contact form submission
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'inquiry_type' => 'required|in:general,quote,technical,partnership',
            'g-recaptcha-response' => 'nullable' // Add if using reCAPTCHA
        ]);

        // Create inquiry record
        $inquiry = Inquiry::create([
            'inquiry_type' => $request->inquiry_type,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'new'
        ]);

        // Send email notifications
        try {
            // Send confirmation email to user
            Mail::to($request->email)->send(new ContactFormMail($inquiry));
            
            // Send notification to admin
            $adminEmail = config('mail.admin_email', 'admin@ktechvalves.com');
            Mail::to($adminEmail)->send(new InquiryNotificationMail($inquiry));
            
        } catch (\Exception $e) {
            // Log the error but don't fail the request
            \Log::error('Email sending failed: ' . $e->getMessage());
        }

        return $this->successResponse(
            'Thank you for your inquiry! We will get back to you within 24 hours.',
            'contact'
        );
    }

    /**
     * Handle product-specific inquiry
     */
    public function inquiry(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'quantity' => 'nullable|string|max:100',
            'application' => 'nullable|string|max:500',
            'message' => 'required|string|max:1000',
            'g-recaptcha-response' => 'nullable'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Create product inquiry
        $inquiry = Inquiry::create([
            'product_id' => $product->id,
            'inquiry_type' => 'product',
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'subject' => "Product Inquiry: {$product->name}",
            'message' => $request->message,
            'additional_data' => [
                'quantity' => $request->quantity,
                'application' => $request->application,
                'product_name' => $product->name,
                'product_category' => $product->category->name
            ],
            'status' => 'new'
        ]);

        // Send email notifications
        try {
            // Send confirmation email to user
            Mail::to($request->email)->send(new ContactFormMail($inquiry));
            
            // Send notification to admin
            $adminEmail = config('mail.admin_email', 'admin@ktechvalves.com');
            Mail::to($adminEmail)->send(new InquiryNotificationMail($inquiry));
            
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your product inquiry! We will send you a detailed quote within 24 hours.'
            ]);
        }

        return $this->successResponse(
            'Thank you for your product inquiry! We will send you a detailed quote within 24 hours.'
        );
    }

    /**
     * Handle quote request
     */
    public function requestQuote(Request $request)
    {
        $request->validate([
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|string|max:100',
            'products.*.specifications' => 'nullable|string|max:500',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'required|string|max:255',
            'delivery_location' => 'required|string|max:255',
            'timeline' => 'nullable|string|max:255',
            'additional_requirements' => 'nullable|string|max:1000'
        ]);

        // Create quote inquiry
        $inquiry = Inquiry::create([
            'inquiry_type' => 'quote',
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'subject' => 'Quote Request - Multiple Products',
            'message' => $request->additional_requirements ?: 'Quote request for multiple products',
            'additional_data' => [
                'products' => $request->products,
                'delivery_location' => $request->delivery_location,
                'timeline' => $request->timeline,
                'quote_type' => 'bulk'
            ],
            'status' => 'new'
        ]);

        // Send notifications
        try {
            Mail::to($request->email)->send(new ContactFormMail($inquiry));
            $adminEmail = config('mail.admin_email', 'admin@ktechvalves.com');
            Mail::to($adminEmail)->send(new InquiryNotificationMail($inquiry));
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
        }

        return $this->successResponse(
            'Your quote request has been submitted successfully! Our sales team will contact you within 24 hours with a detailed quotation.'
        );
    }

    /**
     * Get contact information (AJAX)
     */
    public function getContactInfo()
    {
        $contactSettings = \App\Models\WebsiteSetting::getByGroup('contact');
        
        return response()->json([
            'success' => true,
            'contact_info' => [
                'email' => $contactSettings['contact_email'] ?? '',
                'phone' => $contactSettings['contact_phone'] ?? '',
                'address' => $contactSettings['contact_address'] ?? '',
                'working_hours' => $contactSettings['working_hours'] ?? 'Mon-Fri: 9:00 AM - 6:00 PM'
            ]
        ]);
    }
}
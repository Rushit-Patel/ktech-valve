<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\SeoService;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    protected $websiteSettings;

    public function __construct()
    {
        // Share common data with all frontend views
        $this->middleware(function ($request, $next) {
            $this->websiteSettings = WebsiteSetting::getByGroup('general');
            
            // Share website settings with all views
            View::share('websiteSettings', $this->websiteSettings);
            
            // Share contact settings
            $contactSettings = WebsiteSetting::getByGroup('contact');
            View::share('contactSettings', $contactSettings);
            
            // Share social media settings
            $socialSettings = WebsiteSetting::getByGroup('social');
            View::share('socialSettings', $socialSettings);

            return $next($request);
        });
    }

    /**
     * Set SEO data for the current page
     */
    protected function setSeoData($pageType, $identifier = null, $fallbackData = [])
    {
        return SeoService::setSeoData($pageType, $identifier, $fallbackData);
    }

    /**
     * Handle successful form submissions
     */
    protected function successResponse($message, $redirectRoute = null)
    {
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        }

        $redirect = $redirectRoute ? redirect()->route($redirectRoute) : back();
        return $redirect->with('success', $message);
    }

    /**
     * Handle form errors
     */
    protected function errorResponse($message, $errors = [])
    {
        if (request()->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'errors' => $errors
            ], 422);
        }

        return back()->withErrors($errors)->with('error', $message)->withInput();
    }
}
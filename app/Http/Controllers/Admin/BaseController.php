<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth']);
        // $this->middleware(function ($request, $next) {
        //     if (!auth()->user()->isAdmin()) {
        //         abort(403, 'Access denied. Admin privileges required.');
        //     }
        //     return $next($request);
        // });
    }

    /**
     * Handle successful operations
     */
    protected function successResponse($message, $redirectRoute = null, $data = [])
    {
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data
            ]);
        }

        $redirect = $redirectRoute ? redirect()->route($redirectRoute) : back();
        return $redirect->with('success', $message);
    }

    /**
     * Handle error operations
     */
    protected function errorResponse($message, $redirectRoute = null, $errors = [])
    {
        if (request()->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'errors' => $errors
            ], 422);
        }

        $redirect = $redirectRoute ? redirect()->route($redirectRoute) : back();
        return $redirect->withErrors($errors)->with('error', $message);
    }
}
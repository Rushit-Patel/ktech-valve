@extends('frontend.layouts.app')

@section('title', '404 - Page Not Found - K-Tech Valves')
@section('description', 'The page you are looking for could not be found. Explore our products and services at K-Tech Valves.')

@section('content')
<div class="min-h-screen bg-white flex">
    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
        <div class="mx-auto w-full max-w-sm lg:w-96">
            <div class="text-center">
                <h1 class="text-9xl font-bold text-blue-600">404</h1>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Page not found</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Sorry, we couldn't find the page you're looking for.
                </p>
                <div class="mt-6">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Go back home
                    </a>
                </div>
            </div>

            <div class="mt-10">
                <h3 class="text-sm font-medium text-gray-900">Popular pages</h3>
                <ul role="list" class="mt-4 border-t border-b border-gray-200 divide-y divide-gray-200">
                    <li class="relative py-6 flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <span class="flex items-center justify-center h-10 w-10 rounded-lg bg-blue-50">
                                <svg class="h-6 w-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="text-base font-medium text-gray-900">
                                <a href="{{ route('products.index') }}">
                                    <span class="absolute inset-0"></span>
                                    Our Products
                                </a>
                            </div>
                            <p class="text-base text-gray-500">Browse our complete valve catalog</p>
                        </div>
                        <div class="flex-shrink-0 self-center">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </li>
                    <li class="relative py-6 flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <span class="flex items-center justify-center h-10 w-10 rounded-lg bg-blue-50">
                                <svg class="h-6 w-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 00-2 2H6a2 2 0 00-2-2V6m8 0H8m8 0l-1 12H9L8 6m8 0H8"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="text-base font-medium text-gray-900">
                                <a href="{{ route('about') }}">
                                    <span class="absolute inset-0"></span>
                                    About Us
                                </a>
                            </div>
                            <p class="text-base text-gray-500">Learn about our company and values</p>
                        </div>
                        <div class="flex-shrink-0 self-center">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </li>
                    <li class="relative py-6 flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <span class="flex items-center justify-center h-10 w-10 rounded-lg bg-blue-50">
                                <svg class="h-6 w-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="text-base font-medium text-gray-900">
                                <a href="{{ route('contact') }}">
                                    <span class="absolute inset-0"></span>
                                    Contact Us
                                </a>
                            </div>
                            <p class="text-base text-gray-500">Get in touch with our team</p>
                        </div>
                        <div class="flex-shrink-0 self-center">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </li>
                </ul>
                <div class="mt-8">
                    <a href="{{ route('contact') }}" class="text-base font-medium text-blue-600 hover:text-blue-500">
                        Need help? Contact support
                        <span aria-hidden="true"> &rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="hidden lg:block relative w-0 flex-1">
        <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1518709268805-4e9042af2176?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80" alt="Industrial valves">
    </div>
</div>
@endsection

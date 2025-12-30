<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', $siteSettings['seo']['seo_default_title'] ?? 'K-Tech Valves - Industrial Valve Solutions')</title>
    <meta name="description" content="@yield('description', $siteSettings['seo']['seo_default_description'] ?? 'Leading manufacturer of high-quality industrial valves for diverse applications. From ball valves to gate valves, we provide reliable solutions for your industrial needs.')">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @yield('styles')
</head>

<body class="bg-gray-50">
    <div class="bg-gray-900 text-white py-2 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-6">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        {{ $siteSettings['contact']['contact_phone'] ?? '+1 (555) 123-4567' }}
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        {{ $siteSettings['contact']['contact_email'] ?? 'info@ktechvalves.com' }}
                    </span>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <span class="text-gray-300">Follow us:</span>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.347-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50" x-data="{
        isOpen: false,
        productsOpen: false,
        companypOpen: false,
        searchOpen: false,
        searchQuery: ''
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20"> <!-- Logo Section -->
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center group">
                            @if (\App\Helpers\SiteHelper::hasLogo())
                                <!-- Custom Logo -->
                                <img src="{{ \App\Helpers\SiteHelper::getLogo() }}"
                                    alt="{{ \App\Helpers\SiteHelper::getCompanyName() }}"
                                    class="h-12 w-auto max-w-48 group-hover:opacity-80 transition-opacity duration-300">
                            @else
                                <!-- Default Logo Icon -->
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg flex items-center justify-center mr-3 group-hover:shadow-lg transition-all duration-300">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5L8 4z">
                                        </path>
                                    </svg>
                                </div>
                                <!-- Logo Text -->
                                <div>
                                    <div
                                        class="text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">
                                        {{ \App\Helpers\SiteHelper::getCompanyName() }}</div>
                                    <div class="text-sm text-blue-600 font-medium -mt-1">
                                        {{ \App\Helpers\SiteHelper::get('company_tagline', 'VALVES') }}</div>
                                </div>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-8">
                    <!-- Home -->
                    <a href="{{ route('home') }}"
                        class="@if (request()->routeIs('home')) text-blue-600 border-b-2 border-blue-600 @else text-gray-700 hover:text-blue-600 @endif px-3 py-2 text-sm font-medium transition-all duration-300 border-b-2 border-transparent hover:border-blue-600">
                        Home
                    </a>

                    <!-- About -->
                    <a href="{{ route('about') }}"
                        class="@if (request()->routeIs('about')) text-blue-600 border-b-2 border-blue-600 @else text-gray-700 hover:text-blue-600 @endif px-3 py-2 text-sm font-medium transition-all duration-300 border-b-2 border-transparent hover:border-blue-600">
                        About
                    </a>

                    <!-- Products Dropdown -->
                    <div class="relative" @mouseenter="productsOpen = true" @mouseleave="productsOpen = false">
                        <button
                            class="@if (request()->routeIs('products.*')) text-blue-600 border-b-2 border-blue-600 @else text-gray-700 hover:text-blue-600 @endif px-3 py-2 text-sm font-medium transition-all duration-300 border-b-2 border-transparent hover:border-blue-600 flex items-center">
                            Products
                            <svg class="ml-1 w-4 h-4 transition-transform duration-200"
                                :class="{ 'rotate-180': productsOpen }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Products Mega Menu -->
                        <div x-show="productsOpen" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute left-0 top-full mt-2 w-96 bg-white rounded-lg shadow-xl border border-gray-200 py-6 px-6 z-50">

                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <h3 class="text-sm font-semibold text-gray-900 mb-3">Valve Types</h3>
                                    <ul class="space-y-2">
                                        <li><a href="{{ route('products.category', 'butterfly-valves') }}"
                                                class="text-sm text-gray-600 hover:text-blue-600 transition-colors flex items-center">
                                                <span class="w-2 h-2 bg-blue-600 rounded-full mr-3"></span>Butterfly
                                                Valves
                                            </a></li>
                                        <li><a href="{{ route('products.category', 'ball-valves') }}"
                                                class="text-sm text-gray-600 hover:text-blue-600 transition-colors flex items-center">
                                                <span class="w-2 h-2 bg-blue-600 rounded-full mr-3"></span>Ball Valves
                                            </a></li>
                                        <li><a href="{{ route('products.category', 'check-valves') }}"
                                                class="text-sm text-gray-600 hover:text-blue-600 transition-colors flex items-center">
                                                <span class="w-2 h-2 bg-blue-600 rounded-full mr-3"></span>Check Valves
                                            </a></li>
                                        <li><a href="{{ route('products.category', 'gate-valves') }}"
                                                class="text-sm text-gray-600 hover:text-blue-600 transition-colors flex items-center">
                                                <span class="w-2 h-2 bg-blue-600 rounded-full mr-3"></span>Gate Valves
                                            </a></li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-gray-900 mb-3">Categories</h3>
                                    <ul class="space-y-2">
                                        <li><a href="{{ route('products.category', 'globe-valves') }}"
                                                class="text-sm text-gray-600 hover:text-blue-600 transition-colors flex items-center">
                                                <span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>Globe
                                                Valves
                                            </a></li>
                                        <li><a href="{{ route('products.category', 'automation-valves') }}"
                                                class="text-sm text-gray-600 hover:text-blue-600 transition-colors flex items-center">
                                                <span class="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>Automation
                                                Valves
                                            </a></li>
                                        <li><a href="{{ route('products.index') }}"
                                                class="text-sm text-blue-600 hover:text-blue-800 font-medium transition-colors flex items-center mt-4">
                                                <span class="w-4 h-4 mr-2">
                                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </span>View All Products
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Industries -->
                    <a href="{{ route('industries') }}"
                        class="@if (request()->routeIs('industries')) text-blue-600 border-b-2 border-blue-600 @else text-gray-700 hover:text-blue-600 @endif px-3 py-2 text-sm font-medium transition-all duration-300 border-b-2 border-transparent hover:border-blue-600">
                        Industries
                    </a>

                    <!-- Company Dropdown -->
                    <div class="relative" @mouseenter="companypOpen = true" @mouseleave="companypOpen = false">
                        <button
                            class="@if (request()->routeIs(['gallery', 'certifications', 'quality.*'])) text-blue-600 border-b-2 border-blue-600 @else text-gray-700 hover:text-blue-600 @endif px-3 py-2 text-sm font-medium transition-all duration-300 border-b-2 border-transparent hover:border-blue-600 flex items-center">
                            Company
                            <svg class="ml-1 w-4 h-4 transition-transform duration-200"
                                :class="{ 'rotate-180': companypOpen }" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Company Dropdown -->
                        <div x-show="companypOpen" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute left-0 top-full mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-200 py-4 z-50">

                            <a href="{{ route('gallery') }}"
                                class="block px-6 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Gallery
                                </div>
                            </a>
                            <a href="{{ route('certifications') }}"
                                class="block px-6 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                        </path>
                                    </svg>
                                    Certifications
                                </div>
                            </a>
                            <hr class="my-2">
                            <a href="#"
                                class="block px-6 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                    Quality Assurance
                                </div>
                            </a>
                            <a href="#"
                                class="block px-6 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                    Manufacturing
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Contact -->
                    <a href="{{ route('contact') }}"
                        class="@if (request()->routeIs('contact')) text-blue-600 border-b-2 border-blue-600 @else text-gray-700 hover:text-blue-600 @endif px-3 py-2 text-sm font-medium transition-all duration-300 border-b-2 border-transparent hover:border-blue-600">
                        Contact
                    </a>
                </div>

                <!-- Right Side Actions -->
                <div class="flex items-center space-x-4">
                    <!-- Search Button -->
                    <button @click="searchOpen = !searchOpen"
                        class="p-2 text-gray-400 hover:text-gray-500 hover:bg-gray-100 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>

                    <!-- CTA Button -->
                    <a href="{{ route('contact') }}"
                        class="hidden md:inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white text-sm font-medium rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                        Get Quote
                    </a>

                    <!-- Admin Login (Hidden on small screens) -->
                    <!-- <a href="{{ route('admin.login') }}" class="hidden lg:inline-flex items-center px-3 py-2 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white text-sm font-medium rounded-lg transition-all duration-300">
                        Admin
                    </a> -->

                    <!-- Mobile Menu Button -->
                    <button @click="isOpen = !isOpen"
                        class="lg:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-400 hover:text-gray-500 hover:bg-gray-100 transition-all duration-200">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': isOpen, 'inline-flex': !isOpen }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !isOpen, 'inline-flex': isOpen }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div x-show="searchOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2"
            class="border-t border-gray-200 bg-gray-50 px-4 py-4">
            <div class="max-w-7xl mx-auto">
                <div class="relative">
                    <input x-model="searchQuery" type="text"
                        placeholder="Search products, industries, or content..."
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        @keydown.escape="searchOpen = false">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <button @click="searchOpen = false" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="isOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2"
            class="lg:hidden border-t border-gray-200 bg-white">
            <div class="px-4 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}"
                    class="@if (request()->routeIs('home')) bg-blue-50 border-blue-500 text-blue-700 @else border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 @endif block pl-3 pr-4 py-3 border-l-4 text-base font-medium transition-all">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Home
                    </div>
                </a>
                <a href="{{ route('about') }}"
                    class="@if (request()->routeIs('about')) bg-blue-50 border-blue-500 text-blue-700 @else border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 @endif block pl-3 pr-4 py-3 border-l-4 text-base font-medium transition-all">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        About
                    </div>
                </a>
                <a href="{{ route('products.index') }}"
                    class="@if (request()->routeIs('products.*')) bg-blue-50 border-blue-500 text-blue-700 @else border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 @endif block pl-3 pr-4 py-3 border-l-4 text-base font-medium transition-all">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5L8 4z">
                            </path>
                        </svg>
                        Products
                    </div>
                </a>
                <a href="{{ route('industries') }}"
                    class="@if (request()->routeIs('industries')) bg-blue-50 border-blue-500 text-blue-700 @else border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 @endif block pl-3 pr-4 py-3 border-l-4 text-base font-medium transition-all">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        Industries
                    </div>
                </a>
                <a href="{{ route('gallery') }}"
                    class="@if (request()->routeIs('gallery')) bg-blue-50 border-blue-500 text-blue-700 @else border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 @endif block pl-3 pr-4 py-3 border-l-4 text-base font-medium transition-all">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Gallery
                    </div>
                </a>
                <a href="{{ route('certifications') }}"
                    class="@if (request()->routeIs('certifications')) bg-blue-50 border-blue-500 text-blue-700 @else border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 @endif block pl-3 pr-4 py-3 border-l-4 text-base font-medium transition-all">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                            </path>
                        </svg>
                        Certifications
                    </div>
                </a>
                <a href="{{ route('contact') }}"
                    class="@if (request()->routeIs('contact')) bg-blue-50 border-blue-500 text-blue-700 @else border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 @endif block pl-3 pr-4 py-3 border-l-4 text-base font-medium transition-all">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        Contact
                    </div>
                </a>

                <!-- Mobile CTA Buttons -->
                <div class="pt-4 pb-2 border-t border-gray-200 mt-4">
                    <a href="{{ route('contact') }}"
                        class="block w-full text-center px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors mb-3">
                        Get Quote
                    </a>
                    <a href="{{ route('admin.login') }}"
                        class="block w-full text-center px-4 py-3 border border-blue-600 text-blue-600 hover:bg-blue-50 font-medium rounded-lg transition-colors">
                        Admin Login
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8 xl:col-span-1">
                    <div class="text-2xl font-bold text-blue-600">
                        {{ $siteSettings['company']['company_name'] ?? 'K-Tech Valves' }}</div>
                    <p class="text-gray-500 text-base">
                        {{ $siteSettings['footer']['footer_about_text'] ?? 'Leading manufacturer of high-quality industrial valves for diverse applications worldwide.' }}
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">LinkedIn</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Products</h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="{{ route('products.index') }}"
                                        class="text-base text-gray-500 hover:text-gray-900">All Products</a></li>
                                <li><a href="{{ route('products.category', 'butterfly-valves') }}"
                                        class="text-base text-gray-500 hover:text-gray-900">Butterfly Valves</a></li>
                                <li><a href="{{ route('products.category', 'ball-valves') }}"
                                        class="text-base text-gray-500 hover:text-gray-900">Ball Valves</a></li>
                                <li><a href="{{ route('products.category', 'gate-valves') }}"
                                        class="text-base text-gray-500 hover:text-gray-900">Gate Valves</a></li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Company</h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="{{ route('about') }}"
                                        class="text-base text-gray-500 hover:text-gray-900">About Us</a></li>
                                <li><a href="{{ route('industries') }}"
                                        class="text-base text-gray-500 hover:text-gray-900">Industries</a></li>
                                <li><a href="{{ route('certifications') }}"
                                        class="text-base text-gray-500 hover:text-gray-900">Certifications</a></li>
                                <li><a href="{{ route('gallery') }}"
                                        class="text-base text-gray-500 hover:text-gray-900">Gallery</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Contact</h3>
                            <ul class="mt-4 space-y-4">
                                <li class="text-base text-gray-500">
                                    {{ $siteSettings['contact']['contact_phone'] ?? '+1 (555) 123-4567' }}</li>
                                <li class="text-base text-gray-500">
                                    {{ $siteSettings['contact']['contact_email'] ?? 'info@ktechvalves.com' }}</li>
                                <li class="text-base text-gray-500">
                                    {!! nl2br(\App\Helpers\SiteHelper::getFullAddress()) !!}
                                </li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Support</h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="#"
                                        class="text-base text-gray-500 hover:text-gray-900">Documentation</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Technical
                                        Support</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Warranty</a>
                                </li>
                                <li><a href="#"
                                        class="text-base text-gray-500 hover:text-gray-900">Downloads</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 border-t border-gray-200 pt-8">
                <p class="text-base text-gray-400 xl:text-center">
                    &copy; {{ date('Y') }}
                    {{ $siteSettings['footer']['footer_copyright'] ?? 'K-Tech Valves. All rights reserved.' }}
                </p>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>

</html>

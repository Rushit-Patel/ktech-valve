@extends('frontend.layouts.app')

@section('title', 'K-Tech Valves - Industrial Valve Solutions')
@section('description',
    'Leading manufacturer of high-quality industrial valves for diverse applications. From ball
    valves to gate valves, we provide reliable solutions for your industrial needs.')

@section('styles')
    <!-- Slick Slider CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <style>
        :root {
            --primary-dark: #2c3e50;
            --primary-blue: #0f4c75;
            --secondary-blue: #3282b8;
            --accent-blue: #bbe1fa;
            --primary-orange: #ff6b35;
            --secondary-orange: #f7931e;
            --gradient-primary: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-blue) 50%, var(--accent-blue) 100%);
            --gradient-orange: linear-gradient(135deg, var(--primary-orange) 0%, var(--secondary-orange) 100%);
            --shadow-soft: 0 10px 40px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 20px 60px rgba(0, 0, 0, 0.15);
            --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hero-slider-container {
            background: var(--gradient-primary);
        }


        /* CTA Buttons */
        .cta-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 3rem;
        }

        .cta-primary {
            background: var(--gradient-orange);
            color: white;
            padding: 1rem 2rem;
            border-radius: 9999px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition-smooth);
            box-shadow: 0 8px 24px rgba(255, 107, 53, 0.3);
        }

        .cta-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(255, 107, 53, 0.4);
        }

        .cta-secondary {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 1rem 2rem;
            border-radius: 9999px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition-smooth);
        }

        .cta-secondary:hover {
            background: rgba(255, 255, 255, 0.95);
            color: var(--primary-dark);
        }

        /* Stats Container */
        .stats-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 2rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 900;
            background: var(--gradient-orange);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
            opacity: 0.9;
        }

        .stat-divider {
            width: 3rem;
            height: 2px;
            background: linear-gradient(to right, var(--primary-orange), var(--secondary-orange));
            margin: 0.5rem auto;
        }

        .card-hover {
            transition: var(--transition-smooth);
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-medium);
        }

        .section-divider {
            background: linear-gradient(90deg, transparent, var(--secondary-blue), transparent);
            height: 2px;
        }

        .slick-dotted.slick-slider {
            margin-bottom: 0px;
        }

        .slick-dots {
            display: none !important;
        }

        .image-slider-item {
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <!-- Hero Slider Section -->
    <div class="hero-slider">
        <div class="hero-slider-container">
            <div class="">
                <div class="grid grid-cols-1 lg:grid-cols-1 gap-8 items-center">
                    <!-- Image Slider Column -->
                    <div class="image-slider-wrapper">
                        <div id="imageSlider">
                            @if ($banners->count() > 0)
                                @foreach ($banners as $banner)
                                    <div class="image-slider-item">
                                        @if ($banner->image)
                                            <img src="{{ asset('storage/' . $banner->image) }}"
                                                alt="{{ $banner->title ?? 'K-Tech Valves' }}" loading="lazy">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-700"></div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <!-- Default Images -->
                                <div class="image-slider-item">
                                    <img src="{{ asset('images/quality-image-3.webp') }}"
                                        alt="Flush Bottom Valve manufacturer in india" loading="lazy">
                                </div>
                                <div class="image-slider-item">
                                    <img src="{{ asset('images/quality-image.webp') }}"
                                        alt="Butterfly Valve manufacturer in india" loading="lazy">
                                </div>
                                <div class="image-slider-item">
                                    <img src="{{ asset('images/quality-image-1.webp') }}"
                                        alt="Forged Steel Gate Valve manufacturers" loading="lazy">
                                </div>
                                <div class="image-slider-item">
                                    <img src="{{ asset('images/quality-image-2.webp') }}"
                                        alt="top valve manufacturers in india" loading="lazy">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Categories Section -->
    <div class="bg-gray-50 py-16 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                    Our <span class="text-orange-500">Product Range</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Discover our comprehensive collection of industrial valves, engineered for excellence and built to last
                    in the most demanding environments.
                </p>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($categories->take(6) as $category)
                    <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden group">
                        <div
                            class="relative h-48 bg-gradient-to-br from-blue-500 to-blue-700 p-6 flex items-center justify-center">
                            @if ($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                    class="w-full h-full object-cover absolute inset-0 group-hover:scale-110 transition-transform duration-500">
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-30 group-hover:bg-opacity-20 transition-all duration-300">
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold">{{ $category->name }}</h3>
                            <p class="text-gray-600 mb-4 leading-relaxed">{{ Str::limit($category->description, 100) }}
                            </p>
                            <div class="flex items-center justify-between">
                                <a href="{{ route('products.category', $category) }}"
                                    class="inline-flex items-center text-orange-500 hover:text-orange-600 font-semibold group">
                                    Explore
                                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All Button -->
            <div class="text-center mt-12">
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center px-8 py-4 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                    View All Products
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Featured Products Section -->
    <div class="bg-gray-50 py-16 lg:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                    Featured <span class="text-orange-500">Products</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Discover our most popular and innovative valve solutions trusted by industry leaders worldwide.
                </p>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($featuredProducts->take(8) as $product)
                    <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden group">
                        <div class="relative h-48 bg-gray-100">
                            @if ($product->featured_image)
                                <img src="{{ asset('storage/' . $product->featured_image) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                        </path>
                                    </svg>
                                </div>
                            @endif

                            @if ($product->category)
                                <div class="absolute top-4 left-4">
                                    <span class="bg-orange-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="p-6">
                            <h3
                                class="text-lg font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors duration-300">
                                {{ $product->name }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                {{ Str::limit($product->short_description, 80) }}
                            </p>

                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-500">
                                    <span>SKU: {{ $product->sku ?: 'N/A' }}</span>
                                </div>
                                <a href="{{ route('products.show', $product) }}"
                                    class="inline-flex items-center text-orange-500 hover:text-orange-600 font-semibold text-sm group">
                                    View Details
                                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All Button -->
            <div class="text-center mt-12">
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center px-8 py-4 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                    View All Products
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="section-divider"></div>

    <!-- Industries We Serve Section -->
    <div class="bg-white py-16 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                    Industries <span class="text-orange-500">We Serve</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    From oil & gas to water treatment, we provide specialized valve solutions across diverse industrial
                    sectors.
                </p>
            </div>

            <!-- Industries Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach ($industries->take(10) as $industry)
                    <div
                        class="group text-center p-6 bg-gray-50 rounded-xl hover:bg-orange-50 transition-all duration-300 card-hover">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 group-hover:from-orange-400 group-hover:to-orange-600 rounded-full flex items-center justify-center mx-auto mb-4 transition-all duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 group-hover:text-orange-600 transition-colors duration-300">
                            {{ $industry->name }}
                        </h3>
                    </div>
                @endforeach
            </div>

            <!-- View All Industries Button -->
            <div class="text-center mt-12">
                <a href="{{ route('industries') }}"
                    class="inline-flex items-center px-6 py-3 border-2 border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white font-semibold rounded-full transition-all duration-300">
                    View All Industries
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="section-divider"></div>

    <!-- Client Success Stories Section -->
    <div style="background: var(--gradient-primary);" class="py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-black text-white mb-6">
                    Trusted by <span class="text-orange-400">Industry Leaders</span>
                </h2>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                    Join thousands of satisfied customers who trust K-Tech Valves for their industrial operations worldwide.
                </p>
            </div>

            <!-- Success Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-16">
                <div class="text-center">
                    <div class="text-4xl md:text-6xl font-black text-orange-400 mb-2">
                        {{ $stats['total_clients'] ?? '500+' }}
                    </div>
                    <div class="text-lg text-blue-100 font-semibold">Happy Clients</div>
                    <div class="text-sm text-blue-200">Across Global Markets</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-6xl font-black text-orange-400 mb-2">98%</div>
                    <div class="text-lg text-blue-100 font-semibold">Satisfaction Rate</div>
                    <div class="text-sm text-blue-200">Customer Feedback</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-6xl font-black text-orange-400 mb-2">
                        {{ \App\Helpers\SiteHelper::getExperienceYears() }}
                    </div>
                    <div class="text-lg text-blue-100 font-semibold">Years Experience</div>
                    <div class="text-sm text-blue-200">Industry Expertise</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-6xl font-black text-orange-400 mb-2">50+</div>
                    <div class="text-lg text-blue-100 font-semibold">Countries Served</div>
                    <div class="text-sm text-blue-200">Global Presence</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div id="contact" class="bg-white py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div
                    class="mb-12 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6 shadow-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-green-800">Message Sent Successfully!</h3>
                            <p class="text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                    {{ \App\Helpers\SiteHelper::get('home_contact_title', "Let's Start Your Next Project") }}
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    {{ \App\Helpers\SiteHelper::get('home_contact_subtitle', 'Ready to discuss your valve requirements? Our experts are here to provide personalized solutions and competitive pricing.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Contact Information -->
                <div class="space-y-8">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Get In Touch</h3>
                        <p class="text-lg text-gray-600 leading-relaxed mb-8">
                            {{ \App\Helpers\SiteHelper::get('home_contact_description', 'Our dedicated team of valve specialists is ready to assist you with technical consultations, custom solutions, and exceptional service.') }}
                        </p>
                    </div>

                    <div class="space-y-6">
                        <!-- Phone -->
                        <div class="flex items-start group">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-700 group-hover:from-orange-400 group-hover:to-orange-600 rounded-xl flex items-center justify-center transition-all duration-300 shadow-lg">
                                    <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h4 class="text-lg font-bold text-gray-900 mb-1">Phone</h4>
                                <p class="text-gray-600 text-lg">{{ \App\Helpers\SiteHelper::getPhone() }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ \App\Helpers\SiteHelper::get('contact_business_hours', 'Mon-Fri 8:00 AM - 6:00 PM') }}
                                </p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start group">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-700 group-hover:from-orange-400 group-hover:to-orange-600 rounded-xl flex items-center justify-center transition-all duration-300 shadow-lg">
                                    <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h4 class="text-lg font-bold text-gray-900 mb-1">Email</h4>
                                <p class="text-gray-600 text-lg">{{ \App\Helpers\SiteHelper::getEmail() }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ \App\Helpers\SiteHelper::get('contact_response_time', "We'll respond within 24 hours") }}
                                </p>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="flex items-start group">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-700 group-hover:from-orange-400 group-hover:to-orange-600 rounded-xl flex items-center justify-center transition-all duration-300 shadow-lg">
                                    <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h4 class="text-lg font-bold text-gray-900 mb-1">Address</h4>
                                <div class="text-gray-600 text-lg">
                                    {!! nl2br(\App\Helpers\SiteHelper::getFullAddress()) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Features -->
                    <div class="bg-gradient-to-br from-blue-50 to-orange-50 rounded-2xl p-6 mt-8">
                        <h4 class="text-lg font-bold text-gray-900 mb-4">Why Choose K-Tech Valves?</h4>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-orange-500 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Free technical consultation</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-orange-500 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Custom valve solutions</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-orange-500 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Competitive pricing</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-orange-500 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Global shipping available</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-gray-50 rounded-3xl p-8 lg:p-10">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Request a Quote</h3>
                    <p class="text-gray-600 mb-8">Fill out the form below and we'll get back to you with a personalized
                        solution.</p>

                    <form action="{{ route('home.inquiry') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name
                                    *</label>
                                <input type="text" name="name" id="name" required
                                    value="{{ old('name') }}"
                                    class="block w-full px-4 py-3 border border-gray-200 rounded-xl placeholder-gray-400 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300"
                                    placeholder="Your full name">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address
                                    *</label>
                                <input type="email" name="email" id="email" required
                                    value="{{ old('email') }}"
                                    class="block w-full px-4 py-3 border border-gray-200 rounded-xl placeholder-gray-400 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300"
                                    placeholder="your@email.com">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="company" class="block text-sm font-semibold text-gray-700 mb-2">Company
                                    Name</label>
                                <input type="text" name="company" id="company" value="{{ old('company') }}"
                                    class="block w-full px-4 py-3 border border-gray-200 rounded-xl placeholder-gray-400 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300"
                                    placeholder="Your company">
                                @error('company')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone
                                    Number</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                    class="block w-full px-4 py-3 border border-gray-200 rounded-xl placeholder-gray-400 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300"
                                    placeholder="+1 (555) 123-4567">
                                @error('phone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Project Details
                                *</label>
                            <textarea name="message" id="message" rows="5" required
                                class="block w-full px-4 py-3 border border-gray-200 rounded-xl placeholder-gray-400 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300"
                                placeholder="Tell us about your valve requirements, application, specifications, or any questions you have...">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-4 px-8 rounded-xl text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <span class="flex items-center justify-center">
                                    Send My Request
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- jQuery (required for Slick) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Slick Slider JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Image Slider
            $('#imageSlider').slick({
                dots: false,
                infinite: true,
                speed: 800,
                fade: true,
                cssEase: 'cubic-bezier(0.25, 0.46, 0.45, 0.94)',
                autoplay: false,
                autoplaySpeed: 5000,
                pauseOnHover: true,
                pauseOnFocus: true,
                arrows: true,
                prevArrow: '<button type="button" class="slick-prev">❮</button>',
                nextArrow: '<button type="button" class="slick-next">❯</button>',
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            arrows: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: true,
                            dots: true,
                            autoplaySpeed: 6000
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: false,
                            dots: true,
                            autoplaySpeed: 7000
                        }
                    }
                ]
            });
        });
    </script>
@endsection

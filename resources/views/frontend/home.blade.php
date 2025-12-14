@extends('frontend.layouts.app')

@section('title', 'K-Tech Valves - Industrial Valve Solutions')
@section('description', 'Leading manufacturer of high-quality industrial valves for diverse applications. From ball valves to gate valves, we provide reliable solutions for your industrial needs.')
@section('styles')
    <style>
        /* CSS Variables for consistent theming */
        :root {
            --primary-dark: #2c3e50;
            --primary-blue: #0f4c75;
            --secondary-blue: #3282b8;
            --accent-blue: #bbe1fa;
            --primary-orange: #ff6b35;
            --secondary-orange: #f7931e;
            --accent-red: #c0392b;
            --gradient-primary: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary-blue) 50%, var(--accent-blue) 100%);
            --gradient-orange: linear-gradient(135deg, var(--primary-orange) 0%, var(--secondary-orange) 100%);
            --overlay-dark: rgba(44, 62, 80, 0.85);
            --shadow-soft: 0 10px 40px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 20px 60px rgba(0, 0, 0, 0.15);
            --shadow-strong: 0 30px 80px rgba(0, 0, 0, 0.2);
            --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-bounce: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .hero-gradient {
            background: var(--gradient-primary);
        }

        .card-hover {
            transition: var(--transition-smooth);
        }

        .card-hover:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: var(--shadow-medium);
        }

        .stats-gradient {
            background: var(--gradient-orange);
        }

        .section-divider {
            background: linear-gradient(90deg, transparent, var(--secondary-blue), transparent);
            height: 2px;
        }

        /* Enhanced Hero Slider Styles */
        .hero-slider {
            position: relative;
            overflow: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .hero-slider::before {
            display: none;
        }

        #heroSlider {
            width: 100%;
            height: 80vh;
        }

        /* Send Inquiry Badge - Like Jayant Valves */
        .send-inquiry-badge {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            background: var(--accent-red);
            color: white;
            padding: 2.5rem 1rem;
            writing-mode: vertical-rl;
            text-orientation: mixed;
            font-weight: bold;
            font-size: 1rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            z-index: 10;
            box-shadow: 2px 0 15px rgba(192, 57, 43, 0.4);
            cursor: pointer;
            transition: var(--transition-smooth);
        }

        .send-inquiry-badge:hover {
            padding-right: 1.5rem;
            background: #a93226;
        }

        .send-inquiry-badge::before {
            content: '📧';
            display: block;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .slider-item {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 80vh;
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            opacity: 0;
            visibility: hidden;
            transition: all 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform: scale(1.1);
        }

        .slider-item.active {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
            position: relative;
        }

        .slider-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            /* background: var(--overlay-dark); */
            /* z-index: 2; */
        }

        .slider-item::after {
            display: none;
        }

        .slider-content {
            position: relative;
            z-index: 4;
            width: 100%;
        }

        /* Enhanced Navigation Controls */
        .slider-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 5;
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.25);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition-bounce);
            backdrop-filter: blur(20px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            opacity: 0.8;
        }

        .slider-nav:hover {
            background: rgba(255, 107, 53, 0.9);
            border-color: rgba(255, 107, 53, 1);
            transform: translateY(-50%) scale(1.15);
            opacity: 1;
            box-shadow: 0 12px 40px rgba(255, 107, 53, 0.4);
        }

        .slider-nav:active {
            transform: translateY(-50%) scale(0.95);
        }

        .slider-nav.prev {
            left: 30px;
        }

        .slider-nav.next {
            right: 30px;
        }

        .slider-nav svg {
            transition: transform 0.3s ease;
        }

        .slider-nav:hover svg {
            transform: scale(1.1);
        }

        /* Enhanced Dots Navigation */
        .slider-dots {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 16px;
            z-index: 5;
            padding: 12px 24px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50px;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .slider-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            transition: var(--transition-bounce);
            border: 2px solid rgba(255, 255, 255, 0.6);
            position: relative;
            overflow: hidden;
        }

        .slider-dot::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: var(--primary-orange);
            border-radius: 50%;
            transition: var(--transition-smooth);
            transform: translate(-50%, -50%);
        }

        .slider-dot.active {
            background: var(--primary-orange);
            border-color: var(--primary-orange);
            transform: scale(1.3);
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.4);
        }

        .slider-dot.active::before {
            width: 100%;
            height: 100%;
        }

        .slider-dot:hover:not(.active) {
            transform: scale(1.1);
            background: rgba(255, 255, 255, 0.6);
        }

        /* Enhanced Content Animations */
        .content-animate {
            opacity: 0;
            transform: translateY(60px);
            transition: all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .content-animate.active {
            opacity: 1;
            transform: translateY(0);
        }

        .content-animate.delay-100 {
            transition-delay: 0.1s;
        }

        .content-animate.delay-200 {
            transition-delay: 0.2s;
        }

        .content-animate.delay-300 {
            transition-delay: 0.3s;
        }

        .content-animate.delay-400 {
            transition-delay: 0.4s;
        }

        .content-animate.delay-500 {
            transition-delay: 0.5s;
        }

        /* Enhanced Typography */
        .hero-title {
            background: linear-gradient(135deg, #ffffff 0%, #f0f8ff 50%, #e6f3ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            font-weight: 300;
            letter-spacing: 1px;
        }

        .hero-subtitle {
            background: var(--gradient-orange);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Enhanced Buttons */
        .cta-primary {
            background: var(--gradient-orange);
            box-shadow: 0 8px 24px rgba(255, 107, 53, 0.3);
            transition: var(--transition-bounce);
            position: relative;
            overflow: hidden;
        }

        .cta-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .cta-primary:hover::before {
            left: 100%;
        }

        .cta-primary:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 12px 32px rgba(255, 107, 53, 0.4);
        }

        .cta-secondary {
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.1);
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        .cta-secondary:hover {
            background: rgba(255, 255, 255, 0.95);
            color: var(--primary-dark) !important;
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(255, 255, 255, 0.3);
        }

        /* Enhanced Stats Section */
        .stats-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 2rem;
            transition: var(--transition-smooth);
        }

        .stats-container:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-5px);
        }

        .stat-item {
            transition: var(--transition-smooth);
        }

        .stat-item:hover {
            transform: scale(1.05);
        }

        .stat-number {
            background: var(--gradient-orange);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Responsive Enhancements */
        
        /* Desktop - Full Height */
        @media (min-width: 1025px) {
            .hero-slider {
                min-height: 80vh !important;
                height: 80vh !important;
            }

            #heroSlider {
                height: 80vh !important;
            }

            .slider-item {
                height: 80vh !important;
                min-height: 700px;
                background-size: cover; /* Keep cover for large screens */
                background-attachment: fixed;
            }
        }

        /* Tablet (769px - 1024px) */
        @media (max-width: 1024px) and (min-width: 769px) {
            .hero-slider {
                min-height: 80vh !important;
                height: 80vh !important;
            }

            #heroSlider {
                height: 80vh !important;
            }

            .slider-item {
                height: 80vh !important;
                min-height: 80vh !important;
                background-size: cover; /* Cover still fine on tablet */
                background-attachment: fixed;
            }

            .hero-title {
                font-size: 3.5rem;
            }

            .hero-subtitle {
                font-size: 2.25rem;
            }

            .slider-nav {
                width: 55px;
                height: 55px;
            }

            .slider-nav.prev {
                left: 20px;
            }

            .slider-nav.next {
                right: 20px;
            }

            .stats-container {
                padding: 1.75rem;
            }

            .stat-number {
                font-size: 2.5rem;
            }

            .send-inquiry-badge {
                padding: 2rem 0.875rem;
                font-size: 0.95rem;
            }
        }

        /* Mobile Landscape/Small Tablets (481px - 768px) */
        @media (max-width: 768px) and (min-width: 481px) {
            .hero-slider {
                min-height: 60vh !important;
                height: 60vh !important;
            }

            #heroSlider {
                height: 60vh !important;
                min-height: 60vh !important;
            }

            .slider-item {
                height: 60vh !important;
                min-height: 60vh !important;
                background-size: cover; /* Cover ok here */
                background-attachment: scroll;
                background-position: center center;
            }

            .slider-content {
                padding-top: 3rem;
                padding-bottom: 3rem;
            }

            .hero-title {
                font-size: 2.75rem;
                line-height: 1.2;
                margin-bottom: 1.5rem;
            }

            .hero-subtitle {
                font-size: 2rem;
                margin-top: 1rem;
            }

            .slider-item p {
                font-size: 1.125rem;
                margin-bottom: 2rem;
                line-height: 1.6;
            }

            .cta-primary,
            .cta-secondary {
                padding: 0.875rem 2rem;
                font-size: 1rem;
            }

            .slider-nav {
                width: 50px;
                height: 50px;
                opacity: 0.9;
            }

            .slider-nav.prev {
                left: 15px;
            }

            .slider-nav.next {
                right: 15px;
            }

            .slider-dots {
                bottom: 25px;
                gap: 12px;
                padding: 10px 20px;
            }

            .slider-dot {
                width: 10px;
                height: 10px;
            }

            .stats-container {
                padding: 1.5rem;
                margin: 1.5rem 1rem 0;
            }

            .stat-number {
                font-size: 2rem;
                margin-bottom: 0.5rem;
            }

            .stat-item div:last-child {
                font-size: 0.875rem;
            }

            .send-inquiry-badge {
                padding: 1.75rem 0.75rem;
                font-size: 0.875rem;
                letter-spacing: 2px;
            }
        }

        /* Mobile Portrait (320px - 480px) - HALF SCREEN */
        @media (max-width: 480px) {
            .hero-slider {
                min-height: 27vh !important;
                height: 27vh !important;
                align-items: flex-start;
            }

            #heroSlider {
                height: 27vh !important;
                min-height: 27vh !important;
            }

            .slider-item {
                height: 27vh !important;
                min-height: 27vh !important;
                background-size: cover !important; /* KEY CHANGE: Contain to show full image, no crop */
                background-position: center center !important;
                background-repeat: no-repeat !important;
                background-attachment: scroll !important;
                /* NEW: Fallback background if image doesn't fill */
                background: linear-gradient(rgba(15, 76, 117, 0.6), rgba(50, 130, 184, 0.4)), var(--gradient-primary);
            }

            /* Clear image - remove dark overlay */
            .slider-item::before {
                background: rgba(0, 0, 0, 0.15) !important;
            }

            /* Hide all content on mobile - only show image */
            .slider-content {
                display: none !important;
            }

            /* Hide stats container on mobile */
            .stats-container {
                display: none !important;
            }

            .hero-title {
                font-size: 1.5rem;
                line-height: 1.1;
                margin-bottom: 0.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
                margin-top: 0.35rem;
            }

            .slider-item p {
                font-size: 0.8rem;
                margin-bottom: 0.75rem;
                line-height: 1.3;
            }

            .cta-primary,
            .cta-secondary {
                display: none !important;
            }

            .cta-primary svg,
            .cta-secondary svg {
                width: 0.9rem;
                height: 0.9rem;
                margin-left: 0.4rem;
                margin-right: 0.4rem;
            }

            .slider-nav {
                width: 35px;
                height: 35px;
                background: rgba(255, 255, 255, 0.25);
                backdrop-filter: blur(10px);
            }

            .slider-nav.prev {
                left: 10px;
            }

            .slider-nav.next {
                right: 10px;
            }

            .slider-nav svg {
                width: 1rem;
                height: 1rem;
            }

            .slider-dots {
                bottom: 12px;
                gap: 8px;
                padding: 6px 14px;
                background: rgba(255, 255, 255, 0.2);
            }

            .slider-dot {
                width: 7px;
                height: 7px;
                background: rgba(255, 255, 255, 0.6);
            }

            .slider-dot.active {
                background: white;
            }

            .stats-container {
                display: none !important;
            }

            .stats-container .grid {
                gap: 0.5rem;
            }

            .stat-number {
                font-size: 1.25rem;
                margin-bottom: 0.25rem;
            }

            .stat-item div:last-child {
                font-size: 0.65rem;
            }

            .stat-item .mt-2 {
                margin-top: 0.35rem;
                height: 2px;
            }

            /* Send Inquiry Badge for Mobile - Hide it */
            .send-inquiry-badge {
                display: none !important;
            }

            .send-inquiry-badge::before {
                display: inline-block;
                margin-right: 0.4rem;
                margin-bottom: 0;
                font-size: 1rem;
            }
        }

        /* Extra Small Mobile (max 375px) */
        @media (max-width: 375px) {
            .hero-title {
                font-size: 1.35rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .slider-item p {
                font-size: 0.75rem;
            }

            .stat-number {
                font-size: 1.15rem;
            }

            .cta-primary,
            .cta-secondary {
                padding: 0.55rem 1.1rem;
                font-size: 0.8rem;
            }

            .send-inquiry-badge {
                font-size: 0.7rem;
                padding: 0.5rem 0.65rem;
            }
        }

        /* Accessibility Enhancements */
        @media (prefers-reduced-motion: reduce) {
            .slider-item,
            .content-animate,
            .slider-nav,
            .slider-dot,
            .cta-primary,
            .cta-secondary,
            .send-inquiry-badge {
                transition: none;
                animation: none;
            }

            .hero-title,
            .hero-subtitle,
            .stat-number {
                animation: none;
            }
        }

        /* Focus states for accessibility */
        .slider-nav:focus,
        .slider-dot:focus,
        .cta-primary:focus,
        .cta-secondary:focus,
        .send-inquiry-badge:focus {
            outline: 3px solid rgba(255, 107, 53, 0.8);
            outline-offset: 2px;
        }

        /* Loading state */
        .hero-slider.loading {
            background: var(--gradient-primary);
        }

        .hero-slider.loading::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 50px;
            height: 50px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top: 3px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        @keyframes spin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        #heroSlider {
            width: 100%;
        }
    </style>
@endsection
@section('content')
    <div class="hero-slider relative" role="banner" aria-label="Company Hero Slider">
        @if($banners->count() > 0)

            <div id="heroSlider" class="relative h-screen">
                @foreach($banners as $index => $banner)
                    <div class="slider-item {{ $index === 0 ? 'active' : '' }}" @if($banner->image)
                    style="background-image: url('{{ asset('storage/' . $banner->image) }}')" @else
                        style="background: var(--gradient-primary)" @endif data-slide="{{ $index }}" role="group"
                        aria-roledescription="slide" aria-label="Slide {{ $index + 1 }} of {{ $banners->count() }}">

                        <div class="slider-content max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
                            <div class="text-center">
                                <!-- Enhanced Title with Staggered Animation -->
                                {{-- 
                                <h1 class="hero-title text-5xl md:text-7xl font-black text-white mb-6 leading-tight">
                                    {{ $banner->title }}
                                    @if($banner->subtitle)
                                        <span
                                            class="hero-subtitle block text-4xl md:text-5xl font-bold mt-4">{{ $banner->subtitle }}</span>
                                    @endif
                                </h1>
                                --}}
                                {{-- 
                                 @if($banner->content)
                                    <p class="text-xl md:text-2xl text-blue-100 mb-12 max-w-4xl mx-auto leading-relaxed font-light">
                                        {{ $banner->content }}
                                    </p>
                                @endif
                                
                                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                                    @if($banner->link_url && $banner->link_text)
                                        <a href="{{ $banner->link_url }}"
                                            class="cta-primary group px-10 py-5 text-white font-bold rounded-full text-lg shadow-lg focus:outline-none focus:ring-4 focus:ring-orange-300"
                                            aria-label="{{ $banner->link_text }} - Opens in same window">
                                            <span class="flex items-center relative z-10">
                                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                </svg>
                                                {{ $banner->link_text }}
                                                <svg class="w-5 h-5 ml-3 group-hover:translate-x-2 transition-transform duration-300"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    @else
                                        <a href="{{ route('products.index') }}"
                                            class="cta-primary group px-10 py-5 text-white font-bold rounded-full text-lg shadow-lg focus:outline-none focus:ring-4 focus:ring-orange-300"
                                            aria-label="Explore our product catalog">
                                            <span class="flex items-center relative z-10">
                                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                                    </path>
                                                </svg>
                                                Explore Products
                                                <svg class="w-5 h-5 ml-3 group-hover:translate-x-2 transition-transform duration-300"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                                </svg>
                                            </span>
                                        </a>
                                    @endif

                                    <a href="#contact"
                                        class="cta-secondary px-10 py-5 text-white font-bold rounded-full text-lg focus:outline-none focus:ring-4 focus:ring-white focus:ring-opacity-50"
                                        aria-label="Get a custom quote for your needs">
                                        <span class="flex items-center">
                                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                                </path>
                                            </svg>
                                            Get Custom Quote
                                        </span>
                                    </a>
                                </div>
                                --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Enhanced Navigation Controls (only show if more than 1 banner) -->
            @if($banners->count() > 1)
                <!-- Previous/Next Buttons -->
                <!-- <button class="slider-nav prev" id="prevSlide" aria-label="Previous slide" title="Go to previous slide">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button class="slider-nav next" id="nextSlide" aria-label="Next slide" title="Go to next slide">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button> -->

                <!-- Enhanced Dots Indicator -->
                <div class="slider-dots" role="tablist" aria-label="Slide navigation">
                    @foreach($banners as $index => $banner)
                        <button class="slider-dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}" role="tab"
                            aria-selected="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Go to slide {{ $index + 1 }}"
                            title="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            @endif

        @else
            <!-- Enhanced Fallback if no banners -->
            <div class="slider-item active h-screen" style="background: var(--gradient-primary)">
                <div class="slider-content max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
                    <div class="text-center">
                        <h1 class="hero-title text-5xl md:text-7xl font-black text-white mb-6 leading-tight">
                            Engineering Excellence in
                            <span class="hero-subtitle block text-4xl md:text-5xl font-bold mt-4">Industrial Valves</span>
                        </h1>
                        <p class="text-xl md:text-2xl text-blue-100 mb-12 max-w-4xl mx-auto leading-relaxed font-light">
                            Leading manufacturer of high-quality industrial valves for diverse applications. From ball valves to
                            gate valves, we provide reliable solutions for your industrial needs.
                        </p>

                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                            <a href="{{ route('products.index') }}"
                                class="cta-primary group px-10 py-5 text-white font-bold rounded-full text-lg shadow-lg">
                                <span class="flex items-center relative z-10">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                        </path>
                                    </svg>
                                    Explore Products
                                    <svg class="w-5 h-5 ml-3 group-hover:translate-x-2 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </span>
                            </a>
                            <a href="#contact" class="cta-secondary px-10 py-5 text-white font-bold rounded-full text-lg">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                        </path>
                                    </svg>
                                    Get Custom Quote
                                </span>
                            </a>
                        </div>

                        <!-- Key Stats Row -->
                        <div class="stats-container max-w-5xl mx-auto">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                                <div class="stat-item text-center group">
                                    <div class="stat-number text-4xl md:text-5xl font-black mb-3">
                                        {{ $stats['total_products'] ?? '250+' }}
                                    </div>
                                    <div class="text-sm md:text-base text-blue-100 font-semibold uppercase tracking-wider">
                                        Products</div>
                                    <div
                                        class="mt-2 w-12 h-1 bg-gradient-to-r from-orange-400 to-orange-600 mx-auto rounded-full group-hover:w-16 transition-all duration-300">
                                    </div>
                                </div>
                                <div class="stat-item text-center group">
                                    <div class="stat-number text-4xl md:text-5xl font-black mb-3">
                                        {{ $stats['total_clients'] ?? '500+' }}
                                    </div>
                                    <div class="text-sm md:text-base text-blue-100 font-semibold uppercase tracking-wider">Happy
                                        Clients</div>
                                    <div
                                        class="mt-2 w-12 h-1 bg-gradient-to-r from-orange-400 to-orange-600 mx-auto rounded-full group-hover:w-16 transition-all duration-300">
                                    </div>
                                </div>
                                <div class="stat-item text-center group">
                                    <div class="stat-number text-4xl md:text-5xl font-black mb-3">
                                        {{ $stats['total_industries'] ?? '15+' }}
                                    </div>
                                    <div class="text-sm md:text-base text-blue-100 font-semibold uppercase tracking-wider">
                                        Industries Served</div>
                                    <div
                                        class="mt-2 w-12 h-1 bg-gradient-to-r from-orange-400 to-orange-600 mx-auto rounded-full group-hover:w-16 transition-all duration-300">
                                    </div>
                                </div>
                                <div class="stat-item text-center group">
                                    <div class="stat-number text-4xl md:text-5xl font-black mb-3">
                                        {{ \App\Helpers\SiteHelper::getExperienceYears() }}
                                    </div>
                                    <div class="text-sm md:text-base text-blue-100 font-semibold uppercase tracking-wider">Years
                                        Experience</div>
                                    <div
                                        class="mt-2 w-12 h-1 bg-gradient-to-r from-orange-400 to-orange-600 mx-auto rounded-full group-hover:w-16 transition-all duration-300">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Scroll Indicator -->
                        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
                            <div class="flex flex-col items-center">
                                <span class="text-sm font-medium mb-2 opacity-80">Scroll to explore</span>
                                <svg class="w-6 h-6 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
                @foreach($categories->take(6) as $category)
                    <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden group">
                        <div
                            class="relative h-48 bg-gradient-to-br from-blue-500 to-blue-700 p-6 flex items-center justify-center">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                    class="w-full h-full object-cover absolute inset-0 group-hover:scale-110 transition-transform duration-500">
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-30 group-hover:bg-opacity-20 transition-all duration-300">
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold">{{ $category->name }}</h3>
                            <p class="text-gray-600 mb-4 leading-relaxed">{{ Str::limit($category->description, 100) }}</p>
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
                @foreach($featuredProducts->take(8) as $product)
                    <div class="card-hover bg-white rounded-2xl shadow-lg overflow-hidden group">
                        <div class="relative h-48 bg-gray-100">
                            @if($product->featured_image)
                                <img src="{{ asset('storage/' . $product->featured_image) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                        </path>
                                    </svg>
                                </div>
                            @endif

                            @if($product->category)
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Why Choose K-Tech Valves Section -->



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
                @foreach($industries->take(10) as $industry)
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="section-divider"></div>
    <!-- Trust Indicators Section -->

    <!-- Certifications Section -->
    {{-- <div class="bg-gray-50 py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                    Our <span class="text-orange-500">Certifications</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    K-Tech Valves maintains the highest industry standards through rigorous certification processes and
                    quality management systems.
                </p>
            </div>

            <!-- Certifications Grid -->
            @if($certifications && $certifications->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($certifications->take(8) as $certification)
                <div
                    class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 card-hover text-center">
                    @if($certification->image)
                    <div
                        class="w-20 h-20 mx-auto mb-4 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                        <img src="{{ asset('storage/' . $certification->image) }}" alt="{{ $certification->name }}"
                            class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300">
                    </div>
                    @else
                    <div
                        class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-blue-500 to-blue-700 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    @endif

                    <h3
                        class="text-lg font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors duration-300">
                        {{ $certification->name }}
                    </h3>

                    @if($certification->issuing_authority)
                    <p class="text-sm text-gray-600 mb-2">{{ $certification->issuing_authority }}</p>
                    @endif

                    @if($certification->certificate_number)
                    <p class="text-xs text-gray-500">Cert: {{ $certification->certificate_number }}</p>
                    @endif

                    @if($certification->valid_until)
                    <p class="text-xs text-gray-500 mt-1">
                        Valid until: {{ \Carbon\Carbon::parse($certification->valid_until)->format('M Y') }}
                    </p>
                    @endif
                </div>
                @endforeach
            </div>
            @else
            <!-- Default Certifications if none in database -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @php
                $defaultCertifications = [
                ['name' => 'ISO 9001:2015', 'authority' => 'Quality Management'],
                ['name' => 'API 6D', 'authority' => 'Pipeline Valves'],
                ['name' => 'API 600', 'authority' => 'Gate Valves'],
                ['name' => 'API 6FA', 'authority' => 'Fire Safe Testing'],
                ['name' => 'CE Marking', 'authority' => 'European Conformity'],
                ['name' => 'ANSI B16.34', 'authority' => 'Valve Standards'],
                ['name' => 'ISO 14001', 'authority' => 'Environmental Management'],
                ['name' => 'OHSAS 18001', 'authority' => 'Health & Safety']
                ];
                @endphp

                @foreach($defaultCertifications as $cert)
                <div
                    class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 card-hover text-center">
                    <div
                        class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-blue-500 to-blue-700 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3
                        class="text-lg font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors duration-300">
                        {{ $cert['name'] }}
                    </h3>
                    <p class="text-sm text-gray-600">{{ $cert['authority'] }}</p>
                </div>
                @endforeach
            </div>
            @endif

            <!-- Quality Commitment -->
            <div class="text-center mt-16">
                <div class="bg-white rounded-2xl p-8 lg:p-12 shadow-lg">
                    <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4">
                        Committed to Quality & Excellence
                    </h3>
                    <p class="text-lg text-gray-600 mb-8 max-w-3xl mx-auto">
                        Our certifications demonstrate our unwavering commitment to quality, safety, and environmental
                        responsibility. Every valve we manufacture meets or exceeds international standards.
                    </p>
                    <a href="{{ route('certifications') ?? '#' }}"
                        class="inline-flex items-center px-6 py-3 border-2 border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white font-semibold rounded-full transition-colors duration-300">
                        View All Certifications
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div> --}}


    {{-- <div class="bg-white py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center group">
                    <div
                        class="w-20 h-20 stats-gradient rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">ISO Certified Quality</h3>
                    <p class="text-gray-600 leading-relaxed">100% quality assured products with international certifications
                        and rigorous testing standards.</p>
                </div>

                <div class="text-center group">
                    <div
                        class="w-20 h-20 stats-gradient rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Rapid Delivery</h3>
                    <p class="text-gray-600 leading-relaxed">Express manufacturing and delivery with our efficient supply
                        chain and global distribution network.</p>
                </div>

                <div class="text-center group">
                    <div
                        class="w-20 h-20 stats-gradient rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">24/7 Support</h3>
                    <p class="text-gray-600 leading-relaxed">Round-the-clock technical support and maintenance services for
                        uninterrupted operations.</p>
                </div>
            </div>
        </div>
    </div> <!-- Section Divider --> --}}

    <!-- Client Success Stories Section -->
    <div class="hero-gradient py-16 lg:py-24">
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

            <!-- Client Logos -->
            @if($clients->count() > 0)
                {{-- <div class="bg-white bg-opacity-10 rounded-2xl p-8">
                    <h3 class="text-2xl font-bold text-white text-center mb-8">Our Valued Partners</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 items-center justify-center">
                        @foreach($clients->take(10) as $client)
                        <div class="group text-center">
                            @if($client->logo)
                            <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}"
                                class="h-12 mx-auto filter brightness-0 invert opacity-70 group-hover:opacity-100 transition-all duration-300">
                            @else
                            <div
                                class="h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center group-hover:bg-opacity-30 transition-all duration-300">
                                <span class="text-white font-semibold text-sm">{{ Str::limit($client->name, 10) }}</span>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div> --}}
            @endif
        </div>
    </div><!-- Contact Section - Foram-inspired Design -->
    <div id="contact" class="bg-white py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
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
                                    <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 012 2z" />
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
                                    <svg class="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name *</label>
                                <input type="text" name="name" id="name" required value="{{ old('name') }}"
                                    class="block w-full px-4 py-3 border border-gray-200 rounded-xl placeholder-gray-400 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300"
                                    placeholder="Your full name">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address
                                    *</label>
                                <input type="email" name="email" id="email" required value="{{ old('email') }}"
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

    <!-- About Company Section -->
    {{-- <div class="bg-white py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Content -->
                <div>
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                        About <span class="text-orange-500">K-Tech Valves</span>
                    </h2>
                    <p class="text-xl text-gray-600 leading-relaxed mb-8">
                        {{ \App\Helpers\SiteHelper::get('company_description', 'Leading manufacturer of high-quality
                        industrial valves for diverse applications worldwide.') }}
                    </p>

                    <div class="space-y-6 mb-8">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Quality Assurance</h3>
                                <p class="text-gray-600">Every valve undergoes rigorous testing to meet international
                                    standards and exceed customer expectations.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Innovation Excellence</h3>
                                <p class="text-gray-600">Cutting-edge technology and continuous R&D drive our innovative
                                    valve solutions.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z">
                                    </path>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Global Experience</h3>
                                <p class="text-gray-600">{{ \App\Helpers\SiteHelper::getExperienceYears() }}+ years of
                                    experience serving customers worldwide across multiple industries.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('about') }}"
                            class="inline-flex items-center px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg transition-colors duration-300">
                            Learn More About Us
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        <a href="{{ route('products.index') }}"
                            class="inline-flex items-center px-6 py-3 border-2 border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white font-semibold rounded-lg transition-colors duration-300">
                            View Our Products
                        </a>
                    </div>
                </div>

                <!-- Image/Stats -->
                <div class="space-y-6">
                    <div class="bg-gradient-to-br from-blue-50 to-orange-50 rounded-2xl p-8">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="text-center">
                                <div class="text-3xl font-black text-orange-500 mb-2">{{ $stats['total_products'] ?? '250+'
                                    }}</div>
                                <div class="text-sm text-gray-600 font-semibold">Products</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-black text-orange-500 mb-2">{{ $stats['total_clients'] ?? '500+'
                                    }}</div>
                                <div class="text-sm text-gray-600 font-semibold">Clients</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-black text-orange-500 mb-2">{{ $stats['total_industries'] ?? '15+'
                                    }}</div>
                                <div class="text-sm text-gray-600 font-semibold">Industries</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-black text-orange-500 mb-2">{{
                                    \App\Helpers\SiteHelper::getExperienceYears() }}</div>
                                <div class="text-sm text-gray-600 font-semibold">Years</div>
                            </div>
                        </div>
                    </div>

                    @if($galleries->count() > 0)
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($galleries->take(4) as $gallery)
                        <div class="aspect-square bg-gray-200 rounded-xl overflow-hidden">
                            @if($gallery->image)
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                                class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div> --}}

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Enhanced Slider Configuration
            const heroSlider = document.getElementById('heroSlider');
            const slides = document.querySelectorAll('.slider-item');
            const dots = document.querySelectorAll('.slider-dot');
            const nextBtn = document.getElementById('nextSlide');
            const prevBtn = document.getElementById('prevSlide');
            const playPauseBtn = document.getElementById('playPauseBtn');
            const pauseIcon = document.getElementById('pauseIcon');
            const playIcon = document.getElementById('playIcon');

            // Enhanced configuration
            let currentSlide = 0;
            let isPlaying = true;
            let autoPlayInterval = 80000000; // 8 seconds
            let autoPlay;
            let isTransitioning = false;

            // Reduced motion preference check
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            if (prefersReducedMotion) {
                autoPlayInterval = 12000; // Slower for accessibility
            }

            // Initialize slider
            function initSlider() {
                if (slides.length <= 1) return;

                // Set up initial state
                updateSlider(0, false);

                // Start autoplay
                startAutoPlay();

                // Initialize content animations
                animateContent(0);
            }

            // Enhanced slide transition with better animations
            function showSlide(index, direction = 'next') {
                if (isTransitioning || index === currentSlide || index < 0 || index >= slides.length) return;

                isTransitioning = true;
                const previousSlide = currentSlide;
                currentSlide = index;

                // Animate out current slide
                if (slides[previousSlide]) {
                    // Hide content animations
                    hideContentAnimations(previousSlide);
                }

                // Animate in new slide
                setTimeout(() => {
                    if (slides[previousSlide]) {
                        slides[previousSlide].classList.remove('active');
                        slides[previousSlide].style.visibility = 'hidden';
                    }

                    if (slides[currentSlide]) {
                        slides[currentSlide].style.visibility = 'visible';
                        slides[currentSlide].style.opacity = '0';
                        slides[currentSlide].style.transform = direction === 'next' ? 'scale(1.05) translateX(100px)' : 'scale(1.05) translateX(-100px)';
                        slides[currentSlide].classList.add('active');

                        // Trigger reflow
                        slides[currentSlide].offsetHeight;

                        // Animate in
                        slides[currentSlide].style.transition = 'all 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                        slides[currentSlide].style.opacity = '1';
                        slides[currentSlide].style.transform = 'scale(1) translateX(0)';

                        // Preload next slide image
                        preloadNextImage();
                    }

                    // Update navigation
                    updateNavigation();

                    // Start content animations after slide transition
                    setTimeout(() => {
                        animateContent(currentSlide);
                        isTransitioning = false;
                    }, 200);

                }, 100);
            }

            // Enhanced content animations
            function animateContent(slideIndex) {
                const slide = slides[slideIndex];
                if (!slide) return;

                const contentElements = slide.querySelectorAll('.content-animate');

                contentElements.forEach((element, index) => {
                    // Reset element
                    element.style.opacity = '0';
                    element.style.transform = 'translateY(60px)';

                    // Trigger animation with staggered delays
                    setTimeout(() => {
                        element.classList.add('active');
                    }, index * 150 + 300); // Staggered animation
                });
            }

            // Hide content animations
            function hideContentAnimations(slideIndex) {
                const slide = slides[slideIndex];
                if (!slide) return;

                const contentElements = slide.querySelectorAll('.content-animate');
                contentElements.forEach(element => {
                    element.classList.remove('active');
                });
            }

            // Update navigation states
            function updateNavigation() {
                // Update dots
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentSlide);
                    dot.setAttribute('aria-selected', index === currentSlide ? 'true' : 'false');
                });

                // Update navigation buttons state
                if (nextBtn && prevBtn) {
                    nextBtn.style.opacity = currentSlide === slides.length - 1 ? '0.6' : '1';
                    prevBtn.style.opacity = currentSlide === 0 ? '0.6' : '1';
                }
            }

            // Simplified update function for initial setup
            function updateSlider(index, animate = true) {
                if (animate) {
                    showSlide(index);
                } else {
                    currentSlide = index;
                    slides.forEach((slide, i) => {
                        slide.classList.toggle('active', i === index);
                        slide.style.opacity = i === index ? '1' : '0';
                        slide.style.visibility = i === index ? 'visible' : 'hidden';
                        slide.style.transform = 'scale(1) translateX(0)';
                    });
                    updateNavigation();
                }
            }

            // Navigation functions
            function nextSlide() {
                const next = (currentSlide + 1) % slides.length;
                showSlide(next, 'next');
                restartAutoPlay();
            }

            function prevSlide() {
                const prev = (currentSlide - 1 + slides.length) % slides.length;
                showSlide(prev, 'prev');
                restartAutoPlay();
            }

            // Auto-play functionality
            function startAutoPlay() {
                if (slides.length <= 1 || !isPlaying) return;
                autoPlay = setInterval(nextSlide, autoPlayInterval);
            }

            function stopAutoPlay() {
                clearInterval(autoPlay);
            }

            function restartAutoPlay() {
                stopAutoPlay();
                if (isPlaying) {
                    startAutoPlay();
                }
            }

            function toggleAutoPlay() {
                isPlaying = !isPlaying;

                if (isPlaying) {
                    startAutoPlay();
                    playPauseBtn.setAttribute('aria-label', 'Pause slideshow');
                    playPauseBtn.setAttribute('title', 'Pause slideshow');
                    pauseIcon.classList.remove('hidden');
                    playIcon.classList.add('hidden');
                } else {
                    stopAutoPlay();
                    playPauseBtn.setAttribute('aria-label', 'Play slideshow');
                    playPauseBtn.setAttribute('title', 'Play slideshow');
                    pauseIcon.classList.add('hidden');
                    playIcon.classList.remove('hidden');
                }
            }

            // Event Listeners

            // Navigation buttons
            if (nextBtn) {
                nextBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    nextSlide();
                });
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    prevSlide();
                });
            }

            // Play/Pause button
            if (playPauseBtn) {
                playPauseBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    toggleAutoPlay();
                });
            }

            // Dot navigation with enhanced accessibility
            dots.forEach((dot, index) => {
                dot.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (index !== currentSlide) {
                        showSlide(index, index > currentSlide ? 'next' : 'prev');
                        restartAutoPlay();
                    }
                });

                // Keyboard navigation for dots
                dot.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        if (index !== currentSlide) {
                            showSlide(index, index > currentSlide ? 'next' : 'prev');
                            restartAutoPlay();
                        }
                    }
                });
            });

            // Enhanced keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (slides.length <= 1) return;

                switch (e.key) {
                    case 'ArrowLeft':
                        e.preventDefault();
                        prevSlide();
                        break;
                    case 'ArrowRight':
                        e.preventDefault();
                        nextSlide();
                        break;
                    case ' ': // Space bar
                        if (e.target === document.body) {
                            e.preventDefault();
                            toggleAutoPlay();
                        }
                        break;
                    case 'Home':
                        e.preventDefault();
                        showSlide(0);
                        restartAutoPlay();
                        break;
                    case 'End':
                        e.preventDefault();
                        showSlide(slides.length - 1);
                        restartAutoPlay();
                        break;
                }
            });

            // Enhanced touch/swipe support
            let touchStartX = 0;
            let touchEndX = 0;
            let touchStartY = 0;
            let touchEndY = 0;
            let isSwiping = false;

            if (heroSlider) {
                heroSlider.addEventListener('touchstart', (e) => {
                    touchStartX = e.changedTouches[0].screenX;
                    touchStartY = e.changedTouches[0].screenY;
                    isSwiping = true;
                    stopAutoPlay();
                }, { passive: true });

                heroSlider.addEventListener('touchmove', (e) => {
                    if (!isSwiping) return;

                    const currentX = e.changedTouches[0].screenX;
                    const currentY = e.changedTouches[0].screenY;
                    const diffX = Math.abs(currentX - touchStartX);
                    const diffY = Math.abs(currentY - touchStartY);

                    // If horizontal swipe is more significant than vertical, prevent scrolling
                    if (diffX > diffY && diffX > 10) {
                        e.preventDefault();
                    }
                }, { passive: false });

                heroSlider.addEventListener('touchend', (e) => {
                    if (!isSwiping) return;

                    touchEndX = e.changedTouches[0].screenX;
                    touchEndY = e.changedTouches[0].screenY;
                    handleSwipe();
                    isSwiping = false;

                    if (isPlaying) {
                        startAutoPlay();
                    }
                }, { passive: true });

                // Mouse drag support for desktop
                let isDragging = false;
                let mouseStartX = 0;

                heroSlider.addEventListener('mousedown', (e) => {
                    isDragging = true;
                    mouseStartX = e.clientX;
                    stopAutoPlay();
                    heroSlider.style.cursor = 'grabbing';
                });

                heroSlider.addEventListener('mousemove', (e) => {
                    if (!isDragging) return;
                    e.preventDefault();
                });

                heroSlider.addEventListener('mouseup', (e) => {
                    if (!isDragging) return;

                    const mouseEndX = e.clientX;
                    const diff = mouseStartX - mouseEndX;
                    const threshold = 50;

                    if (Math.abs(diff) > threshold) {
                        if (diff > 0) {
                            nextSlide();
                        } else {
                            prevSlide();
                        }
                    }

                    isDragging = false;
                    heroSlider.style.cursor = 'grab';

                    if (isPlaying) {
                        startAutoPlay();
                    }
                });

                heroSlider.addEventListener('mouseleave', () => {
                    if (isDragging) {
                        isDragging = false;
                        heroSlider.style.cursor = 'default';
                        if (isPlaying) {
                            startAutoPlay();
                        }
                    }
                });
            }

            function handleSwipe() {
                const swipeThreshold = 50;
                const diffX = touchStartX - touchEndX;
                const diffY = Math.abs(touchStartY - touchEndY);

                // Only consider horizontal swipes
                if (Math.abs(diffX) > swipeThreshold && Math.abs(diffX) > diffY) {
                    if (diffX > 0) {
                        // Swipe left - next slide
                        nextSlide();
                    } else {
                        // Swipe right - previous slide
                        prevSlide();
                    }
                }
            }

            // Pause/resume on hover (desktop only)
            if (heroSlider && !('ontouchstart' in window)) {
                heroSlider.addEventListener('mouseenter', () => {
                    if (isPlaying) {
                        stopAutoPlay();
                    }
                });

                heroSlider.addEventListener('mouseleave', () => {
                    if (isPlaying) {
                        startAutoPlay();
                    }
                });
            }

            // Visibility API - pause when tab is not visible
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    stopAutoPlay();
                } else if (isPlaying) {
                    startAutoPlay();
                }
            });

            // Intersection Observer for performance
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const sliderObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (isPlaying && slides.length > 1) {
                            startAutoPlay();
                        }
                    } else {
                        stopAutoPlay();
                    }
                });
            }, observerOptions);

            if (heroSlider) {
                sliderObserver.observe(heroSlider);
            }

            // Enhanced resize handler
            let resizeTimeout;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
                    // Recalculate dimensions if needed
                    updateNavigation();
                }, 250);
            });

            // Initialize slider after DOM is ready
            initSlider();

            // Preload next slide images for better performance
            function preloadNextImage() {
                if (slides.length <= 1) return;

                const nextIndex = (currentSlide + 1) % slides.length;
                const nextSlide = slides[nextIndex];
                if (nextSlide) {
                    const bgImage = nextSlide.style.backgroundImage;
                    if (bgImage && bgImage !== 'none') {
                        const img = new Image();
                        const url = bgImage.slice(4, -1).replace(/["']/g, "");
                        img.src = url;
                    }
                }
            }

            // Preload next image when slide changes
            slides.forEach((slide, index) => {
                if (index === 0) preloadNextImage();
            });

            // Error handling for image loading
            slides.forEach(slide => {
                const bgImage = slide.style.backgroundImage;
                if (bgImage && bgImage !== 'none') {
                    const img = new Image();
                    const url = bgImage.slice(4, -1).replace(/["']/g, "");
                    img.onerror = () => {
                        // Fallback to gradient background
                        slide.style.background = 'var(--gradient-primary)';
                    };
                    img.src = url;
                }
            });
        });
    </script>
@endsection
@extends('frontend.layouts.app')

@section('title', \App\Helpers\SiteHelper::get('about_hero_title', 'About Us') . ' - ' . \App\Helpers\SiteHelper::getCompanyName())
@section('description', \App\Helpers\SiteHelper::get('about_hero_subtitle', 'Learn about K-Tech Valves, a leading manufacturer of high-quality industrial valves for diverse applications worldwide.'))

@section('styles')
    @include('frontend.partials.shared-styles')
@endsection

@section('content')    <!-- Hero Section -->
    <div class="hero-gradient page-header" 
         @if(\App\Helpers\SiteHelper::get('about_hero_background'))
         style="background-image: linear-gradient(rgba(15, 76, 117, 0.8), rgba(50, 130, 184, 0.7)), url('{{ asset('storage/' . \App\Helpers\SiteHelper::get('about_hero_background')) }}'); background-size: cover; background-position: center; background-repeat: no-repeat;"
         @endif>
        <div class="hero-content page-header-content">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">
                        {{ \App\Helpers\SiteHelper::get('about_hero_title', 'About ' . \App\Helpers\SiteHelper::getCompanyName()) }}
                    </h1>
                    <p class="text-xl md:text-2xl opacity-90 mb-8">
                        {{ \App\Helpers\SiteHelper::get('about_hero_subtitle', 'Leading the valve manufacturing industry with innovation, quality, and reliability for over two decades.') }}
                    </p>
                    @if(\App\Helpers\SiteHelper::get('about_hero_description'))
                        <p class="text-lg opacity-80 max-w-2xl mx-auto">
                            {{ \App\Helpers\SiteHelper::get('about_hero_description') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white py-16 lg:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                {{ \App\Helpers\SiteHelper::get('homepage_why_choose_title', 'Why Choose K-Tech Valves?') }}
            </h2><p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                {{ \App\Helpers\SiteHelper::get('homepage_why_choose_subtitle', 'Discover what sets us apart in the valve manufacturing industry and why customers trust us worldwide.') }}
            </p>
        </div>

        <!-- Why Choose Points Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">            @php
                $whyChoosePoints = \App\Helpers\SiteHelper::get('why_choose_points', '[]');
                
                // Handle both string and array formats
                if (is_string($whyChoosePoints)) {
                    $whyChoosePoints = json_decode($whyChoosePoints, true);
                }
                
                // Ensure we have a valid array
                if (!is_array($whyChoosePoints) || empty($whyChoosePoints)) {
                    $whyChoosePoints = [];
                }
                $defaultPoints = [
                    [
                        'title' => 'Premium Quality Materials',
                        'description' => 'We use only the finest materials and manufacturing processes to ensure durability and reliability.',
                        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
                    ],
                    [
                        'title' => 'Expert Engineering',
                        'description' => 'Our team of experienced engineers designs valves that meet the most demanding specifications.',
                        'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'
                    ],
                    [
                        'title' => 'Global Standards Compliance',
                        'description' => 'All our products meet international standards including API, ANSI, DIN, and ISO certifications.',
                        'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'
                    ],
                    [
                        'title' => 'Custom Solutions',
                        'description' => 'We provide tailored valve solutions to meet your specific application requirements.',
                        'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c-.94 1.543-.826 3.31 2.37 2.37a1.724 1.724 0 002.572 1.065c.426 1.756-1.756 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'
                    ],
                    [
                        'title' => 'Fast Delivery',
                        'description' => 'Quick turnaround times and efficient logistics ensure you get your valves when you need them.',
                        'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'
                    ],
                    [
                        'title' => '24/7 Support',
                        'description' => 'Our dedicated support team is available around the clock to assist with any technical queries.',
                        'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z'
                    ]
                ];
                $points = !empty($whyChoosePoints) ? $whyChoosePoints : $defaultPoints;
            @endphp            @foreach($points as $index => $point)
                @php
                    // Handle both simple strings and full objects
                    if (is_string($point)) {
                        $point = [
                            'title' => $point,
                            'description' => 'This is one of the key advantages that sets K-Tech Valves apart in the industry.',
                            'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
                        ];
                    } elseif (!is_array($point)) {
                        continue;
                    }
                    
                    // Ensure all required keys exist
                    $point = array_merge([
                        'title' => 'Feature ' . ($index + 1),
                        'description' => 'Description not available.',
                        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
                    ], $point);
                @endphp
                
                <div class="group text-center p-8 bg-gray-50 rounded-2xl hover:bg-white hover:shadow-xl transition-all duration-300 card-hover">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $point['icon'] }}"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-orange-600 transition-colors duration-300">
                        {{ $point['title'] }}
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $point['description'] }}
                    </p>
                </div>
            @endforeach
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-16">
            <div class="bg-gradient-to-r from-orange-50 to-blue-50 rounded-2xl p-8 lg:p-12">
                <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4">
                    Ready to Experience the K-Tech Difference?
                </h3>
                <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                    Join thousands of satisfied customers and discover why K-Tech Valves is the preferred choice for industrial valve solutions.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#contact" class="inline-flex items-center px-8 py-4 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-full text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Get Custom Quote
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-8 py-4 border-2 border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white font-bold rounded-full text-lg transition-all duration-300">
                        Browse Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Content Section -->
    <div class="py-20 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Mission & Vision -->
            <div class="grid-enhanced mb-20">
                <div class="card-hover p-8 bg-gradient-to-br from-gray-50 to-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">
                            {{ \App\Helpers\SiteHelper::get('about_mission_title', 'Our Mission') }}
                        </h3>
                    </div>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        {{ \App\Helpers\SiteHelper::get('about_mission_content', 'To provide superior valve solutions that exceed industry standards and customer expectations.') }}
                    </p>
                </div>

                <div class="card-hover p-8 bg-gradient-to-br from-blue-50 to-blue-100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">
                            {{ \App\Helpers\SiteHelper::get('about_vision_title', 'Our Vision') }}
                        </h3>
                    </div>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        {{ \App\Helpers\SiteHelper::get('about_vision_content', 'To be the global leader in valve technology and innovation.') }}
                    </p>
                </div>
            </div>

            <!-- Values -->
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-3xl p-12 mb-20">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4 heading-gradient">
                        {{ \App\Helpers\SiteHelper::get('about_values_title', 'Our Core Values') }}
                    </h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        {{ \App\Helpers\SiteHelper::get('about_values_description', 'The principles that guide everything we do') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="text-center card-hover p-6">
                        <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-2xl bg-gradient-to-r from-blue-500 to-blue-600 text-white mb-6">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">
                            {{ \App\Helpers\SiteHelper::get('about_values_value_1_title', 'Quality') }}
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ \App\Helpers\SiteHelper::get('about_values_value_1_description', 'Uncompromising commitment to excellence in every product we manufacture.') }}
                        </p>
                    </div>

                    <div class="text-center card-hover p-6">
                        <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-2xl bg-gradient-to-r from-green-500 to-green-600 text-white mb-6">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">
                            {{ \App\Helpers\SiteHelper::get('about_values_value_2_title', 'Innovation') }}
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ \App\Helpers\SiteHelper::get('about_values_value_2_description', 'Continuously advancing valve technology to meet evolving industry needs.') }}
                        </p>
                    </div>

                    <div class="text-center card-hover p-6">
                        <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-2xl bg-gradient-to-r from-orange-500 to-orange-600 text-white mb-6">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">
                            {{ \App\Helpers\SiteHelper::get('about_values_value_3_title', 'Reliability') }}
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ \App\Helpers\SiteHelper::get('about_values_value_3_description', 'Dependable performance you can trust in critical applications.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Company History -->
            <div class="bg-white rounded-3xl p-12">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4 heading-gradient">
                        {{ \App\Helpers\SiteHelper::get('about_history_title', 'Our History') }}
                    </h2>
                </div>

                <div class="max-w-4xl mx-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div>
                            <div class="text-6xl font-bold text-blue-600 mb-4">
                                {{ \App\Helpers\SiteHelper::get('about_history_founded_year', '1999') }}
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Founded</h3>
                            <p class="text-gray-600 text-lg leading-relaxed">
                                {{ \App\Helpers\SiteHelper::get('about_history_description', 'Founded with a vision to revolutionize the valve industry, K-Tech Valves has grown from a small manufacturing company to a global leader in valve technology.') }}
                            </p>
                        </div>
                        <div class="relative">
                            @if(\App\Helpers\SiteHelper::get('about_history_image'))
                                <div class="aspect-w-16 aspect-h-9 rounded-2xl overflow-hidden">
                                    <img src="{{ asset('storage/' . \App\Helpers\SiteHelper::get('about_history_image')) }}" alt="Company History" class="object-cover w-full h-full">
                                </div>
                            @else
                                <div class="aspect-w-16 aspect-h-9 rounded-2xl overflow-hidden bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                                    <div class="text-center text-blue-600">
                                        <svg class="mx-auto h-16 w-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        <p class="text-lg font-semibold">Company History</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
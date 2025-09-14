@extends('frontend.layouts.app')

@section('title', 'Gallery - K-Tech Valves')
@section('meta_description', 'Explore our state-of-the-art manufacturing facility, quality testing equipment, and valve production processes at K-Tech Valves.')

@section('styles')
@include('frontend.partials.shared-styles')
@endsection

@section('content')
<!-- Hero Section -->
<div class="hero-gradient page-header">
    <div class="hero-content page-header-content">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">{{ $heroData['title'] }}</h1>
                <p class="text-xl md:text-2xl opacity-90 mb-8">{{ $heroData['subtitle'] }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Gallery Grid -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">        <!-- Filter Tabs -->
        @if($settings['show_categories'])
        <div class="flex flex-wrap justify-center mb-16" x-data="{ activeFilter: 'all' }">
            <button @click="activeFilter = 'all'" 
                    :class="activeFilter === 'all' ? 'active' : ''"
                    class="filter-btn">
                All Photos
            </button>
            @foreach($categories as $category)
            <button @click="activeFilter = '{{ strtolower($category) }}'" 
                    :class="activeFilter === '{{ strtolower($category) }}' ? 'active' : ''"
                    class="filter-btn">
                {{ ucfirst($category) }}
            </button>
            @endforeach
        </div>
        @endif

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" 
             x-data="{ 
                 activeFilter: 'all'
             }">            @foreach($galleries as $gallery)
            <div class="gallery-item card-hover"
                 data-category="{{ strtolower($gallery->category) }}"
                 @if($settings['show_categories'])
                 x-show="activeFilter === 'all' || activeFilter === '{{ strtolower($gallery->category) }}'"
                 @endif>
                
                <div class="image-overlay">
                    <img src="{{ asset('storage/' . $gallery->image) }}" 
                         alt="{{ $gallery->title }}" 
                         class="w-full h-64 object-cover">
                    @if($settings['show_categories'])
                    <div class="absolute top-4 left-4 z-10">
                        <span class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                            {{ ucfirst($gallery->category) }}
                        </span>
                    </div>
                    @endif
                </div>
                
                @if($settings['show_image_info'])
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $gallery->title }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ Str::limit($gallery->description, 100) }}</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="stats-gradient text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">Visit Our Facility</h2>
        <p class="text-xl opacity-90 mb-8 max-w-3xl mx-auto">
            Experience our manufacturing excellence firsthand. Schedule a facility tour to see our processes and quality standards.
        </p>
        <a href="{{ route('contact') }}" 
           class="btn-secondary">
            Schedule a Tour
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Gallery filtering is handled by Alpine.js in the template
</script>
@endpush

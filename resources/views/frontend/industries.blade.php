@extends('frontend.layouts.app')

@section('title', 'Industries - K-Tech Valves')
@section('description', 'Discover the diverse industries we serve with our high-quality valve solutions including oil & gas, water treatment, power generation, and more.')

@section('styles')
@include('frontend.partials.shared-styles')
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="hero-gradient page-header">
        <div class="hero-content page-header-content">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">Industries We Serve</h1>
                    <p class="text-xl md:text-2xl opacity-90 mb-8">
                        Comprehensive valve solutions across diverse industrial sectors worldwide
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Industries Grid -->
    @if($industries->count() > 0)
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach($industries as $industry)
                <div class="card-hover">
                    @if($industry->image)
                        <div class="image-overlay">
                            <img src="{{ asset('storage/' . $industry->image) }}" alt="{{ $industry->name }}" class="w-full h-64 object-cover">
                        </div>
                    @else
                        <div class="w-full h-64 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                            <div class="text-center text-white">
                                <svg class="mx-auto h-16 w-16 text-white/80 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                                <p class="text-xl font-bold">{{ $industry->name }}</p>
                            </div>
                        </div>
                    @endif
                    
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">
                            {{ $industry->name }}
                        </h3>
                        
                        @if($industry->description)
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                {{ Str::limit($industry->description, 150) }}
                            </p>
                        @endif

                        @if($industry->features && count($industry->features) > 0)
                            <div class="mb-6">
                                <h4 class="font-semibold text-gray-900 mb-3">Key Applications:</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($industry->features as $feature)
                                        <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">
                                            {{ $feature }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <a href="{{ route('products.index') }}" class="btn-primary mt-4">
                            View Solutions
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @else
    <!-- No Industries Found -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="card-hover p-12">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Industries Coming Soon</h3>
                <p class="text-lg text-gray-600">Industries information will be managed from the admin panel.</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Industries Overview -->
    <div class="bg-gradient-to-r from-gray-50 to-blue-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-6 heading-gradient">Global Industrial Solutions</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Our valve solutions are trusted across diverse industrial sectors, from traditional manufacturing to cutting-edge technology applications.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <div class="text-center card-hover p-8">
                    <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-2xl bg-gradient-to-r from-blue-500 to-blue-600 text-white mb-6">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Oil & Gas</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Critical valve solutions for upstream, midstream, and downstream operations.
                    </p>
                </div>

                <div class="text-center card-hover p-8">
                    <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-2xl bg-gradient-to-r from-green-500 to-green-600 text-white mb-6">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Water Treatment</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Reliable valves for municipal and industrial water treatment facilities.
                    </p>
                </div>

                <div class="text-center card-hover p-8">
                    <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-2xl bg-gradient-to-r from-orange-500 to-orange-600 text-white mb-6">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Power Generation</h3>
                    <p class="text-gray-600 leading-relaxed">
                        High-performance valves for thermal, nuclear, and renewable energy.
                    </p>
                </div>

                <div class="text-center card-hover p-8">
                    <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-2xl bg-gradient-to-r from-purple-500 to-purple-600 text-white mb-6">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Chemical Processing</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Specialized valves for harsh chemical processing environments.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="stats-gradient text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold mb-6">Need Industry-Specific Solutions?</h2>
            <p class="text-xl opacity-90 mb-8 max-w-3xl mx-auto">
                Our experts understand the unique challenges of your industry. Get customized valve solutions tailored to your specific requirements.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('contact') }}" class="btn-secondary">
                    Get Custom Quote
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('products.index') }}" class="btn-secondary">
                    Browse Products
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5L8 4z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
// Content is now visible by default - no animation needed
</script>
@endpush

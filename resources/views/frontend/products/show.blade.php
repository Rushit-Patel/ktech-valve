@extends('frontend.layouts.app')

@section('title', $product->name . ' - K-Tech Valves')
@section('description', $product->meta_data['description'] ?? Str::limit(strip_tags($product->content), 160))

@section('styles')
@include('frontend.partials.shared-styles')
@endsection

@section('content')
    <!-- Small Banner/Announcement -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center text-center">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-medium">
                    ✨ Free Technical Consultation • Fast Quote Response • Worldwide Shipping Available
                </span>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <nav class="bg-gray-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-4 py-4">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Home</a>
                <svg class="h-4 w-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-gray-700">Products</a>
                @if($product->category)
                    <svg class="h-4 w-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <a href="{{ route('products.category', $product->category->slug) }}" class="text-gray-500 hover:text-gray-700">{{ $product->category->name }}</a>
                @endif
                <svg class="h-4 w-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-900 font-medium">{{ $product->name }}</span>
            </div>
        </div>
    </nav>

    <!-- Main Product Section: Image + Content -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 lg:items-start">
                <!-- Product Image -->
                <div class="flex flex-col">
                    <div class="aspect-w-1 aspect-h-1 w-full">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-96 object-center object-cover sm:rounded-lg shadow-lg">
                        @else
                            <div class="w-full h-96 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center shadow-lg">
                                <div class="text-center">
                                    <svg class="h-24 w-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                    <p class="text-gray-500 text-lg font-medium">{{ $product->name }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Trust Indicators -->
                    <div class="mt-6 grid grid-cols-3 gap-4">
                        <div class="text-center p-3 bg-green-50 rounded-lg">
                            <div class="text-green-600 text-2xl font-bold">ISO</div>
                            <div class="text-green-700 text-xs">Certified</div>
                        </div>
                        <div class="text-center p-3 bg-blue-50 rounded-lg">
                            <div class="text-blue-600 text-2xl font-bold">24/7</div>
                            <div class="text-blue-700 text-xs">Support</div>
                        </div>
                        <div class="text-center p-3 bg-purple-50 rounded-lg">
                            <div class="text-purple-600 text-2xl font-bold">5Y</div>
                            <div class="text-purple-700 text-xs">Warranty</div>
                        </div>
                    </div>
                </div>

                <!-- Product Information -->
                <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                    <!-- Product Header -->
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                                {{ $product->name }}
                            </h1>
                            
                            @if($product->category)
                                <div class="mt-3">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Quick Action Button -->
                        <div class="ml-4">
                            <button onclick="document.getElementById('inquiry-form').scrollIntoView({behavior: 'smooth'})" 
                                    class="btn-primary">
                                Get Quote
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </button>
                        </div>
                    </div>                    <!-- Key Features Highlights -->
                    @if(!empty($features) && is_array($features))
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Key Features</h3>
                        <div class="grid grid-cols-1 gap-3">
                            @foreach(array_slice($features, 0, 4) as $feature)
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">{{ $feature }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Product Description -->
                    @if($product->content)
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Product Overview</h3>
                        <div class="prose prose-lg text-gray-600 max-w-none">
                            {!! Str::limit(strip_tags($product->content), 300) !!}
                        </div>
                    </div>
                    @endif                    <!-- Quick Specs Preview -->
                    @if(!empty($technical_specs) && is_array($technical_specs))
                    <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Specifications</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach(array_slice($technical_specs, 0, 6) as $key => $value)
                            <div class="flex justify-between">
                                <span class="text-gray-600 font-medium">{{ $key }}:</span>
                                <span class="text-gray-900">{{ $value }}</span>
                            </div>
                            @endforeach
                        </div>
                        @if(!empty($technical_specs) && count($technical_specs) > 6)
                        <p class="mt-4 text-sm text-blue-600">+ {{ count($technical_specs) - 6 }} more specifications below</p>
                        @endif
                    </div>
                    @endif

                    <!-- Call to Action Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <button onclick="document.getElementById('inquiry-form').scrollIntoView({behavior: 'smooth'})" 
                                class="btn-primary flex-1">
                            Request Detailed Quote
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </button>
                        <a href="{{ route('contact') }}" 
                           class="btn-secondary flex-1">
                            Technical Support
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- Technical Details in Table Format -->
    @if(!empty($technical_specs) && is_array($technical_specs))
    <div class="bg-gradient-to-br from-gray-50 to-blue-50 border-t border-gray-200">        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Technical Specifications</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Comprehensive technical details and engineering specifications for informed decision-making.
                </p>
            </div>
            
            <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold text-white">{{ $product->name }}</h3>
                            <p class="text-blue-100 mt-1">Model: {{ $product->model_number ?? 'N/A' }}</p>
                        </div>
                        <div class="text-right">
                            <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                                <p class="text-white text-sm font-medium">Certified Quality</p>
                                <div class="flex items-center mt-1">
                                    <svg class="w-4 h-4 text-yellow-300 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                    </svg>
                                    <span class="text-white text-xs">ISO Certified</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <th scope="col" class="px-8 py-5 text-left text-sm font-bold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                        Specification Parameter
                                    </div>
                                </th>
                                <th scope="col" class="px-8 py-5 text-left text-sm font-bold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Value & Details
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($technical_specs as $index => $spec_data)
                                @if(is_array($spec_data))
                                    @foreach($spec_data as $key => $value)
                                    <tr class="hover:bg-blue-50 transition-colors duration-150 {{ $loop->parent->even ? 'bg-gray-25' : '' }}">
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full mr-4"></div>
                                                <div>
                                                    <div class="text-sm font-bold text-gray-900">{{ $key }}</div>
                                                    @if($index != 'general')
                                                        <div class="text-xs text-gray-500 mt-1 capitalize">{{ str_replace('_', ' ', $index) }} Category</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div class="text-sm font-semibold text-gray-900">{{ $value }}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr class="hover:bg-blue-50 transition-colors duration-150 {{ $loop->even ? 'bg-gray-25' : '' }}">
                                        <td class="px-8 py-6 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full mr-4"></div>
                                                <div class="text-sm font-bold text-gray-900">{{ $index }}</div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-6">
                                            <div class="text-sm font-semibold text-gray-900">{{ $spec_data }}</div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>                </div>
                
                <!-- Enhanced Footer Section -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 border-t border-gray-200 px-8 py-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-green-100 rounded-lg mb-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">Quality Assured</h4>
                            <p class="text-sm text-gray-600">All specifications tested and certified to international standards</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-100 rounded-lg mb-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">Technical Documentation</h4>
                            <p class="text-sm text-gray-600">Complete technical drawings and installation guides available</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-purple-100 rounded-lg mb-4">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">Custom Specifications</h4>
                            <p class="text-sm text-gray-600">Modified specifications available for special applications</p>
                        </div>
                    </div>
                    
                    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                        <button onclick="document.getElementById('inquiry-form').scrollIntoView({behavior: 'smooth'})" 
                                class="btn-primary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Request Complete Technical Package
                        </button>
                        
                        <a href="{{ route('contact') }}" class="btn-secondary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Technical Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif<!-- Additional Features & Applications -->    @if((!empty($features) && is_array($features)) || (!empty($applications) && is_array($applications)))
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Additional Features -->
                @if(!empty($features) && is_array($features))
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-8">Complete Feature Set</h3>
                    <div class="space-y-4">
                        @foreach($features as $feature)
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-6 h-6 bg-gradient-to-r from-green-400 to-green-500 rounded-full flex items-center justify-center">
                                    <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-700 font-medium">{{ $feature }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif                <!-- Applications -->
                @if(!empty($applications) && is_array($applications))
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-8">Ideal Applications</h3>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($applications as $application)
                        <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-4 rounded-lg border border-blue-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-blue-900 font-medium">{{ $application }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif<!-- Similar Products -->
    @if($similar_products && $similar_products->count() > 0)
    <div class="bg-gradient-to-r from-gray-50 to-blue-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Similar Products</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Explore our range of related valve solutions that might also meet your requirements.
                </p>
            </div>
            
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($similar_products as $similar_product)
                <div class="group relative card-hover bg-white">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden">
                        @if($similar_product->image)
                            <img src="{{ asset('storage/' . $similar_product->image) }}" 
                                 alt="{{ $similar_product->name }}" 
                                 class="w-full h-48 object-center object-cover group-hover:opacity-90 transition-opacity duration-300">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <svg class="h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Quick View Overlay -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                            <a href="{{ route('products.show', $similar_product->slug) }}" 
                               class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 btn-primary">
                                View Details
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">
                                    <a href="{{ route('products.show', $similar_product->slug) }}">
                                        {{ $similar_product->name }}
                                    </a>
                                </h3>
                                @if($similar_product->category)
                                <p class="mt-1 text-sm text-gray-500">{{ $similar_product->category->name }}</p>
                                @endif
                            </div>
                        </div>
                        
                        @if($similar_product->content)
                        <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                            {{ Str::limit(strip_tags($similar_product->content), 80) }}
                        </p>
                        @endif
                        
                        <div class="mt-4 flex items-center justify-between">
                            <a href="{{ route('products.show', $similar_product->slug) }}" 
                               class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                Learn More →
                            </a>
                            <button onclick="document.getElementById('inquiry-form').scrollIntoView({behavior: 'smooth'})" 
                                    class="text-gray-500 hover:text-gray-700 text-sm">
                                Get Quote
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- View All Products CTA -->
            <div class="text-center mt-12">
                <a href="{{ route('products.index') }}" class="btn-secondary">
                    View All Products
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0l-4 4m4-4l-4-4"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Popular Searches & Related Keywords -->
    <div class="bg-white py-16 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Popular Searches</h2>
                <p class="text-gray-600">
                    Explore related valve solutions and popular product categories
                </p>
            </div>
            
            <div class="flex flex-wrap justify-center gap-3">
                @php
                $popular_searches = [
                    'Ball Valves',
                    'Gate Valves', 
                    'Check Valves',
                    'Butterfly Valves',
                    'Globe Valves',
                    'Pressure Relief Valves',
                    'Control Valves',
                    'API 6D Valves',
                    'High Pressure Valves',
                    'Stainless Steel Valves'
                ];
                @endphp
                
                @foreach($popular_searches as $search)
                <a href="{{ route('products.index', ['search' => $search]) }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-blue-100 text-gray-700 hover:text-blue-700 rounded-full text-sm font-medium transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    {{ $search }}
                </a>
                @endforeach
            </div>
            
            <!-- Industry Links -->
            <div class="mt-8 text-center">
                <p class="text-gray-600 mb-4">Browse by Industry:</p>
                <div class="flex flex-wrap justify-center gap-3">
                    @php
                    $industries = [
                        'Oil & Gas' => 'oil-gas',
                        'Water Treatment' => 'water-treatment', 
                        'Power Generation' => 'power-generation',
                        'Chemical Processing' => 'chemical-processing',
                        'Marine & Offshore' => 'marine-offshore'
                    ];
                    @endphp
                    
                    @foreach($industries as $industry => $slug)
                    <a href="{{ route('industries') }}#{{ $slug }}" 
                       class="inline-flex items-center px-3 py-1 border border-gray-300 hover:border-blue-500 text-gray-600 hover:text-blue-600 rounded-full text-sm transition-colors duration-200">
                        {{ $industry }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Inquiry Form -->
    <div id="inquiry-form" class="stats-gradient text-white py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Get Your Custom Quote</h2>
                <p class="text-xl opacity-90 max-w-2xl mx-auto">
                    Ready to discuss your valve requirements? Our technical experts are here to help you find the perfect solution for your specific application.
                </p>
                
                <!-- Trust Indicators -->
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
                    <div class="flex items-center justify-center">
                        <svg class="w-6 h-6 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm">24-hour response guarantee</span>
                    </div>
                    <div class="flex items-center justify-center">
                        <svg class="w-6 h-6 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm">Free technical consultation</span>
                    </div>
                    <div class="flex items-center justify-center">
                        <svg class="w-6 h-6 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        <span class="text-sm">ISO certified quality</span>
                    </div>
                </div>
            </div>
              <div class="bg-white rounded-2xl shadow-2xl p-8">
                @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
                @endif
                
                @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-red-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h3 class="text-red-800 font-medium">Please correct the following errors:</h3>
                            <ul class="mt-2 list-disc list-inside text-red-700">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                
                <form action="{{ route('products.inquiry') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="subject" value="Quote Request for {{ $product->name }}">
                    
                    <!-- Personal Information -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name *
                            </label>
                            <input type="text" name="name" id="name" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                   placeholder="Enter your full name">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address *
                            </label>
                            <input type="email" name="email" id="email" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                   placeholder="your.email@company.com">
                        </div>
                    </div>
                    
                    <!-- Company Information -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number
                            </label>
                            <input type="tel" name="phone" id="phone" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                   placeholder="+1 (555) 123-4567">
                        </div>
                        <div>
                            <label for="company" class="block text-sm font-medium text-gray-700 mb-2">
                                Company Name
                            </label>
                            <input type="text" name="company" id="company" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                   placeholder="Your Company Name">
                        </div>
                    </div>
                    
                    <!-- Project Details -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            Project Requirements *
                        </label>
                        <textarea name="message" id="message" rows="5" required 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                  placeholder="Please describe your project requirements, including:
• Application details
• Required specifications
• Quantity needed
• Timeline requirements
• Any special considerations"></textarea>
                    </div>
                    
                    <!-- Additional Options -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Additional Information</h4>
                        <div class="space-y-3">
                            <label class="flex items-center">
                                <input type="checkbox" name="request_cad" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <span class="ml-3 text-sm text-gray-700">Request CAD drawings and technical documentation</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="urgent_quote" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <span class="ml-3 text-sm text-gray-700">This is an urgent request (expedited response)</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="newsletter" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <span class="ml-3 text-sm text-gray-700">Subscribe to our newsletter for product updates and industry insights</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-4 px-8 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            Send Quote Request
                        </button>
                        
                        <p class="mt-4 text-center text-sm text-gray-600">
                            By submitting this form, you agree to our 
                            <a href="#" class="text-blue-600 hover:text-blue-800">Privacy Policy</a> 
                            and 
                            <a href="#" class="text-blue-600 hover:text-blue-800">Terms of Service</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

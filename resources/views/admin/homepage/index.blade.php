@extends('admin.layouts.app')

@section('title', 'Homepage Management')

@section('header')
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Homepage Management</h1>
                    <p class="mt-1 text-sm text-gray-600">Manage all homepage sections and content</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ url('/') }}" target="_blank" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Preview Homepage
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-8">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Banners</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $stats['banners_count'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Products</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $stats['products_count'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Categories</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $stats['categories_count'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Industries</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $stats['industries_count'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Certifications</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $stats['certifications_count'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Clients</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $stats['clients_count'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Management Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- About Company Section -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">About Company Section</h3>
                <p class="mt-1 text-sm text-gray-600">Manage the about company section content and features</p>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.homepage.section.update', 'about_company') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-4">                        <div>
                            <label for="about_title" class="block text-sm font-medium text-gray-700">Section Title</label>
                            <input type="text" name="about_title" id="about_title" 
                                   value="{{ $sections['about_company']['title'] }}" 
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label for="about_content" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea name="about_content" id="about_content" rows="4" 
                                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $sections['about_company']['content'] }}</textarea>
                        </div>
                        
                        <!-- Features Section -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Features</label>
                            <div id="about-features-container">
                                @foreach($sections['about_company']['features'] as $index => $feature)
                                <div class="border border-gray-200 rounded-md p-4 mb-3 feature-item">                                    <div class="grid grid-cols-1 gap-3">
                                        <input type="text" name="about_features[{{ $index }}][title]" 
                                               value="{{ $feature['title'] ?? '' }}" 
                                               placeholder="Feature title" 
                                               class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <textarea name="about_features[{{ $index }}][description]" 
                                                  placeholder="Feature description" rows="2"
                                                  class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $feature['description'] ?? '' }}</textarea>
                                        <button type="button" onclick="removeFeature(this)" 
                                                class="text-red-600 hover:text-red-800 text-sm">Remove Feature</button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" onclick="addAboutFeature()" 
                                    class="mt-2 text-blue-600 hover:text-blue-800 text-sm">+ Add Feature</button>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Update About Section
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Why Choose Section -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Why Choose Section</h3>
                <p class="mt-1 text-sm text-gray-600">Manage the why choose K-Tech Valves section</p>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.homepage.section.update', 'why_choose') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-4">                        <div>
                            <label for="why_choose_title" class="block text-sm font-medium text-gray-700">Section Title</label>
                            <input type="text" name="why_choose_title" id="why_choose_title" 
                                   value="{{ $sections['why_choose']['title'] }}" 
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        
                        <div>
                            <label for="why_choose_subtitle" class="block text-sm font-medium text-gray-700">Subtitle</label>
                            <textarea name="why_choose_subtitle" id="why_choose_subtitle" rows="2" 
                                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $sections['why_choose']['subtitle'] }}</textarea>
                        </div>
                        
                        <!-- Points Section -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Why Choose Points</label>
                            <div id="why-choose-points-container">
                                @foreach($sections['why_choose']['points'] as $index => $point)
                                <div class="border border-gray-200 rounded-md p-4 mb-3 point-item">                                    <div class="grid grid-cols-1 gap-3">
                                        <input type="text" name="why_choose_points[{{ $index }}][title]" 
                                               value="{{ $point['title'] ?? '' }}" 
                                               placeholder="Point title" 
                                               class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <textarea name="why_choose_points[{{ $index }}][description]" 
                                                  placeholder="Point description" rows="2"
                                                  class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $point['description'] ?? '' }}</textarea>
                                        <input type="text" name="why_choose_points[{{ $index }}][icon]" 
                                               value="{{ $point['icon'] ?? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' }}" 
                                               placeholder="SVG path for icon" 
                                               class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-xs">
                                        <button type="button" onclick="removePoint(this)" 
                                                class="text-red-600 hover:text-red-800 text-sm">Remove Point</button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" onclick="addWhyChoosePoint()" 
                                    class="mt-2 text-blue-600 hover:text-blue-800 text-sm">+ Add Point</button>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Update Why Choose Section
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Quick Links Section -->
    <div class="mt-8 bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Quick Management Links</h3>
            <p class="mt-1 text-sm text-gray-600">Direct links to manage homepage content</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.banners.index') }}" 
                   class="flex items-center p-4 border border-gray-200 rounded-md hover:bg-gray-50 transition-colors duration-200">
                    <svg class="h-6 w-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-900">Manage Banners</span>
                </a>
                
                <a href="{{ route('admin.categories.index') }}" 
                   class="flex items-center p-4 border border-gray-200 rounded-md hover:bg-gray-50 transition-colors duration-200">
                    <svg class="h-6 w-6 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-900">Manage Categories</span>
                </a>
                
                <a href="{{ route('admin.products.index') }}" 
                   class="flex items-center p-4 border border-gray-200 rounded-md hover:bg-gray-50 transition-colors duration-200">
                    <svg class="h-6 w-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-900">Manage Products</span>
                </a>
                
                <a href="{{ route('admin.industries.index') }}" 
                   class="flex items-center p-4 border border-gray-200 rounded-md hover:bg-gray-50 transition-colors duration-200">
                    <svg class="h-6 w-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-900">Manage Industries</span>
                </a>
                
                <a href="{{ route('admin.certifications.index') }}" 
                   class="flex items-center p-4 border border-gray-200 rounded-md hover:bg-gray-50 transition-colors duration-200">
                    <svg class="h-6 w-6 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-900">Manage Certifications</span>
                </a>
                
                <a href="{{ route('admin.clients.index') }}" 
                   class="flex items-center p-4 border border-gray-200 rounded-md hover:bg-gray-50 transition-colors duration-200">
                    <svg class="h-6 w-6 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-900">Manage Clients</span>
                </a>
                
                <a href="{{ route('admin.settings.index') }}" 
                   class="flex items-center p-4 border border-gray-200 rounded-md hover:bg-gray-50 transition-colors duration-200">
                    <svg class="h-6 w-6 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c-.94 1.543.826 3.31 2.37 2.37a1.724 1.724 0 002.572 1.065c.426 1.756-1.756 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-900">Site Settings</span>
                </a>
                
                <a href="{{ route('admin.galleries.index') }}" 
                   class="flex items-center p-4 border border-gray-200 rounded-md hover:bg-gray-50 transition-colors duration-200">
                    <svg class="h-6 w-6 text-pink-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-900">Manage Gallery</span>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Add About Feature
function addAboutFeature() {
    const container = document.getElementById('about-features-container');
    const index = container.children.length;
    const featureHtml = `
        <div class="border border-gray-200 rounded-md p-4 mb-3 feature-item">
            <div class="grid grid-cols-1 gap-3">
                <input type="text" name="about_features[${index}][title]" 
                       placeholder="Feature title" 
                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <textarea name="about_features[${index}][description]" 
                          placeholder="Feature description" rows="2"
                          class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                <button type="button" onclick="removeFeature(this)" 
                        class="text-red-600 hover:text-red-800 text-sm">Remove Feature</button>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', featureHtml);
}

// Remove Feature
function removeFeature(button) {
    button.closest('.feature-item').remove();
}

// Add Why Choose Point
function addWhyChoosePoint() {
    const container = document.getElementById('why-choose-points-container');
    const index = container.children.length;
    const pointHtml = `
        <div class="border border-gray-200 rounded-md p-4 mb-3 point-item">
            <div class="grid grid-cols-1 gap-3">
                <input type="text" name="why_choose_points[${index}][title]" 
                       placeholder="Point title" 
                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <textarea name="why_choose_points[${index}][description]" 
                          placeholder="Point description" rows="2"
                          class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                <input type="text" name="why_choose_points[${index}][icon]" 
                       value="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" 
                       placeholder="SVG path for icon" 
                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-xs">
                <button type="button" onclick="removePoint(this)" 
                        class="text-red-600 hover:text-red-800 text-sm">Remove Point</button>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', pointHtml);
}

// Remove Point
function removePoint(button) {
    button.closest('.point-item').remove();
}
</script>
@endsection

@extends('admin.layouts.app')

@section('title', 'About Us Page Management')

@section('header')
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">About Us Page Management</h1>
                    <p class="mt-1 text-sm text-gray-600">Manage all about us page sections and content</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('about') }}" target="_blank" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Preview About Page
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
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Years Experience</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $stats['years_experience'] ?? 25 }}</dd>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Countries Served</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $stats['countries_served'] ?? 50 }}</dd>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Satisfied Clients</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $stats['satisfied_clients'] ?? 1000 }}+</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-6 py-5 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Hero Section</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Main banner content for the about us page</p>
        </div>
        <div class="px-6 py-5">
            <form action="{{ route('admin.about-page.section.update', 'hero') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-6">
                    @include('admin.partials.form-input', [
                        'name' => 'title',
                        'label' => 'Title',
                        'value' => $sections['hero']['title'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'subtitle',
                        'label' => 'Subtitle',
                        'type' => 'textarea',
                        'value' => $sections['hero']['subtitle'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'description',
                        'label' => 'Description',
                        'type' => 'textarea',
                        'value' => $sections['hero']['description'] ?? '',
                        'required' => true
                    ])                    @include('admin.partials.form-input', [
                        'name' => 'background_image',
                        'label' => 'Background Image',
                        'type' => 'file',
                        'accept' => 'image/*',
                        'help' => 'Upload a new background image (optional)'
                    ])

                    <!-- Current Background Image Preview -->
                    @if($sections['hero']['background_image'] ?? false)
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Background Image</label>
                            <div class="relative">
                                <img src="{{ asset('storage/' . $sections['hero']['background_image']) }}" 
                                     alt="Current Background" 
                                     class="w-full h-32 object-cover rounded-lg border border-gray-300">
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-600/70 to-blue-400/70 rounded-lg flex items-center justify-center">
                                    <p class="text-white font-semibold">Hero Background Preview</p>
                                </div>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">
                                File: {{ basename($sections['hero']['background_image']) }}
                            </p>
                        </div>
                    @else
                        <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <div class="flex">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        <strong>No background image uploaded.</strong> Upload an image to customize the hero section background.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Hero Section
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Mission & Vision Section -->
    <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-6 py-5 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Mission & Vision</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Company mission and vision statements</p>
        </div>
        <div class="px-6 py-5">
            <form action="{{ route('admin.about-page.section.update', 'mission-vision') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-6">
                    @include('admin.partials.form-input', [
                        'name' => 'mission_title',
                        'label' => 'Mission Title',
                        'value' => $sections['mission_vision']['mission_title'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'mission_description',
                        'label' => 'Mission Description',
                        'type' => 'textarea',
                        'value' => $sections['mission_vision']['mission_description'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'vision_title',
                        'label' => 'Vision Title',
                        'value' => $sections['mission_vision']['vision_title'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'vision_description',
                        'label' => 'Vision Description',
                        'type' => 'textarea',
                        'value' => $sections['mission_vision']['vision_description'] ?? '',
                        'required' => true
                    ])
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Mission & Vision
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Company History Section -->
    <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-6 py-5 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Company History</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Company history and milestones</p>
        </div>
        <div class="px-6 py-5">
            <form action="{{ route('admin.about-page.section.update', 'history') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-6">
                    @include('admin.partials.form-input', [
                        'name' => 'title',
                        'label' => 'Section Title',
                        'value' => $sections['history']['title'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'description',
                        'label' => 'History Description',
                        'type' => 'textarea',
                        'value' => $sections['history']['description'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'founded_year',
                        'label' => 'Founded Year',
                        'type' => 'number',
                        'value' => $sections['history']['founded_year'] ?? '',
                        'required' => true
                    ])
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Company History
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Company Values Section -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-5 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Company Values</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Core values and principles</p>
        </div>
        <div class="px-6 py-5">
            <form action="{{ route('admin.about-page.section.update', 'values') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-6">
                    @include('admin.partials.form-input', [
                        'name' => 'title',
                        'label' => 'Section Title',
                        'value' => $sections['values']['title'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'description',
                        'label' => 'Values Description',
                        'type' => 'textarea',
                        'value' => $sections['values']['description'] ?? '',
                        'required' => true
                    ])

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @include('admin.partials.form-input', [
                            'name' => 'value_1_title',
                            'label' => 'Value 1 Title',
                            'value' => $sections['values']['value_1_title'] ?? '',
                            'required' => true
                        ])

                        @include('admin.partials.form-input', [
                            'name' => 'value_1_description',
                            'label' => 'Value 1 Description',
                            'type' => 'textarea',
                            'value' => $sections['values']['value_1_description'] ?? '',
                            'required' => true
                        ])

                        @include('admin.partials.form-input', [
                            'name' => 'value_2_title',
                            'label' => 'Value 2 Title',
                            'value' => $sections['values']['value_2_title'] ?? '',
                            'required' => true
                        ])

                        @include('admin.partials.form-input', [
                            'name' => 'value_2_description',
                            'label' => 'Value 2 Description',
                            'type' => 'textarea',
                            'value' => $sections['values']['value_2_description'] ?? '',
                            'required' => true
                        ])

                        @include('admin.partials.form-input', [
                            'name' => 'value_3_title',
                            'label' => 'Value 3 Title',
                            'value' => $sections['values']['value_3_title'] ?? '',
                            'required' => true
                        ])

                        @include('admin.partials.form-input', [
                            'name' => 'value_3_description',
                            'label' => 'Value 3 Description',
                            'type' => 'textarea',
                            'value' => $sections['values']['value_3_description'] ?? '',
                            'required' => true
                        ])
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Company Values
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

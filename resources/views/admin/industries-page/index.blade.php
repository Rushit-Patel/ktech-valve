@extends('admin.layouts.app')

@section('title', 'Industries Page Management')

@section('content')
<div class="space-y-6">
    <div class="md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Industries Page Management
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Customize the content and settings for the Industries page
            </p>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="rounded-md bg-green-50 p-4 border border-green-200">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <!-- Hero Section -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Hero Section</h3>
                <p class="mt-1 text-sm text-gray-500">Main banner area of the industries page</p>
            </div>

            <form action="{{ route('admin.industries-page.section.update', 'hero') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
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
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'background_image',
                        'label' => 'Background Image',
                        'type' => 'file',
                        'accept' => 'image/*',
                        'help' => 'Upload a new background image (optional)'
                    ])
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Hero Section
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Introduction Section -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Introduction Section</h3>
                <p class="mt-1 text-sm text-gray-500">Introduction content about industries</p>
            </div>

            <form action="{{ route('admin.industries-page.section.update', 'intro') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    @include('admin.partials.form-input', [
                        'name' => 'title',
                        'label' => 'Section Title',
                        'value' => $sections['intro']['title'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'description',
                        'label' => 'Description',
                        'type' => 'textarea',
                        'value' => $sections['intro']['description'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'highlight_text',
                        'label' => 'Highlight Text',
                        'value' => $sections['intro']['highlight_text'] ?? '',
                        'help' => 'Text that will be highlighted or emphasized'
                    ])
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Introduction
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Expertise Section -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Expertise Section</h3>
                <p class="mt-1 text-sm text-gray-500">Showcase company expertise and capabilities</p>
            </div>

            <form action="{{ route('admin.industries-page.section.update', 'expertise') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    @include('admin.partials.form-input', [
                        'name' => 'title',
                        'label' => 'Section Title',
                        'value' => $sections['expertise']['title'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'description',
                        'label' => 'Description',
                        'type' => 'textarea',
                        'value' => $sections['expertise']['description'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'feature_1_title',
                        'label' => 'Feature 1 Title',
                        'value' => $sections['expertise']['feature_1_title'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'feature_1_description',
                        'label' => 'Feature 1 Description',
                        'type' => 'textarea',
                        'value' => $sections['expertise']['feature_1_description'] ?? ''
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'feature_2_title',
                        'label' => 'Feature 2 Title',
                        'value' => $sections['expertise']['feature_2_title'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'feature_2_description',
                        'label' => 'Feature 2 Description',
                        'type' => 'textarea',
                        'value' => $sections['expertise']['feature_2_description'] ?? ''
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'feature_3_title',
                        'label' => 'Feature 3 Title',
                        'value' => $sections['expertise']['feature_3_title'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'feature_3_description',
                        'label' => 'Feature 3 Description',
                        'type' => 'textarea',
                        'value' => $sections['expertise']['feature_3_description'] ?? ''
                    ])
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Expertise Section
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Industries Stats -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Industries Statistics</h3>
                <p class="mt-1 text-sm text-gray-500">Current industries statistics</p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">
                <div class="bg-gray-50 px-4 py-5 sm:p-6 rounded-lg">
                    <dt class="text-sm font-medium text-gray-500 truncate">Total Industries</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['total_industries'] }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:p-6 rounded-lg">
                    <dt class="text-sm font-medium text-gray-500 truncate">Featured Industries</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['featured_count'] }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:p-6 rounded-lg">
                    <dt class="text-sm font-medium text-gray-500 truncate">Years Experience</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['years_experience'] }}+</dd>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.industries.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Manage Industries
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

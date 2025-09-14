@extends('admin.layouts.app')

@section('title', 'Gallery Page Management')

@section('content')
<div class="space-y-6">
    <div class="md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Gallery Page Management
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Customize the content and settings for the Gallery page
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
                <p class="mt-1 text-sm text-gray-500">Main banner area of the gallery page</p>
            </div>

            <form action="{{ route('admin.gallery-page.section.update', 'hero') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label for="gallery_hero_title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="gallery_hero_title" id="gallery_hero_title" 
                               value="{{ $sections['hero']['title'] }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="gallery_hero_subtitle" class="block text-sm font-medium text-gray-700">Subtitle</label>
                        <textarea name="gallery_hero_subtitle" id="gallery_hero_subtitle" rows="3" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ $sections['hero']['subtitle'] }}</textarea>
                    </div>

                    <div>
                        <label for="gallery_hero_background" class="block text-sm font-medium text-gray-700">Background Image URL</label>
                        <input type="text" name="gallery_hero_background" id="gallery_hero_background" 
                               value="{{ $sections['hero']['background_image'] }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                               placeholder="Enter image URL or upload below">
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Hero Section
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Gallery Settings -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Gallery Settings</h3>
                <p class="mt-1 text-sm text-gray-500">Configure gallery display options</p>
            </div>

            <form action="{{ route('admin.gallery-page.section.update', 'settings') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label for="gallery_images_per_page" class="block text-sm font-medium text-gray-700">Images Per Page</label>
                        <select name="gallery_images_per_page" id="gallery_images_per_page" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            @foreach([6, 9, 12, 15, 18, 24] as $count)
                                <option value="{{ $count }}" {{ $sections['settings']['images_per_page'] == $count ? 'selected' : '' }}>
                                    {{ $count }} images
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" name="gallery_show_categories" id="gallery_show_categories" 
                                   {{ $sections['settings']['show_categories'] ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="gallery_show_categories" class="ml-2 block text-sm text-gray-900">
                                Show category filter
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="gallery_enable_lightbox" id="gallery_enable_lightbox" 
                                   {{ $sections['settings']['enable_lightbox'] ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="gallery_enable_lightbox" class="ml-2 block text-sm text-gray-900">
                                Enable lightbox popup
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="gallery_show_image_info" id="gallery_show_image_info" 
                                   {{ $sections['settings']['show_image_info'] ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="gallery_show_image_info" class="ml-2 block text-sm text-gray-900">
                                Show image information
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Settings
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Gallery Stats -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Gallery Statistics</h3>
                <p class="mt-1 text-sm text-gray-500">Current gallery statistics</p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">
                <div class="bg-gray-50 px-4 py-5 sm:p-6 rounded-lg">
                    <dt class="text-sm font-medium text-gray-500 truncate">Total Images</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['total_images'] }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:p-6 rounded-lg">
                    <dt class="text-sm font-medium text-gray-500 truncate">Categories</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['categories_count'] }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:p-6 rounded-lg">
                    <dt class="text-sm font-medium text-gray-500 truncate">Featured Images</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['featured_count'] }}</dd>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.galleries.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Manage Gallery Images
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

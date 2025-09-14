@extends('admin.layouts.app')

@section('title', 'Edit Gallery Item')

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Gallery Item</h1>
            <p class="mt-1 text-sm text-gray-600">Update gallery image and information.</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.galleries.show', $gallery) }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                View
            </a>
            <a href="{{ route('admin.galleries.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Gallery
            </a>
        </div>
    </div>
</div>

<div class="max-w-3xl">
    <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl">
            <div class="p-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Title -->
                    <div class="sm:col-span-2">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title *</label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   value="{{ old('title', $gallery->title) }}"
                                   required
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                   placeholder="e.g., Manufacturing Facility - Mumbai">
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Current Image -->
                    @if($gallery->image)
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Current Image</label>
                        <div class="mt-2">
                            <div class="relative bg-gray-50 rounded-lg border border-gray-200 p-3">
                                <img src="{{ Storage::url($gallery->image) }}" 
                                     alt="{{ $gallery->alt_text ?: $gallery->title }}" 
                                     class="w-full h-48 object-cover rounded-lg">
                                <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-20 transition-opacity duration-200 rounded-lg flex items-center justify-center">
                                    <a href="{{ Storage::url($gallery->image) }}" 
                                       target="_blank"
                                       class="opacity-0 hover:opacity-100 bg-white text-gray-900 px-3 py-1 rounded-md text-sm font-medium shadow-lg transition-opacity duration-200">
                                        View Full Size
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Image -->
                    <div class="sm:col-span-2">
                        <label for="image" class="block text-sm font-medium leading-6 text-gray-900">
                            {{ $gallery->image ? 'Replace Image' : 'Image *' }}
                        </label>
                        <div class="mt-2">
                            <input type="file" 
                                   name="image" 
                                   id="image"
                                   accept=".jpg,.jpeg,.png,.webp"
                                   {{ !$gallery->image ? 'required' : '' }}
                                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            @error('image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">
                                {{ $gallery->image ? 'Upload a new image to replace the current one. ' : '' }}Upload JPG, PNG, or WebP file (max 10MB). Recommended: 1200x800px or higher
                            </p>
                        </div>
                    </div>

                    <!-- Alt Text -->
                    <div class="sm:col-span-2">
                        <label for="alt_text" class="block text-sm font-medium leading-6 text-gray-900">Alt Text</label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="alt_text" 
                                   id="alt_text" 
                                   value="{{ old('alt_text', $gallery->alt_text) }}"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                   placeholder="Descriptive text for screen readers and SEO">
                            @error('alt_text')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Important for accessibility and SEO</p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="sm:col-span-2">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea name="description" 
                                      id="description" 
                                      rows="4"
                                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                      placeholder="Detailed description of the image or project...">{{ old('description', $gallery->description) }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="sm:col-span-2">
                        <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                        <div class="mt-2">
                            <select name="category" 
                                    id="category"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                <option value="">Select Category</option>
                                <option value="facilities" {{ old('category', $gallery->category) == 'facilities' ? 'selected' : '' }}>Facilities</option>
                                <option value="products" {{ old('category', $gallery->category) == 'products' ? 'selected' : '' }}>Products</option>
                                <option value="projects" {{ old('category', $gallery->category) == 'projects' ? 'selected' : '' }}>Projects</option>
                                <option value="team" {{ old('category', $gallery->category) == 'team' ? 'selected' : '' }}>Team</option>
                                <option value="events" {{ old('category', $gallery->category) == 'events' ? 'selected' : '' }}>Events</option>
                                <option value="certifications" {{ old('category', $gallery->category) == 'certifications' ? 'selected' : '' }}>Certifications</option>
                                <option value="other" {{ old('category', $gallery->category) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('category')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Featured -->
                    <div>
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   name="is_featured" 
                                   id="is_featured"
                                   value="1"
                                   {{ old('is_featured', $gallery->is_featured) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="is_featured" class="ml-2 block text-sm text-gray-900">
                                Featured Image
                            </label>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Featured images are highlighted on the homepage</p>
                        @error('is_featured')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="is_active" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                        <div class="mt-2">
                            <select name="is_active" 
                                    id="is_active"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                <option value="1" {{ old('is_active', $gallery->is_active) == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active', $gallery->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('is_active')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Sort Order -->
                    <div class="sm:col-span-2">
                        <label for="sort_order" class="block text-sm font-medium leading-6 text-gray-900">Sort Order</label>
                        <div class="mt-2">
                            <input type="number" 
                                   name="sort_order" 
                                   id="sort_order" 
                                   value="{{ old('sort_order', $gallery->sort_order) }}"
                                   min="0"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                            @error('sort_order')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Lower numbers appear first</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-x-6 pt-6">
            <a href="{{ route('admin.galleries.index') }}" 
               class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700">
                Cancel
            </a>
            <button type="submit" 
                    class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                Update Gallery Item
            </button>
        </div>
    </form>
</div>
@endsection

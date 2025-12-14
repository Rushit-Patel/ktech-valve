@extends('admin.layouts.app')

@section('title', 'Edit Banner')

@section('content')
<!-- Header Section -->
<div class="mb-6 sm:mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Edit Banner</h1>
            <p class="mt-1 text-sm text-gray-600">Update banner information and settings.</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('admin.banners.show', $banner) }}" 
               class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                View Banner
            </a>
            <a href="{{ route('admin.banners.index') }}" 
               class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Banners
            </a>
        </div>
    </div>
</div>

<!-- Form Container -->
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Basic Information Section -->
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl">
            <div class="px-4 py-5 sm:p-6">
                <div class="pb-5 border-b border-gray-200 mb-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Basic Information</h3>
                    <p class="mt-1 text-sm text-gray-500">Update the banner's basic details and content.</p>
                </div>
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Title -->
                    <div class="sm:col-span-2">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   value="{{ old('title', $banner->title) }}"
                                   required
                                   class="block w-full rounded-lg border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-colors duration-200"
                                   placeholder="e.g., Premium Quality Valves">
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Subtitle -->
                    <div class="sm:col-span-2">
                        <label for="subtitle" class="block text-sm font-medium leading-6 text-gray-900">Subtitle</label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="subtitle" 
                                   id="subtitle" 
                                   value="{{ old('subtitle', $banner->subtitle) }}"
                                   class="block w-full rounded-lg border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-colors duration-200"
                                   placeholder="e.g., Engineering Excellence">
                            @error('subtitle')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="sm:col-span-2">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea name="description" 
                                      id="description" 
                                      rows="3"
                                      class="block w-full rounded-lg border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-colors duration-200"
                                      placeholder="Brief description for SEO and metadata...">{{ old('description', $banner->description) }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="sm:col-span-2">
                        <label for="content" class="block text-sm font-medium leading-6 text-gray-900">Content</label>
                        <div class="mt-2">
                            <textarea name="content" 
                                      id="content" 
                                      rows="4"
                                      class="block w-full rounded-lg border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-colors duration-200"
                                      placeholder="Main content text that will be displayed on the slider...">{{ old('content', $banner->content) }}</textarea>
                            @error('content')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-500">This text will be displayed below the title on the homepage slider</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Banner Image Section -->
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl">
            <div class="px-4 py-5 sm:p-6">
                <div class="pb-5 border-b border-gray-200 mb-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Banner Image</h3>
                    <p class="mt-1 text-sm text-gray-500">Upload or replace the banner image.</p>
                </div>

                <!-- Current Banner Image -->
                @if($banner->image)
                <div class="mb-6">
                    <label class="block text-sm font-medium leading-6 text-gray-900 mb-3">Current Banner Image</label>
                    <div class="relative p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="flex items-start space-x-4">
                            <img src="{{ Storage::url($banner->image) }}" 
                                 alt="{{ $banner->title }}" 
                                 class="h-24 w-auto max-w-48 object-cover bg-white rounded-lg border shadow-sm">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">{{ $banner->title }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ basename($banner->image) }}</p>
                                <div class="flex items-center mt-2 text-xs text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Upload a new image to replace this one
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif                <!-- New Image Upload -->
                <div>
                    <label for="image" class="block text-sm font-medium leading-6 text-gray-900 mb-3">
                        {{ $banner->image ? 'Replace Banner Image' : 'Banner Image' }}
                        @if(!$banner->image)<span class="text-red-500">*</span>@endif
                    </label>
                    
                    <!-- Image Upload Drop Zone -->
                    <div id="imageDropZone" class="relative">
                        <div class="flex justify-center px-6 pt-8 pb-8 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition-all duration-200 bg-gray-50 hover:bg-blue-50 cursor-pointer">
                            <div class="space-y-3 text-center">
                                <div id="uploadIcon" class="mx-auto">
                                    <svg class="h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                
                                <!-- Upload Content -->
                                <div id="uploadContent">
                                    <div class="flex text-sm text-gray-600 justify-center items-center">
                                        <label for="image" class="relative cursor-pointer bg-transparent rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 px-2 py-1">
                                            <span>Choose file</span>
                                            <input id="image" name="image" type="file" class="sr-only" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" {{ !$banner->image ? 'required' : '' }}>
                                        </label>
                                        <span class="text-gray-500">or drag and drop here</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">JPG, PNG, JPEG, GIF, WEBP up to 5MB</p>
                                    <p class="text-xs text-gray-400 mt-1">Recommended size: 1920x800px for best results</p>
                                </div>
                                
                                <!-- Loading State -->
                                <div id="uploadLoading" class="hidden">
                                    <div class="inline-flex items-center px-4 py-2 text-sm text-blue-600">
                                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Processing image...
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Image Preview -->
                        <div id="imagePreview" class="hidden mt-4">
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="flex items-start space-x-4">
                                    <img id="previewImg" class="h-20 w-auto max-w-32 object-cover bg-white rounded border shadow-sm">
                                    <div class="flex-1 min-w-0">
                                        <p id="fileName" class="text-sm font-medium text-gray-900"></p>
                                        <p id="fileSize" class="text-xs text-gray-500 mt-1"></p>
                                        <button type="button" onclick="clearPreview()" class="mt-2 text-xs text-red-600 hover:text-red-800 font-medium">
                                            Remove selected image
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <!-- Button & Settings Section -->
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl">
            <div class="px-4 py-5 sm:p-6">
                <div class="pb-5 border-b border-gray-200 mb-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Button & Display Settings</h3>
                    <p class="mt-1 text-sm text-gray-500">Configure button actions and banner visibility settings.</p>
                </div>
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Button Text -->
                    <div>
                        <label for="button_text" class="block text-sm font-medium leading-6 text-gray-900">Button Text</label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="button_text" 
                                   id="button_text" 
                                   value="{{ old('button_text', $banner->button_text) }}"
                                   class="block w-full rounded-lg border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-colors duration-200"
                                   placeholder="e.g., Explore Products">
                            @error('button_text')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Button Link -->
                    <div>
                        <label for="button_link" class="block text-sm font-medium leading-6 text-gray-900">Button Link</label>
                        <div class="mt-2">
                            <input type="url" 
                                   name="button_link" 
                                   id="button_link" 
                                   value="{{ old('button_link', $banner->button_link) }}"
                                   class="block w-full rounded-lg border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-colors duration-200"
                                   placeholder="https://www.example.com/products">
                            @error('button_link')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="is_active" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                        <div class="mt-2">
                            <select name="is_active" 
                                    id="is_active"
                                    class="block w-full rounded-lg border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-colors duration-200">
                                <option value="1" {{ old('is_active', $banner->is_active) == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active', $banner->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('is_active')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <label for="sort_order" class="block text-sm font-medium leading-6 text-gray-900">Sort Order</label>
                        <div class="mt-2">
                            <input type="number" 
                                   name="sort_order" 
                                   id="sort_order" 
                                   value="{{ old('sort_order', $banner->sort_order) }}"
                                   min="0"
                                   class="block w-full rounded-lg border-0 py-2.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 transition-colors duration-200">
                            @error('sort_order')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-500">Lower numbers appear first in the slider</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 pt-6 pb-4">
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.banners.index') }}" 
                   class="inline-flex items-center justify-center px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Back to Banners
                </a>
                <a href="{{ route('admin.banners.show', $banner) }}" 
                   class="inline-flex items-center justify-center px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Preview Banner
                </a>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <button type="button" 
                        onclick="window.history.back()"
                        class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors duration-200">
                    Cancel
                </button>
                <button type="submit" 
                        class="inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 rounded-lg text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition-all duration-200">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0120.25 6v12A2.25 2.25 0 0118 20.25H6A2.25 2.25 0 013.75 18V6A2.25 2.25 0 016 3.75h1.5m9 0h-9" />
                    </svg>
                    Update Banner
                </button>
            </div>
        </div>    </form>
</div>

<script>
// Enhanced Image Upload Functionality
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const dropZone = document.getElementById('imageDropZone');
    const uploadContent = document.getElementById('uploadContent');
    const uploadLoading = document.getElementById('uploadLoading');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const uploadIcon = document.getElementById('uploadIcon');
    
    // File constraints
    const maxFileSize = 5 * 1024 * 1024; // 5MB
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    
    // Drag and drop handlers
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    // Highlight drop area when item is dragged over
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });
    
    function highlight() {
        dropZone.classList.add('border-blue-400', 'bg-blue-50');
    }
    
    function unhighlight() {
        dropZone.classList.remove('border-blue-400', 'bg-blue-50');
    }
    
    // Handle dropped files
    dropZone.addEventListener('drop', handleDrop, false);
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        if (files.length > 0) {
            handleFiles(files[0]);
        }
    }
    
    // Handle input change
    imageInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            handleFiles(e.target.files[0]);
        }
    });
    
    // Process uploaded file
    function handleFiles(file) {
        if (!validateFile(file)) return;
        
        showLoading();
        
        const reader = new FileReader();
        reader.onload = function(e) {
            showPreview(e.target.result, file);
            hideLoading();
        };
        
        reader.onerror = function() {
            showError('Error reading file. Please try again.');
            hideLoading();
        };
        
        reader.readAsDataURL(file);
        
        // Update file input
        const dt = new DataTransfer();
        dt.items.add(file);
        imageInput.files = dt.files;
    }
    
    function validateFile(file) {
        // Check file type
        if (!allowedTypes.includes(file.type)) {
            showError('Invalid file type. Please upload a JPEG, PNG, JPG, GIF, or WEBP image.');
            return false;
        }
        
        // Check file size
        if (file.size > maxFileSize) {
            showError('File size too large. Please upload an image smaller than 5MB.');
            return false;
        }
        
        return true;
    }
    
    function showPreview(src, file) {
        if (previewImg && fileName && fileSize) {
            previewImg.src = src;
            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);
            
            uploadContent.classList.add('hidden');
            uploadIcon.classList.add('hidden');
            imagePreview.classList.remove('hidden');
        }
    }
    
    function showLoading() {
        if (uploadLoading && uploadContent) {
            uploadContent.classList.add('hidden');
            uploadLoading.classList.remove('hidden');
        }
    }
    
    function hideLoading() {
        if (uploadLoading && uploadContent) {
            uploadLoading.classList.add('hidden');
            uploadContent.classList.remove('hidden');
        }
    }
    
    function showError(message) {
        alert(message); // Simple alert for now, can be enhanced with toast notifications
        resetUpload();
    }
    
    function resetUpload() {
        if (imageInput) imageInput.value = '';
        hideLoading();
        if (imagePreview) {
            imagePreview.classList.add('hidden');
            uploadContent.classList.remove('hidden');
            uploadIcon.classList.remove('hidden');
        }
    }
    
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
    
    // Clear preview function (global for onclick)
    window.clearPreview = function() {
        resetUpload();
    };
});
    
    // Allowed file types
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
    
    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });
    
    // Highlight drop zone when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });
    
    // Handle dropped files
    dropZone.addEventListener('drop', handleDrop, false);
    
    // Handle file input change
    imageInput.addEventListener('change', function() {
        handleFiles(this.files);
    });
    
    // Remove preview functionality
    removePreview.addEventListener('click', function() {
        clearPreview();
        imageInput.value = '';
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    function highlight(e) {
        dropZone.classList.add('border-blue-400', 'bg-blue-50');
        dropZone.classList.remove('border-gray-300', 'bg-gray-50');
    }
    
    function unhighlight(e) {
        dropZone.classList.remove('border-blue-400', 'bg-blue-50');
        dropZone.classList.add('border-gray-300', 'bg-gray-50');
    }
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }
    
    function handleFiles(files) {
        if (files.length === 0) return;
        
        const file = files[0];
        
        // Hide error message
        hideError();
        
        // Validate file
        if (!validateFile(file)) return;
        
        // Show loading state
        showLoading();
        
        // Create file reader
        const reader = new FileReader();
        
        reader.onload = function(e) {
            showPreview(e.target.result, file);
            hideLoading();
        };
        
        reader.onerror = function() {
            showError('Error reading file. Please try again.');
            hideLoading();
        };
        
        reader.readAsDataURL(file);
        
        // Update file input
        const dt = new DataTransfer();
        dt.items.add(file);
        imageInput.files = dt.files;
    }
    
    function validateFile(file) {
        // Check file type
        if (!allowedTypes.includes(file.type)) {
            showError('Invalid file type. Please upload a JPEG, PNG, JPG, GIF, or WEBP image.');
            return false;
        }
        
        // Check file size
        if (file.size > maxFileSize) {
            showError('File size too large. Please upload an image smaller than 5MB.');
            return false;
        }
        
        return true;
    }
    
    function showPreview(src, file) {
        previewImg.src = src;
        fileName.textContent = file.name;
        fileSize.textContent = formatFileSize(file.size);
        
        uploadContent.classList.add('hidden');
        imagePreview.classList.remove('hidden');
    }
    
    function clearPreview() {
        uploadContent.classList.remove('hidden');
        imagePreview.classList.add('hidden');
        previewImg.src = '';
        fileName.textContent = '';
        fileSize.textContent = '';
    }
    
    function showLoading() {
        uploadContent.classList.add('hidden');
        uploadLoading.classList.remove('hidden');
    }
    
    function hideLoading() {
        uploadLoading.classList.add('hidden');
    }
    
    function showError(message) {
        errorMessage.textContent = message;
        uploadError.classList.remove('hidden');
        clearPreview();
    }
    
    function hideError() {
        uploadError.classList.add('hidden');
    }
    
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
});
</script>
@endsection

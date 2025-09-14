@extends('admin.layouts.app')

@section('title', 'Add New Banner')

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Add New Banner</h1>
            <p class="mt-1 text-sm text-gray-600">Create a new banner for the homepage slider.</p>
        </div>
        <a href="{{ route('admin.banners.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Back to Banners
        </a>
    </div>
</div>

<div class="max-w-3xl">
    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl">
            <div class="p-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">                    <!-- Title -->
                    <div class="sm:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title') }}"
                               required
                               class="w-full px-3 py-2 border @error('title') border-red-300 @else border-gray-300 @enderror rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="e.g., Premium Quality Valves">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subtitle -->
                    <div class="sm:col-span-2">
                        <label for="subtitle" class="block text-sm font-medium leading-6 text-gray-900">Subtitle</label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="subtitle" 
                                   id="subtitle" 
                                   value="{{ old('subtitle') }}"
                                   class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
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
                                      class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                      placeholder="Brief description for SEO and metadata...">{{ old('description') }}</textarea>
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
                                      class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                      placeholder="Main content text that will be displayed on the slider...">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">This text will be displayed below the title on the homepage slider</p>
                        </div>
                    </div>                    <!-- Banner Image -->
                    <div class="sm:col-span-2">
                        <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Banner Image *</label>
                        
                        <!-- Image Upload Drop Zone -->
                        <div id="imageDropZone" class="relative mt-2">
                            <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition-all duration-200 bg-gray-50 hover:bg-blue-50">
                                <div class="space-y-2 text-center">
                                    <div id="uploadIcon" class="mx-auto">
                                        <svg class="h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    
                                    <!-- Upload Content -->
                                    <div id="uploadContent">
                                        <div class="flex text-sm text-gray-600 justify-center">
                                            <label for="image" class="relative cursor-pointer bg-transparent rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 px-2">
                                                <span>Choose file</span>
                                                <input id="image" name="image" type="file" class="sr-only" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" required>
                                            </label>
                                            <p class="pl-1">or drag and drop here</p>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">JPG, PNG, JPEG, GIF, WEBP up to 5MB</p>
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
                                <div class="relative inline-block">
                                    <img id="previewImg" src="" alt="Preview" class="max-w-full h-40 object-cover rounded-lg border border-gray-200 shadow-sm">
                                    <button type="button" id="removePreview" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="mt-2">
                                    <p id="fileName" class="text-sm text-gray-600"></p>
                                    <p id="fileSize" class="text-xs text-gray-500"></p>
                                </div>
                            </div>
                            
                            <!-- Error Message -->
                            <div id="uploadError" class="hidden mt-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                                <div class="flex">
                                    <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p id="errorMessage" class="ml-2 text-sm text-red-600"></p>
                                </div>
                            </div>
                        </div>
                        
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        
                        <!-- Image Requirements -->
                        <div class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <h4 class="text-sm font-medium text-blue-800 mb-2">Image Requirements:</h4>
                            <ul class="text-xs text-blue-700 space-y-1">
                                <li>• Maximum file size: 5MB</li>
                                <li>• Supported formats: JPEG, PNG, JPG, GIF, WEBP</li>
                                <li>• Recommended dimensions: 1920x1080 pixels for best quality</li>
                                <li>• The image will be displayed as a banner on the homepage slider</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Button Text -->
                    <div>
                        <label for="button_text" class="block text-sm font-medium leading-6 text-gray-900">Button Text</label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="button_text" 
                                   id="button_text" 
                                   value="{{ old('button_text') }}"
                                   class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
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
                                   value="{{ old('button_link') }}"
                                   class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
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
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
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
                                   value="{{ old('sort_order', 0) }}"
                                   min="0"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                            @error('sort_order')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Lower numbers appear first in the slider</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-x-6 pt-6">
            <a href="{{ route('admin.banners.index') }}" 
               class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700">
                Cancel
            </a>
            <button type="submit" 
                    class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                Create Banner
            </button>
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
    const removePreview = document.getElementById('removePreview');
    const uploadError = document.getElementById('uploadError');
    const errorMessage = document.getElementById('errorMessage');
    
    // File size limit (5MB)
    const maxFileSize = 5 * 1024 * 1024;
    
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

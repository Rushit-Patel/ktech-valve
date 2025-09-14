@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Edit Category</h1>
            <p class="mt-1 text-sm text-gray-600">Update category information and settings.</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Categories
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
            <input type="text" 
                   id="name" 
                   name="name" 
                   value="{{ old('name', $category->name) }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 @enderror"
                   placeholder="Enter category name"
                   required>
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Slug -->
        <div>
            <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">URL Slug</label>
            <input type="text" 
                   id="slug" 
                   name="slug" 
                   value="{{ old('slug', $category->slug) }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('slug') border-red-300 @enderror"
                   placeholder="category-url-slug">
            @error('slug')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-1 text-sm text-gray-500">Leave blank to auto-generate from name.</p>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea id="description" 
                      name="description" 
                      rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-300 @enderror"
                      placeholder="Enter category description">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Parent Category -->
        <div>
            <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-2">Parent Category</label>
            <select id="parent_id" 
                    name="parent_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('parent_id') border-red-300 @enderror">
                <option value="">No Parent (Top Level Category)</option>
                @foreach($categories as $cat)
                    @if($cat->id !== $category->id)
                        <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endif
                @endforeach
            </select>
            @error('parent_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Current Image -->
        @if($category->image)
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
            <div class="flex items-center space-x-4">
                <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                <div>
                    <p class="text-sm text-gray-600">{{ basename($category->image) }}</p>
                    <label class="flex items-center mt-2">
                        <input type="checkbox" name="remove_image" value="1" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-red-600">Remove current image</span>
                    </label>
                </div>
            </div>
        </div>
        @endif        <!-- New Image -->
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                {{ $category->image ? 'Replace Image' : 'Category Image' }}
            </label>
            
            <!-- Image Upload Drop Zone -->
            <div id="imageDropZone" class="relative">
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition-all duration-200 bg-gray-50 hover:bg-blue-50">
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
                                    <input id="image" name="image" type="file" class="sr-only" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                                </label>
                                <p class="pl-1">or drag and drop here</p>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG, GIF, WEBP up to 2MB</p>
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
                        <img id="previewImg" src="" alt="Preview" class="max-w-full h-32 object-cover rounded-lg border border-gray-200 shadow-sm">
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
                
                <!-- Upload Progress -->
                <div id="uploadProgress" class="hidden mt-4">
                    <div class="bg-gray-200 rounded-full h-2">
                        <div id="progressBar" class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">Uploading... <span id="progressText">0%</span></p>
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
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            
            <!-- Image Requirements -->
            <div class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                <h4 class="text-sm font-medium text-blue-800 mb-2">Image Requirements:</h4>
                <ul class="text-xs text-blue-700 space-y-1">
                    <li>• Maximum file size: 2MB</li>
                    <li>• Supported formats: JPEG, PNG, JPG, GIF, WEBP</li>
                    <li>• Recommended dimensions: 800x600 pixels or higher</li>
                    <li>• The image will be automatically optimized for web display</li>
                </ul>
            </div>
        </div>

        <!-- Sort Order -->
        <div>
            <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
            <input type="number" 
                   id="sort_order" 
                   name="sort_order" 
                   value="{{ old('sort_order', $category->sort_order) }}"
                   min="0"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('sort_order') border-red-300 @enderror">
            @error('sort_order')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-1 text-sm text-gray-500">Lower numbers appear first.</p>
        </div>

        <!-- SEO Fields -->
        <div class="border-t pt-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">SEO Settings</h3>
            
            <div class="space-y-4">
                <!-- Meta Title -->
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                    <input type="text" 
                           id="meta_title" 
                           name="meta_title" 
                           value="{{ old('meta_title', $category->meta_title) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('meta_title') border-red-300 @enderror"
                           placeholder="SEO title for search engines">
                    @error('meta_title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Meta Description -->
                <div>
                    <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                    <textarea id="meta_description" 
                              name="meta_description" 
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('meta_description') border-red-300 @enderror"
                              placeholder="Brief description for search engines (150-160 characters)">{{ old('meta_description', $category->meta_description) }}</textarea>
                    @error('meta_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Status -->
        <div class="flex items-center">
            <input type="checkbox" 
                   id="is_active" 
                   name="is_active" 
                   value="1"
                   {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="is_active" class="ml-2 block text-sm text-gray-700">
                Active (visible on website)
            </label>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center justify-end space-x-3 pt-6 border-t">
            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors duration-200">
                Update Category
            </button>
        </div>
    </form>
</div>

<script>
// Auto-generate slug from name
document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const slug = name.toLowerCase()
        .replace(/[^a-z0-9 -]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
    
    if (!document.getElementById('slug').value || document.getElementById('slug').dataset.autoGenerated !== 'false') {
        document.getElementById('slug').value = slug;
        document.getElementById('slug').dataset.autoGenerated = 'true';
    }
});

document.getElementById('slug').addEventListener('input', function() {
    this.dataset.autoGenerated = 'false';
});

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
    
    // File size limit (2MB)
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
            showError('File size too large. Please upload an image smaller than 2MB.');
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

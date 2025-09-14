@extends('admin.layouts.app')

@section('title', 'Site Settings')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Site Settings</h1>
        <div class="text-sm text-gray-500">
            Manage all website content and configuration
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-8">
            <!-- Company Information -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Company Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                        <input type="text" name="company_name" id="company_name" 
                               value="{{ $settings['company']['company_name'] ?? 'K-Tech Valves' }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('company_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="company_tagline" class="block text-sm font-medium text-gray-700 mb-2">Company Tagline</label>
                        <input type="text" name="company_tagline" id="company_tagline" 
                               value="{{ $settings['company']['company_tagline'] ?? 'Industrial Valve Solutions' }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('company_tagline')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="company_description" class="block text-sm font-medium text-gray-700 mb-2">Company Description</label>
                        <textarea name="company_description" id="company_description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $settings['company']['company_description'] ?? 'Leading manufacturer of high-quality industrial valves for diverse applications worldwide.' }}</textarea>
                        @error('company_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="company_experience_years" class="block text-sm font-medium text-gray-700 mb-2">Years of Experience</label>
                        <input type="number" name="company_experience_years" id="company_experience_years" 
                               value="{{ $settings['company']['company_experience_years'] ?? '25' }}"
                               min="1" max="100"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('company_experience_years')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="company_logo" class="block text-sm font-medium text-gray-700 mb-2">Company Logo</label>
                        
                        <!-- Current Logo Display -->
                        @if(isset($settings['company']['company_logo']) && $settings['company']['company_logo'])
                            <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . $settings['company']['company_logo']) }}" 
                                         alt="Current Logo" 
                                         class="h-20 w-auto max-w-48 object-contain bg-white border border-gray-300 rounded-md p-2">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Current Logo</p>
                                        <p class="text-xs text-gray-500">{{ basename($settings['company']['company_logo']) }}</p>
                                        <button type="button" 
                                                onclick="removeLogo()"
                                                class="mt-2 text-sm text-red-600 hover:text-red-800 font-medium">
                                            Remove Logo
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        <!-- File Upload Area -->
                        <div class="relative">
                            <div id="logo-upload-area" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors duration-200 cursor-pointer">
                                <div id="upload-content">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="mt-4">
                                        <label for="company_logo" class="cursor-pointer">
                                            <span class="mt-2 block text-sm font-medium text-gray-900">
                                                {{ isset($settings['company']['company_logo']) && $settings['company']['company_logo'] ? 'Replace logo' : 'Upload logo' }}
                                            </span>
                                            <span class="mt-1 block text-sm text-gray-500">
                                                or drag and drop here
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- Preview Area -->
                                <div id="preview-content" class="hidden">
                                    <img id="preview-image" class="mx-auto h-20 w-auto max-w-48 object-contain bg-white border border-gray-300 rounded-md p-2">
                                    <div class="mt-2">
                                        <p id="preview-name" class="text-sm font-medium text-gray-900"></p>
                                        <p id="preview-size" class="text-xs text-gray-500"></p>
                                    </div>
                                </div>
                            </div>
                            
                            <input type="file" 
                                   name="company_logo" 
                                   id="company_logo" 
                                   accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml"
                                   class="hidden"
                                   onchange="handleLogoUpload(this)">
                        </div>
                        
                        <p class="mt-2 text-sm text-gray-500">
                            <strong>Recommended:</strong> 200x60px • <strong>Max size:</strong> 2MB • <strong>Formats:</strong> JPEG, PNG, JPG, GIF, SVG
                        </p>
                        @error('company_logo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Contact Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="text" name="contact_phone" id="contact_phone" 
                               value="{{ $settings['contact']['contact_phone'] ?? '+1 (555) 123-4567' }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('contact_phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="contact_email" id="contact_email" 
                               value="{{ $settings['contact']['contact_email'] ?? 'info@ktechvalves.com' }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('contact_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="contact_address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <textarea name="contact_address" id="contact_address" rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $settings['contact']['contact_address'] ?? '123 Industrial Ave, Manufacturing City, MC 12345' }}</textarea>
                        @error('contact_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_province" class="block text-sm font-medium text-gray-700 mb-2">Province/State</label>
                        <input type="text" name="contact_province" id="contact_province" 
                               value="{{ $settings['contact']['contact_province'] ?? 'Ontario' }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('contact_province')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_business_hours" class="block text-sm font-medium text-gray-700 mb-2">Business Hours</label>
                        <input type="text" name="contact_business_hours" id="contact_business_hours" 
                               value="{{ $settings['contact']['contact_business_hours'] ?? 'Mon-Fri 8:00 AM - 6:00 PM' }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('contact_business_hours')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_response_time" class="block text-sm font-medium text-gray-700 mb-2">Response Time Text</label>
                        <input type="text" name="contact_response_time" id="contact_response_time" 
                               value="{{ $settings['contact']['contact_response_time'] ?? 'We\'ll respond within 24 hours' }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('contact_response_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Social Media Links -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Social Media Links</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="social_facebook" class="block text-sm font-medium text-gray-700 mb-2">Facebook URL</label>
                        <input type="url" name="social_facebook" id="social_facebook" 
                               value="{{ $settings['social']['social_facebook'] ?? '' }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('social_facebook')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="social_linkedin" class="block text-sm font-medium text-gray-700 mb-2">LinkedIn URL</label>
                        <input type="url" name="social_linkedin" id="social_linkedin" 
                               value="{{ $settings['social']['social_linkedin'] ?? '' }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('social_linkedin')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="social_twitter" class="block text-sm font-medium text-gray-700 mb-2">Twitter URL</label>
                        <input type="url" name="social_twitter" id="social_twitter" 
                               value="{{ $settings['social']['social_twitter'] ?? '' }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('social_twitter')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="social_youtube" class="block text-sm font-medium text-gray-700 mb-2">YouTube URL</label>
                        <input type="url" name="social_youtube" id="social_youtube" 
                               value="{{ $settings['social']['social_youtube'] ?? '' }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('social_youtube')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Why Choose Us Points -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Why Choose Us Points</h2>
                <div id="why-choose-points">
                    @php
                        $whyChoosePoints = isset($settings['about']['why_choose_points']) 
                            ? json_decode($settings['about']['why_choose_points'], true) 
                            : [
                                'Over 20 years of industry experience',
                                'ISO certified manufacturing processes',
                                'Comprehensive product range',
                                'Global technical support',
                                'Custom solutions available'
                            ];
                    @endphp
                    @foreach($whyChoosePoints as $index => $point)
                    <div class="flex items-center mb-3 why-choose-point">
                        <input type="text" name="why_choose_points[]" 
                               value="{{ $point }}"
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mr-2">
                        <button type="button" onclick="removePoint(this)" class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                            Remove
                        </button>
                    </div>
                    @endforeach
                </div>
                <button type="button" onclick="addPoint()" class="mt-3 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    Add Point
                </button>
            </div>

            <!-- SEO Settings -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">SEO Settings</h2>
                <div class="space-y-6">
                    <div>
                        <label for="seo_default_title" class="block text-sm font-medium text-gray-700 mb-2">Default Page Title</label>
                        <input type="text" name="seo_default_title" id="seo_default_title" 
                               value="{{ $settings['seo']['seo_default_title'] ?? 'K-Tech Valves - Industrial Valve Solutions' }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('seo_default_title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="seo_default_description" class="block text-sm font-medium text-gray-700 mb-2">Default Meta Description</label>
                        <textarea name="seo_default_description" id="seo_default_description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $settings['seo']['seo_default_description'] ?? 'Leading manufacturer of high-quality industrial valves for diverse applications. From ball valves to gate valves, we provide reliable solutions for your industrial needs.' }}</textarea>
                        @error('seo_default_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="seo_keywords" class="block text-sm font-medium text-gray-700 mb-2">Default Keywords</label>
                        <textarea name="seo_keywords" id="seo_keywords" rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $settings['seo']['seo_keywords'] ?? 'industrial valves, ball valves, gate valves, butterfly valves, valve manufacturer, industrial equipment' }}</textarea>
                        @error('seo_keywords')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Save Settings
                </button>
            </div>
        </div>
    </form>
</div>

<script>
function addPoint() {
    const container = document.getElementById('why-choose-points');
    const div = document.createElement('div');
    div.className = 'flex items-center mb-3 why-choose-point';
    div.innerHTML = `
        <input type="text" name="why_choose_points[]" 
               placeholder="Enter a new point..."
               class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mr-2">
        <button type="button" onclick="removePoint(this)" class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
            Remove
        </button>
    `;
    container.appendChild(div);
}

function removePoint(button) {
    button.parentElement.remove();
}

// Logo upload functionality
function handleLogoUpload(input) {
    const file = input.files[0];
    if (!file) return;
    
    // Validate file type
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/svg+xml'];
    if (!allowedTypes.includes(file.type)) {
        alert('Please select a valid image file (JPEG, PNG, GIF, or SVG).');
        input.value = '';
        return;
    }
    
    // Validate file size (2MB = 2 * 1024 * 1024 bytes)
    const maxSize = 2 * 1024 * 1024;
    if (file.size > maxSize) {
        alert('File size must be less than 2MB.');
        input.value = '';
        return;
    }
    
    // Show preview
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('upload-content').classList.add('hidden');
        document.getElementById('preview-content').classList.remove('hidden');
        document.getElementById('preview-image').src = e.target.result;
        document.getElementById('preview-name').textContent = file.name;
        document.getElementById('preview-size').textContent = formatFileSize(file.size);
    };
    reader.readAsDataURL(file);
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function removeLogo() {
    if (confirm('Are you sure you want to remove the current logo?')) {
        fetch('{{ route("admin.settings.remove-file") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                key: 'company_logo'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error removing logo. Please try again.');
        });
    }
}

// Drag and drop functionality
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('logo-upload-area');
    const fileInput = document.getElementById('company_logo');
    
    if (uploadArea && fileInput) {
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        // Highlight drop area when item is dragged over it
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight() {
            uploadArea.classList.add('border-blue-400', 'bg-blue-50');
        }
        
        function unhighlight() {
            uploadArea.classList.remove('border-blue-400', 'bg-blue-50');
        }
        
        // Handle dropped files
        uploadArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 0) {
                fileInput.files = files;
                handleLogoUpload(fileInput);
            }
        }
        
        // Click to upload
        uploadArea.addEventListener('click', function() {
            fileInput.click();
        });
    }
});
</script>
@endsection

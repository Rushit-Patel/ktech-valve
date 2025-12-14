@extends('admin.layouts.app')

@section('title', $product->name)

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center space-x-2 mb-2">
                <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                @if($product->is_featured)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        Featured
                    </span>
                @endif
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $product->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <p class="text-sm text-gray-600">Model: {{ $product->model_number ?: 'N/A' }} | Category: {{ $product->category->name }}</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Product
            </a>
            <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Products
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Featured Image -->
        @if($product->featured_image)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Featured Image</h2>
            <img src="{{ Storage::url($product->featured_image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover rounded-lg border border-gray-200">
        </div>
        @endif

        <!-- Product Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Product Information</h2>
            
            <div class="space-y-4">
                @if($product->short_description)
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Short Description</h3>
                    <p class="text-gray-600">{{ $product->short_description }}</p>
                </div>
                @endif

                @if($product->description)
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Full Description</h3>
                    <div class="text-gray-600 prose max-w-none">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
                @endif

                @if($product->features)
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Features</h3>
                    <div class="text-gray-600 prose max-w-none">
                        {!! nl2br(e($product->features)) !!}
                    </div>
                </div>
                @endif

                @if($product->applications)
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Applications</h3>
                    <div class="text-gray-600 prose max-w-none">
                        {!! nl2br(e($product->applications)) !!}
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Technical Specifications -->
        @if($product->specifications)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Technical Specifications</h2>
            
            @if(is_array($product->specifications))
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-2 font-medium text-gray-700">Specification</th>
                                <th class="text-left py-2 font-medium text-gray-700">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product->specifications as $key => $value)
                            <tr class="border-b border-gray-100">
                                <td class="py-2 text-gray-600">{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                                <td class="py-2 text-gray-900">{{ is_array($value) ? implode(', ', $value) : $value }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-gray-600 prose max-w-none">
                    {!! nl2br(e($product->specifications)) !!}
                </div>
            @endif
        </div>
        @endif

        <!-- Gallery -->
        @if($product->gallery_images && count($product->gallery_images) > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Gallery</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($product->gallery_images as $image)
                    <img src="{{ Storage::url($image) }}" alt="Gallery image" class="w-full h-32 object-cover rounded-lg border border-gray-200 hover:scale-105 transition-transform duration-200 cursor-pointer" onclick="openLightbox('{{ Storage::url($image) }}')">
                @endforeach
            </div>
        </div>
        @endif

        <!-- Documents -->
        @if($product->documents && count($product->documents) > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Documents</h2>
            
            <div class="space-y-3">
                @foreach($product->documents as $document)
                    <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-red-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-900">{{ basename($document) }}</span>
                        </div>
                        <a href="{{ Storage::url($document) }}" target="_blank" class="inline-flex items-center px-3 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs font-medium rounded-md transition-colors duration-200">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Download
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Product Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Product Details</h2>
            
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-sm font-medium text-gray-700">Status:</span>
                    <span class="text-sm {{ $product->is_active ? 'text-green-600' : 'text-red-600' }}">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-sm font-medium text-gray-700">Featured:</span>
                    <span class="text-sm {{ $product->is_featured ? 'text-yellow-600' : 'text-gray-600' }}">
                        {{ $product->is_featured ? 'Yes' : 'No' }}
                    </span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-sm font-medium text-gray-700">Category:</span>
                    <span class="text-sm text-gray-600">{{ $product->category->name }}</span>
                </div>
                
                @if($product->model_number)
                <div class="flex justify-between">
                    <span class="text-sm font-medium text-gray-700">Model:</span>
                    <span class="text-sm text-gray-600">{{ $product->model_number }}</span>
                </div>
                @endif
                
                <div class="flex justify-between">
                    <span class="text-sm font-medium text-gray-700">Sort Order:</span>
                    <span class="text-sm text-gray-600">{{ $product->sort_order }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-sm font-medium text-gray-700">Created:</span>
                    <span class="text-sm text-gray-600">{{ $product->created_at->format('M j, Y') }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-sm font-medium text-gray-700">Updated:</span>
                    <span class="text-sm text-gray-600">{{ $product->updated_at->format('M j, Y') }}</span>
                </div>
            </div>
        </div>

        <!-- SEO Information -->
        @if($product->meta_title || $product->meta_description)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">SEO Information</h2>
            
            <div class="space-y-3">
                @if($product->meta_title)
                <div>
                    <span class="text-sm font-medium text-gray-700">Meta Title:</span>
                    <p class="text-sm text-gray-600 mt-1">{{ $product->meta_title }}</p>
                </div>
                @endif
                
                @if($product->meta_description)
                <div>
                    <span class="text-sm font-medium text-gray-700">Meta Description:</span>
                    <p class="text-sm text-gray-600 mt-1">{{ $product->meta_description }}</p>
                </div>
                @endif
                
                <div>
                    <span class="text-sm font-medium text-gray-700">URL Slug:</span>
                    <p class="text-sm text-gray-600 mt-1 font-mono bg-gray-50 px-2 py-1 rounded">{{ $product->slug }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions</h2>
            
            <div class="space-y-3">
                <a href="{{ route('admin.products.edit', $product) }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Product
                </a>
                
                <button onclick="toggleStatus({{ $product->id }}, {{ $product->is_active ? 'false' : 'true' }})" class="w-full inline-flex items-center justify-center px-4 py-2 {{ $product->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white font-medium rounded-lg transition-colors duration-200">
                    @if($product->is_active)
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                        Deactivate
                    @else
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Activate
                    @endif
                </button>
                
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete Product
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex items-center justify-center" onclick="closeLightbox()">
    <div class="max-w-4xl max-h-full p-4">
        <img id="lightbox-image" src="" alt="Lightbox image" class="max-w-full max-h-full object-contain">
    </div>
</div>

<script>
function openLightbox(src) {
    document.getElementById('lightbox-image').src = src;
    document.getElementById('lightbox').classList.remove('hidden');
}

function closeLightbox() {
    document.getElementById('lightbox').classList.add('hidden');
}

function toggleStatus(productId, status) {
    fetch(`/admin/products/${productId}/toggle-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ is_active: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Failed to update status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred');
    });
}

// Close lightbox with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLightbox();
    }
});
</script>
@endsection

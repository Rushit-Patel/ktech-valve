@extends('admin.layouts.app')

@section('title', 'View Banner')

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Banner Details</h1>
            <p class="mt-1 text-sm text-gray-600">View banner information and preview.</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.banners.edit', $banner) }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow-sm">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
                Edit
            </a>
            <a href="{{ route('admin.banners.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Banners
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Banner Preview -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Banner Preview</h3>
                
                @if($banner->image)
                <div class="relative rounded-lg overflow-hidden bg-gray-900 mb-6">
                    <img src="{{ Storage::url($banner->image) }}" 
                         alt="{{ $banner->title }}" 
                         class="w-full h-64 object-cover">
                    
                    <!-- Content Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                        <div class="text-center text-white p-6">
                            <h1 class="text-3xl font-bold mb-2">{{ $banner->title }}</h1>
                            @if($banner->subtitle)
                            <h2 class="text-xl text-orange-400 font-semibold mb-4">{{ $banner->subtitle }}</h2>
                            @endif
                            @if($banner->content)
                            <p class="text-lg mb-6 max-w-2xl">{{ $banner->content }}</p>
                            @endif
                            @if($banner->button_text && $banner->button_link)
                            <a href="{{ $banner->button_link }}" 
                               class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-full">
                                {{ $banner->button_text }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @else
                <div class="flex items-center justify-center h-64 bg-gray-200 rounded-lg mb-6">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">No image uploaded</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Banner Information -->
    <div class="space-y-6">
        <!-- Basic Info -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Banner Information</h3>
                
                <dl class="space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Title</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $banner->title }}</dd>
                    </div>
                    
                    @if($banner->subtitle)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Subtitle</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $banner->subtitle }}</dd>
                    </div>
                    @endif
                    
                    @if($banner->description)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Description</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $banner->description }}</dd>
                    </div>
                    @endif
                    
                    @if($banner->content)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Content</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $banner->content }}</dd>
                    </div>
                    @endif
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $banner->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $banner->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Sort Order</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $banner->sort_order }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Button Info -->
        @if($banner->button_text || $banner->button_link)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Call to Action</h3>
                
                <dl class="space-y-4">
                    @if($banner->button_text)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Button Text</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $banner->button_text }}</dd>
                    </div>
                    @endif
                    
                    @if($banner->button_link)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Button Link</dt>
                        <dd class="mt-1">
                            <a href="{{ $banner->button_link }}" 
                               target="_blank"
                               class="text-sm text-blue-600 hover:text-blue-900 break-all">
                                {{ $banner->button_link }}
                                <svg class="inline w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </dd>
                    </div>
                    @endif
                </dl>
            </div>
        </div>
        @endif

        <!-- Meta Information -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Meta Information</h3>
                
                <dl class="space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Created</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $banner->created_at->format('F j, Y g:i A') }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $banner->updated_at->format('F j, Y g:i A') }}</dd>
                    </div>
                    
                    @if($banner->image)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Image File</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ basename($banner->image) }}</dd>
                    </div>
                    @endif
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection

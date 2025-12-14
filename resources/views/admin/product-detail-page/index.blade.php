@extends('admin.layouts.app')

@section('title', 'Product Detail Page Management')

@section('content')
<div class="space-y-6">
    <div class="md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Product Detail Page Management
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Customize the layout and content of individual product detail pages
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

    <!-- Layout Settings -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Layout Settings</h3>
                <p class="mt-1 text-sm text-gray-500">Configure the general layout and display options</p>
            </div>

            <form action="{{ route('admin.product-detail-page.section.update', 'layout') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            @include('admin.partials.form-input', [
                                'name' => 'related_products_count',
                                'label' => 'Related Products Count',
                                'type' => 'number',
                                'value' => $sections['layout']['related_products_count'],
                                'min' => 1,
                                'max' => 12,
                                'required' => true
                            ])
                        </div>
                    </div>

                    <div class="space-y-3">
                        <h4 class="text-sm font-medium text-gray-900">Display Options</h4>
                        
                        <div class="space-y-2">
                            @include('admin.partials.form-input', [
                                'name' => 'show_breadcrumbs',
                                'label' => 'Show breadcrumb navigation',
                                'type' => 'checkbox',
                                'checked' => $sections['layout']['show_breadcrumbs']
                            ])

                            @include('admin.partials.form-input', [
                                'name' => 'show_category_link',
                                'label' => 'Show category link',
                                'type' => 'checkbox',
                                'checked' => $sections['layout']['show_category_link']
                            ])

                            @include('admin.partials.form-input', [
                                'name' => 'show_related_products',
                                'label' => 'Show related products section',
                                'type' => 'checkbox',
                                'checked' => $sections['layout']['show_related_products']
                            ])

                            @include('admin.partials.form-input', [
                                'name' => 'enable_image_zoom',
                                'label' => 'Enable image zoom functionality',
                                'type' => 'checkbox',
                                'checked' => $sections['layout']['enable_image_zoom']
                            ])

                            @include('admin.partials.form-input', [
                                'name' => 'show_social_share',
                                'label' => 'Show social media share buttons',
                                'type' => 'checkbox',
                                'checked' => $sections['layout']['show_social_share']
                            ])
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Layout Settings
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Features Section</h3>
                <p class="mt-1 text-sm text-gray-500">Customize how product features are displayed</p>
            </div>

            <form action="{{ route('admin.product-detail-page.section.update', 'features') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    @include('admin.partials.form-input', [
                        'name' => 'features_title',
                        'label' => 'Section Title',
                        'value' => $sections['features']['features_title'],
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'features_description',
                        'label' => 'Section Description',
                        'type' => 'textarea',
                        'value' => $sections['features']['features_description'],
                        'required' => true
                    ])

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="features_layout" class="block text-sm font-medium text-gray-700">Layout Style</label>
                            <select name="features_layout" id="features_layout" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="grid" {{ $sections['features']['features_layout'] === 'grid' ? 'selected' : '' }}>Grid Layout</option>
                                <option value="list" {{ $sections['features']['features_layout'] === 'list' ? 'selected' : '' }}>List Layout</option>
                            </select>
                        </div>
                        
                        <div class="flex items-center mt-6">
                            @include('admin.partials.form-input', [
                                'name' => 'show_features_icons',
                                'label' => 'Show feature icons',
                                'type' => 'checkbox',
                                'checked' => $sections['features']['show_features_icons']
                            ])
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Features Section
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Specifications Section -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Specifications Section</h3>
                <p class="mt-1 text-sm text-gray-500">Configure technical specifications display</p>
            </div>

            <form action="{{ route('admin.product-detail-page.section.update', 'specifications') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    @include('admin.partials.form-input', [
                        'name' => 'specs_title',
                        'label' => 'Section Title',
                        'value' => $sections['specifications']['specs_title'],
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'specs_description',
                        'label' => 'Section Description',
                        'type' => 'textarea',
                        'value' => $sections['specifications']['specs_description'],
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'datasheet_text',
                        'label' => 'Datasheet Download Button Text',
                        'value' => $sections['specifications']['datasheet_text'],
                        'required' => true
                    ])

                    <div class="space-y-2">
                        @include('admin.partials.form-input', [
                            'name' => 'show_specs_table',
                            'label' => 'Show specifications in table format',
                            'type' => 'checkbox',
                            'checked' => $sections['specifications']['show_specs_table']
                        ])

                        @include('admin.partials.form-input', [
                            'name' => 'show_datasheet_download',
                            'label' => 'Show datasheet download button',
                            'type' => 'checkbox',
                            'checked' => $sections['specifications']['show_datasheet_download']
                        ])
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Specifications Section
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Inquiry Section -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Inquiry Section</h3>
                <p class="mt-1 text-sm text-gray-500">Customize the product inquiry/quote request section</p>
            </div>

            <form action="{{ route('admin.product-detail-page.section.update', 'inquiry') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    @include('admin.partials.form-input', [
                        'name' => 'inquiry_title',
                        'label' => 'Section Title',
                        'value' => $sections['inquiry']['inquiry_title'],
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'inquiry_subtitle',
                        'label' => 'Section Subtitle',
                        'type' => 'textarea',
                        'value' => $sections['inquiry']['inquiry_subtitle'],
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'inquiry_button_text',
                        'label' => 'Button Text',
                        'value' => $sections['inquiry']['inquiry_button_text'],
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'inquiry_success_message',
                        'label' => 'Success Message',
                        'type' => 'textarea',
                        'value' => $sections['inquiry']['inquiry_success_message'],
                        'required' => true,
                        'help' => 'Message shown after successful inquiry submission'
                    ])

                    <div>
                        @include('admin.partials.form-input', [
                            'name' => 'show_inquiry_form',
                            'label' => 'Show inquiry form on product pages',
                            'type' => 'checkbox',
                            'checked' => $sections['inquiry']['show_inquiry_form']
                        ])
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Inquiry Section
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Product Statistics -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Product Statistics</h3>
                <p class="mt-1 text-sm text-gray-500">Overview of your product catalog</p>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">
                <div class="bg-gray-50 px-4 py-5 sm:p-6 rounded-lg">
                    <dt class="text-sm font-medium text-gray-500 truncate">Total Products</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['total_products'] }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:p-6 rounded-lg">
                    <dt class="text-sm font-medium text-gray-500 truncate">Products with Images</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['products_with_images'] }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:p-6 rounded-lg">
                    <dt class="text-sm font-medium text-gray-500 truncate">Products with Specs</dt>
                    <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $stats['products_with_specs'] }}</dd>
                </div>
            </div>

            <div class="mt-6 space-x-4">
                <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Manage Products
                </a>
                
                <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Manage Categories
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

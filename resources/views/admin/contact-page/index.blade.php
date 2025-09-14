@extends('admin.layouts.app')

@section('title', 'Contact Page Management')

@section('content')
<div class="space-y-6">
    <div class="md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                Contact Page Management
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Customize the content and settings for the Contact page
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
                <p class="mt-1 text-sm text-gray-500">Main banner area of the contact page</p>
            </div>

            <form action="{{ route('admin.contact-page.section.update', 'hero') }}" method="POST" enctype="multipart/form-data">
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

    <!-- Contact Information Section -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Contact Information</h3>
                <p class="mt-1 text-sm text-gray-500">Company contact details and information</p>
            </div>

            <form action="{{ route('admin.contact-page.section.update', 'info') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    @include('admin.partials.form-input', [
                        'name' => 'office_title',
                        'label' => 'Office Section Title',
                        'value' => $sections['info']['office_title'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'office_address',
                        'label' => 'Office Address',
                        'type' => 'textarea',
                        'value' => $sections['info']['office_address'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'phone_primary',
                        'label' => 'Primary Phone',
                        'value' => $sections['info']['phone_primary'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'phone_secondary',
                        'label' => 'Secondary Phone',
                        'value' => $sections['info']['phone_secondary'] ?? ''
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'email_primary',
                        'label' => 'Primary Email',
                        'type' => 'email',
                        'value' => $sections['info']['email_primary'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'email_secondary',
                        'label' => 'Secondary Email',
                        'type' => 'email',
                        'value' => $sections['info']['email_secondary'] ?? ''
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'working_hours',
                        'label' => 'Working Hours',
                        'type' => 'textarea',
                        'value' => $sections['info']['working_hours'] ?? ''
                    ])
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Contact Information
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Contact Form Settings</h3>
                <p class="mt-1 text-sm text-gray-500">Customize the contact form section</p>
            </div>

            <form action="{{ route('admin.contact-page.section.update', 'form') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    @include('admin.partials.form-input', [
                        'name' => 'form_title',
                        'label' => 'Form Section Title',
                        'value' => $sections['form']['form_title'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'form_subtitle',
                        'label' => 'Form Subtitle',
                        'type' => 'textarea',
                        'value' => $sections['form']['form_subtitle'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'success_message',
                        'label' => 'Success Message',
                        'type' => 'textarea',
                        'value' => $sections['form']['success_message'] ?? '',
                        'help' => 'Message shown after successful form submission'
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'privacy_notice',
                        'label' => 'Privacy Notice',
                        'type' => 'textarea',
                        'value' => $sections['form']['privacy_notice'] ?? '',
                        'help' => 'Privacy notice displayed with the form'
                    ])
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Form Settings
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Map Section -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Map Settings</h3>
                <p class="mt-1 text-sm text-gray-500">Configure the location map display</p>
            </div>

            <form action="{{ route('admin.contact-page.section.update', 'map') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    @include('admin.partials.form-input', [
                        'name' => 'map_title',
                        'label' => 'Map Section Title',
                        'value' => $sections['map']['map_title'] ?? '',
                        'required' => true
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'latitude',
                        'label' => 'Latitude',
                        'value' => $sections['map']['latitude'] ?? '',
                        'help' => 'Decimal degrees (e.g., 40.7128)'
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'longitude',
                        'label' => 'Longitude',
                        'value' => $sections['map']['longitude'] ?? '',
                        'help' => 'Decimal degrees (e.g., -74.0060)'
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'map_zoom',
                        'label' => 'Map Zoom Level',
                        'type' => 'number',
                        'value' => $sections['map']['map_zoom'] ?? '15',
                        'help' => 'Zoom level between 1 and 20'
                    ])

                    @include('admin.partials.form-input', [
                        'name' => 'show_map',
                        'label' => 'Show Map',
                        'type' => 'checkbox',
                        'checked' => $sections['map']['show_map'] ?? true,
                        'help' => 'Display the location map on the contact page'
                    ])
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Map Settings
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Quick Actions</h3>
                <p class="mt-1 text-sm text-gray-500">Manage related content</p>
            </div>

            <div class="space-x-4">
                <a href="{{ route('admin.inquiries.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    View Inquiries
                </a>
                
                <a href="{{ route('admin.settings.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Global Settings
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

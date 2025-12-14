@extends('admin.layouts.app')

@section('title', 'Edit Client')

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Client</h1>
            <p class="mt-1 text-sm text-gray-600">Update client information and details.</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.clients.show', $client) }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                View
            </a>
            <a href="{{ route('admin.clients.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Clients
            </a>
        </div>
    </div>
</div>

<div class="max-w-3xl">
    <form action="{{ route('admin.clients.update', $client) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 rounded-xl">
            <div class="p-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Name -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Client Name *</label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $client->name) }}"
                                   required
                                   class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                   placeholder="e.g., Reliance Industries Ltd.">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Current Logo -->
                    @if($client->logo)
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Current Logo</label>
                        <div class="mt-2">
                            <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <img src="{{ Storage::url($client->logo) }}" 
                                     alt="{{ $client->name }}" 
                                     class="h-16 w-auto max-w-32 object-contain bg-white rounded border">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $client->name }}</p>
                                    <p class="text-xs text-gray-500">{{ basename($client->logo) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Logo -->
                    <div class="sm:col-span-2">
                        <label for="logo" class="block text-sm font-medium leading-6 text-gray-900">
                            {{ $client->logo ? 'Replace Client Logo' : 'Client Logo *' }}
                        </label>
                        <div class="mt-2">
                            <input type="file" 
                                   name="logo" 
                                   id="logo"
                                   accept=".jpg,.jpeg,.png,.svg,.webp"
                                   {{ !$client->logo ? 'required' : '' }}
                                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            @error('logo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">
                                {{ $client->logo ? 'Upload a new logo to replace the current one. ' : '' }}Upload JPG, PNG, SVG, or WebP file (max 5MB). Recommended: 300x150px
                            </p>
                        </div>
                    </div>

                    <!-- Website URL -->
                    <div class="sm:col-span-2">
                        <label for="website_url" class="block text-sm font-medium leading-6 text-gray-900">Website URL</label>
                        <div class="mt-2">
                            <input type="url" 
                                   name="website_url" 
                                   id="website_url" 
                                   value="{{ old('website_url', $client->website_url) }}"
                                   class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                   placeholder="https://www.example.com">
                            @error('website_url')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Industry -->
                    <div>
                        <label for="industry" class="block text-sm font-medium leading-6 text-gray-900">Industry</label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="industry" 
                                   id="industry" 
                                   value="{{ old('industry', $client->industry) }}"
                                   class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                   placeholder="e.g., Oil & Gas, Petrochemicals">
                            @error('industry')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Partnership Since -->
                    <div>
                        <label for="partnership_since" class="block text-sm font-medium leading-6 text-gray-900">Partnership Since</label>
                        <div class="mt-2">
                            <input type="number" 
                                   name="partnership_since" 
                                   id="partnership_since" 
                                   value="{{ old('partnership_since', $client->partnership_since) }}"
                                   min="1900"
                                   max="{{ date('Y') }}"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                   placeholder="e.g., {{ date('Y') }}">
                            @error('partnership_since')
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
                                      rows="4"
                                      class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                      placeholder="Brief description about the client partnership...">{{ old('description', $client->description) }}</textarea>
                            @error('description')
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
                                   {{ old('is_featured', $client->is_featured) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="is_featured" class="ml-2 block text-sm text-gray-900">
                                Featured Client
                            </label>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Featured clients are highlighted on the homepage</p>
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
                                <option value="1" {{ old('is_active', $client->is_active) == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active', $client->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
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
                                   value="{{ old('sort_order', $client->sort_order) }}"
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
            <a href="{{ route('admin.clients.index') }}" 
               class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700">
                Cancel
            </a>
            <button type="submit" 
                    class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                Update Client
            </button>
        </div>
    </form>
</div>
@endsection

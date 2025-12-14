@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mx-auto max-w-7xl">
    <!-- Page header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
            Dashboard
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Welcome back, {{ auth()->user()->name }}! Here's what's happening with your valve business.
        </p>
    </div>

    <!-- Stats grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
        <!-- Total Products -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6 border border-gray-200">
            <dt class="truncate text-sm font-medium text-gray-500">Total Products</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $stats['total_products'] }}</dd>
            <div class="mt-2 flex items-center text-sm">
                <span class="text-green-600">{{ $stats['active_products'] }} active</span>
            </div>
        </div>

        <!-- Categories -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6 border border-gray-200">
            <dt class="truncate text-sm font-medium text-gray-500">Categories</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $stats['total_categories'] }}</dd>
            <div class="mt-2 flex items-center text-sm">
                <a href="{{ route('admin.categories.index') }}" class="text-blue-600 hover:text-blue-500">Manage →</a>
            </div>
        </div>

        <!-- Inquiries -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6 border border-gray-200">
            <dt class="truncate text-sm font-medium text-gray-500">Total Inquiries</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $stats['total_inquiries'] }}</dd>
            <div class="mt-2 flex items-center text-sm">
                @if($stats['new_inquiries'] > 0)
                    <span class="text-red-600">{{ $stats['new_inquiries'] }} new</span>
                @else
                    <span class="text-gray-500">All up to date</span>
                @endif
            </div>
        </div>

        <!-- Active Banners -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6 border border-gray-200">
            <dt class="truncate text-sm font-medium text-gray-500">Active Banners</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $stats['active_banners'] }}</dd>
            <div class="mt-2 flex items-center text-sm">
                <a href="{{ route('admin.banners.index') }}" class="text-blue-600 hover:text-blue-500">Manage →</a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Recent Inquiries -->
        <div class="overflow-hidden rounded-lg bg-white shadow border border-gray-200">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Recent Inquiries</h3>
                    <a href="{{ route('admin.inquiries.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                        View all →
                    </a>
                </div>
                
                @if($recent_inquiries->count() > 0)
                    <div class="flow-root">
                        <ul role="list" class="-my-3 divide-y divide-gray-200">
                            @foreach($recent_inquiries as $inquiry)
                            <li class="py-3">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full {{ $inquiry->status === 'new' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800' }}">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-sm font-medium text-gray-900">{{ $inquiry->name }}</p>
                                        <p class="truncate text-sm text-gray-500">{{ $inquiry->subject }}</p>
                                        @if($inquiry->product)
                                            <p class="truncate text-xs text-blue-600">{{ $inquiry->product->name }}</p>
                                        @endif
                                    </div>
                                    <div class="flex-shrink-0 text-right">
                                        <p class="text-sm text-gray-900">{{ $inquiry->created_at->format('M j') }}</p>
                                        <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium {{ $inquiry->status === 'new' ? 'bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/10' : 'bg-gray-50 text-gray-700 ring-1 ring-inset ring-gray-600/10' }}">
                                            {{ ucfirst($inquiry->status) }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="text-center py-6">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8 0h2m-6 0h2" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No inquiries</h3>
                        <p class="mt-1 text-sm text-gray-500">No customer inquiries yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Featured Products -->
        <div class="overflow-hidden rounded-lg bg-white shadow border border-gray-200">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Featured Products</h3>
                    <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                        View all →
                    </a>
                </div>
                
                @if($featured_products->count() > 0)
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($featured_products as $product)
                        <div class="group relative">
                            <div class="aspect-square w-full overflow-hidden rounded-lg bg-gray-200">
                                @if($product->main_image)
                                    <img src="{{ Storage::url($product->main_image) }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center group-hover:opacity-75">
                                @else
                                    <div class="flex h-full w-full items-center justify-center">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-2">
                                <h4 class="text-sm font-medium text-gray-900 truncate">{{ $product->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $product->category->name }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No featured products</h3>
                        <p class="mt-1 text-sm text-gray-500">Mark some products as featured to display them here.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8">
        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <a href="{{ route('admin.products.create') }}" class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-6 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <span class="mt-2 block text-sm font-medium text-gray-900">Add Product</span>
            </a>

            <a href="{{ route('admin.categories.create') }}" class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-6 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span class="mt-2 block text-sm font-medium text-gray-900">Add Category</span>
            </a>

            <a href="{{ route('admin.banners.create') }}" class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-6 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="mt-2 block text-sm font-medium text-gray-900">Add Banner</span>
            </a>

            <a href="{{ route('admin.galleries.create') }}" class="relative block w-full rounded-lg border-2 border-dashed border-gray-300 p-6 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="mt-2 block text-sm font-medium text-gray-900">Add Gallery</span>
            </a>
        </div>
    </div>
</div>
@endsection

@extends('frontend.layouts.app')

@section('title', 'Products - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
    <!-- Header -->
    <div class="bg-white/70 backdrop-blur-xl border-b border-slate-200/80 dark:bg-slate-900/70 dark:border-slate-700/80">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-slate-900 dark:text-slate-100 sm:text-5xl">
                    Our Products
                </h1>
                <p class="mt-4 text-xl text-slate-600 dark:text-slate-400">
                    Discover our comprehensive range of industrial valve solutions
                </p>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-4 lg:gap-8">
            <!-- Filters Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-8">
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-modern p-6">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100 mb-4">
                            Filter Products
                        </h3>
                        
                        <!-- Category Filter -->
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-slate-700 dark:text-slate-300 mb-3">
                                Categories
                            </h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-slate-600 dark:text-slate-400">All Categories</span>
                                </label>
                                @foreach($categories as $category)
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500" 
                                           value="{{ $category->id }}">
                                    <span class="ml-2 text-sm text-slate-600 dark:text-slate-400">
                                        {{ $category->name }} ({{ $category->products_count }})
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-slate-700 dark:text-slate-300 mb-3">
                                Price Range
                            </h4>
                            <div class="space-y-2">
                                <input type="range" class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer">
                                <div class="flex justify-between text-xs text-slate-500">
                                    <span>$0</span>
                                    <span>$10,000+</span>
                                </div>
                            </div>
                        </div>

                        <!-- Availability -->
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-slate-700 dark:text-slate-300 mb-3">
                                Availability
                            </h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-slate-600 dark:text-slate-400">In Stock</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-slate-600 dark:text-slate-400">Pre-order</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="lg:col-span-3 mt-8 lg:mt-0">
                <!-- Search and Sort -->
                <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="relative mb-4 sm:mb-0">
                        <input type="text" 
                               placeholder="Search products..."
                               class="w-full sm:w-80 pl-10 pr-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    
                    <select class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500">
                        <option>Sort by: Newest</option>
                        <option>Sort by: Price (Low to High)</option>
                        <option>Sort by: Price (High to Low)</option>
                        <option>Sort by: Name (A-Z)</option>
                    </select>
                </div>

                <!-- Products Grid -->
                <div class="product-grid">
                    @foreach($products as $product)
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-modern card-hover overflow-hidden">
                        <div class="aspect-square overflow-hidden">
                            @if($product->featured_image)
                                <img src="{{ Storage::url($product->featured_image) }}" 
                                     alt="{{ $product->name }}"
                                     class="h-full w-full object-cover transition-transform duration-300 hover:scale-105">
                            @else
                                <div class="h-full w-full bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center">
                                    <svg class="h-16 w-16 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-6">
                            <div class="mb-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                    {{ $product->category->name }}
                                </span>
                            </div>
                            
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100 mb-2 line-clamp-2">
                                {{ $product->name }}
                            </h3>
                            
                            @if($product->short_description)
                                <p class="text-slate-600 dark:text-slate-400 text-sm mb-4 line-clamp-3">
                                    {{ $product->short_description }}
                                </p>
                            @endif
                            
                            <div class="flex items-center justify-between">
                                @if($product->price)
                                    <div class="text-xl font-bold text-slate-900 dark:text-slate-100">
                                        ${{ number_format($product->price, 2) }}
                                    </div>
                                @else
                                    <div class="text-sm text-slate-500 dark:text-slate-400">
                                        Contact for pricing
                                    </div>
                                @endif
                                
                                <a href="{{ route('products.show', $product->slug) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors btn-modern">
                                    View Details
                                    <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $products->links('frontend.components.pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
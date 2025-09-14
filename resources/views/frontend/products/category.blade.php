@extends('frontend.layouts.app')

@section('title', $category->name . ' - K-Tech Valves')
@section('description', 'Explore our ' . strtolower($category->name) . ' collection. ' . Str::limit($category->description, 150))

@section('content')
    <!-- Category Header -->
    <div class="bg-white">
        <div class="relative bg-gradient-to-r from-blue-900 to-blue-700 py-16 sm:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl mx-auto text-center">
                    <h1 class="text-3xl font-extrabold text-white sm:text-4xl">
                        {{ $category->name }}
                    </h1>
                    <p class="mt-4 text-lg text-blue-100">
                        {{ $category->description }}
                    </p>
                    <nav class="flex justify-center mt-6">
                        <ol class="flex items-center space-x-4">
                            <li>
                                <a href="{{ route('home') }}" class="text-blue-200 hover:text-white transition-colors duration-200">Home</a>
                            </li>
                            <li>
                                <svg class="flex-shrink-0 h-5 w-5 text-blue-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </li>
                            <li>
                                <a href="{{ route('products.index') }}" class="text-blue-200 hover:text-white transition-colors duration-200">Products</a>
                            </li>
                            <li>
                                <svg class="flex-shrink-0 h-5 w-5 text-blue-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </li>
                            <li>
                                <span class="text-white font-medium">{{ $category->name }}</span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Information -->
    @if($category->image || $category->features)
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 lg:items-start">
                @if($category->image)
                <div class="aspect-w-3 aspect-h-2">
                    <img class="object-cover shadow-lg rounded-lg" src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                </div>
                @endif
                
                <div class="{{ $category->image ? 'mt-10 lg:mt-0' : '' }}">
                    @if($category->features)
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Key Features</h2>
                    <ul class="space-y-3">
                        @foreach($category->features as $feature)
                        <li class="flex items-start">
                            <svg class="flex-shrink-0 h-6 w-6 text-green-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="ml-3 text-gray-700">{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                    
                    @if($category->applications)
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 {{ $category->features ? 'mt-10' : '' }}">Applications</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($category->applications as $application)
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <svg class="flex-shrink-0 h-5 w-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-gray-700">{{ $application }}</span>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Products Grid -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-2xl font-bold text-gray-900 mb-4 sm:mb-0">
                    {{ $category->name }} Products ({{ $products->total() }})
                </h2>
                
                <!-- Sort Options -->
                <div class="flex items-center space-x-4">
                    <label for="sort" class="text-sm font-medium text-gray-700">Sort by:</label>
                    <select id="sort" name="sort" class="border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" onchange="window.location.href = updateUrlParameter(window.location.href, 'sort', this.value)">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                        <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured</option>
                    </select>
                </div>
            </div>

            @if($products->count() > 0)
            <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                @foreach($products as $product)
                <div class="group bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-48 w-full object-cover object-center group-hover:opacity-75 transition-opacity duration-300">
                        @else
                        <div class="h-48 w-full bg-gray-100 flex items-center justify-center">
                            <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        @endif
                        @if($product->is_featured)
                        <div class="absolute top-2 left-2">
                            <span class="bg-red-500 text-white px-2 py-1 text-xs font-semibold rounded-full">Featured</span>
                        </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">
                            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                        </h3>
                        <p class="mt-2 text-sm text-gray-500 line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-sm text-gray-500">{{ $product->category->name }}</span>
                            <a href="{{ route('products.show', $product) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-xs font-medium rounded-md text-blue-600 bg-blue-100 hover:bg-blue-200 transition-colors duration-200">
                                View Details
                                <svg class="ml-1 h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="mt-12">
                {{ $products->links() }}
            </div>
            @endif
            @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No products found</h3>
                <p class="mt-1 text-sm text-gray-500">We don't have any products in this category yet.</p>
                <div class="mt-6">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        View All Products
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Category Navigation -->
    <div class="bg-white py-12 border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-lg font-medium text-gray-900 mb-6">Other Categories</h2>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6">
                @foreach($categories->where('id', '!=', $category->id) as $otherCategory)
                <a href="{{ route('products.category', $otherCategory) }}" class="group relative bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <div>
                        <h3 class="text-sm font-medium text-gray-900 group-hover:text-blue-600">{{ $otherCategory->name }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ $otherCategory->products_count ?? 0 }} products</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-blue-600">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">Need a custom solution?</span>
                <span class="block text-blue-200">Contact our engineering team.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 transition-colors duration-200">
                        Get in Touch
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function updateUrlParameter(url, param, paramVal) {
    var newAdditionalURL = "";
    var tempArray = url.split("?");
    var baseURL = tempArray[0];
    var additionalURL = tempArray[1];
    var temp = "";
    if (additionalURL) {
        tempArray = additionalURL.split("&");
        for (var i = 0; i < tempArray.length; i++) {
            if (tempArray[i].split('=')[0] != param) {
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }
    }
    var rows_txt = temp + "" + param + "=" + paramVal;
    return baseURL + "?" + newAdditionalURL + rows_txt;
}
</script>
@endpush

@extends('admin.layouts.app')

@section('title', 'Banners')

@section('content')
<!-- Header Section -->
<div class="mb-6 sm:mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Banners</h1>
            <p class="mt-1 text-sm text-gray-600">Manage homepage banners and promotional content.</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('admin.banners.create') }}" 
               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Banner
            </a>
        </div>
    </div>
</div>

<!-- Filters Section -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6 mb-6">
    <form method="GET" class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1 min-w-0">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Search banners..." 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
        </div>
        <div class="w-full sm:w-40">
            <select name="status" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                <option value="">All Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" 
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200 shadow-sm">
                Filter
            </button>
            @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('admin.banners.index') }}" 
                   class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200 shadow-sm">
                    Clear
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Banners List -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    @if($banners->count() > 0)
        <!-- Desktop Table View -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 xl:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Banner</th>
                        <th class="px-4 xl:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                        <th class="px-4 xl:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 xl:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="px-4 xl:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($banners as $banner)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-4 xl:px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($banner->image)
                                        <img src="{{ Storage::url($banner->image) }}" 
                                             alt="{{ $banner->title }}" 
                                             class="w-16 h-10 object-cover rounded-lg mr-4 shadow-sm">
                                    @else
                                        <div class="w-16 h-10 bg-gray-200 rounded-lg mr-4 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <div class="text-sm font-medium text-gray-900 truncate">{{ $banner->title }}</div>
                                        @if($banner->subtitle)
                                            <div class="text-sm text-gray-500 truncate">{{ $banner->subtitle }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 xl:px-6 py-4 max-w-xs">
                                @if($banner->content)
                                    <p class="text-sm text-gray-900 line-clamp-2 mb-1">{{ Str::limit($banner->content, 80) }}</p>
                                @endif
                                @if($banner->description)
                                    <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($banner->description, 100) }}</p>
                                @endif
                                @if($banner->button_text && $banner->button_link)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-1">
                                        {{ $banner->button_text }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 xl:px-6 py-4 whitespace-nowrap">
                                <button onclick="toggleStatus({{ $banner->id }}, {{ $banner->is_active ? 'false' : 'true' }})" 
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium transition-colors duration-200 {{ $banner->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}">
                                    <span class="w-2 h-2 rounded-full mr-1 {{ $banner->is_active ? 'bg-green-400' : 'bg-red-400' }}"></span>
                                    {{ $banner->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="px-4 xl:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="inline-flex items-center px-2 py-1 rounded-md bg-gray-100 text-gray-800 text-xs font-medium">
                                    #{{ $banner->sort_order }}
                                </span>
                            </td>
                            <td class="px-4 xl:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('admin.banners.show', $banner) }}" 
                                       class="text-blue-600 hover:text-blue-900 transition-colors duration-200" 
                                       title="View Banner">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.banners.edit', $banner) }}" 
                                       class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200" 
                                       title="Edit Banner">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this banner?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 transition-colors duration-200" 
                                                title="Delete Banner">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="lg:hidden">
            <div class="divide-y divide-gray-200">
                @foreach($banners as $banner)
                    <div class="p-4 sm:p-6">
                        <div class="flex items-start space-x-4">
                            @if($banner->image)
                                <img src="{{ Storage::url($banner->image) }}" 
                                     alt="{{ $banner->title }}" 
                                     class="w-16 h-10 object-cover rounded-lg shadow-sm flex-shrink-0">
                            @else
                                <div class="w-16 h-10 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between">
                                    <div class="min-w-0 flex-1">
                                        <h3 class="text-sm font-medium text-gray-900 truncate">{{ $banner->title }}</h3>
                                        @if($banner->subtitle)
                                            <p class="text-sm text-gray-500 truncate">{{ $banner->subtitle }}</p>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-2 ml-2">
                                        <button onclick="toggleStatus({{ $banner->id }}, {{ $banner->is_active ? 'false' : 'true' }})" 
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium transition-colors duration-200 {{ $banner->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            <span class="w-2 h-2 rounded-full mr-1 {{ $banner->is_active ? 'bg-green-400' : 'bg-red-400' }}"></span>
                                            {{ $banner->is_active ? 'Active' : 'Inactive' }}
                                        </button>
                                        <span class="inline-flex items-center px-2 py-1 rounded-md bg-gray-100 text-gray-800 text-xs font-medium">
                                            #{{ $banner->sort_order }}
                                        </span>
                                    </div>
                                </div>
                                
                                @if($banner->content || $banner->description)
                                    <div class="mt-2">
                                        @if($banner->content)
                                            <p class="text-sm text-gray-900 line-clamp-2">{{ Str::limit($banner->content, 80) }}</p>
                                        @endif
                                        @if($banner->description)
                                            <p class="text-sm text-gray-600 line-clamp-1 mt-1">{{ Str::limit($banner->description, 60) }}</p>
                                        @endif
                                    </div>
                                @endif
                                
                                <div class="flex items-center justify-between mt-3">
                                    @if($banner->button_text && $banner->button_link)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $banner->button_text }}
                                        </span>
                                    @else
                                        <div></div>
                                    @endif
                                    
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('admin.banners.show', $banner) }}" 
                                           class="text-blue-600 hover:text-blue-900 transition-colors duration-200" 
                                           title="View">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.banners.edit', $banner) }}" 
                                           class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200" 
                                           title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this banner?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-200" 
                                                    title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        @if($banners->hasPages())
            <div class="px-4 sm:px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $banners->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No banners found</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating your first banner.</p>
            <div class="mt-6">
                <a href="{{ route('admin.banners.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Banner
                </a>
            </div>
        </div>
    @endif
</div>

<script>
function toggleStatus(bannerId, status) {
    fetch(`/admin/banners/${bannerId}/toggle-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ is_active: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success !== false) {
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
</script>
@endsection

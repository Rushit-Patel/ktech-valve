@extends('admin.layouts.app')

@section('title', 'Clients Management')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Clients</h1>
                    <p class="mt-1 text-sm text-gray-600">Manage client logos and partnerships</p>
                </div>
                <a href="{{ route('admin.clients.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add Client
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="p-6">
                <form method="GET" class="flex flex-wrap gap-4">
                    <div class="flex-1 min-w-64">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               placeholder="Search clients..." 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div>
                        <select name="featured" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Clients</option>
                            <option value="yes" {{ request('featured') === 'yes' ? 'selected' : '' }}>Featured</option>
                            <option value="no" {{ request('featured') === 'no' ? 'selected' : '' }}>Not Featured</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Filter
                    </button>
                    @if(request()->hasAny(['search', 'status', 'featured']))
                        <a href="{{ route('admin.clients.index') }}" 
                           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg transition-colors">
                            Clear
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Clients Grid -->
        @if($clients->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-6">
                @foreach($clients as $client)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                        <!-- Logo -->
                        <div class="aspect-video bg-gray-50 p-6 flex items-center justify-center">
                            @if($client->logo)
                                <img src="{{ Storage::url($client->logo) }}" 
                                     alt="{{ $client->name }}" 
                                     class="max-w-full max-h-full object-contain">
                            @else
                                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-6m-2 0H3m2-16V3a1 1 0 011-1h4a1 1 0 011 1v2M7 7h10M7 11h4m6 0h2M7 15h10"/>
                                </svg>
                            @endif
                        </div>

                        <div class="p-4">
                            <!-- Header -->
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $client->name }}</h3>
                                    @if($client->industry)
                                        <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">
                                            {{ $client->industry }}
                                        </span>
                                    @endif
                                </div>
                                <div class="flex items-center space-x-1">
                                    <!-- Featured Toggle -->
                                    <button onclick="toggleFeatured({{ $client->id }})" 
                                            class="featured-toggle {{ $client->is_featured ? 'text-yellow-500' : 'text-gray-300' }}" 
                                            title="{{ $client->is_featured ? 'Featured' : 'Not Featured' }}">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </button>
                                    
                                    <!-- Status Toggle -->
                                    <button onclick="toggleStatus({{ $client->id }})" 
                                            class="status-toggle {{ $client->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} px-2 py-1 rounded-full text-xs font-medium">
                                        {{ $client->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </div>
                            </div>

                            <!-- Description -->
                            @if($client->description)
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $client->description }}</p>
                            @endif

                            <!-- Website -->
                            @if($client->website)
                                <a href="{{ $client->website }}" target="_blank" 
                                   class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm mb-3">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                    Visit Website
                                </a>
                            @endif

                            <!-- Sort Order -->
                            <div class="text-xs text-gray-500 mb-3">
                                Sort Order: {{ $client->sort_order ?? 0 }}
                            </div>

                            <!-- Actions -->
                            <div class="flex justify-between items-center pt-3 border-t border-gray-100">
                                <a href="{{ route('admin.clients.show', $client) }}" 
                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    View Details
                                </a>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.clients.edit', $client) }}" 
                                       class="text-gray-600 hover:text-gray-800">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" 
                                          onsubmit="return confirm('Are you sure you want to delete this client?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 px-6 py-4">
                {{ $clients->withQueryString()->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                <svg class="mx-auto w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-6m-2 0H3m2-16V3a1 1 0 011-1h4a1 1 0 011 1v2M7 7h10M7 11h4m6 0h2M7 15h10"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No clients found</h3>
                <p class="text-gray-600 mb-6">Get started by adding your first client.</p>
                <a href="{{ route('admin.clients.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    Add Client
                </a>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function toggleStatus(clientId) {
    fetch(`/admin/clients/${clientId}/toggle-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the status.');
    });
}

function toggleFeatured(clientId) {
    fetch(`/admin/clients/${clientId}/toggle-featured`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the featured status.');
    });
}
</script>
@endpush
@endsection

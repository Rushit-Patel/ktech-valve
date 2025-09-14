@extends('admin.layouts.app')

@section('title', 'Inquiries')

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Customer Inquiries</h1>
            <p class="mt-1 text-sm text-gray-600">Manage customer inquiries and requests.</p>
        </div>
        <div class="flex items-center space-x-3">
            <span class="text-sm text-gray-600">Total: {{ $inquiries->total() }}</span>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center">
            <div class="p-2 bg-yellow-100 rounded-lg">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Pending</p>
                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Inquiry::where('status', 'pending')->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center">
            <div class="p-2 bg-blue-100 rounded-lg">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">In Progress</p>
                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Inquiry::where('status', 'in_progress')->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center">
            <div class="p-2 bg-green-100 rounded-lg">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Completed</p>
                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Inquiry::where('status', 'completed')->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center">
            <div class="p-2 bg-gray-100 rounded-lg">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Closed</p>
                <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Inquiry::where('status', 'closed')->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
    <form method="GET" class="flex flex-wrap gap-4">
        <div class="flex-1 min-w-64">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Search by name, email, or company..." 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="min-w-40">
            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>
        <div class="min-w-40">
            <input type="date" 
                   name="date_from" 
                   value="{{ request('date_from') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="min-w-40">
            <input type="date" 
                   name="date_to" 
                   value="{{ request('date_to') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        <button type="submit" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
            Filter
        </button>
        @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
            <a href="{{ route('admin.inquiries.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                Clear
            </a>
        @endif
    </form>
</div>

<!-- Inquiries List -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    @if($inquiries->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($inquiries as $inquiry)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" name="inquiries[]" value="{{ $inquiry->id }}" class="inquiry-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $inquiry->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $inquiry->email }}</div>
                                    @if($inquiry->company)
                                        <div class="text-sm text-gray-500">{{ $inquiry->company }}</div>
                                    @endif
                                    @if($inquiry->phone)
                                        <div class="text-sm text-gray-500">{{ $inquiry->phone }}</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($inquiry->product)
                                    <div class="text-sm font-medium text-gray-900">{{ $inquiry->product->name }}</div>
                                    @if($inquiry->product->model_number)
                                        <div class="text-sm text-gray-500">{{ $inquiry->product->model_number }}</div>
                                    @endif
                                @else
                                    <span class="text-sm text-gray-500">General Inquiry</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($inquiry->message, 100) }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    @switch($inquiry->status)
                                        @case('pending') bg-yellow-100 text-yellow-800 @break
                                        @case('in_progress') bg-blue-100 text-blue-800 @break
                                        @case('completed') bg-green-100 text-green-800 @break
                                        @case('closed') bg-gray-100 text-gray-800 @break
                                        @default bg-gray-100 text-gray-800
                                    @endswitch">
                                    {{ ucfirst(str_replace('_', ' ', $inquiry->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $inquiry->created_at->format('M j, Y') }}
                                <div class="text-xs text-gray-500">{{ $inquiry->created_at->format('g:i A') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-blue-600 hover:text-blue-900 transition-colors duration-200">View</a>
                                    <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this inquiry?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition-colors duration-200">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Bulk Actions -->
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50" style="display: none;" id="bulk-actions">
            <form method="POST" action="{{ route('admin.inquiries.bulk-action') }}" onsubmit="return confirmBulkAction()">
                @csrf
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">With selected:</span>
                    <select name="action" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Choose action...</option>
                        <option value="mark_pending">Mark as Pending</option>
                        <option value="mark_completed">Mark as Completed</option>
                        <option value="delete">Delete</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors duration-200">
                        Apply
                    </button>
                </div>
                <input type="hidden" name="inquiries" id="selected-inquiries">
            </form>
        </div>

        <!-- Pagination -->
        @if($inquiries->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $inquiries->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No inquiries</h3>
            <p class="mt-1 text-sm text-gray-500">No customer inquiries found matching your criteria.</p>
        </div>
    @endif
</div>

<script>
// Handle select all checkbox
document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.inquiry-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    toggleBulkActions();
});

// Handle individual checkboxes
document.querySelectorAll('.inquiry-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', toggleBulkActions);
});

function toggleBulkActions() {
    const selected = document.querySelectorAll('.inquiry-checkbox:checked');
    const bulkActions = document.getElementById('bulk-actions');
    
    if (selected.length > 0) {
        bulkActions.style.display = 'block';
        const ids = Array.from(selected).map(cb => cb.value);
        document.getElementById('selected-inquiries').value = JSON.stringify(ids);
    } else {
        bulkActions.style.display = 'none';
    }
}

function confirmBulkAction() {
    const action = document.querySelector('select[name="action"]').value;
    if (!action) {
        alert('Please select an action');
        return false;
    }
    
    const selected = document.querySelectorAll('.inquiry-checkbox:checked');
    const count = selected.length;
    
    if (count === 0) {
        alert('Please select at least one inquiry');
        return false;
    }
    
    let message = '';
    switch(action) {
        case 'delete':
            message = `Are you sure you want to delete ${count} inquiries? This action cannot be undone.`;
            break;
        case 'mark_pending':
            message = `Mark ${count} inquiries as pending?`;
            break;
        case 'mark_completed':
            message = `Mark ${count} inquiries as completed?`;
            break;
    }
    
    return confirm(message);
}
</script>
@endsection

@extends('admin.layouts.app')

@section('title', 'Pages Management')
@section('page-title', 'Pages Management')

@section('page-actions')
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Add New Page
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0">All Pages</h5>
            </div>
            <div class="col-auto">
                <form method="GET" action="{{ route('admin.pages.index') }}" class="d-flex gap-2">
                    <div class="input-group" style="width: 300px;">
                        <input type="text" 
                               class="form-control" 
                               name="search" 
                               placeholder="Search pages..." 
                               value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    
                    <select name="status" class="form-select" style="width: 150px;" onchange="this.form.submit()">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    
                    @if(request('search') || request('status'))
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
    
    <div class="card-body p-0">
        @if($pages->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Page Title</th>
                            <th>Slug</th>
                            <th style="width: 120px;">Status</th>
                            <th style="width: 150px;">Created Date</th>
                            <th style="width: 150px;">Last Updated</th>
                            <th style="width: 200px;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td>{{ $page->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($page->banner_image)
                                            <img src="{{ asset('storage/' . $page->banner_image) }}" 
                                                 alt="{{ $page->title }}" 
                                                 class="rounded me-2" 
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center" 
                                                 style="width: 40px; height: 40px;">
                                                <i class="fas fa-file-alt text-muted"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-medium">{{ $page->title }}</div>
                                            @if($page->meta_title)
                                                <small class="text-muted">{{ Str::limit($page->meta_title, 50) }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($page->slug)
                                        <code class="text-primary">{{ $page->slug }}</code>
                                    @else
                                        <span class="text-muted">No slug</span>
                                    @endif
                                </td>
                                <td>
                                    @if($page->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <small>
                                        {{ $page->created_at->format('M d, Y') }}<br>
                                        <span class="text-muted">{{ $page->created_at->format('g:i A') }}</span>
                                    </small>
                                </td>
                                <td>
                                    <small>
                                        {{ $page->updated_at->format('M d, Y') }}<br>
                                        <span class="text-muted">{{ $page->updated_at->diffForHumans() }}</span>
                                    </small>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.pages.show', $page) }}" 
                                           class="btn btn-sm btn-outline-info" 
                                           title="View Page">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <a href="{{ route('admin.pages.edit', $page) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="Edit Page">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-{{ $page->is_active ? 'warning' : 'success' }}" 
                                                onclick="toggleStatus({{ $page->id }}, {{ $page->is_active ? 'false' : 'true' }})"
                                                title="{{ $page->is_active ? 'Deactivate' : 'Activate' }} Page">
                                            <i class="fas fa-{{ $page->is_active ? 'eye-slash' : 'eye' }}"></i>
                                        </button>
                                        
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger" 
                                                onclick="deletePage({{ $page->id }}, '{{ $page->title }}')"
                                                title="Delete Page">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    
                                    @if($page->slug)
                                        <div class="mt-1">
                                            <a href="{{ url($page->slug) }}" 
                                               target="_blank" 
                                               class="btn btn-sm btn-outline-secondary" 
                                               title="View on Website">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($pages->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Showing {{ $pages->firstItem() }} to {{ $pages->lastItem() }} of {{ $pages->total() }} results
                            </small>
                        </div>
                        <div>
                            {{ $pages->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-file-alt fa-3x text-muted"></i>
                </div>
                <h5>No Pages Found</h5>
                <p class="text-muted mb-3">
                    @if(request('search') || request('status'))
                        No pages match your search criteria.
                    @else
                        You haven't created any pages yet.
                    @endif
                </p>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-times me-1"></i>Clear Filters
                    </a>
                @endif
                <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Create Your First Page
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Status Toggle Form -->
<form id="toggle-status-form" method="POST" style="display: none;">
    @csrf
    @method('PATCH')
</form>

<!-- Delete Form -->
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
    function toggleStatus(pageId, newStatus) {
        const form = document.getElementById('toggle-status-form');
        const action = `{{ route('admin.pages.toggle-status', ':id') }}`.replace(':id', pageId);
        
        form.action = action;
        
        if (confirm(`Are you sure you want to ${newStatus ? 'activate' : 'deactivate'} this page?`)) {
            form.submit();
        }
    }
    
    function deletePage(pageId, pageTitle) {
        const form = document.getElementById('delete-form');
        const action = `{{ route('admin.pages.destroy', ':id') }}`.replace(':id', pageId);
        
        form.action = action;
        
        if (confirm(`Are you sure you want to delete the page "${pageTitle}"?\n\nThis action cannot be undone.`)) {
            form.submit();
        }
    }
    
    // Auto-submit form on status change
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[name="search"]');
        const form = searchInput.closest('form');
        
        // Auto-submit search after typing stops
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (this.value.length >= 3 || this.value.length === 0) {
                    form.submit();
                }
            }, 500);
        });
    });
</script>
@endpush

@push('styles')
<style>
    .table td {
        vertical-align: middle;
    }
    
    .btn-group .btn {
        border-radius: 0.375rem !important;
        margin-right: 2px;
    }
    
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    
    .table-responsive {
        border-radius: 0;
    }
    
    @media (max-width: 768px) {
        .card-header .row {
            flex-direction: column;
            gap: 1rem;
        }
        
        .d-flex.gap-2 {
            flex-direction: column;
        }
        
        .input-group, .form-select {
            width: 100% !important;
        }
    }
</style>
@endpush
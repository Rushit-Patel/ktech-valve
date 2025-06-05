@extends('admin.layouts.app')

@section('title', 'SEO Management')
@section('page-title', 'SEO Management')

@section('page-actions')
    <a href="{{ route('admin.seo.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Add SEO Settings
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0">SEO Settings</h5>
            </div>
            <div class="col-auto">
                <form method="GET" action="{{ route('admin.seo.index') }}" class="d-flex gap-2">
                    <select class="form-select" name="page_type" onchange="this.form.submit()" style="width: 200px;">
                        <option value="">All Page Types</option>
                        @foreach($pageTypes as $key => $label)
                            <option value="{{ $key }}" {{ request('page_type') === $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    
                    @if(request('page_type'))
                        <a href="{{ route('admin.seo.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
    
    <div class="card-body p-0">
        @if($seoSettings->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Page Type</th>
                            <th>Page/Item</th>
                            <th>Meta Title</th>
                            <th>Meta Description</th>
                            <th>OG Image</th>
                            <th>Status</th>
                            <th width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($seoSettings as $seoSetting)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $pageTypes[$seoSetting->page_type] ?? ucfirst($seoSetting->page_type) }}
                                    </span>
                                </td>
                                <td>
                                    <div>
                                        @if($seoSetting->page_identifier)
                                            <strong>{{ $seoSetting->getPageIdentifierLabel() }}</strong>
                                        @else
                                            <span class="text-muted">General Settings</span>
                                        @endif
                                    </div>
                                    @if($seoSetting->canonical_url)
                                        <div class="text-muted small">
                                            <i class="fas fa-link fa-xs"></i>
                                            <a href="{{ $seoSetting->canonical_url }}" target="_blank" class="text-decoration-none">
                                                {{ Str::limit($seoSetting->canonical_url, 40) }}
                                            </a>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if($seoSetting->meta_title)
                                        <div title="{{ $seoSetting->meta_title }}">
                                            {{ Str::limit($seoSetting->meta_title, 40) }}
                                        </div>
                                        <small class="text-muted">{{ strlen($seoSetting->meta_title) }} chars</small>
                                    @else
                                        <span class="text-muted">Not set</span>
                                    @endif
                                </td>
                                <td>
                                    @if($seoSetting->meta_description)
                                        <div title="{{ $seoSetting->meta_description }}">
                                            {{ Str::limit($seoSetting->meta_description, 60) }}
                                        </div>
                                        <small class="text-muted">{{ strlen($seoSetting->meta_description) }} chars</small>
                                    @else
                                        <span class="text-muted">Not set</span>
                                    @endif
                                </td>
                                <td>
                                    @if($seoSetting->og_image)
                                        <img src="{{ asset('storage/' . $seoSetting->og_image) }}" 
                                             alt="OG Image" 
                                             class="rounded"
                                             style="width: 40px; height: 30px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>
                                    @if($seoSetting->robots_meta)
                                        <span class="badge bg-{{ str_contains($seoSetting->robots_meta, 'noindex') ? 'warning' : 'success' }}">
                                            {{ ucfirst($seoSetting->robots_meta) }}
                                        </span>
                                    @else
                                        <span class="badge bg-success">Index, Follow</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.seo.edit', $seoSetting->id) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="Edit SEO Settings">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-info" 
                                                onclick="previewSEO({{ $seoSetting->id }})"
                                                title="Preview SEO">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger" 
                                                onclick="deleteSeoSetting({{ $seoSetting->id }}, '{{ $pageTypes[$seoSetting->page_type] ?? $seoSetting->page_type }}')"
                                                title="Delete SEO Settings">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($seoSettings->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Showing {{ $seoSettings->firstItem() }} to {{ $seoSettings->lastItem() }} of {{ $seoSettings->total() }} results
                            </small>
                        </div>
                        <div>
                            {{ $seoSettings->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-search fa-3x text-muted"></i>
                </div>
                <h5>No SEO Settings Found</h5>
                <p class="text-muted mb-3">
                    @if(request('page_type'))
                        No SEO settings found for the selected page type.
                    @else
                        You haven't configured any SEO settings yet.
                    @endif
                </p>
                @if(request('page_type'))
                    <a href="{{ route('admin.seo.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-times me-1"></i>Clear Filter
                    </a>
                @endif
                <a href="{{ route('admin.seo.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Add First SEO Setting
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Quick Add SEO Modal -->
<div class="modal fade" id="quickAddModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Quick Add SEO Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach($pageTypes as $key => $label)
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $label }}</h6>
                                    <p class="card-text small text-muted">
                                        @switch($key)
                                            @case('homepage')
                                                Configure SEO for your homepage
                                                @break
                                            @case('product')
                                                Set SEO for individual products
                                                @break
                                            @case('product_category')
                                                Configure category page SEO
                                                @break
                                            @case('page')
                                                Set SEO for static pages
                                                @break
                                            @case('industry')
                                                Configure industry page SEO
                                                @break
                                            @case('contact')
                                                Set contact page SEO
                                                @break
                                            @case('about')
                                                Configure about page SEO
                                                @break
                                            @case('gallery')
                                                Set gallery page SEO
                                                @break
                                        @endswitch
                                    </p>
                                    <a href="{{ route('admin.seo.create', ['page_type' => $key]) }}" 
                                       class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus me-1"></i>Add SEO
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SEO Preview Modal -->
<div class="modal fade" id="seoPreviewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">SEO Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="seo-preview-content">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
function previewSEO(seoId) {
    // You can implement AJAX call to load SEO preview
    const modal = new bootstrap.Modal(document.getElementById('seoPreviewModal'));
    
    // For now, show a simple preview
    document.getElementById('seo-preview-content').innerHTML = `
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading SEO preview...</p>
        </div>
    `;
    
    modal.show();
    
    // Simulate loading (you can replace this with actual AJAX call)
    setTimeout(() => {
        document.getElementById('seo-preview-content').innerHTML = `
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                SEO Preview functionality can be implemented to show how the page appears in search results.
            </div>
        `;
    }, 1000);
}

function deleteSeoSetting(seoId, pageType) {
    const form = document.getElementById('delete-form');
    const action = `{{ route('admin.seo.destroy', ':id') }}`.replace(':id', seoId);
    
    form.action = action;
    
    if (confirm(`Are you sure you want to delete SEO settings for "${pageType}"?\n\nThis action cannot be undone.`)) {
        form.submit();
    }
}

// Show quick add modal
function showQuickAdd() {
    const modal = new bootstrap.Modal(document.getElementById('quickAddModal'));
    modal.show();
}
</script>
@endpush

@push('styles')
<style>
.table th {
    border-top: none;
    font-weight: 600;
    font-size: 0.875rem;
}

.btn-group .btn {
    border-radius: 0.375rem !important;
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

@media (max-width: 768px) {
    .card-header .row {
        flex-direction: column;
        gap: 1rem;
    }
    
    .d-flex.gap-2 {
        flex-direction: column;
    }
    
    .form-select {
        width: 100% !important;
    }
}
</style>
@endpush
@extends('admin.layouts.app')

@section('title', 'Gallery Management')
@section('page-title', 'Gallery Management')

@section('page-actions')
    <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Add New Image
    </a>
    <button type="button" class="btn btn-danger" id="bulk-delete-btn" style="display: none;" onclick="bulkDelete()">
        <i class="fas fa-trash me-1"></i>Delete Selected
    </button>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0">Gallery Images</h5>
            </div>
            <div class="col-auto">
                <form method="GET" action="{{ route('admin.galleries.index') }}" class="d-flex gap-2">
                    <div class="input-group" style="width: 300px;">
                        <input type="text" 
                               class="form-control" 
                               name="search" 
                               placeholder="Search images..." 
                               value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    
                    <select name="category" class="form-select" style="width: 150px;" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>
                                {{ ucwords(str_replace('_', ' ', $category)) }}
                            </option>
                        @endforeach
                    </select>
                    
                    <select name="status" class="form-select" style="width: 150px;" onchange="this.form.submit()">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    
                    @if(request('search') || request('category') || request('status'))
                        <a href="{{ route('admin.galleries.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
    
    <div class="card-body p-0">
        @if($galleries->count() > 0)
            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="select-all">
                    <label class="form-check-label" for="select-all">
                        Select All
                    </label>
                </div>
                <div>
                    <small class="text-muted">
                        Showing {{ $galleries->firstItem() }} to {{ $galleries->lastItem() }} of {{ $galleries->total() }} images
                    </small>
                </div>
            </div>
            
            <div class="row g-3 p-3" id="gallery-grid">
                @foreach($galleries as $gallery)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="card gallery-item h-100" data-id="{{ $gallery->id }}">
                            <div class="position-relative">
                                <div class="form-check position-absolute top-0 start-0 m-2" style="z-index: 10;">
                                    <input class="form-check-input gallery-checkbox" 
                                           type="checkbox" 
                                           value="{{ $gallery->id }}" 
                                           id="gallery-{{ $gallery->id }}">
                                </div>
                                
                                <div class="position-absolute top-0 end-0 m-2" style="z-index: 10;">
                                    @if($gallery->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </div>
                                
                                <div class="gallery-image-container" onclick="viewImage('{{ asset('storage/' . $gallery->image) }}', '{{ $gallery->title ?: 'Gallery Image' }}')">
                                    <img src="{{ asset('storage/' . $gallery->image) }}" 
                                         alt="{{ $gallery->alt_text ?: $gallery->title }}" 
                                         class="card-img-top gallery-image">
                                    <div class="image-overlay">
                                        <i class="fas fa-eye fa-2x text-white"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="card-title mb-0">
                                        {{ $gallery->title ?: 'Untitled Image' }}
                                    </h6>
                                    <small class="text-muted">#{{ $gallery->sort_order }}</small>
                                </div>
                                
                                @if($gallery->category)
                                    <span class="badge bg-primary mb-2">{{ ucwords(str_replace('_', ' ', $gallery->category)) }}</span>
                                @endif
                                
                                @if($gallery->description)
                                    <p class="card-text small text-muted mb-2">
                                        {{ Str::limit($gallery->description, 60) }}
                                    </p>
                                @endif
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        {{ $gallery->created_at->format('M d, Y') }}
                                    </small>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.galleries.show', $gallery->id) }}" 
                                           class="btn btn-sm btn-outline-info" 
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <a href="{{ route('admin.galleries.edit', $gallery->id) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="Edit Image">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-{{ $gallery->is_active ? 'warning' : 'success' }}" 
                                                onclick="toggleStatus({{ $gallery->id }}, {{ $gallery->is_active ? 'false' : 'true' }})"
                                                title="{{ $gallery->is_active ? 'Deactivate' : 'Activate' }} Image">
                                            <i class="fas fa-{{ $gallery->is_active ? 'eye-slash' : 'eye' }}"></i>
                                        </button>
                                        
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger" 
                                                onclick="deleteGallery({{ $gallery->id }}, '{{ $gallery->title ?: 'this image' }}')"
                                                title="Delete Image">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($galleries->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Showing {{ $galleries->firstItem() }} to {{ $galleries->lastItem() }} of {{ $galleries->total() }} results
                            </small>
                        </div>
                        <div>
                            {{ $galleries->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-images fa-3x text-muted"></i>
                </div>
                <h5>No Gallery Images Found</h5>
                <p class="text-muted mb-3">
                    @if(request('search') || request('category') || request('status'))
                        No images match your search criteria.
                    @else
                        You haven't uploaded any images to the gallery yet.
                    @endif
                </p>
                @if(request('search') || request('category') || request('status'))
                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-times me-1"></i>Clear Filters
                    </a>
                @endif
                <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Upload Your First Image
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Image Preview Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalTitle">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" class="img-fluid" style="max-height: 70vh;">
            </div>
        </div>
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

<!-- Bulk Delete Form -->
<form id="bulk-delete-form" method="POST" action="{{ route('admin.galleries.bulk-delete') }}" style="display: none;">
    @csrf
    <input type="hidden" name="galleries" id="bulk-galleries">
</form>
@endsection

@push('scripts')
<script>
    // Image preview functionality
    function viewImage(imageSrc, title) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModalTitle').textContent = title;
        const modal = new bootstrap.Modal(document.getElementById('imageModal'));
        modal.show();
    }
    
    // Toggle status functionality
    function toggleStatus(galleryId, newStatus) {
        const form = document.getElementById('toggle-status-form');
        const action = `{{ route('admin.galleries.toggle-status', ':id') }}`.replace(':id', galleryId);
        
        form.action = action;
        
        if (confirm(`Are you sure you want to ${newStatus ? 'activate' : 'deactivate'} this image?`)) {
            form.submit();
        }
    }
    
    // Delete functionality
    function deleteGallery(galleryId, galleryTitle) {
        const form = document.getElementById('delete-form');
        const action = `{{ route('admin.galleries.destroy', ':id') }}`.replace(':id', galleryId);
        
        form.action = action;
        
        if (confirm(`Are you sure you want to delete "${galleryTitle}"?\n\nThis action cannot be undone.`)) {
            form.submit();
        }
    }
    
    // Bulk selection functionality
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('select-all');
        const galleryCheckboxes = document.querySelectorAll('.gallery-checkbox');
        const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
        
        // Select all functionality
        selectAllCheckbox?.addEventListener('change', function() {
            galleryCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            toggleBulkDeleteButton();
        });
        
        // Individual checkbox change
        galleryCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                // Update select all checkbox
                const checkedBoxes = document.querySelectorAll('.gallery-checkbox:checked');
                selectAllCheckbox.checked = checkedBoxes.length === galleryCheckboxes.length;
                selectAllCheckbox.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < galleryCheckboxes.length;
                
                toggleBulkDeleteButton();
            });
        });
        
        function toggleBulkDeleteButton() {
            const checkedBoxes = document.querySelectorAll('.gallery-checkbox:checked');
            bulkDeleteBtn.style.display = checkedBoxes.length > 0 ? 'inline-block' : 'none';
        }
    });
    
    // Bulk delete functionality
    function bulkDelete() {
        const checkedBoxes = document.querySelectorAll('.gallery-checkbox:checked');
        
        if (checkedBoxes.length === 0) {
            alert('Please select at least one image to delete.');
            return;
        }
        
        const galleryIds = Array.from(checkedBoxes).map(cb => cb.value);
        
        if (confirm(`Are you sure you want to delete ${checkedBoxes.length} selected image(s)?\n\nThis action cannot be undone.`)) {
            document.getElementById('bulk-galleries').value = JSON.stringify(galleryIds);
            document.getElementById('bulk-delete-form').submit();
        }
    }
    
    // Auto-submit form on filter change with debouncing
    const searchInput = document.querySelector('input[name="search"]');
    const form = searchInput?.closest('form');
    
    let searchTimeout;
    searchInput?.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            if (this.value.length >= 3 || this.value.length === 0) {
                form.submit();
            }
        }, 500);
    });
</script>
@endpush

@push('styles')
<style>
    .gallery-image-container {
        position: relative;
        height: 200px;
        overflow: hidden;
        cursor: pointer;
        border-radius: 0.375rem 0.375rem 0 0;
    }
    
    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .gallery-image-container:hover .gallery-image {
        transform: scale(1.1);
    }
    
    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .gallery-image-container:hover .image-overlay {
        opacity: 1;
    }
    
    .gallery-item {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    
    .gallery-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .btn-group .btn {
        border-radius: 0.375rem !important;
        margin-right: 2px;
    }
    
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    
    .card-title {
        font-size: 0.875rem;
        font-weight: 600;
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
        
        .gallery-image-container {
            height: 150px;
        }
    }
    
    @media (max-width: 576px) {
        .col-sm-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>
@endpush
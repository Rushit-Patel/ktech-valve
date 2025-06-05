@extends('admin.layouts.app')

@section('title', 'Gallery Image Details')
@section('page-title', 'Gallery Image Details')

@section('page-actions')
    <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Gallery
    </a>
    <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="btn btn-primary">
        <i class="fas fa-edit me-1"></i>Edit Image
    </a>
    <button type="button" 
            class="btn btn-{{ $gallery->is_active ? 'warning' : 'success' }}" 
            onclick="toggleStatus({{ $gallery->id }}, {{ $gallery->is_active ? 'false' : 'true' }})">
        <i class="fas fa-{{ $gallery->is_active ? 'eye-slash' : 'eye' }} me-1"></i>
        {{ $gallery->is_active ? 'Deactivate' : 'Activate' }}
    </button>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $gallery->title ?: 'Gallery Image' }}</h5>
                @if($gallery->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </div>
            <div class="card-body">
                @if($gallery->image)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $gallery->image) }}" 
                             alt="{{ $gallery->alt_text ?: $gallery->title }}" 
                             class="img-fluid rounded shadow"
                             style="max-height: 500px; cursor: pointer;"
                             onclick="openImageModal('{{ asset('storage/' . $gallery->image) }}', '{{ $gallery->title ?: 'Gallery Image' }}')">
                    </div>
                @else
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-image fa-3x mb-3"></i>
                        <p>No image uploaded</p>
                    </div>
                @endif
                
                @if($gallery->description)
                    <div class="mb-3">
                        <h6>Description:</h6>
                        <p class="text-muted">{{ $gallery->description }}</p>
                    </div>
                @endif
            </div>
        </div>
        
        @if($gallery->image)
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Image Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>File Size:</strong></td>
                                    <td>
                                        @php
                                            $filePath = storage_path('app/public/' . $gallery->image);
                                            $fileSize = file_exists($filePath) ? filesize($filePath) : 0;
                                        @endphp
                                        {{ $fileSize > 0 ? number_format($fileSize / 1024, 2) . ' KB' : 'Unknown' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>File Type:</strong></td>
                                    <td>{{ strtoupper(pathinfo($gallery->image, PATHINFO_EXTENSION)) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Alt Text:</strong></td>
                                    <td>{{ $gallery->alt_text ?: 'Not set' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm">
                                @if($gallery->image && file_exists(storage_path('app/public/' . $gallery->image)))
                                    @php
                                        $imageInfo = getimagesize(storage_path('app/public/' . $gallery->image));
                                    @endphp
                                    <tr>
                                        <td><strong>Dimensions:</strong></td>
                                        <td>{{ $imageInfo[0] ?? 'Unknown' }} × {{ $imageInfo[1] ?? 'Unknown' }} pixels</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td><strong>Upload Date:</strong></td>
                                    <td>{{ $gallery->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Last Modified:</strong></td>
                                    <td>{{ $gallery->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Gallery Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>ID:</strong></td>
                        <td>#{{ $gallery->id }}</td>
                    </tr>
                    <tr>
                        <td><strong>Title:</strong></td>
                        <td>{{ $gallery->title ?: 'Not set' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Category:</strong></td>
                        <td>
                            @if($gallery->category)
                                <span class="badge bg-primary">
                                    {{ ucwords(str_replace('_', ' ', $gallery->category)) }}
                                </span>
                            @else
                                <span class="text-muted">Not categorized</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Sort Order:</strong></td>
                        <td>{{ $gallery->sort_order ?? 0 }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            @if($gallery->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-1"></i>Edit Image
                    </a>
                    
                    <button type="button" 
                            class="btn btn-{{ $gallery->is_active ? 'warning' : 'success' }}" 
                            onclick="toggleStatus({{ $gallery->id }}, {{ $gallery->is_active ? 'false' : 'true' }})">
                        <i class="fas fa-{{ $gallery->is_active ? 'eye-slash' : 'eye' }} me-1"></i>
                        {{ $gallery->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                    
                    @if($gallery->image)
                        <a href="{{ asset('storage/' . $gallery->image) }}" 
                           target="_blank" 
                           class="btn btn-info">
                            <i class="fas fa-external-link-alt me-1"></i>View Full Size
                        </a>
                        
                        <button type="button" 
                                class="btn btn-secondary"
                                onclick="copyImageUrl()">
                            <i class="fas fa-copy me-1"></i>Copy Image URL
                        </button>
                    @endif
                    
                    <hr>
                    
                    <button type="button" 
                            class="btn btn-danger" 
                            onclick="deleteGallery()">
                        <i class="fas fa-trash me-1"></i>Delete Image
                    </button>
                </div>
            </div>
        </div>
        
        @if($gallery->image)
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Frontend URLs</h5>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <small class="text-muted">Direct Image URL:</small>
                        <div class="input-group input-group-sm">
                            <input type="text" 
                                   class="form-control" 
                                   id="image-url" 
                                   value="{{ asset('storage/' . $gallery->image) }}" 
                                   readonly>
                            <button class="btn btn-outline-secondary" 
                                    type="button" 
                                    onclick="copyToClipboard('image-url')">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalTitle">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" class="img-fluid">
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
<form id="delete-form" method="POST" action="{{ route('admin.galleries.destroy', $gallery->id) }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
function openImageModal(imageSrc, title) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModalTitle').textContent = title;
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
}

function toggleStatus(galleryId, newStatus) {
    const form = document.getElementById('toggle-status-form');
    const action = `{{ route('admin.galleries.toggle-status', ':id') }}`.replace(':id', galleryId);
    
    form.action = action;
    
    if (confirm(`Are you sure you want to ${newStatus === 'true' ? 'activate' : 'deactivate'} this image?`)) {
        form.submit();
    }
}

function deleteGallery() {
    if (confirm('Are you sure you want to delete this image?\n\nThis action cannot be undone.')) {
        document.getElementById('delete-form').submit();
    }
}

function copyImageUrl() {
    const imageUrl = document.getElementById('image-url').value;
    copyToClipboard('image-url');
}

function copyToClipboard(elementId) {
    const element = document.getElementById(elementId);
    element.select();
    element.setSelectionRange(0, 99999);
    
    try {
        document.execCommand('copy');
        // Show success message (you can customize this)
        const toast = document.createElement('div');
        toast.className = 'toast-container position-fixed top-0 end-0 p-3';
        toast.innerHTML = `
            <div class="toast show" role="alert">
                <div class="toast-header">
                    <i class="fas fa-check-circle text-success me-2"></i>
                    <strong class="me-auto">Success</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    URL copied to clipboard!
                </div>
            </div>
        `;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 3000);
    } catch (err) {
        console.error('Failed to copy: ', err);
    }
}
</script>
@endpush
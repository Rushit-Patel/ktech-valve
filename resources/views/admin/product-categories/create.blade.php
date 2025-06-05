@extends('admin.layouts.app')

@section('title', 'Add New Category')
@section('page-title', 'Add New Product Category')

@section('page-actions')
    <a href="{{ route('admin.product-categories.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Categories
    </a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.product-categories.store') }}" enctype="multipart/form-data">
    @csrf
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Category Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Leave empty to auto-generate from name.</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- SEO Section -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">SEO Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" maxlength="255">
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Recommended length: 50-60 characters</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="3" maxlength="500">{{ old('meta_description') }}</textarea>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Recommended length: 150-160 characters</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                        <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}">
                        @error('meta_keywords')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Separate keywords with commas</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Category Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                        <small class="form-text text-muted">Only active categories will be visible on the website</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Lower numbers appear first</small>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Category Image</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="image" class="form-label">Category Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Supported formats: JPEG, PNG, JPG, WEBP. Max size: 2MB</small>
                    </div>
                    
                    <!-- Image Preview -->
                    <div id="image-preview" class="mt-3" style="display: none;">
                        <label class="form-label">Preview:</label>
                        <div class="border rounded p-2 text-center">
                            <img id="preview-img" src="" alt="Preview" class="img-fluid" style="max-height: 200px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.product-categories.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Category</button>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-generate slug from name
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');
        
        nameInput.addEventListener('input', function() {
            if (!slugInput.dataset.manual) {
                const name = this.value;
                const slug = name.toLowerCase()
                    .replace(/[^a-z0-9 -]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim('-');
                slugInput.value = slug;
            }
        });
        
        // Mark slug as manually edited if user types in it
        slugInput.addEventListener('input', function() {
            this.dataset.manual = 'true';
        });
        
        // Image preview functionality
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');
        
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none';
            }
        });
        
        // Auto-generate meta title from name if empty
        const metaTitleInput = document.getElementById('meta_title');
        nameInput.addEventListener('input', function() {
            if (!metaTitleInput.value || !metaTitleInput.dataset.manual) {
                metaTitleInput.value = this.value;
            }
        });
        
        metaTitleInput.addEventListener('input', function() {
            this.dataset.manual = 'true';
        });
        
        // Character counter for meta description
        const metaDescInput = document.getElementById('meta_description');
        const metaDescCounter = document.createElement('small');
        metaDescCounter.className = 'form-text text-muted';
        metaDescInput.parentNode.appendChild(metaDescCounter);
        
        function updateMetaDescCounter() {
            const length = metaDescInput.value.length;
            const maxLength = 500;
            metaDescCounter.textContent = `${length}/${maxLength} characters`;
            
            if (length > 160) {
                metaDescCounter.className = 'form-text text-warning';
            } else if (length > maxLength) {
                metaDescCounter.className = 'form-text text-danger';
            } else {
                metaDescCounter.className = 'form-text text-muted';
            }
        }
        
        metaDescInput.addEventListener('input', updateMetaDescCounter);
        updateMetaDescCounter(); // Initialize counter
        
        // Character counter for meta title
        const metaTitleCounter = document.createElement('small');
        metaTitleCounter.className = 'form-text text-muted';
        metaTitleInput.parentNode.appendChild(metaTitleCounter);
        
        function updateMetaTitleCounter() {
            const length = metaTitleInput.value.length;
            const maxLength = 255;
            metaTitleCounter.textContent = `${length}/${maxLength} characters`;
            
            if (length > 60) {
                metaTitleCounter.className = 'form-text text-warning';
            } else if (length > maxLength) {
                metaTitleCounter.className = 'form-text text-danger';
            } else {
                metaTitleCounter.className = 'form-text text-muted';
            }
        }
        
        metaTitleInput.addEventListener('input', updateMetaTitleCounter);
        updateMetaTitleCounter(); // Initialize counter
    });
</script>
@endpush

@push('styles')
<style>
    .form-text.text-warning {
        color: #856404 !important;
    }
    .form-text.text-danger {
        color: #721c24 !important;
    }
    #image-preview img {
        border-radius: 4px;
    }
</style>
@endpush
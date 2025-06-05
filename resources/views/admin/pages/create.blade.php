@extends('admin.layouts.app')

@section('title', 'Add New Page')
@section('page-title', 'Add New Page')

@section('page-actions')
    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Pages
    </a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.pages.store') }}" enctype="multipart/form-data">
    @csrf
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Page Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Page Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Leave empty to auto-generate from title.</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">Page Content</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="15">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">SEO Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" maxlength="255">
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <span id="meta-title-count">0</span>/255 characters
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="3" maxlength="500">{{ old('meta_description') }}</textarea>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <span id="meta-description-count">0</span>/500 characters. Recommended: 150-160 characters
                        </div>
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
                    <h5 class="mb-0">Page Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                        <small class="form-text text-muted">Page will be visible on the website when active</small>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Banner Image</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="banner_image" class="form-label">Banner Image</label>
                        <input type="file" class="form-control @error('banner_image') is-invalid @enderror" id="banner_image" name="banner_image" accept="image/jpeg,image/png,image/jpg,image/webp">
                        @error('banner_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Accepted formats: JPEG, PNG, JPG, WebP. Max size: 2MB</small>
                        
                        <div id="image-preview-container" style="display: none;" class="mt-3">
                            <img id="image-preview" class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-outline-secondary" onclick="previewPage()">
                            <i class="fas fa-eye me-1"></i>Preview Content
                        </button>
                        <button type="button" class="btn btn-outline-info" onclick="autoGenerateSEO()">
                            <i class="fas fa-magic me-1"></i>Auto-generate SEO
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-12">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Page</button>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    let editor;
    
    ClassicEditor
        .create(document.querySelector('#content'))
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => {
            console.error(error);
        });
    
    // Auto-generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9 -]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim('-');
        document.getElementById('slug').value = slug;
        
        // Auto-generate meta title if empty
        const metaTitle = document.getElementById('meta_title');
        if (!metaTitle.value) {
            metaTitle.value = title;
            updateCharacterCount('meta_title', 'meta-title-count');
        }
    });
    
    // Character counters
    function updateCharacterCount(fieldId, counterId) {
        const field = document.getElementById(fieldId);
        const counter = document.getElementById(counterId);
        if (field && counter) {
            counter.textContent = field.value.length;
        }
    }
    
    document.getElementById('meta_title').addEventListener('input', function() {
        updateCharacterCount('meta_title', 'meta-title-count');
    });
    
    document.getElementById('meta_description').addEventListener('input', function() {
        updateCharacterCount('meta_description', 'meta-description-count');
    });
    
    // Image preview
    document.getElementById('banner_image').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                const container = document.getElementById('image-preview-container');
                preview.src = e.target.result;
                container.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Auto-generate SEO
    function autoGenerateSEO() {
        const title = document.getElementById('title').value;
        const content = editor.getData();
        
        if (!title) {
            alert('Please enter a page title first.');
            return;
        }
        
        // Generate meta title
        document.getElementById('meta_title').value = title;
        updateCharacterCount('meta_title', 'meta-title-count');
        
        // Generate meta description from content
        const textContent = content.replace(/<[^>]*>/g, '').substring(0, 160);
        document.getElementById('meta_description').value = textContent;
        updateCharacterCount('meta_description', 'meta-description-count');
        
        alert('SEO fields have been auto-generated. Please review and modify as needed.');
    }
    
    // Preview page
    function previewPage() {
        const title = document.getElementById('title').value;
        const content = editor.getData();
        
        if (!title && !content) {
            alert('Please add some content to preview.');
            return;
        }
        
        const previewWindow = window.open('', '_blank', 'width=800,height=600');
        previewWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>${title}</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 40px; line-height: 1.6; }
                    h1 { color: #333; border-bottom: 2px solid #eee; padding-bottom: 10px; }
                </style>
            </head>
            <body>
                <h1>${title}</h1>
                <div>${content}</div>
            </body>
            </html>
        `);
        previewWindow.document.close();
    }
    
    // Initialize character counters
    document.addEventListener('DOMContentLoaded', function() {
        updateCharacterCount('meta_title', 'meta-title-count');
        updateCharacterCount('meta_description', 'meta-description-count');
    });
</script>
@endpush
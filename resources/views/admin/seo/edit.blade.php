@extends('admin.layouts.app')

@section('title', 'Edit SEO Settings')
@section('page-title', 'Edit SEO Settings')

@section('page-actions')
    <a href="{{ route('admin.seo.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to SEO Settings
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('admin.seo.update', $seoSetting->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Basic SEO Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="page_type" class="form-label">Page Type</label>
                                <select class="form-select" id="page_type" name="page_type" disabled>
                                    @foreach($pageTypes as $key => $label)
                                        <option value="{{ $key }}" {{ $seoSetting->page_type === $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="page_type" value="{{ $seoSetting->page_type }}">
                                <div class="form-text">Page type cannot be changed after creation</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="page_identifier" class="form-label">Specific Page/Item</label>
                                <select class="form-select" id="page_identifier" name="page_identifier" disabled>
                                    <option value="">General Settings for Page Type</option>
                                    @if($availableItems)
                                        @foreach($availableItems as $item)
                                            <option value="{{ $item['value'] }}" {{ $seoSetting->page_identifier === $item['value'] ? 'selected' : '' }}>
                                                {{ $item['label'] }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <input type="hidden" name="page_identifier" value="{{ $seoSetting->page_identifier }}">
                                <div class="form-text">Page identifier cannot be changed after creation</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Meta Tags</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" 
                               class="form-control @error('meta_title') is-invalid @enderror" 
                               id="meta_title" 
                               name="meta_title" 
                               value="{{ old('meta_title', $seoSetting->meta_title) }}"
                               maxlength="255"
                               placeholder="Enter meta title...">
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <span id="meta-title-count">{{ strlen($seoSetting->meta_title ?? '') }}</span>/255 characters
                            <span class="text-muted">| Recommended: 50-60 characters</span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                  id="meta_description" 
                                  name="meta_description" 
                                  rows="3"
                                  maxlength="500"
                                  placeholder="Enter meta description...">{{ old('meta_description', $seoSetting->meta_description) }}</textarea>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <span id="meta-description-count">{{ strlen($seoSetting->meta_description ?? '') }}</span>/500 characters
                            <span class="text-muted">| Recommended: 150-160 characters</span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                        <input type="text" 
                               class="form-control @error('meta_keywords') is-invalid @enderror" 
                               id="meta_keywords" 
                               name="meta_keywords" 
                               value="{{ old('meta_keywords', $seoSetting->meta_keywords) }}"
                               placeholder="keyword1, keyword2, keyword3...">
                        @error('meta_keywords')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Separate keywords with commas</div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Open Graph (Social Media)</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="og_title" class="form-label">OG Title</label>
                        <input type="text" 
                               class="form-control @error('og_title') is-invalid @enderror" 
                               id="og_title" 
                               name="og_title" 
                               value="{{ old('og_title', $seoSetting->og_title) }}"
                               maxlength="255"
                               placeholder="Open Graph title...">
                        @error('og_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Used when shared on social media</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="og_description" class="form-label">OG Description</label>
                        <textarea class="form-control @error('og_description') is-invalid @enderror" 
                                  id="og_description" 
                                  name="og_description" 
                                  rows="3"
                                  maxlength="500"
                                  placeholder="Open Graph description...">{{ old('og_description', $seoSetting->og_description) }}</textarea>
                        @error('og_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="og_image" class="form-label">OG Image</label>
                        <input type="file" 
                               class="form-control @error('og_image') is-invalid @enderror" 
                               id="og_image" 
                               name="og_image" 
                               accept="image/*"
                               onchange="previewOgImage(this)">
                        @error('og_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Leave empty to keep current image. Recommended size: 1200x630px. Supported formats: JPEG, PNG, JPG, WebP. Max: 2MB
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Advanced Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="canonical_url" class="form-label">Canonical URL</label>
                        <input type="url" 
                               class="form-control @error('canonical_url') is-invalid @enderror" 
                               id="canonical_url" 
                               name="canonical_url" 
                               value="{{ old('canonical_url', $seoSetting->canonical_url) }}"
                               placeholder="https://example.com/page">
                        @error('canonical_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Helps prevent duplicate content issues</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="robots_meta" class="form-label">Robots Meta</label>
                        <select class="form-select @error('robots_meta') is-invalid @enderror" 
                                id="robots_meta" 
                                name="robots_meta">
                            <option value="">Default (index, follow)</option>
                            <option value="index, follow" {{ old('robots_meta', $seoSetting->robots_meta) === 'index, follow' ? 'selected' : '' }}>Index, Follow</option>
                            <option value="noindex, follow" {{ old('robots_meta', $seoSetting->robots_meta) === 'noindex, follow' ? 'selected' : '' }}>No Index, Follow</option>
                            <option value="index, nofollow" {{ old('robots_meta', $seoSetting->robots_meta) === 'index, nofollow' ? 'selected' : '' }}>Index, No Follow</option>
                            <option value="noindex, nofollow" {{ old('robots_meta', $seoSetting->robots_meta) === 'noindex, nofollow' ? 'selected' : '' }}>No Index, No Follow</option>
                        </select>
                        @error('robots_meta')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="schema_markup" class="form-label">Schema Markup (JSON-LD)</label>
                        <textarea class="form-control @error('schema_markup') is-invalid @enderror" 
                                  id="schema_markup" 
                                  name="schema_markup" 
                                  rows="5"
                                  placeholder='{"@context": "https://schema.org", "@type": "WebPage", "name": "Page Name"}'>{{ old('schema_markup', is_array($seoSetting->schema_markup) ? json_encode($seoSetting->schema_markup, JSON_PRETTY_PRINT) : $seoSetting->schema_markup) }}</textarea>
                        @error('schema_markup')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Valid JSON-LD schema markup for structured data</div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between gap-2 mt-4">
                <button type="button" 
                        class="btn btn-danger" 
                        onclick="deleteSeoSetting()">
                    <i class="fas fa-trash me-1"></i>Delete SEO Settings
                </button>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.seo.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Update SEO Settings
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">SEO Preview</h5>
            </div>
            <div class="card-body">
                <div id="seo-preview" class="border rounded p-3" style="background-color: #f8f9fa;">
                    <div id="preview-title" class="text-primary" style="font-size: 18px; line-height: 1.2;">
                        {{ $seoSetting->meta_title ?: 'Your Meta Title Here' }}
                    </div>
                    <div id="preview-url" class="text-success small">
                        {{ $seoSetting->canonical_url ?: 'https://yoursite.com/page-url' }}
                    </div>
                    <div id="preview-description" class="text-muted small mt-1">
                        {{ $seoSetting->meta_description ?: 'Your meta description will appear here. This is how your page might look in search results.' }}
                    </div>
                </div>
                <small class="text-muted">Preview of how this might appear in search results</small>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Current OG Image</h5>
            </div>
            <div class="card-body text-center">
                @if($seoSetting->og_image)
                    <div id="current-og-image">
                        <img src="{{ asset('storage/' . $seoSetting->og_image) }}" 
                             alt="Current OG Image" 
                             class="img-fluid rounded"
                             style="max-height: 200px;">
                    </div>
                @else
                    <div class="text-muted">
                        <i class="fas fa-image fa-3x mb-3"></i>
                        <p>No OG image set</p>
                    </div>
                @endif
                
                <div id="og-image-preview" style="display: none;">
                    <hr>
                    <h6>New Image Preview:</h6>
                    <img id="preview-og-img" class="img-fluid rounded" style="max-height: 200px;">
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">SEO Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Page Type:</strong></td>
                        <td>{{ $pageTypes[$seoSetting->page_type] ?? ucfirst($seoSetting->page_type) }}</td>
                    </tr>
                    @if($seoSetting->page_identifier)
                        <tr>
                            <td><strong>Page/Item:</strong></td>
                            <td>{{ $seoSetting->getPageIdentifierLabel() }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td><strong>Created:</strong></td>
                        <td>{{ $seoSetting->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Updated:</strong></td>
                        <td>{{ $seoSetting->updated_at->format('M d, Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Form -->
<form id="delete-form" method="POST" action="{{ route('admin.seo.destroy', $seoSetting->id) }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
// Character counters
document.addEventListener('DOMContentLoaded', function() {
    const metaTitle = document.getElementById('meta_title');
    const metaDescription = document.getElementById('meta_description');
    
    metaTitle.addEventListener('input', function() {
        document.getElementById('meta-title-count').textContent = this.value.length;
        updatePreview();
    });
    
    metaDescription.addEventListener('input', function() {
        document.getElementById('meta-description-count').textContent = this.value.length;
        updatePreview();
    });
});

function updatePreview() {
    const title = document.getElementById('meta_title').value || 'Your Meta Title Here';
    const description = document.getElementById('meta_description').value || 'Your meta description will appear here. This is how your page might look in search results.';
    
    document.getElementById('preview-title').textContent = title;
    document.getElementById('preview-description').textContent = description;
}

function previewOgImage(input) {
    const file = input.files[0];
    const preview = document.getElementById('preview-og-img');
    const previewContainer = document.getElementById('og-image-preview');
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.style.display = 'block';
        }
        
        reader.readAsDataURL(file);
    } else {
        previewContainer.style.display = 'none';
    }
}

function deleteSeoSetting() {
    if (confirm('Are you sure you want to delete these SEO settings?\n\nThis action cannot be undone.')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endpush
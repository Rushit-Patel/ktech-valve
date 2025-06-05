@extends('admin.layouts.app')

@section('title', 'View Page: ' . $page->title)
@section('page-title', 'View Page')

@section('page-actions')
    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Pages
    </a>
    <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-primary">
        <i class="fas fa-edit me-1"></i>Edit Page
    </a>
    @if($page->slug)
        <a href="{{ url($page->slug) }}" target="_blank" class="btn btn-success">
            <i class="fas fa-external-link-alt me-1"></i>View on Website
        </a>
    @endif
    <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this page?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash me-1"></i>Delete
        </button>
    </form>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Page Information</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <strong>Page Title:</strong>
                    </div>
                    <div class="col-sm-9">
                        <h4 class="mb-0">{{ $page->title }}</h4>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <strong>Slug:</strong>
                    </div>
                    <div class="col-sm-9">
                        @if($page->slug)
                            <code class="text-primary">{{ $page->slug }}</code>
                            <div class="mt-1">
                                <small class="text-muted">
                                    URL: <a href="{{ url($page->slug) }}" target="_blank">{{ url($page->slug) }}</a>
                                </small>
                            </div>
                        @else
                            <em class="text-muted">No slug set</em>
                        @endif
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <strong>Status:</strong>
                    </div>
                    <div class="col-sm-9">
                        @if($page->is_active)
                            <span class="badge bg-success fs-6">Active</span>
                        @else
                            <span class="badge bg-danger fs-6">Inactive</span>
                        @endif
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <strong>Created:</strong>
                    </div>
                    <div class="col-sm-9">
                        {{ $page->created_at->format('M d, Y \a\t g:i A') }}
                        <small class="text-muted">({{ $page->created_at->diffForHumans() }})</small>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <strong>Last Updated:</strong>
                    </div>
                    <div class="col-sm-9">
                        {{ $page->updated_at->format('M d, Y \a\t g:i A') }}
                        <small class="text-muted">({{ $page->updated_at->diffForHumans() }})</small>
                    </div>
                </div>
            </div>
        </div>
        
        @if($page->content)
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Page Content</h5>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleContentView()">
                        <i class="fas fa-code me-1"></i>
                        <span id="view-toggle">Show HTML</span>
                    </button>
                </div>
                <div class="card-body">
                    <div id="rendered-content">
                        {!! $page->content !!}
                    </div>
                    <div id="raw-content" style="display: none;">
                        <pre><code>{{ $page->content }}</code></pre>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">SEO Settings</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <strong>Meta Title:</strong>
                    </div>
                    <div class="col-sm-9">
                        @if($page->meta_title)
                            <p class="mb-1">{{ $page->meta_title }}</p>
                            <small class="text-muted">{{ strlen($page->meta_title) }} characters</small>
                        @else
                            <em class="text-muted">Not set</em>
                        @endif
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <strong>Meta Description:</strong>
                    </div>
                    <div class="col-sm-9">
                        @if($page->meta_description)
                            <p class="mb-1">{{ $page->meta_description }}</p>
                            <small class="text-muted">{{ strlen($page->meta_description) }} characters</small>
                        @else
                            <em class="text-muted">Not set</em>
                        @endif
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <strong>Meta Keywords:</strong>
                    </div>
                    <div class="col-sm-9">
                        @if($page->meta_keywords)
                            @foreach(explode(',', $page->meta_keywords) as $keyword)
                                <span class="badge bg-secondary me-1">{{ trim($keyword) }}</span>
                            @endforeach
                        @else
                            <em class="text-muted">Not set</em>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Banner Image</h5>
            </div>
            <div class="card-body">
                @if($page->banner_image)
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $page->banner_image) }}" 
                             alt="{{ $page->title }}" 
                             class="img-fluid rounded shadow-sm"
                             style="max-width: 100%;">
                        <div class="mt-2">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Click to view full size
                            </small>
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <div class="bg-light p-4 rounded">
                            <i class="fas fa-image fa-3x text-muted mb-2"></i>
                            <p class="text-muted mb-0">No banner image uploaded</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-1"></i>Edit Page
                    </a>
                    
                    @if($page->slug)
                        <a href="{{ url($page->slug) }}" target="_blank" class="btn btn-outline-success">
                            <i class="fas fa-external-link-alt me-1"></i>View on Website
                        </a>
                    @endif
                    
                    <button type="button" class="btn btn-outline-info" onclick="previewPage()">
                        <i class="fas fa-eye me-1"></i>Preview Content
                    </button>
                    
                    @if($page->is_active)
                        <form action="{{ route('admin.pages.toggle-status', $page->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-warning w-100">
                                <i class="fas fa-eye-slash me-1"></i>Deactivate
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.pages.toggle-status', $page->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-success w-100">
                                <i class="fas fa-eye me-1"></i>Activate
                            </button>
                        </form>
                    @endif
                    
                    <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this page? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fas fa-trash me-1"></i>Delete Page
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">SEO Preview</h5>
            </div>
            <div class="card-body">
                <div class="border rounded p-3" style="background-color: #f8f9fa;">
                    <div class="text-primary" style="font-size: 18px; line-height: 1.2;">
                        {{ $page->meta_title ?: $page->title }}
                    </div>
                    <div class="text-success small">
                        {{ url($page->slug ?: '#') }}
                    </div>
                    <div class="text-muted small mt-1">
                        {{ $page->meta_description ?: 'No meta description available' }}
                    </div>
                </div>
                <small class="text-muted">How this page might appear in search results</small>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
@if($page->banner_image)
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $page->title }} - Banner Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('storage/' . $page->banner_image) }}" 
                     alt="{{ $page->title }}" 
                     class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
    function toggleContentView() {
        const renderedContent = document.getElementById('rendered-content');
        const rawContent = document.getElementById('raw-content');
        const toggleButton = document.getElementById('view-toggle');
        
        if (renderedContent.style.display === 'none') {
            renderedContent.style.display = 'block';
            rawContent.style.display = 'none';
            toggleButton.textContent = 'Show HTML';
        } else {
            renderedContent.style.display = 'none';
            rawContent.style.display = 'block';
            toggleButton.textContent = 'Show Rendered';
        }
    }
    
    function previewPage() {
        const title = '{{ $page->title }}';
        const content = `{!! addslashes($page->content) !!}`;
        
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
    
    // Image modal trigger
    @if($page->banner_image)
    document.addEventListener('DOMContentLoaded', function() {
        const bannerImage = document.querySelector('.card-body img[alt="{{ $page->title }}"]');
        if (bannerImage) {
            bannerImage.style.cursor = 'pointer';
            bannerImage.addEventListener('click', function() {
                const modal = new bootstrap.Modal(document.getElementById('imageModal'));
                modal.show();
            });
        }
    });
    @endif
</script>
@endpush
@extends('admin.layouts.app')

@section('title', 'Product Details')
@section('page-title', 'Product: ' . $product->name)

@section('page-actions')
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Products
    </a>
    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">
        <i class="fas fa-edit me-1"></i>Edit Product
    </a>
    <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <i class="fas fa-cog me-1"></i>Actions
        </button>
        <ul class="dropdown-menu">
            <li>
                <form method="POST" action="{{ route('admin.products.toggle-status', $product) }}" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-toggle-{{ $product->is_active ? 'off' : 'on' }} me-2"></i>
                        {{ $product->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                </form>
            </li>
            <li>
                <form method="POST" action="{{ route('admin.products.toggle-featured', $product) }}" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-star me-2"></i>
                        {{ $product->is_featured ? 'Remove from Featured' : 'Mark as Featured' }}
                    </button>
                </form>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="fas fa-trash me-2"></i>Delete Product
                    </button>
                </form>
            </li>
        </ul>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <!-- Product Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Product Information</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Name:</strong></div>
                    <div class="col-sm-9">{{ $product->name }}</div>
                </div>
                
                @if($product->sku)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>SKU:</strong></div>
                    <div class="col-sm-9">{{ $product->sku }}</div>
                </div>
                @endif
                
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Slug:</strong></div>
                    <div class="col-sm-9">
                        <code>{{ $product->slug }}</code>
                        <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="btn btn-sm btn-outline-primary ms-2">
                            <i class="fas fa-external-link-alt"></i> View Frontend
                        </a>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Category:</strong></div>
                    <div class="col-sm-9">
                        @if($product->category)
                            <a href="{{ route('admin.product-categories.show', $product->category) }}" class="text-decoration-none">
                                {{ $product->category->name }}
                            </a>
                        @else
                            <span class="text-muted">No category assigned</span>
                        @endif
                    </div>
                </div>
                
                @if($product->short_description)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Short Description:</strong></div>
                    <div class="col-sm-9">{{ $product->short_description }}</div>
                </div>
                @endif
                
                @if($product->description)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Description:</strong></div>
                    <div class="col-sm-9">
                        <div class="border rounded p-3 bg-light">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
                @endif
                
                @if($product->specifications)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Specifications:</strong></div>
                    <div class="col-sm-9">
                        <div class="border rounded p-3 bg-light">
                            {!! $product->specifications !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Technical Details -->
        @if($product->technical_details && count($product->technical_details) > 0)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Technical Details</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        @foreach($product->technical_details as $key => $value)
                        <tr>
                            <td width="30%" class="fw-bold">{{ $key }}</td>
                            <td>{{ $value }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        @endif

        <!-- Recent Inquiries -->
        @if($product->inquiries && $product->inquiries->count() > 0)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Inquiries ({{ $product->inquiries->count() }})</h5>
                <a href="{{ route('admin.inquiries.index', ['product' => $product->id]) }}" class="btn btn-sm btn-outline-primary">
                    View All
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product->inquiries as $inquiry)
                            <tr>
                                <td>{{ $inquiry->created_at->format('M d, Y') }}</td>
                                <td>{{ $inquiry->name }}</td>
                                <td>{{ Str::limit($inquiry->subject ?? 'Product Inquiry', 30) }}</td>
                                <td>
                                    <span class="badge bg-{{ $inquiry->status === 'new' ? 'warning' : ($inquiry->status === 'responded' ? 'success' : 'secondary') }}">
                                        {{ ucfirst($inquiry->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <!-- SEO Information -->
        @if($product->meta_title || $product->meta_description || $product->meta_keywords)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">SEO Information</h5>
            </div>
            <div class="card-body">
                @if($product->meta_title)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Meta Title:</strong></div>
                    <div class="col-sm-9">{{ $product->meta_title }}</div>
                </div>
                @endif
                
                @if($product->meta_description)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Meta Description:</strong></div>
                    <div class="col-sm-9">{{ $product->meta_description }}</div>
                </div>
                @endif
                
                @if($product->meta_keywords)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Meta Keywords:</strong></div>
                    <div class="col-sm-9">{{ $product->meta_keywords }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
    
    <div class="col-lg-4">
        <!-- Product Status -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Product Status</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-6"><strong>Status:</strong></div>
                    <div class="col-6">
                        <span class="badge bg-{{ $product->is_active ? 'success' : 'danger' }}">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-6"><strong>Featured:</strong></div>
                    <div class="col-6">
                        @if($product->is_featured)
                            <i class="fas fa-star text-warning"></i> Yes
                        @else
                            <span class="text-muted">No</span>
                        @endif
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-6"><strong>Sort Order:</strong></div>
                    <div class="col-6">{{ $product->sort_order ?? 0 }}</div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-6"><strong>Created:</strong></div>
                    <div class="col-6">{{ $product->created_at->format('M d, Y') }}</div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-6"><strong>Updated:</strong></div>
                    <div class="col-6">{{ $product->updated_at->format('M d, Y') }}</div>
                </div>
            </div>
        </div>

        <!-- Industries -->
        @if($product->industries && $product->industries->count() > 0)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Associated Industries</h5>
            </div>
            <div class="card-body">
                @foreach($product->industries as $industry)
                <span class="badge bg-info me-1 mb-1">
                    <a href="{{ route('admin.industries.show', $industry) }}" class="text-white text-decoration-none">
                        {{ $industry->name }}
                    </a>
                </span>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Images -->
        @if($product->banner_image || ($product->images && count($product->images) > 0))
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Product Images</h5>
            </div>
            <div class="card-body">
                @if($product->banner_image)
                <div class="mb-3">
                    <label class="form-label fw-bold">Banner Image:</label>
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $product->banner_image) }}" alt="Banner Image" class="img-fluid rounded" style="max-height: 200px;">
                    </div>
                </div>
                @endif
                
                @if($product->images && count($product->images) > 0)
                <div class="mb-3">
                    <label class="form-label fw-bold">Gallery Images:</label>
                    <div class="row">
                        @foreach($product->images as $image)
                        <div class="col-6 mb-2">
                            <img src="{{ asset('storage/' . $image) }}" alt="Product Image" class="img-fluid rounded" style="height: 100px; object-fit: cover; width: 100%;" data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-image="{{ asset('storage/' . $image) }}">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Product Image" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Image modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        const imageModal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        
        imageModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const imageSrc = button.getAttribute('data-bs-image');
            modalImage.src = imageSrc;
        });
    });
</script>
@endpush
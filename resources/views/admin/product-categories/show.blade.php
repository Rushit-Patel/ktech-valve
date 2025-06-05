@extends('admin.layouts.app')

@section('title', 'Category Details')
@section('page-title', 'Category: ' . $productCategory->name)

@section('page-actions')
    <a href="{{ route('admin.product-categories.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Categories
    </a>
    <a href="{{ route('admin.product-categories.edit', $productCategory) }}" class="btn btn-primary">
        <i class="fas fa-edit me-1"></i>Edit Category
    </a>
    <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <i class="fas fa-cog me-1"></i>Actions
        </button>
        <ul class="dropdown-menu">
            <li>
                <form method="POST" action="{{ route('admin.product-categories.toggle-status', $productCategory) }}" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-toggle-{{ $productCategory->is_active ? 'off' : 'on' }} me-2"></i>
                        {{ $productCategory->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                </form>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('admin.product-categories.destroy', $productCategory) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger" {{ $productCategory->products_count > 0 ? 'disabled' : '' }}>
                        <i class="fas fa-trash me-2"></i>Delete Category
                    </button>
                </form>
            </li>
        </ul>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <!-- Category Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Category Information</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Name:</strong></div>
                    <div class="col-sm-9">{{ $productCategory->name }}</div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Slug:</strong></div>
                    <div class="col-sm-9">
                        <code>{{ $productCategory->slug }}</code>
                        @if(Route::has('categories.show'))
                        <a href="{{ route('categories.show', $productCategory->slug) }}" target="_blank" class="btn btn-sm btn-outline-primary ms-2">
                            <i class="fas fa-external-link-alt"></i> View Frontend
                        </a>
                        @endif
                    </div>
                </div>
                
                @if($productCategory->description)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Description:</strong></div>
                    <div class="col-sm-9">
                        <div class="border rounded p-3 bg-light">
                            {{ $productCategory->description }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Products in Category -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Products in this Category ({{ $productCategory->products->count() }})</h5>
                <div>
                    <a href="{{ route('admin.products.create', ['category' => $productCategory->id]) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus me-1"></i>Add Product
                    </a>
                    @if($productCategory->products->count() > 10)
                    <a href="{{ route('admin.products.index', ['category' => $productCategory->id]) }}" class="btn btn-sm btn-outline-primary">
                        View All
                    </a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                @if($productCategory->products->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th width="60">Image</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th>Created</th>
                                <th width="100">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productCategory->products as $product)
                            <tr>
                                <td>
                                    @if($product->featured_image)
                                        <img src="{{ Storage::url($product->featured_image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $product->name }}</strong>
                                        @if($product->short_description)
                                            <br><small class="text-muted">{{ Str::limit($product->short_description, 50) }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $product->sku ?: '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $product->is_active ? 'success' : 'danger' }}">
                                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    @if($product->is_featured)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $product->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-outline-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <div class="text-muted">
                        <i class="fas fa-box-open fa-3x mb-3"></i>
                        <h5>No Products Found</h5>
                        <p>This category doesn't have any products yet.</p>
                        <a href="{{ route('admin.products.create', ['category' => $productCategory->id]) }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Add First Product
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- SEO Information -->
        @if($productCategory->meta_title || $productCategory->meta_description || $productCategory->meta_keywords)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">SEO Information</h5>
            </div>
            <div class="card-body">
                @if($productCategory->meta_title)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Meta Title:</strong></div>
                    <div class="col-sm-9">{{ $productCategory->meta_title }}</div>
                </div>
                @endif
                
                @if($productCategory->meta_description)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Meta Description:</strong></div>
                    <div class="col-sm-9">{{ $productCategory->meta_description }}</div>
                </div>
                @endif
                
                @if($productCategory->meta_keywords)
                <div class="row mb-3">
                    <div class="col-sm-3"><strong>Meta Keywords:</strong></div>
                    <div class="col-sm-9">{{ $productCategory->meta_keywords }}</div>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
    
    <div class="col-lg-4">
        <!-- Category Status -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Category Status</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-6"><strong>Status:</strong></div>
                    <div class="col-6">
                        <span class="badge bg-{{ $productCategory->is_active ? 'success' : 'danger' }}">
                            {{ $productCategory->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-6"><strong>Sort Order:</strong></div>
                    <div class="col-6">{{ $productCategory->sort_order ?? 0 }}</div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-6"><strong>Products:</strong></div>
                    <div class="col-6">
                        <span class="badge bg-info">{{ $productCategory->products->count() }}</span>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-6"><strong>Created:</strong></div>
                    <div class="col-6">{{ $productCategory->created_at->format('M d, Y') }}</div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-6"><strong>Updated:</strong></div>
                    <div class="col-6">{{ $productCategory->updated_at->format('M d, Y') }}</div>
                </div>
            </div>
        </div>

        <!-- Category Image -->
        @if($productCategory->image)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Category Image</h5>
            </div>
            <div class="card-body text-center">
                <img src="{{ Storage::url($productCategory->image) }}" alt="{{ $productCategory->name }}" class="img-fluid rounded" style="max-height: 300px;" data-bs-toggle="modal" data-bs-target="#imageModal">
                <div class="mt-2">
                    <small class="text-muted">Click to enlarge</small>
                </div>
            </div>
        </div>
        @endif

        <!-- Quick Statistics -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Quick Statistics</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 border-end">
                        <div class="h4 mb-0 text-primary">{{ $productCategory->products->where('is_active', true)->count() }}</div>
                        <small class="text-muted">Active Products</small>
                    </div>
                    <div class="col-6">
                        <div class="h4 mb-0 text-warning">{{ $productCategory->products->where('is_featured', true)->count() }}</div>
                        <small class="text-muted">Featured Products</small>
                    </div>
                </div>
                
                @if($productCategory->products->count() > 0)
                <hr class="my-3">
                <div class="row text-center">
                    <div class="col-12">
                        <div class="h6 mb-0 text-info">{{ $productCategory->products->max('created_at')?->format('M d, Y') ?? 'N/A' }}</div>
                        <small class="text-muted">Latest Product Added</small>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Recent Activity -->
        @if($productCategory->products->count() > 0)
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Recent Products</h5>
            </div>
            <div class="card-body">
                @foreach($productCategory->products->take(5) as $product)
                <div class="d-flex align-items-center mb-2 {{ !$loop->last ? 'border-bottom pb-2' : '' }}">
                    <div class="flex-shrink-0 me-2">
                        @if($product->featured_image)
                            <img src="{{ Storage::url($product->featured_image) }}" alt="{{ $product->name }}" class="rounded" style="width: 30px; height: 30px; object-fit: cover;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                                <i class="fas fa-image text-muted" style="font-size: 12px;"></i>
                            </div>
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-bold" style="font-size: 0.9rem;">{{ Str::limit($product->name, 25) }}</div>
                        <small class="text-muted">{{ $product->created_at->format('M d') }}</small>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Image Modal -->
@if($productCategory->image)
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $productCategory->name }} - Category Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ Storage::url($productCategory->image) }}" alt="{{ $productCategory->name }}" class="img-fluid">
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add any additional JavaScript functionality here
        console.log('Category details page loaded');
    });
</script>
@endpush

@push('styles')
<style>
    .border-end {
        border-right: 1px solid #dee2e6 !important;
    }
    
    .cursor-pointer {
        cursor: pointer;
    }
    
    .img-thumbnail:hover {
        opacity: 0.8;
        transition: opacity 0.2s ease;
    }
</style>
@endpush
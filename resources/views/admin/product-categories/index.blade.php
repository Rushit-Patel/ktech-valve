@extends('admin.layouts.app')

@section('title', 'Product Categories')
@section('page-title', 'Product Categories')

@section('page-actions')
    <a href="{{ route('admin.product-categories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Add New Category
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0">All Categories</h5>
            </div>
            <div class="col-auto">
                <form method="GET" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Search categories..." value="{{ request('search') }}">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <button type="submit" class="btn btn-outline-primary btn-sm">Filter</button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Products Count</th>
                        <th>Status</th>
                        <th>Sort Order</th>
                        <th>Created</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>
                                @if($category->image)
                                    <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $category->name }}</strong>
                                    @if($category->description)
                                        <br><small class="text-muted">{{ Str::limit($category->description, 50) }}</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $category->products_count ?? 0 }} Products</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $category->is_active ? 'success' : 'danger' }}">
                                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $category->sort_order ?? 0 }}</td>
                            <td>{{ $category->created_at->format('M d, Y') }}</td>
                            <td class="table-actions">
                                <a href="{{ route('admin.product-categories.show', $category) }}" class="btn btn-sm btn-outline-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.product-categories.edit', $category) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.product-categories.toggle-status', $category) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-{{ $category->is_active ? 'warning' : 'success' }}" title="{{ $category->is_active ? 'Deactivate' : 'Activate' }}">
                                        <i class="fas fa-toggle-{{ $category->is_active ? 'off' : 'on' }}"></i>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.product-categories.destroy', $category) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-layer-group fa-3x mb-3"></i>
                                    <h5>No Categories Found</h5>
                                    <p>Start by creating your first product category.</p>
                                    <a href="{{ route('admin.product-categories.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-1"></i>Add New Category
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($categories->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $categories->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-submit form on status change
        document.querySelector('select[name="status"]').addEventListener('change', function() {
            this.form.submit();
        });
    });
</script>
@endpush
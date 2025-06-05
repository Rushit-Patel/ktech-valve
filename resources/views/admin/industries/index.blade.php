@extends('admin.layouts.app')

@section('title', 'Industries Management')
@section('page-title', 'Industries Management')

@section('page-actions')
    <a href="{{ route('admin.industries.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Add New Industry
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0">All Industries</h5>
            </div>
            <div class="col-auto">
                <form method="GET" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Search industries..." value="{{ request('search') }}">
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
                        <th>Icon</th>
                        <th>Name</th>
                        <th>Products Count</th>
                        <th>Status</th>
                        <th>Sort Order</th>
                        <th>Created</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($industries as $industry)
                        <tr>
                            <td>
                                @if($industry->image)
                                    <img src="{{ Storage::url($industry->image) }}" alt="{{ $industry->name }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if($industry->icon)
                                    <img src="{{ Storage::url($industry->icon) }}" alt="{{ $industry->name }} Icon" class="img-thumbnail" style="width: 30px; height: 30px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                                        <i class="fas fa-industry text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $industry->name }}</strong>
                                    @if($industry->description)
                                        <br><small class="text-muted">{{ Str::limit($industry->description, 50) }}</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $industry->products_count ?? 0 }} Products</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $industry->is_active ? 'success' : 'danger' }}">
                                    {{ $industry->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $industry->sort_order ?? 0 }}</td>
                            <td>{{ $industry->created_at->format('M d, Y') }}</td>
                            <td class="table-actions">
                                <a href="{{ route('admin.industries.show', $industry) }}" class="btn btn-sm btn-outline-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.industries.edit', $industry) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-{{ $industry->is_active ? 'warning' : 'success' }}" 
                                        onclick="toggleStatus('{{ route('admin.industries.toggle-status', $industry) }}')" 
                                        title="{{ $industry->is_active ? 'Deactivate' : 'Activate' }}">
                                    <i class="fas fa-{{ $industry->is_active ? 'eye-slash' : 'eye' }}"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        onclick="deleteItem('{{ route('admin.industries.destroy', $industry) }}')" 
                                        title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-industry fa-3x mb-3"></i>
                                    <p class="mb-0">No industries found.</p>
                                    <a href="{{ route('admin.industries.create') }}" class="btn btn-primary btn-sm mt-2">
                                        <i class="fas fa-plus me-1"></i>Add First Industry
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($industries->hasPages())
            <div class="d-flex justify-content-center">
                {{ $industries->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleStatus(url) {
    if (confirm('Are you sure you want to change the status of this industry?')) {
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
}

function deleteItem(url) {
    if (confirm('Are you sure you want to delete this industry? This action cannot be undone.')) {
        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
}
</script>
@endpush
@extends('admin.layouts.app')

@section('title', 'Inquiries Management')
@section('page-title', 'Inquiries Management')

@section('page-actions')
    <button type="button" class="btn btn-danger" id="bulk-action-btn" style="display: none;">
        <i class="fas fa-tasks me-1"></i>Bulk Actions
    </button>
    <a href="{{ route('admin.inquiries.export', request()->query()) }}" class="btn btn-success">
        <i class="fas fa-download me-1"></i>Export CSV
    </a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0">Customer Inquiries</h5>
            </div>
            <div class="col-auto">
                <form method="GET" action="{{ route('admin.inquiries.index') }}" class="d-flex gap-2">
                    <div class="input-group" style="width: 300px;">
                        <input type="text" 
                               class="form-control" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Search name, email, company...">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    
                    <select class="form-select" name="status" onchange="this.form.submit()" style="width: 150px;">
                        <option value="">All Status</option>
                        <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
                        <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>Contacted</option>
                        <option value="quoted" {{ request('status') === 'quoted' ? 'selected' : '' }}>Quoted</option>
                        <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    
                    <select class="form-select" name="product" onchange="this.form.submit()" style="width: 200px;">
                        <option value="">All Products</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ request('product') == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    
                    <input type="date" 
                           class="form-control" 
                           name="date_from" 
                           value="{{ request('date_from') }}" 
                           placeholder="From Date"
                           onchange="this.form.submit()"
                           style="width: 150px;">
                    
                    <input type="date" 
                           class="form-control" 
                           name="date_to" 
                           value="{{ request('date_to') }}" 
                           placeholder="To Date"
                           onchange="this.form.submit()"
                           style="width: 150px;">
                    
                    @if(request('search') || request('status') || request('product') || request('date_from') || request('date_to'))
                        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
    
    <div class="card-body p-0">
        @if($inquiries->count() > 0)
            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="select-all">
                    <label class="form-check-label" for="select-all">
                        Select All
                    </label>
                </div>
                <div>
                    <small class="text-muted">
                        Showing {{ $inquiries->firstItem() }} to {{ $inquiries->lastItem() }} of {{ $inquiries->total() }} inquiries
                    </small>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="3%">
                                <input type="checkbox" id="select-all-header" class="form-check-input">
                            </th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inquiries as $inquiry)
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input inquiry-checkbox" value="{{ $inquiry->id }}">
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $inquiry->name }}</strong>
                                        <div class="text-muted small">{{ $inquiry->email }}</div>
                                        @if($inquiry->company)
                                            <div class="text-muted small">{{ $inquiry->company }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($inquiry->product)
                                        <span class="badge bg-primary">{{ $inquiry->product->name }}</span>
                                    @else
                                        <span class="text-muted">General Inquiry</span>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        {{ Str::limit($inquiry->subject ?: 'No Subject', 40) }}
                                        @if($inquiry->phone)
                                            <div class="text-muted small">
                                                <i class="fas fa-phone fa-xs"></i> {{ $inquiry->phone }}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div>{{ $inquiry->created_at->format('M d, Y') }}</div>
                                    <div class="text-muted small">{{ $inquiry->created_at->format('h:i A') }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $inquiry->status === 'new' ? 'warning' : ($inquiry->status === 'contacted' ? 'info' : ($inquiry->status === 'quoted' ? 'success' : 'secondary')) }}">
                                        {{ ucfirst($inquiry->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.inquiries.show', $inquiry->id) }}" 
                                           class="btn btn-sm btn-outline-info" 
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        @if($inquiry->status === 'new')
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-success" 
                                                    onclick="updateStatus({{ $inquiry->id }}, 'contacted')"
                                                    title="Mark as Contacted">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                        @endif
                                        
                                        @if($inquiry->status !== 'closed')
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-warning" 
                                                    onclick="updateStatus({{ $inquiry->id }}, 'quoted')"
                                                    title="Mark as Quoted">
                                                <i class="fas fa-file-invoice"></i>
                                            </button>
                                        @endif
                                        
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger" 
                                                onclick="deleteInquiry({{ $inquiry->id }}, '{{ $inquiry->name }}')"
                                                title="Delete Inquiry">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($inquiries->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                Showing {{ $inquiries->firstItem() }} to {{ $inquiries->lastItem() }} of {{ $inquiries->total() }} results
                            </small>
                        </div>
                        <div>
                            {{ $inquiries->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-envelope fa-3x text-muted"></i>
                </div>
                <h5>No Inquiries Found</h5>
                <p class="text-muted mb-3">
                    @if(request('search') || request('status') || request('product') || request('date_from') || request('date_to'))
                        No inquiries match your search criteria.
                    @else
                        No customer inquiries have been received yet.
                    @endif
                </p>
                @if(request('search') || request('status') || request('product') || request('date_from') || request('date_to'))
                    <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-times me-1"></i>Clear Filters
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>

<!-- Bulk Actions Modal -->
<div class="modal fade" id="bulkActionsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bulk Actions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="bulk-actions-form" method="POST" action="{{ route('admin.inquiries.bulk-action') }}">
                    @csrf
                    <input type="hidden" name="inquiries" id="bulk-inquiries">
                    
                    <div class="mb-3">
                        <label for="bulk-action" class="form-label">Select Action</label>
                        <select class="form-select" name="action" id="bulk-action" required>
                            <option value="">Choose an action...</option>
                            <option value="mark_contacted">Mark as Contacted</option>
                            <option value="mark_quoted">Mark as Quoted</option>
                            <option value="mark_closed">Mark as Closed</option>
                            <option value="delete">Delete Selected</option>
                        </select>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Apply Action</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Form -->
<form id="status-update-form" method="POST" style="display: none;">
    @csrf
    @method('PATCH')
</form>

<!-- Delete Form -->
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
// Bulk selection functionality
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select-all');
    const selectAllHeaderCheckbox = document.getElementById('select-all-header');
    const inquiryCheckboxes = document.querySelectorAll('.inquiry-checkbox');
    const bulkActionBtn = document.getElementById('bulk-action-btn');
    
    // Sync both select all checkboxes
    selectAllCheckbox?.addEventListener('change', function() {
        selectAllHeaderCheckbox.checked = this.checked;
        inquiryCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        toggleBulkActionButton();
    });
    
    selectAllHeaderCheckbox?.addEventListener('change', function() {
        selectAllCheckbox.checked = this.checked;
        inquiryCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        toggleBulkActionButton();
    });
    
    // Individual checkbox change
    inquiryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedBoxes = document.querySelectorAll('.inquiry-checkbox:checked');
            const allChecked = checkedBoxes.length === inquiryCheckboxes.length;
            const someChecked = checkedBoxes.length > 0;
            
            selectAllCheckbox.checked = allChecked;
            selectAllHeaderCheckbox.checked = allChecked;
            selectAllCheckbox.indeterminate = someChecked && !allChecked;
            selectAllHeaderCheckbox.indeterminate = someChecked && !allChecked;
            
            toggleBulkActionButton();
        });
    });
    
    function toggleBulkActionButton() {
        const checkedBoxes = document.querySelectorAll('.inquiry-checkbox:checked');
        bulkActionBtn.style.display = checkedBoxes.length > 0 ? 'inline-block' : 'none';
    }
    
    // Bulk actions
    bulkActionBtn?.addEventListener('click', function() {
        const checkedBoxes = document.querySelectorAll('.inquiry-checkbox:checked');
        if (checkedBoxes.length === 0) {
            alert('Please select at least one inquiry.');
            return;
        }
        
        const inquiryIds = Array.from(checkedBoxes).map(cb => cb.value);
        document.getElementById('bulk-inquiries').value = JSON.stringify(inquiryIds);
        
        const modal = new bootstrap.Modal(document.getElementById('bulkActionsModal'));
        modal.show();
    });
});

function updateStatus(inquiryId, status) {
    const form = document.getElementById('status-update-form');
    const action = `{{ route('admin.inquiries.update-status', ':id') }}`.replace(':id', inquiryId);
    
    form.action = action;
    
    // Add hidden input for status
    const statusInput = document.createElement('input');
    statusInput.type = 'hidden';
    statusInput.name = 'status';
    statusInput.value = status;
    form.appendChild(statusInput);
    
    const statusText = status.charAt(0).toUpperCase() + status.slice(1);
    
    if (confirm(`Are you sure you want to mark this inquiry as ${statusText}?`)) {
        form.submit();
    }
}

function deleteInquiry(inquiryId, customerName) {
    const form = document.getElementById('delete-form');
    const action = `{{ route('admin.inquiries.destroy', ':id') }}`.replace(':id', inquiryId);
    
    form.action = action;
    
    if (confirm(`Are you sure you want to delete the inquiry from "${customerName}"?\n\nThis action cannot be undone.`)) {
        form.submit();
    }
}
</script>
@endpush

@push('styles')
<style>
.table th {
    border-top: none;
    font-weight: 600;
    font-size: 0.875rem;
}

.btn-group .btn {
    border-radius: 0.375rem !important;
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
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
}
</style>
@endpush
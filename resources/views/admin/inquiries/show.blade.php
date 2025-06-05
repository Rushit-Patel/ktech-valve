@extends('admin.layouts.app')

@section('title', 'Inquiry Details')
@section('page-title', 'Inquiry Details')

@section('page-actions')
    <a href="{{ route('admin.inquiries.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Inquiries
    </a>
    
    @if($inquiry->status !== 'contacted')
        <button type="button" 
                class="btn btn-success" 
                onclick="updateStatus('{{ $inquiry->id }}', 'contacted')">
            <i class="fas fa-phone me-1"></i>Mark as Contacted
        </button>
    @endif
    
    @if($inquiry->status !== 'quoted')
        <button type="button" 
                class="btn btn-warning" 
                onclick="updateStatus('{{ $inquiry->id }}', 'quoted')">
            <i class="fas fa-file-invoice me-1"></i>Mark as Quoted
        </button>
    @endif
    
    @if($inquiry->status !== 'closed')
        <button type="button" 
                class="btn btn-info" 
                onclick="updateStatus('{{ $inquiry->id }}', 'closed')">
            <i class="fas fa-check me-1"></i>Mark as Closed
        </button>
    @endif
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Inquiry #{{ $inquiry->id }}</h5>
                <span class="badge bg-{{ $inquiry->status === 'new' ? 'warning' : ($inquiry->status === 'contacted' ? 'info' : ($inquiry->status === 'quoted' ? 'success' : 'secondary')) }} fs-6">
                    {{ ucfirst($inquiry->status) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6>Customer Information</h6>
                        <table class="table table-sm">
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td>{{ $inquiry->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>
                                    <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a>
                                </td>
                            </tr>
                            @if($inquiry->phone)
                                <tr>
                                    <td><strong>Phone:</strong></td>
                                    <td>
                                        <a href="tel:{{ $inquiry->phone }}">{{ $inquiry->phone }}</a>
                                    </td>
                                </tr>
                            @endif
                            @if($inquiry->company)
                                <tr>
                                    <td><strong>Company:</strong></td>
                                    <td>{{ $inquiry->company }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Inquiry Details</h6>
                        <table class="table table-sm">
                            <tr>
                                <td><strong>Date:</strong></td>
                                <td>{{ $inquiry->created_at->format('M d, Y H:i A') }}</td>
                            </tr>
                            @if($inquiry->product)
                                <tr>
                                    <td><strong>Product:</strong></td>
                                    <td>
                                        <a href="{{ route('admin.products.show', $inquiry->product->id) }}" class="text-decoration-none">
                                            {{ $inquiry->product->name }}
                                        </a>
                                    </td>
                                </tr>
                            @endif
                            @if($inquiry->inquiry_type)
                                <tr>
                                    <td><strong>Type:</strong></td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $inquiry->inquiry_type)) }}</td>
                                </tr>
                            @endif
                            @if($inquiry->contacted_at)
                                <tr>
                                    <td><strong>Contacted At:</strong></td>
                                    <td>{{ $inquiry->contacted_at->format('M d, Y H:i A') }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
                
                @if($inquiry->subject)
                    <div class="mb-4">
                        <h6>Subject</h6>
                        <p class="bg-light p-3 rounded">{{ $inquiry->subject }}</p>
                    </div>
                @endif
                
                @if($inquiry->message)
                    <div class="mb-4">
                        <h6>Message</h6>
                        <div class="bg-light p-3 rounded">
                            {!! nl2br(e($inquiry->message)) !!}
                        </div>
                    </div>
                @endif
                
                @if($inquiry->additional_data && count($inquiry->additional_data) > 0)
                    <div class="mb-4">
                        <h6>Additional Information</h6>
                        <div class="bg-light p-3 rounded">
                            @foreach($inquiry->additional_data as $key => $value)
                                <div class="row mb-2">
                                    <div class="col-md-4"><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong></div>
                                    <div class="col-md-8">{{ is_array($value) ? implode(', ', $value) : $value }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Admin Notes Section -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Admin Notes</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.inquiries.update-status', $inquiry->id) }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="{{ $inquiry->status }}">
                    
                    <div class="mb-3">
                        <label for="admin_notes" class="form-label">Internal Notes</label>
                        <textarea class="form-control @error('admin_notes') is-invalid @enderror" 
                                  id="admin_notes" 
                                  name="admin_notes" 
                                  rows="4"
                                  placeholder="Add internal notes about this inquiry...">{{ old('admin_notes', $inquiry->admin_notes) }}</textarea>
                        @error('admin_notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">These notes are for internal use only and won't be visible to the customer.</div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Save Notes
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="mailto:{{ $inquiry->email }}?subject=Re: {{ $inquiry->subject ?: 'Your Inquiry' }}" 
                       class="btn btn-primary">
                        <i class="fas fa-envelope me-1"></i>Send Email
                    </a>
                    
                    @if($inquiry->phone)
                        <a href="tel:{{ $inquiry->phone }}" class="btn btn-success">
                            <i class="fas fa-phone me-1"></i>Call Customer
                        </a>
                    @endif
                    
                    @if($inquiry->product)
                        <a href="{{ route('admin.products.show', $inquiry->product->id) }}" 
                           class="btn btn-info">
                            <i class="fas fa-box me-1"></i>View Product
                        </a>
                    @endif
                    
                    <hr>
                    
                    @if($inquiry->status === 'new')
                        <button type="button" 
                                class="btn btn-outline-success" 
                                onclick="updateStatus('{{ $inquiry->id }}', 'contacted')">
                            <i class="fas fa-phone me-1"></i>Mark as Contacted
                        </button>
                    @endif
                    
                    @if($inquiry->status !== 'quoted')
                        <button type="button" 
                                class="btn btn-outline-warning" 
                                onclick="updateStatus('{{ $inquiry->id }}', 'quoted')">
                            <i class="fas fa-file-invoice me-1"></i>Mark as Quoted
                        </button>
                    @endif
                    
                    @if($inquiry->status !== 'closed')
                        <button type="button" 
                                class="btn btn-outline-info" 
                                onclick="updateStatus('{{ $inquiry->id }}', 'closed')">
                            <i class="fas fa-check me-1"></i>Mark as Closed
                        </button>
                    @endif
                    
                    <hr>
                    
                    <button type="button" 
                            class="btn btn-outline-danger" 
                            onclick="deleteInquiry()">
                        <i class="fas fa-trash me-1"></i>Delete Inquiry
                    </button>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Inquiry Timeline</h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <h6 class="timeline-title">Inquiry Received</h6>
                            <p class="timeline-text">{{ $inquiry->created_at->format('M d, Y H:i A') }}</p>
                        </div>
                    </div>
                    
                    @if($inquiry->contacted_at)
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Customer Contacted</h6>
                                <p class="timeline-text">{{ $inquiry->contacted_at->format('M d, Y H:i A') }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($inquiry->status === 'quoted')
                        <div class="timeline-item">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Quote Provided</h6>
                                <p class="timeline-text">{{ $inquiry->updated_at->format('M d, Y H:i A') }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($inquiry->status === 'closed')
                        <div class="timeline-item">
                            <div class="timeline-marker bg-info"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Inquiry Closed</h6>
                                <p class="timeline-text">{{ $inquiry->updated_at->format('M d, Y H:i A') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        @if($inquiry->product)
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Related Product</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        @if($inquiry->product->featured_image)
                            <img src="{{ asset('storage/' . $inquiry->product->featured_image) }}" 
                                 alt="{{ $inquiry->product->name }}" 
                                 class="rounded me-3"
                                 style="width: 60px; height: 60px; object-fit: cover;">
                        @endif
                        <div>
                            <h6 class="mb-1">{{ $inquiry->product->name }}</h6>
                            <p class="text-muted small mb-0">{{ $inquiry->product->category->name ?? 'Uncategorized' }}</p>
                            <a href="{{ route('admin.products.show', $inquiry->product->id) }}" 
                               class="btn btn-sm btn-outline-primary mt-2">
                                View Product
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Status Update Form -->
<form id="status-update-form" method="POST" style="display: none;">
    @csrf
    @method('PATCH')
</form>

<!-- Delete Form -->
<form id="delete-form" method="POST" action="{{ route('admin.inquiries.destroy', $inquiry->id) }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
function updateStatus(inquiryId, status) {
    const form = document.getElementById('status-update-form');
    const action = `{{ route('admin.inquiries.update-status', ':id') }}`.replace(':id', inquiryId);
    
    form.action = action;
    
    // Clear existing hidden inputs
    form.querySelectorAll('input[type="hidden"]:not([name="_token"]):not([name="_method"])').forEach(input => {
        input.remove();
    });
    
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

function deleteInquiry() {
    if (confirm('Are you sure you want to delete this inquiry?\n\nThis action cannot be undone.')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endpush

@push('styles')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: -35px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #dee2e6;
}

.timeline::before {
    content: '';
    position: absolute;
    left: -29px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-title {
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.timeline-text {
    font-size: 0.8rem;
    color: #6c757d;
    margin-bottom: 0;
}
</style>
@endpush
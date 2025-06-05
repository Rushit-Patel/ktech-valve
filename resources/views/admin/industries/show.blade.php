@extends('admin.layouts.app')

@section('title', 'View Industry: ' . $industry->name)
@section('page-title', 'View Industry')

@section('page-actions')
    <a href="{{ route('admin.industries.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Industries
    </a>
    <a href="{{ route('admin.industries.edit', $industry->id) }}" class="btn btn-primary">
        <i class="fas fa-edit me-1"></i>Edit Industry
    </a>
    <form action="{{ route('admin.industries.destroy', $industry->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this industry?')">
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
                <h5 class="mb-0">Industry Information</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <strong>Industry Name:</strong>
                    </div>
                    <div class="col-sm-9">
                        {{ $industry->name }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <strong>Slug:</strong>
                    </div>
                    <div class="col-sm-9">
                        <code>{{ $industry->slug ?: 'Not set' }}</code>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <strong>Description:</strong>
                    </div>
                    <div class="col-sm-9">
                        @if($industry->description)
                            <p class="mb-0">{{ $industry->description }}</p>
                        @else
                            <em class="text-muted">No description provided</em>
                        @endif
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <strong>Status:</strong>
                    </div>
                    <div class="col-sm-9">
                        @if($industry->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <strong>Sort Order:</strong>
                    </div>
                    <div class="col-sm-9">
                        {{ $industry->sort_order }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <strong>Created:</strong>
                    </div>
                    <div class="col-sm-9">
                        {{ $industry->created_at->format('M d, Y \a\t g:i A') }}
                        <small class="text-muted">({{ $industry->created_at->diffForHumans() }})</small>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <strong>Last Updated:</strong>
                    </div>
                    <div class="col-sm-9">
                        {{ $industry->updated_at->format('M d, Y \a\t g:i A') }}
                        <small class="text-muted">({{ $industry->updated_at->diffForHumans() }})</small>
                    </div>
                </div>
            </div>
        </div>
        
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
                        @if($industry->meta_title)
                            {{ $industry->meta_title }}
                            <small class="text-muted d-block">{{ strlen($industry->meta_title) }} characters</small>
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
                        @if($industry->meta_description)
                            <p class="mb-1">{{ $industry->meta_description }}</p>
                            <small class="text-muted">{{ strlen($industry->meta_description) }} characters</small>
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
                        @if($industry->meta_keywords)
                            @foreach(explode(',', $industry->meta_keywords) as $keyword)
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
                <h5 class="mb-0">Industry Images</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <strong>Industry Image:</strong>
                    @if($industry->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $industry->image) }}" alt="{{ $industry->name }}" class="img-fluid rounded" style="max-width: 100%;">
                        </div>
                    @else
                        <div class="mt-2">
                            <div class="bg-light p-4 text-center rounded">
                                <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                <p class="text-muted mb-0">No image uploaded</p>
                            </div>
                        </div>
                    @endif
                </div>
                
                <div>
                    <strong>Industry Icon:</strong>
                    @if($industry->icon)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $industry->icon) }}" alt="{{ $industry->name }} icon" class="img-fluid rounded" style="max-width: 150px;">
                        </div>
                    @else
                        <div class="mt-2">
                            <div class="bg-light p-3 text-center rounded" style="max-width: 150px;">
                                <i class="fas fa-star fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0 small">No icon uploaded</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.industries.edit', $industry->id) }}" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-1"></i>Edit Industry
                    </a>
                    
                    @if($industry->is_active)
                        <form action="{{ route('admin.industries.update', $industry->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_active" value="0">
                            <button type="submit" class="btn btn-outline-warning w-100">
                                <i class="fas fa-eye-slash me-1"></i>Deactivate
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.industries.update', $industry->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_active" value="1">
                            <button type="submit" class="btn btn-outline-success w-100">
                                <i class="fas fa-eye me-1"></i>Activate
                            </button>
                        </form>
                    @endif
                    
                    <form action="{{ route('admin.industries.destroy', $industry->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this industry? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fas fa-trash me-1"></i>Delete Industry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
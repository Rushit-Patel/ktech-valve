@extends('admin.layouts.app')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product: ' . $product->name)

@section('page-actions')
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Products
    </a>
    <a href="{{ route('admin.products.show', $product) }}" class="btn btn-info">
        <i class="fas fa-eye me-1"></i>View Product
    </a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Product Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" value="{{ old('sku', $product->sku) }}">
                            @error('sku')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $product->slug) }}">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="short_description" class="form-label">Short Description</label>
                        <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="3">{{ old('short_description', $product->short_description) }}</textarea>
                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control ckeditor @error('description') is-invalid @enderror" id="description" name="description" rows="10">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="specifications" class="form-label">Specifications</label>
                        <textarea class="form-control ckeditor @error('specifications') is-invalid @enderror" id="specifications" name="specifications" rows="8">{{ old('specifications', $product->specifications) }}</textarea>
                        @error('specifications')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Technical Details Section -->
                    @if($product->technical_details)
                    <div class="mb-3">
                        <label class="form-label">Technical Details</label>
                        <div id="technical-details-container">
                            @foreach($product->technical_details as $key => $value)
                            <div class="row mb-2 technical-detail-row">
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="technical_details_keys[]" value="{{ $key }}" placeholder="Detail Name">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="technical_details_values[]" value="{{ $value }}" placeholder="Detail Value">
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger btn-sm remove-technical-detail">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-technical-detail">
                            <i class="fas fa-plus"></i> Add Technical Detail
                        </button>
                    </div>
                    @endif
                </div>
            </div>

            <!-- SEO Section -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">SEO Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" value="{{ old('meta_title', $product->meta_title) }}">
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $product->meta_description) }}</textarea>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                        <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $product->meta_keywords) }}">
                        @error('meta_keywords')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Product Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select select2 @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="industries" class="form-label">Industries</label>
                        <select class="form-select select2 @error('industries') is-invalid @enderror" id="industries" name="industries[]" multiple>
                            @foreach($industries as $industry)
                                <option value="{{ $industry->id }}" 
                                    {{ in_array($industry->id, old('industries', $product->industries->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $industry->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('industries')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                Featured Product
                            </label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $product->sort_order ?? 0) }}">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Product Images</h5>
                </div>
                <div class="card-body">
                    <!-- Current Banner Image -->
                    @if($product->banner_image)
                    <div class="mb-3">
                        <label class="form-label">Current Banner Image</label>
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $product->banner_image) }}" alt="Banner Image" class="img-fluid rounded" style="max-height: 200px;">
                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" onclick="removeBannerImage()">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <input type="hidden" name="remove_banner_image" id="remove_banner_image" value="0">
                    </div>
                    @endif
                    
                    <div class="mb-3">
                        <label for="banner_image" class="form-label">Banner Image</label>
                        <input type="file" class="form-control @error('banner_image') is-invalid @enderror" id="banner_image" name="banner_image" accept="image/*">
                        @error('banner_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Current Gallery Images -->
                    @if($product->images && count($product->images) > 0)
                    <div class="mb-3">
                        <label class="form-label">Current Gallery Images</label>
                        <div class="row" id="current-images">
                            @foreach($product->images as $index => $image)
                            <div class="col-6 mb-2" data-image="{{ $image }}">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Product Image" class="img-fluid rounded" style="height: 100px; object-fit: cover;">
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" onclick="removeImage('{{ $image }}', this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <div class="mb-3">
                        <label for="images" class="form-label">Add New Gallery Images</label>
                        <input type="file" class="form-control @error('images') is-invalid @enderror" id="images" name="images[]" multiple accept="image/*">
                        @error('images')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">You can select multiple images.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-12">
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Product</button>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value;
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9 -]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim('-');
        document.getElementById('slug').value = slug;
    });

    // Remove image functionality
    let imagesToRemove = [];
    
    function removeImage(imagePath, button) {
        if (confirm('Are you sure you want to remove this image?')) {
            imagesToRemove.push(imagePath);
            button.closest('.col-6').remove();
            updateRemoveImagesInput();
        }
    }
    
    function removeBannerImage() {
        if (confirm('Are you sure you want to remove the banner image?')) {
            document.getElementById('remove_banner_image').value = '1';
            document.querySelector('[data-banner-image]').style.display = 'none';
        }
    }
    
    function updateRemoveImagesInput() {
        // Create hidden inputs for images to remove
        const existingInputs = document.querySelectorAll('input[name="remove_images[]"]');
        existingInputs.forEach(input => input.remove());
        
        imagesToRemove.forEach(image => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'remove_images[]';
            input.value = image;
            document.querySelector('form').appendChild(input);
        });
    }

    // Technical details functionality
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('technical-details-container');
        const addButton = document.getElementById('add-technical-detail');
        
        if (addButton) {
            addButton.addEventListener('click', function() {
                const row = document.createElement('div');
                row.className = 'row mb-2 technical-detail-row';
                row.innerHTML = `
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="technical_details_keys[]" placeholder="Detail Name">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="technical_details_values[]" placeholder="Detail Value">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm remove-technical-detail">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
                container.appendChild(row);
            });
        }
        
        // Remove technical detail
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-technical-detail')) {
                e.target.closest('.technical-detail-row').remove();
            }
        });
    });
</script>
@endpush
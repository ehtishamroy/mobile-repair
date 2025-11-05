@extends('admin.layouts.app')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('admin-panel/plugins/summernote/summernote-bs4.min.css') }}">
@endpush

@section('content')
<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="productForm">
    <div id="formErrors" class="alert alert-danger" style="display: none;"></div>
    @csrf
    @method('PUT')
    
    <!-- Basic Information -->
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Basic Information</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sku">SKU <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('sku') is-invalid @enderror" 
                                       id="sku" name="sku" value="{{ old('sku', $product->sku) }}" required>
                                @error('sku')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                       id="slug" name="slug" value="{{ old('slug', $product->slug) }}">
                                @error('slug')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_id">Category <span class="text-danger">*</span></label>
                                <select class="form-control @error('category_id') is-invalid @enderror" 
                                        id="category_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="brand_id">Brand</label>
                                <select class="form-control @error('brand_id') is-invalid @enderror" 
                                        id="brand_id" name="brand_id">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Price <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ $settings->currency_symbol ?? '$' }}</span>
                                    </div>
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                           id="price" name="price" value="{{ old('price', $product->price) }}" required>
                                </div>
                                @error('price')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="compare_at_price">Compare At Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ $settings->currency_symbol ?? '$' }}</span>
                                    </div>
                                    <input type="number" step="0.01" class="form-control @error('compare_at_price') is-invalid @enderror" 
                                           id="compare_at_price" name="compare_at_price" value="{{ old('compare_at_price', $product->compare_at_price) }}">
                                </div>
                                <small class="form-text text-muted">Original price for discount display</small>
                                @error('compare_at_price')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quantity">Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                       id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
                                @error('quantity')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="availability">Availability <span class="text-danger">*</span></label>
                                <select class="form-control @error('availability') is-invalid @enderror" 
                                        id="availability" name="availability" required>
                                    <option value="in_stock" {{ old('availability', $product->availability) == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                    <option value="out_of_stock" {{ old('availability', $product->availability) == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                    <option value="pre_order" {{ old('availability', $product->availability) == 'pre_order' ? 'selected' : '' }}>Pre Order</option>
                                </select>
                                @error('availability')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tags</label>
                        <div class="row">
                            @foreach($tags as $tag)
                                <div class="col-md-3">
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}" 
                                               {{ in_array($tag->id, old('tags', $product->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        <label for="tag_{{ $tag->id }}">
                                            {{ $tag->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Product Settings</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_featured">Featured Product</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_best_deal" name="is_best_deal" value="1" {{ old('is_best_deal', $product->is_best_deal) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_best_deal">Best Deal</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_hot_product" name="is_hot_product" value="1" {{ old('is_hot_product', $product->is_hot_product) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_hot_product">Hot Product</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="has_color_variant" name="has_color_variant" value="1" {{ old('has_color_variant', $product->has_color_variant) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="has_color_variant">Has Color Variant</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Featured Image</h3>
                </div>
                <div class="card-body">
                    @if($product->featured_image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $product->featured_image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-height: 200px;">
                        <p class="text-muted small mt-1">Current featured image</p>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="featured_image">Change Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('featured_image') is-invalid @enderror" 
                                       id="featured_image" name="featured_image" accept="image/*">
                                <label class="custom-file-label" for="featured_image">Choose file</label>
                            </div>
                        </div>
                        @error('featured_image')
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                        <small class="form-text text-muted">Recommended size: 800x800px. Max size: 2MB</small>
                        <div id="featured_image_preview" class="mt-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Images -->
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Gallery Images</h3>
                </div>
                <div class="card-body">
                    @if($product->galleryImages->count() > 0)
                    <div class="mb-3">
                        <label>Current Gallery Images</label>
                        <div class="row">
                            @foreach($product->galleryImages as $galleryImage)
                            <div class="col-md-3 mb-2">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $galleryImage->image) }}" class="img-fluid" style="max-height: 150px;">
                                    <button type="button" class="btn btn-sm btn-danger position-absolute" style="top: 5px; right: 5px;" onclick="deleteGalleryImage({{ $galleryImage->id }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="gallery_images">Add More Images</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('gallery_images.*') is-invalid @enderror" 
                                       id="gallery_images" name="gallery_images[]" accept="image/*" multiple>
                                <label class="custom-file-label" for="gallery_images">Choose files</label>
                            </div>
                        </div>
                        @error('gallery_images.*')
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                        <small class="form-text text-muted">You can select multiple images. Max size: 2MB per image</small>
                        <div id="gallery_preview" class="row mt-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Description</h3>
                </div>
                <div class="card-body">
                    <textarea id="description" name="description" class="summernote">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Additional Information</h3>
                </div>
                <div class="card-body">
                    <textarea id="additional_information" name="additional_information" class="summernote">{{ old('additional_information', $product->additional_information) }}</textarea>
                    @error('additional_information')
                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Specifications -->
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Specifications</h3>
                </div>
                <div class="card-body">
                    <textarea id="specifications" name="specifications" class="summernote">{{ old('specifications', $product->specifications) }}</textarea>
                    @error('specifications')
                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Variants -->
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Product Variants</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-primary" id="addVariant">
                            <i class="fas fa-plus"></i> Add Variant
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="variantsContainer">
                        @foreach($product->variants as $variant)
                        <div class="card mb-3 variant-item" data-index="{{ $variant->id }}" data-variant-id="{{ $variant->id }}">
                            <div class="card-header">
                                <h5 class="card-title mb-0">{{ $variant->name }}</h5>
                                <button type="button" class="btn btn-sm btn-danger float-right removeVariant">Remove</button>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="variants[{{ $variant->id }}][id]" value="{{ $variant->id }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Variant Name</label>
                                            <input type="text" class="form-control" name="variants[{{ $variant->id }}][name]" value="{{ $variant->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Variant Type</label>
                                            <select class="form-control variant-type" name="variants[{{ $variant->id }}][type]" data-index="{{ $variant->id }}">
                                                <option value="select" {{ $variant->type == 'select' ? 'selected' : '' }}>Select</option>
                                                <option value="color" {{ $variant->type == 'color' ? 'selected' : '' }}>Color</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Order</label>
                                            <input type="number" class="form-control" name="variants[{{ $variant->id }}][order]" value="{{ $variant->order }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="variant-options-container" data-variant-index="{{ $variant->id }}">
                                    <label>Variant Options</label>
                                    <button type="button" class="btn btn-sm btn-info mb-2 addVariantOption" data-variant-index="{{ $variant->id }}">Add Option</button>
                                    <div class="variant-options-list">
                                        @foreach($variant->options as $option)
                                        <div class="card mb-2 option-item">
                                            <div class="card-body">
                                                <input type="hidden" name="variants[{{ $variant->id }}][options][{{ $option->id }}][id]" value="{{ $option->id }}">
                                                <div class="row">
                                                    @if($variant->type == 'color')
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Color Value</label>
                                                            <input type="text" class="form-control" name="variants[{{ $variant->id }}][options][{{ $option->id }}][value]" value="{{ $option->value }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Color Code</label>
                                                            <input type="color" class="form-control" name="variants[{{ $variant->id }}][options][{{ $option->id }}][color_code]" value="{{ $option->color_code ?: '#000000' }}" style="height: 38px;">
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>Option Value</label>
                                                            <input type="text" class="form-control" name="variants[{{ $variant->id }}][options][{{ $option->id }}][value]" value="{{ $option->value }}" required>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Order</label>
                                                            <input type="number" class="form-control" name="variants[{{ $variant->id }}][options][{{ $option->id }}][order]" value="{{ $option->order }}">
                                                            <button type="button" class="btn btn-sm btn-danger mt-2 removeOption">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Variant Combinations Matrix (Shopify-like) -->
    <div class="row" id="variantMatrixSection">
        <div class="col-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-table"></i> Variant Combinations & Pricing</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-success" id="generateMatrixBtn">
                            <i class="fas fa-sync-alt"></i> Generate Matrix
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> <strong>Instructions:</strong> 
                        <ol class="mb-0">
                            <li>Add variants above (e.g., "Color", "Storage")</li>
                            <li>Add options for each variant (e.g., "Red", "Blue" for Color and "64GB", "128GB" for Storage)</li>
                            <li>The matrix will appear automatically below OR click "Generate Matrix"</li>
                            <li>Set custom price, quantity, and SKU for each combination</li>
                        </ol>
                    </div>
                    <div id="matrixMessage" class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> Please add at least one variant with options above, then click "Generate Matrix" or wait for auto-generation.
                    </div>
                    <div class="table-responsive" id="matrixTableContainer" style="display: none;">
                        <table class="table table-bordered table-hover table-striped" id="variantMatrixTable">
                            <thead class="thead-light">
                                <tr id="variantMatrixHeader">
                                    <!-- Header will be generated dynamically -->
                                </tr>
                            </thead>
                            <tbody id="variantMatrixBody">
                                <!-- Rows will be generated dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Product Features</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-primary" id="addFeature">
                            <i class="fas fa-plus"></i> Add Feature
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="featuresContainer">
                        @foreach($product->features as $feature)
                        <div class="card mb-3 feature-item" data-feature-id="{{ $feature->id }}">
                            <div class="card-body">
                                <input type="hidden" name="features[{{ $feature->id }}][id]" value="{{ $feature->id }}">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Icon Image</label>
                                            @php
                                                $iconExists = $feature->icon && \Illuminate\Support\Facades\Storage::disk('public')->exists($feature->icon);
                                            @endphp
                                            @if($iconExists)
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $feature->icon) }}" alt="Icon" style="max-height: 50px;">
                                                </div>
                                            @endif
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input feature-icon-input" 
                                                       id="featureIcon{{ $feature->id }}" 
                                                       name="features[{{ $feature->id }}][icon]" 
                                                       accept="image/*">
                                                <label class="custom-file-label" for="featureIcon{{ $feature->id }}">Choose new image</label>
                                            </div>
                                            <small class="text-muted">Leave empty to keep current</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" name="features[{{ $feature->id }}][title]" value="{{ $feature->title }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <input type="text" class="form-control" name="features[{{ $feature->id }}][description]" value="{{ $feature->description }}">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>Order</label>
                                            <input type="number" class="form-control" name="features[{{ $feature->id }}][order]" value="{{ $feature->order }}">
                                            <button type="button" class="btn btn-sm btn-danger mt-2 removeFeature">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Buttons -->
    <div class="row">
        <div class="col-12">
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Product
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script src="{{ asset('admin-panel/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
function deleteGalleryImage(imageId) {
    if (confirm('Are you sure you want to delete this image?')) {
        fetch('{{ route("admin.products.gallery.delete", ":id") }}'.replace(':id', imageId), {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => response.json()).then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}

$(document).ready(function() {
    // Initialize Summernote editors
    $('.summernote').summernote({
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    // File input label update
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').html(fileName || 'Choose file');
    });

    // Featured image preview
    $('#featured_image').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#featured_image_preview').html('<img src="' + e.target.result + '" class="img-fluid" style="max-height: 200px;">');
            };
            reader.readAsDataURL(file);
        }
    });

    // Gallery images preview
    $('#gallery_images').on('change', function(e) {
        const files = e.target.files;
        $('#gallery_preview').html('');
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#gallery_preview').append(
                    '<div class="col-md-3 mb-2">' +
                    '<img src="' + e.target.result + '" class="img-fluid" style="max-height: 150px;">' +
                    '</div>'
                );
            };
            reader.readAsDataURL(files[i]);
        }
    });

    // Variant management - similar to create view
    let variantIndex = {{ $product->variants->count() }};
    $('#addVariant').on('click', function() {
        const variantHtml = `
            <div class="card mb-3 variant-item" data-index="${variantIndex}">
                <div class="card-header">
                    <h5 class="card-title mb-0">Variant ${variantIndex + 1}</h5>
                    <button type="button" class="btn btn-sm btn-danger float-right removeVariant">Remove</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Variant Name (e.g., Color, Size)</label>
                                <input type="text" class="form-control" name="variants[${variantIndex}][name]" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Variant Type</label>
                                <select class="form-control variant-type" name="variants[${variantIndex}][type]" data-index="${variantIndex}">
                                    <option value="select">Select</option>
                                    <option value="color">Color</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Order</label>
                                <input type="number" class="form-control" name="variants[${variantIndex}][order]" value="${variantIndex}">
                            </div>
                        </div>
                    </div>
                    <div class="variant-options-container" data-variant-index="${variantIndex}">
                        <label>Variant Options</label>
                        <button type="button" class="btn btn-sm btn-info mb-2 addVariantOption" data-variant-index="${variantIndex}">Add Option</button>
                        <div class="variant-options-list"></div>
                    </div>
                </div>
            </div>
        `;
        $('#variantsContainer').append(variantHtml);
        variantIndex++;
    });

    $(document).on('click', '.removeVariant', function() {
        const variantId = $(this).closest('.variant-item').data('variant-id');
        if (variantId) {
            // Mark for deletion
            $(this).closest('.variant-item').append('<input type="hidden" name="delete_variants[]" value="' + variantId + '">');
            $(this).closest('.variant-item').hide();
        } else {
            $(this).closest('.variant-item').remove();
        }
        generateVariantMatrix();
    });

    $(document).on('click', '.addVariantOption', function() {
        const variantIndex = $(this).data('variant-index');
        const optionIndex = $(this).closest('.variant-options-container').find('.option-item').length;
        const variantType = $(this).closest('.variant-item').find('.variant-type').val();
        
        let optionHtml = '';
        if (variantType === 'color') {
            optionHtml = `
                <div class="card mb-2 option-item">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Color Value</label>
                                    <input type="text" class="form-control" name="variants[${variantIndex}][options][${optionIndex}][value]" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Color Code</label>
                                    <input type="color" class="form-control" name="variants[${variantIndex}][options][${optionIndex}][color_code]" style="height: 38px;">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Order</label>
                                    <input type="number" class="form-control" name="variants[${variantIndex}][options][${optionIndex}][order]" value="${optionIndex}">
                                    <button type="button" class="btn btn-sm btn-danger mt-2 removeOption">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        } else {
            optionHtml = `
                <div class="card mb-2 option-item">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Option Value</label>
                                    <input type="text" class="form-control" name="variants[${variantIndex}][options][${optionIndex}][value]" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Order</label>
                                    <input type="number" class="form-control" name="variants[${variantIndex}][options][${optionIndex}][order]" value="${optionIndex}">
                                    <button type="button" class="btn btn-sm btn-danger mt-2 removeOption">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }
        $(this).siblings('.variant-options-list').append(optionHtml);
        generateVariantMatrix();
    });

    $(document).on('click', '.removeOption', function() {
        $(this).closest('.option-item').remove();
        generateVariantMatrix();
    });

    // Generate variant combinations matrix (Shopify-like)
    function generateVariantMatrix() {
        const variants = [];
        const variantItems = $('.variant-item:visible');
        
        variantItems.each(function() {
            const variantIndex = $(this).data('index');
            const variantId = $(this).data('variant-id');
            const variantName = $(this).find('input[name*="[name]"]').val().trim();
            const options = [];
            
            $(this).find('.option-item:visible').each(function() {
                const optionValue = $(this).find('input[name*="[value]"]').val().trim();
                if (optionValue) {
                    options.push(optionValue);
                }
            });
            
            if (variantName && options.length > 0) {
                variants.push({
                    index: variantIndex,
                    id: variantId,
                    name: variantName,
                    options: options
                });
            }
        });
        
        if (variants.length === 0) {
            $('#matrixMessage').show();
            $('#matrixTableContainer').hide();
            return;
        }
        
        $('#matrixMessage').hide();
        $('#matrixTableContainer').show();
        
        // Generate all combinations
        const combinations = generateCombinations(variants);
        
        if (combinations.length === 0) {
            $('#matrixMessage').show();
            $('#matrixTableContainer').hide();
            return;
        }
        
        // Generate header
        let headerHtml = '';
        variants.forEach(variant => {
            headerHtml += `<th class="bg-light"><strong>${variant.name}</strong></th>`;
        });
        headerHtml += '<th class="bg-light"><strong>Price ({{ $settings->currency_symbol ?? '$' }})</strong></th><th class="bg-light"><strong>Compare Price ({{ $settings->currency_symbol ?? '$' }})</strong></th><th class="bg-light"><strong>Quantity</strong></th><th class="bg-light"><strong>SKU</strong></th>';
        $('#variantMatrixHeader').html(headerHtml);
        
        // Debug: Log all combinations being generated
        console.log('Variants found:', variants);
        console.log('Combinations to generate:', combinations.length);
        
        // Get existing variant values - normalize keys for matching
        const existingValues = {};
        @if($product->variantValues->count() > 0)
            @foreach($product->variantValues as $variantValue)
                @php
                    // Normalize combination by sorting keys
                    $combination = is_array($variantValue->variant_combination) 
                        ? $variantValue->variant_combination 
                        : json_decode($variantValue->variant_combination, true);
                    if (!is_array($combination)) {
                        $combination = [];
                    }
                    ksort($combination);
                    $normalizedKey = json_encode($combination, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                @endphp
                (function() {
                    const key = {!! json_encode($normalizedKey) !!};
                    existingValues[key] = {
                        price: {{ $variantValue->price !== null ? number_format($variantValue->price, 2, '.', '') : 'null' }},
                        compare_at_price: {{ $variantValue->compare_at_price !== null ? number_format($variantValue->compare_at_price, 2, '.', '') : 'null' }},
                        quantity: {{ $variantValue->quantity ?? 0 }},
                        sku: '{{ addslashes($variantValue->sku ?? '') }}'
                    };
                })();
            @endforeach
        @endif
        
        // Debug: Log existing values
        console.log('Existing variant values object:', existingValues);
        console.log('Existing values keys:', Object.keys(existingValues));
        
        // Helper function to normalize combination keys - match PHP's json_encode format
        function normalizeCombination(combination) {
            const sorted = {};
            Object.keys(combination).sort().forEach(key => {
                sorted[key] = combination[key];
            });
            // Use JSON.stringify without any spaces to match PHP's json_encode
            return JSON.stringify(sorted);
        }
        
        // Also create a lookup function that tries multiple key formats
        function findExistingValue(combinationKey, existingValues) {
            // Try exact match first
            if (existingValues[combinationKey]) {
                return existingValues[combinationKey];
            }
            
            // Try to decode HTML entities in keys and match
            const keys = Object.keys(existingValues);
            for (let i = 0; i < keys.length; i++) {
                // Decode HTML entities in the key
                const decodedKey = keys[i].replace(/&quot;/g, '"').replace(/&#39;/g, "'").replace(/&amp;/g, '&');
                if (decodedKey === combinationKey) {
                    return existingValues[keys[i]];
                }
                
                // Also try normalizing both sides
                try {
                    const decodedParsed = JSON.parse(decodedKey);
                    const decodedNormalized = normalizeCombination(decodedParsed);
                    const currentParsed = JSON.parse(combinationKey);
                    const currentNormalized = normalizeCombination(currentParsed);
                    if (decodedNormalized === currentNormalized) {
                        return existingValues[keys[i]];
                    }
                } catch(e) {
                    // Skip if parsing fails
                }
            }
            
            return null;
        }
        
        // Generate body
        let bodyHtml = '';
        const basePrice = parseFloat($('#price').val()) || 0;
        const baseComparePrice = parseFloat($('#compare_at_price').val()) || 0;
        const currencySymbol = '{{ $settings->currency_symbol ?? '$' }}';
        
        combinations.forEach((combination, index) => {
            const combinationKey = normalizeCombination(combination);
            const existing = existingValues[combinationKey] || {};
            
            // Debug: Log every combination being checked
            console.log(`Combination ${index}:`, combinationKey);
            console.log('  Key exists in existingValues:', combinationKey in existingValues);
            console.log('  Value:', existingValues[combinationKey]);
            if (existing && Object.keys(existing).length > 0) {
                console.log('  -> Using values:', existing);
            } else {
                console.log('  -> No match found, using empty');
            }
            
            bodyHtml += '<tr>';
            
            // Variant values
            variants.forEach(variant => {
                bodyHtml += `<td><strong class="text-primary">${combination[variant.name]}</strong></td>`;
            });
            
            // Price input - use existing price if available, otherwise empty
            const existingPrice = (existing.price !== null && existing.price !== undefined && existing.price !== 'null') ? existing.price : '';
            bodyHtml += `
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">${currencySymbol}</span>
                        </div>
                        <input type="number" step="0.01" class="form-control variant-price" 
                               name="variant_values[${index}][price]" 
                               value="${existingPrice}"
                               placeholder="${basePrice.toFixed(2)}"
                               data-base-price="${basePrice}">
                    </div>
                    <small class="text-muted">Empty = ${currencySymbol}${basePrice.toFixed(2)}</small>
                </td>
            `;
            
            // Compare At Price input - use existing compare price if available, otherwise empty
            const existingComparePrice = (existing.compare_at_price !== null && existing.compare_at_price !== undefined && existing.compare_at_price !== 'null') ? existing.compare_at_price : '';
            bodyHtml += `
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">${currencySymbol}</span>
                        </div>
                        <input type="number" step="0.01" class="form-control variant-compare-price" 
                               name="variant_values[${index}][compare_at_price]" 
                               value="${existingComparePrice}"
                               placeholder="${baseComparePrice > 0 ? baseComparePrice.toFixed(2) : 'Optional'}"
                               data-base-compare-price="${baseComparePrice}">
                    </div>
                    <small class="text-muted">${baseComparePrice > 0 ? 'Empty = ' + currencySymbol + baseComparePrice.toFixed(2) : 'Optional discount price'}</small>
                </td>
            `;
            
            // Quantity input - always show existing quantity or 0
            bodyHtml += `
                <td>
                    <input type="number" class="form-control" 
                           name="variant_values[${index}][quantity]" 
                           value="${existing.quantity !== null && existing.quantity !== undefined ? existing.quantity : 0}" 
                           min="0" required>
                </td>
            `;
            
            // SKU input
            bodyHtml += `
                <td>
                    <input type="text" class="form-control" 
                           name="variant_values[${index}][sku]" 
                           value="${existing.sku || ''}"
                           placeholder="Optional SKU">
                </td>
            `;
            
            // Hidden combination field - properly escape JSON
            bodyHtml += `<input type="hidden" name="variant_values[${index}][combination]" value="${JSON.stringify(combination).replace(/"/g, '&quot;')}">`;
            
            bodyHtml += '</tr>';
        });
        
        console.log('Generated combinations:', combinations.length);
        console.log('Matrix rows generated');
        
        $('#variantMatrixBody').html(bodyHtml);
        
        // Auto-fill base price if empty
        $(document).off('focus', '.variant-price').on('focus', '.variant-price', function() {
            if (!$(this).val()) {
                $(this).val($(this).data('base-price'));
            }
        });
    }
    
    // Generate all combinations from variants
    function generateCombinations(variants) {
        if (variants.length === 0) return [];
        
        const combinations = [];
        
        function generate(index, current) {
            if (index === variants.length) {
                combinations.push(Object.assign({}, current));
                return;
            }
            
            const variant = variants[index];
            variant.options.forEach(option => {
                const newCurrent = Object.assign({}, current);
                newCurrent[variant.name] = option;
                generate(index + 1, newCurrent);
            });
        }
        
        generate(0, {});
        return combinations;
    }
    
    // Manual generate matrix button
    $('#generateMatrixBtn').on('click', function() {
        generateVariantMatrix();
    });
    
    // Regenerate matrix when variants or options change - with debounce
    let matrixTimeout;
    $(document).on('input keyup change', '.variant-item input[name*="[name]"], .option-item input[name*="[value]"]', function() {
        clearTimeout(matrixTimeout);
        matrixTimeout = setTimeout(function() {
            generateVariantMatrix();
        }, 500);
    });
    
    // Regenerate when base price or compare price changes
    $(document).on('input change', '#price, #compare_at_price', function() {
        setTimeout(generateVariantMatrix, 200);
    });
    
    // Regenerate when variant type changes
    $(document).on('change', '.variant-type', function() {
        setTimeout(generateVariantMatrix, 200);
    });
    
    // Initial generation after page load - wait for variants to load
    // Also trigger when variants are loaded
    $(document).ready(function() {
        // Wait a bit for DOM to be fully ready
        setTimeout(function() {
            generateVariantMatrix();
        }, 2000);
    });
    
    // Also regenerate when variant name or option inputs change
    $(document).on('input', '.variant-item input[name*="[name]"], .option-item input[name*="[value]"]', function() {
        setTimeout(generateVariantMatrix, 300);
    });

    // Feature management
    let featureIndex = {{ $product->features->count() }};
    $('#addFeature').on('click', function() {
        const featureHtml = `
            <div class="card mb-3 feature-item">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Icon Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input feature-icon-input" 
                                           id="featureIcon${featureIndex}" 
                                           name="features[${featureIndex}][icon]" 
                                           accept="image/*">
                                    <label class="custom-file-label" for="featureIcon${featureIndex}">Choose image</label>
                                </div>
                                <div class="feature-icon-preview mt-2" style="display: none;">
                                    <img src="" alt="Icon preview" style="max-height: 50px;">
                                </div>
                                <small class="text-muted">Upload icon image</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="features[${featureIndex}][title]" required>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="features[${featureIndex}][description]">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label>Order</label>
                                <input type="number" class="form-control" name="features[${featureIndex}][order]" value="${featureIndex}">
                                <button type="button" class="btn btn-sm btn-danger mt-2 removeFeature">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('#featuresContainer').append(featureHtml);
        featureIndex++;
    });

    $(document).on('click', '.removeFeature', function() {
        const featureId = $(this).closest('.feature-item').data('feature-id');
        if (featureId) {
            $(this).closest('.feature-item').append('<input type="hidden" name="delete_features[]" value="' + featureId + '">');
            $(this).closest('.feature-item').hide();
        } else {
            $(this).closest('.feature-item').remove();
        }
    });
    
    // Feature icon preview
    $(document).on('change', '.feature-icon-input', function() {
        const file = this.files[0];
        const preview = $(this).closest('.form-group').find('.feature-icon-preview');
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (preview.length === 0) {
                    $(this).closest('.form-group').append('<div class="feature-icon-preview mt-2"><img src="' + e.target.result + '" alt="Icon preview" style="max-height: 50px;"></div>');
                } else {
                    preview.find('img').attr('src', e.target.result);
                    preview.show();
                }
            }.bind(this);
            reader.readAsDataURL(file);
        } else {
            preview.hide();
        }
    });
    
    // AJAX Form Submission with validation
    $('#productForm').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        
        // Update Summernote content before submit
        $('.summernote').each(function() {
            $(this).summernote('code', $(this).summernote('code'));
        });
        
        // Collect variant values manually to ensure they're included
        const variantValues = [];
        $('#variantMatrixBody tr').each(function(index) {
            const row = $(this);
            const combinationInput = row.find('input[name*="[combination]"]');
            const priceInput = row.find('input[name*="[price]"]');
            const comparePriceInput = row.find('input[name*="[compare_at_price]"]');
            const quantityInput = row.find('input[name*="[quantity]"]');
            const skuInput = row.find('input[name*="[sku]"]');
            
            if (combinationInput.length && combinationInput.val()) {
                variantValues.push({
                    combination: combinationInput.val(),
                    price: priceInput.val() || '',
                    compare_at_price: comparePriceInput.val() || '',
                    quantity: quantityInput.val() || '0',
                    sku: skuInput.val() || ''
                });
            }
        });
        
        const formData = new FormData(this);
        
        // Remove old variant_values and add new ones manually
        // FormData doesn't handle nested arrays well, so we need to do this manually
        const keysToDelete = [];
        for (let key of formData.keys()) {
            if (key.startsWith('variant_values')) {
                keysToDelete.push(key);
            }
        }
        keysToDelete.forEach(key => formData.delete(key));
        
        // Append variant values properly
        variantValues.forEach((value, index) => {
            formData.append(`variant_values[${index}][combination]`, value.combination);
            formData.append(`variant_values[${index}][price]`, value.price);
            formData.append(`variant_values[${index}][compare_at_price]`, value.compare_at_price);
            formData.append(`variant_values[${index}][quantity]`, value.quantity);
            formData.append(`variant_values[${index}][sku]`, value.sku);
        });
        
        const submitBtn = form.find('button[type="submit"]');
        const originalText = submitBtn.html();
        
        // Clear previous errors
        $('#formErrors').hide().html('');
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        
        // Show loading state
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Success - redirect to products list
                window.location.href = '{{ route('admin.products.index') }}';
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html(originalText);
                
                if (xhr.status === 422) {
                    // Validation errors
                    const errors = xhr.responseJSON.errors || {};
                    let errorHtml = '<strong>Please fix the following errors:</strong><ul class="mb-0">';
                    
                    let firstErrorField = null;
                    
                    $.each(errors, function(field, messages) {
                        const fieldName = field.replace(/\./g, '_');
                        let input = form.find(`[name="${field}"]`);
                        
                        if (input.length === 0) {
                            // Try to find by name attribute with array notation
                            const fieldParts = field.split('.');
                            if (fieldParts.length > 1) {
                                const nameAttr = fieldParts[0] + '[' + fieldParts.slice(1).join('][') + ']';
                                input = form.find(`[name="${nameAttr}"]`);
                            }
                        }
                        
                        if (input.length > 0) {
                            input.addClass('is-invalid');
                            input.after('<span class="invalid-feedback"><strong>' + messages[0] + '</strong></span>');
                            
                            if (!firstErrorField) {
                                firstErrorField = input;
                            }
                        }
                        
                        errorHtml += '<li><strong>' + field + ':</strong> ' + messages[0] + '</li>';
                    });
                    
                    errorHtml += '</ul>';
                    $('#formErrors').html(errorHtml).show();
                    
                    // Scroll to first error
                    if (firstErrorField) {
                        $('html, body').animate({
                            scrollTop: firstErrorField.offset().top - 100
                        }, 500);
                        firstErrorField.focus();
                    } else {
                        $('html, body').animate({
                            scrollTop: $('#formErrors').offset().top - 100
                        }, 500);
                    }
                } else {
                    // Other errors
                    $('#formErrors').html('<strong>Error:</strong> ' + (xhr.responseJSON.message || 'An error occurred. Please try again.')).show();
                    $('html, body').animate({
                        scrollTop: $('#formErrors').offset().top - 100
                    }, 500);
                }
            }
        });
    });
});
</script>
@endpush


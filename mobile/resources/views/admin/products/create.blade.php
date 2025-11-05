@extends('admin.layouts.app')

@section('title', 'Create Product')
@section('page-title', 'Create Product')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('admin-panel/plugins/summernote/summernote-bs4.min.css') }}">
@endpush

@section('content')
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
    <div id="formErrors" class="alert alert-danger" style="display: none;"></div>
    @csrf
    
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
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sku">SKU <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('sku') is-invalid @enderror" 
                                       id="sku" name="sku" value="{{ old('sku') }}" required>
                                @error('sku')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                       id="slug" name="slug" value="{{ old('slug') }}" placeholder="Auto-generated">
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
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
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
                                           id="price" name="price" value="{{ old('price') }}" required>
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
                                           id="compare_at_price" name="compare_at_price" value="{{ old('compare_at_price') }}">
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
                                       id="quantity" name="quantity" value="{{ old('quantity', 0) }}" required>
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
                                    <option value="in_stock" {{ old('availability') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                    <option value="out_of_stock" {{ old('availability') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                    <option value="pre_order" {{ old('availability') == 'pre_order' ? 'selected' : '' }}>Pre Order</option>
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
                                               {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
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
                            <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_featured">Featured Product</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_best_deal" name="is_best_deal" value="1" {{ old('is_best_deal') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_best_deal">Best Deal</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_hot_product" name="is_hot_product" value="1" {{ old('is_hot_product') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_hot_product">Hot Product</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="has_color_variant" name="has_color_variant" value="1" {{ old('has_color_variant') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="has_color_variant">Has Color Variant</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" checked>
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
                    <div class="form-group">
                        <label for="featured_image">Image</label>
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
                    <div class="form-group">
                        <label for="gallery_images">Select Multiple Images</label>
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
                    <textarea id="description" name="description" class="summernote">{{ old('description') }}</textarea>
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
                    <textarea id="additional_information" name="additional_information" class="summernote">{{ old('additional_information') }}</textarea>
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
                    <textarea id="specifications" name="specifications" class="summernote">{{ old('specifications') }}</textarea>
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
                        <!-- Variants will be added here dynamically -->
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
                        <!-- Features will be added here dynamically -->
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
                    <i class="fas fa-save"></i> Create Product
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

    // Variant management
    let variantIndex = 0;
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
        $(this).closest('.variant-item').remove();
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
        const variantItems = $('.variant-item');
        
        variantItems.each(function() {
            const variantIndex = $(this).data('index');
            const variantName = $(this).find('input[name*="[name]"]').val().trim();
            const options = [];
            
            $(this).find('.option-item').each(function() {
                const optionValue = $(this).find('input[name*="[value]"]').val().trim();
                if (optionValue) {
                    options.push(optionValue);
                }
            });
            
            if (variantName && options.length > 0) {
                variants.push({
                    index: variantIndex,
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
        
        // Generate body
        let bodyHtml = '';
        const basePrice = parseFloat($('#price').val()) || 0;
        const baseComparePrice = parseFloat($('#compare_at_price').val()) || 0;
        const currencySymbol = '{{ $settings->currency_symbol ?? '$' }}';
        
        combinations.forEach((combination, index) => {
            const combinationKey = JSON.stringify(combination);
            bodyHtml += '<tr>';
            
            // Variant values
            variants.forEach(variant => {
                bodyHtml += `<td><strong class="text-primary">${combination[variant.name]}</strong></td>`;
            });
            
            // Price input
            bodyHtml += `
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">${currencySymbol}</span>
                        </div>
                        <input type="number" step="0.01" class="form-control variant-price" 
                               name="variant_values[${index}][price]" 
                               placeholder="${basePrice.toFixed(2)}"
                               data-base-price="${basePrice}">
                    </div>
                    <small class="text-muted">Empty = ${currencySymbol}${basePrice.toFixed(2)}</small>
                </td>
            `;
            
            // Compare At Price input
            bodyHtml += `
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">${currencySymbol}</span>
                        </div>
                        <input type="number" step="0.01" class="form-control variant-compare-price" 
                               name="variant_values[${index}][compare_at_price]" 
                               placeholder="${baseComparePrice > 0 ? baseComparePrice.toFixed(2) : 'Optional'}"
                               data-base-compare-price="${baseComparePrice}">
                    </div>
                    <small class="text-muted">${baseComparePrice > 0 ? 'Empty = ' + currencySymbol + baseComparePrice.toFixed(2) : 'Optional discount price'}</small>
                </td>
            `;
            
            // Quantity input
            bodyHtml += `
                <td>
                    <input type="number" class="form-control" 
                           name="variant_values[${index}][quantity]" 
                           value="0" min="0" required>
                </td>
            `;
            
            // SKU input
            bodyHtml += `
                <td>
                    <input type="text" class="form-control" 
                           name="variant_values[${index}][sku]" 
                           placeholder="Optional SKU">
                </td>
            `;
            
            // Hidden combination field - properly escape JSON
            bodyHtml += `<input type="hidden" name="variant_values[${index}][combination]" value="${combinationKey.replace(/"/g, '&quot;')}">`;
            
            bodyHtml += '</tr>';
        });
        
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
    
    // Initial generation after page load
    setTimeout(function() {
        generateVariantMatrix();
    }, 1000);

    // Feature management
    let featureIndex = 0;
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
        $(this).closest('.feature-item').remove();
    });
    
    // Feature icon preview
    $(document).on('change', '.feature-icon-input', function() {
        const file = this.files[0];
        const preview = $(this).closest('.form-group').find('.feature-icon-preview');
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.find('img').attr('src', e.target.result);
                preview.show();
            };
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


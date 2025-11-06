@extends('admin.layouts.app')

@section('title', 'Edit Coupon')
@section('page-title', 'Edit Coupon')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.coupons.index') }}">Coupons</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST" id="couponForm">
    @csrf
    @method('PUT')
    
    <div class="row">
        <!-- Basic Information -->
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Coupon Information</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="code">Coupon Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" 
                               id="code" name="code" value="{{ old('code', $coupon->code) }}" 
                               placeholder="e.g., SAVE20" required style="text-transform: uppercase;">
                        <small class="form-text text-muted">Uppercase letters and numbers only</small>
                        @error('code')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Coupon Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $coupon->name) }}" 
                               placeholder="e.g., Summer Sale 2024">
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description', $coupon->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Discount Type <span class="text-danger">*</span></label>
                                <select class="form-control @error('type') is-invalid @enderror" 
                                        id="type" name="type" required>
                                    <option value="percentage" {{ old('type', $coupon->type) == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                    <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="value">Discount Value <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" step="0.01" class="form-control @error('value') is-invalid @enderror" 
                                           id="value" name="value" value="{{ old('value', $coupon->value) }}" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="valueSuffix">%</span>
                                    </div>
                                </div>
                                <small class="form-text text-muted" id="valueHelp">Enter discount percentage (max 100%)</small>
                                @error('value')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="minimum_purchase">Minimum Purchase Amount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ $settings->currency_symbol ?? '$' }}</span>
                                    </div>
                                    <input type="number" step="0.01" class="form-control @error('minimum_purchase') is-invalid @enderror" 
                                           id="minimum_purchase" name="minimum_purchase" value="{{ old('minimum_purchase', $coupon->minimum_purchase) }}">
                                </div>
                                <small class="form-text text-muted">Leave empty for no minimum</small>
                                @error('minimum_purchase')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="maxDiscountGroup">
                                <label for="maximum_discount">Maximum Discount Amount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{ $settings->currency_symbol ?? '$' }}</span>
                                    </div>
                                    <input type="number" step="0.01" class="form-control @error('maximum_discount') is-invalid @enderror" 
                                           id="maximum_discount" name="maximum_discount" value="{{ old('maximum_discount', $coupon->maximum_discount) }}">
                                </div>
                                <small class="form-text text-muted">Only for percentage discounts</small>
                                @error('maximum_discount')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">Start Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                       id="start_date" name="start_date" value="{{ old('start_date', $coupon->start_date->format('Y-m-d')) }}" required>
                                @error('start_date')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date">End Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                       id="end_date" name="end_date" value="{{ old('end_date', $coupon->end_date->format('Y-m-d')) }}" required>
                                @error('end_date')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usage_limit">Total Usage Limit</label>
                                <input type="number" class="form-control @error('usage_limit') is-invalid @enderror" 
                                       id="usage_limit" name="usage_limit" value="{{ old('usage_limit', $coupon->usage_limit) }}" min="1">
                                <small class="form-text text-muted">Leave empty for unlimited</small>
                                @error('usage_limit')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usage_limit_per_user">Usage Limit Per User</label>
                                <input type="number" class="form-control @error('usage_limit_per_user') is-invalid @enderror" 
                                       id="usage_limit_per_user" name="usage_limit_per_user" value="{{ old('usage_limit_per_user', $coupon->usage_limit_per_user ?? 1) }}" min="1">
                                <small class="form-text text-muted">How many times one user can use this coupon</small>
                                @error('usage_limit_per_user')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $coupon->is_active) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Applicable To -->
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Applicable To</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="applicable_to">Apply To <span class="text-danger">*</span></label>
                        <select class="form-control @error('applicable_to') is-invalid @enderror" 
                                id="applicable_to" name="applicable_to" required>
                            <option value="all" {{ old('applicable_to', $coupon->applicable_to) == 'all' ? 'selected' : '' }}>All Products</option>
                            <option value="categories" {{ old('applicable_to', $coupon->applicable_to) == 'categories' ? 'selected' : '' }}>Specific Categories</option>
                            <option value="products" {{ old('applicable_to', $coupon->applicable_to) == 'products' ? 'selected' : '' }}>Specific Products</option>
                        </select>
                        @error('applicable_to')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group" id="categoriesGroup" style="display: none;">
                        <label>Select Categories</label>
                        <div style="max-height: 300px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; border-radius: 4px;">
                            @foreach($categories as $category)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" 
                                           id="category_{{ $category->id }}" 
                                           name="category_ids[]" 
                                           value="{{ $category->id }}"
                                           {{ in_array($category->id, old('category_ids', $coupon->category_ids ?? [])) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="category_{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('category_ids')
                            <span class="text-danger"><small>{{ $message }}</small></span>
                        @enderror
                    </div>

                    <div class="form-group" id="productsGroup" style="display: none;">
                        <label>Select Products</label>
                        <div style="max-height: 300px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; border-radius: 4px;">
                            @foreach($products as $product)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" 
                                           id="product_{{ $product->id }}" 
                                           name="product_ids[]" 
                                           value="{{ $product->id }}"
                                           {{ in_array($product->id, old('product_ids', $coupon->product_ids ?? [])) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="product_{{ $product->id }}">
                                        {{ $product->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('product_ids')
                            <span class="text-danger"><small>{{ $message }}</small></span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Coupon</button>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const valueSuffix = document.getElementById('valueSuffix');
        const valueHelp = document.getElementById('valueHelp');
        const maxDiscountGroup = document.getElementById('maxDiscountGroup');
        const applicableTo = document.getElementById('applicable_to');
        const categoriesGroup = document.getElementById('categoriesGroup');
        const productsGroup = document.getElementById('productsGroup');
        const codeInput = document.getElementById('code');

        // Handle discount type change
        typeSelect.addEventListener('change', function() {
            if (this.value === 'percentage') {
                valueSuffix.textContent = '%';
                valueHelp.textContent = 'Enter discount percentage (max 100%)';
                maxDiscountGroup.style.display = 'block';
            } else {
                valueSuffix.textContent = '{{ $settings->currency_symbol ?? '$' }}';
                valueHelp.textContent = 'Enter fixed discount amount';
                maxDiscountGroup.style.display = 'none';
            }
        });

        // Trigger on load
        typeSelect.dispatchEvent(new Event('change'));

        // Handle applicable to change
        applicableTo.addEventListener('change', function() {
            if (this.value === 'categories') {
                categoriesGroup.style.display = 'block';
                productsGroup.style.display = 'none';
            } else if (this.value === 'products') {
                categoriesGroup.style.display = 'none';
                productsGroup.style.display = 'block';
            } else {
                categoriesGroup.style.display = 'none';
                productsGroup.style.display = 'none';
            }
        });

        // Trigger on load
        applicableTo.dispatchEvent(new Event('change'));

        // Uppercase code input
        codeInput.addEventListener('input', function() {
            this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
        });
    });
</script>
@endpush
@endsection


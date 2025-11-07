@extends('admin.layouts.app')

@section('title', 'Products')
@section('page-title', 'Products')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Products</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Products List</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Product
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Bulk Actions Bar -->
                <div id="bulk-actions-bar" class="mb-3" style="display: none;">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="mr-2"><strong id="selected-count">0</strong> product(s) selected</span>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-danger" id="bulk-delete-btn">
                                <i class="fas fa-trash"></i> Delete Selected
                            </button>
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary" id="clear-selection-btn">
                            <i class="fas fa-times"></i> Clear Selection
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="50">
                                    <input type="checkbox" id="select-all" title="Select All">
                                </th>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Price</th>
                                <th>Compare Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td>
                                    <input type="checkbox" class="product-checkbox" value="{{ $product->id }}">
                                </td>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if($product->featured_image)
                                        <img src="{{ asset('storage/' . $product->featured_image) }}" alt="{{ $product->name }}" style="max-width: 50px; max-height: 50px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td>{{ $product->brand->name ?? 'N/A' }}</td>
                                <td>{{ $settings->currency_symbol ?? '$' }}{{ number_format($product->price, 2) }}</td>
                                <td>
                                    @if($product->compare_at_price)
                                        <span class="text-muted text-decoration-line-through">{{ $settings->currency_symbol ?? '$' }}{{ number_format($product->compare_at_price, 2) }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    @if($product->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                    @if($product->is_featured)
                                        <span class="badge badge-info">Featured</span>
                                    @endif
                                    @if($product->is_best_deal)
                                        <span class="badge badge-warning">Best Deal</span>
                                    @endif
                                    @if($product->is_hot_product)
                                        <span class="badge badge-danger">Hot</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.products.duplicate', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-secondary" title="Duplicate">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-info" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="12" class="text-center">No products found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @if($products->hasPages())
                    {{ $products->links() }}
                @else
                    <div class="text-muted text-center py-2">
                        Showing all {{ $products->count() }} product(s)
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Select All checkbox
    $('#select-all').on('change', function() {
        $('.product-checkbox').prop('checked', this.checked);
        updateBulkActionsBar();
    });

    // Individual checkbox change
    $(document).on('change', '.product-checkbox', function() {
        updateSelectAllState();
        updateBulkActionsBar();
    });

    // Update select all checkbox state
    function updateSelectAllState() {
        const total = $('.product-checkbox').length;
        const checked = $('.product-checkbox:checked').length;
        $('#select-all').prop('checked', total > 0 && total === checked);
    }

    // Update bulk actions bar visibility
    function updateBulkActionsBar() {
        const selected = $('.product-checkbox:checked').length;
        if (selected > 0) {
            $('#bulk-actions-bar').show();
            $('#selected-count').text(selected);
        } else {
            $('#bulk-actions-bar').hide();
        }
    }

    // Clear selection
    $('#clear-selection-btn').on('click', function() {
        $('.product-checkbox').prop('checked', false);
        $('#select-all').prop('checked', false);
        updateBulkActionsBar();
    });

    // Bulk Delete
    $('#bulk-delete-btn').on('click', function() {
        const selected = getSelectedIds();
        if (selected.length === 0) {
            alert('Please select at least one product.');
            return;
        }
        
        if (!confirm(`Are you sure you want to delete ${selected.length} product(s)? This action cannot be undone.`)) {
            return;
        }

        // Create form and submit
        const form = $('<form>', {
            'method': 'POST',
            'action': '{{ route("admin.products.bulk-delete") }}'
        });
        form.append('<input type="hidden" name="_token" value="{{ csrf_token() }}">');
        form.append('<input type="hidden" name="_method" value="DELETE">');
        
        selected.forEach(function(id) {
            form.append(`<input type="hidden" name="product_ids[]" value="${id}">`);
        });

        $('body').append(form);
        form.submit();
    });

    // Get selected product IDs
    function getSelectedIds() {
        const ids = [];
        $('.product-checkbox:checked').each(function() {
            ids.push($(this).val());
        });
        return ids;
    }
});
</script>
@endpush
@endsection


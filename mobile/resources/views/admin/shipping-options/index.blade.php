@php
    $settings = \App\Models\Setting::getSettings();
@endphp
@extends('admin.layouts.app')

@section('title', 'Shipping Options')
@section('page-title', 'Shipping Options Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Shipping Options</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Shipping Options</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addShippingOptionModal">
                        <i class="fas fa-plus"></i> Add New Shipping Option
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50">Order</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Cost</th>
                                <th>Status</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($shippingOptions as $option)
                                <tr>
                                    <td>{{ $option->order }}</td>
                                    <td><strong>{{ $option->name }}</strong></td>
                                    <td>{{ $option->description ?? '-' }}</td>
                                    <td>{{ $settings->currency_symbol ?? '$' }}{{ number_format($option->cost, 2) }}</td>
                                    <td>
                                        @if($option->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" 
                                                data-toggle="modal" 
                                                data-target="#editShippingOptionModal{{ $option->id }}"
                                                onclick="populateEditForm({{ $option->id }}, '{{ $option->name }}', '{{ $option->description }}', {{ $option->cost }}, {{ $option->order }}, {{ $option->is_active ? 'true' : 'false' }})">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form action="{{ route('admin.shipping-options.destroy', $option) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this shipping option?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                
                                <!-- Edit Modal -->
                                <div class="modal fade" id="editShippingOptionModal{{ $option->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.shipping-options.update', $option) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Shipping Option</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="edit_name_{{ $option->id }}">Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="edit_name_{{ $option->id }}" 
                                                               name="name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_description_{{ $option->id }}">Description</label>
                                                        <input type="text" class="form-control" id="edit_description_{{ $option->id }}" 
                                                               name="description" placeholder="e.g., 2-4 days, free shipping">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="edit_cost_{{ $option->id }}">Cost <span class="text-danger">*</span></label>
                                                                <input type="number" step="0.01" min="0" class="form-control" 
                                                                       id="edit_cost_{{ $option->id }}" name="cost" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="edit_order_{{ $option->id }}">Display Order</label>
                                                                <input type="number" min="0" class="form-control" 
                                                                       id="edit_order_{{ $option->id }}" name="order" value="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" 
                                                                   id="edit_is_active_{{ $option->id }}" name="is_active" value="1">
                                                            <label class="form-check-label" for="edit_is_active_{{ $option->id }}">
                                                                Active
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No shipping options found. Add your first shipping option above.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addShippingOptionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.shipping-options.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Shipping Option</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" required 
                               placeholder="e.g., Courier, Local Shipping, UPS Ground Shipping">
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" 
                               id="description" name="description" 
                               placeholder="e.g., 2-4 days, free shipping">
                        @error('description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cost">Cost <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" class="form-control @error('cost') is-invalid @enderror" 
                                       id="cost" name="cost" required value="0">
                                @error('cost')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="order">Display Order</label>
                                <input type="number" min="0" class="form-control @error('order') is-invalid @enderror" 
                                       id="order" name="order" value="0">
                                @error('order')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function populateEditForm(id, name, description, cost, order, isActive) {
    document.getElementById('edit_name_' + id).value = name;
    document.getElementById('edit_description_' + id).value = description || '';
    document.getElementById('edit_cost_' + id).value = cost;
    document.getElementById('edit_order_' + id).value = order;
    document.getElementById('edit_is_active_' + id).checked = isActive;
}
</script>
@endpush
@endsection


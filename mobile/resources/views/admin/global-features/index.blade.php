@php
    $settings = \App\Models\Setting::getSettings();
@endphp
@extends('admin.layouts.app')

@section('title', 'Global Features')
@section('page-title', 'Global Features Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Global Features</li>
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
                <h3 class="card-title">Global Features</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addGlobalFeatureModal">
                        <i class="fas fa-plus"></i> Add New Feature
                    </button>
                </div>
            </div>
            <div class="card-body">
                <p class="text-muted mb-3">
                    <small>These features will be displayed on product detail pages when a product doesn't have its own specific features.</small>
                </p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="50">Order</th>
                                <th width="80">Icon</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($globalFeatures as $feature)
                                <tr>
                                    <td>{{ $feature->order }}</td>
                                    <td>
                                        <i class="{{ $feature->icon }} fs-5 text-primary"></i>
                                    </td>
                                    <td><strong>{{ $feature->title }}</strong></td>
                                    <td>
                                        @if($feature->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" 
                                                data-toggle="modal" 
                                                data-target="#editGlobalFeatureModal{{ $feature->id }}"
                                                onclick="populateEditForm({{ $feature->id }}, '{{ addslashes($feature->icon) }}', '{{ addslashes($feature->title) }}', {{ $feature->order }}, {{ $feature->is_active ? 'true' : 'false' }})">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form action="{{ route('admin.global-features.destroy', $feature) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this feature?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                
                                <!-- Edit Modal -->
                                <div class="modal fade" id="editGlobalFeatureModal{{ $feature->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.global-features.update', $feature) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Global Feature</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="edit_icon_{{ $feature->id }}">Icon Class <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="edit_icon_{{ $feature->id }}" 
                                                               name="icon" required placeholder="e.g., bi-award, bi-truck, bi-shield-check">
                                                        <small class="form-text text-muted">Use Bootstrap Icons classes (e.g., bi-award, bi-truck)</small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_title_{{ $feature->id }}">Title <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="edit_title_{{ $feature->id }}" 
                                                               name="title" required placeholder="e.g., Free 1 Year Warranty">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit_order_{{ $feature->id }}">Display Order</label>
                                                        <input type="number" min="0" class="form-control" 
                                                               id="edit_order_{{ $feature->id }}" name="order" value="0">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" 
                                                                   id="edit_is_active_{{ $feature->id }}" name="is_active" value="1">
                                                            <label class="form-check-label" for="edit_is_active_{{ $feature->id }}">
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
                                    <td colspan="5" class="text-center">No global features found. Add your first feature above.</td>
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
<div class="modal fade" id="addGlobalFeatureModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.global-features.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Global Feature</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="icon">Icon Class <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                               id="icon" name="icon" required 
                               placeholder="e.g., bi-award, bi-truck, bi-shield-check">
                        <small class="form-text text-muted">Use Bootstrap Icons classes (e.g., bi-award, bi-truck, bi-shield-check, bi-headset, bi-lock)</small>
                        @error('icon')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" required 
                               placeholder="e.g., Free 1 Year Warranty">
                        @error('title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="order">Display Order</label>
                        <input type="number" min="0" class="form-control @error('order') is-invalid @enderror" 
                               id="order" name="order" value="0">
                        @error('order')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
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
function populateEditForm(id, icon, title, order, isActive) {
    document.getElementById('edit_icon_' + id).value = icon;
    document.getElementById('edit_title_' + id).value = title;
    document.getElementById('edit_order_' + id).value = order;
    document.getElementById('edit_is_active_' + id).checked = isActive;
}
</script>
@endpush
@endsection


@extends('admin.layouts.app')

@section('title', 'Create Device Type')
@section('page-title', 'Create Device Type')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.repair-device-types.index') }}">Device Types</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <form action="{{ route('admin.repair-device-types.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Device Type Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="repair_service_id">Repair Service <span class="text-danger">*</span></label>
                            <select class="form-control @error('repair_service_id') is-invalid @enderror"
                                id="repair_service_id" name="repair_service_id" required>
                                <option value="">Select Service</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('repair_service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('repair_service_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Device Type Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="repair_brand_id">Brand</label>
                            <select class="form-control @error('repair_brand_id') is-invalid @enderror" id="repair_brand_id"
                                name="repair_brand_id">
                                <option value="">Select Brand (Optional)</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('repair_brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('repair_brand_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                            <small class="form-text text-muted">Select a brand from the list or leave empty</small>
                        </div>

                        <div class="form-group">
                            <label for="order">Display Order</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" id="order"
                                name="order" value="{{ old('order', 0) }}" min="0">
                            @error('order')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                            <small class="form-text text-muted">Lower numbers appear first</small>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                                    value="1" checked>
                                <label class="custom-control-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Featured Image</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="featured_image">Device Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file"
                                        class="custom-file-input @error('featured_image') is-invalid @enderror"
                                        id="featured_image" name="featured_image" accept="image/*">
                                    <label class="custom-file-label" for="featured_image">Choose file</label>
                                </div>
                            </div>
                            @error('featured_image')
                                <span class="text-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                            <small class="form-text text-muted">Upload a device image (e.g., phone photo). If set, it will
                                be displayed as a featured card on the frontend. Max: 4MB</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Create Device Type</button>
                    <a href="{{ route('admin.repair-device-types.index') }}" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const fileInput = document.getElementById('featured_image');
                if (fileInput) {
                    fileInput.addEventListener('change', function (e) {
                        const fileName = e.target.files[0]?.name || 'Choose file';
                        const label = e.target.nextElementSibling;
                        label.textContent = fileName;
                    });
                }
            });
        </script>
    @endpush
@endsection
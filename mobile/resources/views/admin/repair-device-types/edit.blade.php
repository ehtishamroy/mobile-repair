@extends('admin.layouts.app')

@section('title', 'Edit Device Type')
@section('page-title', 'Edit Device Type')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.repair-device-types.index') }}">Device Types</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
@php
    $serviceIdValue = old('repair_service_id', $deviceType->repair_service_id ?? '');
    $nameValue = old('name', $deviceType->name ?? '');
    $brandValue = old('brand', $deviceType->brand ?? '');
    $orderValue = old('order', $deviceType->order ?? 0);
    $isActive = old('is_active', $deviceType->is_active ?? false);
@endphp
<form action="{{ route('admin.repair-device-types.update', $deviceType->id) }}" method="POST">
    @csrf
    @method('PUT')
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
                                <option value="{{ $service->id }}" {{ $serviceIdValue == $service->id ? 'selected' : '' }}>
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
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ $nameValue }}" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <input type="text" class="form-control @error('brand') is-invalid @enderror" 
                               id="brand" name="brand" value="{{ $brandValue }}">
                        @error('brand')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="order">Display Order</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror" 
                               id="order" name="order" value="{{ $orderValue }}" min="0">
                        @error('order')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <small class="form-text text-muted">Lower numbers appear first</small>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" @if($isActive) checked @endif>
                            <label class="custom-control-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Device Type</button>
                <a href="{{ route('admin.repair-device-types.index') }}" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </div>
</form>
@endsection


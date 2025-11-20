@extends('admin.layouts.app')

@section('title', 'Edit Repair Issue')
@section('page-title', 'Edit Repair Issue')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.repair-issues.index') }}">Repair Issues</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
@php
    $serviceIdValue = old('repair_service_id', $issue->repair_service_id ?? '');
    $nameValue = old('name', $issue->name ?? '');
    $orderValue = old('order', $issue->order ?? 0);
    $isActive = old('is_active', $issue->is_active ?? false);
@endphp
<form action="{{ route('admin.repair-issues.update', $issue->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Issue Information</h3>
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
                        <label for="name">Issue Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ $nameValue }}" required>
                        @error('name')
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
                <button type="submit" class="btn btn-primary">Update Issue</button>
                <a href="{{ route('admin.repair-issues.index') }}" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </div>
</form>
@endsection


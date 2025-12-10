@extends('admin.layouts.app')

@section('title', isset($repairQualityTier) ? 'Edit Quality Tier' : 'Create Quality Tier')

@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin-panel/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-panel/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ isset($repairQualityTier) ? 'Edit Quality Tier' : 'Create Quality Tier' }}
            </h1>
            <a href="{{ route('admin.repair-quality-tiers.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form
                    action="{{ isset($repairQualityTier) ? route('admin.repair-quality-tiers.update', $repairQualityTier->id) : route('admin.repair-quality-tiers.store') }}"
                    method="POST">
                    @csrf
                    @if(isset($repairQualityTier))
                        @method('PUT')
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Tier Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $repairQualityTier->name ?? '') }}" required>
                            <small class="text-muted">e.g., "Standard Screen", "OEM Screen", "Premium Screen"</small>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price_modifier" class="form-label">Price Modifier (£) <span
                                    class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0"
                                class="form-control @error('price_modifier') is-invalid @enderror" id="price_modifier"
                                name="price_modifier"
                                value="{{ old('price_modifier', $repairQualityTier->price_modifier ?? '0.00') }}" required>
                            <small class="text-muted">Additional cost on top of base price</small>
                            @error('price_modifier')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="repair_issue_id" class="form-label">Repair Issue <span
                                    class="text-muted font-weight-light">(Optional)</span></label>
                            <select class="form-control select2 @error('repair_issue_id') is-invalid @enderror"
                                id="repair_issue_id" name="repair_issue_id" style="width: 100%;">
                                <option value="">All Issues</option>
                                @foreach($issues as $issue)
                                    <option value="{{ $issue->id }}" {{ (old('repair_issue_id', $repairQualityTier->repair_issue_id ?? '') == $issue->id) ? 'selected' : '' }}>
                                        {{ $issue->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Leave empty to apply to all issues</small>
                            @error('repair_issue_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="repair_device_type_id" class="form-label">Device Type <span
                                    class="text-muted font-weight-light">(Optional)</span></label>
                            <select class="form-control select2 @error('repair_device_type_id') is-invalid @enderror"
                                id="repair_device_type_id" name="repair_device_type_id" style="width: 100%;">
                                <option value="">All Device Types</option>
                                @foreach($deviceTypes as $deviceType)
                                    <option value="{{ $deviceType->id }}" {{ (old('repair_device_type_id', $repairQualityTier->repair_device_type_id ?? '') == $deviceType->id) ? 'selected' : '' }}>
                                        {{ $deviceType->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Leave empty to apply to all device types</small>
                            @error('repair_device_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description"
                                rows="3">{{ old('description', $repairQualityTier->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="order" class="form-label">Display Order</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" id="order"
                                name="order" value="{{ old('order', $repairQualityTier->order ?? 0) }}">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="is_default" name="is_default" value="1"
                                    {{ old('is_default', $repairQualityTier->is_default ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_default">
                                    Default Selection
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $repairQualityTier->is_active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Quality Tier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Select2 -->
    <script src="{{ asset('admin-panel/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: function () {
                    $(this).data('placeholder');
                },
                allowClear: true
            });
        });
    </script>
@endpush
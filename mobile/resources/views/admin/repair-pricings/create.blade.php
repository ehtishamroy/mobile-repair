@extends('admin.layouts.app')

@section('title', 'Create Repair Pricing')
@section('page-title', 'Create Repair Pricing')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.repair-pricings.index') }}">Repair Pricing</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<form action="{{ route('admin.repair-pricings.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Pricing Information</h3>
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
                        <label for="repair_device_type_id">Device Type</label>
                        <select class="form-control @error('repair_device_type_id') is-invalid @enderror" 
                                id="repair_device_type_id" name="repair_device_type_id">
                            <option value="">Select Device Type (Optional)</option>
                            @foreach($deviceTypes as $deviceType)
                                <option value="{{ $deviceType->id }}" {{ old('repair_device_type_id') == $deviceType->id ? 'selected' : '' }}>
                                    {{ $deviceType->name }} ({{ $deviceType->service->name ?? '' }})
                                </option>
                            @endforeach
                        </select>
                        @error('repair_device_type_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <small class="form-text text-muted">Leave empty for general pricing</small>
                    </div>

                    <div class="form-group">
                        <label for="repair_issue_id">Issue</label>
                        <select class="form-control @error('repair_issue_id') is-invalid @enderror" 
                                id="repair_issue_id" name="repair_issue_id">
                            <option value="">Select Issue (Optional)</option>
                            @foreach($issues as $issue)
                                <option value="{{ $issue->id }}" {{ old('repair_issue_id') == $issue->id ? 'selected' : '' }}>
                                    {{ $issue->name }} ({{ $issue->service->name ?? '' }})
                                </option>
                            @endforeach
                        </select>
                        @error('repair_issue_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        <small class="form-text text-muted">Leave empty for inspection fee</small>
                    </div>

                    <div class="form-group">
                        <label for="price">Price <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">£</span>
                            </div>
                            <input type="number" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price') }}" required>
                        </div>
                        @error('price')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_inspection_fee" name="is_inspection_fee" value="1" {{ old('is_inspection_fee') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_inspection_fee">Is Inspection Fee</label>
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
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Create Pricing</button>
                <a href="{{ route('admin.repair-pricings.index') }}" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const serviceSelect = document.getElementById('repair_service_id');
        const deviceTypeSelect = document.getElementById('repair_device_type_id');
        const issueSelect = document.getElementById('repair_issue_id');

        if (serviceSelect) {
            serviceSelect.addEventListener('change', function() {
                const serviceId = this.value;
                if (serviceId) {
                    // Fetch device types for this service
                    fetch(`/admin/repair-pricings/get-device-types?service_id=${serviceId}`)
                        .then(response => response.json())
                        .then(data => {
                            deviceTypeSelect.innerHTML = '<option value="">Select Device Type (Optional)</option>';
                            data.forEach(deviceType => {
                                const option = document.createElement('option');
                                option.value = deviceType.id;
                                option.textContent = deviceType.name;
                                deviceTypeSelect.appendChild(option);
                            });
                        });

                    // Fetch issues for this service
                    fetch(`/admin/repair-pricings/get-issues?service_id=${serviceId}`)
                        .then(response => response.json())
                        .then(data => {
                            issueSelect.innerHTML = '<option value="">Select Issue (Optional)</option>';
                            data.forEach(issue => {
                                const option = document.createElement('option');
                                option.value = issue.id;
                                option.textContent = issue.name;
                                issueSelect.appendChild(option);
                            });
                        });
                } else {
                    deviceTypeSelect.innerHTML = '<option value="">Select Device Type (Optional)</option>';
                    issueSelect.innerHTML = '<option value="">Select Issue (Optional)</option>';
                }
            });
        }
    });
</script>
@endpush
@endsection


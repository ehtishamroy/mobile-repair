@extends('admin.layouts.app')

@section('title', 'Device Issue Availability')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Device Issue Availability Management</h4>

                <!-- Service Filter -->
                <form method="GET" action="{{ route('admin.repair-device-issues.index') }}" class="form-inline">
                    <label for="service_id" class="mr-2">Service:</label>
                    <select name="service_id" id="service_id" class="form-control" onchange="this.form.submit()">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ $serviceId == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="card-body">
                @if($devices->count() > 0 && $issues->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th style="min-width: 150px;">Device / Issue</th>
                                    @foreach($issues as $issue)
                                        <th class="text-center" style="min-width: 120px;">{{ $issue->name }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($devices as $device)
                                    <tr>
                                        <td class="font-weight-bold">{{ $device->name }}</td>
                                        @foreach($issues as $issue)
                                            @php
                                                $key = $device->id . '_' . $issue->id;
                                                $availability = $availabilityMatrix[$key] ?? null;

                                                if (!$availability) {
                                                    $icon = '➕';
                                                    $iconClass = 'text-secondary';
                                                    $statusText = 'Not configured';
                                                    $cellClass = 'bg-light';
                                                } elseif (!$availability->is_available) {
                                                    $icon = '❌';
                                                    $iconClass = 'text-danger';
                                                    $statusText = 'Not available';
                                                    $cellClass = 'bg-danger-light';
                                                } elseif ($availability->requires_quality_tier) {
                                                    $icon = '✅';
                                                    $iconClass = 'text-success';
                                                    $statusText = 'Tiers required';
                                                    $cellClass = 'bg-success-light';
                                                } else {
                                                    $icon = '🔧';
                                                    $iconClass = 'text-primary';
                                                    $statusText = '£' . number_format($availability->base_price, 2);
                                                    $cellClass = 'bg-info-light';
                                                }
                                            @endphp
                                            <td class="text-center {{ $cellClass }}" style="cursor: pointer; padding: 15px;"
                                                onclick="openSettingsModal({{ $device->id }}, {{ $issue->id }}, '{{ $device->name }}', '{{ $issue->name }}')">
                                                <div>
                                                    <span style="font-size: 24px;">{{ $icon }}</span>
                                                </div>
                                                <small class="{{ $iconClass }}">{{ $statusText }}</small>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <h6>Legend:</h6>
                        <ul class="list-unstyled">
                            <li><span style="font-size: 20px;">➕</span> Not configured (defaults apply)</li>
                            <li><span style="font-size: 20px;">✅</span> Available - Requires quality tier selection</li>
                            <li><span style="font-size: 20px;">🔧</span> Available - No tier needed (base price shown)</li>
                            <li><span style="font-size: 20px;">❌</span> Not available (out of stock/hidden)</li>
                        </ul>
                    </div>
                @else
                    <div class="alert alert-warning">
                        No devices or issues found for this service. Please add devices and issues first.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Settings Modal -->
    <div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="settingsModalLabel">Configure Availability</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Device:</label>
                        <p id="modal-device-name" class="text-muted"></p>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Issue:</label>
                        <p id="modal-issue-name" class="text-muted"></p>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label class="font-weight-bold">Availability</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_available" checked>
                            <label class="custom-control-label" for="is_available">
                                <span id="availability-label">Available</span>
                            </label>
                        </div>
                        <small class="text-muted">If disabled, this issue will not be shown for this device.</small>
                    </div>

                    <div class="form-group" id="tier-requirement-group">
                        <label class="font-weight-bold">Requires Quality Tier Selection</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="requires_quality_tier">
                            <label class="custom-control-label" for="requires_quality_tier">
                                <span id="tier-label">No</span>
                            </label>
                        </div>
                        <small class="text-muted">Enable if users should choose between quality tiers (e.g., OEM vs Standard
                            screen).</small>
                    </div>

                    <div class="form-group" id="base-price-group" style="display: none;">
                        <label class="font-weight-bold" for="base_price">Base Price (£) <span
                                class="text-muted">(Optional)</span></label>
                        <input type="number" class="form-control" id="base_price" step="0.01" min="0"
                            placeholder="Leave empty to use price from Repair Pricing">
                        <small class="text-muted">If left empty, the system will automatically use the price from your
                            Repair Pricing table.</small>
                    </div>

                    <input type="hidden" id="modal-device-id">
                    <input type="hidden" id="modal-issue-id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="saveSettings()">Save Settings</button>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .bg-success-light {
                background-color: #d4edda !important;
            }

            .bg-danger-light {
                background-color: #f8d7da !important;
            }

            .bg-info-light {
                background-color: #d1ecf1 !important;
            }

            table td {
                vertical-align: middle;
            }

            table td:hover {
                opacity: 0.8;
                transition: opacity 0.2s;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            function openSettingsModal(deviceId, issueId, deviceName, issueName) {
                // Set context
                $('#modal-device-id').val(deviceId);
                $('#modal-issue-id').val(issueId);
                $('#modal-device-name').text(deviceName);
                $('#modal-issue-name').text(issueName);

                // Load current settings
                $.ajax({
                    url: '{{ route('admin.repair-device-issues.get-settings') }}',
                    method: 'GET',
                    data: {
                        device_type_id: deviceId,
                        issue_id: issueId
                    },
                    success: function (response) {
                        // Set availability
                        $('#is_available').prop('checked', response.is_available);
                        updateAvailabilityLabel();

                        // Set requires_quality_tier
                        $('#requires_quality_tier').prop('checked', response.requires_quality_tier);
                        updateTierLabel();

                        // Set base_price
                        if (response.base_price) {
                            $('#base_price').val(parseFloat(response.base_price).toFixed(2));
                        } else {
                            $('#base_price').val('');
                        }

                        // Show/hide base price field
                        toggleBasePriceField();

                        // Show modal
                        $('#settingsModal').modal('show');
                    },
                    error: function () {
                        alert('Error loading settings');
                    }
                });
            }

            function saveSettings() {
                const deviceId = $('#modal-device-id').val();
                const issueId = $('#modal-issue-id').val();
                const isAvailable = $('#is_available').is(':checked');
                const requiresQualityTier = $('#requires_quality_tier').is(':checked');
                const basePrice = $('#base_price').val();

                // No validation needed - base price is optional, will use repair_pricings if empty

                $.ajax({
                    url: '{{ route('admin.repair-device-issues.update-settings') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        device_type_id: deviceId,
                        issue_id: issueId,
                        is_available: isAvailable ? 1 : 0,
                        requires_quality_tier: requiresQualityTier ? 1 : 0,
                        base_price: basePrice || null
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#settingsModal').modal('hide');
                            location.reload(); // Reload to show updated matrix
                        } else {
                            alert(response.message || 'Error saving settings');
                        }
                    },
                    error: function (xhr) {
                        const error = xhr.responseJSON?.message || 'Error saving settings';
                        alert(error);
                    }
                });
            }

            function updateAvailabilityLabel() {
                const isAvailable = $('#is_available').is(':checked');
                $('#availability-label').text(isAvailable ? 'Available' : 'Not Available');

                // Show/hide tier requirement section
                if (isAvailable) {
                    $('#tier-requirement-group').show();
                } else {
                    $('#tier-requirement-group').hide();
                    $('#base-price-group').hide();
                }
            }

            function updateTierLabel() {
                const requiresTier = $('#requires_quality_tier').is(':checked');
                $('#tier-label').text(requiresTier ? 'Yes' : 'No');
                toggleBasePriceField();
            }

            function toggleBasePriceField() {
                const isAvailable = $('#is_available').is(':checked');
                const requiresTier = $('#requires_quality_tier').is(':checked');

                if (isAvailable && !requiresTier) {
                    $('#base-price-group').show();
                    $('#base_price').prop('required', true);
                } else {
                    $('#base-price-group').hide();
                    $('#base_price').prop('required', false);
                }
            }

            $(document).ready(function () {
                // Event listeners for switches
                $('#is_available').on('change', updateAvailabilityLabel);
                $('#requires_quality_tier').on('change', updateTierLabel);
            });
        </script>
    @endpush
@endsection
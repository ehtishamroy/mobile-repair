@extends('admin.layouts.app')

@section('title', 'Repair Order Details')
@section('page-title', 'Repair Order Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.repair-orders.index') }}">Repair Orders</a></li>
    <li class="breadcrumb-item active">{{ $repairOrder->order_number }}</li>
@endsection

@section('content')
    <div class="row">
        <!-- Order Information -->
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Booking Information</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Order Number:</strong> {{ $repairOrder->order_number }}<br>
                            <strong>Booking Date:</strong> {{ $repairOrder->created_at->format('M d, Y h:i A') }}<br>
                            <strong>Status:</strong>
                            @if($repairOrder->status === 'paid')
                                <span class="badge badge-success">Paid</span>
                            @elseif($repairOrder->status === 'processing')
                                <span class="badge badge-info">Processing</span>
                            @elseif($repairOrder->status === 'completed')
                                <span class="badge badge-success">Completed</span>
                            @elseif($repairOrder->status === 'cancelled')
                                <span class="badge badge-danger">Cancelled</span>
                            @else
                                <span class="badge badge-warning">{{ ucfirst($repairOrder->status) }}</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <strong>Customer Name:</strong> {{ $repairOrder->customer_name }}<br>
                            <strong>Email:</strong> {{ $repairOrder->customer_email }}<br>
                            <strong>Phone:</strong> {{ $repairOrder->customer_phone ?? 'N/A' }}<br>
                            <strong>Delivery Method:</strong>
                            @if($repairOrder->delivery_method === 'visit')
                                <span class="badge badge-info">Visit Us</span>
                            @elseif($repairOrder->delivery_method === 'online')
                                <span class="badge badge-primary">Online Delivery</span>
                            @else
                                <span class="badge badge-secondary">N/A</span>
                            @endif
                            <br>
                            @if($repairOrder->delivery_method === 'visit' && $repairOrder->appointment_date && $repairOrder->appointment_time)
                                <strong>Appointment:</strong>
                                <span class="text-success">
                                    <i class="fas fa-calendar-check"></i>
                                    {{ \Carbon\Carbon::parse($repairOrder->appointment_date)->format('M d, Y') }}
                                    at
                                    @if($repairOrder->appointment_time == '09:00:00')
                                        9-12 PM
                                    @elseif($repairOrder->appointment_time == '12:00:00')
                                        12-3 PM
                                    @elseif($repairOrder->appointment_time == '15:00:00')
                                        3-6 PM
                                    @else
                                        {{ $repairOrder->appointment_time }}
                                    @endif
                                </span>
                                <br>
                            @endif
                            <strong>Payment Method:</strong>
                            @if(empty($repairOrder->payment_method))
                                @if($repairOrder->delivery_method === 'visit')
                                    <span class="badge badge-success">Card</span>
                                @else
                                    <span class="badge badge-secondary">Not Selected</span>
                                @endif
                            @else
                                @if($repairOrder->payment_method === 'stripe')
                                    <span class="badge badge-success">Card</span>
                                @elseif($repairOrder->payment_method === 'paypal')
                                    <span class="badge badge-primary">PayPal</span>
                                @else
                                    <span class="badge badge-secondary">{{ ucfirst($repairOrder->payment_method) }}</span>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service Details -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Service Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Service:</strong> {{ $repairOrder->service->name ?? 'N/A' }}<br>
                            <strong>Device Type:</strong> {{ $repairOrder->deviceType->name ?? 'N/A' }}<br>
                            <strong>Device Model:</strong> {{ $repairOrder->device_model }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Selected Issues -->
            @if($issues && count($issues) > 0)
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Selected Issues</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($issues as $issue)
                                <li class="list-group-item">{{ $issue->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @else
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Issue Information</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Inspection Required - Customer selected "I don't know the issue"</p>
                    </div>
                </div>
            @endif

            @if($repairOrder->issue_description)
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Issue Description</h3>
                    </div>
                    <div class="card-body">
                        <p>{{ $repairOrder->issue_description }}</p>
                    </div>
                </div>
            @endif

            <!-- Shipping Address / Visit Information -->
            @if($repairOrder->delivery_method === 'online' && $repairOrder->address)
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Shipping Address</h3>
                    </div>
                    <div class="card-body">
                        <p style="white-space: pre-line;">{{ $repairOrder->address }}</p>
                    </div>
                </div>
            @elseif($repairOrder->delivery_method === 'visit')
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Visit Information</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-info">
                            <i class="fas fa-store"></i> Customer will visit the store to drop off their device.
                        </p>
                        @if($repairOrder->appointment_date && $repairOrder->appointment_time)
                            <div class="alert alert-success mt-3">
                                <h5><i class="fas fa-calendar-check"></i> Scheduled Appointment</h5>
                                <p class="mb-1"><strong>Date:</strong>
                                    {{ \Carbon\Carbon::parse($repairOrder->appointment_date)->format('l, F d, Y') }}</p>
                                <p class="mb-0"><strong>Time Slot:</strong>
                                    @if($repairOrder->appointment_time == '09:00:00')
                                        9:00 AM - 12:00 PM
                                    @elseif($repairOrder->appointment_time == '12:00:00')
                                        12:00 PM - 3:00 PM
                                    @elseif($repairOrder->appointment_time == '15:00:00')
                                        3:00 PM - 6:00 PM
                                    @else
                                        {{ $repairOrder->appointment_time }}
                                    @endif
                                </p>
                            </div>
                        @endif
                        @if($repairOrder->address)
                            <p><strong>Optional Address:</strong></p>
                            <p style="white-space: pre-line;">{{ $repairOrder->address }}</p>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Order Summary -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Order Summary</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            @if($repairOrder->subtotal > 0)
                                <tr>
                                    <td><strong>Repair Cost:</strong></td>
                                    <td class="text-right">£{{ number_format($repairOrder->subtotal, 2) }}</td>
                                </tr>
                            @endif
                            @if($repairOrder->inspection_fee > 0)
                                <tr>
                                    <td><strong>Inspection Fee:</strong></td>
                                    <td class="text-right">£{{ number_format($repairOrder->inspection_fee, 2) }}</td>
                                </tr>
                            @endif
                            <tr class="table-primary">
                                <td><strong>Total Amount:</strong></td>
                                <td class="text-right"><strong>£{{ number_format($repairOrder->total, 2) }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Order Actions -->
        <div class="col-md-4">
            <!-- Update Order Status -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Booking Status</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.repair-orders.update', $repairOrder->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="pending" {{ $repairOrder->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="paid" {{ $repairOrder->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="processing" {{ $repairOrder->status == 'processing' ? 'selected' : '' }}>
                                    Processing</option>
                                <option value="completed" {{ $repairOrder->status == 'completed' ? 'selected' : '' }}>
                                    Completed</option>
                                <option value="cancelled" {{ $repairOrder->status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Update Status</button>
                    </form>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Payment Information</h3>
                </div>
                <div class="card-body">
                    <p><strong>Delivery Method:</strong>
                        @if($repairOrder->delivery_method === 'visit')
                            <span class="badge badge-info">Visit Us</span>
                        @elseif($repairOrder->delivery_method === 'online')
                            <span class="badge badge-primary">Online Delivery</span>
                        @else
                            <span class="badge badge-secondary">N/A</span>
                        @endif
                    </p>
                    <p><strong>Payment Method:</strong>
                        @if(empty($repairOrder->payment_method))
                            @if($repairOrder->delivery_method === 'visit')
                                <span class="badge badge-success">Card</span>
                            @else
                                <span class="badge badge-secondary">Not Selected</span>
                            @endif
                        @else
                            @if($repairOrder->payment_method === 'stripe')
                                <span class="badge badge-success">Card</span>
                            @elseif($repairOrder->payment_method === 'paypal')
                                <span class="badge badge-primary">PayPal</span>
                            @else
                                <span class="badge badge-secondary">{{ ucfirst($repairOrder->payment_method) }}</span>
                            @endif
                        @endif
                    </p>
                    @if($repairOrder->payment_intent_id)
                        <p><strong>Payment Intent ID:</strong> <small
                                class="text-muted">{{ $repairOrder->payment_intent_id }}</small></p>
                    @endif
                    @if($repairOrder->paypal_order_id)
                        <p><strong>PayPal Order ID:</strong> <small
                                class="text-muted">{{ $repairOrder->paypal_order_id }}</small></p>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Quick Actions</h3>
                </div>
                <div class="card-body">
                    <a href="mailto:{{ $repairOrder->customer_email }}" class="btn btn-info btn-block mb-2">
                        <i class="fas fa-envelope"></i> Email Customer
                    </a>
                    <a href="tel:{{ $repairOrder->customer_phone }}" class="btn btn-success btn-block">
                        <i class="fas fa-phone"></i> Call Customer
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
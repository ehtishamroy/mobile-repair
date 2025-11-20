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
                        <strong>Payment Method:</strong> 
                        <span class="badge badge-secondary">{{ ucfirst($repairOrder->payment_method) }}</span>
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

        <!-- Shipping Address -->
        @if($repairOrder->address)
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Shipping Address</h3>
            </div>
            <div class="card-body">
                <p style="white-space: pre-line;">{{ $repairOrder->address }}</p>
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
                            <option value="pending" {{ $repairOrder->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $repairOrder->status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="processing" {{ $repairOrder->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $repairOrder->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $repairOrder->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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
                <p><strong>Payment Method:</strong> {{ ucfirst($repairOrder->payment_method) }}</p>
                @if($repairOrder->payment_intent_id)
                    <p><strong>Payment Intent ID:</strong> <small class="text-muted">{{ $repairOrder->payment_intent_id }}</small></p>
                @endif
                @if($repairOrder->paypal_order_id)
                    <p><strong>PayPal Order ID:</strong> <small class="text-muted">{{ $repairOrder->paypal_order_id }}</small></p>
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


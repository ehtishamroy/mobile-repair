@extends('admin.layouts.app')

@section('title', 'Order Details')
@section('page-title', 'Order Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
    <li class="breadcrumb-item active">{{ $order->order_number }}</li>
@endsection

@section('content')
<div class="row">
    <!-- Order Information -->
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Order Information</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Order Number:</strong> {{ $order->order_number }}<br>
                        <strong>Order Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}<br>
                        <strong>Status:</strong> 
                        <span class="badge badge-{{ $order->status_badge }}">{{ ucfirst($order->status) }}</span><br>
                        <strong>Payment Status:</strong> 
                        @if($order->payment_status === 'paid')
                            <span class="badge badge-success">Paid</span>
                        @elseif($order->payment_status === 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @else
                            <span class="badge badge-danger">{{ ucfirst($order->payment_status) }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <strong>Customer Name:</strong> {{ $order->customer_name }}<br>
                        <strong>Email:</strong> {{ $order->customer_email }}<br>
                        <strong>Phone:</strong> {{ $order->customer_phone ?? 'N/A' }}<br>
                        @if($order->coupon)
                            <strong>Coupon Used:</strong> {{ $order->coupon->code }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Order Items</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                {{ $item->product_name }}
                                @if(!empty($item->variant_data))
                                    <div class="text-muted small mt-1">
                                        @foreach($item->variant_data as $variantName => $variantValue)
                                            <div><strong>{{ $variantName }}:</strong> {{ $variantValue }}</div>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td>{{ $item->product_sku ?? 'N/A' }}</td>
                            <td>{{ $settings->currency_symbol ?? '$' }}{{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $settings->currency_symbol ?? '$' }}{{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-right">Subtotal:</th>
                            <th>{{ $settings->currency_symbol ?? '$' }}{{ number_format($order->subtotal, 2) }}</th>
                        </tr>
                        @if($order->tax > 0)
                        <tr>
                            <th colspan="4" class="text-right">Tax:</th>
                            <th>{{ $settings->currency_symbol ?? '$' }}{{ number_format($order->tax, 2) }}</th>
                        </tr>
                        @endif
                        @if($order->shipping_cost > 0)
                        <tr>
                            <th colspan="4" class="text-right">Shipping:</th>
                            <th>{{ $settings->currency_symbol ?? '$' }}{{ number_format($order->shipping_cost, 2) }}</th>
                        </tr>
                        @endif
                        @if($order->discount > 0)
                        <tr>
                            <th colspan="4" class="text-right">Discount:</th>
                            <th class="text-danger">-{{ $settings->currency_symbol ?? '$' }}{{ number_format($order->discount, 2) }}</th>
                        </tr>
                        @endif
                        <tr>
                            <th colspan="4" class="text-right">Total:</th>
                            <th>{{ $settings->currency_symbol ?? '$' }}{{ number_format($order->total, 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Shipping Address -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Shipping Address</h3>
            </div>
            <div class="card-body">
                {{ $order->customer_name }}<br>
                {{ $order->shipping_address }}<br>
                @if($order->city){{ $order->city }}, @endif
                @if($order->state){{ $order->state }} @endif
                @if($order->zip_code){{ $order->zip_code }}@endif<br>
                @if($order->country){{ $order->country }}@endif
            </div>
        </div>

        <!-- Order Tracking Timeline -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Order Tracking Timeline</h3>
            </div>
            <div class="card-body">
                @if($order->tracking->count() > 0)
                    <div class="timeline">
                        @foreach($order->tracking as $track)
                        <div class="time-label">
                            <span class="bg-{{ $track->status_badge }}">
                                {{ $track->tracking_date->format('M d, Y') }}
                            </span>
                        </div>
                        <div>
                            <i class="fas fa-{{ $track->status === 'delivered' ? 'check-circle' : ($track->status === 'cancelled' ? 'times-circle' : 'info-circle') }} bg-{{ $track->status_badge }}"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> {{ $track->tracking_date->format('h:i A') }}</span>
                                <h3 class="timeline-header">
                                    <strong>{{ $track->title }}</strong>
                                    <span class="badge badge-{{ $track->status_badge }} ml-2">{{ ucfirst($track->status) }}</span>
                                </h3>
                                @if($track->message)
                                <div class="timeline-body">
                                    {{ $track->message }}
                                </div>
                                @endif
                                @if($track->location)
                                <div class="timeline-footer">
                                    <i class="fas fa-map-marker-alt"></i> {{ $track->location }}
                                </div>
                                @endif
                                @if($track->updatedBy)
                                <div class="timeline-footer">
                                    <small class="text-muted">Updated by: {{ $track->updatedBy->name }}</small>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No tracking updates yet.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Order Actions & Tracking -->
    <div class="col-md-4">
        <!-- Update Order Status -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Update Order Status</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="status">Order Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="refunded" {{ $order->status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="payment_status">Payment Status</label>
                        <select class="form-control" id="payment_status" name="payment_status" required>
                            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="admin_notes">Admin Notes</label>
                        <textarea class="form-control" id="admin_notes" name="admin_notes" rows="3">{{ old('admin_notes', $order->admin_notes) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Update Order</button>
                </form>
            </div>
        </div>

        <!-- Add Tracking Update -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Add Tracking Update</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.orders.tracking.store', $order->id) }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="tracking_status">Status <span class="text-danger">*</span></label>
                        <select class="form-control" id="tracking_status" name="status" required>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="processing">Processing</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="refunded">Refunded</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tracking_title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="tracking_title" name="title" 
                               placeholder="e.g., Order Confirmed, Out for Delivery" required>
                    </div>

                    <div class="form-group">
                        <label for="tracking_message">Message</label>
                        <textarea class="form-control" id="tracking_message" name="message" rows="3" 
                                  placeholder="Detailed message for customer"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="tracking_location">Location</label>
                        <input type="text" class="form-control" id="tracking_location" name="location" 
                               placeholder="e.g., Warehouse, In Transit">
                    </div>

                    <div class="form-group">
                        <label for="tracking_date">Tracking Date</label>
                        <input type="datetime-local" class="form-control" id="tracking_date" name="tracking_date" 
                               value="{{ date('Y-m-d\TH:i') }}">
                        <small class="form-text text-muted">Leave empty to use current date/time</small>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="is_customer_notified" name="is_customer_notified" value="1">
                            <label class="custom-control-label" for="is_customer_notified">Notify Customer</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-plus"></i> Add Tracking Update
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Notes -->
        @if($order->notes)
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Customer Notes</h3>
            </div>
            <div class="card-body">
                {{ $order->notes }}
            </div>
        </div>
        @endif
    </div>
</div>

@push('styles')
<style>
.timeline {
    position: relative;
    padding: 0;
    list-style: none;
}
.timeline:before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    left: 40px;
    width: 2px;
    margin-left: -1.5px;
    background-color: #ddd;
}
.timeline > li {
    position: relative;
    margin-bottom: 20px;
}
.timeline > li:before,
.timeline > li:after {
    content: " ";
    display: table;
}
.timeline > li:after {
    clear: both;
}
.timeline > li > .timeline-item {
    margin-left: 60px;
    border-radius: 0.25rem;
    padding: 20px;
    position: relative;
    background-color: #fff;
    border: 1px solid #ddd;
}
.timeline > li > .timeline-item:before {
    content: '';
    position: absolute;
    top: 26px;
    right: 100%;
    width: 0;
    height: 0;
    border: 7px solid transparent;
    border-right-color: #ddd;
}
.timeline > li > .timeline-item:after {
    content: '';
    position: absolute;
    top: 27px;
    right: 100%;
    width: 0;
    height: 0;
    border: 6px solid transparent;
    border-right-color: #fff;
}
.timeline > li > i {
    width: 40px;
    height: 40px;
    font-size: 16px;
    line-height: 40px;
    position: absolute;
    color: #fff;
    background: #6c757d;
    border-radius: 50%;
    text-align: center;
    left: 20px;
    top: 16px;
}
.timeline .time-label > span {
    padding: 5px 10px;
    border-radius: 4px;
    font-weight: 600;
    color: #fff;
}
.timeline-header {
    margin: 0 0 10px 0;
    font-size: 16px;
}
.timeline-body {
    padding: 10px 0;
}
.timeline-footer {
    padding: 10px 0 0 0;
    margin-top: 10px;
    border-top: 1px solid #eee;
}
</style>
@endpush
@endsection


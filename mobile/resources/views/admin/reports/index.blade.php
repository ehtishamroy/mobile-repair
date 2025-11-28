@extends('admin.layouts.app')

@section('title', 'Reports')
@section('page-title', 'Order Reports')

@push('styles')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .stat-card {
        border-left: 4px solid #007bff;
    }
    .stat-card.product {
        border-left-color: #28a745;
    }
    .stat-card.repair {
        border-left-color: #ffc107;
    }
    .stat-card.total {
        border-left-color: #dc3545;
    }
    /* Pagination Styling */
    .pagination {
        display: flex;
        padding-left: 0;
        list-style: none;
        border-radius: 0.25rem;
        justify-content: center;
        flex-wrap: wrap;
    }
    .pagination .page-item {
        display: inline-block;
    }
    .pagination .page-item .page-link {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
        text-decoration: none;
    }
    .pagination .page-item .page-link:hover {
        z-index: 2;
        color: #0056b3;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
    .pagination .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        cursor: auto;
        background-color: #fff;
        border-color: #dee2e6;
    }
    .pagination .page-item:first-child .page-link {
        margin-left: 0;
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }
    .pagination .page-item:last-child .page-link {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }
    .card-footer {
        padding: 0.75rem 1.25rem;
        background-color: rgba(0, 0, 0, 0.03);
        border-top: 1px solid rgba(0, 0, 0, 0.125);
    }
    .card-footer .pagination {
        margin-bottom: 0;
    }
</style>
@endpush

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
<li class="breadcrumb-item active">Reports</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Date Filter -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Filter by Date Range</h3>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.reports.index') }}" class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Statistics -->
    <div class="row">
        <!-- Total Orders -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info stat-card total">
                <div class="inner">
                    <h3>{{ number_format($totalOrders) }}</h3>
                    <p>Total Orders</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success stat-card total">
                <div class="inner">
                    <h3>{{ $currencySymbol }}{{ number_format($totalRevenue, 2) }}</h3>
                    <p>Total Revenue</p>
                </div>
                <div class="icon">
                    <i class="fas fa-pound-sign"></i>
                </div>
            </div>
        </div>

        <!-- Stripe Revenue -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning stat-card">
                <div class="inner">
                    <h3>{{ $currencySymbol }}{{ number_format($totalRevenueStripe, 2) }}</h3>
                    <p>Stripe Revenue</p>
                </div>
                <div class="icon">
                    <i class="fab fa-stripe"></i>
                </div>
            </div>
        </div>

        <!-- PayPal Revenue -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger stat-card">
                <div class="inner">
                    <h3>{{ $currencySymbol }}{{ number_format($totalRevenuePaypal, 2) }}</h3>
                    <p>PayPal Revenue</p>
                </div>
                <div class="icon">
                    <i class="fab fa-paypal"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Orders Statistics -->
    <div class="row">
        <div class="col-md-6">
            <div class="card stat-card product">
                <div class="card-header">
                    <h3 class="card-title">Product Orders</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p><strong>Total Orders:</strong> {{ number_format($totalProductOrders) }}</p>
                            <p><strong>Paid Orders:</strong> {{ number_format($productOrdersPaid) }}</p>
                        </div>
                        <div class="col-6">
                            <p><strong>Total Revenue:</strong> {{ $currencySymbol }}{{ number_format($productRevenue, 2) }}</p>
                            <p><strong>Stripe:</strong> {{ $currencySymbol }}{{ number_format($productRevenueStripe, 2) }}</p>
                            <p><strong>PayPal:</strong> {{ $currencySymbol }}{{ number_format($productRevenuePaypal, 2) }}</p>
                        </div>
                    </div>
                    <hr>
                    <h5>Orders by Status</h5>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Count</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productOrdersByStatus as $status)
                            <tr>
                                <td>{{ ucfirst($status->status) }}</td>
                                <td>{{ $status->count }}</td>
                                <td>{{ $currencySymbol }}{{ number_format($status->revenue ?? 0, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Repair Orders Statistics -->
        <div class="col-md-6">
            <div class="card stat-card repair">
                <div class="card-header">
                    <h3 class="card-title">Repair Orders</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p><strong>Total Orders:</strong> {{ number_format($totalRepairOrders) }}</p>
                            <p><strong>Paid Orders:</strong> {{ number_format($repairOrdersPaid) }}</p>
                        </div>
                        <div class="col-6">
                            <p><strong>Total Revenue:</strong> {{ $currencySymbol }}{{ number_format($repairRevenue, 2) }}</p>
                            <p><strong>Stripe:</strong> {{ $currencySymbol }}{{ number_format($repairRevenueStripe, 2) }}</p>
                            <p><strong>PayPal:</strong> {{ $currencySymbol }}{{ number_format($repairRevenuePaypal, 2) }}</p>
                        </div>
                    </div>
                    <hr>
                    <h5>Orders by Status</h5>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Count</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($repairOrdersByStatus as $status)
                            <tr>
                                <td>{{ ucfirst($status->status) }}</td>
                                <td>{{ $status->count }}</td>
                                <td>{{ $currencySymbol }}{{ number_format($status->revenue ?? 0, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <hr>
                    <h5>Orders by Delivery Method</h5>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Delivery Method</th>
                                <th>Count</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge badge-info">Visit Us</span></td>
                                <td>{{ number_format($visitUsOrders) }}</td>
                                <td>{{ $currencySymbol }}{{ number_format($visitUsRevenue, 2) }}</td>
                            </tr>
                            <tr>
                                <td><span class="badge badge-primary">Online Delivery</span></td>
                                <td>{{ number_format($onlineDeliveryOrders) }}</td>
                                <td>{{ $currencySymbol }}{{ number_format($onlineDeliveryRevenue, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <h5>Orders by Payment Method</h5>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Payment Method</th>
                                <th>Count</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($repairOrdersByPaymentRaw as $payment)
                            <tr>
                                <td>
                                    @if($payment->payment_method === 'stripe')
                                        <span class="badge badge-success">Card</span>
                                    @elseif($payment->payment_method === 'paypal')
                                        <span class="badge badge-primary">PayPal</span>
                                    @elseif($payment->payment_method === 'pay_on_visit')
                                        <span class="badge badge-success">Card</span>
                                    @else
                                        <span class="badge badge-secondary">{{ ucfirst($payment->payment_method) }}</span>
                                    @endif
                                </td>
                                <td>{{ $payment->count }}</td>
                                <td>{{ $currencySymbol }}{{ number_format($payment->revenue ?? 0, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">No data available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Chart -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daily Revenue (Last 30 Days)</h3>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Product Orders</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentProductOrders as $order)
                            <tr>
                                <td><a href="{{ route('admin.orders.show', $order->id) }}">{{ $order->order_number }}</a></td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $currencySymbol }}{{ number_format($order->total, 2) }}</td>
                                <td>
                                    <span class="badge badge-{{ $order->status_badge }}">{{ ucfirst($order->status) }}</span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No orders found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($recentProductOrders->hasPages())
                <div class="card-footer text-center">
                    {{ $recentProductOrders->links() }}
                </div>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Repair Orders</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Service</th>
                                <th>Delivery</th>
                                <th>Payment</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentRepairOrders as $order)
                            <tr>
                                <td><a href="{{ route('admin.repair-orders.show', $order->id) }}">{{ $order->order_number }}</a></td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->service->name ?? 'N/A' }}</td>
                                <td>
                                    @if($order->delivery_method === 'visit')
                                        <span class="badge badge-info">Visit Us</span>
                                    @elseif($order->delivery_method === 'online')
                                        <span class="badge badge-primary">Online</span>
                                    @else
                                        <span class="badge badge-secondary">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if(empty($order->payment_method))
                                        @if($order->delivery_method === 'visit')
                                            <span class="badge badge-success">Card</span>
                                        @else
                                            <span class="badge badge-secondary">Not Selected</span>
                                        @endif
                                    @else
                                        @if($order->payment_method === 'stripe')
                                            <span class="badge badge-success">Card</span>
                                        @elseif($order->payment_method === 'paypal')
                                            <span class="badge badge-primary">PayPal</span>
                                        @else
                                            <span class="badge badge-secondary">{{ ucfirst($order->payment_method) }}</span>
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $currencySymbol }}{{ number_format($order->total, 2) }}</td>
                                <td>
                                    <span class="badge badge-{{ $order->status === 'paid' ? 'success' : ($order->status === 'pending' ? 'warning' : 'info') }}">{{ ucfirst($order->status) }}</span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No orders found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($recentRepairOrders->hasPages())
                <div class="card-footer text-center">
                    {{ $recentRepairOrders->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Revenue Chart
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const dailyData = @json($dailyRevenue);
    
    const revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dailyData.map(d => {
                const date = new Date(d.date);
                return date.toLocaleDateString('en-GB', { month: 'short', day: 'numeric' });
            }),
            datasets: [
                {
                    label: 'Product Orders',
                    data: dailyData.map(d => d.product),
                    borderColor: 'rgb(40, 167, 69)',
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Repair Orders',
                    data: dailyData.map(d => d.repair),
                    borderColor: 'rgb(255, 193, 7)',
                    backgroundColor: 'rgba(255, 193, 7, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Total Revenue',
                    data: dailyData.map(d => d.total),
                    borderColor: 'rgb(220, 53, 69)',
                    backgroundColor: 'rgba(220, 53, 69, 0.1)',
                    tension: 0.4,
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '{{ $currencySymbol }}' + value.toFixed(2);
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': {{ $currencySymbol }}' + context.parsed.y.toFixed(2);
                        }
                    }
                }
            }
        }
    });
</script>
@endpush


@extends('admin.layouts.app')

@section('title', 'Repair Orders')
@section('page-title', 'Repair Orders')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Repair Orders</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Repair Orders List</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Service</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Device</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($repairOrders as $repairOrder)
                        <tr>
                            <td><strong class="text-primary">{{ $repairOrder->order_number }}</strong></td>
                            <td>{{ $repairOrder->service->name ?? 'N/A' }}</td>
                            <td>{{ $repairOrder->customer_name }}</td>
                            <td>{{ $repairOrder->customer_email }}</td>
                            <td>{{ $repairOrder->device_model }}</td>
                            <td><strong>£{{ number_format($repairOrder->total, 2) }}</strong></td>
                            <td>
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
                            </td>
                            <td>
                                <span class="badge badge-secondary">{{ ucfirst($repairOrder->payment_method) }}</span>
                            </td>
                            <td>{{ $repairOrder->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.repair-orders.show', $repairOrder->id) }}" class="btn btn-sm btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">No repair orders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($repairOrders instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator && $repairOrders->hasPages())
            <div class="card-footer">
                {{ $repairOrders->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection


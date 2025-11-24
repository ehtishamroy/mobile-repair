@extends('admin.layouts.app')

@section('title', 'Orders')
@section('page-title', 'Orders')

@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin-panel/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-panel/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-panel/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Orders</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Orders List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="orders-table" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td><strong class="text-primary">{{ $order->order_number }}</strong></td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->customer_email }}</td>
                                <td>{{ $order->items->sum('quantity') }} item(s)</td>
                                <td><strong>{{ $settings->currency_symbol ?? '$' }}{{ number_format($order->total, 2) }}</strong></td>
                                <td>
                                    <span class="badge badge-{{ $order->status_badge }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($order->payment_status === 'paid')
                                        <span class="badge badge-success">Paid</span>
                                    @elseif($order->payment_status === 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($order->payment_status === 'failed')
                                        <span class="badge badge-danger">Failed</span>
                                    @else
                                        <span class="badge badge-secondary">{{ ucfirst($order->payment_status) }}</span>
                                    @endif
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">No orders found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin-panel/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-panel/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-panel/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin-panel/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-panel/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin-panel/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin-panel/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('admin-panel/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin-panel/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin-panel/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin-panel/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin-panel/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Initialize DataTables with export buttons
            var table = $('#orders-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "columnDefs": [
                    { "orderable": false, "targets": [8] } // Disable sorting on Actions column
                ],
                "order": [[7, 'desc']] // Default sort by Date desc
            });

            // Append buttons to the table
            table.buttons().container().appendTo('#orders-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
@endsection


@extends('admin.layouts.app')

@section('title', 'Repair Orders')
@section('page-title', 'Repair Orders')

@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin-panel/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-panel/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-panel/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

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
            <div class="card-body">
                <div class="table-responsive">
                    <table id="repair-orders-table" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Service</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Device</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Delivery</th>
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
                                    @if($repairOrder->delivery_method === 'visit')
                                        <span class="badge badge-info">Visit Us</span>
                                    @elseif($repairOrder->delivery_method === 'online')
                                        <span class="badge badge-primary">Online</span>
                                    @else
                                        <span class="badge badge-secondary">N/A</span>
                                    @endif
                                </td>
                                <td>
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
                                <td colspan="11" class="text-center">No repair orders found.</td>
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
            var table = $('#repair-orders-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "columnDefs": [
                    { "orderable": false, "targets": [10] } // Disable sorting on Actions column
                ],
                "order": [[9, 'desc']], // Default sort by Date desc
                "pageLength": 25,
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        extend: 'copy',
                        text: '<i class="fas fa-copy"></i> Copy',
                        className: 'btn btn-sm btn-secondary'
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        className: 'btn btn-sm btn-secondary',
                        filename: 'repair-orders-' + new Date().toISOString().split('T')[0]
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        className: 'btn btn-sm btn-success',
                        filename: 'repair-orders-' + new Date().toISOString().split('T')[0]
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        className: 'btn btn-sm btn-danger',
                        filename: 'repair-orders-' + new Date().toISOString().split('T')[0],
                        orientation: 'landscape',
                        pageSize: 'A4'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Print',
                        className: 'btn btn-sm btn-info'
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fas fa-columns"></i> Columns',
                        className: 'btn btn-sm btn-secondary'
                    }
                ]
            });

            // Append buttons to the table wrapper
            table.buttons().container().appendTo('#repair-orders-table_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
@endsection


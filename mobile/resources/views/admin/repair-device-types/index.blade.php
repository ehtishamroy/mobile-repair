@extends('admin.layouts.app')

@section('title', 'Device Types')
@section('page-title', 'Device Types')

@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('admin-panel/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin-panel/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin-panel/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Device Types</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Device Types List</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.repair-device-types.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Device Type
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="repair-device-types-table" class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Service</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($deviceTypes as $deviceType)
                        <tr>
                            <td>{{ $deviceType->id }}</td>
                            <td>{{ $deviceType->service->name ?? 'N/A' }}</td>
                            <td>{{ $deviceType->name }}</td>
                            <td>
                                @php
                                    $brandModel = $deviceType->repairBrand;
                                    $brandText = $deviceType->getAttributes()['brand'] ?? null;
                                @endphp
                                @if($brandModel)
                                    @if($brandModel->logo)
                                        <img src="{{ asset('storage/' . $brandModel->logo) }}" alt="{{ $brandModel->name }}" style="max-width: 30px; max-height: 30px; margin-right: 5px;">
                                    @endif
                                    {{ $brandModel->name }}
                                @elseif($brandText && !empty($brandText))
                                    {{ $brandText }}
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>{{ $deviceType->order ?? 0 }}</td>
                            <td>
                                @if($deviceType->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $deviceType->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.repair-device-types.edit', $deviceType->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.repair-device-types.destroy', $deviceType->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this device type?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No device types found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
        $('#repair-device-types-table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "pageLength": 25,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "order": [[4, 'asc'], [0, 'desc']], // Sort by Order column (asc) then ID (desc)
            "columnDefs": [
                { "orderable": false, "targets": [7] }, // Disable sorting on Actions column
                { "orderable": true, "targets": [4] } // Enable sorting on Order column
            ],
            "buttons": [
                {
                    extend: 'copy',
                    text: '<i class="fas fa-copy"></i> Copy',
                    className: 'btn btn-sm btn-secondary'
                },
                {
                    extend: 'csv',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    className: 'btn btn-sm btn-secondary'
                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    className: 'btn btn-sm btn-success'
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    className: 'btn btn-sm btn-danger'
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
            ],
            "dom": 'Bfrtip',
            "language": {
                "search": "Search:",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "Showing 0 to 0 of 0 entries",
                "infoFiltered": "(filtered from _MAX_ total entries)",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        });
    });
</script>
@endpush


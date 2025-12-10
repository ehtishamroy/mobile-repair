@extends('admin.layouts.app')

@section('title', 'Repair Issues')
@section('page-title', 'Repair Issues')

@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin-panel/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin-panel/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-panel/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Repair Issues</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Repair Issues List</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.repair-issues.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New Issue
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="repair-issues-table" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Service</th>
                                    <th>Issue Name</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($issues as $issue)
                                    <tr>
                                        <td>{{ $issue->id }}</td>
                                        <td>{{ $issue->service->name ?? 'N/A' }}</td>
                                        <td>{{ $issue->name }}</td>
                                        <td>{{ $issue->order ?? 0 }}</td>
                                        <td>
                                            @if($issue->is_active)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $issue->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.repair-issues.edit', $issue->id) }}"
                                                class="btn btn-sm btn-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.repair-issues.destroy', $issue->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this issue?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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

    <script>
        $(document).ready(function () {
            $('#repair-issues-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "order": [[3, 'asc']], // Default sort by Order
                "columnDefs": [
                    { "orderable": false, "targets": [6] } // Disable sorting on Actions column
                ]
            });
        });
    </script>
@endpush
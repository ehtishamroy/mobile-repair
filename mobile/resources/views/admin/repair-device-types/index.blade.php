@extends('admin.layouts.app')

@section('title', 'Device Types')
@section('page-title', 'Device Types')

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
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
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
                            <td>{{ $deviceType->brand ?? 'N/A' }}</td>
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
            @if($deviceTypes instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator && $deviceTypes->hasPages())
            <div class="card-footer">
                {{ $deviceTypes->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection


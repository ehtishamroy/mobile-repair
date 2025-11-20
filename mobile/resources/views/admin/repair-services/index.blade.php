@extends('admin.layouts.app')

@section('title', 'Repair Services')
@section('page-title', 'Repair Services')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Repair Services</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Repair Services List</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.repair-services.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Service
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>
                                @if($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" style="max-width: 50px; max-height: 50px;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->slug }}</td>
                            <td>{{ $service->order ?? 0 }}</td>
                            <td>
                                @if($service->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $service->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.repair-services.edit', $service->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.repair-services.destroy', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this service?');">
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
                            <td colspan="8" class="text-center">No repair services found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($services instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator && $services->hasPages())
            <div class="card-footer">
                {{ $services->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection


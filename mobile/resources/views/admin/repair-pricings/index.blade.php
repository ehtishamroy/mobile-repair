@extends('admin.layouts.app')

@section('title', 'Repair Pricing')
@section('page-title', 'Repair Pricing')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Repair Pricing</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pricing List</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.repair-pricings.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Pricing
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Service</th>
                            <th>Device Type</th>
                            <th>Issue</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pricings as $pricing)
                        <tr>
                            <td>{{ $pricing->id }}</td>
                            <td>{{ $pricing->service->name ?? 'N/A' }}</td>
                            <td>{{ $pricing->deviceType->name ?? 'N/A' }}</td>
                            <td>{{ $pricing->issue->name ?? 'N/A' }}</td>
                            <td>£{{ number_format($pricing->price, 2) }}</td>
                            <td>
                                @if($pricing->is_inspection_fee)
                                    <span class="badge badge-warning">Inspection Fee</span>
                                @else
                                    <span class="badge badge-info">Repair Price</span>
                                @endif
                            </td>
                            <td>
                                @if($pricing->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.repair-pricings.edit', $pricing->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.repair-pricings.destroy', $pricing->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this pricing?');">
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
                            <td colspan="8" class="text-center">No pricing found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($pricings instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator && $pricings->hasPages())
            <div class="card-footer">
                {{ $pricings->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection


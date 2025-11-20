@extends('admin.layouts.app')

@section('title', 'Repair Issues')
@section('page-title', 'Repair Issues')

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
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
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
                        @forelse($issues as $issue)
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
                                <a href="{{ route('admin.repair-issues.edit', $issue->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.repair-issues.destroy', $issue->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this issue?');">
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
                            <td colspan="7" class="text-center">No repair issues found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($issues instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator && $issues->hasPages())
            <div class="card-footer">
                {{ $issues->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection


@extends('admin.layouts.app')

@section('title', 'Quality Tiers')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Quality Tiers</h1>
            <a href="{{ route('admin.repair-quality-tiers.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Tier
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Quality Tiers</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Name</th>
                                <th>Issue</th>
                                <th>Device Type</th>
                                <th>Price Modifier</th>
                                <th>Default</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($qualityTiers as $tier)
                                <tr>
                                    <td>{{ $tier->order }}</td>
                                    <td>{{ $tier->name }}</td>
                                    <td>{{ $tier->issue ? $tier->issue->name : 'All Issues' }}</td>
                                    <td>{{ $tier->deviceType ? $tier->deviceType->name : 'All Devices' }}</td>
                                    <td>£{{ number_format($tier->price_modifier, 2) }}</td>
                                    <td>
                                        @if($tier->is_default)
                                            <span class="badge bg-info">Default</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($tier->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.repair-quality-tiers.edit', $tier->id) }}"
                                            class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.repair-quality-tiers.destroy', $tier->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No quality tiers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
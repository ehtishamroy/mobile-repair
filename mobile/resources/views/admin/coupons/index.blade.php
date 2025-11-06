@extends('admin.layouts.app')

@section('title', 'Coupons')
@section('page-title', 'Coupons')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Coupons</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Coupons List</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Coupon
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Discount</th>
                            <th>Usage</th>
                            <th>Status</th>
                            <th>Valid Period</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->id }}</td>
                            <td><strong class="text-primary">{{ $coupon->code }}</strong></td>
                            <td>{{ $coupon->name ?? '-' }}</td>
                            <td>
                                @if($coupon->type === 'percentage')
                                    <span class="badge badge-info">{{ $coupon->value }}%</span>
                                @else
                                    <span class="badge badge-success">{{ $settings->currency_symbol ?? '$' }}{{ number_format($coupon->value, 2) }}</span>
                                @endif
                            </td>
                            <td>
                                @if($coupon->type === 'percentage')
                                    {{ $coupon->value }}%
                                    @if($coupon->maximum_discount)
                                        <br><small class="text-muted">Max: {{ $settings->currency_symbol ?? '$' }}{{ number_format($coupon->maximum_discount, 2) }}</small>
                                    @endif
                                @else
                                    {{ $settings->currency_symbol ?? '$' }}{{ number_format($coupon->value, 2) }}
                                @endif
                            </td>
                            <td>
                                {{ $coupon->usages_count ?? 0 }} / {{ $coupon->usage_limit ?? '∞' }}
                            </td>
                            <td>
                                @if($coupon->is_active && $coupon->isValid())
                                    <span class="badge badge-success">Active</span>
                                @elseif(!$coupon->is_active)
                                    <span class="badge badge-secondary">Inactive</span>
                                @else
                                    <span class="badge badge-warning">Expired</span>
                                @endif
                            </td>
                            <td>
                                <small>
                                    {{ $coupon->start_date->format('M d, Y') }}<br>
                                    to {{ $coupon->end_date->format('M d, Y') }}
                                </small>
                            </td>
                            <td>
                                <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-info" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this coupon?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No coupons found. <a href="{{ route('admin.coupons.create') }}">Create one</a></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $coupons->links() }}
            </div>
        </div>
    </div>
</div>
@endsection


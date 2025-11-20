@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12 mb-3">
        <div class="alert alert-info">
            <h5><i class="icon fas fa-info"></i> Welcome, {{ Auth::user()->name }}!</h5>
            <p class="mb-0">
                @if(!empty($userRoles))
                    Your Roles: <strong>{{ implode(', ', $userRoles) }}</strong>
                @else
                    You are logged in as a <strong>Regular User</strong>
                @endif
            </p>
        </div>
    </div>
</div>

<div class="row">
    @if(isset($stats['total_users']))
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $stats['total_users'] }}</h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            @if(Auth::user()->hasPermission('manage-users'))
            <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            @else
            <span class="small-box-footer">Limited access</span>
            @endif
        </div>
    </div>
    @endif

    @if(isset($stats['active_users']))
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $stats['active_users'] }}</h3>
                <p>Active Users</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            @if(Auth::user()->hasPermission('manage-users'))
            <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            @else
            <span class="small-box-footer">Limited access</span>
            @endif
        </div>
    </div>
    @endif

    @if(isset($stats['total_roles']))
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $stats['total_roles'] }}</h3>
                <p>Total Roles</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-stalker"></i>
            </div>
            @if(Auth::user()->hasPermission('manage-roles'))
            <a href="{{ route('admin.roles.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            @else
            <span class="small-box-footer">Limited access</span>
            @endif
        </div>
    </div>
    @endif

    @if(isset($stats['admin_users']))
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $stats['admin_users'] }}</h3>
                <p>Admin Users</p>
            </div>
            <div class="icon">
                <i class="ion ion-shield"></i>
            </div>
            @if(Auth::user()->hasPermission('manage-users'))
            <a href="{{ route('admin.users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            @else
            <span class="small-box-footer">Limited access</span>
            @endif
        </div>
    </div>
    @endif

    @if(isset($stats['total_orders']))
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $stats['total_orders'] }}</h3>
                <p>Total Orders</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif

    @if(isset($stats['pending_orders']))
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $stats['pending_orders'] }}</h3>
                <p>Pending Orders</p>
            </div>
            <div class="icon">
                <i class="ion ion-clock"></i>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif

    @if(isset($stats['total_repairs']))
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ $stats['total_repairs'] }}</h3>
                <p>Total Repairs</p>
            </div>
            <div class="icon">
                <i class="ion ion-wrench"></i>
            </div>
            <a href="{{ route('admin.repair-orders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif

    @if(isset($stats['pending_repairs']))
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $stats['pending_repairs'] }}</h3>
                <p>Pending Repairs</p>
            </div>
            <div class="icon">
                <i class="ion ion-clock"></i>
            </div>
            <a href="{{ route('admin.repair-orders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif

    @if(isset($stats['total_products']))
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $stats['total_products'] }}</h3>
                <p>Active Products</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-cart"></i>
            </div>
            <a href="{{ route('admin.products.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif

    @if(isset($stats['total_categories']))
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $stats['total_categories'] }}</h3>
                <p>Active Categories</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-list"></i>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif

    @if(isset($stats['total_revenue']))
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>£{{ number_format($stats['total_revenue'], 2) }}</h3>
                <p>Total Revenue</p>
            </div>
            <div class="icon">
                <i class="ion ion-cash"></i>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif

    @if(isset($stats['repair_revenue']))
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>£{{ number_format($stats['repair_revenue'], 2) }}</h3>
                <p>Repair Revenue</p>
            </div>
            <div class="icon">
                <i class="ion ion-cash"></i>
            </div>
            <a href="{{ route('admin.repair-orders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endif
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-tachometer-alt mr-1"></i>
                    Dashboard Overview
                </h3>
            </div>
            <div class="card-body">
                <p>Welcome to the Harrow Mobiles Admin Panel. Use the sidebar navigation to access different modules based on your permissions.</p>
                
                @if(Auth::user()->roles->count() > 0)
                    <h5>Your Permissions:</h5>
                    <ul>
                        @foreach(Auth::user()->roles as $role)
                            @foreach($role->permissions as $permission)
                                <li>{{ $permission->name }}</li>
                            @endforeach
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">You don't have any specific roles assigned. Contact your administrator for access permissions.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection


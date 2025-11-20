<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Order;
use App\Models\RepairOrder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Base stats - available to all authenticated users
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),
        ];

        // Additional stats based on permissions
        if ($user->hasPermission('manage-roles')) {
            $stats['total_roles'] = Role::count();
        }

        if ($user->hasPermission('manage-users')) {
            $stats['admin_users'] = User::whereHas('roles', function ($query) {
                $query->whereIn('slug', ['super-admin', 'admin']);
            })->count();
        }

        // Order stats
        if ($user->hasPermission('manage-orders')) {
            $stats['total_orders'] = Order::count();
            $stats['pending_orders'] = Order::where('status', 'pending')->count();
            $stats['paid_orders'] = Order::where('payment_status', 'paid')->count();
            $stats['total_revenue'] = Order::where('payment_status', 'paid')->sum('total');
        }

        // Repair order stats
        if ($user->hasPermission('manage-repairs')) {
            $stats['total_repairs'] = RepairOrder::count();
            $stats['pending_repairs'] = RepairOrder::where('status', 'pending')->count();
            $stats['paid_repairs'] = RepairOrder::where('status', 'paid')->count();
            $stats['repair_revenue'] = RepairOrder::where('status', 'paid')->sum('total');
        }

        // Product stats
        if ($user->hasPermission('manage-products')) {
            $stats['total_products'] = Product::where('is_active', true)->count();
            $stats['total_categories'] = Category::where('is_active', true)->count();
        }

        // Get user's roles for display
        $userRoles = $user->roles->pluck('name')->toArray();

        return view('admin.dashboard.index', compact('stats', 'userRoles'));
    }
}

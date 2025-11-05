<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
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

        // Role-based stats
        if ($user->hasPermission('manage-orders')) {
            $stats['total_orders'] = 0; // Placeholder - will be implemented when orders module is added
        }

        if ($user->hasPermission('manage-repairs')) {
            $stats['total_repairs'] = 0; // Placeholder - will be implemented when repairs module is added
        }

        // Get user's roles for display
        $userRoles = $user->roles->pluck('name')->toArray();

        return view('admin.dashboard.index', compact('stats', 'userRoles'));
    }
}

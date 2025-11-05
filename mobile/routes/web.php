<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Frontend Authentication Routes (for regular users/customers)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Login Routes (only accessible when not authenticated)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'login']);
    });

    // Logout Route (only accessible when authenticated)
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    });

    // Protected Admin Panel Routes (require authentication, role-based access)
    Route::middleware(['auth.panel'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Profile Management - All authenticated users can manage their own profile
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        
        // Settings Management - Only admins can manage settings
        Route::middleware(['admin'])->group(function () {
            Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
            Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
        });
        
        // Roles Management - Only users with manage-roles permission
        Route::middleware(['permission:manage-roles'])->group(function () {
            Route::resource('roles', RoleController::class);
        });
        
        // Users Management - Only users with manage-users permission
        Route::middleware(['permission:manage-users'])->group(function () {
            Route::resource('users', UserController::class);
        });
        
        // Product Management - Only users with manage-products permission
        Route::middleware(['permission:manage-products'])->group(function () {
            Route::resource('categories', CategoryController::class);
            Route::resource('brands', BrandController::class);
            Route::resource('tags', TagController::class);
            Route::resource('products', ProductController::class);
            Route::post('/products/gallery/{id}/delete', [ProductController::class, 'deleteGalleryImage'])->name('products.gallery.delete');
        });
    });
});

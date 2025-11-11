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
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderTrackingController;
use App\Http\Controllers\Admin\HomepageContentController;
use App\Http\Controllers\Admin\AboutPageContentController;
use App\Http\Controllers\Admin\ServicePageContentController;
use App\Http\Controllers\Admin\JoinPageContentController;
use App\Http\Controllers\Admin\ShippingOptionController;
use App\Http\Controllers\Admin\GlobalFeatureController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('frontend.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('frontend.contact');
Route::get('/join', [HomeController::class, 'join'])->name('frontend.join');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('frontend.checkout');
Route::post('/checkout/process', [HomeController::class, 'processCheckout'])->name('frontend.checkout.process');
Route::post('/checkout/create-paypal-order', [HomeController::class, 'createPayPalOrder'])->name('frontend.checkout.create-paypal-order');
Route::get('/marketplace', [HomeController::class, 'marketplace'])->name('frontend.marketplace');
Route::post('/marketplace/filter', [HomeController::class, 'marketplaceFilter'])->name('frontend.marketplace.filter');
Route::get('/service', [HomeController::class, 'service'])->name('frontend.service');
Route::get('/wishlist', [HomeController::class, 'wishlist'])->name('frontend.wishlist');
Route::get('/track-order', [HomeController::class, 'trackOrder'])->name('frontend.track-order');
Route::get('/cart', [HomeController::class, 'cart'])->name('frontend.cart');
Route::get('/select', [HomeController::class, 'select'])->name('frontend.select');
Route::get('/product/{slug}', [HomeController::class, 'productDetail'])->name('frontend.product-detail');
Route::post('/product/{slug}/variant-price', [HomeController::class, 'getVariantPrice'])->name('frontend.product.variant-price');
Route::post('/product/{slug}/reviews', [HomeController::class, 'storeReview'])->name('frontend.product.reviews.store');
Route::post('/wishlist/add/{product}', [HomeController::class, 'addToWishlist'])->name('frontend.wishlist.add');
Route::post('/wishlist/remove/{product}', [HomeController::class, 'removeFromWishlist'])->name('frontend.wishlist.remove');
Route::get('/place-order', [HomeController::class, 'placeOrder'])->name('frontend.place-order');
Route::get('/mobile-repair', [HomeController::class, 'mobileRepair'])->name('frontend.mobile-repair');

// Cart Routes
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('frontend.cart.add');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('frontend.cart.remove');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('frontend.cart.update');
Route::get('/cart/get', [CartController::class, 'getCart'])->name('frontend.cart.get');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('frontend.cart.clear');

// Coupon Routes
Route::post('/coupon/validate', [CartController::class, 'validateCoupon'])->name('frontend.coupon.validate');
Route::post('/coupon/remove', [CartController::class, 'removeCoupon'])->name('frontend.coupon.remove');

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
            
            // Homepage Content Management (Admin/Superadmin only)
            Route::get('/homepage-content', [HomepageContentController::class, 'index'])->name('homepage-content.index');
            Route::put('/homepage-content', [HomepageContentController::class, 'update'])->name('homepage-content.update');
            
            // About Page Content Management (Admin/Superadmin only)
            Route::get('/about-page-content', [AboutPageContentController::class, 'index'])->name('about-page-content.index');
            Route::put('/about-page-content', [AboutPageContentController::class, 'update'])->name('about-page-content.update');
            
            // Service Page Content Management (Admin/Superadmin only)
            Route::get('/service-page-content', [ServicePageContentController::class, 'index'])->name('service-page-content.index');
            Route::put('/service-page-content', [ServicePageContentController::class, 'update'])->name('service-page-content.update');
            
            // Join Page Content Management (Admin/Superadmin only)
            Route::get('/join-page-content', [JoinPageContentController::class, 'index'])->name('join-page-content.index');
            Route::put('/join-page-content', [JoinPageContentController::class, 'update'])->name('join-page-content.update');
            
            // Shipping Options Management (Admin/Superadmin only)
            Route::get('/shipping-options', [ShippingOptionController::class, 'index'])->name('shipping-options.index');
            Route::post('/shipping-options', [ShippingOptionController::class, 'store'])->name('shipping-options.store');
            Route::put('/shipping-options/{shippingOption}', [ShippingOptionController::class, 'update'])->name('shipping-options.update');
            Route::delete('/shipping-options/{shippingOption}', [ShippingOptionController::class, 'destroy'])->name('shipping-options.destroy');
            
            // Global Features Management (Admin/Superadmin only)
            Route::get('/global-features', [GlobalFeatureController::class, 'index'])->name('global-features.index');
            Route::post('/global-features', [GlobalFeatureController::class, 'store'])->name('global-features.store');
            Route::put('/global-features/{globalFeature}', [GlobalFeatureController::class, 'update'])->name('global-features.update');
            Route::delete('/global-features/{globalFeature}', [GlobalFeatureController::class, 'destroy'])->name('global-features.destroy');
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
            Route::post('/products/{product}/duplicate', [ProductController::class, 'duplicate'])->name('products.duplicate');
            Route::post('/products/gallery/{id}/delete', [ProductController::class, 'deleteGalleryImage'])->name('products.gallery.delete');
            Route::delete('/products/bulk-delete', [ProductController::class, 'bulkDelete'])->name('products.bulk-delete');
        });
        
        // Coupon Management - Only users with manage-products permission
        Route::middleware(['permission:manage-products'])->group(function () {
            Route::resource('coupons', CouponController::class);
        });
        
        // Order Management - Only users with manage-orders permission
        Route::middleware(['permission:manage-orders'])->group(function () {
            Route::resource('orders', OrderController::class)->only(['index', 'show', 'update']);
            Route::post('/orders/{order}/tracking', [OrderTrackingController::class, 'store'])->name('orders.tracking.store');
            Route::put('/orders/{order}/tracking/{tracking}', [OrderTrackingController::class, 'update'])->name('orders.tracking.update');
            Route::delete('/orders/{order}/tracking/{tracking}', [OrderTrackingController::class, 'destroy'])->name('orders.tracking.destroy');
        });
    });
});

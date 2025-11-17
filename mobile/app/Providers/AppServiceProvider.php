<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share settings with all views
        View::composer('*', function ($view) {
            $settings = Setting::getSettings();
            
            // Get wishlist count from session
            $wishlist = session()->get('wishlist', []);
            $wishlistCount = count($wishlist);
            
            $view->with('settings', $settings);
            $view->with('wishlistCount', $wishlistCount);
        });

        // Share categories only with frontend views (not admin)
        View::composer('frontend.*', function ($view) {
            $categories = Category::where('is_active', true)->orderBy('name')->get();
            $view->with('categories', $categories);
        });
    }
}

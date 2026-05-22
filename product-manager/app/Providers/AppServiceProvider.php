<?php

namespace App\Providers;

use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        $cartCount = fn () => Auth::check() && Auth::user()->isStudent()
            ? app(CartService::class)->count()
            : 0;

        View::composer(['layouts.frontend', 'layouts.student'], function ($view) use ($cartCount) {
            $view->with('cartCount', $cartCount());
        });
    }
}

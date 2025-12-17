<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
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
        View::composer('*', function ($view) {
            $carts = auth()->check()
                ? Cart::with('product')
                    ->where('id_user', auth()->id())
                    ->get()
                : collect();

            $view->with('carts', $carts);
        });
    }
}
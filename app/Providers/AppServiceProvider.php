<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Observers\ProductImager;
use App\Models\Product;

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
        Product::observe(ProductImager::class);
    }
}

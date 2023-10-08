<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\DataProviderInterface;
use App\Apis\RapidApi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DataProviderInterface::class, RapidApi::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

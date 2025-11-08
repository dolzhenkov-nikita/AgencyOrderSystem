<?php

namespace App\Providers;

use App\Containers\Order\Tasks\SendOrderNotificationTask;
use App\Services\FractalService;
use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SendOrderNotificationTask::class);

        $this->app->singleton(Manager::class, function () {
            return new Manager();
        });
        $this->app->singleton(FractalService::class, function ($app) {
            return new FractalService($app->make(Manager::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

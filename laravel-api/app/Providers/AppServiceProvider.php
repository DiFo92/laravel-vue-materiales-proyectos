<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(
            'App\Interfaces\MaterialRepositoryInterface',
            'App\Repositories\MaterialRepository'
        );
        $this->app->bind(
            'App\Interfaces\ProyectoRepositoryInterface',
            'App\Repositories\ProyectoRepository'
        );
        $this->app->bind(
            'App\Interfaces\ProyectoMaterialRepositoryInterface',
            'App\Repositories\ProyectoMaterialRepository'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

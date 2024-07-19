<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(MaterialRepositoryInterface::class,MaterialReposiotry::class);
        $this->app->bind(ProyectoRepositoryInterface::class,ProyectoReposiotry::class);
        // $this->app->bind(
        //     'App\Interfaces\MaterialRepositoryInterface',
        //     'App\Repositories\MaterialRepository');

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

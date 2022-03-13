<?php

declare(strict_types=1);

namespace Mohamadtsn\Charts;

use Mohamadtsn\Charts\Registrar;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\Registrar as RouteRegistrar;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ChartsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Merge the configuration files.
        $this->mergeConfigFrom(__DIR__.'/Config/charts.php', 'charts');
        // Register the Chart Registerer singleton class to avoid resolving it
        // multiple times in the application.
        $this->app->singleton(Registrar::class, fn (Application $app) => new Registrar(
            $app,
            $app->make(Repository::class),
            $app->make(RouteRegistrar::class)
        ));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Repository $config, Registrar $charts): void
    {
        // Publish the configuration file to the config path.
        $this->publishes([__DIR__.'/Config/charts.php' => config_path('charts.php')], 'charts');

        // Register the console commands.
        if ($this->app->runningInConsole()) {
            $this->commands([Commands\CreateChart::class]);
        }
    }
}

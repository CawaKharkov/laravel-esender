<?php

namespace CawaKharkov\LaravelSender;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelSenderServiceProvider
 * @package CawaKharkov\LaravelSender
 */
class LaravelSenderServiceProvider extends ServiceProvider
{

    /**
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../views', 'laravel-sender');

        $this->publishes([
            __DIR__ . '/../../config/laravel_sender.php' => config_path('laravel_sender.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../../database/migrations/' => database_path('/migrations/laravel_sender')
        ], 'migrations');

        include __DIR__ . '/../routes.php';

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
        ];
    }

}
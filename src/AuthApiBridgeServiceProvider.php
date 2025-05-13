<?php

namespace LaravelCore\AuthApiBridge;

use Illuminate\Support\ServiceProvider;
use LaravelCore\AuthApiBridge\Services\{
    Clinic,
    Oauth
};

class AuthApiBridgeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/authbridge.php', 'authbridge');

        $this->app->singleton('clinic', function () {
            return new Clinic();
        });

         $this->app->singleton('authbridge', function () {
            return new Oauth();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/authbridge.php' => config_path('authbridge.php'),
        ], 'authbridge-config');

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
    }
}

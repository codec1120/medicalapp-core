<?php

namespace MedicalappCore\AuthApiBridge;

use Illuminate\Support\ServiceProvider;
use MedicalappCore\AuthApiBridge\Services\{
    Clinic,
    Oauth
};
use Illuminate\Foundation\AliasLoader;

class AuthApiBridgeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/authBridge.php', 'authBridge');

        $this->app->singleton('clinic', function ($app) {
            return new Clinic();
        });

        $this->app->singleton('authBridge', function ($app) {
            return new Oauth();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/authBridge.php' => config_path('authBridge.php'),
        ], 'authBridge-config');

        $this->publishes([
            __DIR__.'/../config/clinic.php' => config_path('clinic.php'),
        ], 'clinic-config');
    }
}


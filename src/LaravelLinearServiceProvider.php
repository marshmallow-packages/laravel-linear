<?php

namespace LaravelLinear;

use LaravelLinear\Commands\InstallLinear;
use LaravelLinear\Commands\UpdateLinear;
use LaravelLinear\Http\Livewire\Auth;
use LaravelLinear\Http\Livewire\Config;
use LaravelLinear\Providers\SocialiteProvider;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelLinearServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-linear')
            ->hasConfigFile()
            ->hasViews()
            ->hasRoutes('web')
            ->hasMigrations(['create_linear_table'])
            ->runsMigrations()
            ->hasCommands([
                InstallLinear::class,
                UpdateLinear::class,
            ]);

        $this->publishes([
            __DIR__.'/../public/build' => public_path('marshmallow/linear'),
        ], 'linear-assets');
    }

    public function boot()
    {
        parent::boot();
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'linear',
            function ($app) use ($socialite) {
                $config = $app['config']['linear']['service'];

                return $socialite->buildProvider(SocialiteProvider::class, $config);
            }
        );

        Livewire::component('linear::auth', Auth::class);
        Livewire::component('linear::config', Config::class);
    }
}

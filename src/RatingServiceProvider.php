<?php

namespace Laraveles\Rating;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class RatingServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $this->publishes([
            __DIR__.'/../config/rating.php' => config_path('rating.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations/');

        $this->loadTranslationsFrom(__DIR__.'/../lang/', 'rating');

        $this->publishes([
            __DIR__.'/../lang/' => resource_path('lang/vendor/rating'),
        ]);
    }
}

<?php

namespace Laraveles\Rating\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Laraveles\Rating\Models\Rating;
use Laraveles\Rating\Tests\Models\Page;
use Laraveles\Rating\Tests\Models\User;
use Laraveles\Rating\RatingServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'VendorName\\Skeleton\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            RatingServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        //config()->set('database.default', 'testing');

        $app['config']->set('app.locale', 'es');
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => __DIR__.'/database.sqlite',
            'prefix' => '',
        ]);
        $app['config']->set('auth.providers.users.model', User::class);
        $app['config']->set('auth.providers.pages.model', Page::class);
        $app['config']->set('app.key', 'wslxrEFGWY6GfGhvN9L3wH3KSRJQQpBD');
        $app['config']->set('rating.models.rating', Rating::class);
        $app['config']->set('rating.required_approval', false);
        $app['config']->set('rating.from', 1);
        $app['config']->set('rating.to', 10);
    }

    protected function resetDatabase()
    {
        file_put_contents(__DIR__.'/database.sqlite', null);
    }
}

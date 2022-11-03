<?php

namespace LaravelLinear\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use LaravelLinear\LaravelLinearServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'LaravelLinear\\LaravelLinear\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelLinearServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-linear_table.php.stub';
        $migration->up();
        */
    }
}

<?php

namespace Radiocubito\TallAuth\Tests;

use Illuminate\Support\Facades\Route;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Radiocubito\BladeInput\BladeInputServiceProvider;
use Radiocubito\TallAuth\TallAuthServiceProvider;
use Radiocubito\TallAuth\Tests\Fixtures\User;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->loadLaravelMigrations();

        $this->withFactories(__DIR__.'/database/factories');

        Route::tallAuth('/');

        Route::get('/', function () {
            return;
        })->name('home');
    }

    protected function getPackageProviders($app)
    {
        return [
            TallAuthServiceProvider::class,
            LivewireServiceProvider::class,
            BladeInputServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'AckfSECXIvnK5r28GVIWUAxmbBSjTsmF');
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        $app['config']->set('auth.providers.users.model', User::class);
    }
}

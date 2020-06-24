<?php

namespace Radiocubito\TallAuth;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class TallAuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this
            ->registerPublishables()
            ->registerRoutes()
            ->registerViews();

        Livewire::component('tall-auth.login', \Radiocubito\TallAuth\Http\Livewire\Login::class);

        Blade::directive('route', function ($expression) {
            return "<?php echo route({$expression}) ?>";
        });

        Blade::directive('routeIs', function ($expression) {
            return "<?php if (request()->routeIs({$expression})) : ?>";
        });

        Blade::directive('endrouteIs', function () {
            return "<?php endif; ?>";
        });
    }

    protected function registerPublishables(): self
    {
        if (! $this->app->runningInConsole()) {
            return $this;
        }

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/tall-auth'),
        ], 'views');

        return $this;
    }

    protected function registerRoutes(): self
    {
        Route::macro('tallAuth', function (string $prefix) {
            Route::prefix($prefix)->group(function () {
                Route::view('login', 'tall-auth::login')->middleware('guest')->name('tall-auth.login');

                Route::view('password/reset', 'tall-auth::passwords.request-password')->name('password.request');
            });
        });

        return $this;
    }

    protected function registerViews(): self
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tall-auth');

        Blade::component('tall-auth::components.input.group', 'input.group');
        Blade::component('tall-auth::components.input.text', 'input.text');
        Blade::component('tall-auth::components.card', 'card');

        return $this;
    }
}

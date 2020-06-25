<?php

namespace Radiocubito\TallAuth;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Radiocubito\TallAuth\Http\Controllers\ResetPasswordController;
use Radiocubito\TallAuth\Http\Controllers\VerificationController;

class TallAuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this
            ->registerPublishables()
            ->registerRoutes()
            ->registerViews();

        Livewire::component('tall-auth.register', \Radiocubito\TallAuth\Http\Livewire\Register::class);
        Livewire::component('tall-auth.login', \Radiocubito\TallAuth\Http\Livewire\Login::class);
        Livewire::component('tall-auth.logout', \Radiocubito\TallAuth\Http\Livewire\Logout::class);
        Livewire::component('tall-auth.resend-verification', \Radiocubito\TallAuth\Http\Livewire\ResendVerification::class);
        Livewire::component('tall-auth.passwords.confirm-password', \Radiocubito\TallAuth\Http\Livewire\Passwords\ConfirmPassword::class);
        Livewire::component('tall-auth.passwords.request-password', \Radiocubito\TallAuth\Http\Livewire\Passwords\RequestPassword::class);
        Livewire::component('tall-auth.passwords.reset-password', \Radiocubito\TallAuth\Http\Livewire\Passwords\ResetPassword::class);

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

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/tall-auth'),
        ], 'assets');

        return $this;
    }

    protected function registerRoutes(): self
    {
        Route::macro('tallAuth', function (string $prefix) {
            Route::prefix($prefix)->group(function () {
                Route::view('register', 'tall-auth::register')->middleware('guest')->name('register');
                Route::view('login', 'tall-auth::login')->middleware('guest')->name('login');

                Route::get('email/verify', [VerificationController::class, 'show'])->middleware(['throttle:6,1', 'auth'])->name('verification.notice');
                Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');

                Route::view('password/reset', 'tall-auth::passwords.request-password')->name('password.request');
                Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

                Route::view('password/confirm', 'tall-auth::passwords.confirm-password')->middleware('auth')->name('password.confirm');
            });
        });

        return $this;
    }

    protected function registerViews(): self
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tall-auth');

        return $this;
    }
}

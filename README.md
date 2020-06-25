# A TALL (Tailwind CSS, Alpine.js, Laravel and Livewire) authentication for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/radiocubito/laravel-tall-auth.svg?style=flat-square)](https://packagist.org/packages/radiocubito/laravel-tall-auth)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/radiocubito/laravel-tall-auth/Tests?label=tests)](https://github.com/radiocubito/laravel-tall-auth/actions?query=workflow%3ATests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/radiocubito/laravel-tall-auth.svg?style=flat-square)](https://packagist.org/packages/radiocubito/laravel-tall-auth)


laravel-tall-auth is an authentication scaffolding using the TALL (Tailwind CSS, Alpine.js, Laravel and Livewire) stack.

## Installation

You can install the package via composer:

```bash
composer require radiocubito/laravel-tall-auth
```

You can publish the views with:
```bash
php artisan vendor:publish --provider="Radiocubito\TallAuth\TallAuthServiceProvider" --tag="views"
```

You can publish the assets with:
```bash
php artisan vendor:publish --provider="Radiocubito\TallAuth\TallAuthServiceProvider" --tag="assets" --force
```

Add the route macro. You must register the routes needed to handle authentication. You can put this in your routes file, or in the `map` method of `RouteServiceProvider`
```bash
Route::tall-auth('/');
```

## Usage

After performing all these steps, you should be able to visit the auth UI at `/login`.

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email oliver@radiocubito.com instead of using the issue tracker.

## Credits

- [Oliver Jiménez Servín](https://github.com/oliverds)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

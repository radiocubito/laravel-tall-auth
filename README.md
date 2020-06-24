# A self-hosted invoice manager

[![Latest Version on Packagist](https://img.shields.io/packagist/v/radiocubito/laravel-tall-auth.svg?style=flat-square)](https://packagist.org/packages/radiocubito/laravel-tall-auth)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/radiocubito/laravel-tall-auth/Tests?label=tests)](https://github.com/radiocubito/laravel-tall-auth/actions?query=workflow%3ATests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/radiocubito/laravel-tall-auth.svg?style=flat-square)](https://packagist.org/packages/radiocubito/laravel-tall-auth)


laravel-tall-auth let your generate and manage simple invoices.

## Installation

You can install the package via composer:

```bash
composer require radiocubito/laravel-tall-auth
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Radiocubito\TallAuth\TallAuthServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Radiocubito\TallAuth\TallAuthServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

``` php
$tallAuth = new Radiocubito\TallAuth();
echo $tallAuth->echoPhrase('Hello, Radiocubito!');
```

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

- [Oliver Jiménez-Servín](https://github.com/oliverds)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

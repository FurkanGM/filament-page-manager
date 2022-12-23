# Filament page manager

[![Latest Version on Packagist](https://img.shields.io/packagist/v/furkangm/filament-page-manager.svg?style=flat-square)](https://packagist.org/packages/furkangm/filament-page-manager)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/furkangm/filament-page-manager/run-tests?label=tests)](https://github.com/furkangm/filament-page-manager/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/furkangm/filament-page-manager/Check%20&%20fix%20styling?label=code%20style)](https://github.com/furkangm/filament-page-manager/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/furkangm/filament-page-manager.svg?style=flat-square)](https://packagist.org/packages/furkangm/filament-page-manager)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require furkangm/filament-page-manager
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-page-manager-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-page-manager-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-page-manager-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$filament-page-manager = new FurkanGM\FilamentPageManager();
echo $filament-page-manager->echoPhrase('Hello, FurkanGM!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Furkan Gezek](https://github.com/FurkanGM)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

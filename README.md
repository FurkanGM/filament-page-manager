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

## Usage

First create page template with make command

```shell
php artisan make:page-template {name?}
```

Also you can create manually page template with extend `\FurkanGM\FilamentPageManager\Templates\PageTemplate` class

```php
class ExampleTemplate extends \FurkanGM\FilamentPageManager\Templates\PageTemplate
{
    // ....
}
```

After creating page, you should register page template in config file.

```php
'templates' => [
    // ...
    CreatedPageTemplate::class
]
```

If you want register templates without config file,  you can use `FilamentPageManager` facade.

```php
app(\FurkanGM\FilamentPageManager\FilamentPageManager::class)->setPageTemplates([
    // templates...
]);
```

## Customization

You can extend `Page` model and `PageResource` resource.

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

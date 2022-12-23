<?php

namespace FurkanGM\FilamentPageManager;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FilamentPageManagerServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-page-manager';

    protected array $resources = [
        // CustomResource::class,
    ];

    protected array $pages = [
        // CustomPage::class,
    ];

    protected array $widgets = [
        // CustomWidget::class,
    ];

    protected array $styles = [
        'plugin-filament-page-manager' => __DIR__.'/../resources/dist/filament-page-manager.css',
    ];

    protected array $scripts = [
        'plugin-filament-page-manager' => __DIR__.'/../resources/dist/filament-page-manager.js',
    ];

    // protected array $beforeCoreScripts = [
    //     'plugin-filament-page-manager' => __DIR__ . '/../resources/dist/filament-page-manager.js',
    // ];

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name);
    }
}

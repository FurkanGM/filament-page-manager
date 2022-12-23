<?php

namespace FurkanGM\FilamentPageManager;

use Filament\PluginServiceProvider;
use FurkanGM\FilamentPageManager\Console\Commands\CreatePageTemplateCommand;
use FurkanGM\FilamentPageManager\Facades\FilamentPageManager as FilamentPageManagerFacade;
use Spatie\LaravelPackageTools\Package;

class FilamentPageManagerServiceProvider extends PluginServiceProvider
{
    public function registeringPackage()
    {
        $this->app->bind(FilamentPageManager::class, fn ($app) => new FilamentPageManager());
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-page-manager')
            ->hasConfigFile()
            ->hasTranslations()
            ->hasMigration('create_pages_table')
            ->hasCommand(CreatePageTemplateCommand::class);
    }

    protected function getResources(): array
    {
        return [
            FilamentPageManagerFacade::getResource(),
        ];
    }

    public function packageBooted(): void
    {
        parent::packageBooted();

        FilamentPageManagerFacade::setPageTemplates(config('filament-page-manager.templates'));
    }
}

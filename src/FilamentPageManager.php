<?php

namespace FurkanGM\FilamentPageManager;

use FurkanGM\FilamentPageManager\Models\Page;
use FurkanGM\FilamentPageManager\Resources\PageResource;
use FurkanGM\FilamentPageManager\Templates\PageTemplate;

class FilamentPageManager
{
    /** @var class-string<Page> */
    public string $model;

    /** @var class-string<PageResource> */
    public string $resource;

    public array $pageTemplates = [];

    public function __construct()
    {
        $this->setModel(config('filament-page-manager.model', Page::class));
        $this->setResource(config('filament-page-manager.resource.class', PageResource::class));
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    /**
     * @return class-string<Page>
     */
    public function getModel()
    {
        return $this->model;
    }

    public function setResource(string $resource): void
    {
        $this->resource = $resource;
    }

    /**
     * @return class-string<PageResource>
     */
    public function getResource()
    {
        return $this->resource;
    }

    public function getPageTemplate(string $name): ?PageTemplate
    {
        return collect($this->getPageTemplates())->get($name);
    }

    public function getPageTemplates(): array
    {
        return collect($this->pageTemplates)
            ->filter(fn (string $pageTemplate) => class_exists($pageTemplate))
            ->mapWithKeys(fn (string $pageTemplate) => [$pageTemplate => new $pageTemplate()])
            ->mapWithKeys(fn (PageTemplate $page) => [$page->getName() => $page])
            ->toArray();
    }

    /**
     * @param  PageTemplate[]  $pageTemplates
     */
    public function setPageTemplates(array $pageTemplates): void
    {
        $this->pageTemplates = $pageTemplates;
    }

    public function getPageTemplateOptions(): array
    {
        return collect($this->getPageTemplates())
            ->mapWithKeys(fn (PageTemplate $page) => [$page->getName() => $page->getLabel()])
            ->toArray();
    }
}

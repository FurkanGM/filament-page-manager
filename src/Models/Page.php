<?php

namespace FurkanGM\FilamentPageManager\Models;

use FurkanGM\FilamentPageManager\Facades\FilamentPageManager;
use FurkanGM\FilamentPageManager\Templates\PageTemplate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Page extends Model
{
    protected $fillable = ['name', 'slug', 'data', 'template'];

    protected $casts = [
        'data' => 'json',
    ];

    public function resolveRouteBindingQuery($query, $value, $field = null): Builder|Relation
    {
        $field = $field ?? $this->getRouteKeyName();

        if ($field !== $this->getRouteKeyName()) {
            return parent::resolveRouteBindingQuery($query, $value, $field);
        }

        return $query->where($field, $value);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getTemplateAttribute($template): string|bool|null
    {
        return mb_strtolower($template);
    }

    public function getSlugAttribute($slug): string
    {
        $pageTemplate = $this->getTemplate();

        return $pageTemplate instanceof PageTemplate
            ? ($pageTemplate->isSlugHidden() ? '' : $slug)
            : $slug;
    }

    public function getTemplate(): ?PageTemplate
    {
        return FilamentPageManager::getPageTemplate($this->template);
    }
}

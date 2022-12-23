<?php

namespace FurkanGM\FilamentPageManager\Templates;

use FurkanGM\FilamentPageManager\Contracts\IPageTemplate;
use Illuminate\Support\Str;

abstract class PageTemplate implements IPageTemplate
{
    protected static string $name;

    protected static string $label;

    protected bool $isSlugHidden = false;

    public static function getName(): string
    {
        return mb_strtolower(static::$name ?? Str::snake(class_basename(static::class)));
    }

    public static function getLabel(): string
    {
        return static::$label ?? Str::title(Str::replaceFirst('Template', '', class_basename(static::class)));
    }

    public static function sidebarFields(): array
    {
        return [];
    }

    public static function mainFields(): array
    {
        return [];
    }

    public static function outsideFields(): array
    {
        return [];
    }

    public function hideSlug(bool $hidden = false): void
    {
        $this->isSlugHidden = $hidden;
    }

    public function isSlugHidden(): bool
    {
        return $this->isSlugHidden;
    }
}

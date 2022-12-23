<?php

namespace FurkanGM\FilamentPageManager\Contracts;

interface IPageTemplate
{
    public static function mainFields(): array;

    public static function sidebarFields(): array;

    public static function outsideFields(): array;

    public static function getName(): string;

    public static function getLabel(): string;

    public function hideSlug(): void;

    public function isSlugHidden(): bool;
}

<?php

namespace FurkanGM\FilamentPageManager\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \FurkanGM\FilamentPageManager\FilamentPageManager
 */
class FilamentPageManager extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \FurkanGM\FilamentPageManager\FilamentPageManager::class;
    }
}

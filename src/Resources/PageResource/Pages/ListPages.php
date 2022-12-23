<?php

namespace FurkanGM\FilamentPageManager\Resources\PageResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use FurkanGM\FilamentPageManager\Resources\PageResource;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

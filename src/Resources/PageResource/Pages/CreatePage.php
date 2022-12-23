<?php

namespace FurkanGM\FilamentPageManager\Resources\PageResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use FurkanGM\FilamentPageManager\Resources\PageResource;
use Illuminate\Database\Eloquent\Model;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data = collect($data);

        $additionalFields = $data->except(PageResource::DEFAULT_FIELDS)->toArray();
        $defaultFields = $data->only(PageResource::DEFAULT_FIELDS)->toArray();

        return $this->getModel()::create(array_merge($defaultFields, ['data' => $additionalFields]));
    }
}

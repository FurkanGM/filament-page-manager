<?php

namespace FurkanGM\FilamentPageManager\Resources\PageResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use FurkanGM\FilamentPageManager\Resources\PageResource;
use Illuminate\Database\Eloquent\Model;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function fillForm(): void
    {
        $this->callHook('beforeFill');

        $data = collect($this->getRecord()->attributesToArray())
            ->mapWithKeys(fn ($value, $key) => $key === 'data' ? [...$value] : [$key => $value])
            ->toArray();

        $data = $this->mutateFormDataBeforeFill($data);

        $this->form->fill($data);

        $this->callHook('afterFill');
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $data = collect($data);

        $additionalFields = $data->except(PageResource::DEFAULT_FIELDS)->toArray();
        $defaultFields = $data->only(PageResource::DEFAULT_FIELDS)->toArray();

        $record->update(array_merge($defaultFields, ['data' => $additionalFields]));

        return $record;
    }
}

<?php

namespace FurkanGM\FilamentPageManager\Resources;

use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use FurkanGM\FilamentPageManager\Facades\FilamentPageManager;
use FurkanGM\FilamentPageManager\Models\Page;
use FurkanGM\FilamentPageManager\Resources\PageResource\Pages;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    public const DEFAULT_FIELDS = ['id', 'name', 'slug', 'template', 'created_at', 'updated_at'];

    protected static ?string $recordRouteKeyName = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Forms\Components\Grid::make()
                    ->columnSpan(2)
                    ->schema(function ($livewire, $get, $record) {
                        $additionalMainFields = [];
                        $additionalOutsideFields = [];

                        if ($livewire instanceof (Pages\EditPage::class) || filled($get('template'))) {
                            $additionalMainFields = $record?->getTemplate()->mainFields() ?? FilamentPageManager::getPageTemplate($get('template'))->mainFields();
                            $additionalOutsideFields = $record?->getTemplate()->outsideFields() ?? FilamentPageManager::getPageTemplate($get('template'))->outsideFields();
                        }

                        return array_merge([
                            Forms\Components\Card::make()
                                ->schema(array_merge([
                                    Forms\Components\TextInput::make('name')
                                        ->label(__('filament-page-manager::fields.name'))
                                        ->required()
                                        ->reactive()
                                        ->afterStateUpdated(fn (Closure $set, $state) => $set('slug', Str::slug($state))),
                                    Forms\Components\TextInput::make('slug')
                                        ->label(__('filament-page-manager::fields.slug'))
                                        ->required(fn ($livewire, ?Page $record) => ! $livewire instanceof Pages\EditPage || ! $record?->getTemplate()->isSlugHidden())
                                        ->unique('pages', 'slug', fn ($record) => $record),
                                    Forms\Components\Select::make('template')
                                        ->label(__('filament-page-manager::fields.template'))
                                        ->required()
                                        ->reactive()
                                        ->options(FilamentPageManager::getPageTemplateOptions())
                                        ->disabled(fn ($livewire) => $livewire instanceof Pages\EditPage),
                                ], $additionalMainFields)),
                        ], $additionalOutsideFields);
                    }),
                Forms\Components\Grid::make()
                    ->columnSpan(1)
                    ->schema(function ($livewire, $get, $record) {
                        $additionalFields = [];

                        if ($livewire instanceof (Pages\EditPage::class) || filled($get('template'))) {
                            $additionalFields = $record?->getTemplate()->sidebarFields() ?? FilamentPageManager::getPageTemplate($get('template'))->sidebarFields();
                        }

                        return array_merge([
                            Forms\Components\Card::make()
                                ->columnSpan(2)
                                ->schema([
                                    Forms\Components\Placeholder::make('created_at')
                                        ->label(__('filament-page-manager::fields.creation_date'))
                                        ->content(fn (?Page $record): string => $record?->created_at->diffForHumans() ?? '-'),
                                    Forms\Components\Placeholder::make('updated_at')
                                        ->label(__('filament-page-manager::fields.updated_date'))
                                        ->content(fn (?Page $record): string => $record?->updated_at->diffForHumans() ?? '-'),
                                ]),
                        ], $additionalFields);
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label(__('filament-page-manager::fields.name')),
                Tables\Columns\TextColumn::make('slug')->label(__('filament-page-manager::fields.slug')),
                Tables\Columns\TextColumn::make('template')->label(__('filament-page-manager::fields.template'))->enum(FilamentPageManager::getPageTemplateOptions()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record:id}/edit'),
        ];
    }

    public static function getModel(): string
    {
        return FilamentPageManager::getModel();
    }

    public static function getModelLabel(): string
    {
        return config('filament-page-manager.resource.label') ?? parent::getModelLabel();
    }

    public static function getPluralModelLabel(): string
    {
        return config('filament-page-manager.resource.plural_label') ?? parent::getPluralModelLabel();
    }

    protected static function getNavigationLabel(): string
    {
        return config('filament-page-manager.resource.navigation_label') ?? parent::getNavigationLabel();
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('filament-page-manager.resource.navigation_group') ?? parent::getNavigationGroup();
    }

    protected static function getNavigationIcon(): string
    {
        return config('filament-page-manager.resource.navigation_icon') ?? parent::getNavigationIcon();
    }

    protected static function getNavigationSort(): ?int
    {
        return config('filament-page-manager.resource.navigation_sort_order') ?? parent::getNavigationSort();
    }
}

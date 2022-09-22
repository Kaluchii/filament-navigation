<?php

namespace Kaluchii\FilamentNavigation\Filament\Resources;

use Closure;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Forms\Components\ViewField;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Kaluchii\FilamentNavigation\Models\Navigation;

class NavigationResource extends Resource
{
    protected static ?string $model = Navigation::class;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('name')
                        ->label(__('filament-navigation::filament-navigation.attributes.name'))
                        ->reactive()
                        ->afterStateUpdated(function (?string $state, Closure $set, $context) {
                            if (! $state || $context === 'edit') {
                                return;
                            }

                            $set('handle', Str::slug($state));
                        })
                        ->required(),
                    ViewField::make('items')
                        ->label(__('filament-navigation::filament-navigation.attributes.items'))
                        ->default([])
                        ->view('filament-navigation::navigation-builder'),
                ])
                    ->columnSpan([
                        12,
                        'lg' => 8,
                    ]),
                Group::make([
                    Card::make([
                        TextInput::make('handle')
                            ->label(__('filament-navigation::filament-navigation.attributes.handle'))
                            ->required()
                            ->disabled(fn ($state) => $state )
                            ->unique(column: 'handle', ignoreRecord: true),
                        View::make('filament-navigation::card-divider')
                            ->visible(static::canShowTimestamps()),
                        Placeholder::make('created_at')
                            ->label(__('filament-navigation::filament-navigation.attributes.created_at'))
                            ->visible(static::canShowTimestamps())
                            ->content(fn (?Navigation $record) => $record ? $record->created_at->translatedFormat(config('tables.date_time_format')) : new HtmlString('&mdash;')),
                        Placeholder::make('updated_at')
                            ->label(__('filament-navigation::filament-navigation.attributes.updated_at'))
                            ->visible(static::canShowTimestamps())
                            ->content(fn (?Navigation $record) => $record ? $record->updated_at->translatedFormat(config('tables.date_time_format')) : new HtmlString('&mdash;')),
                    ]),
                ])
                    ->columnSpan([
                        12,
                        'lg' => 4,
                    ]),
            ])
            ->columns(12);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament-navigation::filament-navigation.attributes.name'))
                    ->searchable(isGlobal: false),
                TextColumn::make('handle')
                    ->label(__('filament-navigation::filament-navigation.attributes.handle'))
                    ->searchable(isGlobal: false),
                TextColumn::make('created_at')
                    ->label(__('filament-navigation::filament-navigation.attributes.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->visible(static::canShowTimestamps()),
                TextColumn::make('updated_at')
                    ->label(__('filament-navigation::filament-navigation.attributes.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->visible(static::canShowTimestamps()),
            ])
            ->filters([

            ])
            ->actions([
                \Filament\Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => NavigationResource\Pages\ListNavigations::route('/'),
            'create' => NavigationResource\Pages\CreateNavigation::route('/create'),
            'edit' => NavigationResource\Pages\EditNavigation::route('/{record}'),
        ];
    }

    protected static function getNavigationSort(): ?int
    {
        return config('filament-navigation.navigation-sort') ?? null;
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('filament-navigation.navigation-group') ?? null;
    }

    protected static function getNavigationLabel(): string
    {
        return config('filament-navigation.navigation-label') ?? parent::getNavigationLabel();
    }

    protected static function getNavigationIcon(): string
    {
        return config('filament-navigation.navigation-icon') ?? 'heroicon-o-menu';
    }

    public static function getSlug(): string
    {
        return config('filament-navigation.slug') ?? parent::getSlug();
    }

    public static function getPluralModelLabel(): string
    {
        return config('filament-navigation.plural-model-label') ?? parent::getPluralModelLabel();
    }

    public static function getModelLabel(): string
    {
        return config('filament-navigation.label') ?? parent::getModelLabel();
    }

    public static function canShowTimestamps(): string
    {
        return config('filament-navigation.show-timestamps') ?? false;
    }
}

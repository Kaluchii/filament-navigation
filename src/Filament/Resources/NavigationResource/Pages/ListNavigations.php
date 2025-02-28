<?php

namespace Kaluchii\FilamentNavigation\Filament\Resources\NavigationResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Kaluchii\FilamentNavigation\Filament\Resources\NavigationResource;

class ListNavigations extends ListRecords
{
    protected static string $resource = NavigationResource::class;

    protected function hasCreateAction(): bool
    {
        return config('filament-navigation.can-create') ?? false;
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}

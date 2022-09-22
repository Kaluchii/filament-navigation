<?php

namespace Kaluchii\FilamentNavigation\Filament\Resources\NavigationResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Kaluchii\FilamentNavigation\Filament\Resources\NavigationResource;

class ListNavigations extends ListRecords
{
    protected static string $resource = NavigationResource::class;

    protected function hasCreateAction(): bool
    {
        return false; // TODO: Сделать редактируемым из конфига
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}

<?php

namespace Kaluchii\FilamentNavigation\Filament\Resources\NavigationResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Kaluchii\FilamentNavigation\Filament\Resources\NavigationResource;
use Kaluchii\FilamentNavigation\Filament\Resources\NavigationResource\Pages\Concerns\HandlesNavigationBuilder;

class EditNavigation extends EditRecord
{
    use HandlesNavigationBuilder;

    protected static string $resource = NavigationResource::class;
}

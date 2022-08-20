<?php

namespace Kaluchii\FilamentNavigation\Filament\Resources\NavigationResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Kaluchii\FilamentNavigation\Filament\Resources\NavigationResource;
use Kaluchii\FilamentNavigation\Filament\Resources\NavigationResource\Pages\Concerns\HandlesNavigationBuilder;

class CreateNavigation extends CreateRecord
{
    use HandlesNavigationBuilder;

    protected static string $resource = NavigationResource::class;
}

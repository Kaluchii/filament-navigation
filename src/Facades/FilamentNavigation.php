<?php

namespace Kaluchii\FilamentNavigation\Facades;

use Illuminate\Support\Facades\Facade;
use Kaluchii\FilamentNavigation\FilamentNavigationManager;

/**
 * @method static \Kaluchii\FilamentNavigation\FilamentNavigationManager addItemType(string $name, array | \Closure $fields = [])
 * @method static array getItemTypes()
 * @method static \Kaluchii\FilamentNavigation\Models\Navigation|null get(string $handle)
 */
class FilamentNavigation extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FilamentNavigationManager::class;
    }
}

<?php

namespace Spatie\Permission\Traits;

use Illuminate\Support\Collection;
use Spatie\Permission\PermissionRegistrar;

trait RefreshesPermissionCache
{
    public static function bootRefreshesPermissionCache()
    {
        static::created(function ($model) {
            $model->forgetCachedPermissions();
        });

        static::updated(function ($model) {
            $model->forgetCachedPermissions();
        });

        static::deleted(function ($model) {
            $model->forgetCachedPermissions();
        });
    }

    /**
     *  Forget the cached permissions.
     */
    public function forgetCachedPermissions()
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    /**
     * Get the current cached permissions.
     */
    protected static function getPermissions(): Collection
    {
        return app(PermissionRegistrar::class)->getPermissions();
    }
}

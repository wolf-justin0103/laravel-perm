<?php

namespace Spatie\Permission\Traits;

use Spatie\Permission\Models\Permission;

trait HasPermissions
{
    /**
     * Grant the given permission to a role.
     *
     * @param  $permission
     *
     * @return this
     */
    public function givePermissionTo($permission)
    {
        $this->permissions()->save($this->getStoredPermission($permission));

        $this->forgetCachedPermissions();

        return $this;
    }

    /**
     * Revoke the given permission.
     *
     * @param $permission
     *
     * @return $this
     */
    public function revokePermissionTo($permission)
    {
        $this->permissions()->detach($this->getStoredPermission($permission));

        $this->forgetCachedPermissions();

        return $this;
    }

    /**
     * @param $permission
     *
     * @return Permission
     */
    protected function getStoredPermission($permission)
    {
        if (is_string($permission)) {
            return Permission::findByName($permission);
        }

        return $permission;
    }
}

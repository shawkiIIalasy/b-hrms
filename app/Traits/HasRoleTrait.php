<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;

trait HasRoleTrait
{

    public function assignRole($roles) {
        $this->roles()->detach();
        $this->roles()->attach($roles);
    }

    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }

        return false;
    }

    public function roles()
    {

        return $this->belongsToMany(Role::class, 'users_roles');

    }

    public function hasPermissionTo($permission) {

        return $this->hasPermissionThroughRole($permission);
    }

    public function hasPermissionThroughRole($permission) {

        foreach ($permission->roles as $role){
            if($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }
}

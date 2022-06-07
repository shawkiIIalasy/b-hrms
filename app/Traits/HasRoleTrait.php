<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;

trait HasRoleTrait
{

    public function assignRole($roles) {
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
}

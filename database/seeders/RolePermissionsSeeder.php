<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();

        foreach ($roles as $role) {
            $role->permissions()->attach(Permission::query()->pluck('id')->toArray());
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'employee-index',
            'employee-store',
            'employee-update',
            'employee-show'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'slug' => $permission]);
        }
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Console\Command;

class SuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'superadmin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create super admin user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->ask('Please enter employee email');
        $password = $this->ask('Please enter employee password');

        try {
            $user = User::updateOrCreate(['email' => $email], ['email' => $email, 'password' => $password]);
        } catch (\Throwable $e) {
            $this->error('Cannot create superadmin.');

            return;
        }

        $role = Role::updateOrCreate([
            'slug' => 'super_admin',
        ], [
            'name' => 'Super admin',
            'slug' => 'super_admin',
        ]);

        $user->assignRole([$role->id]);

        $this->call('permissions:sync');

        $permissions = Permission::query()->pluck('id')->toArray();

        $role->permissions()->detach();

        $role->permissions()->attach($permissions);

        $this->alert('Super admin created successfully.');

        return 0;
    }
}

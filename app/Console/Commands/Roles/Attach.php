<?php

namespace App\Console\Commands\Roles;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Console\Command;

class Attach extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:attach {slug} {permission_slug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Attach permission to role';

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
        $role = Role::where('slug', $this->argument('slug'));

        if(!$role->exists()) {
            $this->error('Role not found.');
        }

        $permission = Permission::where('slug', $this->argument('permission_slug'));

        if(!$permission->exists()) {
            $this->error('Permission not found.');
        }

        try {
            $role->first()->permissions()->attach([$permission->first()->id]);
            $this->alert('Role permission attached successfully.');
        }catch (\Exception $e){
            $this->error('Role already have this permission.');
        }

        return 0;
    }
}

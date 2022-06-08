<?php

namespace App\Console\Commands\Permissions;

use App\Models\Role;
use App\Models\Permission;
use App\Enums\PermissionsEnum;
use Illuminate\Console\Command;

class Sync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sync permissions.';

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
        $permissions = PermissionsEnum::cases();

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission->name,
                'slug' => $permission,
            ]);
        }

        $this->alert('Permission synced successfully.');

        return 0;
    }
}

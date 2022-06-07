<?php

namespace App\Console\Commands\Permissions;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Console\Command;

class Create extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:create {name} {slug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new permission.';

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
        Permission::create([
            'name' => $this->argument('name'),
            'slug' => $this->argument('slug')
        ]);

        $this->alert('Permission created successfully.');
        return 0;
    }
}

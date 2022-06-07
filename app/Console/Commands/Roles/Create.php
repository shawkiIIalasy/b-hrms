<?php

namespace App\Console\Commands\Roles;

use App\Models\Role;
use Illuminate\Console\Command;

class Create extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:create {name} {slug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new role.';

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
        Role::create([
            'name' => $this->argument('name'),
            'slug' => $this->argument('slug')
        ]);

        $this->alert('Role created successfully.');
        return 0;
    }
}

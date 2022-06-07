<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;

class UsersSuperadmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:superadmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user as super admin';

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
        $role = Role::where('slug', 'admin')->first();

        $user = User::create([
            'email' => 'superadmin@admin.com',
            'password' => 'Abcdef123'
        ]);

        $user->assignRole([$role->id]);
        return 0;
    }
}

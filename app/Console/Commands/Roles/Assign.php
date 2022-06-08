<?php

namespace App\Console\Commands\Roles;

use App\Models\Employee;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;

class Assign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:assign {role} {employee}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign role for employee';

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

        $employee = Employee::findOrFail($this->argument('employee'));

        $user = User::findOrFail($employee->user->id);

        $user->assignRole([$this->argument('role')]);

        $this->alert('User assign role successfully');

        return 0;
    }
}

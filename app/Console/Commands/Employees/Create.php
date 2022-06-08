<?php

namespace App\Console\Commands\Employees;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Console\Command;

class Create extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employee:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create employee';

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
        $firstName = $this->ask('Please enter employee first name');
        $lastName = $this->ask('Please enter employee last name');
        $phone = $this->ask('Please enter employee phone');
        $countryId = $this->ask('Please enter country id');
        $positionId = $this->ask('PLease enter position id');

        try {
            $user = User::create(['email' => $email, 'password' => $password]);
        } catch (\Throwable $e) {
            $this->error('Cannot create employee');

            return;
        }

        try {
            Employee::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'phone' => $phone,
                'user_id' => $user->id,
                'country_id' => $countryId,
                'position_id' => $positionId
            ]);
        } catch (\Throwable $e) {
            $this->error('Cannot create employee');

            info($e);
            return;
        }

        $this->alert('Employee created successfully');

        return 0;
    }
}

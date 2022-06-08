<?php

namespace App\Console\Commands\Countries;

use App\Models\Country;
use Illuminate\Console\Command;

class Create extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'country:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create country';

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

        try {
            $country = Country::create([
                'name' => $this->argument('name')
            ]);
        }catch (\Throwable $e) {
            $this->error('Country cannot created');
        }

        $this->alert("Country created id:$country->id");

        return 0;
    }
}

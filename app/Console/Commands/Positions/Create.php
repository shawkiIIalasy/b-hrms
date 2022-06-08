<?php

namespace App\Console\Commands\Positions;

use App\Models\Position;
use Illuminate\Console\Command;

class Create extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'position:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create position';

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
            $position = Position::create([
                'name' => $this->argument('name')
            ]);
        }catch (\Throwable $e) {
            $this->error('Position cannot created');
        }

        $this->alert("Position created id:$position->id");
        return 0;
    }
}

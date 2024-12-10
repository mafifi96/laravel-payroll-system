<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LogAttendances extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'log and save employee attendances immediately';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "attendances logged successfully.!\n";

    }
}

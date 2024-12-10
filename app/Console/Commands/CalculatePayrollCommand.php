<?php

namespace App\Console\Commands;

use App\Http\Services\PayrollService;
use Illuminate\Console\Command;

class CalculatePayrollCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:payroll';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Employees Payrolls';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        (new PayrollService)->calculatePayrolls();
        $this->info("Payrolls Created Successfuly");
    }
}

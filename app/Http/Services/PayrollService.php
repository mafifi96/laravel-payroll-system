<?php

namespace App\Http\Services;

use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Support\Carbon;

class PayrollService
{

    public function calculatePayrolls()
    {

        Employee::all()->each(function($employee) {
        
            $salary = $employee->salary ;

            $deductions = $employee->deductions()->whereMonth('date',Carbon::now()->month
            )->sum('amount');

            $bounses = $employee->bounses()->whereMonth('date',Carbon::now()->month
            )->sum('amount');

            $netSalary = ($salary + $bounses) - $deductions;

            Payroll::create([
                'employee_id' => $employee->id,
                'bounses' => $bounses,
                'deductions' => $deductions,
                'salary' => $salary,
                'net' => $netSalary,
                'pay_date' => Carbon::now()
            ]);
        });
        
    }

}

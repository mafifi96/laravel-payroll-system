<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Position;
use App\Models\Payslip;
use App\Models\Allowance;
use App\Models\Deduction;

class Employee extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function allowances()
    {
        return $this->belongsToMany(Allowance::class, 'employee_allowances');
    }

    public function deduction()
    {
        return $this->belongsToMany(Deduction::class, 'employee_deductions');
    }

    public function payslip()
    {
        return $this->hasMany(Payslip::class);
    }
}

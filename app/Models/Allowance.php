<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Allowance extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function employees()
    {
        return $this->belongsToMany(Employee::class , 'employee_allowances');
    }
}

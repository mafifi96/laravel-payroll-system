<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use Carbon\Carbon;

class Deduction extends Model
{
    use HasFactory;

    protected $fillable = ['name','amount','date','description','created_at'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class,'employees_deductions');
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value)->format('Y-m-d h:i:s');
    }
}

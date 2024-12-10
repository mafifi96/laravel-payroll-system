<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use Carbon\Carbon;

class Bonus extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','amount','date','description','created_at'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class,'employees_bonuses');
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value)->format('Y-m-d h:i:s');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:M , d / Y',
        'date'       => 'datetime:M , d / Y'
    ];

    protected $fillable = [ 'date', 'check_in', 'check_out', 'status','employee_id', 'created_at'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::parse($value)->format('Y-m-d h:i:s');
    }
    
}

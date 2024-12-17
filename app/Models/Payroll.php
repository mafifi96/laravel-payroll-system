<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory,SoftDeletes;

        /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:M , d / Y',
    ];


    protected $fillable = [
        'bounses',          // Bonuses for the employee
        'deductions',       // Deductions applied to salary
        'salary',           // Base salary
        'net',              // Net salary after bonuses and deductions
        'pay_date',         // Salary payment date
        'payment_status',   // Payment status: 'paid' or 'pending'
        'employee_id',      // Foreign key to link with the employees table
    ];

    
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Position;
use App\Models\Bonus;
use App\Models\Deduction;

class Employee extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:M , d / Y',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'email',
        'phone',
        'salary',
        'hired_at',
        'status',
        'department_id',
        'position_id'
    ];


    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function bonuses()
    {
        return $this->belongsToMany(Bonus::class , 'employees_bonuses');
    }

    public function deductions()
    {
        return $this->belongsToMany(Deduction::class , 'employees_deductions');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}

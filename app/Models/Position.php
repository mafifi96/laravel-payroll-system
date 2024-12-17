<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Employee;

class Position extends Model
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


    protected $fillable = ['name','description','created_at'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

}

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


    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    

}

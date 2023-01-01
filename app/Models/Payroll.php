<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payslip;

class Payroll extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarde = [];

    public function payslips()
    {
        return $this->hasMany(Payslip::class);
    }

}

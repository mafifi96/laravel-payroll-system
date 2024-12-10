<?php

namespace App\Http\Resources\Payrolls;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class PayrollResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return 
        [
            'id' => $this->id,
            'employee_name' => $this->employee->first_name . ' ' . $this->employee->last_name,
            'bounses' => $this->bounses,
            'deductions' => $this->deductions,
            'salary' => $this->salary,
            'net_salary' => $this->net,
            'pay_date' => Carbon::parse($this->pay_date)->format('Y-m-d h:i a'),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d h:i a'),
            'status' => $this->payment_status,
        ];
    }
}

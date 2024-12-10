<?php

namespace App\Http\Resources\Attendances;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendancesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'employee' => $this->employee->first_name . " " . $this->employee->last_name,
            'employee_id' =>$this->employee_id,
            'status' => $this->status,
            'date' => Carbon::parse($this->date)->format('M , d / Y'),
            'check_in' => Carbon::parse($this->check_in)->format('h:i a'),
            'check_out' => Carbon::parse($this->check_out)->format('h:i a')
        ];
    }
}

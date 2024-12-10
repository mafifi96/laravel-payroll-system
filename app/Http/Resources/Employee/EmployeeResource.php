<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class EmployeeResource extends JsonResource
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
            'name' => $this->first_name .' ' . $this->last_name,
            'email' => $this->email,
            'department' => $this->department?->name,
            'department_id' => $this->department?->id,
            'position' => $this->position?->name,
            'position_id' => $this->position?->id,
            'joined_at' => Carbon::parse($this->created_at)?->format('Y-m-d h:i a')
        ];
    }
}

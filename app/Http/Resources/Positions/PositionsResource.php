<?php

namespace App\Http\Resources\Positions;

use App\Http\Resources\Employee\EmployeeCollection;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PositionsResource extends JsonResource
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
            'name' => $this->name,
            'employees_count' => $this->employees_count,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d h:i a'),
            'employees'       => $this->whenLoaded('employees',fn () => new EmployeeCollection($this->employees)),
            'department_name' => $this->whenLoaded('departments',fn () => $this->department->name),
            
        ];
    }
}

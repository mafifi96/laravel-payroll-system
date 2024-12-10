<?php

namespace App\Http\Resources\Bonuses;

use App\Http\Resources\Employee\EmployeeCollection;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BonusesResource extends JsonResource
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
            'id'              => $this->id,
            'employees_count' => $this->employees_count,
            'amount'          => $this->amount,
            'date'            => $this->date,
            'date'            => Carbon::parse($this->date)->format("Y-m-d h:i a"),
            'created_at'      => Carbon::parse($this->created_at)->format("Y-m-d h:i a"),
            'employees'       => $this->whenLoaded('employees',fn () => new EmployeeCollection($this->employees))
        ];
    }
}

<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'sometimes|string|max:25|min:3',
            'last_name' => 'sometimes|string|max:25|min:3',
            'email' => 'sometimes|email|max:30|unique:App\Models\Employee,email',
            'status' => 'in:active,inactive',
            'phone' => 'sometimes|numeric',
            'salary' => 'sometimes|numeric',
            'hired_at' => 'sometimes|date',
            'department_id' => 'sometimes|exists:App\Models\Department,id',
            'position_id' => 'sometimes|exists:App\Models\Position,id'
        ];
    }
}

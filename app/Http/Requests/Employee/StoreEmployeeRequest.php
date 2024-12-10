<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
        return  [
            'first_name' => 'required|string|max:25|min:3',
            'last_name' => 'required|string|max:25|min:3',
            'email' => 'required|email|max:30|unique:App\Models\Employee,email',
            'status' => 'in:active,inactive',
            'phone' => 'required|numeric',
            'salary' => 'required|numeric',
            'hired_at' => 'required|date',
            'department_id' => 'exists:App\Models\Department,id',
            'position_id' => 'exists:App\Models\Position,id'
        ];
    }
}

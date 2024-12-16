<?php

namespace App\Http\Requests\Poisitons;

use Illuminate\Foundation\Http\FormRequest;

class PositionsRequest extends FormRequest
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
            'name' => 'required|string|max:30|min:4',
            'description' => 'sometimes|string|max:100|min:10',
            'department_id' => 'sometimes|integer|exists:App\Models\Department,id'
        ];
    }
}

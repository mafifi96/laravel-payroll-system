<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees = Employee::with('position','department')->get();

        return $this->sendResponse($employees);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->only(['name','email','status','phone','department_id','position_id']),
        [
            'name' => 'required|string|max:25|min:5',
            'email' => 'required|email|max:30',
            'status' => 'numeric',
            'phone' => 'numeric',
            'department_id' => 'numeric',
            'position_id' => 'numeric'
        ]
        );

        if($validator->fails())
        {
            return $this->sendError($validator->errors());
        }

        $employee = Employee::create($validator->validated());

        return $this->sendResponse($employee);
    }

}

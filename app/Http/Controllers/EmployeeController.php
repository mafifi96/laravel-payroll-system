<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Http\Resources\Employee\EmployeeCollection;
use App\Http\Resources\Employee\EmployeeResource;
use App\Http\Services\PayrollService;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{

    public function index(Request $request)
    {

        $employees = Employee::with('position','department')->paginate($request->limit ?? 10);
        
        return successResponse(new EmployeeCollection($employees));
    }

    public function store(StoreEmployeeRequest $request)
    {

        $employee = Employee::create($request->validated());

        return simpleSuccessResponse(new EmployeeResource($employee));
    }

    public function show(Employee $employee)
    {
        return simpleSuccessResponse(new EmployeeResource($employee));
    }

    public function update(UpdateEmployeeRequest $request , Employee $employee)
    {
        
        $employee->update($request->validated());
        
        return simpleSuccessResponse(message: "Employee Updated Successfuly");
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
    
        return successResponse(message: "Employee Deleted Successfully");
    }

}

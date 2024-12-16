<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\Departments\DepartmentsCollection;
use App\Http\Resources\Departments\DepartmentsResource;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {

       $departments = Department::withCount('employees')->paginate($request->limit ?? 10);

       return successResponse(new DepartmentsCollection($departments));
       return successResponse(DepartmentsResource::collection($departments));

    }

    public function show(Department $department)
    {
        return simpleSuccessResponse(new DepartmentsResource($department));
    }

    public function store(DepartmentRequest $request)
    {

        Department::updateOrCreate($request->validated());

        return simpleSuccessResponse(message: 'department created successfully');

    }

    public function destroy(Department $department)
    {
        $department->delete();

        return simpleSuccessResponse(message: 'department deleted successfully');

    }
    
}

<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {

        if($request->hasHeader('x-with-positions'))
        {
            return $this->sendResponse(Department::latest()->with('positions')->get(['id', 'name']));
        }

        return $this->sendResponse(Department::latest()->get(['id', 'name']));

    }

    public function show($id)
    {
        return $this->sendResponse(Department::findOrFail($id));
    }

    public function store(Request $request)
    {

        //return $this->sendResponse($request->all());
        $validator = Validator::make($request->only(['name', 'description']), [
            'name' => 'required|min:6',
            'description' => 'max:100'
        ]);

         if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'something is wrong..');
        }

        Department::updateOrCreate($validator->validated());

        return $this->sendResponse([], 'department created successfully');

    }

    public function destroy($id)
    {
        Department::findOrFail($id)->delete();

        return $this->sendResponse([] , 'deleted');
    }

    public function positions($id)
    {
        $department = Department::findOrFail($id);

        $positions = $department->positions;

        return response()->json($positions);

    }
}

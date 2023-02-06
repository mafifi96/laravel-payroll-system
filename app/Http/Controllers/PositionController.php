<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Position;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{

    public function index()
    {

        $positions = Position::with('department')->get();

        $departments = Department::all('id','name');

        return $this->sendResponse(['positions' => $positions , 'departments' => $departments]);

    }

    public function show($id)
    {
        $department = Department::findOrFail($id);

        $positions = Position::where('department_id',$id)->get();

        return $this->sendResponse($positions);
    }

    public function store(Request $request)
    {
        $department =  Department::findOrFail($request->department);

        $validator = Validator::make($request->only(['department', 'name']), [
            'name' => 'required|min:6',
            'department' => 'required|integer'
        ]);

        if($validator->fails())
        {
            return $this->sendError($validator->errors());
        }

        Position::create([
            'name' => $request->name,
            'department_id' => $request->department
        ]);

        return $this->sendResponse([], 'position created successfully');


    }


    public function destroy($id)
    {
        Position::findOrFail($id)->delete();
    }

}

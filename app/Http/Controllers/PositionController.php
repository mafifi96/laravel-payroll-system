<?php

namespace App\Http\Controllers;

use App\Http\Requests\Poisitons\PositionsRequest;
use App\Http\Resources\Positions\PositionsCollection;
use App\Http\Resources\Positions\PositionsResource;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Position;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{

    public function index(Request $request)
    {

        $positions = Position::with('department')->withCount('employees')->paginate($request->limit ?? 10);

        return successResponse(new PositionsCollection($positions));

    }

    public function show(Position $position)
    {
        return simpleSuccessResponse(new PositionsResource($position->load('employees')));
    }

    public function store(PositionsRequest $request)
    {
        
        Position::create($request->validated());

        return simpleSuccessResponse(message: 'position created successfully');

    }

    public function update(PositionsRequest $request , Position $position)
    {
        
        $position->create($request->validated());

        return simpleSuccessResponse(message: 'position updated successfully');

    }

    public function destroy(Position $position)
    {
       $position->delete();

       return simpleSuccessResponse(message: 'position deleted successfully');
    }

}

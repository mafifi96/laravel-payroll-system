<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bonuses\BonusRequest;
use App\Http\Requests\Bonuses\BonusUpdateRequest;
use App\Http\Resources\Bonuses\BonusesCollection;
use App\Http\Resources\Bonuses\BonusesResource;
use App\Models\Bonus;
use Illuminate\Http\Request;

class BonusesController extends Controller
{
    public function index(Request $request)
    {
        $bonuses = Bonus::with('employees')->paginate($request->limit ?? 10);

        return successResponse(new BonusesCollection($bonuses));
    }

    public function show(Bonus $bonus)
    {
        return simpleSuccessResponse(new BonusesResource($bonus));
    }

    public function store(BonusRequest $request)
    {

        $bonus = Bonus::create($request->validated());
        
        $bonus->employees()->attach(array_column($request->employees,'employee_id'));

        return simpleSuccessResponse(message:"Bonus Created Successfully");
    }

    public function update(BonusUpdateRequest $request , Bonus $bonus)
    {
        $bonus->update($request->validated());
        
        return simpleSuccessResponse(message:"Bonus Updated");
    }

    public function delete(Bonus $bonus)
    {
        $bonus->delete();

        return simpleSuccessResponse(message:"Bonus Deleted");
    }


}

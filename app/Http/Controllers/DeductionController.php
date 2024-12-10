<?php

namespace App\Http\Controllers;

use App\Http\Requests\Deductions\DeductionRequest;
use App\Http\Requests\Deductions\DeductionUpdateRequest;
use App\Http\Resources\Deductions\DeductionsCollection;
use App\Http\Resources\Deductions\DeductionsResource;
use App\Models\Deduction;
use Illuminate\Http\Request;

class DeductionController extends Controller
{
    public function index(Request $request)
    {
        $deductions = Deduction::withCount('employees')->paginate($request->limit ?? 10);

        return successResponse(new DeductionsCollection($deductions));
    }

    public function show(Deduction $deduction)
    {
        return simpleSuccessResponse(new DeductionsResource($deduction->load('employees')));
    }

    public function store(DeductionRequest $request)
    {

        $deduction = Deduction::create($request->validated());
        
        $deduction->employees()->attach(array_column($request->employees,'employee_id'));

        return simpleSuccessResponse(message:"Deduction Created Successfully");
    }

    public function update(DeductionUpdateRequest $request , Deduction $deduction)
    {
        $deduction->update($request->validated());
        
        return simpleSuccessResponse(message:"Deduction Updated");
    }

    public function delete(Deduction $deduction)
    {
        $deduction->delete();

        return simpleSuccessResponse(message:"Deduction Deleted");
    }

}

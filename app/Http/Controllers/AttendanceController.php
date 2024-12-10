<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attendances\AttendanceRequest;
use App\Http\Resources\Attendances\AttendancesCollection;
use App\Http\Resources\Attendances\AttendancesResource;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $attendances = Attendance::with('employee')
            ->when($request->date_from, function ($query) use ($request) {
                $query->whereBetween('date', [Carbon::parse($request->date_from)->toDayDateTimeString(), Carbon::parse($request->date_to)->toDayDateTimeString()]);
            })
            ->when($request->search , function($query) use ($request)
            {
                $query->whereHas('employee' , function($q) use ($request){
                    $q->whereRaw("CONCAT(first_name, ' ' ,last_name) LIKE ?" , ["%{$request->search}%"]);
                });
            })
            ->paginate($request->limit ?? 10);

        return successResponse(new AttendancesCollection($attendances));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttendanceRequest $request)
    {
  
        $attendance = Attendance::updateOrCreate(
            [
                'employee_id' => $request->employee_id,
                'date'        => today()
            ],
            $request->validated()
        );

        return simpleSuccessResponse(new AttendancesResource($attendance));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        return simpleSuccessResponse(new AttendancesResource($attendance));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(AttendanceRequest $request, Attendance $attendance)
    {
        $attendance = Attendance::updateOrCreate(
            [
                'employee_id' => $request->employee_id,
                'date'        => today()
            ],
            $request->validated()
        );
        
        return simpleSuccessResponse(new AttendancesResource($attendance));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return simpleSuccessResponse(message:"Attendace Deleted");
    }
}

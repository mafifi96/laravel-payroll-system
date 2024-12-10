<?php

namespace App\Http\Controllers;

use App\Http\Resources\Payrolls\PayrollCollection;
use App\Http\Resources\Payrolls\PayrollResource;
use App\Http\Services\PayrollService;
use App\Models\Employee;
use App\Models\Payroll;
use App\Notifications\SalaryPaidNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payrolls = Payroll::paginate($request->limit ?? 10);

        return successResponse(new PayrollCollection($payrolls));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        (new PayrollService)->calculatePayrolls();

        return simpleSuccessResponse(message: "Payrolls Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Payroll $payroll)
    {
        return simpleSuccessResponse(new PayrollResource($payroll));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payroll $payroll)
    {
        $request->validate([
            'payment_status' => 'in:paid,pending'
        ]);

        if($payroll->payment_status == "paid")
        {
            return failMessageResponse("payroll already paid");
        }

        $payroll->update([
            'payment_status' => $request->status,
            'pay_date'       => Carbon::now()
        ]);

        try {

            $payroll->employee->notify(new SalaryPaidNotification([
                'amount' => $payroll->net,
                'date'   => now()->format('Y-m-d h:i a')
            ]));

        } catch (\Exception $e) {

            logger()->error('Failed to send salary email: ' . $e->getMessage());
            
        }

        return simpleSuccessResponse(new PayrollResource($payroll));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payroll $payroll)
    {
        $payroll->delete();

        return simpleSuccessResponse(message: "payroll deleted");
    }
}

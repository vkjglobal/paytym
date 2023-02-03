<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use App\Models\User;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payrolls = Payroll::all();

        return view('employer.Payroll.index', compact('payrolls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('employer.Payroll.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pay = new Payroll();
        $pay->user_id = $request->name;
        $pay->salary = $request->salary; 
        $pay->paid_salary = $request->paid_salary; 
        $pay->fund_deduction = $request->fund_deduction; 
        $pay->p_tax = $request->p_tax; 
        $pay->total_deduction = $request->total_deduction;

        if ($request->hasFile('slip')) {
            $path =  $request->file('slip')->storeAs(  
                'payroll/slips',
                urlencode(time()) . '_' . uniqid() . '_' . $request->slip->getClientOriginalName(),
                'public'
            );
            $pay->pay_slip = $path;
        }

        $res = $pay->save();

        if($res){
            notify()->success(__('Created successfully'));
                } else {
            notify()->error(__('Failed to Create. Please try again'));
                }

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $res = Payroll::find($id);
        return view('employer.Payroll.payslip', compact('res'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payroll = Payroll::find($id);

        return view('employer.Payroll.edit', compact('payroll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

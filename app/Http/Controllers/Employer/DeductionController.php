<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Employer\StoreDeductionRequest;
use App\Models\Deduction;
use Auth;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('deductions')), null],
        ];

        $deductions = Deduction::where('employer_id',Auth::guard('employer')->user()->id)->get();

        return view('employer.deduction.index', compact('breadcrumbs', 'deductions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Create')), null]
        ];
        
        return view('employer.deduction.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeductionRequest $request)
    {
        $request = $request->validated();
        $deduction = new Deduction();
        $deduction->name = $request['name'];
        // $deduction->amount = $request['amount'];
        // $deduction->percentage = $request['percentage'];
        $deduction->description = $request['description'];
        $deduction->employer_id = Auth::guard('employer')->user()->id;
        $issave=$deduction->save();

        if ($issave) {
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Deduction $deduction)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Deductions')), route('employer.deduction.index')],
            [(__('Edit')), null],
        ];
        
        return view('employer.deduction.edit',compact('breadcrumbs','deduction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDeductionRequest $request, Deduction $deduction)
    {
        $request = $request->validated();
        $deduction->name = $request['name'];
        // $deduction->amount = $request['amount'];
        // $deduction->percentage = $request['percentage'];
        $deduction->description = $request['description'];
        $deduction->employer_id = Auth::guard('employer')->user()->id;
        $issave=$deduction->save();

        if ($issave) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deduction $deduction)
    {
        $res=$deduction->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Employer\StoreAllowanceRequest;
use App\Models\Allowance;
use Auth;

class AllowanceController extends Controller
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
            [(__('Allowance')), null],
        ];

        $allowances = Allowance::where('employer_id',Auth::guard('employer')->user()->id)->get();

        return view('employer.allowance.index', compact('breadcrumbs', 'allowances'));
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
        return view('employer.allowance.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAllowanceRequest $request)
    {
        $request = $request->validated();
        $allowance = new Allowance();
        $allowance->type = $request['type'];
        $allowance->rate = $request['rate'];
        $allowance->employer_id = Auth::guard('employer')->user()->id;
        $issave = $allowance->save();
        if($issave){
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
    public function edit(Allowance $allowance)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Edit')), null]
        ];
        return view('employer.allowance.edit', compact('breadcrumbs','allowance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAllowanceRequest $request, Allowance $allowance)
    {
        $request = $request->validated();
        $allowance->type = $request['type'];
        $allowance->rate = $request['rate'];
        $allowance->employer_id = Auth::guard('employer')->user()->id;
        $issave = $allowance->save();
        if($issave){
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
    public function destroy(Allowance $allowance)
    {
        $res = $allowance->delete();

        if($res){
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employer\UpdateBenefitRequest;
use App\Http\Requests\Employer\StoreBenefitRequest;
use App\Models\Benefit;
use Illuminate\Http\Request;
use Auth;

class BenefitController extends Controller
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
            [(__('Benefit')), null],
        ];
        $benefit = Benefit::where('employer_id',Auth::guard('employer')->user()->id)->get();
        return view('employer.benefit.index', compact('breadcrumbs', 'benefit'));
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
            [(__('Benefit')), route('employer.benefit.index')],
            [(__('Create')), null]
        ];
        return view('employer.benefit.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBenefitRequest $request)
    {
        $validated = $request->validated();

        $benefit = new Benefit();
        $benefit->benefit_type = $validated['benefit_type'];
        $benefit->description = $validated['description'];
        $benefit->employer_id = Auth::guard('employer')->user()->id;
        $issave = $benefit->save();
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
     * @param  \App\Models\Benefit  $benefit
     * @return \Illuminate\Http\Response
     */
    public function show(Benefit $benefit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Benefit  $benefit
     * @return \Illuminate\Http\Response
     */
    public function edit(Benefit $benefit)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Benefit')), route('employer.benefit.index')],
            [(__('Edit')), null]
        ];
        //dd($cm);
        return view('employer.benefit.edit', compact('breadcrumbs', 'benefit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Benefit  $benefit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBenefitRequest $request, Benefit $benefit)
    {
        $validated = $request->validated();
        $benefit->benefit_type = $validated['benefit_type'];
        $benefit->description = $validated['description'];
        $benefit->employer_id = Auth::guard('employer')->user()->id;
       
        $issave = $benefit->save();
        if ($issave) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->route('employer.benefit.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Benefit  $benefit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Benefit $benefit)
    {
        $res = $benefit->delete();

        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}

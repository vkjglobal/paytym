<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\PayrollBudget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayrollBudgetController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Payroll Budget')), null],
        ];

        $payroll_budgets = PayrollBudget::where('employer_id',Auth::guard('employer')->user()->id)->get();

        return view('employer.payroll_budget.index', compact('breadcrumbs', 'payroll_budgets'));
    }


    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Payroll Budget')), route('employer.payroll-budget.index')],
            [(__('Create')), null]
        ];
        //Employer $employer
        // $employer=Auth::guard('employer')->user()->id;
        return view('employer.payroll_budget.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required',
            'budget' => 'required',
        ]);

        $payroll_budget = new PayrollBudget();
        $payroll_budget->year = $request->year;
        $payroll_budget->budget_amount = $request->budget;
        $payroll_budget->employer_id = Auth::guard('employer')->user()->id;
        $data = PayrollBudget::where('year', $request->year)->first();
        if($data){
            notify()->error(__('Failed to Create. Data already exists'));
        } else {
            $res = $payroll_budget->save();
                if($res){
                    notify()->success(__('Created successfully'));
                }else{
                    notify()->error(__('Failed to Create. Please try again'));
            }
                
        }
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Payroll Budget')), route('employer.payroll-budget.index')],
            [(__('Edit')), null],
        ];
        //Employer $employer
        // $employer=Auth::guard('employer')->user()->id;
        $payroll_budget = PayrollBudget::findOrFail($id);
        return view('employer.payroll_budget.edit', compact('breadcrumbs', 'id', 'payroll_budget'));
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
        $validated = $request->validate([
            // 'year' => 'required',
            'budget' => 'required',
        ]);
        
        $payroll_budget = PayrollBudget::findOrFail($id);
        // $payroll_budget->year = $request->year;
        $payroll_budget->budget_amount = $request->budget;
        $payroll_budget->employer_id = Auth::guard('employer')->user()->id;
        $data = PayrollBudget::where('year', $request->year)->first();
        // if($data){
        //     notify()->error(__('Failed to Create. Data already exists'));
        // } else {
            $res = $payroll_budget->save();
                if($res){
                    notify()->success(__('Created successfully'));
                }else{
                    notify()->error(__('Failed to Create. Please try again'));
            }
                
        // }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $res = PayrollBudget::findOrFail($id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}

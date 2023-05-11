<?php

namespace App\Http\Controllers\Employer;

use App\Exports\Employer\PaymentExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployerBusiness;
use App\Http\Requests\Employer\StoreBusinessRequest;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.department.index')],
            [(__('Business')), null],
        ];

        $businesses = EmployerBusiness::where('employer_id',Auth::guard('employer')->user()->id)->get();

        // $data = User::with('payroll_latest', 'split_payment')->where('employer_id', Auth::guard('employer')->id())->get();

        // return $data;
        return Excel::download(new PaymentExport, 'budget_report_export-'.Carbon::now().'.xlsx');
        // $export = new PaymentExport();

        return view('employer.business.index', compact('breadcrumbs', 'businesses'));
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
            [(__('Business')), route('employer.business.index')],
            [(__('Create')), null]
        ];
        //Employer $employer
        $employer=Auth::guard('employer')->user()->id;
        return view('employer.business.create', compact('breadcrumbs','employer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBusinessRequest $request)
    {
        $request = $request->validated();
        $business = new EmployerBusiness;
        $business->name = $request['name'];
        $business->description = $request['description'];
        $business->employer_id = Auth::guard('employer')->user()->id;
        $res = $business->save();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployerBusiness $business)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Business')), route('employer.business.index')],
            [(__('Create')), null]
        ];
        //Employer $employer
        return view('employer.business.edit', compact('breadcrumbs','business'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBusinessRequest $request, EmployerBusiness $business)
    {
        $request = $request->validated();
        $business->name = $request['name'];
        $business->description = $request['description'];
        $business->employer_id = Auth::guard('employer')->user()->id;
        $res = $business->save();
        if($res){
                notify()->success(__('Updated successfully'));
            } else {
                notify()->error(__('Failed to Update. Please try again'));
            }
            return redirect()->route('employer.business.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = EmployerBusiness::findOrFail($id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }

    //Change department Status
    public function changeStatus(Request $request){
        $business = EmployerBusiness::find($request->business_id);
        $business->status = $request->status;
        $res=$business->save();
        if($res){
        return response()->json(['success' => 'Status change successfully.']);
        }
    }
}

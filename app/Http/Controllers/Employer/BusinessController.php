<?php

namespace App\Http\Controllers\Employer;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployerBusiness;
use App\Http\Requests\Employer\StoreBusinessRequest;
use App\Models\BankModel;
use App\Models\Country;
use Illuminate\Contracts\View\View;


use Auth;
use Illuminate\Support\Facades\Redirect;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.department.index')],
            [(__('Business')), null],
        ];

        $businesses = EmployerBusiness::where('employer_id', Auth::guard('employer')->user()->id)->get();
        return view('employer.business.index', compact('breadcrumbs', 'businesses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Business')), route('employer.business.index')],
            [(__('Create')), null]
        ];
        //Employer $employer
        $employer = Auth::guard('employer')->user()->id;
        $country = Country::all();
        return view('employer.business.create', compact('breadcrumbs', 'employer','country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBusinessRequest $request)
    {
        $validated = $request->validated();
        $business = new EmployerBusiness;
        $business->name = $validated['name'];
        $business->description = $validated['description'];
        // 06-10-23 
        $business->country = $validated['country'];
        $business->bank = $validated['bank'];
        $business->account_number = $validated['account_number'];
        $business->company_name = $validated['company_name'];
        $business->batch_no = $validated['batch_no'];

        $business->employer_id = Auth::guard('employer')->user()->id;
        $res = $business->save();
        if ($res) {
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
    public function edit(EmployerBusiness $business): View
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Business')), route('employer.business.index')],
            [(__('Create')), null]
        ];
        //Employer $employer
        $country = Country::all();
        $bank=BankModel::where('country_id',$business->country)->get();  
        return view('employer.business.edit', compact('breadcrumbs', 'business','country','bank'));
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
        $validated = $request->validated();
        $business->name = $validated['name'];
        $business->description = $validated['description'];

        $business->country = $validated['country'];
        $business->bank = $validated['bank'];
        $business->account_number = $validated['account_number'];
        $business->company_name = $validated['company_name'];
        $business->batch_no = $validated['batch_no'];


        $business->employer_id = Auth::guard('employer')->user()->id;
        $res = $business->save();
        if ($res) {
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
    public function changeStatus(Request $request)
    {
        $business = EmployerBusiness::find($request->business_id);
        $business->status = $request->status;
        $res = $business->save();
        if ($res) {
            return response()->json(['success' => 'Status change successfully.']);
        }
    }

    // Robin Update 30-08-23   business QR code view 
    public function view_qrcode($id)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.department.index')],
            [(__('Business')), null],
        ];
       $business = EmployerBusiness::where('id', $id)->first();
        return view('employer.business.qr_code', compact('breadcrumbs', 'business'));
    }

    public function generate_qrcode($id)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.department.index')],
            [(__('Business')), null],
        ];
        $business=EmployerBusiness::where('id',$id)->first();
        $business->qr_code = QrCode::size(250)->format('svg')->generate($id);
        $res=$business->save();
        if($res)
        {
            return Redirect::back();
            notify()->success(__('QR code Generated  successfully'));
        }

     //   return view('employer.business.qr_code', compact('breadcrumbs', 'business'));
    }


   


}

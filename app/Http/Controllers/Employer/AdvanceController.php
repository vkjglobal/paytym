<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\AssignDeduction;
use App\Models\Branch;
use App\Models\Deduction;
use App\Models\Department;
use App\Models\EmployerBusiness;
use App\Models\PaymentAdvance;
use App\Models\PaymentRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdvanceController extends Controller
{
    //

    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Advance')), null],
        ];

        $advance_request = PaymentAdvance::with('user.business')->where('employer_id', Auth::guard('employer')->user()->id)->orderBy('created_at', 'desc')->get();
        return view('employer.advance.index', compact('breadcrumbs', 'advance_request'));
    }


    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Advance')), route('employer.advance.index')],
            [(__('Create')), null]
        ];
        $employer_id = Auth::guard('employer')->id();
        $businesses = EmployerBusiness::where('employer_id', Auth::guard('employer')->user()->id)->get();
        $branches = Branch::where('employer_id', Auth::guard('employer')->user()->id)->get();
        $departments = Department::where('employer_id', Auth::guard('employer')->user()->id)->get();
        $users = User::where('employer_id', $employer_id)->where('status', 1)->get();
        return view('employer.advance.create', compact('breadcrumbs', 'businesses', 'branches', 'departments', 'users'));
    }

    public function store(Request $request)
    {
        $now = Carbon::now();
        $payRequest = new PaymentAdvance();
        $payRequest->user_id = $request->employee_id;
        $payRequest->employer_id = Auth::guard('employer')->id();
        $payRequest->advance_amount = $request->amount;
        $payRequest->description = $request->description;
        $payRequest->requested_date = $now;
        $res = $payRequest->save();

        if ($res) {
            notify()->success(__('Added Successfully'));
        } else {
            notify()->success(__('Something went wrong'));
        }
        return Redirect::back();
    }

    public function respond_advance_request(Request $request)
    {
        $id = $request->request_id;
        $status = $request->action;
        $payment_advance = PaymentAdvance::where('id', $id)->first();
        if ($payment_advance) {
            $payment_advance->status = $status;
            $issave = $payment_advance->save();
            if ($issave) {
                if ($status == '1') {
                    $deduction_details = Deduction::where('name', 'LIKE', '%Salary Advance%')->first();
                    if ($deduction_details) {
                    } else {
                        $deduction_details = new Deduction();
                        $deduction_details->employer_id = Auth::guard('employer')->id();
                        $deduction_details->name = "Salary Advance";
                        $deduction_details->description = "Salary Advance";
                        $issave = $deduction_details->save();
                    }
                    $deduction = new AssignDeduction();
                    $deduction->employer_id = Auth::guard('employer')->id();
                    $deduction->rate = $request->requested_amount;
                    $deduction->deduction_id = $deduction_details->id;
                    $deduction->user_id = $request->user_id;
                    $issave = $deduction->save();
                }
                return Redirect::back();
            }
        }
    }

    public function destroy($id)
    {
        $item = PaymentRequest::findOrFail($id);
        $res = $item->delete();

        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return Redirect::back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $breadcrumbs = [
    //         [(__('Dashboard')), route('employer.home')],
    //         [(__('Allowance')), route('employer.allowance.index')],
    //         [(__('Create')), null]
    //     ];
    //     return view('employer.allowance.create', compact('breadcrumbs'));
    // }

}

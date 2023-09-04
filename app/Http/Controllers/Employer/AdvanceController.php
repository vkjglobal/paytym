<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\PaymentAdvance;
use App\Models\PaymentRequest;
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

        $advance_request = PaymentAdvance::with('user.business')->where('employer_id', Auth::guard('employer')->user()->id)->get();
        return view('employer.advance.index', compact('breadcrumbs', 'advance_request'));
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
                return Redirect::back();
            }
        }
    }

    public function destroy($id)
    {
        $item = PaymentRequest::findOrFail($id);
        $res =$item->delete();

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

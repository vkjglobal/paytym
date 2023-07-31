<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\SplitPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SplitPaymentController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Split Payments')), null],
        ];

        $splitpayments = SplitPayment::where('employer_id', Auth::guard('employer')->id())->orderBy('created_at', 'desc')->get();

        return view('employer.split-payment.index',compact('breadcrumbs', 'splitpayments'));
    }
}

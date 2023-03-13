<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeductionsController extends Controller
{
    public function deductions()
    {
       
        $user = Auth::user();
        $deduction = Payroll::with(['user:id,branch_id','user.branch:id,name', 'employer:id', 'employer.surcharge'])->where('user_id', $user->id)->get();
        if ($deduction) {
            return response()->json([
                'message' => "Success",
                'deductions'=>$deduction
            ], 200);
        } else {
            return response()->json([
                'message' => "Fail"
            ], 400);
        }
    }
    public function payroll_list()
    {
       
        $user = Auth::user();
        $payroll_list = Payroll::with(['user:id,branch_id','user.branch:id,name', 'employer:id', 'employer.surcharge'])->where('user_id', $user->id)->get();
        if ($payroll_list) {
            return response()->json([
                'message' => "Success",
                'payroll-list'=>$payroll_list
            ], 200);
        } else {
            return response()->json([
                'message' => "Fail"
            ], 400);
        }
    }
    
}

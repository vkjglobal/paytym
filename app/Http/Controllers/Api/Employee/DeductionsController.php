<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Models\Deduction;
use App\Models\Payroll;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeductionsController extends Controller
{
    public function deductions()
    {
       
        // $user = Auth::user();
        // $deduction = Payroll::with(['user:id,branch_id','user.branch:id,name', 'employer:id', 'employer.surcharge'])->where('user_id', $user->id)->get();
        // $totad_deductions = Payroll::where('user_id', $user->id)->sum('total_deduction');
        // if ($deduction) {
        //     return response()->json([
        //         'message' => "Success",
        //         'deductions'=>$deduction,
        //         'totad_deductions'=>$totad_deductions,
        //     ], 200);
        // } else {
        //     return response()->json([
        //         'message' => "Fail"
        //     ], 400);
        // }

        $user = Auth::user();
        $employer_id = $user->employer_id;
        $deduction = User::select(['id', 'first_name', 'last_name', 'branch_id','department_id'])->with('assign_deduction.deduction:id,name,description')
                    ->where('id', $user->id)->has('assign_deduction')->orderBy('id', 'desc')->get();
        $deductions_types = Deduction::select(['id','employer_id','name','description'])->where('employer_id', $employer_id)->get();
          


        if ($deduction) {
            return response()->json([
                'message' => "Success",
                'deductions'=>$deduction,
                'deductions types'=>$deductions_types,
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

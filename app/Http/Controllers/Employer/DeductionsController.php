<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeductionsController extends Controller
{
    //

    public function deductions()
    {
        $user = Auth::user();
        $deduction = Payroll::where('user_id', $user->id)->get();
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
}

<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index(){
        $payrolls = Payroll::all();

        return view('employer.Payroll.index', compact('payrolls'));
    }
}

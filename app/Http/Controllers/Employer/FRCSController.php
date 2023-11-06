<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrcsEmployeeData;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class FRCSController extends Controller
{
    //

    public function add($id)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Users')), route('employer.user.index')],
            [(__('FRCS Data')), null],
        ];
        $employee = User::where('id', $id)->first();
        return view('employer.user.frcs_add',compact('employee','breadcrumbs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'yeartodate_normal_pay' => 'numeric',
            'yeartodate_dir_rem_and_bonus_overtime' => 'numeric',
            'yeartodate_redundancy_payments' => 'numeric',
            'yeartodate_lumpsum_payments' => 'numeric',
            'yeartodate_other_one_off_payments' => 'numeric',
            'yeartodate_income_tax' => 'numeric',
            'yeartodate_srt' => 'numeric',
            'yeartodate_ecal' => 'numeric',
            'normal_pay' => 'numeric',
            'director_remuneration' => 'numeric',
            'bonus_overtime' => 'numeric',
            'redundancy_payment_approval_no' => 'numeric',
            'redundancy_payments' => 'numeric',
            'lumpsum_payment_approval_no' => 'numeric',
            'lumpsum_payment' => 'numeric',
            'other_oneoff_payment_approval_no' => 'numeric',
            'other_oneoff_payment' => 'numeric',
            'fnpf_deduction' => 'numeric',
            'gross_up_employee' => 'numeric',
            'income_tax' => 'numeric',
            'srt' => 'numeric',
            'ecal' => 'numeric',
        ]);
        $user =  User::where('id', $request->employee_id)->first();
        $data = new FrcsEmployeeData();
        $data->employee_id = $request->employee_id;
        $data->employer_id = Auth::guard('employer')->id();
        $data->yeartodate_normal_pay = $request->yeartodate_normal_pay;
        $data->yeartodate_dir_rem_and_bonus_overtime = $request->yeartodate_dir_rem_and_bonus_overtime;
        $data->yeartodate_redundancy_payments = $request->yeartodate_redundancy_payments;
        $data->yeartodate_lumpsum_payments = $request->yeartodate_lumpsum_payments;
        $data->yeartodate_other_one_off_payments = $request->yeartodate_other_one_off_payments;
        $data->yeartodate_income_tax = $request->yeartodate_income_tax;
        $data->yeartodate_srt = $request->yeartodate_srt;
        $data->yeartodate_ecal = $request->yeartodate_ecal;

        $data->normal_pay = $request->normal_pay;
        $data->director_remuneration = $request->director_remuneration;
        $data->bonus_overtime = $request->bonus_overtime;
        $data->redundancy_payment_approval_no = $request->redundancy_payment_approval_no;
        $data->redundancy_payments = $request->redundancy_payments;
        $data->lumpsum_payment_approval_no = $request->lumpsum_payment_approval_no;
        $data->lumpsum_payment = $request->lumpsum_payment;
        $data->other_oneoff_payment_approval_no = $request->other_oneoff_payment_approval_no;
        $data->other_oneoff_payment = $request->other_oneoff_payment;
        $data->fnpf_deduction = $request->fnpf_deduction;
        $data->gross_up_employee = $request->gross_up_employee;
        $data->income_tax = $request->income_tax;
        $data->srt = $request->srt;
        $data->ecal = $request->ecal;

        $data->tin = $user->tin;
        $data->date_of_birth = $user->date_of_birth;
        $data->tax_code = $user->tax_code;
        $data->employment_start_date = $user->employment_start_date;
        $data->employment_end_date = $user->employment_end_date;
        
        $data->residence = $user->street . ', ' . $user->city . ',' . $user->postcode . ',' . optional($user->country)->name ?? "";
        //dd($data);
        $issave = $data->save();

        if ($issave) {
            notify()->success(__('Added successfully'));
        } else {
            notify()->error(__('Failed to Add. Please try again'));
        }
        return redirect()->back();
    }

    public function show($id)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Users')), route('employer.user.index')],
            [(__('FRCS Data')), null],
        ];
        $frcs = FrcsEmployeeData::where('employee_id', $id)->first();
        return view('employer.user.frcs_index', compact('breadcrumbs', 'frcs'));
    }

    public function edit($id)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Users')), route('employer.user.index')],
            [(__('FRCS Data')), null],
        ];
        $frcs = FrcsEmployeeData::where('id', $id)->first();
        $employee = User::where('id', $frcs->employee_id)->first();
        return view('employer.user.frcs_edit',compact('employee','breadcrumbs','frcs'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'yeartodate_normal_pay' => 'numeric',
            'yeartodate_dir_rem_and_bonus_overtime' => 'numeric',
            'yeartodate_redundancy_payments' => 'numeric',
            'yeartodate_lumpsum_payments' => 'numeric',
            'yeartodate_other_one_off_payments' => 'numeric',
            'yeartodate_income_tax' => 'numeric',
            'yeartodate_srt' => 'numeric',
            'yeartodate_ecal' => 'numeric',
            'normal_pay' => 'numeric',
            'director_remuneration' => 'numeric',
            'bonus_overtime' => 'numeric',
            'redundancy_payment_approval_no' => 'numeric',
            'redundancy_payments' => 'numeric',
            'lumpsum_payment_approval_no' => 'numeric',
            'lumpsum_payment' => 'numeric',
            'other_oneoff_payment_approval_no' => 'numeric',
            'other_oneoff_payment' => 'numeric',
            'fnpf_deduction' => 'numeric',
            'gross_up_employee' => 'numeric',
            'income_tax' => 'numeric',
            'srt' => 'numeric',
            'ecal' => 'numeric',
        ]);
        $data = FrcsEmployeeData::findOrFail($id);
        // $data->employee_id = $request->employee_id;
        // $data->employer_id = Auth::guard('employer')->id();
        $data->yeartodate_normal_pay = $request->yeartodate_normal_pay;
        $data->yeartodate_dir_rem_and_bonus_overtime = $request->yeartodate_dir_rem_and_bonus_overtime;
        $data->yeartodate_redundancy_payments = $request->yeartodate_redundancy_payments;
        $data->yeartodate_lumpsum_payments = $request->yeartodate_lumpsum_payments;
        $data->yeartodate_other_one_off_payments = $request->yeartodate_other_one_off_payments;
        $data->yeartodate_income_tax = $request->yeartodate_income_tax;
        $data->yeartodate_srt = $request->yeartodate_srt;
        $data->yeartodate_ecal = $request->yeartodate_ecal;

        $data->normal_pay = $request->normal_pay;
        $data->director_remuneration = $request->director_remuneration;
        $data->bonus_overtime = $request->bonus_overtime;
        $data->redundancy_payment_approval_no = $request->redundancy_payment_approval_no;
        $data->redundancy_payments = $request->redundancy_payments;
        $data->lumpsum_payment_approval_no = $request->lumpsum_payment_approval_no;
        $data->lumpsum_payment = $request->lumpsum_payment;
        $data->other_oneoff_payment_approval_no = $request->other_oneoff_payment_approval_no;
        $data->other_oneoff_payment = $request->other_oneoff_payment;
        $data->fnpf_deduction = $request->fnpf_deduction;
        $data->gross_up_employee = $request->gross_up_employee;
        $data->income_tax = $request->income_tax;
        $data->srt = $request->srt;
        $data->ecal = $request->ecal;
        $issave = $data->save();

        if ($issave) {
            notify()->success(__('Edited successfully'));
        } else {
            notify()->error(__('Failed to Edit. Please try again'));
        }
        return redirect()->route('employer.frcs.show', $data->employee_id);
    }

}

<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BillingEmail;
use App\Http\Requests\Employer\StoreBillingEmailRequest;
use Auth;

class BillingEmailController extends Controller
{
    //
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.billing_emails.index')],
            [(__('Emails')), null],
        ];
  
        $billing_emails = BillingEmail::where('employer_id', Auth::guard('employer')->user()->id)->get();
        return view('employer.billing_email.index', compact('breadcrumbs', 'billing_emails'));
    }
    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Emails')), route('employer.billing_emails.index')],
            [(__('Create')), null]
        ];
        //Employer $employer
        $employer = Auth::guard('employer')->user()->id;
        return view('employer.billing_email.create', compact('breadcrumbs', 'employer'));
    }

    public function store(StoreBillingEmailRequest $request)
    {
        
        $validated = $request->validated();
        $billingemail = new BillingEmail;
        $billingemail->name = $validated['name'];
        $billingemail->email = $validated['email'];
        $billingemail->employer_id = Auth::guard('employer')->user()->id;
        $res = $billingemail->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->route('employer.billing_emails.index');
    }

    public function edit(BillingEmail $billing_email)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Emails')), route('employer.billing_emails.index')],
            [(__('Create')), null]
        ];
        //Employer $employer
        return view('employer.billing_email.edit', compact('breadcrumbs', 'billing_email'));
    }
    public function update(StoreBillingEmailRequest $request, BillingEmail $billing_email)
    {
        //dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:billing_emails,email,' . $billing_email->id,
        ]);
       
        $billing_email->employer_id = Auth::guard('employer')->user()->id;


        $res=$billing_email->update($request->all());


       /*  $request = $request->validated();
        $billingemail->name = $request['name'];
        $billingemail->email = $request['email'];
        $billingemail->employer_id = Auth::guard('employer')->user()->id;
        $res = $billingemail->save(); */
        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->route('employer.billing_emails.index');
    }

    public function destroy($id)
    {
        $res = BillingEmail::findOrFail($id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }


}

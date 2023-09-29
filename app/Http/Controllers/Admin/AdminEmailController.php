<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminEmails;
use App\Http\Requests\Admin\StoreAdminEmailRequest;

class AdminEmailController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.emails.index')],
            [(__('Emails')), null],
        ];
  
        $emails = AdminEmails::get();
        return view('admin.emails.index', compact('breadcrumbs', 'emails'));
    }

    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Emails')), route('admin.emails.index')],
            [(__('Create')), null]
        ];
        return view('admin.emails.create', compact('breadcrumbs'));
    }

    public function store(StoreAdminEmailRequest $request)
    {
        
        $validated = $request->validated();
        $email = new AdminEmails;
        $email->name = $validated['name'];
        $email->email = $validated['email'];
        $res = $email->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->route('admin.emails.index');
    }

    public function edit(AdminEmails $email)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Emails')), route('admin.emails.index')],
            [(__('Create')), null]
        ];
        return view('admin.emails.edit', compact('breadcrumbs', 'email'));
    }

    public function update(StoreAdminEmailRequest $request, AdminEmails $email)
    {
        //dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:super_admin_emails,email,' . $email->id,
        ]);
       
        $res=$email->update($request->all());

        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->route('admin.emails.index');
    }

    public function destroy($id)
    {
        $res = AdminEmails::findOrFail($id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}

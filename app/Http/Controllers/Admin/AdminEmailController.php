<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminEmails;

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
}

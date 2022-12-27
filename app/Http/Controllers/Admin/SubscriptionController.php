<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Subscriptions')), null],
        ];

        $subscription =Subscription::get();

        return view('admin.subscription.index', compact('breadcrumbs', 'subscription'));
    }

    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Employers')), route('admin.subscriptions.index')],
            [(__('Create')), null]
        ];
        return view('admin.subscriptions.create', compact('breadcrumbs'));
    }

    public function changeStatus(Request $request)
    {
        $employer = Subscription::find($request->employer_id);
        $employer->status = $request->status;
        $employer->save();
        return response()->json(['success' => 'Status change successfully.']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomSubscriptionRequest;
use App\Models\CustomSubscription;
use App\Models\Employer;
use Illuminate\Http\Request;

class CustomSubscriptionController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Custom Subscriptions')), null],
        ];

        $subscription = CustomSubscription::get();

        return view('admin.custom_subscription.index', compact('breadcrumbs', 'subscription'));
    }

    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Subscriptions')), route('admin.custom_subscriptions.index')],
            [(__('Create')), null]
        ];
        //Employer $employer
        $employer=Employer::get();
        return view('admin.custom_subscription.create', compact('breadcrumbs','employer'));
    }

    public function store(CustomSubscriptionRequest $request)
    {
        $validated = $request->validated();

        $subscription = new CustomSubscription();
        $subscription->plan = $validated['plan'];
        $subscription->employer_id = $validated['company'];
        $subscription->range_from = $validated['range_from'];
        $subscription->range_to = $validated['range_to'];
        $subscription->rate_per_employee = $validated['rate_per_employee'];
        $subscription->rate_per_month = $request->get('rate_per_month');
        // if (isset($validated['rate_per_month'])) {
        //     $subscription->rate_per_month = $validated['rate_per_month'];
        // }
        $issave = $subscription->save();
        if ($issave) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->back();
    }

    public function destroy(CustomSubscription $subscription)
    {
        $res = $subscription->delete();

        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $employer = CustomSubscription::find($request->subscription_id);
        $employer->status = $request->status;
        $employer->save();
        return response()->json(['success' => 'Status change successfully.']);
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscriptionRequest;
use App\Http\Requests\Admin\UpdateSubscriptionRequest;
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
        $subscription = Subscription::get();
        return view('admin.subscription.index', compact('breadcrumbs', 'subscription'));
    }

    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Subscriptions')), route('admin.subscriptions.index')],
            [(__('Create')), null]
        ];
        return view('admin.subscription.create', compact('breadcrumbs'));
    }

    public function store(SubscriptionRequest $request)
    {
        $validated = $request->validated();

        $subscription = new Subscription();
        $subscription->plan = $validated['plan'];
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


    public function edit(Subscription $subscription)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Subscription')), route('admin.subscriptions.index')],
            [(__('Edit')), null]
        ];
        return view('admin.subscription.edit', compact('breadcrumbs', 'subscription'));
    }


    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $validated = $request->validated();
        $subscription->plan = $validated['plan'];
        $subscription->range_from = $validated['range_from'];
        $subscription->range_to = $validated['range_to'];
        $subscription->rate_per_employee = $validated['rate_per_employee'];
        $subscription->rate_per_month = $request->get('rate_per_month');
        // if ($request->get('rate_per_month')) {
        //     $subscription->rate_per_month = $request->get('rate_per_month');
        // }
        // else{

        // }
        $issave = $subscription->save();
        if ($issave) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        //return redirect()->back();
        return redirect()->route('admin.subscriptions.index');

    }


    public function destroy(Subscription $subscription)
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
        $employer = Subscription::find($request->subscription_id);
        $employer->status = $request->status;
        $employer->save();
        return response()->json(['success' => 'Status change successfully.']);
    }
}

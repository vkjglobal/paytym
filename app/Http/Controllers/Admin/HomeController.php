<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\Contact;
use App\Models\Subscription;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $employers= Employer::get()->all();
        $contacts= Contact::get()->all();
        $subscriptions= Subscription::get()->all();
        return view('admin.home',compact('employers','contacts','subscriptions'));
    }
}

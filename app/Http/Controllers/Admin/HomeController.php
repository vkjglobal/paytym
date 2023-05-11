<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Subscription;
use App\Models\SupportTicket;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

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
    public function index()
    {
        $employers = Employer::all();
        $contacts = Contact::get()->all();
        $subscriptions = Subscription::get()->all();
        $projects = Project::get()->all();

        return view('admin.home', compact('employers', 'contacts', 'subscriptions', 'projects'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankModel;
use App\Models\Country;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Bank')), null],
        ];

        $bank=BankModel::with('country')->get();
        return view('admin.bank.index', compact('breadcrumbs','bank'));
    }

    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Bank')), null],
        ];

        $countries=Country::get();
        return view('admin.bank.create', compact('breadcrumbs','countries'));
    }

}

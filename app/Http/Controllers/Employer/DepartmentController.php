<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\employer\StoreDepartmentRequest;
use App\Models\Branch;

class DepartmentController extends Controller
{
    public function index(){
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.department.create')],
            [(__('Departments')), null],
        ];

        $admin = Auth::guard('employer')->user();
        $branches = Branch::all();
        return view('employer.departments.create', compact('breadcrumbs', 'admin','branches'));
    }

    public function list(){
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.department.list')],
            [(__('Branch')), null],
        ];

        $admin = Auth::guard('employer')->user();
        return view('employer.departments.list_view', compact('breadcrumbs', 'admin'));
    }


}

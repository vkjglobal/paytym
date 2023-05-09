<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
{
    //
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.userroles.index')],
            [(__('User Capabilities')), null],
        ];

        $userroles = Role::where('employer_id', Auth::guard('employer')->user()->id)->get();

        return view('employer.user-role.index', compact('breadcrumbs', 'userroles'));
    }

    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('User Roles')), route('employer.userroles.index')],
            [(__('Create')), null]
        ];
        return view('employer.user-role.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $role = new Role();
        $role->role_name = $request->user_role;
        $role->employer_id = Auth::guard('employer')->user()->id;
        $issave = $role->save();
        if ($issave) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->back();
    }


    public function edit($id)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('User Role')), route('employer.userroles.index')],
            [(__('Edit')), null]
        ];
        $roles = Role::where('id', $id)->first();
        return view('employer.user-role.edit', compact('breadcrumbs', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::where('id', $id)->first();
        $role->role_name = $request->role_name;
        $issave = $role->save();
        if ($issave) {
            notify()->success(__('Updated  successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $res = Role::where('id', $id)->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}

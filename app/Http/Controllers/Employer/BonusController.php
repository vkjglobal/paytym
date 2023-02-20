<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Bonus;
use App\Models\Branch;
use App\Models\Department;
use App\Models\EmployerBusiness;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BonusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bonuses = Bonus::where('employer_id', Auth::guard('employer')->id())->get();
        return view('employer.bonus.index', compact('bonuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = User::all(); 
        $departments = Department::all(); 
        $branches = Branch::all(); 
        $businesses = EmployerBusiness::all(); 
        return view('employer.bonus.create', compact('employees','departments','branches','businesses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required',
            'type_id' => 'required',
            'rate_type' => 'required',
            'rate' => 'required|numeric',
        ]);
        $data = new Bonus();
        $data->employer_id = Auth::guard('employer')->id();
        $data->type = $request->type;
        $data->type_id = $request->type_id;
        $data->rate_type = $request->rate_type;
        $data->rate = $request->rate;
        $res = $data->save();

        if ($res) {
            notify()->success(__('Bonus added.'));
        } else {
            notify()->error(__('Failed to add bonus. Please try again'));
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bonus = Bonus::find($id);
        // dd($bonus);
        $employees = User::all(); 
        $departments = Department::all(); 
        $branches = Branch::all(); 
        $businesses = EmployerBusiness::all(); 

        if($bonus->type == 0){
            return view('employer.bonus.edit1', compact('employees','departments','branches','businesses','bonus'));
        }elseif($bonus->type == 1){
            return view('employer.bonus.edit2', compact('employees','departments','branches','businesses','bonus'));
        }elseif($bonus->type == 2){
            return view('employer.bonus.edit3', compact('employees','departments','branches','businesses','bonus'));
        }elseif($bonus->type == 3){
            return view('employer.bonus.edit4', compact('employees','departments','branches','businesses','bonus'));
        }else{
            return view('employer.bonus.edit', compact('employees','departments','branches','businesses','bonus'));
        }
        // return view('employer.bonus.edit', compact('employees','departments','branches','businesses','bonus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Bonus::find($id);
        $data->employer_id = Auth::guard('employer')->id();
        $data->type = $request->type;
        $data->type_id = $request->type_id;
        $data->rate_type = $request->rate_type;
        $data->rate = $request->rate;
        $res = $data->save();

        if ($res) {
            notify()->success(__('Bonus updated.'));
        } else {
            notify()->error(__('Failed to update bonus. Please try again'));
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Bonus::find($id);
        $res = $data->delete();
    
        if ($res) {
            notify()->success(__('Bonus deleted.'));
        } else {
            notify()->error(__('Failed to delete bonus. Please try again'));
        }

        return redirect()->back();
    }
    
}

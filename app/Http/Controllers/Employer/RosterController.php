<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Employer\StoreRosterRequest;
use App\Models\Project;
use App\Models\User;
use App\Models\JobType;
use App\Models\Roster;
use App\Models\EmployerBusiness;
use App\Models\Department;
use Auth;

class RosterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.roster.index')],
            [(__('Rosters')), null],
        ];

        $rosters = Roster::where('employer_id',Auth::guard('employer')->user()->id)->get();

        return view('employer.roster.index', compact('breadcrumbs', 'rosters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Create')), null]
        ];
        $users = User::where('employer_id', Auth::guard('employer')->user()->id)->get();
        $businesses = EmployerBusiness::where('employer_id',Auth::guard('employer')->user()->id)->get();
        $departments = Department::where('employer_id',Auth::guard('employer')->user()->id)->get();
        $job_types = JobType::get();
        return view('employer.roster.create', compact('breadcrumbs',
                                                      'users',
                                                      'job_types',
                                                      'businesses',
                                                      'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRosterRequest $request)
    {   

        $salaryType = User::findOrFail($request['employee'])->salary_type;
        $request = $request->validated();
        $roster = new Roster();
        $roster->user_id = $request['employee'];
        $roster->business_id = $request['business'];
        $roster->department_id = $request['department'];
        $roster->start_date = $request['start_date'];
        $roster->end_date = $request['end_date'];
        if($salaryType == 0){
            $roster->start_time = $request['start_time'];
            $roster->end_time = $request['end_time'];
        }
        else{
            $roster->mon = $request['mon_start']."/".$request['mon_end'];
            $roster->tue = $request['tue_start']."/".$request['tue_end'];
            $roster->wed = $request['wed_start']."/".$request['wed_end'];
            $roster->thu = $request['thu_start']."/".$request['thu_end'];
            $roster->fri = $request['fri_start']."/".$request['fri_end'];
            $roster->sat = $request['sat_start']."/".$request['sat_end'];
            $roster->sun = $request['sun_start']."/".$request['sun_end'];
        }
        
        $roster->employer_id = Auth::guard('employer')->user()->id;
        $issave = $roster->save();
        if($issave){
            notify()->success(__('Created successfully'));
                } else {
                    notify()->error(__('Failed to Create. Please try again'));
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
    public function edit(Roster $roster)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Roster')), null],
        ];
        $users = User::where('employer_id',Auth::guard('employer')->user()->id)->get();
        $projects = Project::where('employer_id',Auth::guard('employer')->user()->id)->get();
        $job_types = JobType::get();
        $businesses = EmployerBusiness::where('employer_id',Auth::guard('employer')->user()->id)->get();
        $departments = Department::where('employer_id',Auth::guard('employer')->user()->id)->get();
        return view('employer.roster.edit',compact('roster','breadcrumbs','users','projects','job_types','businesses','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRosterRequest $request, Roster $roster)
    {   
        $salaryType = $roster->user->salary_type;
        $request = $request->validated();
        $roster->user_id = $request['employee'];
        $roster->business_id = $request['business'];
        $roster->department_id = $request['department'];
        $roster->start_date = $request['start_date'];
        $roster->end_date = $request['end_date'];
        if($salaryType == 0){
        $roster->start_time = $request['start_time'];
        $roster->end_time = $request['end_time'];
        }else{
            $roster->mon = $request['mon_start']."/".$request['mon_end'];
            $roster->tue = $request['tue_start']."/".$request['tue_end'];
            $roster->wed = $request['wed_start']."/".$request['wed_end'];
            $roster->thu = $request['thu_start']."/".$request['thu_end'];
            $roster->fri = $request['fri_start']."/".$request['fri_end'];
            $roster->sat = $request['sat_start']."/".$request['sat_end'];
            $roster->sun = $request['sun_start']."/".$request['sun_end'];
        }
        $roster->employer_id = Auth::guard('employer')->user()->id;
        $issave = $roster->save();
        if($issave){
            notify()->success(__('Updated successfully'));
                } else {
                    notify()->error(__('Failed to Update. Please try again'));
                }
                return redirect()->route('employer.roster.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roster $roster)
    {
        $res = $roster->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}

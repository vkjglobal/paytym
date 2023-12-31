<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\EmployerBusiness;
use App\Models\Project;
use App\Http\Requests\Employer\StoreProjectRequest;
use Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            $breadcrumbs = [
                [(__('Dashboard')), route('employer.home')],
                [(__('Projects')), null],
            ];
            $branches = Branch::where('employer_id',Auth::guard('employer')->user()->id)->get();
            $businesses = EmployerBusiness::where('employer_id',Auth::guard('employer')->user()->id)->get();
            $projects = Project::where('employer_id',Auth::guard('employer')->user()->id)->get();
    
            return view('employer.project.index', compact('breadcrumbs', 'projects','branches','businesses'));
        }
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
            [(__('Projects')), route('employer.project.index')],
            [(__('Create')), null]
        ];
        //Employer $employer
        $branches=Branch::where('employer_id',Auth::guard('employer')->user()->id)->get();
        $businesses = EmployerBusiness::where('employer_id',Auth::guard('employer')->user()->id)->get();
        return view('employer.project.create', compact('breadcrumbs','branches','businesses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $request = $request->validated();
        $project = new Project();
        $project->name = $request['name'];
        $project->branch_id = $request['branch'];
        $project->business_id = $request['business'];
        $project->description = $request['description'];    
        $project->budget = $request['budget'];
        $project->start_date = $request['start_date'];
        $project->end_date = $request['end_date'];
        $project->employer_id = Auth::guard('employer')->user()->id;
        $issave = $project->save();
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
    public function edit(Project $project)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Projects')), route('employer.project.index')],
            [(__('Edit')), null]
        ];
        //Employer $employer
        $branches=Branch::where('employer_id',Auth::guard('employer')->user()->id)->get();
        $businesses = EmployerBusiness::where('employer_id',Auth::guard('employer')->user()->id)->get();
        return view('employer.project.edit', compact('breadcrumbs','project','branches','businesses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProjectRequest $request,Project $project)
    {
        $request = $request->validated();
        $project->name = $request['name'];
        $project->branch_id = $request['branch'];
        $project->business_id = $request['business'];
        $project->description = $request['description'];
        $project->budget = $request['budget'];
        $project->start_date = $request['start_date'];
        $project->end_date = $request['end_date'];
        $project->employer_id = Auth::guard('employer')->user()->id;

        $issave = $project->save();
        if($issave){
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->route('employer.project.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $res = $project->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
    public function changeStatus(Request $request)
    {
        $project = Project::find($request->project_id);
        $project->status = $request->status;
        $res = $project->save();
        return response()->json(['success' => 'Status change successfully.']);
    }
}

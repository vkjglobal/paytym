<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Department;
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
                [(__('Dashboard')), route('employer.project.index')],
                [(__('departments')), null],
            ];
            $branches = Branch::where('employer_id',Auth::guard('employer')->user()->id)->get();
            $departments = Department::where('employer_id',Auth::guard('employer')->user()->id)->get();
            $projects = Project::where('employer_id',Auth::guard('employer')->user()->id)->get();
    
            return view('employer.project.index', compact('breadcrumbs', 'projects','branches','departments'));
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
            [(__('Dashboard')), route('employer.project.create')],
            [(__('Create')), null]
        ];
        //Employer $employer
        $branches=Branch::where('employer_id',Auth::guard('employer')->user()->id)->get();
        $departments=Department::where('employer_id',Auth::guard('employer')->user()->id)->get();
        return view('employer.project.create', compact('breadcrumbs','branches','departments'));
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
        $project->department_id = $request['department'];
        $project->description = $request['description'];
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
            [(__('Dashboard')), route('employer.project.create')],
            [(__('Edit')), null]
        ];
        //Employer $employer
        $branches=Branch::where('employer_id',Auth::guard('employer')->user()->id)->get();
        $departments=Department::where('employer_id',Auth::guard('employer')->user()->id)->get();
        return view('employer.project.edit', compact('breadcrumbs','project','branches','departments'));
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
        $project->department_id = $request['department'];
        $project->description = $request['description'];
        $project->employer_id = Auth::guard('employer')->user()->id;
        $issave = $project->save();
        if($issave){
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
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
        //
    }
}

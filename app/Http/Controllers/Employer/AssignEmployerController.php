<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\EmployeeProject;
use Auth;

class AssignEmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Projects')), null],
        ];

        $assign_projects = EmployeeProject::where('employer_id',Auth::guard('employer')->user()->id)->get();
        return view('employer.project.assign_index', compact('breadcrumbs', 'assign_projects'));
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
                [(__('Projects')), route('employer.assign.index')],
                [(__('Assign Project')), null],
            ];
            $users = User::where('employer_id',Auth::guard('employer')->user()->id)->get();
            $projects = Project::where('employer_id',Auth::guard('employer')->user()->id)->get();
            return view('employer.project.assign_create', compact('breadcrumbs','users','projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $request->validate([
                'employee' => 'required',
                'project' => 'required',
        ]);
        $assign_project = new EmployeeProject();
        $assign_project->employee_id = $request['employee'];
        $assign_project->project_id = $request['project'];
        $assign_project->employer_id = Auth::guard('employer')->user()->id;
        $issave = $assign_project->save();
        if($issave){
            notify()->success(__('Assigned successfully'));
            } else {
                notify()->error(__('Failed to Assign. Please try again'));
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
        $assign_project= EmployeeProject::findOrFail($id);
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Projects')), route('employer.assign.index')],
            [(__('Edit')), null],
        ];
        $users = User::where('employer_id',Auth::guard('employer')->user()->id)->get();
        $projects = Project::where('employer_id',Auth::guard('employer')->user()->id)->get();
        return view('employer.project.assign_edit', compact('assign_project','breadcrumbs','users','projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,EmployeeProject $assign)
    {
        $request = $request->validate([
            'employee' => 'required',
            'project' => 'required',
    ]);
    $assign->employee_id = $request['employee'];
    $assign->project_id = $request['project'];
    $assign->employer_id = Auth::guard('employer')->user()->id;
    $issave = $assign->save();
    if($issave){
        notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->route('employer.assign.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = EmployeeProject::findOrfail($id);
        $res= $del->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }


    public function search(Request $request)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('List')), null],
        ];

        $searchTerm = $request->search;

        $assign_projects = EmployeeProject::when($searchTerm, function ($query) use ($searchTerm) {
            return $query->whereHas('project', function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            });
        })
        ->with(['user', 'project'])
        ->get();

        return view('employer.project.assign_index', compact('breadcrumbs','assign_projects', 'searchTerm'));
    }

}

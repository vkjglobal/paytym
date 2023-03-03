<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FileType;
use Auth;

class FileTypeController extends Controller
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
            [(__('File Types')), null],
        ];
        $employer = Auth::guard('employer')->id();
        $filetypes = FileType::where('employer_id',$employer)->get();

        return view('employer.filetype.index', compact('breadcrumbs', 'filetypes'));
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
        //Employer $employer
        return view('employer.filetype.create', compact('breadcrumbs'));
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
            'filetype' => 'required'
        ]);
        $filetype = new FileType();
        $filetype->file_type = $request['filetype'];
        $filetype->employer_id = Auth::guard('employer')->user()->id;
        $issave = $filetype->save();
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
    public function edit(FileType $file_type)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Edit')), null],
        ];  
        return view('employer.filetype.edit',compact('breadcrumbs','file_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,FileType $file_type)
    {
        $request = $request->validate([
            'filetype' => 'required'
        ]);
        $file_type->file_type = $request['filetype'];
        $file_type->employer_id = Auth::guard('employer')->user()->id;
        $issave = $file_type->save();
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
    public function destroy(FileType $file_type)
    {
        $res = $file_type->delete();
        if($res){
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();

    }
}

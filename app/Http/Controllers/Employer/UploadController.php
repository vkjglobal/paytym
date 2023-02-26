<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Upload;
use App\Models\User;
use App\Models\FileType;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Leave Requests')), null],
        ];
        $employer = Auth::guard('employer')->id();
        $employees = User::where('employer_id', $employer)->get();
        // $up = Upload::all();
        // $data = Upload::where();

        return view('employer.Uploads.index', compact('breadcrumbs', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->managefile;
        $ups = Upload::where('user_id', $id)->first();
        return view('employer.Uploads.add', compact('id', 'ups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'filetype' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx,jpeg,png',
            'employee_id' => 'required'
        ]);
        $upload = new Upload();
        
        $upload->user_id = $request->employee_id;
        $upload->employer_id = Auth::guard('employer')->id();  
        $upload->file_type_id = $request->filetype; 
        
        if ($request->hasFile('file')) {
            $path =  $request->file('file')->storeAs(  
                'uploads/employees',
                urlencode(time()) . '_' . uniqid() . '_' . $request->file->getClientOriginalName(),
                'public'
            );
            $upload->file = $path;
            $issave = $upload->save();
        if($issave){
            notify()->success(__('Created successfully'));
                } else {
            notify()->error(__('Failed to Create. Please try again'));
                }
        return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $ups = Upload::where('user_id',$id)->get();

        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Uploads')), null],
        ];

        return view('employer.uploads.show', compact('breadcrumbs', 'ups','id'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Edit')), null],
        ];
            $upload = Upload::findOrFail($id);
            $employee_id = $upload->user_id;
            $filetypes = FileType::get()->all();
            return view('employer.Uploads.edit',compact('breadcrumbs','employee_id','filetypes','upload'));

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
        $upload = Upload::findOrFail($id);
        $request->validate([
            'filetype' => 'required',
            'file' => 'file|mimes:pdf,doc,docx,jpeg,png',
            'employee_id' => 'required'
        ]);
        
        $upload->user_id = $request->employee_id;
        $upload->employer_id = Auth::guard('employer')->id();  
        $upload->file_type_id = $request->filetype; 
        $up = $upload->file; 
        
        if ($request->hasFile('file')) {
            if (Storage::exists('public/'. $up))  {
                $del=Storage::delete('public/'.$up);
               } 
            $path =  $request->file('file')->storeAs(  
                'uploads/employees',
                urlencode(time()) . '_' . uniqid() . '_' . $request->file->getClientOriginalName(),
                'public'
            );
            $upload->file = $path;
            $issave = $upload->save();
        if($issave){
            notify()->success(__('Updated successfully'));
                } else {
            notify()->error(__('Failed to Update. Please try again'));
                }
        return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $upload = Upload::findOrFail($id);
        $up=$upload->file;
        if (Storage::exists('public/'. $up))  {
            $del=Storage::delete('public/'.$up);
           } 
         $res = $upload->delete();
         if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }

    public function showCreateForm($id){
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Uploads')), null],
        ];
            $employee_id = $id;
            $filetypes = FileType::get()->all();
            return view('employer.Uploads.add',compact('breadcrumbs','employee_id','filetypes'));

    }

    public function download($id)
    {
        $file = Upload::findOrFail($id);
        $fileName =$file->file;
        $filePath = storage_path('app/public/' . $fileName);
        return response()->download($filePath);
        


     
    }
}

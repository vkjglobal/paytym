<?php

namespace App\Http\Controllers\Employer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Upload;
use App\Models\User;
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
        // $data = Upload::where();

        return view('employer.uploads.index', compact('breadcrumbs', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->managefile;
        return view('employer.uploads.add', compact('id'));
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
            'contract' => 'file',
            'employment' => 'file',
            'termination' => 'file',
        ]);
        $uploadid = $request->id;
        $res = Upload::where('id', $uploadid)->get();

        if(!$res){
        
        $user = new Upload();
        
        $user->user_id = $request->userid;
        $user->employer_id = Auth::guard('employer')->id();   
        
        if ($request->hasFile('contract')) {
            $path =  $request->file('contract')->storeAs(  
                'uploads/contract',
                urlencode(time()) . '_' . uniqid() . '_' . $request->contract->getClientOriginalName(),
                'public'
            );
            $user->contracts = $path;
        }
        if ($request->hasFile('employment')) {
            $path =  $request->file('employment')->storeAs(  
                'uploads/employment',
                urlencode(time()) . '_' . uniqid() . '_' . $request->employment->getClientOriginalName(),
                'public'
            );
            $user->employment_letter = $path;
        }
        if ($request->hasFile('termination')) {
            $path =  $request->file('termination')->storeAs(  
                'uploads/termination',
                urlencode(time()) . '_' . uniqid() . '_' . $request->termination->getClientOriginalName(),
                'public'
            );
            $user->termination_letter = $path;
        }
        $issave = $user->save();
        if($issave){
            notify()->success(__('Created successfully'));
                } else {
            notify()->error(__('Failed to Create. Please try again'));
                }
        return redirect()->back();
        }else{
            notify()->error(__('Failed to Create. The employee files already exists'));
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
        // $id = $id;
        // return view('employer.uploads.upload', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $file = Upload::where('user_id', $id)->get();
        return view('employer.uploads.edit', compact('file'));
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
        $request->validate([
            'contract' => 'file',
            'employment' => 'file',
            'termination' => 'file',
        ]);
        $user = Upload::where('user_id', $id)->first();

        // $user->user_id = $id;
        // $user->employer_id = Auth::guard('employer')->id(); 
        $contract = $user->contracts;
        $employment = $user->employment_letter;
        $termination = $user->termination_letter;


        if ($request->hasFile('contract')) {
            if (Storage::exists('public/'. $contract))  {
                $del=Storage::delete('public/'.$contract);
               
            } 
            $path =  $request->file('contract')->storeAs(  
                'uploads/contract',
                urlencode(time()) . '_' . uniqid() . '_' . $request->contract->getClientOriginalName(),
                'public'
            );
            $user->contracts = $path;
        }
        if ($request->hasFile('employment')) {
            if (Storage::exists('public/'. $employment))  {
                $del=Storage::delete('public/'.$employment);
               
            } 
            $path =  $request->file('employment')->storeAs(  
                'uploads/employment',
                urlencode(time()) . '_' . uniqid() . '_' . $request->employment->getClientOriginalName(),
                'public'
            );
            $user->employment_letter = $path;
        }
        if ($request->hasFile('termination')) {
            if (Storage::exists('public/'. $termination))  {
                $del=Storage::delete('public/'.$termination);
               
            } 
            $path =  $request->file('termination')->storeAs(  
                'uploads/termination',
                urlencode(time()) . '_' . uniqid() . '_' . $request->termination->getClientOriginalName(),
                'public'
            );
            $user->termination_letter = $path;
        }
        
        // if ($request->hasFile('contract')) {
        //     $path =  $request->file('contract')->storeAs(  
        //         'uploads/contract',
        //         urlencode(time()) . '_' . uniqid() . '_' . $request->contract->getClientOriginalName(),
        //         'public'
        //     );
        //     $user->contracts = $path;
        // }
        // if ($request->hasFile('employment')) {
        //     $path =  $request->file('employment')->storeAs(  
        //         'uploads/employment',
        //         urlencode(time()) . '_' . uniqid() . '_' . $request->employment->getClientOriginalName(),
        //         'public'
        //     );
        //     $user->employment_letter = $path;
        // }
        // if ($request->hasFile('termination')) {
        //     $path =  $request->file('termination')->storeAs(  
        //         'uploads/termination',
        //         urlencode(time()) . '_' . uniqid() . '_' . $request->termination->getClientOriginalName(),
        //         'public'
        //     );
        //     $user->termination_letter = $path;
        // }
        $issave = $user->save();
        if($issave){
            notify()->success(__('Created successfully'));
                } else {
            notify()->error(__('Failed to Create. Please try again'));
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

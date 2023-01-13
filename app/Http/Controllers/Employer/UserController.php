<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Employer\StoreUserRequest;
use App\Http\Requests\Employer\UpdateUserRequest;
use App\Models\User;
use App\Models\Branch;
use App\Models\Employer;
use App\Models\Role;
use Auth,Hash;


class UserController extends Controller
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
                [(__('Dashboard')), route('employer.user.index')],
                [(__('Users')), null],
            ];
    
            $users = User::where('employer_id',Auth::guard('employer')->user()->id)->get();
    
            return view('employer.user.index', compact('breadcrumbs', 'users'));
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
            [(__('Dashboard')), route('employer.user.create')],
            [(__('Users')), null],
        ];
        $branches = Branch::where('employer_id',Auth::guard('employer')->user()->id)->get();
        $roles = Role::get();
        return view('employer.user.create',compact('breadcrumbs','branches','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request, User $user)
    {
     $user = new User(); 
     $validated = $request->validated();
     $user->employer_id = Auth::guard('employer')->user()->id;
     $user->company = Auth::guard('employer')->user()->company;
     $user->branch= $validated['branch'];
     $user->first_name = $validated['first_name'];
     $user->last_name = $validated['last_name'];
     $user->email = $validated['email'];
     $user->branch = $validated['branch'];
     $user->country = $validated['country'];
     $user->position = $validated['position'];
     $user->phone = $validated['phone'];
     $user->date_of_birth = $validated['date_of_birth'];
     $user->street = $validated['street'];
     $user->town = $validated['town'];
     $user->postcode = $validated['postcode'];
     $user->tin = $validated['tin'];
     $user->fnpf = $validated['fnpf'];
     $user->bank = $validated['bank'];
     $user->city = $validated['city'];
     $user->account_number = $validated['account_number'];
     $user->password = Hash::make($validated['password']);

     if ($request->hasFile('image')) {
        $path =  $request->file('image')->storeAs(  
            'uploads/users',
            urlencode(time()) . '_' . uniqid() . '_' . $request->image->getClientOriginalName(),
            'public'
        );
        $user->image = $path;
    }
    $issave = $user->save();
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
    public function edit(User $user)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.branch.create')],
            [(__('Branch')), null],
        ];
        $roles = Role::get();
        $branches=Branch::where('employer_id',Auth::guard('employer')->user()->id)->get();
        return view('employer.user.edit',compact('breadcrumbs','user','branches','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request,User $user)
    {
        $validated = $request->validated();
        //  dd($validated);
         $user->employer_id = Auth::guard('employer')->user()->id;
         $user->company = Auth::guard('employer')->user()->company;
         $user->branch= $validated['branch'];
         $user->first_name = $validated['first_name'];
         $user->last_name = $validated['last_name'];
         $user->email = $validated['email'];
         $user->branch = $validated['branch'];
         $user->country = $validated['country'];
         $user->position = $validated['position'];
         $user->phone = $validated['phone'];
         $user->date_of_birth = $validated['date_of_birth'];
         $user->street = $validated['street'];
         $user->town = $validated['town'];
         $user->postcode = $validated['postcode'];
         $user->tin = $validated['tin'];
         $user->fnpf = $validated['fnpf'];
         $user->bank = $validated['bank'];
         $user->city = $validated['city'];
         $user->account_number = $validated['account_number'];
         $user->password = Hash::make($validated['password']);
    
         if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs(  
                'uploads/users',
                urlencode(time()) . '_' . uniqid() . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $user->image = $path;
        }
        $issave = $user->save();
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
    public function destroy(User $user)
    {
        $res = $user->delete();
    
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }


    //Change Employer Status
    public function changeStatus(Request $request){
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $res= $user->save();
        if($res){
        return response()->json(['success' => 'Status change successfully.']);
        }
    }
}

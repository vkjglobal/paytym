<?php

namespace App\Http\Controllers\Employer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\branch\StoreBranchRequest;
use App\Http\Requests\branch\UpdateBranchRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Branch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(){
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.branch.create')],
            [(__('Branch')), null],
        ];

        $admin = Auth::guard('employer')->user();
        return view('employer.branch.index', compact('breadcrumbs', 'admin'));
    }

    public function list(){
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.branch.list')],
            [(__('Branch')), null],
        ];

        $branches = Branch::latest()->get();
        return view('employer.branch.list_view', compact('breadcrumbs', 'branches'));
    }

        public function store(StoreBranchRequest $request)
        {
            $validated = $request->validated();
    
    
            $branch = new Branch();
            $branch->name = $validated['name'];
            $branch->city = $validated['city'];
            $branch->town = $validated['town'];
            $branch->postcode = $validated['postcode'];
            $branch->country = $validated['country'];
            $branch->bank = $validated['bank'];
            $branch->account_number = $validated['account_number'];
            // $branch->postcode = $validated['qr_code'];
    
            if ($request->hasFile('qr_code')) {
                $path =  $request->file('qr_code')->storeAs(
                    'uploads/branch',
                    urlencode(time()) . '_' . uniqid() . '_' . $request->qr_code->getClientOriginalName(),
                    'public'
                );
                $branch->qr_code = $path;
            }
    
    
            $res = $branch->save();
    
            if ($res) {
                notify()->success(__('Created successfully'));
            } else {
                notify()->error(__('Failed to Create. Please try again'));
            }
            return redirect()->back();
        }

        //edit

        public function edit($id){
            $breadcrumbs = [
                [(__('Dashboard')), route('employer.branch.create')],
                [(__('Branch')), null],
            ];
            $branch = Branch::findOrFail($id);   
            return view('employer.branch.edit',compact('breadcrumbs','branch'));
        
        }

        //update
        public function update(UpdateBranchRequest $request, Branch $branch){
            $validated = $request->validated();
    
    
            $branch = new Branch();
            $branch->name = $validated['name'];
            $branch->city = $validated['city'];
            $branch->town = $validated['town'];
            $branch->postcode = $validated['postcode'];
            $branch->country = $validated['country'];
            $branch->bank = $validated['bank'];
            $branch->account_number = $validated['account_number'];
    
            if ($request->hasFile('qr_code')) {
                $path =  $request->file('qr_code')->storeAs(
                    'uploads/branch',
                    urlencode(time()) . '_' . uniqid() . '_' . $request->qr_code->getClientOriginalName(),
                    'public'
                );

                
                $branch->qr_code = $path;
            }
    
    
            $res = $branch->save();
    
            if ($res) {
                notify()->success(__('Updated successfully'));
            } else {
                notify()->error(__('Failed to Update. Please try again'));
            }
            return redirect()->back();
        }


    


        //Destroy 
        
        public function destroy($id)
        {
            $res = Branch::findOrFail($id)->delete();
    
            if ($res) {
                notify()->success(__('Deleted successfully'));
            } else {
                notify()->error(__('Failed to Delete. Please try again'));
            }
            return redirect()->back();
        }


        // Change Employer Status
    public function changeStatus(Request $request)
    {
        $branch = Branch::find($request->branch_id);
        $branch->status = $request->status;
        $res=$branch->save();
        if($res){
        return response()->json(['success' => 'Status change successfully.']);
        }
    }
    
    }



<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BankStoreRequest;
use App\Models\BankModel;
use App\Models\Country;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Bank')), null],
        ];

        $bank = BankModel::with('country')->get();
        return view('admin.bank.index', compact('breadcrumbs', 'bank'));
    }

    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Bank')), null],
        ];

        $countries = Country::get();
        return view('admin.bank.create', compact('breadcrumbs', 'countries'));
    }


    public function store(BankStoreRequest $request)
    {
        $validated = $request->validated();
        $bank = new BankModel();
        $bank->country_id = $validated['country_id'];
        $bank->bank_name = $validated['bank_name'];
        $bank->address = $validated['address'];
        $bank->other_bank_code = $validated['bank_code'];
        $bank->branch_code = $validated['branch_code'];



        // if ($request->hasFile('bank_template')) {
        //     $imagePath = $request->file('bank_template')->store('images', 'public'); // 'public' is the disk name, 'images' is the folder
        //     $bank->template = $imagePath;
        // }
        




        if ($request->hasFile('bank_template')) {
            // Get the uploaded file
            $image = $request->file('bank_template');
    
            // Generate a unique filename for the image
            $filename = time() . '_' . $image->getClientOriginalName();
    
            // Define the storage path for the image
            $storagePath = 'uploads/bank_template';
    
            // Move the uploaded file to the storage location
            $image->move(public_path($storagePath), $filename);
            $bank->template = $filename;
            }

        $issave = $bank->save();
        if ($issave) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->back();
    }


    public function edit($id)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Banks')), null],
        ];
        $bank = BankModel::find($id);
        $countries = Country::get();
        return view('admin.bank.edit', compact('breadcrumbs', 'bank', 'countries'));
    }
}

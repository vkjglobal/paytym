<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEmployerRequest;
use App\Http\Requests\Admin\UpdateEmployerRequest;
use App\Models\Employer;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployerController extends Controller
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
            [(__('Employers')), null],
        ];

        //$employers = Employer::latest()->get();
        $employers = Employer::with('country')->latest()->get();
        return view('admin.employers.index', compact('breadcrumbs', 'employers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Employers')), route('admin.employers.index')],
            [(__('Create')), null]
        ];
        $country = Country::get();
        //dd($country);

        return view('admin.employers.create', compact('breadcrumbs','country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployerRequest $request)
    {
        $validated = $request->validated();


        $employer = new Employer();
        $employer->company = $validated['company'];
        $employer->name = $validated['name'];
        $employer->email = $validated['email'];
        $employer->password = Hash::make($employer->email);
        $employer->phone = $validated['phone'];
        $employer->company_phone = $validated['company_phone'];
        $employer->street = $validated['street'];
        $employer->city = $validated['city'];
        $employer->postcode = $validated['postcode'];
        $employer->country_id = $validated['country'];
        $employer->tin = $validated['tin'];
        $employer->website = $validated['website'];

        if ($request->hasFile('registration_certificate')) {
            $path =  $request->file('registration_certificate')->storeAs(
                'uploads/employers',
                urlencode(time()) . '_' . uniqid() . '_' . $request->registration_certificate->getClientOriginalName(),
                'public'
            );
            $employer->registration_certificate = $path;
        }

        if ($request->hasFile('tin_letter')) {
            $path =  $request->file('tin_letter')->storeAs(
                'uploads/employers',
                urlencode(time()) . '_' . uniqid() . '_' . $request->tin_letter->getClientOriginalName(),
                'public'
            );
            $employer->tin_letter = $path;
        }

        if ($request->hasFile('logo')) {
            $path =  $request->file('logo')->storeAs(
                'uploads/employers',
                urlencode(time()) . '_' . uniqid() . '_' . $request->logo->getClientOriginalName(),
                'public'
            );
            $employer->logo = $path;
        }

        $res = $employer->save();

        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit(Employer $employer)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Employers')), route('admin.employers.index')],
            [(__('Edit')), null]
        ];
        $country = Country::get();
        return view('admin.employers.edit', compact('breadcrumbs', 'employer','country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployerRequest $request, Employer $employer)
    {
        $validated = $request->validated();

        $employer->company = $validated['company'];
        $employer->name = $validated['name'];
        $employer->email = $validated['email'];
        $employer->phone = $validated['phone'];
        $employer->company_phone = $validated['company_phone'];
        $employer->street = $validated['street'];
        $employer->city = $validated['city'];
        $employer->postcode = $validated['postcode'];
        $employer->country_id = $validated['country'];
        $employer->tin = $validated['tin'];
        $employer->website = $validated['website'];
        $registration_certificate = $employer->registration_certificate;
        $tin_letter = $employer->tin_letter;
        $logo = $employer->logo;

        if ($request->hasFile('registration_certificate')) {
            $path =  $request->file('registration_certificate')->storeAs(
                'uploads/employers',
                urlencode(time()) . '_' . uniqid() . '_' . $request->registration_certificate->getClientOriginalName(),
                'public'
            );

            if (Storage::exists('public/'. $registration_certificate))  {
                $del=Storage::delete('public/'.$registration_certificate);
               
            } 
            $employer->registration_certificate = $path;
        }

        if ($request->hasFile('tin_letter')) {
            $path =  $request->file('tin_letter')->storeAs(
                'uploads/employers',
                urlencode(time()) . '_' . uniqid() . '_' . $request->tin_letter->getClientOriginalName(),
                'public'
            );

            if (Storage::exists('public/'. $tin_letter))  {
                $del=Storage::delete('public/'.$tin_letter);
               
            } 
            $employer->tin_letter = $path;
        }

        if ($request->hasFile('logo')) {
            $path =  $request->file('logo')->storeAs(
                'uploads/employers',
                urlencode(time()) . '_' . uniqid() . '_' . $request->logo->getClientOriginalName(),
                'public'
            );

            if (Storage::exists('public/'. $logo))  {
                $del=Storage::delete('public/'.$logo);
               
            } 
            $employer->logo = $path;
        }
//dd($employer);
        $res = $employer->save();

        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employer $employer)
    {
        $res = $employer->delete();

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
        $employer = Employer::find($request->employer_id);
        $employer->status = $request->status;
        $employer->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}

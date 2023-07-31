<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreCountryRequest;
use App\Models\Country;

class CountryController extends Controller
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
            [(__('Country')), null],
        ];
        $countries = Country::get();
        return view('admin.country.index', compact('breadcrumbs', 'countries'));
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
            [(__('Country')), null],
        ];
        return view('admin.country.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountryRequest $request)
    {
        $request = $request->validated();
        $country = new Country;
        $country->name = $request['name'];
        $country->currency = $request['currency'];
        $country->tax = $request['tax'];
        $country->srt_tax = $request['srt'];
        $country->ecal_tax = $request['ecal'];
        $country->fnpf = $request['fnpf'];
        $res = $country->save();
        if($res){
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
    public function edit(Country $country)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Country')), null],
        ];
        return view('admin.country.edit', compact('breadcrumbs','country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCountryRequest $request, Country $country)
    {
        $request = $request->validated();
        $country->name = $request['name'];
        $country->currency = $request['currency'];
        $country->tax = $request['tax'];
        $country->srt_tax = $request['srt'];
        $country->ecal_tax = $request['ecal'];
        $country->fnpf = $request['fnpf'];
        $res = $country->save();
        if($res){
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
    public function destroy(Country $country)
    {
        $res = $country->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();

    }
}

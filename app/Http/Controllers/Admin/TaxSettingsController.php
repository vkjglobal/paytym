<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCountryRequest;
use App\Http\Requests\StoreTaxSettingsRequest;
use App\Models\Country;
use App\Models\TaxSettings;
use Illuminate\Http\Request;

class TaxSettingsController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('TaxSettings')), null],
        ];
        $tax_settings = TaxSettings::with('country')->get();

        return view('admin.tax_settings.index', compact('breadcrumbs', 'tax_settings'));
    }

    //Create
    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('TaxSettings')), null],
        ];
        $countries = Country::get();
        return view('admin.tax_settings.create', compact('breadcrumbs', 'countries'));
    }

    //store
    public function store(StoreTaxSettingsRequest $request)
    {
        $request = $request->validated();
        $tax_settings = new TaxSettings();
        $tax_settings->country_id = $request['country_id'];
        $tax_settings->annualincome_from = $request['annual_income_from'];
        $tax_settings->annualincome_to = $request['annual_income_to'];
        $tax_settings->income_tax_rate = $request['income_tax_rate'];
        $tax_settings->income_tax_value = $request['income_tax_value'];
        $tax_settings->srt_tax = $request['srt_tax'];
        $tax_settings->srt_value = $request['srt_value'];
        $res = $tax_settings->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->back();
    }



    //Edit
    public function edit($id)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Tax Settings')), null],
        ];
        $tax = TaxSettings::find($id)->first();
        $countries = Country::get();
        return view('admin.tax_settings.edit', compact('breadcrumbs', 'tax', 'countries'));
    }


    public function update(StoreTaxSettingsRequest $request, $id)
    {
        $request = $request->validated();
        $tax_settings = TaxSettings::find($id)->first();
        $tax_settings->country_id = $request['country_id'];
        $tax_settings->annualincome_from = $request['annual_income_from'];
        $tax_settings->annualincome_to = $request['annual_income_to'];
        $tax_settings->income_tax_rate = $request['income_tax_rate'];
        $tax_settings->income_tax_value = $request['income_tax_value'];
        $tax_settings->srt_tax = $request['srt_tax'];
        $tax_settings->srt_value = $request['srt_value'];

        $res = $tax_settings->save();
        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->back();
    }


    //destroy
    public function destroy(TaxSettings $tax)
    {
        $res = $tax->delete();
        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}

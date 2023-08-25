<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaxSettingsSrtRequest;
use App\Models\Country;
use App\Models\TaxSettingsSrtModel;
use Illuminate\Http\Request;

class TaxSettingsSrtController extends Controller
{

    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('TaxSettings- SRT')), null],
        ];
        $tax_settings = TaxSettingsSrtModel::with('country')->get();
        return view('admin.tax_settings_srt.index', compact('breadcrumbs', 'tax_settings'));
    }


        //Create
        public function create()
        {
            $breadcrumbs = [
                [(__('Dashboard')), route('admin.home')],
                [(__('TaxSettings- SRT')), null],
            ];
            $countries = Country::get();
            return view('admin.tax_settings_srt.create', compact('breadcrumbs', 'countries'));
        }

        //
         //store
    public function store(StoreTaxSettingsSrtRequest $request)
    {
        $request = $request->validated();
        $tax_settings = new TaxSettingsSrtModel();
        $tax_settings->country_id = $request['country_id'];
        $tax_settings->annualincome_from = $request['annual_income_from'];
        $tax_settings->annualincome_to = $request['annual_income_to'];
        $tax_settings->srt_tax = $request['srt_tax'];
        $tax_settings->srt_value = $request['srt_value'];
        $res = $tax_settings->save();
        if ($res) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        //return redirect()->back();
        return redirect()->route('admin.tax_settings_srt.index');
    }


        //Edit
        public function edit($id)
        {
            $breadcrumbs = [
                [(__('Dashboard')), route('admin.home')],
                [(__('Tax Settings')), null],
            ];
            $tax = TaxSettingsSrtModel::find($id);
            $countries = Country::get();
            return view('admin.tax_settings_srt.edit', compact('breadcrumbs', 'tax', 'countries'));
        }
    
    
        public function update(StoreTaxSettingsSrtRequest $request, $id)
        {
            $request = $request->validated();
            $tax_settings = TaxSettingsSrtModel::find($id)->first();
            $tax_settings->country_id = $request['country_id'];
            $tax_settings->annualincome_from = $request['annual_income_from'];
            $tax_settings->annualincome_to = $request['annual_income_to'];
            $tax_settings->srt_tax = $request['srt_tax'];
            $tax_settings->srt_value = $request['srt_value'];
            $res = $tax_settings->save();
            if ($res) {
                notify()->success(__('Updated successfully'));
            } else {
                notify()->error(__('Failed to Update. Please try again'));
            }
            //return redirect()->back();
            return redirect()->route('admin.tax_settings_srt.index');
        }
    
    
        //destroy
        public function destroy($id)
        {
            $tax=TaxSettingsSrtModel::find($id);
            $res = $tax->delete();
            if ($res) {
                notify()->success(__('Deleted successfully'));
            } else {
                notify()->error(__('Failed to Delete. Please try again'));
            }
            return redirect()->back();
        }
    
}

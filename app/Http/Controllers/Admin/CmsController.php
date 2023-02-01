<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\UpdateCmsRequest;
use App\Http\Requests\Admin\StoreCmsRequest;
use App\Http\Controllers\Controller;
use App\Models\Cms;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('CMS')), null],
        ];
        $cms = Cms::get();
        return view('admin.cms.index', compact('breadcrumbs', 'cms'));
    }

    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Cms')), route('admin.cms.index')],
            [(__('Create')), null]
        ];
        return view('admin.cms.create', compact('breadcrumbs'));
    }

    public function store(StoreCmsRequest $request)
    {
        $validated = $request->validated();

        $cms = new CMS();
        $cms->cms_type = $validated['cms_type'];
        $cms->content = $validated['content'];
       
        $issave = $cms->save();
        if ($issave) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->back();
    }

    public function edit(Cms $cm)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Cms')), route('admin.cms.index')],
            [(__('Edit')), null]
        ];
        //dd($cm);
        return view('admin.cms.edit', compact('breadcrumbs', 'cm'));
    }

    public function update(UpdateCmsRequest $request, Cms $cm)
    {
        //dd($cm);
        $validated = $request->validated();
        $cm->cms_type = $validated['cms_type'];
        $cm->content = $validated['content'];
       
        $issave = $cm->save();
        if ($issave) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->back();

    }
 
   
    public function destroy(Cms $cm)
    {
        
        //dd($cms);
        $res = $cm->delete();

        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $cms = Cms::find($request->cms_id);
        
        $cms->status = $request->status;
        $cms->save();
        return response()->json(['success' => 'Status change successfully.']);
    }

    
}

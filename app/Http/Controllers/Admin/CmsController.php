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
        //   dd($request->get('person_name'));
        $cms = new CMS();
        $cms->cms_type = $validated['cms_type'];
        $cms->content = $validated['content'];

        if ($request->hasFile('img')) {
        // Get the uploaded file
        $image = $request->file('img');

        // Generate a unique filename for the image
        $filename = time() . '_' . $image->getClientOriginalName();

        // Define the storage path for the image
        $storagePath = 'uploads/cms';

        // Move the uploaded file to the storage location
        $image->move(public_path($storagePath), $filename);
        $cms->img = $filename;
        }


        // if ($request->hasFile('img')) {
        //     $path =  $request->file('img')->storeAs(
        //         'uploads/cms',
        //         urlencode(time()) . '_' . uniqid() . '_' . $request->img->getClientOriginalName(),
        //         'public'
        //     );
        //     $cms->img = $path;
        // }
        if ($request->get('person_name')) {
            $cms->content1 = $request->get('person_name');
        }

        if ($request->get('company_name')) {
            $cms->content2 = $request->get('company_name');
        }

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
        if ($request->get('person_name')) {
            $cm->content1 = $request->get('person_name');
        }

        if ($request->get('company_name')) {
            $cm->content2 = $request->get('company_name');
        }
        if ($request->hasFile('img')) {
            // Get the uploaded file
            $image = $request->file('img');
    
            // Generate a unique filename for the image
            $filename = time() . '_' . $image->getClientOriginalName();
    
            // Define the storage path for the image
            $storagePath = 'uploads/cms';
    
            // Move the uploaded file to the storage location
            $image->move(public_path($storagePath), $filename);
            $cm->img = $filename;
            }
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

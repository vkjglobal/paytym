<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\StoreBannerRequest;
use App\Http\Requests\Admin\UpdateBannerRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Banner;

use Illuminate\Http\Request;

class BannerController extends Controller
{
    //
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Banner')), null],
        ];
        $banner = Banner::get();
        return view('admin.banners.index', compact('breadcrumbs', 'banner'));
    }

    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Banner')), route('admin.banner.index')],
            [(__('Create')), null]
        ];
        return view('admin.banners.create', compact('breadcrumbs'));
    }

    public function store(StoreBannerRequest $request)
    {
        $validated = $request->validated();

        $banner = new Banner();
        $banner->name = $validated['name'];
        //$banner->image = $validated['image'];
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs(
                'uploads/banners',
                urlencode(time()) . '_' . uniqid() . '_' . $request->image->getClientOriginalName(),
                'public'
            );
            $banner->image = $path;
        }
       
        $issave = $banner->save();
        if ($issave) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->back();
    }

    public function edit(Banner $banner)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Banner')), route('admin.banner.index')],
            [(__('Edit')), null]
        ];
        //dd($banner);

        return view('admin.banners.edit', compact('breadcrumbs', 'banner'));
    }

    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $validated = $request->validated();
        $banner->name = $validated['name'];
        $image = $banner->image;
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->storeAs(
                'uploads/banners',
                urlencode(time()) . '_' . uniqid() . '_' . $request->image->getClientOriginalName(),
                'public'
            );

            if (Storage::exists('public/'. $image))  {
                $del=Storage::delete('public/'.$image);
               
            } 
            $banner->image = $path;
            dd($banner);
        }
        $res = $banner->save();

        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->back();

    }
    public function destroy(Banner $banner)
    {
        $res = $banner->delete();

        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
    public function changeStatus(Request $request)
    {
        $banner = Banner::find($request->banner_id);
        $banner->status = $request->status;
        $banner->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

}

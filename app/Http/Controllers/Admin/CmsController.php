<?php

namespace App\Http\Controllers\Admin;

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

    
}

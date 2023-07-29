<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmployerBusiness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BusinessController extends Controller
{
    public function get_business()
    {

        $businesses = EmployerBusiness::where('employer_id', Auth::user()->employer_id)->get();
        if ($businesses) {
            return response()->json([
                'message' => "Business Details Listed Below",
                'businesses' => $businesses,
            ], 200);
        } else {
            return response()->json([
                'message' => "No Business found. Please check business is created or not"
            ], 200);
        }
    }


}

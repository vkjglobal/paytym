<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\CreditCard;
use Illuminate\Http\Request;
use Auth;

class CardController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.invoice.index')],
            [(__('Invoice')), null],
        ];
  
        $card = CreditCard::where('employer_id', Auth::guard('employer')->user()->id)->get();
        return view('employer.card.index', compact('breadcrumbs', 'card'));
    }
}

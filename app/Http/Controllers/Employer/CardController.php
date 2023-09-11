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
            [(__('Dashboard')), route('employer.cards.index')],
            [(__('Cards')), null],
        ];
  
        $card = CreditCard::where('employer_id', Auth::guard('employer')->user()->id)->get();
        return view('employer.card.index', compact('breadcrumbs', 'card'));
    }

    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Cards')), route('employer.cards.index')],
            [(__('Create')), null]
        ];
        //Employer $employer
        $employer = Auth::guard('employer')->user()->id;
        return view('employer.card.create', compact('breadcrumbs', 'employer'));
    }
}

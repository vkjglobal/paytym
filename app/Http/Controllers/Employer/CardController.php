<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employer\StoreCreditcardRequest;
use App\Models\CreditCard;
use Illuminate\Http\Request;
use Auth;
use Validator;

class CardController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.cards.index')],
            [(__('Cards')), null],
        ];
  
        $card = CreditCard::where('employer_id', Auth::guard('employer')->user()->id)->first();
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

    public function store(StoreCreditcardRequest $request)
    {
        //dd('11');
        $validated = $request->validated();
        $cards = CreditCard::where('primary_card_number', '!=', null)->first();//CreditCard::get();
        //return $cards;
        if(!$cards)
        {
            $card = new CreditCard;
            $card->primary_card_number = $validated['primary_card_number'];
            $card->primary_name_on_card = $validated['primary_name_on_card'];
            $card->primary_expiry_date = $validated['primary_expiry_date'];
            //$card->primary_is_default = $validated['primary_is_default'];

            $card->secondary_card_number = $validated['secondary_card_number'];
            $card->secondary_name_on_card = $validated['secondary_name_on_card'];
            $card->secondary_expiry_date = $validated['secondary_expiry_date'];
            //$card->secondary_is_default = $validated['secondary_is_default'];

            $card->employer_id = Auth::guard('employer')->user()->id;
            if ($request->input('default_card_type') === 'primary') {
                $card->primary_is_default = 1;
            } elseif ($request->input('default_card_type') === 'secondary') {
                $card->secondary_is_default = 1;
            }

            $res = $card->save();
            if ($res) {
                notify()->success(__('Created successfully'));
            } else {
                notify()->error(__('Failed to Create. Please try again'));
            }
            return redirect()->route('employer.cards.index');
    }
    else
    {
        return redirect()->back();
    }

    }

    public function edit(CreditCard $card)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Cards')), route('employer.cards.index')],
            [(__('Create')), null]
        ];
        //Employer $employer
        return view('employer.card.edit', compact('breadcrumbs', 'card'));
    }

    public function update(StoreCreditcardRequest $request, CreditCard $card)
    {
       //dd($request)->all();
        $request = $request->validated();
        $card->primary_card_number = $request['primary_card_number'];
        $card->primary_name_on_card = $request['primary_name_on_card'];
        $card->primary_expiry_date = $request['primary_expiry_date'];

        $card->secondary_card_number = $request['secondary_card_number'];
        $card->secondary_name_on_card = $request['secondary_name_on_card'];
        $card->secondary_expiry_date = $request['secondary_expiry_date'];
        
        $card->employer_id = Auth::guard('employer')->user()->id;
        if (isset($request['default_card_type'])) { 
            if ($request['default_card_type'] === 'primary') {
                $card->primary_is_default = 1;
                $card->secondary_is_default = 0; // Ensure the secondary is not set as default
            } elseif ($request['default_card_type'] === 'secondary') {
                $card->secondary_is_default = 1;
                $card->primary_is_default = 0; // Ensure the primary is not set as default
            }
        }
        /*if ($request['default_card_type'] == 'primary'){
            $card->primary_is_default = 1;
            $card->secondary_is_default = 0; // Ensure the secondary is not set as default
        } elseif ($request->default_card_type == 'secondary') {
            $card->secondary_is_default = 1;
            $card->primary_is_default = 0; // Ensure the primary is not set as default
        }*/
    
    
    

        //$card->primary_is_default = $request['primary_is_default'];
        //$card->secondary_is_default = $request['secondary_is_default'];
         

        $res=$card->save();


       /*  $request = $request->validated();
        $billingemail->name = $request['name'];
        $billingemail->email = $request['email'];
        $billingemail->employer_id = Auth::guard('employer')->user()->id;
        $res = $billingemail->save(); */
        if ($res) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->route('employer.cards.index');
    }



}

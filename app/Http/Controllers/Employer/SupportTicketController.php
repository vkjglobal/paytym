<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Http\Requests\Employer\UpdateSupportTicketRequest;
use App\Http\Requests\Employer\StoreSupportTicketRequest;
use Illuminate\Http\Request;
use Auth;

class SupportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Support Tickets')), null],
        ];

        $supportTicket = SupportTicket::where('employer_id',Auth::guard('employer')->user()->id)->get();
        // dd($leaveRequests);
        return view('employer.support-tickets.index', compact('breadcrumbs', 'supportTicket'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Support Tickets')), route('employer.supportticket.index')],
            [(__('Create')), null]
        ];
        return view('employer.support-tickets.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupportTicketRequest $request)
    {
        $validated = $request->validated();

        $supportTicket = new SupportTicket();
        $supportTicket->subject = $validated['subject'];
        $supportTicket->message = $validated['message'];
        $supportTicket->employer_id = Auth::guard('employer')->user()->id;
        $issave = $supportTicket->save();
        if ($issave) {
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function show(SupportTicket $supportTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function edit(SupportTicket $supportticket)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.home')],
            [(__('Support Ticket')), route('employer.supportticket.index')],
            [(__('Edit')), null]
        ];
        //dd($supportticket);
        return view('employer.support-tickets.edit', compact('breadcrumbs', 'supportticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupportTicketRequest $request, SupportTicket $supportticket)
    {
        $validated = $request->validated();
        $supportticket->subject = $validated['subject'];
        $supportticket->message = $validated['message'];
        $supportticket->employer_id = Auth::guard('employer')->user()->id;
        //dd($supportticket);
        $issave = $supportticket->save();
        if ($issave) {
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->route('employer.supportticket.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupportTicket $supportticket)
    {
        $res = $supportticket->delete();

        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
    public function changeStatus(Request $request)
    {
        $supportticket = SupportTicket::find($request->supportticket_id);
        $supportticket->status = $request->status;
        $supportticket->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
    
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
class SupportTicketController extends Controller
{
    //
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Support Ticket')), null],
        ];

       // $supportTicket = SupportTicket::latest()->get();
        $supportTicket = SupportTicket::with('employer')->latest()->get();
        return view('admin.support-tickets.index', compact('breadcrumbs', 'supportTicket'));
    }

    public function destroy(SupportTicket $supportTicket)
    {
        //dd($supportTicket);
        $res = $supportTicket->delete();

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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Notifications\AdminContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class ContactController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('admin.home')],
            [(__('Contacts')), null],
        ];

        $contacts = Contact::latest()->get();
        return view('admin.contacts.index', compact('breadcrumbs', 'contacts'));
    }

    public function sendReply(Request $request)
    {
        $validated = $request->validate([
            'reply_message' => 'required'
        ]);

        FacadesNotification::route('mail', $request->email)->notify(new AdminContact($validated));

        notify()->success(__('Reply send successfully'));
        return redirect()->back();
    }

    public function destroy($id)
    {
        $contact = Contact::where('id', $id)->firstorFail();
        $res = $contact->delete();

        if ($res) {
            notify()->success(__('Deleted successfully'));
        } else {
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}

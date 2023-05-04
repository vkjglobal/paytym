<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Notifications\AdminContact;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ContactRequest;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Mail;

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

    public function store(Request $request){
        
         try{
            Mail::send('mail.send-contactusmsg',
             array(
                 'name' => $request->get('name'),
                 'email' => $request->get('email'),
                 'msg' => $request->get('message'),
             ), function($msg) use ($request)
               {
                  $msg->from($request->email);
                  $msg->to('buzzmefiji@gmail.com');
                  $msg->subject('New Customer Enquiry');
               });
         } catch (TransportExceptionInterface $e){
            return redirect()->back()->with('error', 'Error Occured');
        }
        $result = Contact::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'message' => $request['message']
        ]);
        if ($result) {
            return redirect()->back()->with('success', 'Send successfully!');

        } else {
            return redirect()->back()->with('error', 'Error Occured');

        }
       
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

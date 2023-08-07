<?php

namespace App\Http\Controllers\Employer;
use App\Models\Meeting;
use App\Models\User;
use App\Models\MeetingAttendees;
use App\Models\Employer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employer\StoreMeetingRequest;
use App\Http\Requests\Employer\UpdateMeetingRequest;
use symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Illuminate\Http\Request;
use Auth;

class MeetingController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.meeting.index')],
            [(__('List')), null]
        ];
        $meetings = Meeting::where('employer_id', Auth::guard('employer')->user()->id)->latest()->get();
        return view('employer.meeting.index', compact('breadcrumbs','meetings'));
    }
    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.meeting.create')],
            [(__('Create')), null]
        ];
        
        $employees = User::select('id','first_name')->where('employer_id',Auth::guard('employer')->user()->id)->where('status',1)->get();
        return view('employer.meeting.create', compact('breadcrumbs','employees'));
    }
    public function store(StoreMeetingRequest $request)
    {
        $request = $request->validated();
        $meeting = new Meeting();
        $meeting->employer_id = Auth::guard('employer')->user()->id;
        //$meeting->user_id = User::where('employer_id',Auth::guard('employer')->user()->id)->first()->id;
        $meeting->name = $request['name'];
        $meeting->date = $request['date'];
        $meeting->start_time = $request['start_time'];
        $meeting->end_time = $request['end_time'];
        $meeting->location = $request['location'];
        $meeting->agenda = $request['agenda'];
        
        $issave = $meeting->save();
        if($issave)
        {
            $users = request()->input('users');
            foreach($users as $user_id) {
                $attendees[] = [
                    'meeting_id' => $meeting->id,
                    'attendee_id' => $user_id,
                ];
                $receipients[] = User::where('id',$user_id)->first()->email;
                $guests[] = User::where('id',$user_id)->first()->first_name;
        }
            $issave=MeetingAttendees::insert($attendees);
            /*$emailaddresses =  */
            $from_address = Employer::where('id',$meeting->employer_id)->first()->email;

             \Mail::send('mail.send-meetinginvitation',
            array(
               //'email_id' => $receipients,
               'title' => $meeting->name,
               'location' => $meeting->location,
               'date' => $meeting->date,
               'start_time' => $meeting->start_time,
               'end_time' => $meeting->end_time,
               'agenda' => $meeting->agenda,
               'guests' => $guests,
               // 'guests' => array_map('htmlspecialchars', $guests),//$guests,
                
            ), function($msg) use ($request,$receipients,$from_address)
              {
                 $msg->to($receipients);
                 $msg->from($from_address);
                 $msg->subject('Meeting Invitation!');
              }); 

            if($issave){
                notify()->success(__('Created successfully'));
            } else {
                notify()->error(__('Failed to Create. Please try again'));
            }
            return redirect()->back();
    
        }
             

    }
    public function edit(Meeting $meeting)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.meeting.create')],
            [(__('Meeting')), null],
        ]; 
       
        $attendees = MeetingAttendees::with(['users'=> function ($query) {
            $query->select('id', 'first_name','last_name','email'); 
               }])->where('meeting_id', $meeting->id)->get();
        $meetingAttendees = $attendees->pluck('attendee_id')->toArray();
        //return $attendees;
        $employees = User::whereNotIn('id', $meetingAttendees)->where('employer_id',Auth::guard('employer')->user()->id)->where('status',1)->get();
        //return $employees;
        return view('employer.meeting.edit',compact('breadcrumbs','meeting','employees','attendees','meetingAttendees'));
    }

    public function update(UpdateMeetingRequest $request, Meeting $meeting)
    {
        $request = $request->validated();
        $meeting->employer_id = Auth::guard('employer')->user()->id;
        $meeting->name = $request['name'];
        $meeting->location = $request['location'];
        $meeting->date = $request['date'];
        $meeting->start_time = $request['start_time'];
        $meeting->end_time = $request['end_time'];
        $meeting->agenda = $request['agenda'];
        $issave = $meeting->save();
        if($issave)
        {
            //$users = User::all();
            //$meetingAttendees = $meeting->meeting_attendees->pluck('id')->toArray();
            $attendees = MeetingAttendees::with(['users'=> function ($query) {
                $query->select('id', 'first_name','last_name','email'); 
                   }])->where('meeting_id', $meeting->id)->get();
            $meetingAttendees = $attendees->pluck('id')->toArray();

// Get the list of attendees selected in the update form
$selectedAttendees = request()->input('attendees', []);
$allAttendees = request()->input('all_attendees', []);

// Get the IDs of unchecked checkboxes (attendees to be removed)
$attendeesToRemove = array_diff($allAttendees, $selectedAttendees);

//return $selectedAttendees;
MeetingAttendees::where('meeting_id', $meeting->id)->whereIn('attendee_id', $attendeesToRemove)->delete();

// Add new attendees to the meeting\
$attendeesToAdd = request()->input('new_attendees'); //array_diff($selectedAttendees, $meetingAttendees);
$newAttendees = [];
if($attendeesToAdd!=null){
foreach ($attendeesToAdd as $attendee_id) {
    $newAttendees[] = [
        'meeting_id' => $meeting->id,
        'attendee_id' => $attendee_id,
    ];
    //$receipients[] = User::where('id',$attendee_id)->first()->email;
}
MeetingAttendees::insert($newAttendees);
$emailallAttendees = array_merge($selectedAttendees, $attendeesToAdd);
}
else
$emailallAttendees = $selectedAttendees;
$receipients = User::whereIn('id', $emailallAttendees)->pluck('email')->toArray();
$guests = User::whereIn('id',$emailallAttendees)->pluck('first_name')->toArray();
$from_address = Employer::where('id',$meeting->employer_id)->first()->email;

        \Mail::send('mail.send-meetinginvitation-updated',
       array(
          //'email_id' => $receipients,
          'title' => $meeting->name,
          'location' => $meeting->location,
          'date' => $meeting->date,
          'start_time' => $meeting->start_time,
          'end_time' => $meeting->end_time,
          'agenda' => $meeting->agenda,
          'guests' => $guests,
          // 'guests' => array_map('htmlspecialchars', $guests),//$guests,
           
       ), function($msg) use ($request,$receipients,$from_address,$guests)
         {
            $msg->to($receipients);
            $msg->from($from_address);
            $msg->subject('Meeting Invitation!');
         }); 


            if($issave){
                notify()->success(__('Updated successfully'));
            } else {
                notify()->error(__('Failed to Update. Please try again'));
            }
            return redirect('employer/meeting');
    
        }


        
    }


    public function view_details($id)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.meeting.index')],
            [(__('Meeting Details & Attendees')), null],
        ];
        $meeting = Meeting::findOrFail($id);
        $attendees = MeetingAttendees::with(['users'=> function ($query) {
            $query->select('id', 'first_name','last_name','email'); 
               }])->where('meeting_id', $id)->get();
        //return($attendees);
        return view('employer.meeting.view_details',compact('breadcrumbs','meeting','attendees'));
    }

    public function destroy(Meeting $meeting)
    {
        $meeting_del = $meeting->delete();
        $meeting_attendees_del = MeetingAttendees::where('meeting_id', $meeting->id)->delete();
        if($meeting_del && $meeting_attendees_del){
            notify()->success(__('Deleted successfully'));
        }else{
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }


}

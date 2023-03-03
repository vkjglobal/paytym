<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Employer\StoreEventRequest;
use App\Http\Requests\Employer\UpdateEventRequest;
use App\Models\Event;
use Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.event.index')],
            [(__('List')), null]
        ];
        $events = Event::where('employer_id', Auth::guard('employer')->user()->id)->get();
        return view('employer.event.index', compact('breadcrumbs','events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.event.create')],
            [(__('Create')), null]
        ];
        
        return view('employer.event.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $request = $request->validated();
        $event = new Event();
        $event->employer_id = Auth::guard('employer')->user()->id;
        $event->name = $request['name'];
        $event->place = $request['place'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->start_time = $request['start_time'];
        $event->end_time = $request['end_time'];
        $event->description = $request['description'];
        $event->status = 1;
        $issave = $event->save();
        if($issave){
            notify()->success(__('Created successfully'));
        } else {
            notify()->error(__('Failed to Create. Please try again'));
        }
        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $breadcrumbs = [
            [(__('Dashboard')), route('employer.event.create')],
            [(__('Event')), null],
        ]; 
        // $event = Event::findOrFail($id); 
        return view('employer.event.edit',compact('breadcrumbs','event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request , Event $event)
    {
        $request = $request->validated();
        $event->employer_id = Auth::guard('employer')->user()->id;
        $event->name = $request['name'];
        $event->place = $request['place'];
        $event->start_date = $request['start_date'];
        $event->end_date = $request['end_date'];
        $event->start_time = $request['start_time'];
        $event->end_time = $request['end_time'];
        $event->description = $request['description'];
        $issave = $event->save();
        if($issave){
            notify()->success(__('Updated successfully'));
        } else {
            notify()->error(__('Failed to Update. Please try again'));
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $res = $event->delete();
        if($res){
            notify()->success(__('Deleted successfully'));
        }else{
            notify()->error(__('Failed to Delete. Please try again'));
        }
        return redirect()->back();
    }
}

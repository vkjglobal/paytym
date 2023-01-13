<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function list_events(){
        $events = Event::get();
        if(count($events)>0){
            return response()->json([
                'message' => 'Events List',
                'events' => $events
            ],200);
        }else{
            return response()->json([
                'message'=> 'No events present'
            ],400);
        }
    }
}

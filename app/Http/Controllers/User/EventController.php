<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\Ticket;
use DB;

class EventController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
    function view(Request $request, $id) {
        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $event = Event::with('country')->where('end_date', '>', $date)->find($id);
        $crruntDate=$date;      
        if (!empty($event)) {
            $sugstEvent = Event::with('tickets')->where('end_date', '>', $date)->where('category_id', $event->category_id)->where('id','!=', $event->id)->limit(3)->get()->toArray();
            $ticket = Ticket::where('event_id', $event->id)->get();                    
            return view('user.events.events', compact('event', 'sugstEvent','ticket','crruntDate'));
        } else {
            
        }
    }

}

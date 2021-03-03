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
        $event = Event::with('country')->find($id);
        $crruntDate=$date;
//        echo '<pre>';
//        print_r($crruntDate ); die('dfkjgh');

        if (!empty($event)) {
            $sugstEvent = Event::with('tickets')->where('end_date', '>', $date)->where('country_id', $event->country_id)->get();
            $ticket = Ticket::where('event_id', $event->id)->get();
//            echo '<pre>';
//            print_r($sugstEvent); die;
            return view('user.events.events', compact('event', 'sugstEvent','ticket','crruntDate'));
        } else {
            
        }
    }

}

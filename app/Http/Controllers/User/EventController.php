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
use App\Models\Slider;
use App\Models\EventTicketsPayments;
use App\Models\Testimonial;
use App\Models\Service;
use App\Models\Banner;
use App\Models\PricingPlans;
use App\Models\buyTicketsDetails;
use Paystack;
use Response;
use Auth;
use Illuminate\Support\Facades\Redirect;

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
        $testimonials = Testimonial::all();
        $inArray = ['home', 'trusted brands'];
        $slider = Slider::whereIn('name', $inArray)->get();
        if ($slider->count() > 0) {
            foreach ($slider as $val) {
                $sliders[$val->name][] = $val;
            }
        }
        $allServices = Service::get();
        if ($allServices->count() > 0) {
            foreach ($allServices as $val) {
                $services[$val->type][] = $val;
            }
        }

        $aboutBanner = Banner::where('page', 'aboutus')->first();
        if (!empty($aboutBanner)) {
            $banners = $aboutBanner;
        }
        $crruntDate = $date;
        if (!empty($user) && $user->id != '') {
            $userStatus = "yes";
        } else {
            $userStatus = "no";
        }
        if (!empty($event)) {
            $sugstEvent = Event::with('tickets')->where('end_date', '>', $date)->where('category_id', $event->category_id)->where('id', '!=', $event->id)->limit(3)->get()->toArray();
            $ticket = Ticket::where('event_id', $event->id)->get();
            return view('user.events.events', compact('event', 'userStatus', 'sugstEvent', 'ticket', 'crruntDate', 'sliders', 'testimonials', 'services', 'banners'));
        } else {
            
        }
    }

    function buyEventTickets(Request $request) {

        $user = Auth::user();
        $newrow = [];
        $x = 0;
        $totalpaidtikects = 0;
        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $time = $mytime->toTimeString();
        $credt = $date . ' ' . $time;
        try {
            if ($request->input()) {
                $data = $request->input();

                $size = count($data['number']);
                for ($x = 0; $x < $size; $x++) {
                    if ($data['number'][$x] != '') {
                        $newrow[$x]['number'] = $data['number'][$x];
                        $newrow[$x]['tktId'] = $data['tktId'][$x];
                        $newrow[$x]['evntId'] = $data['evntId'][$x];
                        $newrow[$x]['single_amount'] = $data['single_amount'][$x];
                        if ($data['type'][$x] != 'paid') {
                            $totalpaidtikects = $totalpaidtikects + $data['number'][$x];
                        }
                    }
                }
//                 print_r($newrow); die;
                foreach ($newrow as $key => $row) {
                    $event_payment = new EventTicketsPayments;
                    $buyTicketsDetails = new buyTicketsDetails;
                    $ticket = Ticket::find($row['tktId']);
                    if (!empty($ticket)) {
                        if ($ticket->ticket_type == 'free') {
                            if (!empty($user) && $user['id'] != '') {
                                $event_payment->user_id = $user['id'];
                            }
                            $event_payment->event_id = $row['evntId'];
                            $event_payment->ticket_id = $row['tktId'];
                            if ($ticket->ticket_number != '') {
                                $event_payment->ticket_number = $ticket->ticket_number;
                            }
                            $event_payment->coupon = NULL;
                            $event_payment->total_tickets = $row['number'];
                            $event_payment->type = $ticket->ticket_type;
                            $event_payment->created_at = $credt;
                            $event_payment->updated_at = $credt;
                            $event_payment->save();
                        } else {
                            if (!empty($user) && $user['id'] != '') {
                                $event_payment->user_id = $user['id'];
                            }
                            $totalamount = $row['number'] * $row['single_amount'];
                            $event_payment->reference = $data['reference'];
                            $event_payment->trans = $data['trans'];
                            $event_payment->status = $data['status'];
                            $event_payment->transaction = $data['transaction'];
                            $event_payment->coupon = NULL;
                            $event_payment->total_tickets = $totalpaidtikects;
                            $event_payment->paid_amount = $totalamount;
                            $event_payment->total_amount = $totalamount;
                            $event_payment->event_id = $row['evntId'];
                            $event_payment->ticket_id = $row['tktId'];
                            $event_payment->ticket_amount = $row['single_amount'];
                            if ($ticket->ticket_number != '') {
                                $event_payment->ticket_number = $ticket->ticket_number;
                            }
                            $event_payment->total_tickets = $row['number'];
                            $event_payment->type = $ticket->ticket_type;
                            $event_payment->created_at = $credt;
                            $event_payment->updated_at = $credt;
                            $event_payment->save();
                        }
                    }
                }
            }
            return Response::json(['success' => true, 'status' => 1, 'message' => "Event Ticket has been bought successfully."]);
        } catch (\Exception $e) {
            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
        }
    }

}

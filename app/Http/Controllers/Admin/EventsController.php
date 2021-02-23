<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use Session;
use Response;
use App\Models\Event;
use App\Models\States;
use App\Models\Ticket;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Categories;
use Yajra\Datatables\Datatables;

class EventsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        return view('admin.events.index');
    }

    public function addEvent(Request $request) {

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                        'event_title' => 'required',
                        'start_date' => 'required',
                        'end_date' => 'required',
                        'organiser_name' => 'required',
                        'city' => 'required',
                        'state' => 'required',
                        'country' => 'required',
                        'event_category' => 'required',
                        'event_priority' => 'required',
                        'timezone' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            try {
                $user = Auth::user();
                $data = $request->all();

                $existing = Event::where('name', $data['event_title'])->count();
                if ($existing > 0) {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Event already exists');
                    return redirect()->back();
                }

                $event = new Event;
                $event->name = $data['event_title'];
                $event->organizer_name = $data['organiser_name'];
                $event->category_id = $data['event_category'];
                $event->start_date = date("Y-m-d H:i:s", strtotime($data['start_date']));
                $event->end_date = date("Y-m-d H:i:s", strtotime($data['end_date']));
                $event->city_id = $data['city'];
                $event->state_id = $data['state'];
                $event->country_id = $data['country'];
                $event->timezone = $data['timezone'];
                $event->description = $data['description'];
                $event->event_priority = $data['event_priority'];
                $event->user_id = $user->id;

                if ($request->hasFile('image')) {
                    if ($request->file('image')->isValid()) {
                        $validated = $request->validate([
                            'image' => 'string|max:40',
                            'image' => 'mimes:jpeg,png|max:1014',
                        ]);
                        $file = request()->file('image');
                        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                        $file->move('./uploads/images/', $fileName);
                        $img = '/uploads/images/' . $fileName;
                        $event->image = $img;
                    }
                }
                $event->save();

                $ticketName = $request->get('ticket_name');
                $ticketType = $request->get('ticket_type');
                $ticketQuantity = $request->get('quantity');
                $ticketPrice = $request->get('price');
                $ticketStartDate = $request->get('ticket_start_date');
                $ticketEndDate = $request->get('ticketend_date');
                if (!empty($ticketName)) {
                    foreach ($ticketName as $key => $ticket) {
                        $ticket = new Ticket;
                        $ticket->event_id = $event->id;
                        $ticket->ticket_type = $ticketType[$key];
                        $ticket->name = $ticketName[$key];
                        $ticket->quantity = $ticketQuantity[$key];
                        $ticket->price = $ticketPrice[$key];
                        $ticket->start_date = $ticketStartDate[$key];
                        $ticket->end_date = $ticketEndDate[$key];
                        $ticket->created_by = $user->id;
                        $ticket->save();
                    }
                }

                if ($event->id != '') {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.text', 'Event Added successfully.');
                    return redirect()->back();
                } else {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Event fail.');
                    return redirect()->back();
                }
            } catch (\Exception $e) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', $e->getMessage());
                return redirect()->back()->withErrors($e->getMessage());
            }
        }
        if ($request->isMethod('get')) {
            $categories = Categories::get();
            $countries = Countries::get();
            $states = States::get();
            $cities = Cities::get();
            return view('admin.events.add')->with(['categories' => $categories, 'states' => $states, 'cities' => $cities, 'countries' => $countries]);
        }
    }

    public function allEvents(Request $request) {

        $allEvents = Event::orderBy('created_at', 'desc')->get();

        return DataTables::of($allEvents)
                        ->addColumn('name', function($allEvents) {
                            return $allEvents->name;
                        })
                        ->addColumn('image', function($allEvents) {
                            $img = '-';
                            if ($allEvents->image != '') {
                                $img = '<img src="' . url($allEvents->image) . '" width="100" height="100">';
                            }
                            return $img;
                        })
                        ->addColumn('organizer_name', function($allEvents) {
                            return $allEvents->organizer_name;
                        })
                        ->addColumn('country', function($allEvents) {
                            return $allEvents->country->name;
                        })
                        ->editColumn('created_at', function($allEvents) {
                            if (!empty($allEvents->created_at)) {
                                return getDateOnly($allEvents->created_at);
                            }
                            return 'N/A';
                        })
                        ->addColumn('action', function($allEvents) {
                            $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item"  href="' . route('admin.edit.event', ['id' => $allEvents['id']]) . '"><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit Event</a>';


                            $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteEvent(this,' . $allEvents['id'] . ')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete Event</a>';
                            $str .= '</div></div>';
                            return $str;
                        })
                        ->rawColumns(['name', 'image', 'organizer_name', 'country', 'created_at', 'action'])
                        ->make(true);
    }

    public function editEvent(Request $request) {

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                        'event_title' => 'required',
                        'start_date' => 'required',
                        'end_date' => 'required',
                        'organiser_name' => 'required',
                        'city' => 'required',
                        'state' => 'required',
                        'country' => 'required',
                        'event_category' => 'required',
                        'event_priority' => 'required',
                        'timezone' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            try {
                $user = Auth::user();
                $data = $request->all();
                $existing = Event::where('name', $data['event_title'])->where('id', '!=', $request->get('event_id'))->count();
                if ($existing > 0) {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Event already exists');
                    return redirect()->back();
                }

                $event = Event::find($request->get('event_id'));
                $event->name = $data['event_title'];
                $event->organizer_name = $data['organiser_name'];
                $event->category_id = $data['event_category'];
                $event->start_date = date("Y-m-d H:i:s", strtotime($data['start_date']));
                $event->end_date = date("Y-m-d H:i:s", strtotime($data['end_date']));
                $event->city_id = $data['city'];
                $event->state_id = $data['state'];
                $event->country_id = $data['country'];
                $event->timezone = $data['timezone'];
                $event->description = $data['description'];
                if ($request->hasFile('image')) {
                    if ($request->file('image')->isValid()) {
                        $validated = $request->validate([
                            'image' => 'string|max:40',
                            'image' => 'mimes:jpeg,png|max:1014',
                        ]);
                        $file = request()->file('image');
                        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                        $file->move('./uploads/images/', $fileName);
                        $img = '/uploads/images/' . $fileName;
                        $event->image = $img;
                    }
                }

                $event->update();
                $ticketName = $request->get('ticket_name');

                if (!empty($ticketName)) {
                    $ticketType = $request->get('ticket_type');
                    $ticketQuantity = $request->get('quantity');
                    $ticketPrice = $request->get('price');
                    $ticketStartDate = $request->get('ticket_start_date');
                    $ticketEndDate = $request->get('ticketend_date');
                    $deleteTicket = Ticket::where('event_id', $event->id)->delete();
                    foreach ($ticketName as $key => $ticket) {
                        $ticket = new Ticket;
                        $ticket->event_id = $event->id;
                        $ticket->ticket_type = $ticketType[$key];
                        $ticket->name = $ticketName[$key];
                        $ticket->quantity = $ticketQuantity[$key];
                        $ticket->price = $ticketPrice[$key];
                        $ticket->start_date = $ticketStartDate[$key];
                        $ticket->end_date = $ticketEndDate[$key];
                        $ticket->created_by = $user->id;
                        $ticket->save();
                    }
                }

                if ($event->id != '') {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.text', 'Event Updated successfully.');
                    return redirect()->back();
                } else {
                    $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.text', 'Event fail.');
                    return redirect()->back();
                }
            } catch (\Exception $e) {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.text', $e->getMessage());
                return redirect()->back()->withErrors($e->getMessage());
            }
        }
        if ($request->isMethod('get')) {
            $categories = Categories::get();
            $countries = Countries::get();
            $states = States::get();
            $cities = Cities::get();
            $id = $request->get('id');
            $event = Event::find($id);

            return view('admin.events.edit')->with(['event' => $event, 'categories' => $categories, 'states' => $states, 'cities' => $cities, 'countries' => $countries]);
        }
    }

    public function deleteEvent(Request $request) {
        $validator = Validator::make($request->all(), [
                    'id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return Response::json(['success' => false, 'status' => 2, "error" => $validator->errors()->first()]);
        }
        try {
            $event = Event::find($request->input('id'));
            if (file_exists(public_path($event->image))) {
                unlink(public_path($event->image));
                File::delete(public_path($event->image));
            }
            $event->delete();

            if ($event) {
                return Response::json(['success' => true, 'status' => 1, 'message' => "Event has been deleted successfully."]);
            } else {
                return Response::json(['success' => false, 'status' => 2, "error" => 'Something went wrong.']);
            }
        } catch (\Exception $e) {
            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
        }
    }

}

<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
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
use App\Models\ModulesList;
use App\Models\VendorPermissions;

class EventsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:vendor');
    }

    public function index() {
        $user = Auth::user();
        $permissions = VendorPermissions::where(['vendor_id' => $user->id, 'modul_id' => 1])->first();

        return view('vendor.event.index', compact('permissions'));
    }

    public function allCategories(Request $request) {
        $allCategories = Categories::orderBy('created_at', 'desc')->get();

        return DataTables::of($allCategories)
                        ->addColumn('name', function ($allCategories) {
                            return $allCategories->name;
                        })
                        ->addColumn('image', function ($allCategories) {
                            $img = '-';
                            if ($allCategories->image != '') {
                                $img = '<img src="' . url($allCategories->image) . '" width="100" height="100">';
                            }

                            return $img;
                        })
                        ->editColumn('created_at', function ($allCategories) {
                            if (!empty($allCategories->created_at)) {
                                return getDateOnly($allCategories->created_at);
                            }
                            return 'N/A';
                        })
                        ->addColumn('action', function ($allCategories) {
                            if (Auth::user()->id == $allCategories['created_by']) {
                                $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item" href="' . route('event-categories.edit', $allCategories->id) . '"  ><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit Category</a>';

                                $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteCategory(this,' . $allCategories['id'] . ')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete Category</a>';
                                $str .= '</div></div>';
                                return $str;
                            } else {
                                return '-';
                            }
                        })
                        ->rawColumns(['name', 'image', 'created_at', 'action'])
                        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        $user = Auth::user();
        $permissions = VendorPermissions::where(['vendor_id' => $user->id, 'modul_id' => 1])->first();
        if ($permissions->add == '1') {
            $categories = Categories::where('parent_id', 0)->get();
            $countries = Countries::get();
            $states = States::get();
            $cities = Cities::get();
            return view('vendor.event.add', compact('categories', 'countries', 'states', 'cities'));
        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.text', 'You have no added permission.');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
//echo '<pre>';
//print_r($request->all()); die;
        $validator = Validator::make($request->all(), [
                    'event_title' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'organiser_name' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'country' => 'required',
                    'event_category' => 'required',
                    'subcategory_id' => 'required',
                    'addticketcheck' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
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
            $event->subcategory_id = $data['subcategory_id'];
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
                    if (isset($ticketName[$key]) && $ticketName[$key] != '' && isset($ticketQuantity[$key]) && $ticketQuantity[$key] != '') {
                        $row = Ticket::select('ticket_number')->latest('id')->first();
                        if (!empty($row) && $row->ticket_number != '') {
                            $ticket_number = $row->ticket_number + 1;
                        } else {
                            $ticket_number = 10000000;
                        }
                        $ticket = new Ticket;
                        $ticket->event_id = $event->id;
                        $ticket->ticket_type = $ticketType[$key];
                        $ticket->name = $ticketName[$key];
                        $ticket->quantity = $ticketQuantity[$key];
                        $ticket->price = $ticketPrice[$key];
                        $ticket->ticket_number = $ticket_number;
                        $ticket->start_date = date("Y-m-d", strtotime($ticketStartDate[$key]));
                        $ticket->end_date = date("Y-m-d", strtotime($ticketEndDate[$key]));
                        $ticket->created_by = $user->id;
                        $ticket->save();
                    }
                }
            }

            if ($event->id != '') {
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.text', 'Event Added successfully.Please wait administration response ');
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

    public function allEvents(Request $request) {

        $allEvents = Event::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return DataTables::of($allEvents)
                        ->addColumn('name', function ($allEvents) {
                            return $allEvents->name;
                        })
                        ->addColumn('image', function ($allEvents) {
                            $img = '-';
                            if ($allEvents->image != '') {
                                $img = '<img src="' . url($allEvents->image) . '" width="100" height="100">';
                            }
                            return $img;
                        })
                        ->addColumn('organizer_name', function ($allEvents) {
                            return $allEvents->organizer_name;
                        })
                        ->addColumn('country', function ($allEvents) {
                            return $allEvents->country->name;
                        })
                        ->editColumn('created_at', function ($allEvents) {
                            if (!empty($allEvents->created_at)) {
                                return getDateOnly($allEvents->created_at);
                            }
                            return 'N/A';
                        })
                        ->addColumn('action', function ($allEvents) {
                            $str = '<div class="btn-group dropdown">
                <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                <div class="dropdown-menu dropdown-menu-right"><a data-toggle="tooltip" data-placement="top" title="Edit" class="dropdown-item"  href="' . route('event.edit', $allEvents->id) . '"><i class="mdi mdi-pencil mr-1 text-muted font-18 vertical-middle"></i> Edit Event</a>';

                            $str .= '<a data-toggle="tooltip" data-placement="top" title="Delete" class="dropdown-item"   onclick="deleteEvent(this,' . $allEvents['id'] . ')" href="javascript:void(0);" ><i class="mdi mdi-delete mr-1 text-muted font-18 vertical-middle"></i> Delete Event</a>';
                            $str .= '</div></div>';
                            return $str;
                        })
                        ->rawColumns(['name', 'image', 'organizer_name', 'country', 'created_at', 'action'])
                        ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $categories = Categories::where('parent_id', 0)->get();
        $countries = Countries::get();
        $event = Event::find($id);

        return view('vendor.event.edit', compact('event', 'categories', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
                    'event_title' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'organiser_name' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'country' => 'required',
                    'event_category' => 'required',
                    'subcategory_id' => 'required',
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
            $event->subcategory_id = $data['subcategory_id'];
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
                $ticket_id = $request->get('ticket_id');
                $deleteTicket = Ticket::where('event_id', $event->id)->delete();
                foreach ($ticketName as $key => $ticket) {
                    if (isset($ticketName[$key]) && $ticketName[$key] != '' && isset($ticketQuantity[$key]) && $ticketQuantity[$key] != '') {

                        if (!isset($ticket_id[$key]) || $ticket_id[$key] == '') {
                            $rownum = Ticket::select('ticket_number')->orderBy('id', 'desc')->first();
                            if (!empty($rownum)) {
                                $ticket_id[$key] = $rownum->ticket_number + 1;
                            } else {
                                $ticket_id[$key] = 1000000;
                            }
                        }
                        $ticket = new Ticket;
                        $ticket->event_id = $event->id;
                        $ticket->ticket_type = $ticketType[$key];
                        $ticket->ticket_number = $ticket_id[$key];
                        $ticket->name = $ticketName[$key];
                        $ticket->quantity = $ticketQuantity[$key];
                        $ticket->price = $ticketPrice[$key];
                        $ticket->start_date = $ticketStartDate[$key];
                        $ticket->end_date = $ticketEndDate[$key];
                        $ticket->created_by = $user->id;
                        $ticket->save();
                    }
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $event = Event::findOrFail($id);
            $event->delete();

            if ($event) {
                return Response::json(['success' => true, 'status' => 1, 'message' => "event has been deleted successfully."]);
            } else {
                return Response::json(['success' => false, 'status' => 2, "error" => 'Something went wrong.']);
            }
        } catch (\Exception $e) {
            return Response::json(['success' => false, 'status' => 2, "error" => $e->getMessage()]);
        }
    }

}

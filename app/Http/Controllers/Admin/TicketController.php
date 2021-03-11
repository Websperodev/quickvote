<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use App\Models\Ticket;
use App\Models\TeamMember;
use Yajra\Datatables\Datatables;

use Response;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    
    public function index()
    {
        return view('admin.team.index');
    }
    public function deleteTicket(Request $request){
        $ticket = Ticket::findOrFail($request->id);
        $ticket->delete();
           
        if($ticket){
            return Response::json(['success' => true, 'status' => 1, 'message' => "Ticket has been deleted successfully."]);
        }else{
            return Response::json(['success' => false, 'status' => 2, "error" => 'Something went wrong.']);
        }
        
    }

    
}

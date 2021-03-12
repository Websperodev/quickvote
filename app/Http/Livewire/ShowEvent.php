<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Categories;

class ShowEvent extends Component {

    public $allCategories = [];
    public $allEvents = [];
    public $searchName = '';
    public $searchTerm;
    public $allEvt = [];
    public $eventDate = '';
    public $catId = '';
    public $catIds=[];
    public $categoriesids = [];

    public function mount(Request $req, $searchName = null) {
        $this->catId = $req->id;
        $this->categoriesids = [];

        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $this->catIds = Categories::select('id')->where('parent_id', $this->catId)->get()->toArray();

        $this->categoriesids = array_column($this->catIds, 'id');
        $this->categoriesids[] = $this->catId;
        $this->allCategories = Categories::whereIn('id', $this->categoriesids)->get();
        $this->searchName = $searchName;

        $this->eventDate = $req->input('eventDate');
        $this->searchName = $req->input('eventname');
        if ($this->eventDate != '' && $this->searchName == '') {
            $this->allEvents = Event::where('end_date', '>', $this->eventDate)->orderBy('id', 'desc')->whereIn('category_id', $this->categoriesids)->get()->toArray();
        } elseif ($this->searchName != '' && $this->eventDate == '') {
            $this->allEvents = Event::where('end_date', '>', $date)->where('name', 'like', '%' . $this->searchName . '%')->whereIn('category_id', $this->categoriesids)->orderBy('id', 'desc')->get()->toArray();
        } elseif ($this->searchName != '' && $this->eventDate != '') {
            $this->allEvents = Event::where('end_date', '>', $this->eventDate)->where('name', 'like', '%' . $this->searchName . '%')->whereIn('category_id', $this->categoriesids)->orderBy('id', 'desc')->get()->toArray();
        } else {
            $this->allEvents = Event::where('end_date', '>', $date)->whereIn('category_id', $this->categoriesids)->orderBy('id', 'desc')->get();
        }

        if (!empty($this->allEvents)) {
            foreach ($this->allEvents as $key => $event) {
                $this->allEvents[$key]['tickets'] = Ticket::where(['event_id' => $event['id']])->get();
            }
        }

        $this->allEvt = $this->allEvents;
    }

    public function searchEvent() {

        $this->categoriesids = [];
        $mytime = Carbon::now();
        $date = $mytime->toDateString();
     
        $this->allCategories = Categories::whereIn('id', $this->categoriesids)->get();
        if ($this->searchName != '') {
            $this->allEvents = Event::where('end_date', '>', $date)->where('name', 'like', '%' . $this->searchName . '%')->whereIn('category_id', $this->categoriesids)->orderBy('id', 'desc')->get()->toArray();
        } else {
            $this->allEvents = Event::where('end_date', '>', $date)->orderBy('id', 'desc')->get()->whereIn('category_id', $this->categoriesids)->toArray();
        }
        if (!empty($this->allEvents)) {
            foreach ($this->allEvents as $key => $event) {
                $this->allEvents[$key]['tickets'] = Ticket::where(['event_id' => $event['id']])->get();
            }
        }
        $this->allEvt = $this->allEvents;
    }

    public function searchTabList($type) {

        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $event = [];

        if ($type != '') {
            switch ($type) {
                CASE 'all':
                    $this->allEvents = Event::where('end_date', '>', $date)->whereIn('category_id', $this->categoriesids)->orderBy('id', 'desc')->get()->toArray();
                    break;
                CASE 'Recent':
                    $this->allEvents = Event::where('end_date', '>', $date)->whereIn('category_id', $this->categoriesids)->orderBy('start_date', 'desc')->get()->toArray();
                    break;
                CASE 'Free':
                    $tickets = Ticket::where('ticket_type', 'free')->distinct()->get();

                    if (!empty($tickets)) {
                        foreach ($tickets as $ticket) {

                            $eventdat = Event::where('end_date', '>', $date)->where('id', '=', $ticket->event_id)->whereIn('category_id', $this->categoriesids)->orderBy('id', 'desc')->first();
                            if (!empty($eventdat)) {
                                $event[] = $eventdat;
                            }
                        }
                        $this->allEvents = $event;
                    }

                    break;
                CASE 'Paid':
                    $tickets = Ticket::where('ticket_type', 'paid')->distinct()->get();
                    if (!empty($tickets)) {
                        foreach ($tickets as $ticket) {
                            $eventdat = Event::where('end_date', '>', $date)->where('id', '=', $ticket->event_id)->whereIn('category_id', $this->categoriesids)->orderBy('id', 'desc')->first();
                            if (!empty($eventdat)) {
                                $event[] = $eventdat;
                            }
                        }
                        $this->allEvents = $event;
                    }
                    break;
            }
            if (!empty($this->allEvents)) {
                foreach ($this->allEvents as $key => $event) {
                    $this->allEvents[$key]['tickets'] = Ticket::where(['event_id' => $event['id']])->get();
                }
            }
            $this->allEvt = $this->allEvents;
        }
    }

    public function render() {

        return view('livewire.show-event');
    }

}

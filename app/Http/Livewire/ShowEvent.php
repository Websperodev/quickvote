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
    public $searchCat = '';
    public $searchTerm;
    public $allEvt = [];
    public $eventDate = '';

    public function mount(Request $req, $searchName = null, $searchCat = null) {

        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $this->allCategories = Categories::all();
        $this->searchName = $searchName;
        $this->searchCat = $searchCat;

        $this->eventDate = $req->input('eventDate');
        $this->searchName = $req->input('eventname');
        if ($this->eventDate != '' && $this->searchName == '') {
            $allEvents = Event::where('end_date', '>', $this->eventDate)->orderBy('id', 'desc')->get()->toArray();
        } elseif ($this->searchName != '' && $this->eventDate == '') {
            $allEvents = Event::where('end_date', '>', $date)->where('name', 'like', '%' . $this->searchName . '%')->orderBy('id', 'desc')->get()->toArray();
        } elseif ($this->searchName != '' && $this->eventDate != '') {
            $allEvents = Event::where('end_date', '>', $this->eventDate)->where('name', 'like', '%' . $this->searchName . '%')->orderBy('id', 'desc')->get()->toArray();
        } else {
            $allEvents = Event::where('end_date', '>', $date)->orderBy('id', 'desc')->get();
        }

        if (!empty($allEvents)) {
            foreach ($allEvents as $key => $event) {
                $allEvents[$key]['tickets'] = Ticket::where(['event_id' => $event['id']])->get();
            }
        }

        $this->allEvents = $allEvents;

    }

    public function searchEvent() {

        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $this->allCategories = Categories::all();
        $this->searchTerm = $this->searchName;

        if ($this->searchName != '' && $this->searchCat == '') {

            $this->allEvents = Event::where('end_date', '>', $date)->where('name', 'like', '%' . $this->searchName . '%')->orderBy('id', 'desc')->get()->toArray();
        } elseif ($this->searchName == '' && $this->searchCat != '') {

            $this->allEvents = Event::where('end_date', '>', $date)->where('category_id', $this->searchCat)->orderBy('id', 'desc')->get()->toArray();
        } elseif ($this->searchName != '' && $this->searchCat != '') {

            $this->allEvents = Event::where('end_date', '>', $date)->where('category_id', $this->searchCat)->where('name', 'like', '%' . $this->searchName . '%')->orderBy('id', 'desc')->get()->toArray();
        } else {

            $this->allEvents = Event::where('end_date', '>', $date)->orderBy('id', 'desc')->get()->toArray();
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
                    $this->allEvents = Event::where('end_date', '>', $date)->orderBy('id', 'desc')->get()->toArray();
                    break;
                CASE 'Recent':
                    $this->allEvents = Event::where('end_date', '>', $date)->orderBy('start_date', 'desc')->get()->toArray();
                    break;
                CASE 'Free':
                    $tickets = Ticket::where('ticket_type', 'free')->distinct()->get();

                    if (!empty($tickets)) {
                        foreach ($tickets as $ticket) {

                            $eventdat = Event::where('end_date', '>', $date)->where('id', '=', $ticket->event_id)->orderBy('id', 'desc')->first();
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
                            $eventdat = Event::where('end_date', '>', $date)->where('id', '=', $ticket->event_id)->orderBy('id', 'desc')->first();
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

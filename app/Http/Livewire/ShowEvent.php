<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Categories;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class ShowEvent extends Component {

    public $allCategories = [];
    public $allEvents = [];
    public $searchName = '';
    public $searchCat = '';
    public $searchTerm;
    public $allEvt = [];
    public $eventDate = '';

    public function mount(Request $req, $searchName = null, $searchCat = null) {
//        print_r($_POST);
//        die;
        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $this->allCategories = Categories::all();
        $this->searchName = $searchName;
        $this->searchCat = $searchCat;

//        if(){
//            
//        }
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
//        echo '<pre>';
//        print_r($allEvents); die;
        if (!empty($allEvents)) {
            foreach ($allEvents as $key => $event) {
                $allEvents[$key]['tickets'] = DB::table('tickets')->where(['event_id' => $event['id']])->get();
            }
        }
//         echo '<pre>';
//        print_r($allEvents); die;
//        if ($this->searchName != '' && $this->searchCat =='') {
//            $this->allEvents = Event::where('end_date', '>', $date)->where('name', 'like', '%' . $this->searchName . '%')->orderBy('id', 'desc')->get()->toArray();
//        }
//         if ($this->searchName == '' && $this->searchCat !='') {
//            $this->allEvents = Event::where('end_date', '>', $date)->where('name', 'like', '%' . $this->searchName . '%')->orderBy('id', 'desc')->get()->toArray();
//        }
        $this->allEvents = $allEvents;
//                 echo '<pre>';  
//          print_r($this->allEvents);  die;
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
                $this->allEvents[$key]['tickets'] = DB::table('tickets')->where(['event_id' => $event['id']])->get();
            }
        }
        $this->allEvt = $this->allEvents;
    }

    public function render() {

        return view('livewire.show-event');
    }

}

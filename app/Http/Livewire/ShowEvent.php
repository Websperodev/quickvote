<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Categories;
use Livewire\Component;
use Carbon\Carbon;

class ShowEvent extends Component
{
	public $allCategories  = [];
	public $allEvents  = [];
	public $searchName = '';
	public $searchCat = '';
	public $searchTerm;
	public $allEvt  = [];

	public function mount($searchName = null, $searchCat = null)
    {
    	$mytime = Carbon::now();
        $date = $mytime->toDateString();
        $this->allCategories = Categories::all();
        $this->searchName = $searchName;
        $this->searchCat = $searchCat;
        
 		$this->allEvents = Event::where('end_date', '>', $date)->orderBy('id', 'desc')->get()->toArray();
    }

    public function searchEvent(){
    	$mytime = Carbon::now();
        $date = $mytime->toDateString();
        $this->allCategories = Categories::all();
        $this->searchTerm = $this->searchName;
 		if($this->searchName != ''){

 			$this->allEvents = Event::where('end_date', '>', $date)->where('name', 'like', '%' . $this->searchName . '%')->orderBy('id', 'desc')->get()->toArray();
 			$this->allEvt = $this->allEvents;
 			
 		}else{
 			$this->allEvents = Event::where('end_date', '>', $date)->orderBy('id', 'desc')->get()->toArray();
 		}

    }

    public function render()
    {

        return view('livewire.show-event');
    }
}

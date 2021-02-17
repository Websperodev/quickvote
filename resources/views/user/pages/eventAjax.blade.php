<div class="eventpagiging row">
@foreach($allEvents as $event)
@php 
$minPrice = '';
$ticketType = [];
@endphp

@if(count($event->tickets) > 0)
@foreach($event->tickets as $tic)
@php 
if($tic->ticket_type == 'paid'){
if($minPrice == '' || $minPrice > $tic->price){
$minPrice = $tic->price;
}
}
$ticketType[] = $tic->ticket_type;
@endphp
@endforeach
@php 
$ticketType = array_unique($ticketType);
@endphp
@endif

<div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter Most Recent">
    <div class="tcard border-0 py-3 px-4">
        <div class="justify-content-center"> <img src="{{ url($event->image) }}" class="img-fluid profile-pic mb-4 mt-3"> </div>
        @php 
       
        $startTime = '';
        $yrdata= strtotime($event->start_date);
        $startDate = date('d-M', $yrdata);
        $startTime = date("g:i a", strtotime($event->start_date));

        @endphp
        <div class="fe-abs">
            <span class="date-abs">{{ $startDate }}</span>
            <div class="txt-card">
                <div class="event-name">
                    <h2 class="titleh2 event-title">{{ $event->name }}</h2>
                    @if($minPrice != '')
                    <span class="tickets">Tickets From ${{ $minPrice }}</span>
                    @endif
                </div>
                @if($startTime != '')
                <p class="time-price"><span class="etime"><i class="far fa-clock"></i>  Start {{ $startTime}}</span> 
                    @endif
                    @foreach($ticketType as $tt) <span class="eprice">{{ ucfirst($tt) }}</span> @endforeach</p>
                <a class="btn btn-grad-bd ticket-details" href="#">Tickets & Details</a>
            </div>
        </div>
    </div>
</div>


@endforeach
</div>

{!! $allEvents->links() !!}
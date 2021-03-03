<div>
    <div id="floating-search" class="container evnt">
        <h2>Event Browse</h2>
        <div class=" row">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" class="form-control" wire:model.debounce.300ms="searchName" placeholder="Enter KeyWord"/>


                </div>
            </div>

            <!--            <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" wire:model="searchCat" id="event-cat" >
                                    <option value="">Event Category</option>
                                    @foreach($allCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>-->
            <div class="col-md-4">
                <button type="button" wire:click="searchEvent" class="btn btn-primary advanceSearch seachButton">Search Event</button>
            </div>
        </div>
    </div>
    <div id="eve" class="events">
        <div class="container">
            <div class="row">
                <div class="filterr col-12" align="center">
                    <button class="btn btn-default filter-button" wire:click="searchTabList('all')" data-filter="all">All</button>
                    <button class="btn btn-default filter-button" wire:click="searchTabList('Recent')" data-filter="Recent">Most Recent</button>
                    <button class="btn btn-default filter-button" wire:click="searchTabList('Free')" data-filter="Free">Free Forms</button>
                    <button class="btn btn-default filter-button" wire:click="searchTabList('Paid')" data-filter="Paid">Paid Forms</button>
                </div>
                <br/>
                @foreach($allEvents as $event)
                @php 
                $minPrice = '';
                $ticketType = [];
                @endphp
                @if(isset($event['tickets']) && !empty($event['tickets']))
                @foreach($event['tickets'] as $tic)
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
                        <div class="justify-content-center"> <img src="{{ isset($event['image'])? url($event['image']) : '' }}" class="img-fluid profile-pic mb-4 mt-3"> </div>
                        @php 
                        $startTime = '';
                        $startDate = '';
                        if(isset($event['start_date'])){
                        $yrdata= strtotime($event['start_date']);
                        $startDate = date('d-M', $yrdata);
                        $startTime = date("g:i a", strtotime($event['start_date']));
                        }
                        $description=substr(strip_tags($event['description']),0, 150);
                        $char=strlen($event['description']);
                        if($char >150){
                        $description=$description.'...';
                        }

                        @endphp
                        <div class="fe-abs">
                            <span class="date-abs">{{ $startDate }}</span>
                            <div class="txt-card">
                                <div class="event-name">
                                    <h2 class="titleh2 event-title">{{ $event['name'] }}</h2>
                                    @if($minPrice != '')
                                    <span class="tickets">Tickets From ${{ $minPrice }}</span>
                                    @endif
                                    @if($startTime != '')
                                    <p class="time-price"><span class="etime"><i class="far fa-clock"></i>  Start {{ $startTime}}</span> 
                                        @endif
                                        @foreach($ticketType as $tt) <span class="eprice">{{ ucfirst($tt) }}</span> @endforeach</p>
                                    <div><p>{{($description)}}</p><a href="{{url('event-detail').'/'.$event['id']}}" >Read more</a></div>
                                    <a class="btn btn-grad-bd ticket-details" href="{{url('event-detail').'/'.$event['id']}}">Tickets & Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

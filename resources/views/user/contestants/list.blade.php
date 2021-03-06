@extends('user.layouts.main')
@section('content')
<style>
    .brands .slick-slide{
        height:30% !important;
    }
    .votesBtn{
        margin-top: 10px !important;
    }
    .img-fluid12 {
        max-width: 502px !important;
        height: 400px !important;
    }
</style>
<script>
    var url = "{{url('contestants').'/'.$voting->id}}";
</script>

<div id="eve-detail" class="event-contestant">
    <div class="container">
        <div class="row">

            @php

            if($voting->image != '')
            {
            $img = $voting->image;
            }
            else{
            $img ="img/fe2.jpg";
            }
            $date = $voting->starting_date;
            $close_date = $voting->closing_date;

            $start_day=date('D', strtotime($date));
            $start_month=date('F', strtotime($date));
            $start_month_shot=date('m', strtotime($date));
            $start_date=date('d',strtotime($date));
            $start_year=date('Y',strtotime($date));
            $start_time=date('h:m',strtotime($date));

            $close_day=date('D', strtotime($close_date));
            $close_month=date('F', strtotime($close_date));
            $close_month_shot=date('m', strtotime($close_date));
            $clos_date=date('d',strtotime($close_date));
            $close_year=date('Y',strtotime($close_date));
            $close_time=date('h:m',strtotime($close_date));

            @endphp
            <div class="col-md-8 col-sm-12 edetail">
                <div class="event-titlee">
                    <div class="eve-img"><img src="{{url($img)}}" ></div>
                    <div class="eve-title">
                        <h2>{{ucfirst($voting->title) }}</h2>
                        <p class="eve-date-time"><span class="eve-date">Date: {{$start_day .' '.$start_month .' '.$start_date.' '.$start_year}}</span> <span class="eve-time">Time: {{$start_time}}</span></p>
                    </div>
                </div>
                <div class="event-details">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#candidate">Candidate</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#organizer">Organizer</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="candidate" class="tab-pane active">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <select class="form-control cont_id" name="cont_id" >
                                        <option value=""> Select Contestant</option>
                                        @if(!empty($contestants))
                                        @foreach($allContestants as $cont)
                                        <option {{ $constnt_id == $cont->id ? 'selected' : ''}}  value="{{ $cont->id }}">{{ $cont->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-bg">Search Event</button>
                            </div>
                        </div>
                        <div id="organizer" class="tab-pane fade">
                            <div class="eve-description">
                                <div><h4>Date & Time</h4> <span>{{$start_day.' '.$start_month.' '.$start_date. ' '.$start_year}}, Time:{{$start_time}}</span></div>
                                @if($voting->description)
                                <div>
                                  <h4>Vote Details</h4>
                                  <span>{{$voting->description}}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 sidebar">
                <div class="single-event-ticket">
                    <img src="{{url($img)}}">
                </div>
            </div>
        </div>
    </div>
</div>

<div id="cand" class="events candidatelists">
    <div class="container">
        <div class="row">
            @if(!empty($contestants))
            @foreach($contestants as $cont)
            @php  if($cont->image != '')
            {
            $cImg = $cont->image;
            }
            else{
            $cImg ="img/fe2.jpg";
            }
            @endphp
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 candidates">
                <div class="tcard border-0 py-3 px-4">
                    <div class="justify-content-center"> <img src="{{url($cImg)}}" class="img-fluid12 cand-pic mt-3"> </div>
                    <div class="can-detail">
                        <div class="txt-card">
                            <div class="event-name">
                                <h2 class="cand-name">{{ucfirst($cont->name)}}</h2>
                                <span class="cand-no">Candidate Number: <span>{{ $cont->candidate_id}}<span></span>
                                        </div>
                                        <div class="votez"><span class="vote-result">Vote Result: <span>{{$cont->percentage}}%</span></span>
                                            <span class="vote-btn"><a href="{{url('vote/contestants/').'/'.$voting->id.'/'.$cont->id}}" class="btn btn-bg">Vote</a></span></div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>

                                        @endforeach


                                        @endif
                                        </div>
                                        </div>
                                        </div>

                                        <div id="eve" class="events single-eve">
                                            <div class="container">
                                                <div class="row">
                                                    <h2 class="titleh2 tc">Similar Votes</h2>
                                                    @if(!empty($voting_contest))
                                                    @foreach($voting_contest as $voting)
                                                    @php

                                                    if($voting->image != '')
                                                    {
                                                    $img = $voting->image;
                                                    }
                                                    else{
                                                    $img ="img/fe2.jpg";
                                                    }
                                                    $date = $voting->starting_date;
                                                    $close_date = $voting->closing_date;

                                                    $start_day=date('D', strtotime($date));
                                                    $start_month=date('F', strtotime($date));
                                                    $start_month_shot=date('m', strtotime($date));
                                                    $start_date=date('d',strtotime($date));
                                                    $start_year=date('Y',strtotime($date));
                                                    $start_time=date('h:m',strtotime($date));

                                                    $close_day=date('D', strtotime($close_date));
                                                    $close_month=date('F', strtotime($close_date));
                                                    $close_month_shot=date('m', strtotime($close_date));
                                                    $clos_date=date('d',strtotime($close_date));
                                                    $close_year=date('Y',strtotime($close_date));
                                                    $close_time=date('h:m',strtotime($close_date));


                                                    @endphp
                                                    <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter Most Recent">
                                                        <div class="tcard border-0 py-3 px-4">
                                                            <div class="justify-content-center"> <img src="{{url($img)}}" class="img-fluid profile-pic mb-4 mt-3" > </div>
                                                            <div class="fe-abs">
                                                                <span class="date-abs">Vote</span>
                                                                <div class="txt-card">
                                                                    <div class="event-name">
                                                                        <h2 class="titleh2 event-title">{{ucfirst($voting->title)}}</h2>

                                                                    </div>
                                                                    <p class="time-price"><span class="etime"><i class="far fa-clock"></i> Start {{$start_day .' '.$start_month. ' '.$start_date.' '.$start_year .' - '.$close_day.' '.$close_month.' '.$clos_date}}</span> </p>
                                                                    <a class="btn btn-grad-bd ticket-details" href="{{url('contestants').'/'.$voting->id}}">View contest</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                    <p align="center"> <a href="{{url('vote/categories-list')}}" class="btn btn-bg mt-4 votesBtn">View All Votes</a></p>
                                                </div>

                                            </div>
                                        </div>

                                     @include('user.components.trusted-brands')

                                        @endsection

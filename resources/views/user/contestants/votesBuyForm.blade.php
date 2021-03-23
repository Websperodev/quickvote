@extends('user.layouts.main')

@section('content')

<style>
    .brands .slick-slide{
        height:30% !important;
    }
    .error{
        color:red;
    }
    .vote-price{
        color:red; 
    }
    .img-fluid {
        max-width: 100% !important;
        height: 53% !important;
    }
</style>

<div id="cand-detail" class="candid">
    <div class="container">
        @if(session()->has('message.level'))
        <div class="alert alert-{{ session('message.level') }}"> 
            {!! session('message.text') !!}
        </div>
        @endif
        <div class="row">
            @php

            if($vote->image != '')
            {
            $img = $vote->image;
            }
            else{
            $img ="img/fe2.jpg";
            }
            $date = $vote->starting_date;
            $close_date = $vote->closing_date;

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
                        <h2>{{$vote->title }}</h2>
                        <p class="eve-date-time"><span class="eve-date">Date: {{$start_day .' '.$start_month .' '.$start_date.' '.$start_year}}</span> <span class="eve-time">Time: {{$start_time}}</span></p>
                    </div>
                </div>
                <div class="event-details"> <br> <br>
                    <div class="eve-description">

                        <div><h4>Date & Time</h4> <span>{{$start_day.' '.$start_month.' '.$start_date. ' '.$start_year}}, Time:{{$start_time}}</span></div>
                        <div><h4>Vote Details</h4> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 sidebar">			
                <div class="candidate-vote">
                    <img src="{{url($img)}}" class="cand-pic">
                    <h5>Vote Form</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <!--{!! Form::open(array('route' => 'pay', 'id' => 'buy_votes_form', 'method' => 'post','class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}-->
                    {!! Form::open(array('class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}
                    <script src="https://js.paystack.co/v1/inline.js"></script>
                    @csrf
                    <div class="col-md-12">
                        <input type="hidden" id="voting_id" name="voting_id" value="{{$vote->id}}">
                        <input type="hidden" id="contestant_id" name="contestant_id" value="{{$contestants->id}}" >
                        <div class="form-group">
                            <input type="Number" name="quantity" id="quantity" value="" class="form-control" placeholder="Enter the total number of votes you">
                            @if($errors->has('quantity'))
                            <div class="error">{{ $errors->first('quantity') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" id="name" value="" class="form-control" placeholder="Enter your full name">
                            @if($errors->has('name'))
                            <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="email" value="" class="form-control" placeholder="Enter valid email for your receipt">
                            @if($errors->has('email'))
                            <div class="error">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" id="phone" value="" class="form-control" placeholder="Enter your phone number">
                            @if($errors->has('phone'))
                            <div class="error">{{ $errors->first('phone') }}</div>
                            @endif
                        </div>

                    </div>
                    <p class="vote-price">Each Vote costs <span>{{$vote->fees}} USD</span></p>
                    <p class="vote-payment"><button type="button" onclick="payWithPaystack()" class="btn btn-bg">Proceed To Payment</button></p>
                    </form>
                </div>

            </div>
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
                    <div class="justify-content-center"> <img src="{{url($img)}}" class="img-fluid profile-pic mb-4 mt-3"> </div>
                    <div class="fe-abs">
                        <span class="date-abs">Vote</span>
                        <div class="txt-card">
                            <div class="event-name">
                                <h2 class="titleh2 event-title">{{$voting->title}}</h2>

                            </div>
                            <p class="time-price"><span class="etime"><i class="far fa-clock"></i> Start {{$start_day .' '.$start_month. ' '.$start_date.' '.$start_year .' - '.$close_day.' '.$close_month.' '.$clos_date}}</span> </p>
                            <a class="btn btn-grad-bd ticket-details" href="{{url('contestants').'/'.$voting->id}}">View Contestants</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            <p align="center"> <a href="{{url('votes')}}" class="btn btn-bg mt-4">View All Votes</a></p>
        </div>
    </div>
</div>
<!-- place below the html form -->
<script>
    function payWithPaystack() {
        var fees = "{{$vote->fees}}";
        var phone = $('#phone').val();
        var name = $('#name').val();
        var quantity = $('#quantity').val();
        var amount = fees * quantity;
        var email = $('#email').val();
        var voting_id = "{{$vote->id}}";
        var contestant_id = "{{$contestants->id}}";
        var handler = PaystackPop.setup({
            key: 'pk_test_402e4abb808a62fc2ba080d79887f256cb5c574a',
            email: email,
            amount: amount,
            ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            metadata: {
                custom_fields: [
                    {
                        display_name: "Mobile Number",
                        variable_name: "mobile_number",
                        value: "+2348012345678"
                    }
                ]
            },
            callback: function (response) {
                var payurl = "{{url('vote/contestants')}}";
                var data = {'reference': response.reference, _token: "{!! csrf_token() !!}", 'name': name, 'fees': fees, 'phone': phone, 'quantity': quantity, 'amount': amount, 'email': email, 'voting_id': voting_id, 'contestant_id': contestant_id}
                $.ajax({
                    url: payurl,
                    type: "post",
                    data: data,
                    success: function (res) {
                        if (res.status == 1) {
                            $('#phone').val('');
                            $('#name').val('');
                            $('#quantity').val('');
                            $('#email').val('');
                            Swal.fire({
                                type: 'Success',
                                title: 'Success!',
                                text: data.message,
                                confirmButtonClass: 'btn btn-confirm mt-2',
                            });

                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'Error!',
                                text: 'Cannot buy votes',
                                confirmButtonClass: 'btn btn-confirm mt-2',
                            });
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });

            },
            onClose: function () {
                alert('window closed');
            }
        });
        handler.openIframe();
    }
</script>
@include('user.components.newsletter')
@include('user.components.trusted-brands')
@endsection

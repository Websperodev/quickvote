@extends('vendor.layouts.master')
@section("meta_page_title") Voting | Quickvote | Edit @endsection
@section("page_title") <a href="{!! route('vendor.voting.index') !!}" class="head-a"> Voting </a> > Edit @endsection
@section("content")
@php 
$timezoneArray = config('constants.timezones');
@endphp
<script>
    var typevote = "{{$VotingContest->type}}";
</script>

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Voting Contests</h4>
                @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                </div>
                @endif
                {!! Form::open(array('route' => 'vendor.edit.voting', 'id' => 'edit_voting_form', 'method' => 'post','class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}
                @csrf
                <div class="col-md-12 form-group cus-form-group">
                    <div class="col-md-12 form-group cus-form-group row">
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="Category">Category selection</label>
                        </div>
                        @if($VotingContest->category=='1')
                        <div class="col-md-3">
                            <label for="Category">Pageants (Not Categorized)</label>
                            <input type="radio" class="category" checked name="category" value="1">
                        </div>
                        <div class="col-md-3">
                            <label for="Category">Awards (Categorized)</label>
                            <input type="radio" class="category" name="category" value="2">
                        </div>
                        @else
                        <div class="col-md-3">
                            <label for="Category">Pageants (Not Categorized)</label>
                            <input type="radio" class="category"  name="category" value="1">
                        </div>
                        <div class="col-md-3">
                            <label for="Category">Awards (Categorized)</label>
                            <input type="radio" class="category" checked name="category" value="2">
                        </div>
                        @endif
                        @if($errors->has('category'))
                        <div class="error">{{$errors->first('category')}}</div>
                        @endif
                    </div>
                    <div class="col-md-12 form-group cus-form-group row">
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="type">Voting type</label>
                        </div>
                        @if($VotingContest->type=='paid')
                        <div class="col-md-3">
                            <label for="type">Paid</label>
                            <input type="radio" checked name="type" class="vote_type" id="vote_type" value="paid">
                        </div>
                        <div class="col-md-3">
                            <label for="type">Free</label>
                            <input type="radio"  name="type" class="vote_type" value="free">
                        </div>
                        @else
                        <div class="col-md-3">
                            <label for="type">Paid</label>
                            <input type="radio"  name="type" class="vote_type" id="vote_type" value="paid">
                        </div>
                        <div class="col-md-3">
                            <label for="type">Free</label>
                            <input type="radio" checked name="type" class="vote_type" value="free">
                        </div>
                        @endif
                        @if($errors->has('type'))
                        <div class="error">{{$errors->first('type')}}</div>
                        @endif
                    </div>
                    <div class="col-md-12 form-group cus-form-group row">
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="limit">Daily vote limit</label>
                        </div>
                        @if($VotingContest->limit=='0')
                        <div class="col-md-3">
                            <label for="limit">Unlimited</label>
                            <input type="radio" checked class="votelimit" name="limit" value="0">
                        </div>
                        <div class="col-md-3">
                            <label for="limit">Limited</label>
                            <input type="radio"  name="limit" class="votelimit" value="1">
                        </div>
                        @else
                        <div class="col-md-3">
                            <label for="limit">Unlimited</label>
                            <input type="radio"  class="votelimit" name="limit" value="0">
                        </div>
                        <div class="col-md-3">
                            <label for="limit">Limited</label>
                            <input type="radio" checked name="limit" class="votelimit" value="1">
                        </div>
                        @endif
                        @if($errors->has('limit'))
                        <div class="error">{{ $errors->first('limit') }}</div>
                        @endif
                        <div class="col-md-7 form-group cus-form-group votelimitcount">
                            <label for="limit_count">Vote Limit</label>
                            <input type="number" autocomplete="off" class="form-control" name="limit_count" id="limit_count" value="{{ isset($VotingContest->limit_count) ? $VotingContest->limit_count : ''}}" aria-describedby="emailHelp" placeholder="Enter limit count">
                            @if($errors->has('limit_count'))
                            <div class="error">{{ $errors->first('limit_count') }}</div>
                            @endif
                        </div>
                        <div class="col-md-7 form-group cus-form-group awardsCat" >
                            <label for="awards">Select Category</label>
                            <select class="form-control" name="category_id" id="event_category" aria-describedby="emailHelp">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option {{ $VotingContest->category_id == $category->id ? 'selected' : ''}}  value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                            @if($errors->has('category_id'))
                            <div class="error">{{ $errors->first('category_id') }}</div>
                            @endif
                        </div>
                        <div class="col-md-7 form-group cus-form-group payment_gateway">
                            <label for="payment_gateway">Select preferred payment gateway</label>
                            <select class="form-control" name="payment_gateway" autocomplete="off" id="payment_gateway" aria-describedby="emailHelp">
                                <option {{ $VotingContest->payment_gateway == 'paystack' ? 'selected' : ''}} value="paystack">Paystack</option>
                              
                            </select>
                            @if($errors->has('payment_gateway'))
                            <div class="error">{{ $errors->first('payment_gateway') }}</div>
                            @endif
                        </div>
                        <div class="col-md-12 form-group cus-form-group row">
                            <div class="col-md-12 form-group cus-form-group">
                                <label for="Profile">Contestant Profile view</label>
                            </div>
                            @if($VotingContest->packages=='0')
                            <div class="col-md-3">
                                <label for="Profile">OFF</label>
                                <input type="radio" checked name="packages" value="0">
                            </div>
                            <div class="col-md-3">
                                <label for="Profile">ON</label>
                                <input type="radio" name="packages" value="1">
                            </div>
                            @else
                            <div class="col-md-3">
                                <label for="Profile">OFF</label>
                                <input type="radio"  name="packages" value="0">
                            </div>
                            <div class="col-md-3">
                                <label for="Profile">ON</label>
                                <input type="radio" checked name="packages" value="1">
                            </div>
                            @endif
                            @if($errors->has('profile'))
                            <div class="error">{{ $errors->first('profile') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6 form-group cus-form-group">
                            <label for="image">Image</label>
                            @if(isset($VotingContest->image) && $VotingContest->image != '' )
                            <img src="{{ url($VotingContest->image) }}" width="150" height="150">
                            @endif
                            <input type="file"  class="form-control" name="image" id="image" aria-describedby="emailHelp" placeholder="Choose Image">
                            @if($errors->has('image'))
                            <div class="error">{{ $errors->first('image') }}</div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="title">Vote Contest title</label>
                                <input type="text" autocomplete="off" class="form-control" name="title" id="title" value="{{ isset($VotingContest->title) ? $VotingContest->title : ''}}" placeholder="Enter title">
                                @if($errors->has('title'))
                                <div class="error">{{ $errors->first('title') }}</div>
                                @endif
                            </div>

                            <div class="col-md-6 form-group cus-form-group votesfees">
                                <label for="fees">Voting Fee</label>
                                <input type="number" autocomplete="off" class="form-control" name="fees" id="organiser_name" value="{{ isset($VotingContest->fees) ? $VotingContest->fees : ''}}"  placeholder="Enter Voting fee">
                                @if($errors->has('fees'))
                                <div class="error">{{ $errors->first('fees') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="starting_date">Starting date</label>
                                <input type="text" autocomplete="off" class="form-control datetimepicker" value="{{ isset($VotingContest->viewstart_date) ? $VotingContest->viewstart_date : ''}}" name="starting_date" aria-describedby="emailHelp" placeholder="Enter Starting Date" >
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                @if($errors->has('starting_date'))
                                <div class="error">{{ $errors->first('starting_date') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="closing_date">Closing date</label>
                                <input type="text" autocomplete="off" class="form-control datetimepicker" value="{{ isset($VotingContest->viewclosing_date) ? $VotingContest->viewclosing_date : ''}}" name="closing_date"  aria-describedby="emailHelp" placeholder="Enter Closing Date">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                @if($errors->has('closing_date'))
                                <div class="error">{{ $errors->first('closing_date') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="timezone">Timezone</label>
                                <select class="form-control" name="timezone" id="timezone"  aria-describedby="emailHelp">
                                    @foreach($timezoneArray as $key=>$time)
                                    <option value="{{ $key }}" {{ $key == $VotingContest->timezone ? 'selected' : ''}}>{{ $key }}</option>
                                    @endforeach

                                </select>
                                @if($errors->has('timezone'))
                                <div class="error">{{ $errors->first('timezone') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">    
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="description">Description</label>
                            <textarea type="text" cols="50" class="form-control" name="description" id="area1" placeholder="Description here..">{{ isset($VotingContest->description)? ucfirst($VotingContest->description) : ''}} 
                            </textarea>
                            @if($errors->has('description'))
                            <div class="error">{{ $errors->first('description') }}</div>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" name="VotingContest_id" value="{{ isset($VotingContest->id ) ? $VotingContest->id  : ''}}"> 
                    <div class="btn-right">
                        <button type="submit" class="btn btn-bg ladda-button">Submit</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div> <!-- end card-body-->    </div>
    </div> 
</div>
</div> 

<script type="text/javascript">
      $(".datetimepicker").datetimepicker({
        format: 'm/d/Y H:i'
    });
</script>

<script>
    if (typevote == 'free') {
        $('.votesfees').hide();
        $('.payment_gateway').hide();
    }
    $('.vote_type').on('click', function () {
        var type = $(this).val();
        if (type == 'free') {
            $('.votesfees').hide();
            $('.payment_gateway').hide();
        } else {
            $('.votesfees').show();
            $('.payment_gateway').show();
        }
    })
    var evtstatus = $("input[name='status']:checked").val();
    if (evtstatus == 'Rejected') {
        $('.eventreason').show();
    } else {
        $('.eventreason').hide();
    }

    $('.eventstatus').on('click', function () {

        var evtstatus = $(this).val();
        if (evtstatus == 'Rejected') {
            $('.eventreason').show();
        } else {
            $('.eventreason').hide();
        }
    })
    $(document).ready(function () {

        var cat = $('input[name="category"]:checked').val();

        if (cat == 1) {
            $('.awardsCat').hide();
        } else {
            $('.awardsCat').show();
        }
        var limit = $('input[name="limit"]:checked').val();

        if (limit == 0) {
            $('.votelimitcount').hide();
        } else {
            $('.votelimitcount').show();
        }

        $('.category').on('click', function () {
            var cat = $(this).val();
            if (cat == 1) {
                $('.awardsCat').hide();
            } else {
                $('.awardsCat').show();
            }
        })
        $('.votelimit').on('click', function () {
            var limit = $(this).val();
            if (limit == 0) {
                $('.votelimitcount').hide();
            } else {
                $('.votelimitcount').show();
            }
        })
    });

    $('.vote_type').on('click', function () {
        var type = $(this).val();
        if (type == 'free') {
            $('.votesfees').hide();
            $('.payment_gateway').hide();
        } else {
            $('.votesfees').show();
            $('.payment_gateway').show();
        }
    })
</script>
@endsection
@section('script-bottom')
@endsection
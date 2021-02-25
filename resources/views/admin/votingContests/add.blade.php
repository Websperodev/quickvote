@extends('admin.layouts.master')
@section("meta_page_title") Voting | Quickvote | Dashboard @endsection
@section("page_title") <a href="{!! route('admin.voting.index') !!}" class="head-a"> Voting </a> > Add @endsection


@section("content")
@php 
$timezoneArray = config('constants.timezones');
@endphp

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

                {!! Form::open(array('route' => 'admin.add.voting', 'id' => 'add_voting_form', 'method' => 'post','class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}

                @csrf

                <div class="col-md-12 form-group cus-form-group">

                    <div class="col-md-12 form-group cus-form-group row">
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="Category">Category selection</label>
                        </div>
                        <div class="col-md-3">
                            <label for="Category">Pageants (Not Categorized)</label>
                            <input type="radio" checked name="category">
                        </div>
                        <div class="col-md-3">
                            <label for="Category">Awards (Categorized)</label>
                            <input type="radio"  name="category">
                        </div>
                        @if($errors->has('category'))
                        <div class="error">{{ $errors->first('category') }}</div>
                        @endif
                    </div>

                    <div class="col-md-12 form-group cus-form-group row">
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="type">Voting type</label>
                        </div>
                        <div class="col-md-3">
                            <label for="type">Paid</label>
                            <input type="radio"  name="type" value="paid">
                        </div>
                        <div class="col-md-3">
                            <label for="type">Free</label>
                            <input type="radio" checked name="type" value="free">
                        </div>
                        @if($errors->has('type'))
                        <div class="error">{{ $errors->first('type') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12 form-group cus-form-group row">
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="packages">Vote packages</label>
                        </div>
                        <div class="col-md-3">
                            <label for="packages">Disabled</label>
                            <input type="radio" checked name="packages" value="0">
                        </div>
                        <div class="col-md-3">
                            <label for="packages">Enabled</label>
                            <input type="radio"  name="packages" value="1">
                        </div>
                        @if($errors->has('packages'))
                        <div class="error">{{ $errors->first('packages') }}</div>
                        @endif
                    </div>
                    <div class="col-md-12 form-group cus-form-group row">
                        <div class="col-md-12 form-group cus-form-group">
                            <label for="limit">Daily vote limit</label>
                        </div>
                        <div class="col-md-3">
                            <label for="limit">Unlimited</label>
                            <input type="radio" checked class="limit" name="limit" value="0">
                        </div>
                        <div class="col-md-3">
                            <label for="limit">Limited</label>
                            <input type="radio"  name="limit" class="limit" value="1">
                        </div>
                        @if($errors->has('limit'))
                        <div class="error">{{ $errors->first('limit') }}</div>
                        @endif

                        <div class="col-md-7 form-group cus-form-group">
                            <label for="limit_count">Vote Limit</label>
                            <input type="number" autocomplete="off" class="form-control" name="limit_count" id="organiser_name" value="" aria-describedby="emailHelp" placeholder="Enter limit count">
                            @if($errors->has('limit_count'))
                            <div class="error">{{ $errors->first('limit_count') }}</div>
                            @endif
                        </div>
                        <div class="col-md-7 form-group cus-form-group">
                            <label for="awards">Number of Award Categories (if categorised)</label>
                            <input type="number" autocomplete="off" class="form-control" name="awards" id="awards" value="" aria-describedby="emailHelp" placeholder="Enter awards">
                            @if($errors->has('awards'))
                            <div class="error">{{ $errors->first('awards') }}</div>
                            @endif
                        </div>
                        <div class="col-md-7 form-group cus-form-group">
                            <label for="payment">Select preferred payment gateway</label>
                            <select class="form-control" name="event_priority"autocomplete="off" id="event_priority" aria-describedby="emailHelp">

                                <option value="paystack">Paystack</option>
                                <option value="flutterwavwe">Flutterwavwe</option>
                                <option value="payu">Payu</option>
                                <option value="interswitch">Interswitch</option>
                            </select>
                            @if($errors->has('event_priority'))
                            <div class="error">{{ $errors->first('event_priority') }}</div>
                            @endif
                        </div>
                        <div class="col-md-12 form-group cus-form-group row">
                            <div class="col-md-12 form-group cus-form-group">
                                <label for="Profile">Contestant Profile view</label>
                            </div>
                            <div class="col-md-3">
                                <label for="Profile">OFF</label>
                                <input type="radio"  name="packages" value="0">
                            </div>
                            <div class="col-md-3">
                                <label for="Profile">ON</label>
                                <input type="radio"  name="packages" value="1">
                            </div>
                            @if($errors->has('profile'))
                            <div class="error">{{ $errors->first('profile') }}</div>
                            @endif
                        </div>


                        <div class="row">
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="title">Vote Contest title</label>
                                <input type="text" autocomplete="off" class="form-control" name="title" id="title" value="" placeholder="Enter title">
                                @if($errors->has('title'))
                                <div class="error">{{ $errors->first('title') }}</div>
                                @endif
                            </div>

                            <div class="col-md-6 form-group cus-form-group">
                                <label for="image">Image</label>
                                <input type="file"  class="form-control" name="image" id="image" aria-describedby="emailHelp" placeholder="Choose Image">
                                @if($errors->has('image'))
                                <div class="error">{{ $errors->first('image') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="fees">Voting Fee</label>
                                <input type="number" autocomplete="off" class="form-control" name="fees" id="organiser_name" value=""  placeholder="Enter Voting fee">
                                @if($errors->has('fees'))
                                <div class="error">{{ $errors->first('fees') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="starting_date">Starting date</label>
                                <input type="text" autocomplete="off" class="form-control datetimepicker" name="starting_date" id="start-date" aria-describedby="emailHelp" placeholder="Enter Starting Date" >

                                <i class="fa fa-calendar" aria-hidden="true"></i>


                                @if($errors->has('starting_date'))
                                <div class="error">{{ $errors->first('starting_date') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="closing_date">Closing date</label>
                                <input type="text" autocomplete="off" class="form-control datetimepicker" name="closing_date" id="end_date" aria-describedby="emailHelp" placeholder="Enter Closing Date">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                @if($errors->has('closing_date'))
                                <div class="error">{{ $errors->first('closing_date') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="timezone">Timezone</label>

                                <select class="form-control" name="timezone" id="timezone" aria-describedby="emailHelp">

                                    @foreach($timezoneArray as $key=>$time)
                                    @if($key=='Africa/Lagos')
                                    <option value="{{ $key }}" selected>{{ $key }}</option>                                
                                    @else
                                    <option value="{{ $key }}">{{ $key }}</option>
                                    @endif
                                    @endforeach
                                </select>

                                @if($errors->has('timezone'))
                                <div class="error">{{ $errors->first('timezone') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
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
       $(document).ready(function(){
          $('.').()
     });
    
    
</script>
@endsection



@section('script-bottom')



@endsection
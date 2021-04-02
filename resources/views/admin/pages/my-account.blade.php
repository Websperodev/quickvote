@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Dashboard @endsection
@section("page_title") Dashboard @endsection


@section("content")

<div class="row justify-content-center">
    <script>
        var country = "{{$user->country_id}}";
        var state = "{{$user->state_id}}";
        var city = "{{$user->city_id}}";

    </script>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">My Account</h4>
                @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                </div>
                @endif
                <form id="my_account_form" method="post" class = "custum-frm" action="{{ route('admin.update.profile') }}">
                    @csrf

                    @php
                    $userCountry = isset($user->country_id) ? $user->country_id : '161';
                    $userState = isset($user->state_id) ? $user->state_id : '';
                    $userCity = isset($user->city_id) ? $user->city_id : '';
                    @endphp
                    <div class="my-account mb-2">
                        <div class="row">
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" value="{{ isset($user->first_name) ? $user->first_name : ''}}" name="first_name" id="first_name" aria-describedby="emailHelp" placeholder="Enter First Name">
                                @if($errors->has('first_name'))
                                <div class="error">{{ $errors->first('first_name') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" value="{{ isset($user->last_name) ? $user->last_name : ''}}" name="last_name" id="last_name" aria-describedby="emailHelp" placeholder="Enter Last Name">
                                @if($errors->has('last_name'))
                                <div class="error">{{ $errors->first('last_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="business_name">Business Name</label>
                                <input type="text" class="form-control" value="{{ isset($user->business_name) ? $user->business_name : ''}}" name="business_name" id="business_name" aria-describedby="emailHelp" placeholder="Enter Business Name">
                                @if($errors->has('business_name'))
                                <div class="error">{{ $errors->first('business_name') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="contact_name">Contact Name</label>
                                <input type="text" class="form-control" value="{{ isset($user->contact_name) ? $user->contact_name : ''}}" name="contact_name" id="contact_name" aria-describedby="emailHelp" placeholder="Enter Contact Name">
                                @if($errors->has('contact_name'))
                                <div class="error">{{ $errors->first('contact_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group cus-form-group">
                                <label for="email">Email</label>
                                <input type="text" readonly="readonly" class="form-control" value="{{ isset($user->email) ? $user->email : ''}}" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Contact Name">
                                @if($errors->has('email'))
                                <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" value="{{ isset($user->phone) ? $user->phone : ''}}" name="phone" id="phone" aria-describedby="emailHelp" placeholder="Enter Phone Number">
                                @if($errors->has('phone'))
                                <div class="error">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="alternate_phone">Alternate Phone Number</label>
                                <input type="text" class="form-control" value="{{ isset($user->alternate_phone) ? $user->alternate_phone : ''}}" name="alternate_phone" id="alternate_phone" aria-describedby="emailHelp" placeholder="Enter Alternate Phone Number">
                                @if($errors->has('alternate_phone'))
                                <div class="error">{{ $errors->first('alternate_phone') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="address1">Address1</label>
                                <input type="text" class="form-control" value="{{ isset($user->address1) ? $user->address1 : ''}}" name="address1" id="address1" aria-describedby="emailHelp" placeholder="Enter Address1">
                                @if($errors->has('address1'))
                                <div class="error">{{ $errors->first('address1') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="address1">Address2</label>
                                <input type="text" class="form-control" value="{{ isset($user->address2) ? $user->address2 : ''}}" name="address2" id="address2" aria-describedby="emailHelp" placeholder="Enter Address2">
                                @if($errors->has('address2'))
                                <div class="error">{{ $errors->first('address2') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">   
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="country">Country</label>

                                <select class="form-control" name="country" id="country" aria-describedby="emailHelp">                                
                                    @foreach($countries as $country)
                                    <option {{ $userCountry == $country->id ? 'selected' : ''}} value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('country'))
                                <div class="error">{{ $errors->first('country') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="state">State</label>
                                <option value="">Choose State</option>
                                <select class="form-control" name="state" id="state" aria-describedby="emailHelp">
                                    <option value="">Select State</option>

                                </select>

                                @if($errors->has('state'))
                                <div class="error">{{ $errors->first('state') }}</div>
                                @endif
                            </div>       
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="city">City</label>
                                <select class="form-control" name="city" id="city" aria-describedby="emailHelp">
                                    <option value="">Choose City</option>

                                </select>

                                @if($errors->has('city'))
                                <div class="error">{{ $errors->first('city') }}</div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group cus-form-group">
                                <label for="postal">Postal</label>
                                <input type="text" class="form-control" value="{{ isset($user->postal) ? $user->postal : ''}}" name="postal" id="postal" aria-describedby="emailHelp" placeholder="Enter Postal">
                                @if($errors->has('postal'))
                                <div class="error">{{ $errors->first('postal') }}</div>
                                @endif
                            </div>   
                        </div>
                        <div class="row">    
                            <div class="col-md-12 form-group cus-form-group">
                                <label for="description">Description</label>
                                <textarea type="text" name="description" class="form-control" placeholder="Description here..">{{ isset($user->description ) ? $user->description  : ''}}</textarea>
                                @if($errors->has('description'))
                                <div class="error">{{ $errors->first('description') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="btn-right">
                            <button type="submit" class="btn btn-bg ladda-button">Submit</button>
                        </div>
                    </div>
                </form>
            </div> <!-- end card-body-->
        </div> 
    </div>
</div> 
@endsection



@section('script-bottom')

<script type="text/javascript">
    $(document).ready(function () {

        if (country != '') {
            var cid = country;
        } else {
            var cid = 1;
        }

        if (state != '') {
            var stateId = state;
        } else {
            var stateId = 1;
        }
        if (city != '') {
            var cityId = city;
        } else {
            var cityId = 1;
        }

        var url = '{{ route("states", ":id") }}';
        url = url.replace(':id', cid);
        var selected = '';
        $.ajax({
            type: 'GET',
            url: url,
            success: function (res) {
                if (res) {
                    $("#state").empty();
                    $.each(res, function (key, value) {
                        if (stateId == value.id) {
                            selected = "selected";
                        } else {
                            selected = '';
                        }
                        $("#state").append('<option ' + selected + ' value="' + value.id + '">' + value.name + '</option>');
                    });

                } else {
                    $("#state").empty();
                }

            },
            error: function (err) {
                console.log(err);
            }
        });


        var cityUrl = '{{ route("cities", ":id") }}';
        cityUrl = cityUrl.replace(':id', stateId);
        $.ajax({
            type: 'GET',
            url: cityUrl,
            success: function (res) {
                if (res)
                {
                    $("#city").empty();
                    $.each(res, function (key, value) {
                        if (cityId == value.id) {
                            selected = "selected";
                        } else {
                            selected = '';
                        }
                        $("#city").append('<option ' + selected + ' value="' + value.id + '">' + value.name + '</option>');
                    });
                } else {

                    $("#city").empty();
                }

            },
            error: function (err) {
                console.log(err);
            }

        });

    });

    $('#country').change(function () {
        var cid = $(this).val();
        var url = '{{ route("states", ":id") }}';
        url = url.replace(':id', cid);

        if (cid) {
            $.ajax({
                type: 'GET',
                url: url,
                success: function (res) {
                    console.log('response', res);
                    if (res) {
                        $("#state").empty();
                        if (res != '') {
                            var stateid = res[0].id;
                            citylist(stateid);
                        } else {
                            $("#state").empty();
                            $("#city").empty();
                        }
                        $.each(res, function (key, value) {
                            $("#state").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });

                    } else {
                        $("#state").empty();
                    }

                },
                error: function (err) {
                    console.log(err);
                }
            });
        }


    });
    function citylist(stateid) {
        var ctyurl = '{{ route("cities", ":id") }}';
        ctyurl = ctyurl.replace(':id', stateid);
        $.ajax({
            type: 'GET',
            url: ctyurl,
            success: function (res) {
                console.log('response', res);
                if (res)
                {
                    $("#city").empty();
                    $.each(res, function (key, value) {
                        $("#city").append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                } else {
                    $("#city").empty();
                }

            },
            error: function (err) {
                console.log(err);
            }
        });
    }
    $('#state').change(function () {
        var sid = $(this).val();
        citylist(sid);
    });
</script>


@endsection
@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Dashboard @endsection
@section("page_title") Users @endsection


@section("content")

<div class="row justify-content-center">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Users</h4>
                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                    </div>
                @endif

                {!! Form::open(array('route' => 'admin.add.user', 'id' => 'add_user_form', 'method' => 'post' )) !!}

                	@csrf

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
                            <input type="text"  class="form-control" value="{{ isset($user->email) ? $user->email : ''}}" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email">
                            @if($errors->has('email'))
                                <div class="error">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        
                    </div>

                     <div class="row">
                        <div class="col-md-6 form-group cus-form-group">
                            <label for="email">Password</label>
                            <input type="text"  class="form-control" name="password" id="password" aria-describedby="emailHelp" placeholder="Enter Password">
                            @if($errors->has('password'))
                                <div class="error">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                         <div class="col-md-6 form-group cus-form-group">
                            <label for="email">User Type</label>
                            <select class="form-control" name="user_type">
                                <option value="">Select Type</option>
                                <option value="user"  title="User">User</option>
                                <option value="vendor"  title="Vendor">Vendor</option> 
                            </select>
                            
                            @if($errors->has('user_type'))
                                <div class="error">{{ $errors->first('user_type') }}</div>
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
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>

                            @if($errors->has('country'))
                                <div class="error">{{ $errors->first('country') }}</div>
                            @endif
                        </div>
                    

                        <div class="col-md-6 form-group cus-form-group">
                            <label for="state">State</label>
                            
                            <select class="form-control" name="state" id="state" aria-describedby="emailHelp">
                                <option value="">Select State</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
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
                                <option value="">Select City</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
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
                </form>
            </div> <!-- end card-body-->
        </div> 
    </div>
</div> 
@endsection



@section('script-bottom')
<script type="text/javascript">
    
    $('#country').change(function(){
        var cid = $(this).val();
        var url = '{{ route("states", ":id") }}';
        url = url.replace(':id', cid);
       
        if(cid){
            $.ajax({
                    type: 'GET',
                    url: url,
                    success: function (res) {
                      console.log('response',res);
                      if(res){
                        $("#state").empty();
                        $("#state").append('<option>Select</option>');
                        $.each(res,function(key,value){
                          $("#state").append('<option value="'+key+'">'+value+'</option>');
                        });
                      
                      }else{
                        $("#state").empty();
                      }
                      
                    },
                    error: function(err) {
                      console.log(err);
                    }
            });
        }

       
    });
    $('#state').change(function(){
        var sid = $(this).val();

        var url = '{{ route("cities", ":id") }}';
        url = url.replace(':id', sid);
       console.log(url);

        if(sid){
            $.ajax({
                    type: 'GET',
                    url: url,
                    success: function (res) {
                    console.log('response',res);
                        if(res)
                        {
                            $("#city").empty();
                            $("#city").append('<option>Select City</option>');
                            $.each(res,function(key,value){
                                $("#city").append('<option value="'+key+'">'+value+'</option>');
                            });
                        }else{
                            $("#city").empty();
                        }
                      
                    },
                    error: function(err) {
                      console.log(err);
                    }
            });
        }   
        
    }); 

</script>


@endsection
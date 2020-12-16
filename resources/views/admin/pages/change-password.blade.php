@extends('vendor.layouts.master')
@section("meta_page_title") Admin | Quickvote | Dashboard @endsection
@section("page_title") Dashboard @endsection


@section("content")

<div class="row justify-content-center">
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Change Password</h4>
                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                    </div>
                @endif
                <form id="change_password_form" method="post" action="{{ route('admin.update.password') }}">
                	@csrf
                    <div class="form-group cus-form-group">
                        <label for="old_password">Old Password</label>
                        <input type="password" class="form-control" name="old_password" id="old_password" aria-describedby="emailHelp" placeholder="Enter old password">
                        @if($errors->has('old_password'))
						    <div class="error">{{ $errors->first('old_password') }}</div>
						@endif
                 	</div>
                    <div class="form-group cus-form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" name="new_password" id="new_password" aria-describedby="emailHelp" placeholder="Enter New Password">
                        @if($errors->has('new_password'))
						    <div class="error">{{ $errors->first('new_password') }}</div>
						@endif
                    </div>
                 	<div class="form-group cus-form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" aria-describedby="emailHelp" placeholder="Enter Confirm Password">
                        @if($errors->has('confirm_password'))
						    <div class="error">{{ $errors->first('confirm_password') }}</div>
						@endif
                    </div>
                    
                    <div class="btn-right">
                    <button type="submit" class="btn btn-primary waves-effect waves-light ladda-button">Submit</button>
                    </div>
                </form>
            </div> <!-- end card-body-->
        </div> 
    </div>
</div> 
@endsection



@section('script-bottom')


@endsection
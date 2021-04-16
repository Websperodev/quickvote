@extends('admin.layouts.master')
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
                <form id="change_password_form" class = "custum-frm" method="post" action="{{ route('admin.update.password') }}">
                    @csrf
                    <div class="my-account mb-2">
                        <div class="form-group cus-form-group">
                            <label for="old_password">Old Password</label>
                            <input type="password" class="form-control" name="old_password" id="old_password" aria-describedby="emailHelp" placeholder="Enter old password">
                            <span><i class="fa fa-eye" aria-hidden="true" onclick="showPassword('old_password')"></i></span>
                            @if($errors->has('old_password'))
                            <div class="error">{{ $errors->first('old_password') }}</div>
                            @endif
                        </div>
                        <div class="form-group cus-form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" name="new_password" id="new_password" aria-describedby="emailHelp" placeholder="Enter New Password">
                            <span><i class="fa fa-eye" aria-hidden="true" onclick="showPassword('new_password')"></i></span>
                            @if($errors->has('new_password'))
                            <div class="error">{{ $errors->first('new_password') }}</div>
                            @endif
                        </div>
                        <div class="form-group cus-form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" aria-describedby="emailHelp" placeholder="Enter Confirm Password">
                            <span><i class="fa fa-eye" aria-hidden="true" onclick="showPassword('confirm_password')"></i></span>
                            @if($errors->has('confirm_password'))
                            <div class="error">{{ $errors->first('confirm_password') }}</div>
                            @endif
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
@if(session()->has("message.level") && session("message.text")=="Password changed successfully.")

<script>
    Swal.fire({
        title: 'Success ',
        text: "Password has been changed successfully ",
        type: 'success',
        timer: 2000,
        confirmButtonColor: '#6658dd',
    }).then((result) => {
        window.location.href = '{{url("/admin")}}';
    })
</script>
@endif
<script type="text/javascript">
    function showPassword(id) {
        var x = document.getElementById(id);
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>


@endsection
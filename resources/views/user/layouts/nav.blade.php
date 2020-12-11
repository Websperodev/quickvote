<header>


    <nav id="navbar_top" class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="#"><img class="logo" src="{{asset('img/qv-logo.png')}}"></a>
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" aria-controls="navbarNavAltMarkup">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        <a class="nav-link" href="#">About Us</a>
        <a class="nav-link" href="#">How It Works</a>
        <a class="nav-link" href="#">Pricing</a>
        <a class="nav-link" href="#">FAQs</a>
        <a class="nav-link" href="#">Contact</a>
      </div>
      <div class="reg-login">
        <a href="" class="btn btn-bg" data-toggle="modal" data-target="#resetPassModal">Create Event</a>

    
        @if(Auth::user())
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <span class="pro-user-name ml-1">
            {{ isset(\Auth::user()->first_name) ? ucfirst(\Auth::user()->first_name) : 'User'}} <i class="mdi mdi-chevron-down"></i> 
            </span>
          </a>
           <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>
    
                    <!-- item-->
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#editProfileModal" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Edit Profile</span>
                    </a>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#changePassModal"  class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Change Password</span>
                    </a>
    
                    <div class="dropdown-divider"></div>
    
                    <!-- item-->
                    <a href="{{ route('user.logout') }}" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>
                    
                </div>

          <!-- <a href="{{ route('user.logout') }}" class="btn btn-grad-bd"> <span>Logout </span></a> -->
        @else
          <a data-toggle="modal" data-target="#loginModal" class="btn btn-grad-bd"> <span>Login </span></a>
        @endif
       
      </div>
     
        
      </div>
    </div>
    </nav>
  </header>
@include('user.components.login')
 
@include('user.components.user-register')
  
@include('user.components.vendor-register')
  
@include('user.components.forget-password')
 
@include('user.components.reset-password')

@include('user.components.edit-profile')

@include('user.components.change-password')
  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script>
$(document).ready(function () {
  $('.modal').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
  })

  $('#openSignUp').click(function() {
    $('#loginModal').modal('hide');
    $('#registerModal').modal('show');
  });

  $('#vendorSignUp').click(function() {
    $('#registerModal').modal('hide');
    $('#vendorModal').modal('show');
  });

  $('#resetPass').click(function() {
    $('#loginModal').modal('hide');
    $('#forgetPassModal').modal('show');
  });

  $("#register-frm-user").validate({
         ignore: ":hidden",
         rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 3
            },
            confirm_password: {
                required: true,
                equalTo : "#password"
            },
             
         },
         submitHandler: function (form) {
             $.ajax({
                type: 'POST',
                url: "{{ route('user.register') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('form.register-frm-user').serialize(),
                success: function (response) {
                  console.log(response);
                  if(response.success == true){
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: response.message,
                      text: 'Please verify Email',
                      showConfirmButton: false,
                      showCloseButton: true,
                      
                    })
                    $('#registerModal').modal('hide');
                  }else{
                     $.each(response.errors, function(key, value){
                        $('.alert-danger').show();
                        $('.alert-danger').append('<p>'+value+'</p>');
                      });
                  }
                },
                error: function(err) {
                  console.log(err);
                }
             });
             return false; // required to block normal submit since you used ajax
         }
  });

  $("#register-frm-vendor").validate({
         ignore: ":hidden",
         rules: {
            first_name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
             
         },
         submitHandler: function (form) {
             $.ajax({
                type: 'POST',
                url: "{{ route('vendor.register') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('form.register-frm-vendor').serialize(),
                success: function (response) {
                  console.log(response);
                  if(response.success == true){
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: response.message,
                      text: 'Please verify Email',
                      showConfirmButton: false,
                      showCloseButton: true,
                      
                    })
                    $('#vendorModal').modal('hide');
                  }else{
                     $.each(response.errors, function(key, value){
                        $('.alert-danger').show();
                        $('.alert-danger').append('<p>'+value+'</p>');
                      });
                  }
                },
                error: function(err) {
                  console.log(err);
                }
             });
             return false; // required to block normal submit since you used ajax
         }
  });

  $("#login-frm-user").validate({
         ignore: ":hidden",
         rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            }             
         },
         submitHandler: function (form) {
          $(".alert-danger").hide();
          $(".alert-danger").empty();

             $.ajax({
                type: 'POST',
                url: "{{ route('user.login') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('form.login-frm-user').serialize(),
                success: function (response) {
                  console.log(response);
                  if(response.success == true){
                    if(response.user_type == 'user'){
                      location.href = "{{ route('user.dashboard') }}"; 
                    }
                    if(response.user_type == 'vendor'){
                      location.href = "{{ route('vendor.dashboard') }}"; 
                    }
                  }else{ 

                      $.each(response.errors, function(key, value){
                        $('.alert-danger').show();
                        $('.alert-danger').append('<p>'+value+'</p>');
                      });  
                  }
                  
                },
                error: function(err) {
                  console.log(err);
                }
             });
             return false; // required to block normal submit since you used ajax
         }
  });

  $("#forget-pass-frm").validate({
         ignore: ":hidden",
         rules: {
            email: {
                required: true,
                email: true
            },          
         },
         submitHandler: function (form) {
          $(".alert-danger").hide();
          $(".alert-danger").empty();

             $.ajax({
                type: 'POST',
                url: "{{ route('forget.password') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('form.forget-pass-frm').serialize(),
                success: function (response) {
                  console.log(response);
                  if(response.success == true){
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: response.message,
                      showConfirmButton: false,
                      showCloseButton: true,
                      
                    })
                    $('#forgetPassModal').modal('hide');
                    
                  }else{ 

                      $.each(response.errors, function(key, value){
                        $('.alert-danger').show();
                        $('.alert-danger').append('<p>'+value+'</p>');
                      });  
                  }
                  
                },
                error: function(err) {
                  console.log(err);
                }
             });
             return false; // required to block normal submit since you used ajax
         }
  });

  $("#reset-pass-frm").validate({
         ignore: ":hidden",
         rules: {
            password: {
                required: true,
                minlength: 8
            },
            confirm_password: {
                required: true,
                equalTo : "#pass"
            },          
         },
         submitHandler: function (form) {
          $(".alert-danger").hide();
          $(".alert-danger").empty();

             $.ajax({
                type: 'POST',
                url: "{{ route('reset.password') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('form.reset-pass-frm').serialize(),
                success: function (response) {
                  console.log(response);
                  if(response.success == true){
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: response.message,
                      showConfirmButton: false,
                      showCloseButton: true,
                      
                    })
                    $('#resetPassModal').modal('hide');
                    
                  }else{ 

                      $.each(response.errors, function(key, value){
                        $('.alert-danger').show();
                        $('.alert-danger').append('<p>'+value+'</p>');
                      });  
                  }
                  
                },
                error: function(err) {
                  console.log(err);
                }
             });
             return false; // required to block normal submit since you used ajax
         }
  });

  $("#change-pass-frm").validate({
         ignore: ":hidden",
         rules: {
            old_password: {
                required: true,
                minlength: 8
            },
            new_password: {
                required: true,
                minlength: 8
            }, 
            confirm_password: {
                required: true,
                equalTo : "#new_password"
            },         
         },
         submitHandler: function (form) {
          $(".alert-danger").hide();
          $(".alert-danger").empty();

             $.ajax({
                type: 'POST',
                url: "{{ route('user.updatePass') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('form.change-pass-frm').serialize(),
                success: function (response) {
                  console.log(response);
                  if(response.success == true){
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: response.message,
                      showConfirmButton: false,
                      showCloseButton: true,
                      
                    })
                    $('#changePassModal').modal('hide');
                    
                  }else{ 

                      $.each(response.errors, function(key, value){
                        $('.alert-danger').show();
                        $('.alert-danger').append('<p>'+value+'</p>');
                      });  
                  }
                  
                },
                error: function(err) {
                  console.log(err);
                }
             });
             return false; // required to block normal submit since you used ajax
         }
  });


  $("#edit-profile-frm").validate({
         ignore: ":hidden",
         rules: {
            old_password: {
                required: true,
                minlength: 8
            },
            new_password: {
                required: true,
                minlength: 8
            }, 
            confirm_password: {
                required: true,
                equalTo : "#new_password"
            },         
         },
         submitHandler: function (form) {
          $(".alert-danger").hide();
          $(".alert-danger").empty();

             $.ajax({
                type: 'POST',
                url: "{{ route('user.editProfile') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('form.edit-profile-frm').serialize(),
                success: function (response) {
                  console.log(response);
                  if(response.success == true){
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: response.message,
                      showConfirmButton: false,
                      showCloseButton: true,
                      
                    })
                    $('#editProfileModal').modal('hide');
                    location.reload();
                  }else{ 

                      $.each(response.errors, function(key, value){
                        $('.alert-danger').show();
                        $('.alert-danger').append('<p>'+value+'</p>');
                      });  
                  }
                  
                },
                error: function(err) {
                  console.log(err);
                }
             });
             return false; // required to block normal submit since you used ajax
         }
  });

});

</script>
@if(isset($message) && $message != '')
<script type="text/javascript">
    $(document).ready(function() {
        alert("{{ $message }}");
    });
</script>
@endif

@if(isset($page) && $page == 'forgetPassword')
<script type="text/javascript">
    $(window).on('load',function(){
        $('#resetPassModal').modal('show');
    });
</script>
@endif

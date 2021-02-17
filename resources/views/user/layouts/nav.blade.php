<header>

    <script>
        var imageUrl="{{url('/')}}";
//        alert(imageUrl);
        </script>
    <nav id="navbar_top" class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img class="logo" src="{{asset('img/qv-logo.png')}}"></a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" aria-controls="navbarNavAltMarkup">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                    <a class="nav-link" href="{{ route('about-us') }}">About Us</a>
                    <a class="nav-link" href="{{ route('our-services') }}">Services</a>
                    <a class="nav-link" href="{{ route('pricing') }}">Pricing</a>
                    <a class="nav-link" href="{{ route('faq') }} ">FAQs</a>
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                </div>
                <div class="reg-login">
                    <a href="{{ route('search-event') }}" class="btn btn-bg">Create Event</a>


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
<script type="text/javascript">

function showPassword(id) {
    var x = document.getElementById(id);
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
$(document).ready(function () {
    $('.modal').on('hidden.bs.modal', function () {
        $('.alert-danger').hide();
        $(this).find('form').trigger('reset');
    })

    $('#openSignUp').click(function () {
        $('#loginModal').modal('hide');
        $('#registerModal').modal('show');

        setTimeout(function () {
            jQuery("body").addClass("modal-open");
        }, 700);

    });

    $('#vendorSignUp').click(function () {
        $('#registerModal').modal('hide');
        $('#vendorModal').modal('show');
        setTimeout(function () {
            jQuery("body").addClass("modal-open");
        }, 700);
    });

    $('#resetPass').click(function () {
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
                equalTo: "#user-password"
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
                    if (response.success == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            text: 'Please verify Email',
                            showConfirmButton: false,
                            showCloseButton: true,

                        })
                        $('#registerModal').modal('hide');
                    } else {
                        $.each(response.errors, function (key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<p>' + value + '</p>');
                        });
                    }
                },
                error: function (err) {
                    console.log(err);
                }
            });
            return false; // required to block normal submit since you used ajax
        }
    });

    $("#vendForm").validate({
        ignore: ":hidden",
        rules: {
            company_name: {
                required: true,
                minlength: 3
            },
            company_address: {
                required: true,

            },
            company_country: {
                required: true,
            },
            company_state: {
                required: true,
            },
            company_city: {
                required: true,
            },
            company_phone: {
                required: true,
            },
            company_email: {
                required: true,
            },
            company_website: {
                required: true,
            },
            company_description: {
                required: true,
            },
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            business_name: {
                required: true,
            },
            email: {
                required: true,
            },
            password: {
                required: true,
            },
            phone: {
                required: true,
            },
            alternate_phone: {
                required: true,
            },
            address1: {
                required: true,
            },
            address2: {
                required: true,
            },
            postcode: {
                required: true,
            },
            country: {
                required: true,
            },
            state: {
                required: true,
            },
            city: {
                required: true,
            },
            account_holder_name: {
                required: true,
            },
            account_no: {
                required: true,
            },
            bank_name: {
                required: true,
            }

        },
        submitHandler: function (form) {
            console.log('vendor reg');
            $.ajax({
                type: 'POST',
                url: "{{ route('vendor.register') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('form#vendForm').serialize(),
                success: function (response) {
                    console.log(response);
                    if (response.success == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            text: 'Please verify Email',
                            showConfirmButton: false,
                            showCloseButton: true,

                        })
                        $('.tab').css('display', 'none');
                        $('#tabs-1').css('display', 'block');
                        $('#vendorModal').modal('hide');
                    } else {
                        $.each(response.errors, function (key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<p>' + value + '</p>');
                        });
                    }
                },
                error: function (err) {
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
                    if (response.success == true) {
                        if (response.user_type == 'user') {
                            location.href = "{{ route('user.dashboard') }}";
                        }
                        if (response.user_type == 'vendor') {
                            location.href = "{{ route('vendor.dashboard') }}";
                        }
                    } else {

                        $.each(response.errors, function (key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<p>' + value + '</p>');
                        });
                    }

                },
                error: function (err) {
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
                    if (response.success == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            showCloseButton: true,

                        })
                        $('#forgetPassModal').modal('hide');

                    } else {

                        $.each(response.errors, function (key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<p>' + value + '</p>');
                        });
                    }

                },
                error: function (err) {
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
                equalTo: "#pass"
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
                    if (response.success == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            showCloseButton: true,

                        })
                        $('#resetPassModal').modal('hide');

                    } else {

                        $.each(response.errors, function (key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<p>' + value + '</p>');
                        });
                    }

                },
                error: function (err) {
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
                equalTo: "#new_password"
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
                    if (response.success == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            showCloseButton: true,

                        })
                        $('#changePassModal').modal('hide');

                    } else {

                        $.each(response.errors, function (key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<p>' + value + '</p>');
                        });
                    }

                },
                error: function (err) {
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
                equalTo: "#new_password"
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
                    if (response.success == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            showCloseButton: true,

                        })
                        $('#editProfileModal').modal('hide');
                        location.reload();
                    } else {

                        $.each(response.errors, function (key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<p>' + value + '</p>');
                        });
                    }

                },
                error: function (err) {
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
    $(document).ready(function () {
        console.log("{{ $message }}");
    });
</script>
@endif

@if(isset($page) && $page == 'forgetPassword')
<script type="text/javascript">
    $(window).on('load', function () {
        $('#resetPassModal').modal('show');
    });
</script>
@endif

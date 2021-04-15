@extends('user.layouts.main')

@section('content')

<div id="contact-page" class="banner breadcrumb" style="background-image:url({!! isset($banners['img']) ? asset($banners['img']) : 'img/contact.jpg' !!})">
    <div class="slider-content">
        <h4>{{ isset($banners['heading1']) ? $banners['heading1'] : 'Contact us Now' }}</h4>
        <h2>{{ isset($banners['heading2']) ? $banners['heading2'] : 'Keep In Touch' }}</h2>
        <div class="lmore breadcrumb">
            <p>Home | <span>Contact US</span></p>
        </div>
    </div>
</div>

<div class="contact-form">
    <div class="col-md-12">
        <h2 class="titleh2 tc">Keep In Touch</h2>
        {!! Form::open(array('id' => 'contact_form','name' => 'contact_form' ,'class' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data' )) !!}

        <div class="form-group w50">
            <label for="name">Name</label>
            <input class="form-control" type="text" maxlength="70" id="name" name="name" placeholder="Your Name">
            <div class="name"></div>
        </div>
        <div class="form-group w50">
            <label for="email">E-Mail</label>
            <input class="form-control" type="Email" id="email" name="email" placeholder="Your E-Mail Address">
        </div>
        <div class="form-group w50">
            <label for="subject">Subject</label>
            <input class="form-control" type="text" id="subject" name="subject" placeholder="Subject">
        </div>
        <div class="form-group w50">
            <label for="phone">Phone Number</label>
            <input class="form-control" type="number" id="phone" minlength="5" maxlength="12" name="phone"  placeholder="Your Phone Number">
            <div class="phone"></div>
        </div>
        <div class="form-group w100">
            <label for="message">Write Message</label>
            <textarea class="form-control" type="text" id="message" name="message" placeholder="Message here"></textarea>
        </div>
        <p><input class="submit btn btn-bg" type="submit" value="Send Message"></p>
        {!! Form::close() !!}

    </div>
</div>

<div id="mapp">
    <div class="addrs row">
        <div class="direc col-8">
            <h3 class="titleh3">17 Musa Traore, Asokoro, Abuja, Nigeria</h3>
            <p>17 Musa Traore, Asokoro, Abuja, Nigeria</p>
            <p><a href="mailto:supports@quickvote.ng">supports@quickvote.ng</a> | <a href="tel:+2348053682130">+234 805 368 2130</a></p>
            <p><a href="www.quickvote.ng">www.quickvote.ng</a></p>
        </div>
        <div class="dicon col-4">
            <span class="icnn">
                <span class="map-icn"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                           viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                    <style type="text/css"> .st0{fill:url(#SVGID_1_);} </style>
                    <g>
                    <g>

                    <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="55.9949" y1="92.3965" x2="55.9949" y2="14.9022" gradientTransform="matrix(1 0 0 1 -6 7)">
                    <stop  offset="0" style="stop-color:#FCB82C"/>
                    <stop  offset="1" style="stop-color:#F47F32"/>  </linearGradient>
                    <path class="st0" d="M70.1,59c-1.7-0.4-3.5,0.7-3.9,2.4c-0.4,1.7,0.7,3.4,2.4,3.9c10,2.4,13.7,5.9,13.7,7.6
                          c0,3.8-12.9,9.6-32.3,9.6c-19.4,0-32.3-5.8-32.3-9.6c0-1.8,3.6-5.3,13.7-7.6c1.7-0.4,2.8-2.1,2.4-3.9c-0.4-1.7-2.2-2.8-3.9-2.4
                          c-12,2.8-18.6,7.7-18.6,13.9c0,10.5,19.5,16,38.7,16c19.3,0,38.7-5.5,38.7-16C88.7,66.8,82.1,61.8,70.1,59z M50,37.6
                          c1.8,0,3.2-1.4,3.2-3.2c0-1.8-1.4-3.2-3.2-3.2c-1.8,0-3.2,1.4-3.2,3.2C46.8,36.2,48.2,37.6,50,37.6z M45.8,71.7l1.3,2.6
                          c0.5,1.1,1.7,1.8,2.9,1.8c1.2,0,2.3-0.7,2.9-1.8l2.8-5.5c3.4-6.7,7.6-13.2,11.6-19.5l1.8-2.9c2.3-3.6,3.5-7.7,3.5-11.9
                          c0-6.4-2.8-12.5-7.6-16.7c-4.8-4.3-11.3-6.3-17.7-5.5c-10,1.1-18.3,9.2-19.7,19.1c-0.8,5.9,0.7,11.7,4.2,16.5
                          C37.3,55.1,41.5,63.2,45.8,71.7z M50,24.8c5.3,0,9.7,4.3,9.7,9.6c0,5.3-4.3,9.6-9.7,9.6c-5.3,0-9.7-4.3-9.7-9.6
                          C40.3,29.1,44.7,24.8,50,24.8z"/>
                    </g>
                    </g>
                    </svg>
                </span>
                Direction
            </span>
        </div>
        <p class="larger-map"><span class="reviews">105 Reviews</span> <a class="btn lmap" target="_blank" href="https://www.google.com/maps?ll=9.040334,7.528093&z=16&t=m&hl=en&gl=IN&mapclient=embed&q=17+Musa+Traore+Asokoro+Abuja+Nigeria">View Larger Map</a></p>
    </div>
    <div class="embeded-map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.2566334107078!2d7.525903915278817!3d9.040338791299241!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104e095ed2fa1ec1%3A0xbe7294cc5316a05e!2s17%20Musa%20Traore%2C%20Asokoro%2C%20Abuja%2C%20Nigeria!5e0!3m2!1sen!2sin!4v1609323745443!5m2!1sen!2sin" width="100%" height="500" frameborder="0" style="border:0;" aria-hidden="false" tabindex="0"></iframe></div>
</div>


<script type="text/javascript">
//    $.validator.addMethod('phonenu', function (value, element) {
//        alert('sdkj');
//        if (element.value != 10 && element.value == isNaN)
//        {
//            return false;
//        } else
//        {
//            return true;
//
//        }
//    });


    $("#contact_form").validate({
        ignore: ":hidden",
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            subject: {
                required: true,
            },
            phone: {
                required: true,
              
            },
            message: {
                required: true,
            },
        },
          messages: {
    
      phone: {
       
        phonenu: "Please enter minimum 5 and maximum 12 number "
      },
     
    },
        submitHandler: function (form) {
            $(".alert-danger").hide();
            $(".alert-danger").empty();
            $.ajax({
                type: 'POST',
                url: "{{ route('user.contact') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('#contact_form').serialize(),
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
                        $('#contact_form').trigger("reset");
                    } else {

                        $.each(response.errors, function (key, value) {
                            console.log(value);
                            if (value.includes('phone')) {

                                $('.alert-danger').show();
                                $('.phone').append('<p style="color:red";>' + value + '</p>');
                            }
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



</script>

@endsection
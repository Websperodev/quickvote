@extends('vendor.layouts.master')
@section("meta_page_title") Vendor | Quickvote | Contestant @endsection
@section("page_title") <a href="{!! route('contestant.index') !!}" class="head-a"> Contestant </a> > Add @endsection


@section("content")

<div class="row justify-content-center">

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Add Contestant</h4>
                @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                </div>
                @endif
                <div id="err" style="display: none;" class="alert alert-danger"> 
                    <p> Fill Required fields</p>  
                </div>

                <div id="contestant" class="mb-2 custum-frm">
                    <div class="col-md-12 form-group cus-form-group">
                        <label for="contestant" class="col-12">Number of Contestants</label>
                        <input type="text" name="contestant" onkeyup="contenstcheck()" id="contestant-no" class="form-control" placeholder="Enter Contestant no" />
                        <p id="error_contestant" style="color:red;"></p>
                    </div>

                    <div class="col-md-12 form-group cus-form-group">
                        <label for="event" class="col-12">Choose Event</label>
                        <select name="event" id="event" onchange="eventcheck()" class="form-control">
                            <option value="">Choose Event</option>
                            @if(!empty($events))
                            @foreach($events as $event)
                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                            @endforeach
                            @endif
                        </select>
                        <p id="error_event" style="color:red;"></p>
                    </div>

                    <div class="col-12 btn-right">
                        <button type="button" id="add-contestant" class="btn btn-bg ladda-button">Load</button>
                    </div>
                </div>

            </div> <!-- end card-body-->
        </div> 
    </div>
</div> 

<div id="contestantModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Contestant</h4>
            </div>
            <div class="modal-body">

                <div id="contestant" class="mb-2">
                    {!! Form::open(array( 'id' => 'add_contestant_form', 'enctype' => 'multipart/form-data' )) !!}
                    @csrf


                    {!! Form::close() !!}
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
@endsection



@section('script-bottom')
<!--<script type="text/javascript" src="{{ URL::asset('assets/js/nicEdit-latest.js') }}"></script>-->
<script src="{{url('assets/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
                            CKEDITOR.replace('banner_description', {
                                height: '20%',
                                width: '100%'
                            });
//bkLib.onDomLoaded(function() {
//    new nicEditor({ maxHeight : 100 }).panelInstance('answer');
//});


                            function contenstcheck() {

                                let total = $('#contestant-no').val();
                                if (!$.isNumeric(total)) {
                                    $('#error_contestant').text('Contestant number field is requied and use to only numbers');

                                } else {
                                    $('#error_contestant').text('');
                                }
                            }
                            function eventcheck() {

                                let eventId = $('#event').val();
                                if (eventId == '') {
                                    $('#error_event').text('Event field is requied');

                                } else {
                                    $('#error_event').text('');
                                }
                            }

                            $("#add-contestant").click(function () {
                                $('#error_event').text('');
                                $('#error_contestant').text('');
                                let total = $('#contestant-no').val();
                                let eventId = $('#event').val();

                                if (total == '' || !$.isNumeric(total)) {
                                    $('#error_contestant').text('Contestant number field is requied and use to only numbers');
                                    return false;
                                }
                                if (eventId == '') {
                                    $('#error_event').text('Event field is requied');
                                    return false;
                                }


//    if (total == '' || eventId == '') {
//        $('#err').css("display", "block");
//        setTimeout(function () {
//            $('#err').css("display", "none");
//        }, 3000);
//        return false;
//    }
                                $('#add_contestant_form').empty();
                                var html = '';
                                for (let i = 0; i < total; i++) {
                                    html += '<div class="col-md-12 form-group cus-form-group">\n\
                        <label for="name" class="col-12">Name</label>\n\
                        <input type="text" name="name[]"  class="form-control" placeholder="Enter Contestant name" required/>\n\
                                             </div>\n\
                          <div class="col-md-12 form-group cus-form-group">\n\
                           <label for="image" class="col-12">Image</label>\n\
                          <input type="file" name="image[]"  class="form-control" placeholder="Choose image" />\n\
          </div><div class="col-md-12 form-group cus-form-group">\n\
                <label for="number" class="col-12">Number</label>\n\
<input type="text" name="number[]"  class="form-control" placeholder="Enter Number" required/></div>\n\
<div class="col-md-12 form-group cus-form-group"><label for="image" class="col-12">About</label>\n\
<textarea type="text" required cols="50" class="form-control" name="about[]" placeholder="About here..">\n\
</textarea></div>';
                                }

                                html += '<input type="hidden" name="event_id" value=' + eventId + ' /><div class="col-12 btn-right"><button type="submit" class="btn btn-bg ladda-button submitBtn">Add</button></div>';

                                $('#add_contestant_form').append(html);
                                $('#contestantModal').modal('show');
                            });

                            $(document).ready(function (e) {
                                // Submit form data via Ajax
                                $("#add_contestant_form").on('submit', function (e) {
                                    e.preventDefault();
                                    $.ajax({
                                        type: 'POST',
                                        url: "{{ route('vendor.contestant.store')}}",
                                        data: new FormData(this),
                                        dataType: 'json',
                                        contentType: false,
                                        cache: false,
                                        processData: false,
                                        beforeSend: function () {
                                            // $('.submitBtn').attr("disabled","disabled");

                                        },
                                        success: function (response) { //console.log(response);
                                            console.log(response);
                                            Swal.fire({
                                                type: 'success',
                                                title: 'Success!',
                                                text: response.message,
                                                confirmButtonClass: 'btn btn-confirm mt-2',
                                            }).then((value) => {
                                                location.reload();
                                            });
                                            location.reload();
                                        },
                                        error(e) {
                                            console.log(e);

                                        }
                                    });
                                });
                            });
</script>

@endsection
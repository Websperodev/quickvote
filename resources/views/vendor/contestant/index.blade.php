@extends('vendor.layouts.master')
@section("meta_page_title") Dashboard | Contestant  @endsection
@section("page_title") Contestant @endsection
@section("css")
<style type="text/css">
    form#add_user_form .modal-body .form-group {position: relative;}
    form#add_user_form .modal-body .form-group label.error {position: absolute;width: 100%;bottom: -18px;}
</style>
@endsection
@section("page_directory")
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="{!! route('vendor.dashboard') !!}">Dashboard</a></li>
    <li class="breadcrumb-item active">Contestant</li>
</ol>
@endsection
@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h4 class="header-title">Manage Contestant</h4>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-bg" href="{{ route('vendor.contestant.create') }}" style="color: black">Add Contestant</a>
                    </div>
                </div>
                <p class="sub-header">View and manage Contestant users on this page.</p>
                <table id="contestant-table" class="table table-hover m-0 table-centered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>About</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="editContestantModal" class="modal fade bs-example-modal-center"  role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Contestant</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            {!! Form::open(['id' => 'edit_contestant_form', 'enctype' => 'multipart/form-data'] ) !!}
            <div class="col-md-12 form-group cus-form-group">
                <label for="name" class="col-12">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Contestant name" /></div>
            <p id="error_name" style="color:red;"></p>
            <div class="col-md-12 form-group cus-form-group">
                <label for="image" class="col-12">Image</label>
                <img src="" id="existing_img" style="height:80px;width:80px;">
                <input type="file" name="image"  class="form-control" placeholder="Choose image" />
            </div>
            <div class="col-md-12 form-group cus-form-group">
                <label for="number" class="col-12">Number</label>
                <input type="number" name="number"  id="number" class="form-control numberclass" placeholder="Enter Number" />
                <p id="error_number" class="error_number" style="color:red;"></p>
            </div>
            <div class="col-md-12 form-group cus-form-group">
                <label for="image" class="col-12">About</label>
                <textarea type="text"  cols="50" class="form-control" name="about" id="about" placeholder="About here.."></textarea>
                <p id="error_about" style="color:red;"></p>
            </div>
            <input type="hidden" name="existing_image"  id="existing_image" class="form-control" placeholder="Enter Number" />

            <div  class="col-12 btn-right">
                <button type="submit" class="btn btn-bg ladda-button">Update</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ URL::asset('assets/libs/jquery-validate/jquery.validate.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jquery-validate/additional-methods.min.js') }}"></script>
@endsection

@section("script-bottom")
<script type="text/javascript">
var update_url = '';
var table_instance;
var initialized = false;
table_instance = $('#contestant-table').DataTable({
    "language": {
        "paginate": {
            "previous": "<i class='mdi mdi-chevron-left'>",
            "next": "<i class='mdi mdi-chevron-right'>"
        },
        "processing": '<div class="table-loader d-flex align-items-center p-2"> <strong>Processing...</strong> <div class="spinner-border ml-auto text-primary" role="status" aria-hidden="true"></div> </div>'
    },
    'drawCallback': function (oSettings) {
        if (!initialized) {
            $('#contestant-table_filter.dataTables_filter').each(function () {
                initialized = true;
            });
        }
        $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
    },
    processing: true,
    serverSide: true,
    serverSide: true,
    order: [], //Initial no order.
    ajax: {
        url: "{{ route('vendor.getContestant') }}",
        method: 'POST'
    },
    columnDefs: [
        {
            targets: [-1],
            orderable: false,
            className: "text-center"
        },
        {
            "responsivePriority": 1,
            "targets": -1
        }
    ],
    columns: [
        {data: 'image', name: 'image'},
        {data: 'name', name: 'name'},
        {data: 'contact', name: 'contact'},
        {data: 'about', name: 'about'},
        {data: 'created_at', name: 'created_at'},
        {data: 'action', name: 'action', "searchable": false, "orderable": false, width: '50px', className: "text-center"}
    ],
});

$(document).ready(function (e) {
    $("#edit_contestant_form").on('submit', function (e) {
        e.preventDefault();
        var number = $('.numberclass').val();
        var ln = parseInt(number.length);



        if (ln < 5 || ln < 12 ) {
             $('.error_number').text('');
            var formdata = new FormData(this);
            l = Ladda.create(document.querySelector('#edit_contestant_form .ladda-button'));
            $.ajax({
                type: 'POST',
                url: update_url,
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    l.start();
                },
                success: function (data) {
                    console.log(data);
                    $('.error_number').text('');
                    l.stop();
                    if (data.status == 2) {
                        Swal.fire({
                            type: 'error',
                            title: 'Error!',
                            text: data.error,
                            confirmButtonClass: 'btn btn-confirm mt-2',
                        });
                        $('#editContestantModal').modal('hide');
                    } else if (data.status == 1) {
                        Swal.fire({
                            type: 'success',
                            title: 'Success!',
                            text: data.message,
                            confirmButtonClass: 'btn btn-confirm mt-2',
                        });
                        table_instance.ajax.reload(null, true);
                        $('#editContestantModal').modal('hide');
                    } else if (data.status == 3) {
                        if (data.inputvalidation.number) {

                            $('#error_number').text(data.inputvalidation.number);
                        }
                        if (data.inputvalidation.name) {

                            $('#error_name').text(data.inputvalidation.name);
                        }
                        if (data.inputvalidation.about) {

                            $('#error_about').text(data.inputvalidation.about);
                        }
                    }
                },
                error(e) {
                    console.log(e);
                }
            });
        } else {

            $('.error_number').text('Please use min 5 or max 12 length');
        }
    });
});
function editcontestant(obj, id) {
    $('.error_number').text('');
    update_url = "{{ url('vendor/contestant-update') }}/" + id;
    var url = '{{ url(":img") }}';
    url = url.replace(':img', $(obj).data('image'));
    $('#editContestantModal').modal('show');
    console.log('name', $(obj).data('name'));
    $('#name').val($(obj).data('name'));
    $('#number').val($(obj).data('phone'));
    $('#about').val($(obj).data('about'));
    $('#existing_img').attr('src', url);
    $('#existing_image').val($(obj).data('image'));
}
function deleteContestant(obj, id)
{
    var url = '{{ route("vendor.contestant.destroy", ":id") }}';
    url = url.replace(':id', id);
    Swal.fire({
        title: 'Delete Contestant?',
        text: "Do you really want to delete this Contestant and all data related to this Contestant?",
        type: 'warning',
        showCancelButton: true,
        showLoaderOnConfirm: true,
        confirmButtonColor: '#6658dd',
        cancelButtonColor: '#f1556c',
        confirmButtonText: 'Yes, do it!'
    }).then((result) => {
        if (result.value) {
            $('#full_page_loader').removeClass('d-none');
            $.post(url, {
                _method: 'DELETE',
                _token: "{!! csrf_token() !!}"
            }, function (data) {
                //console.log('abc', data);
                $('#full_page_loader').addClass('d-none');
                if (data.status == 1) {
                    Swal.fire({
                        type: 'success',
                        title: 'Success!',
                        text: data.message,
                        confirmButtonClass: 'btn btn-confirm mt-2',
                    });
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Error!',
                        text: 'Cannot delete contact group',
                        confirmButtonClass: 'btn btn-confirm mt-2',
                    });
                }
                table_instance.ajax.reload(null, false);
            });
        }
    })
}

</script>
@endsection

@extends('admin.layouts.master')
@section("meta_page_title") Dashboard | User List | Users @endsection
@section("page_title") Users @endsection
@section("css")
    <style type="text/css">
        form#add_user_form .modal-body .form-group {position: relative;}
        form#add_user_form .modal-body .form-group label.error {position: absolute;width: 100%;bottom: -18px;}
    </style>
@endsection
@section("page_directory")
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{!! route('admin.dashboard') !!}">Dashboard</a></li>
        <li class="breadcrumb-item active">Users</li>
    </ol>
@endsection
@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
               <div class="row">
                <div class="col-6">
                    <h4 class="header-title">Manage Users</h4>
                </div>
                <div class="col-6">
                
                
                    <a class="btn btn-bg" href="{{ route('admin.add.user') }}" style="color: black">Add User</a>
                
                </div>
               </div>
                <p class="sub-header">View and manage account users on this page.</p>
                <table id="users-table" class="table table-hover m-0 table-centered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
        
        table_instance = $('#users-table').DataTable({
            "language": {
                "paginate": {
                    "previous": "<i class='mdi mdi-chevron-left'>",
                    "next": "<i class='mdi mdi-chevron-right'>"
                },
                "processing": '<div class="table-loader d-flex align-items-center p-2"> <strong>Processing...</strong> <div class="spinner-border ml-auto text-primary" role="status" aria-hidden="true"></div> </div>'
            },
            'drawCallback': function (oSettings) {
                if (!initialized) {
                    $('#users-table_filter.dataTables_filter').each(function () {
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
                url: "{{ route('admin.getUsers') }}",
                method: 'POST'
            },
            columnDefs: [
                {
                    targets: [-1],
                    orderable:false,
                    className: "text-center"
                },
                { 
                    "responsivePriority": 1, 
                    "targets": -1 
                }
            ],
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'type', name: 'type'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', "searchable": false, "orderable": false, width: '50px', className : "text-center"}
            ],
        });
    
     
    function deleteUser(obj,id) 
    {
        let list_name = $(obj).data('listname');
        Swal.fire({
            title: 'Delete User?',
            text: "Do you really want to delete this user and all data related to this user?",
            type: 'warning',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonColor: '#6658dd',
            cancelButtonColor: '#f1556c',
            confirmButtonText: 'Yes, do it!'
        }).then((result) => {
            if (result.value) {
                $('#full_page_loader').removeClass('d-none');
                $.post('{{ route("admin.users.delete") }}', {
                    id: id,
                    _token: "{!! csrf_token() !!}"
                }, function (data) {
                    $('#full_page_loader').addClass('d-none');
                    if (data.status == 1) {
                        Swal.fire({
                            type: 'success',
                            title: 'Success!',
                            text: data.message,
                            confirmButtonClass: 'btn btn-confirm mt-2',
                        });
                    }
                    else {
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
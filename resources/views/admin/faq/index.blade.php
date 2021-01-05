@extends('admin.layouts.master')
@section("meta_page_title") Dashboard | Faqs  @endsection
@section("page_title") Faqs @endsection
@section("css")
    <style type="text/css">
        form#add_user_form .modal-body .form-group {position: relative;}
        form#add_user_form .modal-body .form-group label.error {position: absolute;width: 100%;bottom: -18px;}
    </style>
@endsection
@section("page_directory")
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{!! route('admin.dashboard') !!}">Dashboard</a></li>
        <li class="breadcrumb-item active">Faqs</li>
    </ol>
@endsection
@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
               <div class="row">
                <div class="col-6">
                    <h4 class="header-title">Manage Faqs</h4>
                </div>
                <div class="col-6">
                
                
                    <a class="btn btn-bg" href="{{ route('faqs.create') }}" style="color: black">Add Faq</a>
                      
                </div>
               </div>
                <p class="sub-header">View and manage account users on this page.</p>
                <table id="faq-table" class="table table-hover m-0 table-centered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Answer</th>
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
        
        table_instance = $('#faq-table').DataTable({
            "language": {
                "paginate": {
                    "previous": "<i class='mdi mdi-chevron-left'>",
                    "next": "<i class='mdi mdi-chevron-right'>"
                },
                "processing": '<div class="table-loader d-flex align-items-center p-2"> <strong>Processing...</strong> <div class="spinner-border ml-auto text-primary" role="status" aria-hidden="true"></div> </div>'
            },
            'drawCallback': function (oSettings) {
                if (!initialized) {
                    $('#faq-table_filter.dataTables_filter').each(function () {
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
                url: "{{ route('admin.getFaqs') }}",
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
                {data: 'question', name: 'question'},
                {data: 'answer', name: 'answer'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', "searchable": false, "orderable": false, width: '50px', className : "text-center"}
            ],
        });
    
     
    function deleteFaq(obj,id) 
    {
        var url = '{{ route("faqs.destroy", ":id") }}';
        url = url.replace(':id', id);
       
        Swal.fire({
            title: 'Delete Faq?',
            text: "Do you really want to delete this Faq and all data related to this Faq?",
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
                    console.log('abc', data);
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
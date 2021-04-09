@extends('admin.layouts.master')
@section("meta_page_title") Dashboard | Event Ticket| Event Ticket Payment List @endsection
@section("page_title") Event Ticket Payment List @endsection
@section("css")
<style type="text/css">
    form#add_user_form .modal-body .form-group {position: relative;}
    form#add_user_form .modal-body .form-group label.error {position: absolute;width: 100%;bottom: -18px;}
</style>
@endsection
@section("page_directory")
<ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="{!! route('admin.dashboard') !!}">Dashboard</a></li>
    <li class="breadcrumb-item active">Payment</li>
</ol>
@endsection
@section("content")
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h4 class="header-title">Event Ticket Payment List</h4>
                    </div>
                    <div class="col-6">


                        <!--<a class="btn btn-bg" href="{{ route('admin.add.user') }}" style="color: black">Add User</a>-->

                    </div>
                </div>
                  <p class="sub-header">View payment list on this page.</p>
                <table id="users-table" class="table table-hover m-0 table-centered dt-responsive nowrap w-100">
                    <thead>
                        <tr>

                            <th>Event</th>
                            <th>Ticket</th>
                            <th>Ticket number</th>
                            <th>Total tickets</th>
                            <th>Total amount</th>
                            <th>Reference</th>
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
        url: "{{ route('admin.tickets.list.payments') }}",
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
        {data: 'event_id', name: 'event_id'},
        {data: 'ticket_id', name: 'ticket_id'},
        {data: 'ticket_number', name: 'ticket_number'},
        {data: 'total_tickets', name: 'total_tickets'},
        {data: 'total_amount', name: 'total_amount'},
        {data: 'reference', name: 'reference'},
        {data: 'type', name: 'type'},
        {data: 'created_at', name: 'created_at'},
        {data: 'action', name: 'action', "searchable": false, "orderable": false, width: '50px', className: "text-center"}
    ],
});


</script>
@endsection
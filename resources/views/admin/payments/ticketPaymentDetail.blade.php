@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Dashboard @endsection
@section("page_title") <a href="{!! route('admin.tickets.payments') !!}" class="head-a">Event Tickets </a> >Payment Detail @endsection


@section("content")

@php 
$timezoneArray = config('constants.timezones');
@endphp


<!-- $timezoneArray = timezone_identifiers_list(); -->
<div class="row justify-content-center">

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Event Tickets Payment Detail</h4>

                <div class="events-frm mb-2">
                    <div class="row">
                        <div class="col-md-12 form-group cus-form-group">
                            <table class="table">

                                <tr>
                                    <td><b>Event</b></td>
                                    <td>{{eventsName($eventTicketDetail->event_id)}}</td>
                                </tr>
                                <tr>
                                    <td><b>Ticket</b></td>
                                    <td>{{ticketName($eventTicketDetail->ticket_id)}}</td>
                                </tr>
                                <tr>
                                    <td><b>Ticket Number</b></td>
                                    <td>{{ticketNumber($eventTicketDetail->ticket_id)}}</td>
                                </tr>
                                <tr>
                                    <td><b>Total Tickets</b></td>
                                    <td>{{$eventTicketDetail->total_tickets}}</td>
                                </tr>
                                @if($eventTicketDetail->user_id !='')
                                <tr>
                                    <td><b>User</b></td>
                                    <td>{{userName($eventTicketDetail->user_id)}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td><b>Type</b></td>
                                    <td>{{$eventTicketDetail->type}}</td>
                                </tr>
                                @if($eventTicketDetail->reference !='')
                                <tr>
                                    <td><b>Reference Number</b></td>
                                    <td>{{$eventTicketDetail->reference}}</td>
                                </tr>
                                <tr>
                                    <td><b>Payment Status</b></td>
                                    <td>{{$eventTicketDetail->status}}</td>
                                </tr>
                                <tr>
                                    <td><b>Transaction Number</b></td>
                                    <td>{{$eventTicketDetail->transaction}}</td>
                                </tr>

                                <tr>
                                    <td><b>Ticket Amount</b></td>
                                    <td>{{$eventTicketDetail->ticket_amount}}</td>
                                </tr>
                                <tr>
                                    <td><b>Paid Amount</b></td>
                                    <td>{{$eventTicketDetail->paid_amount}}</td>
                                </tr>
                                @endif

                            </table>
                        </div>
                    </div>



                </div> <!-- end card-body-->
            </div> 
        </div>
    </div>
</div> 

@endsection
@section('script-bottom')
@endsection
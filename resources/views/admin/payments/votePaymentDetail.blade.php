@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Dashboard @endsection
@section("page_title") <a href="{!! route('admin.votes.payments') !!}" class="head-a"> Contest Vote </a> >Payment Detail @endsection


@section("content")

@php 
$timezoneArray = config('constants.timezones');
@endphp


<!-- $timezoneArray = timezone_identifiers_list(); -->
<div class="row justify-content-center">

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Contest Vote Payment Detail</h4>

                <div class="events-frm mb-2">
                    <div class="row">
                        <div class="col-md-12 form-group cus-form-group">
                            <table class="table">

                                <tr>
                                    <td><b>Contest </b></td>
                                    <td>{{votingTitle($voteDetail->voting_id)}}</td>
                                </tr>
                                <tr>
                                    <td><b>Contestant</b></td>
                                    <td>{{contestant_name($voteDetail->contestant_id)}}</td>
                                </tr>
                                <tr>
                                    <td><b>Name</b></td>
                                    <td>{{$voteDetail->name}}</td>
                                </tr>
                                @if($voteDetail->user_id !='')
                                <tr>
                                    <td><b>User</b></td>
                                    <td>{{userName($voteDetail->user_id)}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td><b>Email</b></td>
                                    <td>{{$voteDetail->email}}</td>
                                </tr>
                                <tr>
                                    <td><b>Phone</b></td>
                                    <td>{{$voteDetail->phone}}</td>
                                </tr>
                                <tr>
                                    <td><b>Votes</b></td>
                                    <td>{{$voteDetail->votes}}</td>
                                </tr>
                                <tr>
                                    <td><b>Type</b></td>
                                    <td>{{$voteDetail->type}}</td>
                                </tr>
                                @if($voteDetail->reference !='')
                                <tr>
                                    <td><b>Reference Number</b></td>
                                    <td>{{$voteDetail->reference}}</td>
                                </tr>
                                <tr>
                                    <td><b>Payment Status</b></td>
                                    <td>{{$voteDetail->status}}</td>
                                </tr>
                                <tr>
                                    <td><b>Transaction Number</b></td>
                                    <td>{{$voteDetail->transaction}}</td>
                                </tr>
                                <tr>
                                    <td><b>Single Vote Fees</b></td>
                                    <td>{{$voteDetail->single_vote_fees}}</td>
                                </tr>
                                <tr>
                                    <td><b>Total Votes Fees</b></td>
                                    <td>{{$voteDetail->total_votes_fees}}</td>
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
@extends('user.layouts.main')

@section('content')
<style>
    .img-fluid{
        height:300px;
        width:500px;
    }

</style>
<div id="event-page" class="banner breadcrumb">
    <div class="slider-content">
        <h4>Quick Events</h4>
        <h2>Search Event</h2>
    </div>
</div>


@livewire('show-event')
   @include('user.components.trusted-brands')
@endsection
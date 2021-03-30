
@extends('user.layouts.main')
@section('content')
<div id="event-page" class="banner breadcrumb">
    <div class="slider-content">
        <h4>Quick Category</h4>
        <h2>Search Category</h2>
    </div>
</div>
<form action="{{url('categories-list')}}" method="POST" >
    <div id="floating-search" class="container evnt">
        <h2>Category Browse</h2>
        @csrf
        <div class=" row">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" name="cat_name" value="{{$search}}" class="form-control"  placeholder="Enter KeyWord"/>
                </div>
            </div>          
            <div class="col-md-4">
                <button type="submit"  class="btn btn-primary advanceSearch seachButton">Search Category</button>
            </div>
        </div>
    </div>
</form>

<div id="eve" class="events">
    <div class="container">
        <div class="row">          
            <br/>
            @if(!empty($categories))
            @foreach($categories as $cat)
            @php

            if($cat->image != '')
            {
            $img = $cat->image;
            }
            else{
            $img ="img/fe2.jpg";
            }
            $description=substr(strip_tags($cat->description),0, 150);
            $char=strlen($cat->description);
            if($char >150){
            $description=ucfirst($description.'...');
            }
            @endphp
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter Most Recent">
                <div class="tcard border-0 py-3 px-4">
                    <div class="justify-content-center"> <img src="{{url($img)}}" class="img-fluid profile-pic mb-4 mt-3"> </div>
                    <div class="fe-abs">

                        <div class="txt-card">
                            <div class="event-name">
                                <h2 class="titleh2 event-title">{{ucfirst($cat->name)}}</h2>                               
                            </div>
                            <p class="time-price">{{$description}}</p>
                            <a class="btn btn-grad-bd ticket-details" href="{{url('search-event').'/'.$cat->id}}">Events</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    @include('user.components.newsletter')
    @include('user.components.trusted-brands')

    @endsection
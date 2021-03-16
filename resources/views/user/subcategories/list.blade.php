
@extends('user.layouts.main')
@section('content')
<style>
    .noncategory{
        height:10px;
        width: 150px;
        margin: -30px 64px 65px 115px;

    }
</style>
<div id="event-page" class="banner breadcrumb">
    <div class="slider-content">
        <h4>Quick Category</h4>
        <h2>Search Category</h2>
    </div>
</div>
<form action="{{url('vote/categories-list')}}" method="POST" >
    <div id="floating-search" class="container evnt">
        <h2>Category Browse</h2>
        @csrf
        <div class=" row">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" name="scat_name" value="{{$search}}" class="form-control"  placeholder="Enter KeyWord"/>
                </div>
            </div>          
            <div class="col-md-4">
                <button type="submit"  class="btn btn-primary advanceSearch seachButton">Search</button>
            </div>
        </div>
    </div>
</form>
<div class="noncategory container evnt">                       
    <div class="col-md-4">
        <a href="{{url('noncatvotes')}}"><button type="submit"  class="btn btn-primary advanceSearch seachButton">Not Categorized</button></a>
    </div>       

</div> 
<div id="eve" class="events">
    <div class="container">
        <div class="row">          
            <br/>
            @if(!empty($subcategories))
            @foreach($subcategories as $scat)
            @php

            if($scat->image != '')
            {
            $img = $scat->image;
            }
            else{
            $img ="img/fe2.jpg";
            }
            $description=substr(strip_tags($scat->description),0, 150);
            $char=strlen($scat->description);
            if($char >150){
            $description=$description.'...';
            }
            @endphp
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter Most Recent">
                <div class="tcard border-0 py-3 px-4">
                    <div class="justify-content-center"> <img src="{{url($img)}}" class="img-fluid profile-pic mb-4 mt-3"> </div>
                    <div class="fe-abs">

                        <div class="txt-card">
                            <div class="event-name">
                                <h2 class="titleh2 event-title">{{$scat->name}}</h2>                               
                            </div>
                            <p class="time-price">{{$description}}</p>
                            <a class="btn btn-grad-bd ticket-details" href="{{url('votes').'/'.$scat->id}}">Votes</a>
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
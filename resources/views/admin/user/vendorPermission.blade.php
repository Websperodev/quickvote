@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Countries @endsection
@section("page_title") <a href="{!! route('admin.vendors') !!}" class="head-a"> Vendors </a> > Permissions @endsection
@section("content")
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title">Permissions</h4>
                @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.text') !!}
                </div>
                @endif
                {!! Form::open(array('route' => 'admin.vendor.addpermissions', 'id' => 'add_Country_form', 'method' => 'post','class' => 'custum-frm', 'enctype' => 'multipart/form-data' )) !!}
                @csrf
                <div class="col-md-12 form-group cus-form-group row"> 
                    <div class="col-md-3"> 
                        <label for="name">Module Name</label>
                    </div>
                    <div class="col-md-2"> 
                        <label for="phonecode">Add</label>
                    </div>
                    <div class="col-md-2"> 
                        <label for="currency">Edit</label>
                    </div>
                    <div class="col-md-2"> 
                        <label for="currency">Delete</label>
                    </div>
                    <div class="col-md-2"> 
                        <label for="currency">View</label>
                    </div>
                </div>
                <div class='row'>
                    <div class="col-md-12 form-group cus-form-group row">
                        @if(!empty($promissions))
                        @foreach($promissions as $key=>$prom)
                        <div class="col-md-3">                      
                            <p><b>{{$prom['name']}}</b></p>
                            <input type="hidden" name='{{$key}}[vendor_id]'  aria-describedby="emailHelp" value="{{$vendor_id}}">
                            <input type="hidden" name='{{$key}}[id]' id="name" aria-describedby="emailHelp" value="{{$prom['id']}}">
                        </div>
                        <div class="col-md-2">  
                            @if($prom['add']=='1')
                            <input type="checkbox" checked name="{{$key}}[add]" id="edit" aria-describedby="emailHelp">
                            @else
                            <input type="checkbox" name="{{$key}}[add]" id="edit" aria-describedby="emailHelp">
                            @endif
                        </div>
                        <div class="col-md-2"> 
                            @if($prom['edit']=='1')
                            <input type="checkbox" checked name="{{$key}}[edit]" id="edit" aria-describedby="emailHelp">
                            @else
                            <input type="checkbox" name="{{$key}}[edit]" id="edit" aria-describedby="emailHelp">
                            @endif

                        </div>  
                        <div class="col-md-2"> 
                            @if($prom['delete']=='1')
                            <input type="checkbox" checked name="{{$key}}[delete]" id="edit" aria-describedby="emailHelp">
                            @else
                            <input type="checkbox" name="{{$key}}[delete]" id="edit" aria-describedby="emailHelp">
                            @endif

                        </div> 
                        <div class="col-md-2">  
                            @if($prom['view']=='1')
                            <input type="checkbox" checked name="{{$key}}[view]" id="delete" aria-describedby="emailHelp">
                            @else
                            <input type="checkbox" name="{{$key}}[view]" id="delete" aria-describedby="emailHelp">
                            @endif

                        </div>
                        @endforeach
                        @endif
                    </div> 
                </div>
                <div class="btn-right">
                    <button type="submit" class="btn btn-bg ladda-button">Submit</button>
                </div>



                {!! Form::close() !!}
            </div> <!-- end card-body-->
        </div> 
    </div>
</div> 
@endsection
@section('script-bottom')
@endsection
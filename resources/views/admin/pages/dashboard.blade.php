@extends('admin.layouts.master')
@section("meta_page_title") Admin | Quickvote | Dashboard @endsection
@section("page_title") Dashboard @endsection


@section("content")

<div class="row">
    <div class="col-md-12 col-12">
    	<div class="row">
    		<div class="col-sm-6 col-12">
    			<div class="widget-rounded-circle card-box">
		            <a href="#">
			           	 <div class="row">
			                <div class="col-6">
			                	<div class="avatar-lg rounded-circle bg-soft-danger border-danger border">
	                                <i class="mdi mdi-account-multiple-outline font-22 avatar-title text-danger"></i>
	                            </div>
			                </div>
			                <div class="col-6">
			                    <div class="text-right">
			                        <h3 class="text-dark mt-1"><span data-plugin="counterup">0</span></h3>
			                        <p class="text-muted mb-1 text-truncate">Active Users</p>
			                    </div>
			                </div>
			            </div> <!-- end row-->
		            </a>
		        </div>
    		</div>
    		<div class="col-sm-6 col-12">
    			<div class="widget-rounded-circle card-box">
    				<a href="#">
			            <div class="row">
			                <div class="col-6">
			                	<div class="avatar-lg rounded-circle bg-soft-success border-success border">
	                                <i class="mdi mdi-briefcase-account font-22 avatar-title text-success"></i>
	                            </div>
			                </div>
			                <div class="col-6">
			                    <div class="text-right">
			                        <h3 class="text-dark mt-1"><span data-plugin="counterup">0</span></h3>
			                        <p class="text-muted mb-1 text-truncate">Paid Users</p>
			                    </div>
			                </div>
			            </div> <!-- end row-->
		        	</a>
		        </div>
    		</div>
    		<div class="col-sm-6 col-12">
    			<div class="widget-rounded-circle card-box">
    				<a href="#">
			            <div class="row">
			                <div class="col-6">
			                	<div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
	                                <i class="mdi mdi-google-photos font-22 avatar-title text-primary"></i>
	                            </div>
			                </div>
			                <div class="col-6">
			                    <div class="text-right">
			                        <h3 class="text-dark mt-1"><span data-plugin="counterup">0</span></h3>
			                        <p class="text-muted mb-1 text-truncate">Pending Requests</p>
			                    </div>
			                </div>
			            </div> <!-- end row-->
		        	</a>
		        </div>
    		</div>
    		<div class="col-sm-6 col-12">
    			<div class="widget-rounded-circle card-box">
    				<a href="#">
			            <div class="row">
			                <div class="col-6">
			                	<div class="avatar-lg rounded-circle bg-soft-info border-info border">
	                                <i class="mdi mdi-view-module font-22 avatar-title text-info"></i>
	                            </div>
			                </div>
			                <div class="col-6">
			                    <div class="text-right">
			                        <h3 class="text-dark mt-1"><span data-plugin="counterup">0</span></h3>
			                        <p class="text-muted mb-1 text-truncate">Total Subscribers</p>
			                    </div>
			                </div>
			            </div> <!-- end row-->
		        	</a>
		        </div>
    		</div>
    		
    	</div>
    </div>
  
</div>  
  
@endsection



@section('script-bottom')

@endsection
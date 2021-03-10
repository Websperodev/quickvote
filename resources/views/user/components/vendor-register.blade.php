<!--Modal Vendor-->
<!--{{ $countries=getcountries()}}-->
<div class="modal fade" id="vendorModal" tabindex="-2" role="dialog" aria-labelledby="VendorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-body">        
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <div class="row popupp">
      <div class="col-md-12">
      <form id="vendForm" class="vform mform row vendForm">
        @csrf
      <div class="vendor-tab" id="tabs-1" >
        <div class="col-12">
          <h3 class="titleh3">Company Information</h3>
          <p>Fill the form below keenly to participate in the Art and Fair exhibition. Forms that are not completly filled will not be accepted.</p>
        </div>
        <div class="form-group col-6">
        <label>Name of Company</label>
        <input type="text" class="form-control" autocomplete="off" name="company_name" placeholder="Your Company Name">
        </div>
        <div class="form-group col-6">
        <label>Address</label>
        <input type="text" class="form-control" autocomplete="off" name="company_address" placeholder="Your Address">
        </div>
        
        <div class="form-group col-6">
        <label>Country</label>
        <select class="form-control" autocomplete="off" name="company_country" id="c_country">
         
          
          @foreach($countries as $country)
            <option {{($country->id == 1) ? 'selected':'' }} value="{{ $country->id }}">{{ $country->name }}</option>
          @endforeach
          
        </select>
        </div>
        <div class="form-group col-6">
        <label>State</label>
          <select class="form-control" autocomplete="off" name="company_state" id="c_state">
            <option value="">Select State</option>
          </select>
        </div>

        <div class="form-group col-6">
        <label>City</label>
          <select class="form-control" autocomplete="off" name="company_city" id="c_city">
         
          </select>
        </div>

        <div class="form-group col-6">
        <label>Phone Number</label>
        <input type="number" class="form-control" autocomplete="off" name="company_phone" placeholder="Your Number">
        </div>
        <div class="form-group col-6">
        <label>E-mail</label>
        <input type="Email" class="form-control" autocomplete="off" name="company_email" placeholder="Your Email">
        </div> 
        <div class="form-group col-6">
        <label>Website</label>
        <input type="text" class="form-control" autocomplete="off" name="company_website" placeholder="Website Name">
        </div> 
        <div class="form-group col-12">
        <label>Company Description</label>
        <textarea type="text" class="form-control" autocomplete="off" name="company_description" placeholder="Company Description here.."> </textarea>
        </div>

        <div>
          <div>
            <button type="button" id="nxtBtn"  class="btn btn-bg" onclick="nextPrev(2)">Next</button>
          </div>
        </div>
        
      </div>

      <div class="vendor-tab hide-div" id="tabs-2">
        <div class="col-12">
          <h3 class="titleh3">Personal Information</h3>
          <p>Fill the form below keenly to participate in the Art and Fair exhibition. Forms that are not completly filled will not be accepted.</p>
        </div>
        <div class="form-group col-12">
        <label>Vendor Name</label>
        <input type="text" class="form-control col-6 fl" autocomplete="off" name="first_name" placeholder="First Name">
        <input type="text" class="form-control col-6 fr" autocomplete="off" name="last_name" placeholder="Last Name">
        </div>
        <div class="form-group col-12">
        <label>Business Name</label>
        <input type="text" class="form-control" autocomplete="off" name="business_name" placeholder="Your Business Name">
        </div>

        <div class="form-group col-6">
        <label>E-mail</label>
        <input type="Email" class="form-control" autocomplete="off" name="email" placeholder="Your Email">
        </div>
        <div class="form-group col-6">
        <label>Password</label>
        <input type="password" id="vendor-password" class="form-control" autocomplete="off" name="password" placeholder="Your Password">
        <span><i class="fa fa-eye" aria-hidden="true" onclick="showPassword('vendor-password')"></i></span>
        </div>

        <div class="form-group col-6">
        <label>Phone Number</label>
        <input type="text" class="form-control" autocomplete="off" name="phone" placeholder="Your Number">
        </div>
        <div class="form-group col-6">
        <label>Alternate Phone Number</label>
        <input type="text" class="form-control" autocomplete="off" name="alternate_phone" placeholder="Your Alternate Number">
        </div>
        
        <div class="form-group multii col-12">
        <label>Address</label>
        <input type="text" class="form-control col-6 fl" name="address1" autocomplete="off" placeholder="Street Address">
        <input type="text" class="form-control col-6 fr" name="address2" autocomplete="off"  placeholder="Street Address Line 2">   
       <input type="text" class="form-control col-6 fl" name="postcode" autocomplete="off" placeholder="Postal / Zip Code">
        <select class="form-control col-6 fr" autocomplete="off" name="country" id="country">
          <option value="">Select Country</option>
           @if(isset($countries) && !empty($countries))
         @foreach($countries as $country)
            <option {{($country->id == 1) ? 'selected':'' }} value="{{ $country->id }}">{{ $country->name }}</option>
          @endforeach
          @endif
        </select>

        <select class="form-control col-6 fl" name="state" autocomplete="off" id="state">
          <option value="">Select State</option>
        </select>

        <select class="form-control col-6 fr" name="city" autocomplete="off" id="city">
         
        </select>


        </div>
        <div>
          <div>
            <button type="button" class="btn btn-bg" id="btnPrevious" onclick="nextPrev(1)">Previous</button>
            <button type="button" id="nxtBtn" class="btn btn-bg" onclick="nextPrev(3)">Next</button>
          </div>
        </div>
        
      </div>

      <div class="vendor-tab hide-div" id="tabs-3">
        <div class="col-12">
          <h3 class="titleh3">Account Information</h3>
          <p>Fill the form below keenly to participate in the Art and Fair exhibition. Forms that are not completly filled will not be accepted.</p>
        </div>
        <div class="form-group col-6">
        <label>Account Holder Name</label>
        <input type="text" class="form-control" autocomplete="off" name="account_holder_name" placeholder="Account Holder Name">
        </div>
        
        <div class="form-group col-6">
        <label>Account Number</label>
        <input type="text" class="form-control" autocomplete="off" name="account_no" placeholder="Your Account Number">
        </div>
        
        <div class="form-group col-12">
        <label>Bank Name</label>
        <input type="text" class="form-control" autocomplete="off" name="bank_name" placeholder="your Bank Name">
        </div>

        <div>
          <div>
            <button type="button" class="btn btn-bg" id="btnPrevious" onclick="nextPrev(2)">Previous</button>
            <button type="submit" id="nxtBtn" class="btn btn-bg" >Submit</button>
          </div>
        </div>
        
      </div>
        
        <!-- <div style="overflow:auto;">
          <div style="float:right;">
            <button type="button" id="btnPrevious" onclick="nextPrev(-1)">Previous</button>
            <button type="button" id="btnNext" class="btn btn-bg" onclick="nextPrev(1)">Next</button>
          </div>
        </div> -->
        <!-- Circles which indicates the steps of the form: -->
        <div class="step-dots" style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        </div>
      
      </form>
      </div>

    </div>
    </div>
  </div>
  </div>
</div>
<!-- Modal--->




<script type="text/javascript">
  function nextPrev(t){
    var nxtTab = 'tabs-'+t;
    $('.vendor-tab').addClass("hide-div");
    $('#'+nxtTab).removeClass("hide-div");
    $('#tab-2').removeClass("hide-div");
  }
</script>
<script type="text/javascript">
  $(document).ready(function() {    
    var cid = '1';
    var url = '{{ route("states", ":id") }}';
    url = url.replace(':id', cid);   
      if(cid){
        $.ajax({
          type: 'GET',
          url: url,
          success: function (res) {
            if(res){
              $("#c_state").empty();
             
              $.each(res,function(key,value){
                $("#c_state").append('<option value="'+value.id+'">'+value.name+'</option>');
              });

              $("#state").empty();
            
              $.each(res,function(key,value){
                $("#state").append('<option value="'+value.id+'">'+value.name+'</option>');
              });
            
            }else{
              $("#state").empty();
            }
          },
          error: function(err) {
            console.log(err);
          }
        });
      }
  });
 
    var sid = 1;
    var url = '{{ route("cities", ":id") }}';
    url = url.replace(':id', sid);
      if(sid){
          $.ajax({
                  type: 'GET',
                  url: url,
                  success: function (res) {
                      if(res)
                      {
                          $("#c_city").empty();
                        
                          $.each(res,function(key,value){
                              $("#c_city").append('<option value="'+value.id+'">'+value.name+'</option>');
                          });
                             $.each(res,function(key,value){
                              $("#city").append('<option value="'+value.id+'">'+value.name+'</option>');
                          });
                      }else{
                          $("#c_city").empty();
                      }
                    
                  },
                  error: function(err) {
                    console.log(err);
                  }
          });
      }   
      
 

  $('#c_country').change(function(){
    var cid = $(this).val();
    var url = '{{ route("states", ":id") }}';
    url = url.replace(':id', cid);   
      if(cid){
          $.ajax({
                  type: 'GET',
                  url: url,
                  success: function (res) {
                    if(res){
                      $("#c_state").empty();
                   
                      $.each(res,function(key,value){
                        $("#c_state").append('<option value="'+value.id+'">'+value.name+'</option>');
                      });
                    
                    }else{
                      $("#c_state").empty();
                    }
                    
                  },
                  error: function(err) {
                    console.log(err);
                  }
          });
      }  
  });

  $('#c_state').change(function(){
    var sid = $(this).val();
    var url = '{{ route("cities", ":id") }}';
    url = url.replace(':id', sid);
      if(sid){
          $.ajax({
                  type: 'GET',
                  url: url,
                  success: function (res) {
                      if(res)
                      {
                          $("#c_city").empty();
                     
                          $.each(res,function(key,value){
                              $("#c_city").append('<option value="'+value.id+'">'+value.name+'</option>');
                          });
                      }else{
                          $("#c_city").empty();
                      }
                    
                  },
                  error: function(err) {
                    console.log(err);
                  }
          });
      }   
      
  }); 

  $('#country').change(function(){
      var cid = $(this).val();
      var url = '{{ route("states", ":id") }}';
      url = url.replace(':id', cid);
     
      if(cid){
          $.ajax({
                  type: 'GET',
                  url: url,
                  success: function (res) {
                    if(res){
                      $("#state").empty();
                   
                      $.each(res,function(key,value){
                        $("#state").append('<option value="'+value.id+'">'+value.name+'</option>');
                      });
                    
                    }else{
                      $("#state").empty();
                    }
                    
                  },
                  error: function(err) {
                    console.log(err);
                  }
          });
      }

     
  });
  $('#state').change(function(){
      var sid = $(this).val();
      var url = '{{ route("cities", ":id") }}';
      url = url.replace(':id', sid);
     
      if(sid){
          $.ajax({
                  type: 'GET',
                  url: url,
                  success: function (res) {
                      if(res)
                      {
                          $("#city").empty();
                         
                          $.each(res,function(key,value){
                              $("#city").append('<option value="'+value.id+'">'+value.name+'</option>');
                          });
                      }else{
                          $("#city").empty();
                      }
                  },
                  error: function(err) {
                    console.log(err);
                  }
          });
      }   
      
  }); 
</script>
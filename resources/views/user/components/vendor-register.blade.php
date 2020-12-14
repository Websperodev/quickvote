<div class="modal fade" id="vendorModal" tabindex="-2" role="dialog" aria-labelledby="VendorModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="row popupp">
          <div class="col-md-12">
          <h3 class="titleh3">Vendor Registration Form</h3>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
          
          <form id="register-frm-vendor"  class="vform mform row register-frm-vendor">

            <div class="form-group col-12">
            <label>Vendor Name</label>
              <input type="text" name="first_name" class="form-control col-6 fl" placeholder="First Name">
              <input type="text" name="last_name" class="form-control col-6 fr" placeholder="Last Name">
            </div>
            <div class="form-group col-6">
            <label>Business Name</label>
              <input type="text" name="business_name" class="form-control" placeholder="Your Business Name">
            </div>
            <div class="form-group col-6">
            <label>Contact Name</label>
              <input type="text" name="contact_name" class="form-control" placeholder="Your Contact Name">
            </div>
            <div class="form-group col-6">
            <label>E-mail</label>
              <input type="Email" name="email" class="form-control" placeholder="Your Email">
            </div>
            <div class="form-group col-6">
            <label>Password</label>
              <input type="password" name="password" class="form-control" placeholder="Your Password">
            </div>
            <div class="form-group col-6">
            <label>Phone Number</label>
              <input type="text" name="phone" class="form-control" placeholder="Your Number">
            </div>
            <div class="form-group col-6">
            <label>Alternate Phone Number</label>
              <input type="text" name="alternate_phn" class="form-control" placeholder="Your Alternate Number">
            </div>
            <div class="form-group addrs col-12">
            <label>Address</label>
              <input type="text" name="address1" class="form-control col-6 fl" placeholder="Street Address">
              <input type="text" name="address2" class="form-control col-6 fr" placeholder="Street Address Line 2">
              <input type="text" name="city" class="form-control col-6 fl" placeholder="City Name">
              <input type="text" name="state" class="form-control col-6 fr" placeholder="State/Province">
              <input type="text" name="postal" class="form-control col-6 fl" placeholder="Postal / Zip Code">
            <?php          
              $countries = config('constants.countries');        
            ?>
            <select class="form-control col-6 fr" name="county">
              <option value="">Select Country</option>
              @foreach($countries as $key => $value)
              <option value="<?= $key ?>" title="<?= htmlspecialchars($value) ?>"><?= htmlspecialchars($value) ?></option>
              @endforeach
            </select>
            </div>
            <div class="form-group col-12">
            <label>Your Description</label>
              <textarea type="text" name="description" class="form-control" placeholder="Description here.."> </textarea>
            </div>
            <button class="btn btn-bg">Submit Form</button>
          </form>
          </div>
        </div>
        </div>
      </div>
      </div>
  </div>
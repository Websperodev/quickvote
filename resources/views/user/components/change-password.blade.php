<div class="modal fade" id="changePassModal" tabindex="-1" role="dialog" aria-labelledby="ChangePassModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="row popupp">
          <div class="col-md-5">
          <h2 class="titleh2 tc">Welcome to The Quickvote</h2>
          <ul class="social-icon">
            <li><a href="#"> <i class="fab fa-facebook-f"></i> </a></li>
            <li><a href="#"> <i class="fab fa-twitter"></i> </a></li>
            <li><a href="#"> <i class="fab fa-google-plus-g"></i> </a></li>
            <li><a href="#"> <i class="fab fa-linkedin-in"></i> </a></li>
            <li><a href="#"> <i class="fab fa-instagram"></i> </a></li>
          </ul>
          </div>
          <div class="col-md-7">
          <h3 class="titleh3">Change Password</h3>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
            <form id="change-pass-frm"  class="lform mform change-pass-frm">
            <div class="alert alert-danger" style="display:none"></div>

            <div class="form-group">
            <label>Old Password</label>
              <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Enter your Password">
              <span><i class="fa fa-eye" aria-hidden="true" onclick="showPassword('old_password')"></i></span>
            </div>

            <div class="form-group">
            <label>New Password</label>
              <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter your Password">
              <span><i class="fa fa-eye" aria-hidden="true" onclick="showPassword('new_password')"></i></span>
            </div>

            <div class="form-group">
            <label>Confirm Password</label>
              <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter your Confirm Password">
              <span><i class="fa fa-eye" aria-hidden="true" onclick="showPassword('confirm_password')"></i></span>
            </div>  
            
            <button class="btn btn-bg">Submit</button>
            <br>
            <p> </p>
          </form>
          </div>
        </div>
        </div>
      </div>
      </div>

  </div>
  <script type="text/javascript">
    function showPassword(id) {
      var x = document.getElementById(id);
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    } 
  </script>
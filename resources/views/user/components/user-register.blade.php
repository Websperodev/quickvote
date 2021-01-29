<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
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
            <h3 class="titleh3">Register</h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
            <form id="register-frm-user"  class="lform mform register-frm-user">
              <div class="alert alert-danger" style="display:none"></div>
              <div class="form-group">
              <label>Email Address</label>
                <input type="text" name="email" autocomplete="off" class="form-control" placeholder="Enter your Email ID">
              </div>    
              <div class="form-group">
              <label>Password</label>
                <input type="password" name="password" id="user-password" class="form-control" placeholder="Password">
                <span><i class="fa fa-eye" aria-hidden="true" onclick="showPassword('user-password')"></i></span>
              </div>
              <div class="form-group">
              <label>Confirm Password</label>
                <input type="password" name="confirm_password" id="user-confirmpass" class="form-control" placeholder="Password">
                <span><i class="fa fa-eye" aria-hidden="true" onclick="showPassword('user-confirmpass')"></i></span>
               
              </div>

              <button class="btn btn-bg">Sign Up</button>
              <br>
              <p class="dhacc tc">Don't Have an account? <a class="signup" href="javascript:void(0);" id="vendorSignUp">Vendor Sign Up here</a></p>
            </form>
            </div>
          </div>
          </div>
        </div>
        </div>
  </div>
  
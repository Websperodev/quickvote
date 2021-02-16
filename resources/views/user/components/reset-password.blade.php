<div class="modal fade" id="resetPassModal" tabindex="-1" role="dialog" aria-labelledby="ResetPassModalLabel" aria-hidden="true">
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
          <h3 class="titleh3">Reset Password</h3>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
            <form id="reset-pass-frm"  class="lform mform reset-pass-frm">
            <div class="alert alert-danger" style="display:none"></div>
            <div class="form-group">
            <label>Password</label>
              <input type="password" name="password" id="pass" class="form-control" placeholder="Enter your Password">
            </div>  
             <div class="form-group">
            <label>Confirm Password</label>
              <input type="password" name="confirm_password" class="form-control" placeholder="Enter your Confirm Password">
            </div>  
            <input type="hidden" name="user_id" value="{{ isset($user_id) ? $user_id:''}}">
            
            <button class="btn btn-bg" id="reset-btn">Reset</button>
            <br>
            <p> </p>
          </form>
          </div>
        </div>
        </div>
      </div>
      </div>

  </div>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalLabel" aria-hidden="true">
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
          <h3 class="titleh3">Login</h3>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>



            <form id="login-frm-user"  class="lform mform login-frm-user">
            <div class="alert alert-danger" style="display:none"></div>
            <div class="form-group">
            <label>Email Address</label>
              <input type="text" name="email" class="form-control" placeholder="Enter your Email ID">
            </div>    
            <div class="form-group">
            <label>Password</label>
              <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <p class="flx"><span class="rem"><input type="Checkbox" class="form-control" name="remember" value="remember"> Remember me</span> <span class="forgot"><a href="javascript:void(0);" id="resetPass">Forgot Password?</a></span></p>
            <button class="btn btn-bg">Log In</button>
           <hr>
            <div class="form-group row mb-0">
             <div class="col-md-8 offset-md-4">
                <a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook</a>
            </div>
            </div>
            <br>
            <a href="{{ url('auth/google') }}" style="margin-top: 20px;" class="btn btn-lg btn-success btn-block">
              <strong>Login With Google</strong>
            </a> 
            <hr>
            <div class="col-md-8 col-md-offset-4">
              <a href="{{url('/auth/redirect/twitter')}}" class="btn btn-primary">Login with Twitter</a>
            </div>
            <p class="dhacc tc">Don't Have an account? <a class="signup" href="javascript:void(0);" id="openSignUp">Sign Up here</a></p>
          </form>
          </div>
        </div>
        </div>
      </div>
      </div>
  </div>
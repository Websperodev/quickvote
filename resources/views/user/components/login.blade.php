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
            <div class="alert alert-danger"  style="display:none"></div>
            <div class="form-group">
            <label>Email Address</label>
              <input type="text" name="email" class="form-control" placeholder="Enter your Email ID">
            </div>    
            <div class="form-group">
            <label>Password</label>
              <input type="password" id="login-password" name="password" class="form-control" placeholder="Password">
              <span><i class="fa fa-eye" aria-hidden="true" onclick="showPassword('login-password')"></i></span>
            </div>
            <p class="flx"><span class="rem"><input type="Checkbox" class="form-control" name="remember" value="remember"> Remember me</span> <span class="forgot"><a href="javascript:void(0);" id="resetPass">Forgot Password?</a></span></p>
            <button class="btn btn-bg">Log In</button>
           <hr>
            <div class="form-group row mb-0 social-logins">
              <div class="col-md-12">
                <a href="{{ url('/auth/redirect/facebook') }}" class="sc-icon fbicon"> <i class="fab fa-facebook-f"></i>Login With Facebook</a>
                <a href="{{ url('auth/google') }}" class="sc-icon gglicon"> <i class="fab fa-google"></i> Login With Google </a>
                <a href="{{url('/auth/redirect/twitter')}}" class="sc-icon twicon"><i class="fab fa-twitter"></i> Login with Twitter</a>
              </div>
            </div>
            <p class="dhacc tc">Don't Have an account? <a class="signup" href="javascript:void(0);" id="openSignUp">Sign Up here</a></p>
          </form>
          </div>
        </div>
        </div>
      </div>
      </div>
  </div>
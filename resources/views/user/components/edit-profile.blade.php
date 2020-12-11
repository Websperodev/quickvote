<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
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
            <h3 class="titleh3">Edit Profile</h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
            <form id="edit-profile-frm"  class="lform mform edit-profile-frm">
              <div class="alert alert-danger" style="display:none"></div>

              <div class="form-group">
              <label>First Name</label>
                <input type="text" name="first_name" value="{{ isset(\Auth::user()->first_name) ? ucfirst(\Auth::user()->first_name) : ''}}" class="form-control" placeholder="Enter your First Name">
              </div> 

              <div class="form-group">
              <label>Last Name</label>
                <input type="text" name="last_name" value="{{ isset(\Auth::user()->last_name) ? ucfirst(\Auth::user()->last_name) : ''}}" class="form-control" placeholder="Enter your Last Name">
              </div> 

              <div class="form-group">
              <label>Phone</label>
                <input type="text" name="phone" value="{{ isset(\Auth::user()->phone) ? ucfirst(\Auth::user()->phone) : ''}}" class="form-control" placeholder="Enter your Phone">
              </div> 

              <button class="btn btn-bg">Submit</button>
              <br>
              
            </form>
            </div>
          </div>
          </div>
        </div>
        </div>
</div>
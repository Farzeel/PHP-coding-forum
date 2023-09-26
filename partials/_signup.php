



<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">SignUp to I Discuss </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/forum/partials/_handleSignup.php" method="post">
  <div class="mb-3">
    <label for="signupemail" class="form-label">Email</label>
    <input type="email" class="form-control" id="signupemail" name="signupemail" aria-describedby="emailHelp">
   
  </div>
  <div class="mb-3">
    <label for="signupusername" class="form-label">User Name</label>
    <input type="text" class="form-control" id="signupusername" name="signupusername" aria-describedby="emailHelp">
   
  </div>
  <div class="mb-3">
    <label for="signuppassword" class="form-label">Password</label>
    <input type="password" class="form-control" id="signuppassword" name="signuppassword">
  </div>
  <div class="mb-3">
    <label for="signupcpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="signupcpassword" name="signupcpassword">
  </div>

  <button type="submit" class="btn btn-primary">SignUp</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>


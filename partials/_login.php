



<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel"> Login To iDiscuss </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/forum/partials/_handlelogin.php" method="post">
  <div class="mb-3">
    <label for="loginemail" class="form-label">Email</label>
    <input type="email" class="form-control" id="loginemail" name="loginemail" aria-describedby="emailHelp">
   
  </div>
  <div class="mb-3">
    <label for="loginpassword" class="form-label">Password</label>
    <input type="password" class="form-control" id="loginpassword" name="loginpassword">
  </div>


  <button type="submit" class="btn btn-primary">login</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>


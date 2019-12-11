<?php
require_once 'classes/Page.php';
$page = new Page();
echo $page->security();
echo $page->head("Encrypted Login - Add Admin");

$output = "";

if(isset($_POST['addAdmin'])){
  require_once 'classes/Admin.php';
  $admin = new Admin();
  $output = $admin->addAdmin($_POST);
}
?>
  <body>
    <div class="container">
    
    <h1>Add Admin</h1>
    <?php echo $page->nav(); ?>  
      <p>Enter a username and password to create a new administrator.</p>
      <p><?php echo $output ?></p>
      <form method="post" action="add_admin.php">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" name="username">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="submit" class="btn btn-primary" name="addAdmin" value="Add Admin" >
            </div>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
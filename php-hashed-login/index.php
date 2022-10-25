<?php
require_once 'classes/Page.php';
$page = new Page();
echo $page->head("Encrypted Login - Login Page");

//echo password_hash('password', PASSWORD_DEFAULT);


$output = "";

if(isset($_POST['login'])){
  require_once 'classes/Admin.php';
  $admin = new Admin();
  $output = $admin->login($_POST);
  echo $output;
  if($output === 'success'){
   
    header('Location: home.php');
  }


}

?>
  <body>
    <div class="container">
      <h1>Login Page</h1>
      <p>Enter username and password</p>
      <p>For test purposes the username is "sshaper" the password is "password"</p>
      <p>I created a database for this named administrator.  It has one table "admin" and two fields "username" and "password".  This is not included on the github site"</p>
      <p><?php echo $output ?></p>
      
      <form action="index.php" method="post">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="sshaper">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" value="password">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <input type="submit" class="btn btn-primary" name="login" value="Login">
          </div>
        </div>
      </div>
      </form>



    </div>

  </body>
</html>
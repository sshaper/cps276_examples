<?php

$output="";
if(count($_POST) > 0){
  require_once 'classes/Admin.php';
  $admin = new Admin();
  //BECAUSE THERE ARE DIFFERENT PAGES I SENT A PAGE NAME SO THE SCRIPT KNOW WHAT METHOD TO RUN
  $output = $admin->init("index");
}

?>
<!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Hashed Login</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="public/css/main.css" rel="stylesheet">
      </head>
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
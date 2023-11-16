<?php
//HERE I DON'T DO THE COUNT POST BECAUSE NO POST DATA IS BEING SENT TO THE SERVER
$output="";
require_once 'classes/Admin.php';
$admin = new Admin();

//BECAUSE THERE ARE DIFFERENT PAGES I SENT A PAGE NAME SO THE SCRIPT KNOW WHAT METHOD TO RUN
$output = $admin->init('addAdmin');

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
    
    <h1>Add Admin</h1>
    <nav>
        <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="add_admin.php">Add Admin</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>  

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
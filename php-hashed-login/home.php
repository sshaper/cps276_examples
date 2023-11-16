<?php
//THE COUNT($_POST) IS NOT USED ON THESE PAGES BECAUSE ONLY ONE NEEDS TO CHECK FOR POST INFORMATION AND THAT IS DONE IN THE CLASS
$output="";
require_once 'classes/Admin.php';
$admin = new Admin();

//BECAUSE THERE ARE DIFFERENT PAGES I SENT A PAGE NAME SO THE SCRIPT KNOW WHAT METHOD TO RUN
$output = $admin->init('home');



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
    <div id="wrapper" class="container">
      
      <h1>Home Page</h1>
      <nav>
        <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="add_admin.php">Add Admin</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
      <p>Below is a list of all usernames and encrypted passwords.</p>
        <div><?php echo $output; ?></div>

      
  </body>
</html>
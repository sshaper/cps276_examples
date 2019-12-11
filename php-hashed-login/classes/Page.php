<?php

class Page {
	public function nav(){
$nav = <<<HTML
      <nav>
        <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="add_admin.php">Add Admin</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
HTML;
		return $nav;
  }
  
  public function head($title="title"){

$head = <<<HTML
  <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>$title</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="public/css/main.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
      </head>
HTML;

    return $head;
  }

  public function security(){
    session_start();
    if($_SESSION['access'] !== "accessGranted"){
      header('location: index.php');
    }
  }

}
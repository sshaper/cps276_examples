<?php
$error = '';

if(isset($_POST['submit'])){
  /* IF THE USERNAME AND PASSWORD MATCH THEN REDIRECT TO */
  if($_POST['username'] === "admin" && $_POST['password'] === "password"){
    
    session_start();
    $_SESSION['access'] = "accessGranted";

    /* HERE I STORE A FIRST NAME IN THE SESSION AS WELL AND WILL DISPLAY IT ON EVERY PAGE*/
    $_SESSION['fname'] = $_POST['fname'];

    //session_regenerate_id();
    header('location:page1.php');
  }
  else {
    $error = "Incorrect username or password";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Session Index page</title>
		
	<!--below is a script which allows IE 8 to understand HTML 5 elements.-->
	<!--[if lt IE 9]>
    	<script>
    		var elementsArray = ['abbr', 'article', 'aside', 'audio', 'bdi', 'canvas', 'data', 'datalist', 'details', 'figcaption', 'figure', 'footer', 'header', 'main', 'mark', 'meter', 'nav', 'output', 'progress', 'section', 'summary', 'template', 'time', 'video'];
    		var len = elementsArray.length;
    		for(i = 0; i < len; i++){
    			document.createElement(elementsArray[i]);
    		}
    	</script>
	<![endif]-->

	<!--CSS style sheet goes here-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/main.css">
  </head>
  <body>
	<div id="wrapper">
    <header>
      <h1>Login</h1>
    </header>
    <main>
      <p class="error"><?php echo $error; ?></p>
      <p>Username is "admin" password is "password"</p>
      <form action="index.php" method="post">
        <div class="form-group">
          <label>First Name: <input type="text" name="fname" class="form-control"></label>
          <label>User Name: <input type="text" name="username" class="form-control"></label>
          <label>Password: <input type="password" name="password" class="form-control"></label>
          <input type="submit" name="submit" value="Login" class="btn btn-primary">
        </div>
        
        
        
      </form> 
    </main>
    
  </div>
  </body>
</html>
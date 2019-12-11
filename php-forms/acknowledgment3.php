<?php

/*IF THE FNAME WAS SENT I THE WEB ADDRESS THEN IT IS ASSUMED THE LNAME IS AS WELL, SO I DID NOT CHECK FOR THAT.  IF NAMES ARE SENT DISPLAY THE NAMES*/
if(isset($_GET['fname'])){
$output = <<<HTML
  <p>{$_GET['fname']} {$_GET['lname']} has successfully been added to our membership.</p>
HTML;
}
/* IF THE NAMES HAVE NOT BEEN SENT THEN DISPLAY THE MESSAGE WITH NO NAMES */
else {
  $output = "<p>You have successfully been added to our membership</p>";
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Basic Form</title>
    <style>
      input[type="radio"]{margin: 0 10px 0 0;}
    </style>
  </head>
  <body>
    <main class="container">
      <h1>Thank You!</h1>
      <?php echo $output; ?>
    </main>
</body>
</html>
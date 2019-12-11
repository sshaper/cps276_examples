<?php

$output = <<<HTML

  <p>This is the information sent to the server and displayed through the &amp;_POST superglobal.</p>
  <dl>
  <dt>First name</dt><dd>{$_POST["firstName"]}</dd>
  <dt>Last name</dt><dd>{$_POST["lastName"]}</dd>
  <dt>Password</dt><dd>{$_POST["password1"]}</dd>
  <dt>Retyped password</dt><dd>{$_POST["password2"]}</dd>
  <dt>Country</dt><dd>{$_POST["country"]}</dd>
  <dt>Favorite widget</dt><dd>{$_POST["favoriteWidget"]}</dd>
  <dt>Do you want to receive our newsletter?</dt><dd>{$_POST["newsletter"]}</dd>
  <dt>Comments</dt><dd>{$_POST["comments"]}</dd>
  </dl>

HTML;
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
      <h1>Membership Form</h1>
      <p>Thanks for choosing to join The Widget Club. To register, please fill in your details below and click Send Details.</p>
      <p>The information that has been sent to the server is displayed below.</p>
            <?php echo $output; ?>
    </main>
  </body>
</html>
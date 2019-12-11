<?php
require_once 'server/pageRoutes.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/main.css">

    <title><?php echo $pageData['title']; ?></title>
  </head>
  <body>
    <div class="container">

      <h1><?php echo $pageData['heading']; ?></h1>
      <?php echo $pageData['nav']; ?>
      <?php echo $pageData['content']; ?>
    </div>
  <?php echo $pageData['js']; ?>
  </body>
</html>
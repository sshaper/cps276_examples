<?php
require_once 'classes/Page.php';
require_once 'classes/Crud.php';
$page = new Page();
$crud = new Crud();
$output = $crud->init();


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CRUD Example</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
    <div id="wrapper" class="container">
      <header>
        <h1>Home Page</h1>
        <?php echo $page->nav(); ?>
      </header>
      <main>
        <p>Check the box next the name or names you want to update or delete and click the "update" or "delete" button.</p>
        <p><?php echo $output;?></p>
        <div><?php echo $crud->getNames('input'); ?></div>
      </main>

    </div>
  </body>
</html>
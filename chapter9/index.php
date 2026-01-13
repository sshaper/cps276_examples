<?php
require_once 'classes/Page.php';
require_once 'classes/Crud.php';
$page = new Page();
$crud = new Crud();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>PDO Crud Example</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="css/main.css" rel="stylesheet">

  </head>
  <body>
    <div class="container">
      <header>
        <h1>Home Page</h1>
        <?php echo $page->nav(); ?>
      </header>
        <main>
        <p>This example demonstrates the CRUD (create, read, update, and delete) operations using PDO.  This page reads and displays a list of names.</p>
      
        <div id="namesList"><?php echo $crud->getNames('list'); ?></div>
      </main>

    </div>
  </body>
</html>
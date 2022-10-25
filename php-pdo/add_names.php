<?php 
require_once 'classes/Page.php';
require_once 'classes/Crud.php';
$page = new Page();
$crud = new Crud();

$output = "";

if(isset($_POST['addName'])){
  $output = $crud->addName();
}


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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <header>
        <h1>Home Page</h1>
        <?php echo $page->nav(); ?>
      </header>
      
      <main>
        
          <p>Fill out all the fields and click the "Add Name" button.</p>
          <p><?php echo $output; ?></p>
        
        <form method="post" action="add_names.php">
        <div class="row">
          <div class="col-md-3">
            <label for="fname">First Name</label>
            <input type="text" class="form-control" placeholder="first name" id="fname" name="fname" value="Scott">
          </div>
          <div class="col-md-3">
            <label for="lname">Last Name</label>
            <input type="text" class="form-control" placeholder="last name" id="lname" name="lname" value="Shaper">
          </div> 
        </div>
        <div class="row">
          <div class="col-md-2">
            <label for="color">Eye Color</label>
            <input type="text" class="form-control" placeholder="eye color" id="color" name="color" value="blue">
          </div>
          
          <div class="col-md-2">
            <label for="state">State</label>
            <input type="text" class="form-control" placeholder="state" id="state" name="state" value="MI">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <input type="submit" class="btn btn-primary" name="addName" id="addName" value="Add Name">
          </div>
        </div>
      </form>
      </main>

    </div>
    

    <script src="../public/js/main.js"></script>
  </body>
</html>
<?php
require_once 'addNameProc.php';
$addNames = new AddNamesProc();
$output = $addNames->addClearNames();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    <title>Assignment 4</title>
</head>
<body>

    <main class="container">

    <form method="post" action="index.php">
    <h1>Add Names</h1>

    <div class="form-group">
    <button type="submit" class="btn btn-primary" name="addNamesButton" id="addNamesButton">Add Names</button>
    <button type="reset" class="btn btn-primary" name="clearNamesButton" id="clearNamesButton">Clear Names</button>
    </div>  

    <div class="form-row">
          <div class="col">
            <label for="names">Enter Names</label>
            <input type="text" class="form-control" name="names" id="names">
          </div>
    </div>

    <div class="form-row">
        <label for="namelist">List Of Names</label>
        <textarea style="height: 500px;" class="form-control"
        id="namelist" name="namelist"><?php echo $output?></textarea>
    </div>

    </form>

</body>
</html>
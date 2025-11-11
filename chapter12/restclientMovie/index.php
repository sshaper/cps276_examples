<?php
$output = "";
$errorMsg = "";
if(isset($_POST['rest'])){
    require_once 'php/api.php';
    $output = getOMDBData($_POST['title']);
    if(!$output){
        $errorMsg = "Could not get movie";
        $output ="";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Rest Client</title>
</head>
<body class="container">
    <?php echo $errorMsg  ?>
    <form action="index.php" method="post">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Enter Movie Title</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="title">
        </div>
        <button type="submit" name="rest" class="btn btn-primary">Make Rest Call</button>
    </form>

    <?php echo $output  ?>
</body>
</html>
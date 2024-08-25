<?php

//CREATING A FUNCTION CONTAINING A POTENTIAL EXCEPTION
function check_num($number) {
    if($number > 1) {
        throw new Exception("The value has to be 1 or lower");
    }
    $output = "Number is 1 or less";
}

try {
    check_num(2);
}
    
//CATCHING THE EXCEPTION
catch(Exception $e) {
    $output = 'Message: ' .$e->getMessage();
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>basic try catch</title>
</head>
<body>
    <?php echo $output; ?>
</body>
</html>
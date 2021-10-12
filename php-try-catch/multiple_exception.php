<?php
class custom_exception extends Exception {
    public function error_message() {
    //defining the error message
    $error_msg = 'Error caught on line '.$this->getLine()."<br> in ".$this->getFile()
    ."<br>: ".$this->getMessage()."<br> is no valid E-Mail address";
    return $error_msg;
    }
}
    
$email = "someonesomeexample@example.com";
    
try {
    //check if
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        //throwing an exception in case email is not valid
        throw new custom_exception($email);
    }

    //checking for "example" in mail address
    if(strpos($email, "example") !== FALSE) {
        throw new Exception("$email contains example'");
    }
    else {
        throw new Exception("$email does not contain the word example");
    }
}
        
catch (custom_exception $e) {
    $output = $e->error_message();
}

catch(Exception $e) {
    $output = $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Exception</title>
</head>
<body>
    <?php echo $output; ?>
</body>
</html>
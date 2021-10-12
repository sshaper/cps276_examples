<?php
class custom_exception extends Exception {
    public function error_message() {
        //defining the error message
        $error_msg = 'Error caught on line '.$this->getLine()."<br> in ".$this->getFile()."<br>: ".$this->getMessage()."<br> is not a valid E-Mail address";
        return $error_msg;
    }
}

$email = "someonesomeone@examcom";

try {
    //checking if
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
    //throwing an exception in case email is not valid
    throw new custom_exception($email);
    }
    else {
        $output = "The email is valid";
    }
}

catch (custom_exception $e) {
    //DISPLAYING A CUSTOM MESSAGE
    $output = $e->error_message();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>custom exception</title>
</head>
<body>
    <?php echo $output; ?>
</body>
</html>
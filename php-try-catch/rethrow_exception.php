<?php
class custom_exception extends Exception {
    public function error_message() {
        //error message
        $error_msg = $this->getMessage().' Does not contain “example”.';
        return $error_msg;
    }
}

$email = "someonesomeoneexample.com";


try {
    try {
    //CHECKING FOR "EXAMPLE" IN MAIL ADDRESS
        if(strpos($email, "example") === FALSE) {
            //THROWING AN EXCEPTION IF EMAIL DOES NOT CONTAIN EXAMPLE
            throw new Exception($email);
        }
        else {
            $output = "Email has word example";
        }
    }
    catch(Exception $e) {
        //RE-THROWING EXCEPTION
        throw new custom_exception($email);
    }
}

catch (custom_exception $e) {
    //DISPLAY CUSTOM MESSAGE
    $output = $e->error_message();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>re-throw exception</title>
</head>
<body>
    <?php echo $output; ?>
</body>
</html>
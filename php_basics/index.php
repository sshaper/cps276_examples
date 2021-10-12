<?php
class Person {
    private $_firstName;
    private $_lastName;
    private $_age;
    public function __construct( $firstName, $lastName, $age ) {
    $this->_firstName = $firstName;
    $this->_lastName = $lastName;
    $this->_age = $age;
    }
    public function __construct($firstName){
        $this->_firstName = $firstName;
    }

    public function showDetails() {
    echo "$this->_firstName $this->_lastName, age $this->_age<br>";
    }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Basics</title>
</head>
<body>
    
</body>
</html>
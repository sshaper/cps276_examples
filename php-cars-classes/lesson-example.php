<?php
include_once('Car.php');

$myCar = new Car();


$myCar->setWheels("Chrome");

$myCar2 = new Car();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Example</title>
</head>
<body>
    <?php
    echo "<h2>My Car</h2>";
    echo "myCar - " . $myCar->getWheels()."<br>";
    echo "<h2>My Car and My Car 2</h2>";
    echo "myCar - " . $myCar->getWheels()."<br>";
    echo "myCar - " . $myCar2->getWheels()."<br>";
    ?>
</body>
</html>

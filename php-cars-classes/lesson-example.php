<?php
include_once('Car.php');

$myCar = new Car();

echo "<h2>My Car</h2>";
echo "myCar - " . $myCar->getWheels()."<br>";
$myCar->setWheels("Chrome");

$myCar2 = new Car();
echo "<h2>My Car and My Car 2</h2>";
echo "myCar - " . $myCar->getWheels()."<br>";
echo "myCar - " . $myCar2->getWheels()."<br>";

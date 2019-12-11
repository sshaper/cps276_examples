<?php
include_once('CarType.php');

$myCorvette = new CarType("Corvette");

$myCorvette->setColor("Red");
$myCorvette->setWheels("Chrome");
$myCorvette->setSeat("2 Leather Black");
$myCorvette->setRadio("AM/FM/Bluetooth/CD");
$myCorvette->setExtras("Hood Scope");
$myCorvette->setExtras("Fin Tail");

echo $myCorvette->carDetails();
echo "<br><br>";

$myCRV = new CarType();
$myCRV->setType("Honda CRV");
$myCRV->setEngine("4 cylinder");
$myCRV->setRadio("AM/FM/Bluetooth/CD");
$myCRV->setExtras("GPS");

echo $myCRV->carDetails();


$myCarSubClass = new CarType("somecar");
echo $myCarSubClass->carDetails();





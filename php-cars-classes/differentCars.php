<?php
include_once('CarType.php');

$myCorvette = new CarType("Corvette");

//THIS ONE WE CHANGE PROPERTIES AND WE ADD SOME EXTRAS
$myCorvette->setColor("Red");
$myCorvette->setWheels("Chrome");
$myCorvette->setSeat("2 Leather Black");
$myCorvette->setRadio("AM/FM/Bluetooth/CD");
$myCorvette->setExtras("Hood Scope");
$myCorvette->setExtras("Fin Tail");

//THIS ONE WE CHANGE PROPERTIES AND WE ADD SOME EXTRAS
$myCRV = new CarType();
$myCRV->setType("Honda CRV");
$myCRV->setEngine("4 cylinder");
$myCRV->setRadio("AM/FM/Bluetooth/CD");
$myCRV->setExtras("GPS");

//THIS ONE WE DO NOT CHANGE ANY PROPERTIES OR ADD EXTRAS
$myCarSubClass = new CarType("Some Car");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Different Cars</title>
</head>
<body>
  <?php
    echo $myCorvette->carDetails();
    echo "<br><br>";
    echo $myCRV->carDetails();
    echo "<br><br>";
    echo $myCarSubClass->carDetails();

  ?>
</body>
</html>





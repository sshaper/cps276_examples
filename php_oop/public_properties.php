<?php
class Car {
    public $color;
    public $manufacturer;
}

//PUBLIC PROPERTIES ALLOW THE OBJECT OF THE CLASS TO CHANGE THE PROPERTY VALUE.  THIS IS NORMALLY NOT A GOOD PRACTICE YOU SHOULD HAVE METHODS THAT DO THAT.
$beetle = new Car();
$beetle->color = "red";
$beetle->manufacturer = "Volkswagen";


$mustang = new Car();
$mustang->color = "green";
$mustang->manufacturer = "Ford";


echo $beetle->color."<br>";
echo $beetle->manufacturer."<br>";
echo $mustang->color."<br>";
echo $mustang->manufacturer."<br>";

echo "<pre>";
print_r($beetle);
echo "<br>";
print_r($mustang);

?>


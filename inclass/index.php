<?php
class Vehicle {
private $wheels = 4;    
public function start() {
        return $this->wheels;
    }
}

class Car extends Vehicle {
    
    public function starty() {
        $parentStart = $this->start(); // Call the parent method
        return $parentStart . " Checking seatbelts...";
    }
}

$car = new Car();
echo $car->starty();  // Outputs: Starting the engine... Checking seatbelts...

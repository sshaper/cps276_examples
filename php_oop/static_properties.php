<?php

//STATIC PROPETIES MUST BE PUBLIC
class Car {
    public $color;
    public $manufacturer;
    static public $numberSold = 123;
}

Car::$numberSold++;

//NOTICE THE VALUE CHANGES EVEN THOUGHT I DID NOT INSTATIATE THE CLASS
echo Car::$numberSold;


?>
<?php

//STATIC METHODS MUST BE PUBLIC
class Car {
    public static function calcMpg( $miles, $gallons ) {
        return ( $miles / $gallons );
    }
}
    echo Car::calcMpg( 168, 6 );
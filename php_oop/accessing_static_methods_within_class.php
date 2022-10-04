<?php
class Car {

    //BECAUSE THIS IS CALLED WITHIN THE CLASS IT CAN BE PRIVATE AS WELL.
    public static function calcMpg( $miles, $gallons ) {
        return ( $miles / $gallons );
    }

    //TO ACCESS PUBLIC METHODS YOU USE THE 'SELF' KEYWORD NOT 'THIS'
    public static function displayMpg( $miles, $gallons ) {
        echo "This car’s MPG is: " . self::calcMpg( $miles, $gallons );
    }
}
    
echo Car::displayMpg( 168, 6 );


    
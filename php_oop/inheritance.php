<?php
class Shape {
    private $_color = "black";
    private $_filled = false;

    public function getColor() {
        return $this->color;
    }

    public function setColor( $color ) {
        $this->color = $color;
    }

    public function isFilled() {
        return $this->filled;
    }

    public function fill() {
        $this->filled = true;
    }

    public function makeHollow() {
        $this->filled = false;
    }
}


class Circle extends Shape {
    private $_radius = 0;

    public function getRadius() {
        return $this->radius;
    }

    public function setRadius( $radius ) {
        $this->radius = $radius;
    }

    public function getArea() {
        return M_PI * pow( $this->radius, 2 );
    }
}
    
class Square extends Shape {
    private $_sideLength = 0;

    public function getSideLength() {
        return $this->sideLength;
    }

    public function setSideLength( $length ) {
        $this->sideLength = $length;
    }

    public function getArea() {
        return pow( $this->sideLength, 2 );
    }
}

    $myCircle = new Circle;
    $myCircle->setColor( "red" );
    $myCircle->fill();
    $myCircle->setRadius(4);
    echo "My Circle<br>";
    echo "My circle has a radius of " . $myCircle->getRadius()."<br>";
    echo "It is " . $myCircle->getColor() . " and it is " . ( $myCircle->isFilled() ? "filled" : "hollow" )."<br>";
    echo "The area of my circle is: " . $myCircle->getArea()."<br>";

    echo "<br><br>";

    $mySquare = new Square;
    $mySquare->setColor("green");
    $mySquare->makeHollow();
    $mySquare->setSideLength(3);
    echo "My Square<br>";
    echo "My square has a side length of " . $mySquare->getSideLength()."<br>";
    echo "It is " . $mySquare->getColor() . " and it is " . ( $mySquare->isFilled() ? "filled" : "hollow" )."<br>";
    echo "The area of my square is: " . $mySquare->getArea()."<br>";
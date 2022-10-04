<?php

class MyClass1 {
    public function hello() {
    echo "Hello, World! (echoed)";
    }
}



$obj1 = new MyClass1;
$obj1->hello();

echo "<br>"; //THIS WAS ADDED TO CREATE A NEW LINE IN HTML

//THIS CLASS RETURNS THE RESULT INSTEAD OF ECHOING IT DIRECTLY.  WHEN USING CLASSES IT IS BETTER TO RETURN A VALUE THEN ECHO IT.
class MyClass2 {
    public function hello() {
        return "Hello, World! (returned)";
    }
}

$obj2 = new MyClass2;
echo $obj2->hello();




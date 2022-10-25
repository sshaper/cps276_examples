<?php
class MyClass {
    private $greeting = "Hello, World!";

    public function hello() {
        return $this->greeting;
    }
}


$obj = new MyClass;
echo $obj->hello(); // DISPLAYS "HELLO, WORLD!"
<?php

class MyClass {
    private function getGreeting() {
        return "Hello, World!";
}
    public function hello() {
        echo $this->getGreeting();
    }
}

$obj = new MyClass;
$obj->hello(); // DISPLAYS "HELLO, WORLD!"

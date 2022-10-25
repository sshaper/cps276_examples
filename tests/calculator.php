<?php

class Calculator{
    public function calc($operator="err", $num1="err", $num2="err"){
        return "it works";
    }
}

$Calc = new Calculator();

echo $Calc->calc(10);
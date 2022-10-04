<?php
class MyClass {
    function __construct() {
        echo "Hello Class!";
    }
}
    
//USES THE PARENT CLASS CONSTRUCT
    
class Test1 extends MyClass {

}
    
//OVERRIDES THE PARENT CLASS CONSTRUCT
class Test2 extends MyClass {
    function __construct(){
        echo "My name is Scott";
    }
}

    //USES THE PARENT CLASS AND ITS OWN CONTRUCTOR
    class Test3 extends MyClass {
    function __construct(){
        parent::__construct();
        echo ", Welcome To PHP";
    }
}

$tst1 = new Test1();
echo "<br>";
$tst2 = new Test2();
echo "<br>";
$tst3 = new Test3();
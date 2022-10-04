<?php
class Fruit {
    
    public function peel() {
        echo "I’m peeling the fruit...<br>";
    }

    public function slice() {
        echo "I'm slicing the fruit...<br>";
    }

    public function eat() {
        echo "I’m eating the fruit. Yummy!<br>";
    }

    public function consume() {
        $this->peel();
        $this->slice();
        $this->eat();
    }
}
    
class Grape extends Fruit {
    public function peel() {
        echo "No need to peel a grape!<br>";
    }
    public function slice() {
        echo "No need to slice a grape!<br>";
    }
}
    
echo "Consuming an apple...<br>";
$apple = new Fruit;
$apple->consume();
echo "Consuming a grape...<br>";
$grape = new Grape;
$grape->consume();

echo "<br><br>";

//THE BANANA CLASS EXTENDS FRUIT AND HAS ITS OWN CONSUME METHOD BUT ALSO USING THE PARENT CONSUME METHOD
class Banana extends Fruit {
    public function consume() {
        echo "I'm breaking off a banana<br>";
    
        parent::consume();
    }
}

$banana = new Banana;
$banana->consume();
<?php
/*THIS IS HOW WE CREATE THE INTERFACES NOTICE WE GIVE THEM METHODS THAT ARE JUST METHOD NAMES AND HAVE NO CONTENT. THE METHODS WILL BE DEFINED IN THE CLASS THAT IMPLEMENTS THE INTERFACE*/
interface Characteristics {
    public function sound();
    public function describe();
}

interface Owner {
    public function setOwnersName($name);
    public function getOwnersName();
}

class Animal {
    private $_legs;
    private $_wings;
    public function __construct($legs, $wings) {
        $this->_legs = $legs;
        $this->_wings = $wings;
    }
    public function getLegs(){
        return $this->_legs;
    }
    public function getWings(){
        return $this->_wings;
    }
}


/*NOTICE HOW THIS CLASS EXTENDS ANIMAL AND IMPLEMENTS BOTH CHARACTERISTICS AND OWNER*/
class Dog extends Animal implements Characteristics, Owner{
    private $_name;
    /*THE FOLLOWING FOUR FUNCTIONS ARE FROM THE INTERFACES BUT THE METHODS CONTENT IS WRITTEN IN THE CLASS. BECAUSE WE IMPLEMENTED THE INTERFACE, WE HAVE TO USE ALL THE METHODS NAMED IN THE INTERFACE*/
    public function sound(){
        return "woof, woof";
    }
    public function setOwnersName($name){
        $this->_name = $name;
    }
    public function getOwnersName(){
        return $this->_name;
    }
    public function describe(){
        return "<p>This animal has {$this->getLegs()} legs and {$this->getWings()} wings and makes a {$this->sound()} sound. The owners name is {$this->getOwnersName()}.</p>";
    }
}

//HERE WE JUST IMPLEMENT ONE INTERFACE
class Cat extends Animal implements Characteristics{
    public function sound(){
        return "meow";
    }


/*NOTICE THE DESCRIBE HERE IS DIFFERENT THAN THAT OF THE DOG CLASS. WE CAN DO THIS BECAUSE WE ARE USING INTEFACES AND THE CLASS DESCRIBES WHAT THE METHOD WILL DO. SO EACH CLASS DOG AND CAT HAVE A DIFFERENT FUNCTION FOR THE DESCRIBE METHOD.*/
    public function describe(){
        
        return "<p>This animal has {$this->getLegs()} legs and {$this->getWings()} wings and makes a {$this->sound()} sound</p>";
    }

}


$dog = new Dog(4, 0);
$dog->setOwnersName("Scott");
echo $dog->describe();

$cat = new Cat(4, 0);
echo $cat->describe();

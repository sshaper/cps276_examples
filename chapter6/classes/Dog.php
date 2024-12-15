<?php
require_once 'Animal.php';
require_once 'interfaces/Characteristics.php';
require_once 'interfaces/Owner.php';

class Dog extends Animal implements Characteristics, Owner {
    private $ownerName;
    const SPECIES = "Canis Lupus Familiaris";

    public function __construct($ownerName) {
        parent::__construct(4, 0);
        $this->ownerName = $ownerName;
    }

    public function sound() {
        return "Woof, woof!";
    }

    public function setOwnerName($name) {
        $this->ownerName = $name;
    }

    public function getOwnerName() {
        return $this->ownerName;
    }

    public static function describeSpecies() {
        return "Most dogs are domesticated mammals, not natural wild animals.";
    }

    public function describe() {
        return "This is a dog with " . $this->getLegs() . " legs and " . $this->getWings() . " wings. It says " . $this->sound() . ". The owner's name is " . $this->getOwnerName() . ".";
    }
}
?>
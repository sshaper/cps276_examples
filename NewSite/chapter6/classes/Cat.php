<?php
require_once 'Animal.php';
require_once 'interfaces/Characteristics.php';

class Cat extends Animal implements Characteristics {
    private $color;
    const SPECIES = "Felis Catus";

    public function __construct($color) {
        parent::__construct(4, 0);
        $this->color = $color;
    }

    public function sound() {
        return "Meow!";
    }

    public function getColor() {
        return $this->color;
    }

    public static function describeSpecies() {
        return "Cats are small, carnivorous mammals that are often kept as pets.";
    }

    public function describe() {
        return "This is a " . $this->color . " cat with " . $this->getLegs() . " legs and " . $this->getWings() . " wings. It says " . $this->sound() . ".";
    }
}
?>
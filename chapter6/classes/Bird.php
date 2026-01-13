<?php
require_once 'Animal.php';
require_once 'interfaces/Characteristics.php';

class Bird extends Animal implements Characteristics {
    private $species;
    const CLASSIFICATION = "Aves";

    public function __construct($species) {
        parent::__construct(2, 2);
        $this->species = $species;
    }

    public function sound() {
        return "Chirp!";
    }

    public function getSpecies() {
        return $this->species;
    }

    public static function describeClassification() {
        return "Birds are a group of warm-blooded vertebrates constituting the class Aves.";
    }

    public function describe() {
        return "This is a " . $this->species . " bird with " . $this->getLegs() . " legs and " . $this->getWings() . " wings. It says " . $this->sound() . ".";
    }
}
?>
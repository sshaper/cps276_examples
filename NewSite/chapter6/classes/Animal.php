<?php
abstract class Animal {
    protected $legs;
    protected $wings;
    private static $animalCount = 0;

    const ANIMAL_TYPE = "General Animal";

    public function __construct($legs, $wings) {
        $this->legs = $legs;
        $this->wings = $wings;
        self::$animalCount++;
    }

    public static function getAnimalCount() {
        return self::$animalCount;
    }

    public static function describeAnimalType() {
        return "Animals are multicellular, eukaryotic organisms.";
    }

    public function getLegs() {
        return $this->legs;
    }

    public function getWings() {
        return $this->wings;
    }

    abstract public function describe();
}
?>
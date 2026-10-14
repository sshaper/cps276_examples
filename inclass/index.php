<?php

class Student {
    private $name;
    private $grades = [];

    public function setName($name) {
        if (strlen($name) >= 2) {
            $this->name = $name;
            return true;
        }
        return false;
    }

    public function addGrade($grade) {
        if ($grade >= 0 && $grade <= 100) {
            $this->grades[] = $grade;
            return true;
        }
        return false;
    }

    public function getAverage() {
        if (empty($this->grades)) {
            return "No grades available";
        }
        return "Average: " . (array_sum($this->grades) / count($this->grades));
    }
}

// Using the encapsulated student class
$student = new Student();
$student->setName("John");
$student->addGrade(85);
$student->addGrade(90);
echo $student->getAverage();  // Outputs: Average: 87.5



?>
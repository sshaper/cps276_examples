<?php
    require_once 'classes/Dog.php';
    require_once 'classes/Cat.php';
    require_once 'classes/Bird.php';

    // Creating objects
    $dog = new Dog("John");
    $cat = new Cat("black");
    $bird = new Bird("sparrow");

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Class Example Project</title>
  </head>
<body class="container">
    <h1 class="text-center">Class Example Project</h1>

    <h2>General Animal Information</h2>
    <p><?php echo Animal::describeAnimalType() ?></p>

    <h3>Dog</h3>
    <p><?php echo $dog->describe() ?></p>
    <p>Species: <?php echo Dog::SPECIES ?></p>
    <p><?php echo Dog::describeSpecies() ?></p>
    
    <h3>Cat</h3>
    <p><?php echo $cat->describe() ?></p>
    <p>Species: <?php echo Cat::SPECIES ?></p>
    <p><?php Cat::describeSpecies()?></p>

    <h3>Bird</h3>
    <p><?php echo $bird->describe() ?></p>
    <p>Classification: <?php echo Bird::CLASSIFICATION ?></p>
    <p><?php echo Bird::describeClassification() ?></p>

    <h3>Total Animals</h3>
    <p>There are <?php echo Animal::getAnimalCount()?> animals created.</p>

</body>
</html>
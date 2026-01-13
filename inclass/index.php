<?php


$d = strtotime("March 28, 2006 9:42am");
$output = date("The jS of F, Y, at g:i A", $d);
// Output: "The 28th of March, 2006, at 9:42 AM"


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    
  </head>
  <body>
    <?php echo $output ?>
</body>
    
</html>
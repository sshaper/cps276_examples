<?php
$handle = fopen("../files/hello_world.txt", "r+");

//fwrite($handle, "Hello World");

echo fread($handle, 1000);

fclose($handle);

?>
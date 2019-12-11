<?php
$handle = fopen("../files/hello_world.txt", "w");

fwrite($handle, "Hello World");

fclose($handle);

$handle = fopen("../files/hello_world.txt", "r");

echo fread($handle,1000)."\n";

fclose($handle);

$handle = fopen("../files/hello_world.txt", "a");

fwrite($handle, "Hello World Again");

fclose($handle);

$handle = fopen("../files/hello_world.txt", "r");

echo fread($handle,1000);

fclose($handle);

?>
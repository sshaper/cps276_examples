<?php

$str = file_get_contents('books.txt');

/* DECODES THE TEXT INTO AN OBJECT */
$json = json_decode($str);

echo "<p>This is print r of an object</p>";
echo "<pre>";
print_r($json);
echo "</pre>";


echo "<p>This is a print r of an associative array</p>";

/*DECODES THE TEXT INTO AN ASSOCIATIVE ARRAY*/
$json = json_decode($str, true);

echo "<p>This is print r of an object</p>";
echo "<pre>";
print_r($json);
echo "</pre>";
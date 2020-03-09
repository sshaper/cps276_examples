<?php
$handle = fopen('../files/csv.txt', 'r');
$names = "";

//print_r(fgetcsv($handle, 0));


while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
    $names .= "<p>Name: {$data[0]} {$data[1]} Age: {$data[2]}</p>";
}

echo $names;

?>
<?php  
$names = ["Scott","Karen","Mike","Judy","Aaron"];

$output = "<ul>";

foreach ($names as $name) {
  $output .= "<li>{$name}</li>";
}
$output .= "</ul>";
?>
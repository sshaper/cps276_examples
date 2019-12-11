<?php  
function getNames(){

	$names = ["Scott","Karen","Mike","Judy","Aaron","Bronson","Brevick"];

	$output = "<ul>";

	foreach ($names as $name) {
	  $output .= "<li>{$name}</li>";
	}
	$output .= "</ul>";

	return $output;
}

<?php

/* JSON_DECODE TAKES THE JSON STRING OF THE POST DATA (DATA IS THE NAME THAT CONTAINS THE STRING THAT WAS SENT) AND TURNS IT INTO A PHP OBJECT.  IN THIS CASE THAT OBJECT IS NAMED $DATA */
$data = json_decode($_POST['data']);

/* HERE I CREATE A STRING THAT ADDS THE VALUE OF THE $DATA OBECT TO A STRING.  */
$output = "The first name is {$data->fname}<br>";
$output .= "The last name is {$data->lname}<br>";
$output .= "The address is {$data->address}<br>";
$output .= "The city is {$data->city}<br>";

/* HERE I CREATE AND OBJECT WHERE THE RESP PROPERTY CONTAINS WHAT THE OUTPUT STRING IS. I CREATED AN OBJECT TO SHOW THAT I COULD HAVE MULIPLE PROPERTIES ASSIGNED TO IT.  I SENT A MASTERSTATUS OF SUCCESS EVEN THOUGH (IN THIS CASE) THERE IS NOT MASTERSTATUS OF ERROR.  BUT IN MANY CASES THERE IS SO I WANTED TO SHOW HOW YOU COULD SEND MULIPLE PROPERTIES.*/
$response = (object)[
	'masterstatus'=>'success',
	'resp'=>$output
];

echo json_encode($response);


?>
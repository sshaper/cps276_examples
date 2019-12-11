<?php

/* GET THE FILE CONTENTS*/
$json = file_get_contents('../data/books.txt');

/* IF THERE IS A PROBLEM GETTING THE FILE CONTENTS THEN CREATE AN OBJECT AND SEND THE ERROR MESSAGE TO THE BROWSER*/
if(!$json){
	$response = (object) [
	    'masterstatus' => 'error',
	    'msg' => 'Could not read file',
	  ];
	echo json_encode($response);

	/* BECAUSE WE DON'T WANT TO GO ANY FURTHER WITH THIS OPERATION TERMINATE IT HERE */
	exit;
}


/* IF ALL IS OKAY THEN CREATE AN OBJECT FROM THE JSON FILE USING JSON_DECODE*/
$json = json_decode($json);

$i = 0;
$j = 0;
$list = '<ul>';

/* LOOP THROUGH THE OBJECT AND CREATE THE BOOK DETAILS AS AN UNORDERED LIST*/
while($i < count($json)){
	$list .= '<li>' . $json[$i]->title;
	$list .= 'By ' . $json[$i]->author . '<br>';
	$list .= 'Published By <em>' . $json[$i]->publisher . '</em><br>Editions:<ul>';

	/* NEED TO RESET J TO ZERO*/
	$j = 0;

	/* BECAUSE THE EDITIONS CAN HAVE MORE THAN ONE IT IS STORED AS AN ARRAY.  THIS INNER LOOP GOES THROUGH THE ARRAY AND LISTS THE EDITIONS*/
	while($j < count($json[$i]->editions)){
		$list .= '<li>' . $json[$i]->editions[$j]->edition . " " . $json[$i]->editions[$j]->year . '</li>';
		$j++;
	}

	$list .= '</ul></li>';
	$i++;
}

$list .= '</ul>';

/* CREATE ANOTHER PHP OBJECT TO STORE THE MASTERSTATUS AND THE LIST, THEN ENCODE THE OBJECT (PUT IT INTO A STRING) AND SEND IT TO THE BROWSER */
$response = (object) [
	    'masterstatus' => 'success',
	    'list' => $list,
	  ];
	echo json_encode($response);

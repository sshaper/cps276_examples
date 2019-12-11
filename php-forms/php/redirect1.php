<?php


/* LOOPS THROUGH THE POST ARRAY AND CHECK FOR ANY BLANK VALUES. IF FOUND REDIRECT BACK TO THE FORM AND EXIT THE SCRIPT.*/
foreach($_POST as $value){
	if($value === ""){
		header('Location: ../form_redirect1.html');
		exit;
	}
}

/* IF EVERYTHING IS OKAY REDIRECT TO THE ACKNOWLEDGEMENT PAGE. */

header('Location: ../acknowledgment1.html');


<?php


/* LOOPS THROUGH THE POST ARRAY AND CHECK FOR ANY BLANK VALUES. IF FOUND REDIRECT BACK TO THE FORM AND EXIT THE SCRIPT.*/
foreach($_POST as $value){
	if($value === ""){
		header('Location: ../form_redirect.html');
		exit;
	}
}

/* IF EVERYTHING IS OKAY BASED UPON WHAT BUTTON IS PRESSED EITHER SEND INFORMATION IN THE WEB ADDRESS OR DONT */

if($_POST['showName']){
	header("Location: ../acknowledgment3.php?fname={$_POST['firstName']}&lname={$_POST['lastName']}");
}

else if($_POST['dontShowName']){
	header("Location: ../acknowledgment3.php");
}




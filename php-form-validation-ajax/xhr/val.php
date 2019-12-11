<?php
require '../classes/Validation.php';
$validate = new Validation();

/* GET THE DATA*/
$data = $_POST['data'];

/* DECODE THE DATA TRANSFORMING A STRING TO AN OBJECT (ASSOCIATIVE ARRAY)*/
$data = json_decode($data, true);

/* THE VALIDATION CLASS WILL RETURN EITHER AN OBJECT (ON FAILURE) OR A "SUCCESS" MESSAGE */
$data = $validate->validate($data);
if($data == 'success'){
	echo "success";
}
else {
	$data = json_encode($data);
	echo $data;
}

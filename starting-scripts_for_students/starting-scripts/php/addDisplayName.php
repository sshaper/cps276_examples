<?php

//$data = $_POST['data'];

//$dataObj = json_decode($data);

$dataObj = json_decode($_POST['data']);

echo $dataObj->name;


/* thaer */
$data = $_POST["data"];

echo $data;

$dataObj = json_decode($data);

//echo $dataObj->name;

    $name = explode(" ", $dataObj->name);
    $fname = $name[0];
    $lname = $name[1];
    $addName = "$lname, $fname\n";

    $sql = "INSERT INTO names (name) VALUES (:name)";

    $bindings = [
        [":name", $addName, "str"]
	];



//write the code for displaying the names when the "Display Names" button is clicked here.
  public function displayNames(){
	  $sql = "SELECT * FROM names";

     
  }


	

    
//echo json_encode($myObject);






/*

1. format the name to be lastname, firstname

2. put that name into the database that you need to create

3. Query the database and get all the names in order
4. create on string that will take all the names from the database and separate them with \n
5. Send that string back to the client

*/


//IF THERE IS AN ERROR THEN DO

$response = (object)[
	'masterstatus'=>'error',
	'msg'=>"There was a problem"
];

$names = "Adams, Amy\nShaper, Scott\nZebra, Zep";


$response = (object)[
	'masterstatus'=>'success',
	'names'=>$names
];

//echo json_encode($response);

//write the code for adding and displaying the names here when the "Add Name" button is clicked
?>
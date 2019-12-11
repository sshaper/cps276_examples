<?php
require_once '/var/www/html/cps276/cps276_examples/php_mvc/classes/Pdo_methods.php';


/* THIS FUNCTION WILL GET ALL THE NAMES FROM THE DATABASE, BUT (DEPENDING ON WHAT ARGUMENT IS SENT) IT WILL EITHER DISPLAY THE LIST AS A UNORDERED LIST. OR RETURN THE LIST WHERE EACH PART IS IN AN INPUT FIELD FOR EDITING */
function getNames($type){
	
	/* CREATE AN INSTANCE OF THE PDOMETHODS CLASS*/
	$pdo = new PdoMethods();

	/* CREATE THE SQL */
	$sql = "SELECT * FROM short_names";
	$records = $pdo->selectNotBinded($sql);

	/* IF THERE WAS AN ERROR DISPLAY MESSAGE */
	if($records == 'error'){
		/* SINCE THIS METHOD IS CALLED DIRECTLY FROM THE PAGE AND NOT A AJAX REQUEST AS SIMPLE RETURN STATEMENT IS USED */
		return 'There has been and error processing your request';
	}
	
	/* IF THERE ARE SOME RECORDS RETURNED THEN DEPENDING ON THE TYPE CALL THE APPROPRIATE FUNCTION CREATELIST OR CREATE INPUT*/
	else{
		if(count($records) != 0){
			if($type == 'list'){return createList($records);}
			if($type == 'input'){return createInput($records);}	
		}
		else {
			return 'no names found';
		}
	}
}


/*THIS FUNCTION TAKES THE DATA FROM THE DATABASE AND RETURN AN UNORDERED LIST OF THE DATA*/
function createList($records){
	$list = '<ol>';
	foreach ($records as $row){
		$list .= "<li>Name: {$row['first_name']} {$row['last_name']} - Eye Color: {$row['eye_color']} - Gender: {$row['gender']} - State: {$row['state']}</li>";
	}
	$list .= '</ol>';
	return $list;
}

/*THIS FUNCTION TAKES THE DATA AND RETURNS THE DATA IN INPUT ELEMENTS SO IT CAN BE EDITED.  */
function createInput($records){
	$output = "<table class='table table-bordered'><thead><tr><th>First Name</th><th>Last Name</th><th>Eye Color</th><th>Gender</th><th>State</th><th>Update</th><th>Delete</th></thead><tbody>";
	foreach ($records as $row){
		
		$output .= "<tr><td><input type='text' class='form-control' name='fname' value='".$row['first_name']."'></td>";
		$output .= "<td><input type='text' class='form-control' name='lname' value='{$row['last_name']}'></td>";
		$output .= "<td><input type='text' class='form-control' name='color' value='{$row['eye_color']}'></td>";
		$output .= "<td><input type='text' class='form-control' name='gender' value='{$row['gender']}'></td>";
		$output .= "<td><input type='text' class='form-control' name='state' value='{$row['state']}'></td>";
		$output .= "<td><input type='button' class='btn btn-success' id='u{$row['id']}' value='Update' ></td>";
		$output .= "<td><input type='button' class='btn btn-danger' id='d{$row['id']}' value='Delete' ></td></tr>";
	}

	$output .= "</table></tbody>";
	
	return $output;
}

/* THE ADD NAME FUNCTION ADDS THE NAME TO THE DATABASE */
function addName($dataObj){
	$pdo = new PdoMethods();

	/* HERE I CREATE THE SQL STATEMENT BUT USE :FIELDNAME */
	$sql = "INSERT INTO short_names (first_name, last_name, eye_color, gender, state) VALUES (:fname, :lname, :eyecolor, :gender, :state)";
    
    /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS */
    $bindings = array(
		array(':fname',$dataObj->fname,'str'),
		array(':lname',$dataObj->lname,'str'),
		array(':eyecolor',$dataObj->color,'str'),
		array(':gender',$dataObj->gender,'str'),
		array(':state',$dataObj->state,'str')
	);

	/* I AM CALLING THE OTHERBINDED METHOD FROM MY PDO CLASS */
	$result = $pdo->otherBinded($sql, $bindings);

	/* HERE I AM USING AN OBJECT TO RETURN WHETHER SUCCESSFUL FOR ERROR */
	if($result === 'error'){
		$response = (object) [
	    	'masterstatus' => 'error',
	    	'msg' => 'There was a problem adding the name',
		];
		echo json_encode($response);
	}
	else {
		$response = (object) [
	    	'masterstatus' => 'success',
	    	'msg' => 'Name has been added',
	    	'specificaction' => 'clearform'
		];
		echo json_encode($response);
	}
}

/* THIS FUNCTION WILL UPDATE THE NAME AND OTHER INFORMAITON FOR THE ROW THAT WAS CLICKED */
function updateName($dataObj){
	$pdo = new PdoMethods();
	$sql = "UPDATE short_names SET first_name = :fname, last_name = :lname, eye_color = :eyecolor, gender = :gender, state = :state WHERE id = :id";
	$bindings = array(
		array(':fname',$dataObj->fname,'str'),
		array(':lname',$dataObj->lname,'str'),
		array(':eyecolor',$dataObj->color,'str'),
		array(':gender',$dataObj->gender,'str'),
		array(':state',$dataObj->state,'str'),
		array(':id',$dataObj->id,'int')		
	);
	$result = $pdo->otherBinded($sql, $bindings);
	if($result === 'error'){
		$response = (object) [
	    	'masterstatus' => 'error',
	    	'msg' => 'There was a problem updating the name',
		];
		echo json_encode($response);
	}
	else {
		$response = (object) [
	    	'masterstatus' => 'success',
	    	'msg' => 'Name has been updated',
	    	'specificaction' => 'displaymessage'
		];
		echo json_encode($response);
	}
}

/* THIS FUNCTION WILL DELETE THE NAME AND OTHE INFORMATION FOR THE ROW THAT WAS CLICKED */
function deleteName($dataObj){
	$pdo = new PdoMethods();
	$sql = "DELETE FROM short_names WHERE id = :id";
	$bindings = array(
		array(':id',$dataObj->id,'str')
	);
	$result = $pdo->otherBinded($sql, $bindings);
	if($result === 'error'){
		$response = (object) [
	    	'masterstatus' => 'error',
	    	'msg' => 'There was a problem deleting the name',
		];
		echo json_encode($response);
	}
	else {
		$response = (object) [
	    	'masterstatus' => 'success',
	    	'specificaction' => 'reloadpage',
		];
		echo json_encode($response);
	}

}


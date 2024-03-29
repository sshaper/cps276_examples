<?php
require 'Pdo_methods.php';

class Crud extends PdoMethods{

	public function init(){
	
	/* I WANTED TO USE THE SWITCH STATEMENT INSTEAD OF IF ELSE BUT IT ERROR ON THE OTHER POST ARRAY NAMES.  FOR EXAMPLE IF I CLICKED ADD NAME IT WOULD ALSO LOOK FOR $_POST['update'] AND $_POST['delete']

		if(count($_POST) > 0){
			switch($_POST){
				case $_POST['addName']: return $crud->addName(); break;
				case $_POST['update']: return $crud->updateNames($_POST); break;
				case $_POST['delete']: return $crud->deleteNames($_POST); break;
				default: return "";
			}
		}	*/		
		
		//THIS CHECKS TO SEE IF THE POST SUPER GLOBAL ARRAY HAS ANYTHING THEN IT CHECKS WHAT BUTTON WAS CLICKED AND RUNS THE REQUIRED METHOD.  IF NO BUTTON WAS CLICKED THEN IT RETURNS AN EMPTY STRING SO OUTPUT IS BLANK.
		if(count($_POST) > 0){

			if(isset($_POST['addName'])){
				return $this->addName();
			}

			else if(isset($_POST['update'])){
				return $this->updateNames($_POST);
			}
			else if(isset($_POST['delete'])){
				return $this->deleteNames($_POST);
			}
			else {
				return "";
			}
		}
	}

	
	//THIS HAS TO BE PUBLIC BECAUSE INDEX.PHP AND UPDATE_DELETE_NAMES.PHP BOTH CALL IT DIRECTLY
	public function getNames($type){
		
		/* CREATE AN INSTANCE OF THE PDOMETHODS CLASS*/
		$pdo = new PdoMethods();

		/* CREATE THE SQL */
		$sql = "SELECT * FROM short_names";

		//PROCESS THE SQL AND GET THE RESULTS
		$records = $pdo->selectNotBinded($sql);

		/* IF THERE WAS AN ERROR DISPLAY MESSAGE */
		if($records == 'error'){
			return 'There has been and error processing your request';
		}
		else {
			if(count($records) != 0){
				if($type == 'list'){return $this->createList($records);}
				if($type == 'input'){return $this->createInput($records);}	
			}
			else {
				return 'no names found';
			}
		}
	}


	/***** THE REST OF THESE METHODS CAN BE PRIVATE BECAUSE THEY ARE CALLED WITHIN THE CLASS. */


	private function addName(){
	
		$pdo = new PdoMethods();

		/* HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS */
		$sql = "INSERT INTO short_names (first_name, last_name, eye_color, state) VALUES (:fname, :lname, :eyecolor, :state)";

			 
	    /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS */
	    $bindings = [
			[':fname',$_POST['fname'],'str'],
			[':lname',$_POST['lname'],'str'],
			[':eyecolor',$_POST['color'],'str'],
			[':state',$_POST['state'],'str']
		];

		/* I AM CALLING THE OTHERBINDED METHOD FROM MY PDO CLASS */
		$result = $pdo->otherBinded($sql, $bindings);

		/* HERE I AM RETURNING EITHER AN ERROR STRING OR A SUCCESS STRING */
		if($result === 'error'){
			return 'There was an error adding the name';
		}
		else {
			return 'Name has been added';
		}
	}

	private function updateNames($post){
		$error = false;

		if(isset($post['inputDeleteChk'])){

			foreach($post['inputDeleteChk'] as $id){
				$pdo = new PdoMethods();

				/* HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS */
				$sql = "UPDATE short_names SET first_name = :fname, last_name = :lname, eye_color = :eyecolor, state = :state WHERE id = :id";

				//THE ^^ WAS USED TO MAKE EACH ITEM UNIQUE BY COMBINING FNAME WITH THE ID
				$bindings = [
					[':fname', $post["fname^^{$id}"], 'str'],
					[':lname', $post["lname^^{$id}"], 'str'],
					[':eyecolor', $post["color^^{$id}"], 'str'],
					[':state', $post["state^^{$id}"], 'str'],
					[':id', $id, 'str']
				];

				$result = $pdo->otherBinded($sql, $bindings);

				if($result === 'error'){
					$error = true;
					break;
				}
				
			}

			if($error){
				return "There was an error in updating a name or names";
			}
			else {
				return "All names updated";
			}
		}
		else {
			return "No names selected to update";
		}
	}

	private function deleteNames($post){
		$error = false;
		if(isset($post['inputDeleteChk'])){
			foreach($post['inputDeleteChk'] as $id){
				$pdo = new PdoMethods();

				$sql = "DELETE FROM short_names WHERE id=:id";
				
				$bindings = [
					[':id', $id, 'int'],
				];


				$result = $pdo->otherBinded($sql, $bindings);

				if($result === 'error'){
					$error = true;
					break;
				}
			}
			if($error){
				return "There was an error in deleting a name or names";
			}
			else {
				return "All names deleted";
			}

		}
		else {
			return "No names selected to delete";
		}
	}

	/*THIS FUNCTION TAKES THE DATA FROM THE DATABASE AND RETURN AN UNORDERED LIST OF THE DATA*/
	private function createList($records){
		$list = '<ol>';
		foreach ($records as $row){
			$list .= "<li>Name: {$row['first_name']} {$row['last_name']} - Eye Color: {$row['eye_color']} - State: {$row['state']}</li>";
		}
		$list .= '</ol>';
		return $list;
	}
	

	/*THIS FUNCTION TAKES THE DATA AND RETURNS THE DATA IN INPUT ELEMENTS SO IT CAN BE EDITED.  */
	private function createInput($records){
		$output = "<form method='post' action='update_delete_name.php'>";
		$output .= "<input class='btn btn-success' type='submit' name='update' value='Update'>";
		$output .= "<input class='btn btn-danger' type='submit' name='delete' value='Delete'>";
		$output .= "<table class='table table-bordered table-striped'><thead><tr>";
		$output .= "<th>First Name</th><th>Last Name</th><th>Eye Color</th><th>State</th><th>Update/Delete</th><tbody>";
		foreach ($records as $row){
			$output .= "<tr><td><input type='text' class='form-control' name='fname^^{$row['id']}' value='{$row['first_name']}'></td>";

			$output .= "<td><input type='text' class='form-control' name='lname^^{$row['id']}' value='{$row['last_name']}'></td>";

			$output .= "<td><input type='text' class='form-control' name='color^^{$row['id']}' value='{$row['eye_color']}'></td>";

			
			$output .= "<td><input type='text' class='form-control' name='state^^{$row['id']}' value='{$row['state']}'></td>";

			$output .= "<td><input type='checkbox' name='inputDeleteChk[]' value='{$row['id']}'></td></tr>";
		}
		
		$output .= "</tbody></table></form>";
		return $output;
	}
}
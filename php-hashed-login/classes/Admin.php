<?php
require_once 'classes/Pdo_methods.php';

class Admin extends PdoMethods {

	public function init($page) {
		if($page == "index"){
			return $this->login();
		}
		else if($page == "home"){
			//SECURITY RETURNS TRUE IF USER HAS ACCESS TO PAGE
			if($this->security()){
				return $this->displayUsernamePassword();
			}
			
		}
		else if($page == "addAdmin"){
			//SECURITY RETURNS TRUE IF USER HAS ACCESS TO PAGE
			if($this->security()){
				//IF THE ADDADMIN BUTTON IS CLICKED THEN RUN THE ADDADMIN METHOD
				if(isset($_POST['addAdmin'])){
					return $this->addAdmin();
				}
			}

		}
	}

	//BECAUSE THE HOME, ADDADMIN, AND LOGOUT PAGES ARE BY ACCESS ONLY WE HAVE TO RUN THE SECURITY SCRIPT FIRST.
	private function security(){
		session_start();
		if($_SESSION['access'] !== "accessGranted"){
		  header('location: index.php');
		}
		else {
			return true;
		}
		
	}
	
	private function login(){
	   
	    $pdo = new PdoMethods();
	    $sql = "SELECT username, password FROM admin WHERE username = :username";
		
		$bindings = [
			[':username', $_POST['username'], 'str']
		];
		
		$records = $pdo->selectBinded($sql, $bindings);

		/** IF THERE WAS AN RETURN ERROR STRING */
		if($records == 'error'){
			return "There was an error logging it";
		}
		
		else{
			if(count($records) != 0){
	            /** IF THE PASSWORD IS NOT VERIFIED USING PASSWORD_VERIFY THEN RETURN FAILED, OTHERWISE RETURN SUCCESS, IF NO RECORDS ARE FOUND RETURN NO RECORDS FOUND. */
	            if(password_verify($_POST['password'], $records[0]['password'])){
	                session_start();
	                $_SESSION['access'] = "accessGranted";
	                header("location: home.php");
	            }
	            else {
	                return "There was a problem logging in with those credentials";
	            }
			}
			else {
				return "There was a problem logging in with those credentials";
			}
		}
	}

	private function addAdmin(){
	    $pdo = new PdoMethods();

		if($_POST['username'] == "" || $_POST['password'] == ""){
			return "You must enter a username and password";
		}

	    $sql = "SELECT username FROM admin WHERE username = :username";
		
		$bindings =  [
			[':username', $_POST['username'], 'str']
		];
		
	    $records = $pdo->selectBinded($sql, $bindings);

		/** IF THERE WAS AN RETURN ERROR STRING */
		if($records == 'error'){
			return 'There was an error processing your request';
		}
		
		/** CHECK FOR A DUPLICATE USERNAME IF FOUND THEN RETURN DUPLICATE OTHERWISE ADD USERNAME AND PASSWORD TO DATABASE */
		else{
			if(count($records) != 0){
	            return "There is already someone with that username";
			}
			else {
				/** ENCRYPT THE PASSWORD USING PASSWORD_HASH */
				$password = password_hash($_POST['password'], PASSWORD_DEFAULT);


				$sql = "INSERT INTO admin (username, password) VALUES (:username, :password)";

				$bindings = [
					[':username', $_POST['username'], 'str'],
					[':password', $password, 'str']
				];
				
				$result = $pdo->otherBinded($sql, $bindings);
				if($result = 'noerror'){
					return 'Admin added';
				}
				else {
					return 'There was a problem adding this administrator';
				}
			}
		}
	}

	private function displayUsernamePassword(){
		$pdo = new PdoMethods();
		$sql = "SELECT username, password FROM admin";
		$records = $pdo->selectNotBinded($sql);
		$result = '';

		/* IF THERE WAS AN ERROR DISPLAY MESSAGE*/
		if($records == 'error'){
		    return 'There has been and error processing this request';
		}

		/** IF USERNAMES AND PASSWORDS ARE FOUND DISPLAY THEM OTHERWISE DISPLAY NO RECORDS FOUND MESSAGE */
		else{
		    if(count($records) != 0){
		        $result = "<ul>";
		        foreach($records as $row){
		            $result .= "<li>{$row['username']} -- {$row['password']}</li>";
		        }
		        $result .= "</ul>";

		        return $result;
		    }
		    else {
		        return "No records found";
		    }
		}
	}
}
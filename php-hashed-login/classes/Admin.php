<?php
require_once 'classes/Pdo_methods.php';

class Admin extends PdoMethods {

	public function login($post){
	   
	    $pdo = new PdoMethods();
	    $sql = "SELECT username, password FROM admin WHERE username = :username";
		$bindings = array(
			array(':username', $post['username'], 'str')
		);

	    $records = $pdo->selectBinded($sql, $bindings);

		/** IF THERE WAS AN RETURN ERROR STRING */
		if($records == 'error'){
			return "There was an error logging it";
		}
		
		/** */
		else{
			if(count($records) != 0){
	            /** IF THE PASSWORD IS NOT VERIFIED USING PASSWORD_VERIFY THEN RETURN FAILED, OTHERWISE RETURN SUCCESS, IF NO RECORDS ARE FOUND RETURN NO RECORDS FOUND. */
	            if(password_verify($post['password'], $records[0]['password'])){
	                session_start();
	                $_SESSION['access'] = "accessGranted";
	                return "success";
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

	public function addAdmin($post){
	    $pdo = new PdoMethods();
	    $sql = "SELECT username FROM admin WHERE username = :username";
		$bindings = array(
			array(':username', $post['username'], 'str')
		);

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
				$password = password_hash($post['password'], PASSWORD_DEFAULT);


				$sql = "INSERT INTO admin (username, password) VALUES (:username, :password)";
				$bindings = array(
					array(':username',$post['username'],'str'),
					array(':password',$password,'str')
				);
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

	public function displayUsernamePassword(){
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
		        $result = '<ul>';
		        foreach($records as $row){
		            $result .= "<li>" .$row['username'] . " -- " . $row['password'] . "</li>";
		        }
		        $result .= "</ul>";

		        return $result;
		    }
		    else {
		        return 'No records found';
		    }
		}
	}
}
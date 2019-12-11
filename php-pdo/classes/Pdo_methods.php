<?php
/* THIS CLASS EXTENDS THE DATABASE CONNECTION CLASS AND BUILD ON IT WITH PDO COMMANDS */
/* THE DATABASE CONNECTION CLASS IS STORED OUTSIDE OF THE EXAMPLE FILES SO YOU CANNOT SEE THE CONNECTION INFORMATION. ALSO IT IS MORE SECURE*/
require_once "Db_conn.php";
date_default_timezone_set('America/Detroit');
class PdoMethods extends DatabaseConn {

	
	private $sth;
	private $conn;
	private $db;
	private $error;


	/* THIS METHOD IS FOR ALL SELECT STATEMENTS THAT NEED TO HAVE A BINDING TO PROETECT THE DATA.  THE SCRIPT TAKES THE SQL STATEMENTS AN THE BINDING ARRAY AS ITS PARAMETERS AND PERFORMS THE QUERY.  IT WILL RUN THE QUERY AND RETURN THE RESULT AS AN ASSOCIATIVE ARRAY OR AN ERROR STRING.*/
	public function selectBinded($sql, $bindings){
		$this->error = false;
		$this->db_connection();
		$this->sth = $this->conn->prepare($sql);
		$this->createBinding($bindings);
		$this->executeStatement();
		$this->conn = null;
		if(!$this->error){
			return $this->sth->fetchAll(PDO::FETCH_ASSOC);
		}
		else{
			return 'error';
		}
	}

	/* THIS FUNCTION DOES THE SAME AS THE ABOVE BUT DOES NOT NEED ANY BINDED PARAMETERS ARE NO PARAMTERS ARE PASSED */
	public function selectNotBinded($sql){
		$this->error = false;
		try{
			$this->db_connection();
			$this->sth = $this->conn->prepare($sql);
			$this->executeStatement();
		}
		catch (PDOException $Exception){
			return 'error';
		}
		
		$this->conn = null;
		if(!$this->error){
			return $this->sth->fetchAll(PDO::FETCH_ASSOC);
		}
		else{
			return 'error';
		}
	}

	/* BECAUSE ONLY SELECT QUERIES RETURN A VALUE THE DOES ALL THE REST CREATE, UPDATE, DELETE */
	public function otherBinded($sql, $bindings){
		$this->error = false;
		$this->db_connection();
		$this->sth = $this->conn->prepare($sql);
		$this->createBinding($bindings);
		$this->executeStatement();
		$this->conn = null;
		if(!$this->error){
			return 'noerror';
		}
		else{
			return 'error';
		}
	}

	/* CREATES A CONNECTION TO THE DATABASE */
	private function db_connection(){
		$this->db = new DatabaseConn();
		$this->conn = $this->db->dbOpen();
	}

	/* CREATES THE BINDINGS (I ONLY HAVE TWO HERE BUT I COULD CREATE OTHERS. */
	private function createBinding($bindings){
		foreach ($bindings as $value) {
			switch($value[2]){
				case 'int' : $this->sth->bindParam($value[0],$value[1], PDO::PARAM_INT);
				case 'str' : $this->sth->bindParam($value[0],$value[1], PDO::PARAM_STR);
			}	
			
		}
	}


	/* THIS METHOD EXECUTES THE STATEMENT AND IF THAT FAILS IT WRITES THE ERROR THE AN ERROR LOG. */
	private function executeStatement(){
		try{
			$this->sth->execute();
		}
		catch (PDOException $Exception){
			$error = date('F-j-Y \a\t h:i:s')." - ERROR! ".$Exception->getMessage()."\n";
			file_put_contents('../logs/pdo_errors.log', $error, FILE_APPEND);
			$this->error = true;
		}
	}
}

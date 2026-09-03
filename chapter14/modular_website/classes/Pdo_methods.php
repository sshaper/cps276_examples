<?php
/**
 * Pdo_methods.php — Chapter 9 PDO helper, reused in Chapter 14
 *
 * This example uses:
 *   otherBinded()      — INSERT (add), UPDATE (update), DELETE (delete)
 *   selectNotBinded()  — SELECT all rows (listContacts) and the newest row after insert
 *
 * Bindings look like [ ':email', $value, 'str' ] or [ ':id', $id, 'int' ].
 * User text is never concatenated into the SQL string.
 *
 * SELECT methods return an array of rows, or the string "error".
 * otherBinded returns "noerror" or "error". It does not return the new id.
 *
 * If a query fails, this class may echo the PDO message, which can break JSON.
 * Check the Network tab if Fetch cannot parse the response.
 */
require_once "Db_conn.php";
class PdoMethods extends DatabaseConn {

	
	private $sth;
	private $conn;
	private $db;
	private $error;


	/* SELECT with bound values (WHERE email = :email, WHERE id = :id). */
	public function selectBinded($sql, $bindings){
		$this->error = false;

		try{
			$this->db_connection();
			$this->sth = $this->conn->prepare($sql);
			$this->createBinding($bindings);
			$this->sth->execute();
		}
		catch(PDOException $e){
			
			echo $e->getMessage(); // Remove in production; it can break Fetch JSON.
			return 'error';
			
		}
		
		$this->conn = null;
		
		return $this->sth->fetchAll(PDO::FETCH_ASSOC);
			
	}

	/* SELECT with no user values in the SQL (SELECT * FROM contactMod). */
	public function selectNotBinded($sql){
			$this->error = false;
			
			try{
				$this->db_connection();
				$this->sth = $this->conn->prepare($sql);
				$this->sth->execute();
			}
			catch (PDOException $e){
				echo $e->getMessage();
				return 'error';
			}
			
			$this->conn = null;
			
			return $this->sth->fetchAll(PDO::FETCH_ASSOC);

		}

	/* INSERT, UPDATE, or DELETE with bound values. Returns "noerror" or "error". */
	public function otherBinded($sql, $bindings){
		$this->error = false;
		
		try{
			$this->db_connection();
			$this->sth = $this->conn->prepare($sql);
			$this->createBinding($bindings);
			$this->sth->execute();
		}
		catch(PDOException $e) {
			echo $e->getMessage();
			return 'error';
		}

		$this->conn = null;

		return 'noerror';
	}

	/* INSERT / UPDATE / DELETE with no bound values. Rarely used in this example. */
	public function otherNotBinded($sql){
		$this->error = false;
			
			try{
				$this->db_connection();
				$this->sth = $this->conn->prepare($sql);
				$this->sth->execute();
			}
			catch (PDOException $e){
				echo $e->getMessage();
				return 'error';
			}
			
			$this->conn = null;
			
			return 'noerror';

	}

	private function db_connection(){
		$this->db = new DatabaseConn();
		$this->conn = $this->db->dbOpen();
	}

	/* Each binding is [ placeholder, value, 'str' or 'int' ]. */
	private function createBinding($bindings){
		foreach($bindings as $value){
			switch($value[2]){
				case "str" : $this->sth->bindParam($value[0],$value[1], PDO::PARAM_STR);
				case "int" : $this->sth->bindParam($value[0],$value[1], PDO::PARAM_INT);
			}
		}
	}
}

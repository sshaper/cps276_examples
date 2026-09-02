<?php
require_once __DIR__ . "/Db_conn.php";
class PdoMethods extends DatabaseConn {

	private $sth;
	private $conn;
	private $db;
	private $error;

	public function selectBinded($sql, $bindings){
		$this->error = false;

		try{
			$this->db_connection();
			$this->sth = $this->conn->prepare($sql);
			$this->createBinding($bindings);
			$this->sth->execute();
		}
		catch(PDOException $e){
			return 'error';
		}

		$this->conn = null;
		return $this->sth->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectNotBinded($sql){
			$this->error = false;

			try{
				$this->db_connection();
				$this->sth = $this->conn->prepare($sql);
				$this->sth->execute();
			}
			catch (PDOException $e){
				return 'error';
			}

			$this->conn = null;
			return $this->sth->fetchAll(PDO::FETCH_ASSOC);
		}

	public function otherBinded($sql, $bindings){
		$this->error = false;

		try{
			$this->db_connection();
			$this->sth = $this->conn->prepare($sql);
			$this->createBinding($bindings);
			$this->sth->execute();
		}
		catch(PDOException $e) {
			return 'error';
		}

		$this->conn = null;
		return 'noerror';
	}

	public function otherNotBinded($sql){
		$this->error = false;

			try{
				$this->db_connection();
				$this->sth = $this->conn->prepare($sql);
				$this->sth->execute();
			}
			catch (PDOException $e){
				return 'error';
			}

			$this->conn = null;
			return 'noerror';
	}

	private function db_connection(){
		$this->db = new DatabaseConn();
		$this->conn = $this->db->dbOpen();
	}

	private function createBinding($bindings){
		foreach($bindings as $value){
			switch($value[2]){
				case "str":
					$this->sth->bindParam($value[0],$value[1], PDO::PARAM_STR);
					break;
				case "int":
					$this->sth->bindParam($value[0],$value[1], PDO::PARAM_INT);
					break;
			}
		}
	}
}

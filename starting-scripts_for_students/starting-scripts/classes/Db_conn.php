<?php

class DatabaseConn {	

  private $conn;
  /* THIS CLASS CONNECTS TO THE DATABASE ONLY AND SETS UP THE ATTRIBUTE PARAMETERS */
  public function dbOpen(){

    try {

      $dbHost = 'localhost';
      $dbName = 'ajax_assignment';
      $dbUsr = 'root';
      $dbPass = 'password';

      $this->conn = new PDO('mysql:host=' . $dbHost . ';dbname=' . $dbName, $dbUsr, $dbPass);
      $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); /*THIS STOPS PDO FROM ADDING SINGLE QUOTES AROUND INTEGER VALUES.*/
      $this->conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);/* FORCES QUERIES TO BE BUFFERED IN MYSQL */
      $this->conn->setAttribute(PDO::ATTR_AUTOCOMMIT, true);
      $this->conn->setAttribute(PDO::MYSQL_ATTR_LOCAL_INFILE, true);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $this->conn;

    }
      
    catch(PDOException $e) { 

      echo $e->getMessage(); 

    }

  }
}
<?php

class DatabaseConn {	

  private $conn;
  /* THIS CLASS CONNECTS TO THE DATABASE ONLY AND SETS UP THE ATTRIBUTE PARAMETERS */
  public function dbOpen(){

    try {

      $dbHost = 'localhost';
      $dbName = 'modWebsite';
      $dbUsr = 'root';
      $dbPass = 'password';

      $this->conn = new PDO('mysql:host=' . $dbHost . ';dbname=' . $dbName, $dbUsr, $dbPass);

      
      $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); /*THIS STOPS PDO FROM ADDING SINGLE QUOTES AROUND INTEGER VALUES.*/
      $this->conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);/* FORCES QUERIES TO BE BUFFERED IN MYSQL */
      $this->conn->setAttribute(PDO::ATTR_AUTOCOMMIT, true);/* THIS ALLOWS TO REVERT TO ITS PREVIOUS STATE WHEN A TRANSACTION IS COMMITTED OR ROLLED BACK*/
      $this->conn->setAttribute(PDO::MYSQL_ATTR_LOCAL_INFILE, true);/*THE LOAD DATA INFILE STATEMENT READS ROWS FROM A TEXT FILE INTO A TABLE AT A VERY HIGH SPEED.  MORE INFO AT https://tecfa.unige.ch/guides/mysql/man/manuel_LOAD_DATA.html*/
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);/* ERROR REPORTING AND THROWING OF ERRORS*/

      return $this->conn;

    }
      
    catch(PDOException $e) { 

      echo $e->getMessage(); 

    }

  }
}
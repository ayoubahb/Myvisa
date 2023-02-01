<?php
class Database {
  private $host = 'localhost';
  private $db_name = 'myvisa';
  private $username = 'root';
  private $password = '';
  private $conn;

  //DB connect

  public function connect(){
    $this->conn = null;
    try {
      $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name ,$this->username,$this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo 'Connetion Error' .$e->getMessage();
    }
    return $this->conn;
  }
}
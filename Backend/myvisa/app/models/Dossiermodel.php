<?php

class Dossiermodel {
  // DB stuff
  private $conn;
  private $table = 'dossier';

  // dossier Properties
  public $id;
  public $first_name;
  public $last_name;
  public $birthday;
  public $nationalite;
  public $situation;
  public $adresse;
  public $type_visa;
  public $date_depart;
  public $date_arriver;
  public $num_document;
  public $type_document;
  public $time;
  public $date;
  public $token;

  // Constructor with DB
  public function __construct() {
    $database = new Database();
    $this->conn = $database->connect();
  }

  // Get all dossier
  public function read() {
    // Create query
    $query = 'SELECT * FROM ' . $this->table . ';';
    
    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }

  //Get single dossier
  public function read_single(){
    // Create query
    $query = 'SELECT * FROM ' . $this->table . ' WHERE token = ? LIMIT 0,1';
    // Prepare statement
    $stmt = $this->conn->prepare($query);

    //Bind Id

    $stmt->bindParam(1,$this->token);

    // Execute query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $this->id            = $row['id'];
    $this->first_name    = $row['first_name'];
    $this->last_name     = $row['last_name'];
    $this->birthday      = $row['birthday'];
    $this->nationalite   = $row['nationalite'];
    $this->situation     = $row['situation'];
    $this->adresse       = $row['adresse'];
    $this->type_visa     = $row['type_visa'];
    $this->date_depart   = $row['date_depart'];
    $this->date_arriver  = $row['date_arriver'];
    $this->num_document  = $row['num_document'];
    $this->type_document = $row['type_document'];
    $this->token         = $row['token'];
    $this->time         = $row['time'];
    $this->date         = $row['date'];
  }
  //create a dossier
  public function create(){
    //Create query
    $query = 'INSERT INTO '. $this->table . ' (first_name, last_name, birthday, nationalite, situation, adresse, type_visa, date_depart, date_arriver, num_document, type_document, time, date, token) VALUES (:first_name,:last_name,:birthday,:nationalite,:situation,:adresse,:type_visa,:date_depart,:date_arriver,:num_document,:type_document,:time,:date,:token);';
    
    // Prepare statement
    $stmt = $this->conn->prepare($query);
    
    //Bind params

    $stmt->bindParam(':first_name',$this->first_name);
    $stmt->bindParam(':last_name',$this->last_name);
    $stmt->bindParam(':birthday',$this->birthday);
    $stmt->bindParam(':nationalite',$this->nationalite);
    $stmt->bindParam(':situation',$this->situation);
    $stmt->bindParam(':adresse',$this->adresse);
    $stmt->bindParam(':type_visa',$this->type_visa);
    $stmt->bindParam(':date_depart',$this->date_depart);
    $stmt->bindParam(':date_arriver',$this->date_arriver);
    $stmt->bindParam(':num_document',$this->num_document);
    $stmt->bindParam(':type_document',$this->type_document);
    $stmt->bindParam(':time',$this->time);
    $stmt->bindParam(':date',$this->date);
    $stmt->bindParam(':token',$this->token);

    //Execute query

    if($stmt->execute()){
      return true;
    }

    // print error is somting goes wrong
    printf("Error : %s.\n",$stmt->error);

    return false;
  }

  //Update dossier
  public function update(){
    //Create query
    $query = 'UPDATE dossier 
              SET 
              first_name= :first_name ,
              last_name= :last_name,
              birthday= :birthday,
              nationalite= :nationalite,
              situation= :situation,
              adresse= :adresse,
              type_visa= :type_visa,
              date_depart= :date_depart,
              date_arriver= :date_arriver,
              num_document= :num_document,
              type_document= :type_document,
              time = :time,
              date= :date WHERE token = :token';
    
    // Prepare statement
    $stmt = $this->conn->prepare($query);
    
    //Bind params

    $stmt->bindParam(':token',$this->token);
    $stmt->bindParam(':first_name',$this->first_name);
    $stmt->bindParam(':last_name',$this->last_name);
    $stmt->bindParam(':birthday',$this->birthday);
    $stmt->bindParam(':nationalite',$this->nationalite);
    $stmt->bindParam(':situation',$this->situation);
    $stmt->bindParam(':adresse',$this->adresse);
    $stmt->bindParam(':type_visa',$this->type_visa);
    $stmt->bindParam(':date_depart',$this->date_depart);
    $stmt->bindParam(':date_arriver',$this->date_arriver);
    $stmt->bindParam(':num_document',$this->num_document);
    $stmt->bindParam(':type_document',$this->type_document);
    $stmt->bindParam(':time',$this->time);
    $stmt->bindParam(':date',$this->date);

    //Execute query

    if($stmt->execute()){
      return true;
    }

    // print error is somting goes wrong
    printf("Error : %s.\n",$stmt->error);

    return false;
  }

  //delete dossier
  public function delete(){
    //create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE token = :token';

    // Prepare statement
    $stmt = $this->conn->prepare($query);
    
    //Clean data
    $this->token = htmlspecialchars(strip_tags($this->token));

    //Bind params
    $stmt->bindParam(':token',$this->token);

    //Execute query

    if($stmt->execute()){
      return true;
    }

    // print error is somting goes wrong
    printf("Error : %s.\n",$stmt->error);

    return false;
  }

  public function tokenExist($token) {
    $stmt = $this->conn->prepare("SELECT token FROM ". $this->table ." WHERE token = :token");
    $stmt->execute(array(':token' => $token));
    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
  }

  public function timeDate(){
    // Create query
    $query = 'SELECT time, date FROM ' . $this->table . ';';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }
}


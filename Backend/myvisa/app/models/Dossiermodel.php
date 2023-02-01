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
    $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';
    // Prepare statement
    $stmt = $this->conn->prepare($query);

    //Bind Id

    $stmt->bindParam(1,$this->id);

    // Execute query
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
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
  }
  //create a dossier
  public function create(){
    //Create query
    $query = 'INSERT INTO '. $this->table .' (first_name, last_name, birthday, nationalite, situation, adresse, type_visa, date_depart, date_arriver, num_document, type_document) VALUES (:first_name,:last_name,:birthday,:nationalite,:situation,:adresse,:type_visa,:date_depart,:date_arriver,:num_document,:type_document);';
    
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
              type_document= :type_document WHERE id = :id';
    
    // Prepare statement
    $stmt = $this->conn->prepare($query);
    
    //Bind params

    $stmt->bindParam(':id',$this->id);
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
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);
    
    //Clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    //Bind params
    $stmt->bindParam(':id',$this->id);

    //Execute query

    if($stmt->execute()){
      return true;
    }

    // print error is somting goes wrong
    printf("Error : %s.\n",$stmt->error);

    return false;
  }
}


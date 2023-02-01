<?php
  class Dossier extends Controller{
    public function __construct(){
      $this->dossierModel = $this->model('Dossiermodel');
    }

    public function index(){
      header('Access-Control-Allow-Origin: *');//public access
      header('Content-Type: application/json');

      $result = $this->dossierModel->read();

      //Get row count
      $num = $result->rowCount();

      //check if any dossiers

      if($num > 0){
        //dossier array
        $dossier_arr = array();
        $dossier_arr['data']= array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
          extract($row);
          $dossier_item = array(
            'id'             => $id,
            'first_name'     => $first_name,
            'last_name'      => $last_name,
            'birthday'       => $birthday,
            'nationalite'    => $nationalite,
            'situation'      => $situation,
            'adresse'        => $adresse,
            'type_visa'      => $type_visa,
            'date_depart'    => $date_depart,
            'date_arriver'   => $date_arriver,
            'num_document'   => $num_document,
            'type_document'  => $type_document,
          );

          //Push to data
          array_push($dossier_arr['data'],$dossier_item);
        }

          //turn to json & output

          echo json_encode($dossier_arr);
      }else{
        //No dossier
        echo json_encode(
          array('message'=>'No dossiers found')
        );
      }
    }

    public function readsingle($id){
      header('Access-Control-Allow-Origin: *');//public access
      header('Content-Type: application/json');

      $this->dossierModel->id = $id;

      $this->dossierModel->read_single();

      //Create array

      $dossier_arr = array(
        'id'             => $id,
        'first_name'     => $this->dossierModel->first_name,
        'last_name'      => $this->dossierModel->last_name,
        'birthday'       => $this->dossierModel->birthday,
        'nationalite'    => $this->dossierModel->nationalite,
        'situation'      => $this->dossierModel->situation,
        'adresse'        => $this->dossierModel->adresse,
        'type_visa'      => $this->dossierModel->type_visa,
        'date_depart'    => $this->dossierModel->date_depart,
        'date_arriver'   => $this->dossierModel->date_arriver,
        'num_document'   => $this->dossierModel->num_document,
        'type_document'  => $this->dossierModel->type_document,
      );

      
      //Make JSON
      print_r(json_encode($dossier_arr));

    }

    public function create(){
      //Headers
      header('Access-Control-Allow-Origin: *');//public access
      header('Content-Type: application/json');
      header('Access-Control-Allow-Methods: POST');
      header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

      $data = json_decode(file_get_contents("php://input"));


      $this->dossierModel->first_name    = $data->first_name;
      $this->dossierModel->last_name     = $data->last_name;
      $this->dossierModel->birthday      = $data->birthday;
      $this->dossierModel->nationalite   = $data->nationalite;
      $this->dossierModel->situation     = $data->situation;
      $this->dossierModel->adresse       = $data->adresse;
      $this->dossierModel->type_visa     = $data->type_visa;
      $this->dossierModel->date_depart   = $data->date_depart;
      $this->dossierModel->date_arriver  = $data->date_arriver;
      $this->dossierModel->num_document  = $data->num_document;
      $this->dossierModel->type_document = $data->type_document;

      if ($this->dossierModel->create()) {
        echo json_encode(array('message' => 'Dossier created'));
      }else{
        echo json_encode(array('message' => 'Dossier Not created'));
      }
    }

    public function update(){
      //Headers
      header('Access-Control-Allow-Origin: *');//public access
      header('Content-Type: application/json');
      header('Access-Control-Allow-Methods: PUT');
      header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
      $data = json_decode(file_get_contents("php://input"));

      //Set ID tp update
      $this->dossierModel->id = $data->id;


      $this->dossierModel->first_name    = $data->first_name;
      $this->dossierModel->last_name     = $data->last_name;
      $this->dossierModel->birthday      = $data->birthday;
      $this->dossierModel->nationalite   = $data->nationalite;
      $this->dossierModel->situation     = $data->situation;
      $this->dossierModel->adresse       = $data->adresse;
      $this->dossierModel->type_visa     = $data->type_visa;
      $this->dossierModel->date_depart   = $data->date_depart;
      $this->dossierModel->date_arriver  = $data->date_arriver;
      $this->dossierModel->num_document  = $data->num_document;
      $this->dossierModel->type_document = $data->type_document;

      //Update dossier

      if ($this->dossierModel->update()) {
        echo json_encode(array('message' => 'Dossier Updated'));
      }else{
        echo json_encode(array('message' => 'Dossier Not Updated'));
      }
    }

    public function delete(){
      //Headers
      header('Access-Control-Allow-Origin: *');//public access
      header('Content-Type: application/json');
      header('Access-Control-Allow-Methods: DELETE');
      header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

      $data = json_decode(file_get_contents("php://input"));

      //Set ID tp update
      $this->dossierModel->id = $data->id;


      //delete dossier

      if ($this->dossierModel->delete()) {
        echo json_encode(array('message' => 'Dossier deleted'));
      }else{
        echo json_encode(array('message' => 'Dossier Not deleted'));
      }
    }
  }
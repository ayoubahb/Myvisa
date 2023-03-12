<?php

ini_set('display_errors', 1);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET , POST , PUT , DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-Width');

//traitement data
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
  if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
    header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
}
if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
  return true;
}


class Dossier extends Controller
{
  public $dossierModel;

  public function __construct()
  {
    $this->dossierModel = $this->model('Dossiermodel');
  }

  public function index()
  {
    header('Access-Control-Allow-Origin: *'); //public access
    header('Content-Type: application/json');

    $result = $this->dossierModel->read();

    //Get row count
    $num = $result->rowCount();

    //check if any dossiers

    if ($num > 0) {
      //dossier array
      $dossier_arr = array();
      $dossier_arr['data'] = array();

      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
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
          'token'          => $token,
        );

        //Push to data
        array_push($dossier_arr['data'], $dossier_item);
      }

      //turn to json & output

      echo json_encode($dossier_arr);
    } else {
      //No dossier
      echo json_encode(
        array('message' => 'No dossiers found')
      );
    }
  }

  public function readsingle($token)
  {
    header('Access-Control-Allow-Origin: *'); //public access
    header('Content-Type: application/json');

    $this->dossierModel->token = $token;

    if (!$this->dossierModel->tokenExist($token)) {
      echo json_encode(array('message' => 'Dossier Not Found'));
      return;
    }
    $this->dossierModel->read_single();

    //Create array

    $dossier_arr = array(
      'id'             => $this->dossierModel->id,
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
      'token'          => $this->dossierModel->token,
      'time'          => $this->dossierModel->time,
      'date'          => $this->dossierModel->date,
    );

    //Make JSON
    print_r(json_encode($dossier_arr));
  }

  public function create()
  {
    $data = json_decode(file_get_contents("php://input"));

    $validate = $this->validateInputs($data);

    if (empty($validate)) {

      $tokenExists = true;
      while ($tokenExists) {
        $code = sprintf(
          '%04x%04x%04x',
          mt_rand(0, 0xffff),
          mt_rand(0, 0xffff),
          mt_rand(0, 0xffff)
        );
        $tokenExists = $this->dossierModel->tokenExist($code);
      }


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
      $this->dossierModel->type_document = $data->type_document;
      $this->dossierModel->type_document = $data->type_document;
      $this->dossierModel->time          = $data->time;
      $this->dossierModel->date          = $data->date;
      $this->dossierModel->token         = $code;

      if ($this->dossierModel->create()) {
        echo json_encode(array('message' => 'Dossier created', 'code' => $code));
      } else {
        echo json_encode(array('message' => 'Dossier Not created'));
      }
    } else {
      echo json_encode(array("message" => "Inputs Not Valide", "Validation" => $validate));
    }
  }

  public function update()
  {
    //Headers
    header('Access-Control-Allow-Origin: *'); //public access
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
    $data = json_decode(file_get_contents("php://input"));

    //Set ID tp update
    $this->dossierModel->token = $data->token;


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
    $this->dossierModel->time          = $data->time;
    $this->dossierModel->date          = $data->date;

    //Update dossier

    if ($this->dossierModel->update()) {
      echo json_encode(array('message' => 'Dossier Updated'));
    } else {
      echo json_encode(array('message' => 'Dossier Not Updated'));
    }
  }

  public function delete($token)
  {
    //Headers
    // header('Access-Control-Allow-Origin: *'); //public access
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    // header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    // $data = json_decode(file_get_contents("php://input"));
    // print_r($data->token);

    //Set ID tp update
    $this->dossierModel->token = $token;

    //delete dossier

    if ($this->dossierModel->delete()) {
      echo json_encode(array('message' => 'Dossier deleted'));
    } else {
      echo json_encode(array('message' => 'Dossier Not deleted'));
    }
  }

  public function getTimeDate()
  {
    $data = $this->dossierModel->timeDate()->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
  }

  public function tokenValid()
  {
    $data = json_decode(file_get_contents("php://input"));
    echo json_encode($this->dossierModel->tokenExist($data->token));
  }

  public function validateInputs($data)
  {
    $errors = array();
    foreach ($data as $name => $value) {
      // Check if the input is empty
      if (empty(trim($value))) {
        $errors[$name] = "Cannot be empty";
      } else if (!preg_match('/^[a-zA-Z0-9\-\:]+$/', $value)) {
        $errors[$name] = "Cannot contain special characters";
      }
    }

    return $errors;
  }
}

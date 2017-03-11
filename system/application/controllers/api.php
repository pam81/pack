<?php defined('BASEPATH') OR exit('No direct script access allowed');  
require(APPPATH.'libraries/REST_Controller.php');
define('CONSUMER_SECRET', 'ee70f0aae541f1d904ba093adf5220d6');
define('CONSUMER_KEY', 'F687t3paK');

class Api extends REST_Controller {

   function __construct()
   {
    parent::__construct();
    $this->load->model('cliente_model');
    $this->load->model('viaje_model');
    $this->load->library("JWT");
   
   }

   private function generateToken($user_id){
      return $this->jwt->encode(array(
        'consumerKey'=>CONSUMER_KEY,
        'userId'=>$user_id,
        'issuedAt'=>date(DATE_ISO8601, strtotime("now"))
      ), CONSUMER_SECRET);
  }

  private function checkToken(){
   $headers = apache_request_headers();

    try{
      $token=$headers["Authorization"];
      $decode = $this->jwt->decode($token,CONSUMER_SECRET);
      if ( !($decode->consumerKey == CONSUMER_KEY)){
        $error['code']="ERROR";
        $error['message']="Token inválido.";
        $this->response($error, 400);
      }else{
        return $decode->userId;
      }
    }catch(Exception $e){
      
      $error['code']="ERROR";
      $error['message']=$e->getMessage();
      $this->response($error, 400);
    }
    
  }

  function login_post(){
      
    $error=array();
    if (!$this->post("email")){
      $error['code']="ERROR";
      $error['message']="Ingrese un email.";
      $this->response($error, 400);
    }
    if (!$this->post("password")){
      $error['code']="ERROR";
      $error['message']="Ingrese la password asociada a la cuenta.";
      $this->response($error, 400);
    }
    


    $user = $this->cliente_model->getClientByEmail(strtolower($this->post("email")));

    if (!$user){
      $error['code']="ERROR";
      $error['message']="Usuario no existe.";
      $this->response($error, 404);
    }else{
          if ($this->cliente_model->checkPassword($user->password,$this->post("password"))){
            $response=array("user"=>$user,"token"=>$this->generateToken($user->id));
            $this->response($response,200);
          }else{
            $error['code']="ERROR";
            $error['message']="Email/Password no válidos.";
            $this->response($error, 400);
          }
    }
  }
 /* Solo traigo los viajes abiertos */
  function viaje_get(){
    $user_id = $this->checkToken();
    $viajes = $this->viaje_model->viajeAbiertos($user_id);
    $this->response($viajes,200);
  }


}
<?php

class Calle extends Controller {

   function __construct()
   {
    parent::Controller();
    $this->lang->load("fletpack_site");
    $this->load->library('form_validation');
     $this->load->helper(array('form'));
    $this->load->model("Current_User");
    $this->load->model("User_model");
    $this->User_model->verified_login();
   
   }
   
   public function index()
   {
   
    $data["content"]="inicio";
    $this->load->view("index",$data);
   
   }
   
   public function getCalles()
   {
     $localidad=$this->uri->segment(3);
     $name=$this->uri->segment(4);
     
      $sql="select id,name from calles where name like \"%$name%\" and ciudadid=\"$localidad\"";
      $query=$this->db->query($sql);
      foreach($query->result() as $calle)
      {
          $resultado[$calle->id]=$calle->name;
      }
      
      echo json_encode($resultado);
      
   } 
  
  
}

?>

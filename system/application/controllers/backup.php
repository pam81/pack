<?php

class Backup extends Controller {

   function __construct()
   {
    parent::Controller();
  $this->lang->load("fletpack_site");
    $this->load->library('form_validation');
    $this->load->helper(array('form'));
    $this->load->library('pagination');
    $this->load->model("Current_User");
    $this->load->model("User_model");
    $this->load->model("Flete_model","flete");
    $this->load->config("site");
    $this->User_model->verified_login();
   
   
   
   }
   
   function index()
   {
      if ( $this->Current_User->isHabilitado("BACKUP") )
    {
     $filename="fletpack".date("Ymd").".sql";
     $user=$this->db->username;
     $pass=$this->db->password;
     $command = "mysqldump -u$user -p$pass fletpack > backup/".$filename;
    
     system($command);
     
     $name="backup/$filename";
     header("Content-disposition: attachment; filename=$name");
     header("Content-type: application/octet-stream");
     readfile($name);
     }
     else
         redirect("inicio/denied");
     
   }



 }
 ?>

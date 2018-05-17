<?php

class Cliente_model extends Model {

    function Cliente_model()
    {
     parent::Model();
  
     
    }    
    
   public function getClientByEmail($email)
   {
      $query=$this->db->get_where("clientes",array("email"=>$this->db->escape_str($email)));
      $cliente=$query->result();
      if (isset($cliente[0])){
       return $cliente[0];  
      }else{
        return null;
      }
   }

   public function checkPassword($clientPassword, $password){
      if ($clientPassword == md5($password)){
        return true;
      }else{
        return false;
      }
   }
   
 }
<?php

class User_model extends Model {

    function User_model()
    {
     parent::Model();
  
     $this->config->load('site');
      $this->lang->load("fletpack_site");
    }    
    
   public static function verified_login()
   {
      $CI =& get_instance();
      $token=$CI->input->cookie("flet-token");
      $user=Current_User::user(); // verificar que este la cookie y sea valida en base al permiso
      if ($user){
        $valid_token = Current_User::checkToken($token, $user);
        if (!$valid_token){
          $CI->session->sess_destroy();
          redirect('home');
        }
      }else{
        redirect('home');
      }
   }
   
   
    
   public function transform_password($pass)
   {
       return md5($pass);
       
   } 
   
   public function rememberByUser($username)
   { 
      $query=$this->db->get_where("admusers",array("username"=>$this->db->escape_str($username)));
      $usuario=$query->result();
      if (isset($usuario[0]))
      {
          return $this->forgotMail($usuario[0]->username,$usuario[0]->password); 
      }
            
       return false;     
      
   }
   
   public function rememberByEmail($email)
   {  
      $query=$this->db->get_where("admusers",array("email"=>$this->db->escape_str($email)));
      $usuario=$query->result();
      
      if (isset($usuario[0]))
      {
              return $this->forgotMail($usuario[0]->username,$usuario[0]->password,$usuario[0]->email);
      }
      return false;
   
   }
   
   public function existEmail($email)
   {
      $query=$this->db->get_where("admusers",array("email"=>$this->db->escape_str($email)));
      $usuario=$query->result();
     
       if (isset($usuario[0]))
        return true;
      else
        return false;  
   }
   
   
   
   
   
   public function existUsername($username)
   {
    $query=$this->db->get_where("admusers",array("username"=>$this->db->escape_str($username)));
      $usuario=$query->result();
     
      if (isset($usuario[0]))
        return true;
      else
        return false;  
       
   }
   public function forgotMail($username,$password,$email)
   {
          $config['mailtype']=$this->config->item("mail_type");
          $config['smtp_host']=$this->config->item("smtp_host");
          $config['smtp_user']=$this->config->item("smtp_user");
          $config['smtp_pass']=$this->config->item("smtp_pass");
          $config['smtp_port']=$this->config->item("smtp_port");
          $config['protocol']=$this->config->item("protocol");
          $config['validate'] = $this->config->item("validate");
        
           $this->load->library('email',$config);
           $this->email->set_newline("\r\n");  
          $this->email->from($this->config->item("email_send"), $this->config->item("name_from"));
          $this->email->to($email);
          $this->email->subject($this->lang->line("subjectForgotMail"));
          $search=array();
          $search[]="[username]";
          $search[]="[pass]";
          $replace=array();
          $replace[]=$username;
          $replace[]=$password;         
          $message=str_ireplace($search,$replace,$this->lang->line("textForgotMail"));
        
          $this->email->message($message);
          if ( @$this->email->send())
          {    //echo $this->email->print_debugger();
             return true;
          }    
          else    
          {   //echo $this->email->print_debugger();
               return false;
          }
   
   }
   
   public function sendRegisterMail($username,$password,$email)
   {
          $config['mailtype']=$this->config->item("mail_type");
          $config['smtp_host']=$this->config->item("smtp_host");
          $config['smtp_user']=$this->config->item("smtp_user");
          $config['smtp_pass']=$this->config->item("smtp_pass");
          $config['smtp_port']=$this->config->item("smtp_port");
          $config['protocol']=$this->config->item("protocol");
          $config['validate'] = $this->config->item("validate");
           $this->load->library('email',$config);
           $this->email->set_newline("\r\n"); 
          $this->email->from($this->config->item("email_send"), $this->config->item("name_from"));
          $this->email->to($email);
          $this->email->subject($this->lang->line("subjectRegisterMail"));
          $search=array();
          $search[]="[username]";
          $search[]="[pass]";
          $replace=array();
          $replace[]=$username;
          $replace[]=$password;         
          $message=str_ireplace($search,$replace,$this->lang->line("textRegisterMail"));
          
          $this->email->message($message);
          if ( @$this->email->send())
          {    
             return true;
          }    
          else    
             return false;
   
   
   }
   
   public function openSession()
  {
   //grabo el inicio de uso de la session
    $record=array();
    $record["iduser"]= $this->session->userdata('user_id');
    $record["date_begin"]=date("Ymd");
    $record["h_begin"]=date("Hi");
    $user_session=$this->session->userdata('session_id');
    $this->session->set_userdata("user_session",$user_session);
    $record["sessionid"]= $user_session;
    $this->db->insert("sessiones",$record);
    
  }
  
  public function lastActivitySession()
  {
   $record=array();
   $record["date_last_activity"]=date("Ymd");
   $record["h_last_activity"]=date("Hi");
    $CI =& get_instance();
   $iduser= $CI->session->userdata('user_id');
   $sessionid= $CI->session->userdata('user_session');
   $CI->db->update("sessiones",$record,array("sessionid"=>$sessionid,"iduser"=>$iduser));
  
  }
  
  public function closeSession()
  {
   $record=array();
   $record["date_last_activity"]=date("Ymd");
   $record["h_last_activity"]=date("Hi");
   $iduser= $this->session->userdata('user_id');
   $sessionid= $this->session->userdata('user_session');
   $this->db->update("sessiones",$record,array("sessionid"=>$sessionid,"iduser"=>$iduser));
    
  }
   
   
 
    
}

?>

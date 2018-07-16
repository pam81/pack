<?php

class Pass extends Controller {
   public $message = '';

   function __construct()
   {
    parent::Controller();
    $this->lang->load("fletpack_site");
    $this->load->library('form_validation');
    $this->load->helper(array('form'));
    $this->load->library('pagination');
    $this->load->model("Current_User");
    $this->load->model("User_model");
    $this->load->config("site");
    $this->User_model->verified_login();
    
   
   }

   public function index(){
	   	if ( $this->Current_User->isHabilitado("SETEO_PASSWORD") )
	    {
            $query=$this->db->get("passwords");
            $data["codigos"]=$query->result();
            $data["content"]="password/password_viewlist";
            if ($this->uri->segment(3)){
             
                  $this->message = "Se ha/n generado la/s clave/s.";
            }
            $data["message"]=$this->message;
            $this->load->view("costoindex",$data);
	   }
	    else{
	          redirect("inicio/denied");
	   }
   }

   public function save(){
      if ($this->input->post("send")  )
      {
            if ($this->input->post("cliente_inhabilitar")){
                  $code = sha1($this->db->escape_str($this->input->post("cliente_inhabilitar")));
                  $record["codigo"] = $code;
                  $record["expire"] = date('Y-m-d H:i', strtotime("+1 day"));
                  $this->db->where("tipo","cliente_inhabilitar");
                  $this->db->update('passwords',$record);
                  $this->message="ok";
            }

            if ($this->input->post("modificar_docu")){
                  $code = sha1($this->db->escape_str($this->input->post("modificar_docu")));
                  $record["codigo"] = $code;
                  $record["expire"] = date('Y-m-d H:i', strtotime("+1 day"));
                  $this->db->where("tipo","modificar_docu");
                  $this->db->update('passwords',$record);
                  $this->message.="ok";
            }

            if ($this->input->post("asignar_viaje")){
                  $code = sha1($this->db->escape_str($this->input->post("asignar_viaje")));
                  $record["codigo"] = $code;
                  $record["expire"] = date('Y-m-d H:i', strtotime("+1 day"));
                  $this->db->where("tipo","asignar_viaje");
                  $this->db->update('passwords',$record);
                  $this->message .= "ok";
            }
            redirect("pass/index/".$this->message);
            
      }
   }

}
?>
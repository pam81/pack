<?php

class Pass extends Controller {

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
	    $data["pass"]=$query->result();
	    $data["content"]="password/password_viewlist";
	    $this->load->view("costoindex",$data);
	   
	   
	   }
	    else{
	          redirect("inicio/denied");
	   }
   }

   public function save(){
 	if ($this->input->post("send")  )
	{
		$record["cliente_inhabilitar"] = sha1($this->db->escape_str($this->input->post("inhabilitar")));
		$this->db->where("id",$this->uri->segment(3));
        $this->db->update('passwords',$record);
       	redirect("pass");
    }
   }

}
?>
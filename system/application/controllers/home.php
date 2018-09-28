<?php

class Home extends Controller {

   function __construct()
   {
    parent::Controller();
    $this->lang->load("fletpack_site");
    $this->load->library('form_validation');
     $this->load->helper(array('form'));
    $this->load->model("Current_User");
   
   }
   
   public function index()
   {     
    if ( $user=Current_User::user() ){
       redirect("inicio");
    }

    $data["content"]="home";
    $this->load->view("index",$data);
   
   }
   
   public function logear()
   {
        if ($this->_submit_validate() === FALSE) {
    	    $this->index();
    	    return;
    	  }
    	 
    	 $this->load->model("User_model");
       $this->User_model->openSession();
   	   redirect('inicio');
   }
   
   private function _submit_validate()
	{
    $this->form_validation->set_rules('user', $this->lang->line('user'),'trim|required|callback_authenticate');
	 
    $this->form_validation->set_rules('password', $this->lang->line('password'),'trim|required');

    $this->form_validation->set_message('authenticate',$this->lang->line("error_login"));

   

	 
	  return $this->form_validation->run();
  
  }


  
  public function authenticate() {
      
    $token = $this->input->cookie("flet-token");

    return Current_User::login($this->input->post('user'),
                                $this->input->post('password'), $token);
  }
	    
	public function logout()
	{
     $this->session->sess_destroy();
     $this->load->model("User_model");
     $this->User_model->closeSession();
     redirect("home");
  }
  
 
  
  
}

?>

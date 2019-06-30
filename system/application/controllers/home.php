<?php

class Home extends Controller {

   function __construct()
   {
    parent::Controller();
    $this->lang->load("fletpack_site");
    $this->load->library('form_validation');
    $this->load->helper(array('form'));
    $this->load->model("Current_User");
    $this->load->model("Viaje_model");
    $this->load->config("site");
   
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
  
 //Correr script diario para cargar radio en movil que no trabajo 
  public function chargeRadio(){
   $today= date("Ymd");
   $sql="select d.* from dias d where d.dia = '$today'"; 
   $query=$this->db->query($sql);
   $dia=$query->result(); 
   $day = strtolower(date("l"));
   if (count($dia) == 0 && $day != "sunday"){ //es dia laborable y no es domingo
     //obtener todos los moviles que no tienen recaudacion para el día de hoy
     $today= date("Y-m-d");
     $sql="select m.* from movil m where m.active=1 and m.movil != -1 and 
     m.id not in (select r.idmovil from recaudacion r where r.fecha = '$today' ) ";
     $query=$this->db->query($sql);
     $moviles=$query->result();
     foreach($moviles as $m){
       $data = array(
         'recaudacion'=> 0,
         'porcentaje'=> 0,
         'comision'=> 0,
         'fecha'=> $today,
         'viaje'=>0,
         'descripcion'=> '',
         'idmovil'=>$m->id,
         'cco'=> 0,
         'peon'=> 0,
         'peaje'=> 0,
         'estacionamiento'=> 0,
         'iva'=> 0,
         'mudanza'=> 0,
         'art'=> 0,
         'total'=> 0
       );
       $this->Viaje_model->updateRecaudacion($data);
     }

   }
  
}
  //testear enviar email 
public function testSendEmail(){
   $to= 'papereyra@gmail.com'; //$this->uri->segment(3);
   $this->config->load('site');
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
   $this->email->to($to);
   $this->email->subject("Confirmación de Envió - Fletpack");
            
   $message="<p>Hola </p> 
     <p>Queremos informarte que ya se ha enviado el móvil</p>
      <br /> <br />
     <p>Saludos <br> Fletpack</p>
   ";
   
   $this->email->message($message);
   if ( $this->email->send())
   {    
      echo "enviado";
   }    
   else{    
     echo "Error: "; 
     echo $this->email->print_debugger();
      
   }   
 }
  
}

?>

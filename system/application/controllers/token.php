<?php

class Token extends Controller {
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
	   	if ( $this->Current_User->isHabilitado("SETEO_TOKEN") )
	    {
            $data["message"]='';
            $data["error"]='';
            $data["token"] = '';
            $data["expire"] = '';
            $data["content"]="token/token_view";
            if ($this->input->post("send")){
              $maquina = $this->input->post("maquina");
              if (!$maquina){
                $data["error"] = "Debe ingresar un nombre de maquina";
                
              }else{
                $code = md5(uniqid(rand(), true));
                $actual = date('Y-m-d H:i:s');
                $expire = date('Y-m-d H:i:s', strtotime($actual. ' + 1 month'));
                $token = array(
                  "user"=> $this->Current_User->getUsername(),
                  "created_at" => $actual,
                  "expired_at "=> $expire,
                  "code" =>  $code,
                  "maquina" => $maquina
                  );

                if ( $this->db->insert("token",$token) ){
                  $data["message"] = "Se ha generado el token.";
                  $data["token"] = $code;
                  $data["expire"] = $expire;
                }else{
                  $data["message"] = "No se ha podido generar el token";
                }
              }
            }
           
            $this->load->view("costoindex",$data);
	   }
	    else{
	          redirect("inicio/denied");
	   }
   }

   public function listado(){
    $limit = 40;
    $inicio=0;

    if ($this->uri->segment(3)){
      $inicio = $this->uri->segment(3);
    }

    $config['base_url'] = site_url()."token/listado";
    $config['total_rows'] = $this->db->count_all('token');
    $config['per_page'] = $limit;
    $config['num_links'] = 4;
    $config['first_link'] = $this->lang->line("first_page");
    $config['first_tag_open'] = '<div id="first">';
    $config['first_tag_close'] = '</div>';
    $config['last_link'] = $this->lang->line("last_page");
    $config['last_tag_open'] = '<div id="last">';
    $config['last_tag_close'] = '</div>';
    $config['next_tag_open'] = '<div id="next">';
    $config['next_tag_close'] = '</div>';
    $config['prev_tag_open'] = '<div id="prev">';
    $config['prev_tag_close'] = '</div>';
    $config['cur_tag_open'] = '<div id="current">';
    $config['cur_tag_close'] = '</div>';
    $config['num_tag_open'] = '<div class="digit">';
    $config['num_tag_close'] = '</div>';
    $this->pagination->initialize($config); 
    
    $this->db->limit($limit,$inicio);
    $this->db->order_by("id", "desc");
   
    $query=$this->db->get("token");
    $clientes=$query->result();
    $data["tokens"]=$clientes;
    $data["maquina"]='';
    $data["content"]="token/token_viewlist";
   
    $this->load->view("costoindex",$data);

   }


   public function desactivar(){
    if ( $this->Current_User->isHabilitado("SETEO_TOKEN") ){
      $id = $this->db->escape_str($this->uri->segment(3));
      if ($id){      
        $expire = date('Y-m-d H:i:s', strtotime('yesterday'));
        $record=array( "expired_at"=>$expire);
        $this->db->where("id",$id);
        $this->db->update("token",$record);
        redirect("token/listado/".$this->uri->segment(4));
      }
    }else{
      redirect("inicio/denied");
    }
   }

  }
  ?>
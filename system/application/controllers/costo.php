<?php

class Costo extends Controller {

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
   
   public function index()
   {
   if ( $this->Current_User->isHabilitado("CHANGE_COSTO") )
    {
 
     if ($this->uri->segment(3))
    {
      $id=$this->db->escape_str($this->uri->segment(3));
      $query=$this->db->get_where("valores",array("categoriaid"=>$id));
      
      $data["valor"]=$query->result();
      $data["categoriaid"]=$id;
    }
    else
      $data["categoriaid"]=0;
    
    $query=$this->db->get("categorias");
    $data["categorias"]=$query->result();
    $data["content"]="costo_viewlist";
    $this->load->view("costoindex",$data);
   
   
   }
    else
          redirect("inicio/denied");
   }
   
   function _submit_validateCosto()
   {
   
   $this->form_validation->set_rules('categoria', $this->lang->line('title_categoria'),'trim|required|is_natural_no_zero');
   $this->form_validation->set_rules('fraccion', $this->lang->line('title_fraccion'),'trim|required|is_natural');
   $this->form_validation->set_rules('cant_hora', $this->lang->line('title_cant_hora'),'trim|required|is_natural');
   $this->form_validation->set_rules('cant_hora2', $this->lang->line('title_cant2_hora'),'trim|required|is_natural');
   $this->form_validation->set_rules('valor_hora', $this->lang->line('title_valor_hora'),'trim|required|decimal');
   $this->form_validation->set_rules('valor_hora2', $this->lang->line('title_valor_hora2'),'trim|required|decimal');
   
   return $this->form_validation->run();
   }
   
   function add()
  {
 
   
    if ($this->input->post("send") && $this->input->post("categoria") )
    {
      if ($this->_submit_validateCosto() === FALSE) {
            $this->index();
            return;
       }
       else
       {
     
        
      $record=array('categoriaid'=> $this->input->post("categoria"));
      $record["fraccion"]=$this->db->escape_str($this->input->post("fraccion"));
      $record["valorhora"]=$this->db->escape_str($this->input->post("valor_hora"));
      $record["valorhora2"]=$this->db->escape_str($this->input->post("valor_hora2"));
      $record["primerciclo"]=$this->db->escape_str($this->input->post("cant_hora"));
      $record["segundociclo"]=$this->db->escape_str($this->input->post("cant_hora2"));
        $this->db->where("categoriaid",$this->input->post("categoria"));
        $this->db->from('valores');
        
       if($this->db->count_all_results() == 0)
         $this->db->insert("valores",$record);
       else
       {   $this->db->where("categoriaid",$this->input->post("categoria"));
        
           $this->db->update('valores',$record);
       }
      
      redirect("costo/index/".$this->input->post("categoriaid"));
      
    }
    }
    else
        redirect("costo");
     
  
  
  }
  
  public function seguro()
  {
  if ( $this->Current_User->isHabilitado("CHANGE_COSTO") )
    {
 
    
    $query=$this->db->get("seguro");
    $data["seguro"]=$query->result();
    $data["content"]="seguro_viewlist";
    $this->load->view("costoindex",$data);
   
   
   }
    else
          redirect("inicio/denied");
  
  }
  
  function _submit_validateSeguro()
  {
  
  
   $this->form_validation->set_rules('monto', $this->lang->line('title_monto'),'trim|required');
   $this->form_validation->set_rules('valor', $this->lang->line('title_valor'),'trim|required');
  
   
   return $this->form_validation->run();
  
  }
  
  public function comision()
  {
  if ( $this->Current_User->isHabilitado("CHANGE_COSTO") )
    {
 
    
    $query=$this->db->get("comision");
    $data["comision"]=$query->result();
    $data["content"]="comision_viewlist";
    $this->load->view("costoindex",$data);
   
   }
    else
          redirect("inicio/denied");
  
  }
  
  function _submit_validateComision()
  {
  
  
   $this->form_validation->set_rules('mudanza', $this->lang->line('title_mudanza'),'trim|required');
   $this->form_validation->set_rules('ctacte', $this->lang->line('title_cta_cte'),'trim|required');
  
   
   return $this->form_validation->run();
  
  }
  
  public function saveComision(){
  
      if ($this->input->post("send")  )
    {
      if ($this->_submit_validateComision() === FALSE) {
            $this->comision();
            return;
       }
       else
       {
     
        
      $record=array();
      $record["mudanza"]=$this->db->escape_str($this->input->post("mudanza"));
      $record["cta_cte"]=$this->db->escape_str($this->input->post("ctacte"));
      
      $this->db->where("id",$this->uri->segment(3));
      $this->db->update('comision',$record);
       
      
      redirect("costo/comision");
      
    }
    }
    else
        redirect("costo");
  
  }
  
  
  
  
  public function save()
  {
   if ($this->input->post("send")  )
    {
      if ($this->_submit_validateSeguro() === FALSE) {
            $this->seguro();
            return;
       }
       else
       {
     
        
      $record=array();
      $record["monto"]=$this->db->escape_str($this->input->post("monto"));
      $record["valor"]=$this->db->escape_str($this->input->post("valor"));
      
      $this->db->where("id",$this->uri->segment(3));
      $this->db->update('seguro',$record);
       
      
      redirect("costo/seguro");
      
    }
    }
    else
        redirect("costo");
  
  }
  
  
}

?>

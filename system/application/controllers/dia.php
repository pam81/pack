<?php

class Dia extends Controller {

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
   
 
    $fdesde=date("Y")."0101";
    $fhasta=date("Y")."1231";
   
    
    
     if ($this->input->post("desde_day") && $this->input->post("desde_month") && $this->input->post("desde_year"))
       $fdesde=$this->db->escape_str($this->input->post("desde_year")).str_pad($this->db->escape_str($this->input->post("desde_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("desde_day")),2,"0",STR_PAD_LEFT);
    
     $data["fdesde"]=$fdesde;
    
    if ($this->input->post("hasta_day") && $this->input->post("hasta_month") && $this->input->post("hasta_year"))
       $fhasta=$this->db->escape_str($this->input->post("hasta_year")).str_pad($this->db->escape_str($this->input->post("hasta_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("hasta_day")),2,"0",STR_PAD_LEFT);
    
    $data["fhasta"]=$fhasta;
  

    
    $sql="select d.* from dias d where d.dia between $fdesde and $fhasta order by d.dia asc"; 
    $query=$this->db->query($sql);

    $dias=$query->result(); 
   
    $data["dias"]=$dias;
    
    $data["content"]="dia/dia_viewlist";
    $this->load->view("index",$data);
   
   
   

  }

  public function add()
   {
   
      
      $data["content"]="dia/dia_viewadd";
      
      $this->load->view("index",$data);
      
   }

   public function addnew()
   {  
       if ($this->_submit_validate() === FALSE ) {
            $this->add();
            return;
       }
       else
       {
         

         $record=array(
        
          'dia'=>$this->input->post("fecha_year").$this->input->post("fecha_month").$this->input->post("fecha_day"),
          
          
         );
         
         
         
         $this->db->insert("dias",$record);
         
         redirect("dia/addSuccess");
       }
        redirect("dia"); 
   }
   
   
   
   public function addSuccess()
   {
      $data["content"]="success";
      $data["message"]="Se ha agregado la fecha";
      $data["url_back"]=site_url()."dia";
      $this->load->view("index",$data);
   }

   public function mod()
   {
     
  
         $id = $this->db->escape_str($this->uri->segment(3));
          if ($id)
          {
         
            $query=$this->db->get_where("dias",array("id"=>$id));
            $dia=$query->result();
            $data["dia"]=$dia; 
            
           
            $data["content"]="dia/dia_viewmod";
            $this->load->view("index",$data);
            
            
          }
          else
             redirect('dia/index/'.$this->uri->segment(4));
     
             
   }
  
  
  
  
   
   public function update()
   {
    $id=$this->db->escape_str($this->uri->segment(3));
    if ($id)
    {
       if ($this->_submit_validate() === FALSE  ) {
            $this->mod();
            return;
       }
       else
       {
       
        $record=array();
      
     
        $record['dia']=$this->input->post("fecha_year").$this->input->post("fecha_month").$this->input->post("fecha_day");
       
        
       
       $this->db->where("id",$id);
       $this->db->update("dias",$record);
      
       
         redirect("dia/index/".$this->uri->segment(4));
       }  
    }
    else
      redirect("dia/index/".$this->uri->segment(4)); 
   }

   function _submit_validate(){
    $this->form_validation->set_rules('fecha_day', $this->lang->line('title_fecha'),'trim|required|callback_checkDate|callback_fechaNoExist');
    $this->form_validation->set_rules('fecha_month', $this->lang->line('title_fecha'),'trim|required');
    $this->form_validation->set_rules('fecha_year', $this->lang->line('title_fecha'),'trim|required');
    $this->form_validation->set_message('checkDate','Fecha no válida');
    $this->form_validation->set_message('fechaNoExist','Fecha ya fue agregada');
    return $this->form_validation->run();
   }

   function checkDate(){
    return checkdate ( $this->input->post("fecha_month") , $this->input->post("fecha_day") , $this->input->post("fecha_year"));
   }

   function fechaNoExist(){
     $date=$this->db->escape_str($this->input->post("fecha_year").$this->input->post("fecha_month").$this->input->post("fecha_day"));
     $query=$this->db->get_where("dias",array("dia"=>$date));
     $resultado=$query->result();
     
     if ( isset($resultado[0]) && count($resultado) > 0 )
     {
        
            return false; //existe la fecha
            
     }else{
     
         return true; //no existe
      }
   }

   function del()
   {
     
         $id = $this->db->escape_str($this->uri->segment(3));
          if ($id)
          {
           
             $this->db->where("id",$id);
             $this->db->delete("dias");
           
          }
          redirect('dia/index/'.$this->uri->segment(4));
     
   }
}

?>
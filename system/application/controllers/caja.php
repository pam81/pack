<?php

class Caja extends Controller {

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
   
   public function index()
   {

    $movil=0;
    $fdesde=date("Ymd");
    $fhasta=date("Ymd");
   
    if ($this->input->post("movil"))
       $movil=$this->db->escape_str($this->input->post("movil"));
       
     $data["movil"]=$movil;
    
     if ($this->input->post("desde_day") && $this->input->post("desde_month") && $this->input->post("desde_year"))
       $fdesde=$this->db->escape_str($this->input->post("desde_year")).str_pad($this->db->escape_str($this->input->post("desde_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("desde_day")),2,"0",STR_PAD_LEFT);
    
     $data["fdesde"]=$fdesde;
    
    if ($this->input->post("hasta_day") && $this->input->post("hasta_month") && $this->input->post("hasta_year"))
       $fhasta=$this->db->escape_str($this->input->post("hasta_year")).str_pad($this->db->escape_str($this->input->post("hasta_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("hasta_day")),2,"0",STR_PAD_LEFT);
    
    $data["fhasta"]=$fhasta;
    $cajas=array();

    if ($movil != 0 ){ 
        $sql="select c.* from cajas c inner join movil m on c.idmovil=m.id where m.movil=$movil  and c.created_at between $fdesde and $fhasta order by c.created_at asc"; 
        $query=$this->db->query($sql);
    
        $cajas=$query->result(); 
    }
          
    
     
    
    
    
    $data["cajas"]=$cajas;
    
    
    
    
    $data["content"]="caja/cajas_viewlist";
    $this->load->view("index",$data);
   
   }
   
    
  
   public function del()
   {
    if ( $this->Current_User->isHabilitado("RECAUDACIONGRAL") )
    {
   
         //no se debe borrar debe quedar el historial
         
         $id = $this->db->escape_str($this->uri->segment(3));
          if ($id)
          {
            $record=array(
             'borrado'=>1,
             'delete_by'=>$this->Current_User->getUsername(),
             'delete_at'=>date("Ymd")
            );
            
            $this->db->where("id",$id);
            $this->db->update("cajas",$record);
            
          }
          redirect('caja/index/'.$this->uri->segment(4));
     }
     else
           redirect("inicio/denied");
   }
   
   
   
   public function add()
   {
     if ( $this->Current_User->isHabilitado("RECAUDACIONGRAL") )
    {  
      
      $this->db->where("active",1);
      $this->db->order_by("movil");
      $query=$this->db->get("movil");
      $data["moviles"]=$query->result();
      
      
      
      $data["content"]="caja/caja_viewadd";
      
      $this->load->view("index",$data);
     }
     else
        redirect("inicio/denied");  
   }
  
   public function addnew()
   {
       if ($this->_submit_validate() === FALSE ) {
            $this->add();
            return;
       }
       else
       {
         $monto=str_replace(",",".",$this->input->post("monto"));

         $record=array(
          'idmovil'=>$this->input->post("movil"),
          'monto'=>$monto,
          'tipo'=>$this->input->post("type"),
          'descripcion'=>$this->input->post("descripcion"),
          'created_at'=>$this->input->post("fecha_year").$this->input->post("fecha_month").$this->input->post("fecha_day"),
          'created_by'=>$this->Current_User->getUsername()
          
         );
         
         
         
         $this->db->insert("cajas",$record);
         
         redirect("caja/addSuccess");
       }
        redirect("caja"); 
   }
   
   
   
   public function addSuccess()
   {
      $data["content"]="success";
      $data["message"]="Se ha agregado el registro";
      $data["url_back"]=site_url()."caja";
      $this->load->view("index",$data);
   }

  
   
   
   
   
    
   public function _submit_validate()
   {
     $this->form_validation->set_rules('movil', $this->lang->line('title_movil'),'trim|required');

     $this->form_validation->set_rules('monto', "monto",'trim|required');
     $this->form_validation->set_rules('descripcion', "descripción",'trim|required');
     
     
      return $this->form_validation->run();
   
   
   }
  
  
  public function lock($id)
   {
      $this->db->trans_start();
      $query=$this->db->get_where("cajas",array("id"=>$id));
      $caja=$query->result();
      $lockeo=false;
      if (isset( $caja[0]) && $caja[0]->bloqueado == 0)
      {
         $record=array(
          'bloqueado'=>1,
          'bloqueado_by'=>$this->Current_User->getUsername()
         );
         $this->db->update("cajas",$record,array("id"=>$id));
         $lockeo=true;
      }
      else{ //si soy yo el que lo lockeo me debe permitir ingresar
        if (isset($caja[0]) && $caja[0]->bloqueado == 1 && $caja[0]->bloqueado_by == $this->Current_User->getUsername())
           $lockeo=true;
      }
      $this->db->trans_complete();
      return $lockeo;
   }
   
   public function unlock()
   {
     $id=$this->db->escape_str($this->uri->segment(3));
     if ($id)
     { 
      $this->db->trans_start();
      $query=$this->db->get_where("cajas",array("id"=>$id));
      $caja=$query->result();
      
      if (isset( $caja[0]) && $caja[0]->bloqueado == 1)
      {
         $record=array(
          'bloqueado'=>0,
          'bloqueado_by'=>''
         );
         $this->db->update("cajas",$record,array("id"=>$id));
       
      }
      $this->db->trans_complete();
     }
      redirect('caja/index/'.$this->uri->segment(4));
   }
  
  
  
   public function mod()
   {
     
   if ( $this->Current_User->isHabilitado("RECAUDACIONGRAL") )
    {
         $id = $this->db->escape_str($this->uri->segment(3));
          if ($id)
          {
          if ( $this->lock($id) )
         {  
            
            $this->db->where("active",1);
             $this->db->order_by("movil");
            $query=$this->db->get("movil");
            $data["moviles"]=$query->result();
            
            $query=$this->db->get_where("cajas",array("id"=>$id));
            $caja=$query->result();
            $data["caja"]=$caja; 
            
            $data["dir_desbloquea"]=site_url()."caja/unlock/".$id;
            $data["content"]="caja/caja_viewmod";
            $this->load->view("index",$data);
           }
           else
            {  
                $data["content"]="lockeado";
                $data["message"]="El resgitro esta bloqueado";
                $this->load->view("index",$data);
             } 
            
          }
          else
             redirect('caja/index/'.$this->uri->segment(4));
      }
      else
         redirect("inicio/denied"); 
             
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
        $monto=str_replace(",",".",$this->input->post("monto"));
        $record['idmovil']=$this->input->post("movil");
        $record['monto']=$monto;
        $record['descripcion']=$this->input->post("descripcion");
        $record['tipo']=$this->input->post("type");
       
       $record["bloqueado"]=0;
       $record["bloqueado_by"]='';  
       
       $this->db->where("id",$id);
       $this->db->update("cajas",$record);
      
       
         redirect("caja/index/".$this->uri->segment(4));
       }  
    }
    else
      redirect("caja/index/".$this->uri->segment(4)); 
   }
   
   
  
}

?>

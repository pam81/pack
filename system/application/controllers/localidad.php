<?php

class Localidad extends Controller {

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
   
   public function getLocalidades()
   {
     $provinciaid=$this->db->escape_str($this->input->post("provincia"));
     if ($provinciaid)
     {
       $query=$this->db->get_where("cities",array("regionid"=>$provinciaid));
       $cities=array();
       foreach($query->result() as $p)
         $cities[$p->id]=$p->name;
       
       echo json_encode($cities); 
      
     }
     else
       echo '';
   
   }
   
  
   
     public function index()
   {
    $urlarray = $this->uri->uri_to_assoc(3);
    $search='';
    $provincia=638;
    $array=array();
   
    if ($this->input->post("searchfield"))
    {   $search=$this->input->post("searchfield");
        $array["find"]=$search;
    }
    else
    {     if (isset($urlarray["find"]))
          { 
            $search=$urlarray["find"];
            $array["find"]=$search;
          }
         
     }
     
    if ($this->input->post("provincia"))
    {  $provincia=$this->input->post("provincia");
      
    }
   else
   {
        if (isset($urlarray["provincia"]))
       {   $provincia=$urlarray["provincia"];
          
       }
          
   }
    $array["provincia"]=$provincia;
    
      
    
    
    $limit = 20;
    $inicio=0;
     if (isset($urlarray["page"]) && $urlarray["page"]!= '')
      $inicio=$urlarray["page"];
    
    $sql="  SELECT l.* FROM cities l,regiones p ";
    $sql .=" WHERE l.regionid = p.id and p.id = $provincia ";
         
    if ($search)
        $sql.=" and l.name like '%".$search."%' ";
       
    $sql_aux=$sql; 
          
     $sql .=" limit $inicio,$limit";
   
    
    $query=$this->db->query($sql);
    $localidades=$query->result(); 
    $data["localidades"]= $localidades;
    
    $query=$this->db->query($sql_aux);
    $uri_segment=(count($array)*2)+4;
    $config['base_url'] = site_url()."localidad/index/".$this->uri->assoc_to_uri($array)."/page/";
    $config['total_rows'] = count($query->result());
    $config['per_page'] = $limit;
    $config['num_links'] = 4;
    $config['uri_segment'] = $uri_segment;
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
    $this->db->order_by("name");
    $query=$this->db->get("regiones");
    $data["provincias"]=$query->result();
    
    $data["search"]=$search;
    $data["provincia"]=$provincia;
    $data["content"]="localidad_viewlist";
    $this->load->view("index",$data);
    
   
   
   } 
  
   public function add()
   {
    $this->db->order_by("name");
    $query=$this->db->get("regiones");
    $data["provincias"]=$query->result();
    $data["content"]="localidad_nueva";
    $this->load->view("index",$data);
   }
  
   public function addnew()
   {
     if ($this->_submit_validateLocalidad() === FALSE) 
     {
            $this->add();
            return;
     }
    else
    {
      $record=array(
       'name'=>$this->input->post("name"),
       'regionid'=>$this->input->post("provincia")
      );
      
       $this->db->insert("cities",$record);
       redirect("localidad/success");
    }
    redirect("localidad");
   }
   function _submit_validateLocalidad()
   {
   
    $this->form_validation->set_rules('name', $this->lang->line('title_localidad'),'trim|required|max_lenght[200]');
    return $this->form_validation->run();
   
   }
   public function success()
   {
      
      $data["content"]="success";
      $data["message"]=$this->lang->line("message_success_add_localidad");
      $data["url_back"]=site_url()."localidad";
      $this->load->view("index",$data);
   
   }
   
    public function successMod()
   {
      
      $data["content"]="success";
      $data["message"]=$this->lang->line("message_success_mod_localidad");
      $data["url_back"]=site_url()."localidad";
      $this->load->view("index",$data);
   
   }
   
   public function del()
   {
     $id = $this->db->escape_str($this->uri->segment(3));
          if ($id)
          {
            
            $this->db->delete("cities",array("id"=>$id));
          }
          redirect('localidad');
   
   }
   
   public function mod()
   {
        $id = $this->db->escape_str($this->uri->segment(3));
        if ($id)
        {
          $query=$this->db->get_where("cities",array("id"=>$id));
          $data["localidad"]=$query->result();
          $this->db->order_by("name");
    $query=$this->db->get("regiones");
    $data["provincias"]=$query->result();
          $data["content"]="localidad_viewmod";
          $this->load->view("index",$data);
        
        }
        else
           redirect('localidad');
   
   }
   
   public function update()
   {
   $id = $this->db->escape_str($this->uri->segment(3));
    if ($id){
     if ($this->_submit_validateLocalidad() === FALSE) 
     {
            $this->mod();
            return;
     }
    else
    {
      $record=array(
       'name'=>$this->input->post("name"),
       'regionid'=>$this->input->post("provincia")
      );
      
       
       $this->db->update("cities",$record,array("id"=>$id));
       redirect("localidad/successMod");
    }
    }
    redirect("localidad");
   
   }
   
   
}

?>

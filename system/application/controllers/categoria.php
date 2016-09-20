<?php

class Categoria extends Controller {

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
    
    
    $sql="  SELECT * FROM categorias ";
    
    $query=$this->db->query($sql);
    $categorias=$query->result(); 
    $data["categorias"]= $categorias;
    
    $data["content"]="categoria_viewlist";
    $this->load->view("index",$data);
    
   
   
   } 
  
   public function add()
   {
   
    $data["content"]="categoria_nueva";
    $this->load->view("index",$data);
   }
  
   public function addnew()
   {
     if ($this->_submit_validateCategoria() === FALSE) 
     {
            $this->add();
            return;
     }
    else
    {
      $record=array(
       'name'=>$this->input->post("name")
       
      );
      
       $this->db->insert("categorias",$record);
       redirect("categoria/success");
    }
    redirect("categoria");
   }
   
   function _submit_validateCategoria()
   {
   
    $this->form_validation->set_rules('name', $this->lang->line('title_name'),'trim|required|max_lenght[200]');
    return $this->form_validation->run();
   
   }
   public function success()
   {
      
      $data["content"]="success";
      $data["message"]=$this->lang->line("message_success_add_categoria");
      $data["url_back"]=site_url()."categoria";
      $this->load->view("index",$data);
   
   }
   
    public function successMod()
   {
      
      $data["content"]="success";
      $data["message"]=$this->lang->line("message_success_mod_categoria");
      $data["url_back"]=site_url()."categoria";
      $this->load->view("index",$data);
   
   }
   
   public function del()
   {
     $id = $this->db->escape_str($this->uri->segment(3));
          if ($id)
          {
            
            $this->db->delete("categorias",array("id"=>$id));
          }
          redirect('categoria');
   
   }
   
   public function mod()
   {
        $id = $this->db->escape_str($this->uri->segment(3));
        if ($id)
        {
          $query=$this->db->get_where("categorias",array("id"=>$id));
          $data["categoria"]=$query->result();
          $data["content"]="categoria_viewmod";
          $this->load->view("index",$data);
        
        }
        else
           redirect('categoria');
   
   }
   
   public function update()
   {
   $id = $this->db->escape_str($this->uri->segment(3));
    if ($id){
     if ($this->_submit_validateCategoria() === FALSE) 
     {
            $this->mod();
            return;
     }
    else
    {
      $record=array(
       'name'=>$this->input->post("name")
     
      );
      
       
       $this->db->update("categorias",$record,array("id"=>$id));
       redirect("categoria/successMod");
    }
    }
    redirect("categoria");
   
   }
   
   
}

?>

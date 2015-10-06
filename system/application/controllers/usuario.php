<?php

class Usuario extends Controller {

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
    $this->User_model->verified_login();
   
   }
   
   public function index()
   {
   $limit = 20;
    $inicio=0;
    if ($this->uri->segment(3))
      $inicio = $this->uri->segment(3);
      
    $config['base_url'] = site_url()."usuario/index";
    $config['total_rows'] = $this->db->count_all('admusers');
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
    $this->db->order_by("name");
    $query=$this->db->get("admusers");
    $data["admusers"]=$query->result(); 
    $data["content"]="usuario_viewlist";
    $this->load->view("index",$data);
   
   }
   
   public function search()
   {
   
   $urlarray = $this->uri->uri_to_assoc(2);
   $search='';
    if ($this->input->post("searchfield"))
       $search=$this->db->escape_str($this->input->post("searchfield"));
    else
        $search=$this->db->escape_str($urlarray["find"]);
    
    $array=array("find"=>$search); 
    
       if ($search )
    {
    
    $urlarray = $this->uri->uri_to_assoc(2);
    
    $limit = 20;
    $inicio=0;
     if (isset($urlarray["page"]) && $urlarray["page"]!= '')
      $inicio=$urlarray["page"];
    
    
    
    $sql="select a.* from admusers a where a.username like \"%$search%\" order by name";  
          
    $sql_aux=$sql; 
          
    $sql .=" limit $inicio,$limit";
     
    $query=$this->db->query($sql);
    $data["admusers"]=$query->result();  
    
    $query=$this->db->query($sql_aux);
    
    $config['base_url'] = site_url()."usuario/search/".$this->uri->assoc_to_uri($array)."/page/";
    $config['total_rows'] = count($query->result());
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
    
    $data["search"]=$search;
    $data["content"]="usuario_viewlist";
    $this->load->view("index",$data);
    }
    else
     show_404();
       
   }
   
   public function active ()
   {
  if ( $this->Current_User->isHabilitado("DEL_USER") )
    {
  
   $id = $this->db->escape_str($this->uri->segment(3));
   if ($id)
   {
     $record=array(
     "active"=>1
     );
     $this->db->where("id",$id);
     $this->db->update("admusers",$record);
   
   }
   
    redirect("usuario/index/".$this->uri->segment(4));
    }
    else
      redirect("inicio/denied");
   }
   
   public function noactive()
   {
    if ( $this->Current_User->isHabilitado("DEL_USER") )
    {
       $id = $this->db->escape_str($this->uri->segment(3));
       if ($id)
       {
         $record=array(
         "active"=>0
         );
         $this->db->where("id",$id);
         $this->db->update("admusers",$record);
       
       }
       
        redirect("usuario/index/".$this->uri->segment(4));
     }
     else
        redirect("inicio/denied");
   }
  
   public function del()
   {
   if ( $this->Current_User->isHabilitado("DEL_USER") )
    {
         $id = $this->db->escape_str($this->uri->segment(3));
          if ($id)
          {
            $this->db->delete("admusers",array("id"=>$id));
            $this->db->delete("usuario_permiso",array("usuarioid"=>$id));
          }
          redirect('usuario/index/'.$this->uri->segment(4));
    }
    else
           redirect("inicio/denied");  
   }
   
   public function add()
   {
    if ( $this->Current_User->isHabilitado("ADD_USER") )
    {
    
      $this->db->order_by("reporte");
      $query=$this->db->get("permisos");
      $data["permisos"]=$query->result();
      $data["content"]="usuario_viewadd";
      $this->load->view("index",$data);
    }
    else
       redirect("inicio/denied");   
   }
   
   public function addnew()
   {
       if ($this->_submit_validateUsuario() === FALSE) {
            $this->add();
            return;
       }
       else
       {
         $usuario=Current_User::user();
         $record=array(
          'name'=>$this->input->post("name"),
          'lastname'=>$this->input->post("lastname"),
          'username'=>$this->input->post("username"),
          'password'=>User_model::transform_password($this->input->post("password")),
          'date_created'=>date("Ymd"),
          'created_by'=>$usuario->username
         );
         $this->db->insert("admusers",$record);
         
         $this->addpermisos($this->db->insert_id());
         
         redirect("usuario/addSuccess");
       }
        redirect("usuario"); 
   }
   
   public function addpermisos($usuarioid)
   {
      foreach($_POST as $key=>$value)
      {
         if (preg_match('/permiso[0-9]*/',$key))
         {
          $record=array(
           'permisoid'=>$this->db->escape_str($value),
           'usuarioid'=>$usuarioid
          );
          $this->db->insert("usuario_permiso",$record);
         }
      }
   
   }
   
   
   public function addSuccess()
   {
      $data["content"]="success";
      $data["message"]=$this->lang->line("message_success_add_usuario");
      $data["url_back"]=site_url()."usuario";
      $this->load->view("index",$data);
   }
   
   public function _submit_validateUsuario()
   {
     $this->form_validation->set_rules('name', $this->lang->line('title_name'),'trim|required|max_lenght[100]');
     $this->form_validation->set_rules('lastname', $this->lang->line('title_lastname'),'trim|required|max_lenght[100]');
     $this->form_validation->set_rules('username', $this->lang->line('user'),'trim|required|max_lenght[100]|callback_existUsuario');
     $this->form_validation->set_rules('password', $this->lang->line('password'),'trim|required|max_lenght[100]');
     $this->form_validation->set_rules('confirm', $this->lang->line('confirm_password'),'trim|required|max_lenght[100]|callback_confirmPass');
     
      $this->form_validation->set_message('existUsuario',$this->lang->line("error_exist_username"));
      $this->form_validation->set_message('confirmPass',$this->lang->line("error_confirm_password"));
     
      return $this->form_validation->run();
   
   }
   
   public function _submit_validateModUsuario()
   {
     $this->form_validation->set_rules('name', $this->lang->line('title_name'),'trim|required|max_lenght[100]');
     $this->form_validation->set_rules('lastname', $this->lang->line('title_lastname'),'trim|required|max_lenght[100]');
     $this->form_validation->set_rules('username', $this->lang->line('user'),'trim|required|max_lenght[100]|callback_existModUsuario');
     $this->form_validation->set_rules('password', $this->lang->line('password'),'trim|max_lenght[100]');
     $this->form_validation->set_rules('confirm', $this->lang->line('confirm_password'),'trim|max_lenght[100]|callback_confirmPass');
     
      $this->form_validation->set_message('existModUsuario',$this->lang->line("error_exist_username"));
      $this->form_validation->set_message('confirmPass',$this->lang->line("error_confirm_password"));
     
      return $this->form_validation->run();
   
   }
   
   public function existModUsuario(){
   
     $this->db->where("username",$this->db->escape_str($this->input->post('username')));
     $this->db->where("id !=",$this->uri->segment(3));
     $query=$this->db->get("admusers");
     
     if ( count($query->result()) == 0)
	     
          return true;
	    
	    else
          return false;
   
   
   }   
   
   
   public function existUsuario() {
        
      if (User_model::existUsername($this->db->escape_str($this->input->post('username'))))
	    { 
          return false;
	    }
	    else
          return true;    
	    }
	    
	 public function confirmPass()
  {
  
      if ($this->input->post("password") == $this->input->post("confirm"))
        return true;
      else 
        return false;  
  
  }   
   
   public function mod()
   {
    if ( $this->Current_User->isHabilitado("MOD_USER") )
    { 
     
     $id = $this->db->escape_str($this->uri->segment(3));
      if ($id)
      {
        $this->db->order_by("reporte");
        $query=$this->db->get("permisos");
        $data["permisos"]=$query->result();
        
        $query=$this->db->get_where("usuario_permiso",array("usuarioid"=>$id));
        $data["permisouser"]=$query->result();
        
        $query=$this->db->get_where("admusers",array("id"=>$id));
        $data["admuser"]=$query->result(); 
        $data["content"]="usuario_viewmod";
        $this->load->view("index",$data);
      }
      else
         redirect('usuario/index/'.$this->uri->segment(4));
    }
    else     
         redirect("inicio/denied");  
   }
  
   public function update()
   {
    $id=$this->db->escape_str($this->uri->segment(3));
    if ($id)
    {
       if ($this->_submit_validateModUsuario() === FALSE) {
            $this->mod();
            return;
       }
       else
       {
       
       $record=array(
        'name'=>$this->input->post('name'),
        'lastname'=>$this->input->post('lastname'),
        'username'=>$this->input->post('username')
       );
       
       if ($this->input->post('password') != '')
         $record["password"]=User_model::transform_password($this->input->post('password'));
       
       $this->db->where("id",$id);
       $this->db->update("admusers",$record);
       $this->updatePermisos($id);
       redirect("usuario/index/".$this->uri->segment(4));
       }  
    }
    else
      redirect("usuario/index/".$this->uri->segment(4)); 
   }
  
  function updatePermisos($usuarioid)
  {
    $query = $this->db->get_where("usuario_permiso",array("usuarioid"=>$usuarioid));
    $permisos = $query->result();//obtengo los permisos del usuario
    $exist_permisos=array();
    foreach($permisos as $row)
    {
      $exist_permisos[]=$row->permisoid;
    }
    $new_permisos=array();
    //me fijo cuales me pasaron
    foreach( $_POST as $key=>$value)
    {
         if (preg_match('/permiso[0-9]*/',$key))
         { 
           $new_permisos[]=$value;
           
         }
    }
    //deben quedar las new_edades - si esta en exist_edades -> la quito de los dos arrays
    //                            - si no esta en exist_edades -> la debo inserta y quito de exist edades
    //                            - las que quedan en exist_edades las debo borrar
    // new_edades quedan las que debo insertar  
    $i=0;
    foreach($new_permisos as $new)
    {  $j=0;
      foreach($exist_permisos as $exist)
      {
        if ($new == $exist)
        { $new_permisos[$i]=0;
          $exist_permisos[$j]=0; 
        }
        $j++; 
      } 
      $i++;
    }  
    
    foreach($new_permisos as $new)
    {
      if($new != 0)
      {
        $record=array(
        'usuarioid'=>$usuarioid,
        'permisoid'=>$new
       );
       $this->db->insert("usuario_permiso",$record);
      }
    }
    
    foreach($exist_permisos as $exist)
    {
       if($exist != 0)
       {
        $this->db->where("usuarioid",$usuarioid);
        $this->db->where("permisoid",$exist);
        $this->db->delete("usuario_permiso");
       }
    }
  
  
  }
  
}

?>

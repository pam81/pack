<?php

class Cliente extends Controller {

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
    $limit = 40;
    $inicio=0;
    if ($this->uri->segment(3))
      $inicio = $this->uri->segment(3);
      
    $config['base_url'] = site_url()."cliente/index";
    $config['total_rows'] = $this->db->count_all('clientes');
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
    $query=$this->db->get("clientes");
    $clientes=$query->result();
    $data["clientes"]=$clientes;
    
    $listado_id='';
    $coma='';
    foreach($clientes as $c)
    {  $listado_id .=$coma.$c->id;
       $coma=",";
     } 
    if ($listado_id != '')
    {
    $sql="SELECT t.*
                  FROM phones t, clientes c
                  WHERE 
                  t.principal = 1
                  and
                  t.clienteid = c.id
                   AND t.clienteid
                  IN ( $listado_id)";
    
    $query=$this->db->query($sql);
    
    $data["phones"]=$query->result();
    }
    
    
    
    $data["content"]="cliente_viewlist";
    $this->load->view("index",$data);
   
   }
   
   
  public function search()
   {
   
   $urlarray = $this->uri->uri_to_assoc(2);
   $search=0;
    $name=0;
    $direccion=0;
    if ($this->input->post("searchfield"))
       $search=$this->db->escape_str($this->input->post("searchfield"));
    else
    {     if (isset($urlarray["find"]))
           $search=$this->db->escape_str($urlarray["find"]);
         else
           $search=0;  
     }   
     
   
    
    if ($this->input->post("name"))
       $name=$this->input->post("name");
    else
    {     if (isset($urlarray["name"]))
           $name=$urlarray["name"];
         else
           $name=0;  
     }
     
     if ($this->input->post("direccion"))
       $direccion=$this->input->post("direccion");
    else
    {     if (isset($urlarray["direccion"]))
           $direccion=$urlarray["direccion"];
         else
           $direccion=0;  
     }
     
    if ($search || $name || $direccion)
    {
    $array=array();
    if ($search != 0)
    $array["find"]=$search;
    if ($name != 0)
    $array["name"]=$name;
    if($direccion != 0)
    $array["direccion"]=$direccion;
      
    $urlarray = $this->uri->uri_to_assoc(2);
    
    $limit = 40;
    $inicio=0;
     if (isset($urlarray["page"]) && $urlarray["page"]!= '')
      $inicio=$urlarray["page"];
       
    
    $sql="select distinct c.* from clientes c, phones t 
          where c.id=t.clienteid "; 
    if ($search)
        $sql.=" and t.phone='".$search."' "; 
    if ($name)
        $sql.=" and c.name like '%".$name."%' ";
    if ($direccion)
        $sql.=" and c.calle like '%".$direccion."%' ";              
    $sql .=" order by c.name";      
             
    //$sql_aux=$sql; 
          
    // $sql .=" limit $inicio,$limit";
    
    $query=$this->db->query($sql);
    $clientes=$query->result(); 
    $data["clientes"]= $clientes;
    
    /*$query=$this->db->query($sql_aux);
    
    $config['base_url'] = site_url()."clientes/search/".$this->uri->assoc_to_uri($array)."/page/";
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
    $this->pagination->initialize($config); */
    
    $listado_id='';
    $coma='';
    foreach($clientes as $c)
    {  $listado_id .=$coma.$c->id;
       $coma=",";
     } 
    
    if ($listado_id !='')
    {
    $sql="SELECT t.*
                  FROM phones t, clientes c
                  WHERE t.clienteid = c.id
                  and t.principal=1
                  AND t.clienteid
                  IN ( $listado_id)";
    
    $query=$this->db->query($sql);
    
    $data["phones"]=$query->result();
    }
    $data["search"]=$search;
    if ($name)
    $data["name"]=$name;
    if ($direccion)
    $data["dir"]=$direccion;
    $data["content"]="cliente_viewlist";
    $this->load->view("index",$data);
    }
    else
     show_404();
   
   }
   //solo activo si no fue borrado
   public function active ()
   {
    if ( $this->Current_User->isHabilitado("DEL_CLIENT") )
    {
   
   $id = $this->db->escape_str($this->uri->segment(3));
   if ($id)
   {
     $record=array(
     "active"=>1
     );
     $this->db->where("id",$id);
      $this->db->where("borrado",0);
     $this->db->update("clientes",$record);
   
   }
   
    redirect("cliente/index/".$this->uri->segment(4));
    }
    else
       redirect("inicio/denied");
   }
   
   public function noactive()
   {
    if ( $this->Current_User->isHabilitado("DEL_CLIENT") )
    {
       $id = $this->db->escape_str($this->uri->segment(3));
       if ($id)
       {
         $record=array(
         "active"=>0
         );
         $this->db->where("id",$id);
         $this->db->update("clientes",$record);
         
   
        }
   
       redirect("cliente/index/".$this->uri->segment(4));
    }
    else   
         redirect("inicio/denied");
   }
  
  public function noctacte()
   {
     if ( $this->Current_User->isHabilitado("HABILITAR_CTACTE") )
    {
     $id = $this->db->escape_str($this->uri->segment(3));
     if ($id)
     {
       $record=array(
       "ctacte"=>'n'
       );
       $this->db->where("id",$id);
       $this->db->update("clientes",$record);
    }
     
      redirect("cliente/index/".$this->uri->segment(4));
    }
    else
      redirect("inicio/denied");
   
   }
   //TODO:ver como manejar el tema de que solo usa ctacte 
   //podria tener un flag extra de solo ctacte
   public function ctacte()
   {
    
    if ( $this->Current_User->isHabilitado("HABILITAR_CTACTE") )
    { 
     $id = $this->db->escape_str($this->uri->segment(3));
     if ($id)
     {
       $record=array(
       "ctacte"=>'s',
       "autorizactacte"=>$this->Current_User->getUsername()
       );
       $this->db->where("id",$id);
       $this->db->update("clientes",$record);
   
   }
   
    redirect("cliente/index/".$this->uri->segment(4));
    }
    else
      redirect("inicio/denied");
    
   
   }
  //al borrar desactivo el cliente con lo cual no podra realizar viajes
   public function del()
   {
   if ( $this->Current_User->isHabilitado("DEL_CLIENT") )
    {
   $id = $this->db->escape_str($this->uri->segment(3));
    if ($id)
    {
      
      $record=array(
       'borrado'=>1,
       'active'=>0,
       'delete_by'=>$this->Current_User->getUsername(),
       'fecha_delete'=>date("Ymd")
      );
      
      $this->db->where("id",$id);
      $this->db->update("clientes",$record);
    }
    redirect('cliente/index/'.$this->uri->segment(4));
    }
    else
     redirect("inicio/denied");
   }
   //poder recuperar los datos del cliente una vez borrado
   //siempre que tenga el permiso de borrarlo
    public function undel()
   {
   if ( $this->Current_User->isHabilitado("DEL_CLIENT") )
    {
   $id = $this->db->escape_str($this->uri->segment(3));
    if ($id)
    {
      
      $record=array(
       'borrado'=>0,
       'active'=>1
      );
      
      $this->db->where("id",$id);
      $this->db->update("clientes",$record);
    }
    redirect('cliente/index/'.$this->uri->segment(4));
    }
    else
     redirect("inicio/denied");
   }
   
   //agregar clientes desde la reserva
   public function reservaadd()
   {
    if ( $this->Current_User->isHabilitado("ADD_CLIENT") )
    { 
      $tel=$this->uri->segment(3);
      $data["tel"]=$tel;
      $query=$this->db->get_where("iva");
      $data["iva"]= $query->result();
      $this->db->order_by("name");
      $query=$this->db->get_where("regiones");
      $data["provincias"]=$query->result();
      $this->db->order_by("name");
      $query=$this->db->get_where("cities",array("regionid"=>$this->config->item("provincia")));
      $data["localidades"]=$query->result();
      
     
      $this->load->view("cliente_addnew",$data);
   }
   else
        redirect("inicio/denied"); 
   }
   
   public function add()
   {
     if ( $this->Current_User->isHabilitado("ADD_CLIENT") )
    {
      $query=$this->db->get_where("iva");
      $data["iva"]= $query->result();
      $this->db->order_by("name");
      $query=$this->db->get_where("regiones");
      $data["provincias"]=$query->result();
      $this->db->order_by("name");
      $query=$this->db->get_where("cities",array("regionid"=>$this->config->item("provincia")));
      $data["localidades"]=$query->result();
      
      $data["content"]="cliente_viewadd";
      $this->load->view("index",$data);
     }
     else
        redirect("inicio/denied"); 
   }
   
   public function addnew()
   {
       if ($this->_submit_validateCliente() === FALSE) {
          if ($this->input->post("popup") == 1)
            $this->reservaadd();
          else 
            $this->add();
          
          return;
       }
       else
       {
        $show=0;
        if ($this->input->post("showbanner"))
          $show=1;
          
         $record=array(
          'name'=>$this->input->post("name"),
          'provincia'=>$this->db->escape_str($this->input->post("provincia")),
          'localidad'=>$this->db->escape_str($this->input->post("localidad")),
          'calle'=>$this->input->post("calle"),
          'numero'=>$this->db->escape_str($this->input->post("altura")),
          'piso'=>$this->db->escape_str($this->input->post("piso")),
          'dpto'=>$this->db->escape_str($this->input->post("dpto")),
          'email'=>$this->input->post("email"),
          'entrecalle1'=>$this->input->post("entrecalle1"),
          'entrecalle2'=>$this->input->post("entrecalle2"),
          'observaciones'=>$this->input->post("observacion"),
          'cuit'=>$this->db->escape_str($this->input->post("cuit")),
          'iva_tipo'=>$this->db->escape_str($this->input->post("iva")),
          'fecha_ingreso'=>date("Ymd"),
          'created_by'=>$this->Current_User->getUsername(),
          'ctacte'=>0, //por default no esta autorizada
          'active'=>1,
          'mensaje'=>$this->input->post("mensaje"),
          'banner'=>$this->input->post("banner"),
          'show_banner'=>$show,
          'comision'=>$this->input->post("comision")
         );
         $record["address"]=$record["calle"]." ".$record["numero"]." ".$record["piso"]." ".$record["dpto"];
         $record["entrecalles"]=$record["entrecalle1"]." y ".$record["entrecalle2"];
         $this->db->insert("clientes",$record);
         $clienteid=$this->db->insert_id();
         $this->addPhone($clienteid);
         if ($this->input->post("popup") == 1)
            redirect("cliente/addSuccess/1");
         else  
            redirect("cliente/addSuccess");
       }
       
   }
   
   
   public function addPhone($clienteid)
   {
        $record=array();
        $record["clienteid"]=$clienteid;
        $record["phone"]=$this->input->post("telefono");
        $record["principal"]=1;
        $this->db->insert("phones",$record);
        
        for($i=1;$i<6;$i++)
        {
          $phone="phone".$i;
          if ($this->input->post($phone))
          {
            $record["clienteid"]=$clienteid;
            $record["phone"]=$this->input->post($phone);
            $record["principal"]=0;
            $this->db->insert("phones",$record);
          }
        }
        
   
   }
   
  
   
   public function addSuccess()
   {
      $data["content"]="success";
      $data["message"]=$this->lang->line("message_success_add_cliente");
      $data["url_back"]=site_url()."cliente";
      if ($this->uri->segment(3))
           $data["popup"]=$this->uri->segment(3);
      $this->load->view("index",$data);
   }
   
   public function _submit_validateCliente()
   {
     $this->form_validation->set_rules('telefono', $this->lang->line('title_telefono'),'trim|required|max_lenght[8]|callback_notExistPhone');
     $this->form_validation->set_rules('name', $this->lang->line('title_name'),'trim|required|max_lenght[250]');
     $this->form_validation->set_rules('calle', $this->lang->line('title_street'),'trim|required|max_lenght[200]');
     $this->form_validation->set_rules('altura', $this->lang->line('title_altura'),'trim|required|max_lenght[10]');
     $this->form_validation->set_rules('provincia', $this->lang->line('title_provincia'),'trim|required|is_natural_no_zero');
     $this->form_validation->set_rules('localidad', $this->lang->line('title_localidad'),'trim|required|is_natural_no_zero');
     $this->form_validation->set_rules('piso', $this->lang->line('title_piso'),'trim|max_lenght[50]');
     $this->form_validation->set_rules('dpto', $this->lang->line('title_dpto'),'trim|max_lenght[50]');
     $this->form_validation->set_rules('entrecalle1', $this->lang->line('title_entrecalle1'),'trim|max_lenght[250]');
     $this->form_validation->set_rules('entrecalle2', $this->lang->line('title_entrecalle2'),'trim|max_lenght[250]');
     $this->form_validation->set_rules('email', $this->lang->line('title_email'),'trim|max_lenght[250]|valid_email');
     $this->form_validation->set_rules('cuit', $this->lang->line('title_cuit'),'trim|max_lenght[50]');
     $this->form_validation->set_rules('iva', $this->lang->line('title_iva'),'trim');
     $this->form_validation->set_rules('mensaje', $this->lang->line('title_mensaje'),'trim|max_lenght[250]');
     $this->form_validation->set_rules('observacion', $this->lang->line('title_observacion'),'trim');
     $this->form_validation->set_rules('phone1', $this->lang->line('title_telefono'),'trim|max_lenght[8]');
     $this->form_validation->set_rules('phone2', $this->lang->line('title_telefono'),'trim|max_lenght[8]');
     $this->form_validation->set_rules('phone3', $this->lang->line('title_telefono'),'trim|max_lenght[8]');
     $this->form_validation->set_rules('phone4', $this->lang->line('title_telefono'),'trim|max_lenght[8]');
     $this->form_validation->set_rules('phone5', $this->lang->line('title_telefono'),'trim|max_lenght[8]');
     
     $this->form_validation->set_message('notExistPhone',$this->lang->line("error_exist_phone"));
     
      return $this->form_validation->run();
   
   }
   //me debo que no exista otro cliente con el mismo telefono principal 
   public function notExistPhone()
   {
   
     $this->db->where("phone",$this->db->escape_str($this->input->post('telefono')));
     $this->db->where("principal",1);
     $query=$this->db->get("phones");
     
     if ( count($query->result()) == 0)
	     
          return true;
	    
	    else
          return false;
   
   
   }
   
   public function notExistClientPhone()
   {
   
     $this->db->where("phone",$this->db->escape_str($this->input->post('telefono')));
     $this->db->where("principal",1);
     $this->db->where("clienteid !=",$this->uri->segment(3));
     $query=$this->db->get("phones");
     
     if ( count($query->result()) == 0)
	     
          return true;
	    
	    else
          return false;
   
   
   }

   public function validPassword(){
   		$deudor = $this->input->post("deudor");
   		$original = $this->input->post("deudor_value");
   		$pass = $this->input->post("pass");
   		if ($deudor != $original){
			return Current_User::login( $this->Current_User->getUsername(),$pass);
   		}else{
   			return true;
   		}
   }
   
   public function _submit_validateModCliente()
   {
     $this->form_validation->set_rules('telefono', $this->lang->line('title_telefono'),'trim|required|max_lenght[8]|callback_notExistClientPhone');
     $this->form_validation->set_rules('name', $this->lang->line('title_name'),'trim|required|max_lenght[250]');
     $this->form_validation->set_rules('calle', $this->lang->line('title_street'),'trim|required|max_lenght[200]');
     $this->form_validation->set_rules('altura', $this->lang->line('title_altura'),'trim|required|max_lenght[10]');
     $this->form_validation->set_rules('provincia', $this->lang->line('title_provincia'),'trim|required|is_natural_no_zero');
     $this->form_validation->set_rules('localidad', $this->lang->line('title_localidad'),'trim|required|is_natural_no_zero');
     $this->form_validation->set_rules('piso', $this->lang->line('title_piso'),'trim|max_lenght[50]');
     $this->form_validation->set_rules('dpto', $this->lang->line('title_dpto'),'trim|max_lenght[50]');
     $this->form_validation->set_rules('entrecalle1', $this->lang->line('title_entrecalle1'),'trim|max_lenght[250]');
     $this->form_validation->set_rules('entrecalle2', $this->lang->line('title_entrecalle2'),'trim|max_lenght[250]');
     $this->form_validation->set_rules('email', $this->lang->line('title_email'),'trim|max_lenght[250]|valid_email');
     $this->form_validation->set_rules('cuit', $this->lang->line('title_cuit'),'trim|max_lenght[50]');
     $this->form_validation->set_rules('iva', $this->lang->line('title_iva'),'trim');
     $this->form_validation->set_rules('mensaje', $this->lang->line('title_mensaje'),'trim|max_lenght[250]');
     $this->form_validation->set_rules('observacion', $this->lang->line('title_observacion'),'trim');
     $this->form_validation->set_rules('phone1', $this->lang->line('title_telefono'),'trim|max_lenght[8]');
     $this->form_validation->set_rules('phone2', $this->lang->line('title_telefono'),'trim|max_lenght[8]');
     $this->form_validation->set_rules('phone3', $this->lang->line('title_telefono'),'trim|max_lenght[8]');
     $this->form_validation->set_rules('phone4', $this->lang->line('title_telefono'),'trim|max_lenght[8]');
     $this->form_validation->set_rules('phone5', $this->lang->line('title_telefono'),'trim|max_lenght[8]');
     $this->form_validation->set_rules('deudor', $this->lang->line('title_bannerdeudor'),'trim|callback_validPassword');
      
      $this->form_validation->set_message('notExistClientPhone',$this->lang->line("error_exist_phone"));
      $this->form_validation->set_message('validPassword',"El password no es válido");
      return $this->form_validation->run();
   
   }
   
   public function lock($id)
   {
      $this->db->trans_start();
      $query=$this->db->get_where("clientes",array("id"=>$id));
      $cliente=$query->result();
      $lockeo=false;
      if (isset( $cliente[0]) && $cliente[0]->bloqueado == 0)
      {
         $record=array(
          'bloqueado'=>1,
          'bloqueado_by'=>$this->Current_User->getUsername()
         );
         $this->db->update("clientes",$record,array("id"=>$id));
         $lockeo=true;
      }
      else{ //si soy yo el que lo lockeo me debe permitir ingresar
        if (isset($cliente[0]) && $cliente[0]->bloqueado == 1 && $cliente[0]->bloqueado_by == $this->Current_User->getUsername())
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
      $query=$this->db->get_where("clientes",array("id"=>$id));
      $cliente=$query->result();
      
      if (isset( $cliente[0]) && $cliente[0]->bloqueado == 1)
      {
         $record=array(
          'bloqueado'=>0,
          'bloqueado_by'=>''
         );
         $this->db->update("clientes",$record,array("id"=>$id));
       
      }
      $this->db->trans_complete();
     }
      redirect('cliente/index/'.$this->uri->segment(4));
   }
	    
	   
   
   public function mod()
   {
    if ( $this->Current_User->isHabilitado("MOD_CLIENT") )
   {
   $id = $this->db->escape_str($this->uri->segment(3));
    if ($id)
    { //si puedo bloquearlo entro sino no puedo entrar
      if ( $this->lock($id) )
      {
          $query=$this->db->get_where("clientes",array("id"=>$id));
          $cliente=$query->result();
          $data["cliente"]=$cliente; 
          $this->db->order_by("id"); 
          
          $query=$this->db->get_where("phones",array("clienteid"=>$id,"principal"=>1));
          $phones=$query->result();
          $data["phone_principal"]=$phones;
          
          $query=$this->db->get_where("phones",array("clienteid"=>$id,"principal"=>0));
          $phones=$query->result();
          $data["phones"]=$phones;
          
          $query=$this->db->get_where("iva");
          $data["iva"]= $query->result();
          
          $this->db->order_by("name");
          $query=$this->db->get_where("regiones");
          $data["provincias"]=$query->result();
          
          $this->db->order_by("name");
          $query=$this->db->get_where("cities",array("regionid"=>$cliente[0]->provincia));
          $data["localidades"]=$query->result();
          
          $data["dir_desbloquea"]=site_url()."cliente/unlock/".$id;
          $data["content"]="cliente_viewmod";
          $this->load->view("index",$data);
      }
      else
      {  
          $data["content"]="lockeado";
          $data["message"]=$this->lang->line("client_lockeado");
          $this->load->view("index",$data);
      }   
    }
    else
       redirect('cliente/index/'.$this->uri->segment(4));
       
    }
    else
        redirect("inicio/denied");    
   }
  
   
   public function update()
   {
    $id=$this->db->escape_str($this->uri->segment(3));
    if ($id)
    {
       if ($this->_submit_validateModCliente() === FALSE) {
            $this->mod();
            return;
       }
       else
       {
       
       $record=array();
       
        $record['name']=$this->input->post('name');
        $record['provincia']=$this->db->escape_str($this->input->post("provincia"));
        $record['localidad']=$this->db->escape_str($this->input->post("localidad"));
        $record['calle']=$this->input->post("calle");
        $record['numero']=$this->db->escape_str($this->input->post("altura"));
        $record['piso']=$this->db->escape_str($this->input->post("piso"));
        $record['dpto']=$this->db->escape_str($this->input->post("dpto"));
        $record['email']=$this->input->post("email");
        $record['entrecalle1']=$this->input->post("entrecalle1");
        $record['entrecalle2']=$this->input->post("entrecalle2");
        $record['observaciones']=$this->input->post("observacion");
        $record['cuit']=$this->db->escape_str($this->input->post("cuit"));
        $record['iva_tipo']=$this->db->escape_str($this->input->post("iva"));
        $record['mensaje']=$this->input->post("mensaje");
        $record["address"]=$record["calle"]." ".$record["numero"]." ".$record["piso"]." ".$record["dpto"];
        $record["entrecalles"]=$record["entrecalle1"]." y ".$record["entrecalle2"];
        $record["banner"]=$this->input->post("banner");
        $record["comision"]=$this->input->post("comision") ? $this->input->post("comision") : 0;
        $show=0;
        if ($this->input->post("showbanner"))
          $show=1;
        $record["show_banner"]=$show;
        $record["deudor"]=$this->input->post("deudor");
        $record["bloqueado"]=0;
        $record["bloqueado_by"]='';   
       
       $this->db->where("id",$id);
       $this->db->update("clientes",$record);
       $this->modPhones($id);
       
       redirect("cliente/index/".$this->uri->segment(4));
       }  
    }
    else
      redirect("cliente/index/".$this->uri->segment(4)); 
   }
   
   public function modPhones($clienteid)
   {
      //telefono principal
       
       $query = $this->db->get_where("phones",array("principal"=>1,"clienteid"=>$clienteid));
       $t=$query->result();
       $telefono=$this->input->post("telefono");
       if ($t[0]->phone != $telefono)
       {
         $record=array();
         $record["phone"]=$telefono;
         $this->db->where("clienteid",$clienteid);
         $this->db->where("principal",1);
         $this->db->update("phones",$record);
      }
      
    $query = $this->db->get_where("phones",array("principal"=>0,"clienteid"=>$clienteid));
    $phones = $query->result();//obtengo los telefonos del cliente no principales
    $exist_phones=array();
    foreach($phones as $row)
    {
      $exist_phones[]=$row->phone;
    }
    
    $new_phones=array();
    //me fijo cuales me pasaron
    foreach( $_POST as $key=>$value)
    {
         if (preg_match('/phone[0-9]*/',$key))
         { 
           $new_phones[]=$value;
           
         }
    }
    
    //deben quedar las new_phones - si esta en exist_phones -> la quito de los dos arrays
    //                            - si no esta en exist_phones -> la debo inserta y quito de exist_phones
    //                            - las que quedan en exist_phones las debo borrar
    // new_phones quedan las que debo insertar  
    $i=0;
    foreach($new_phones as $new)
    {  $j=0;
      foreach($exist_phones as $exist)
      {
        if ($new == $exist)
        { $new_phones[$i]=0;
          $exist_phones[$j]=0; 
        }
        $j++; 
      } 
      $i++;
    }  
    
    foreach($new_phones as $new)
    {
      if($new != 0)
      {
        $record=array(
        'principal'=>0,
        'clienteid'=>$clienteid,
        'phone'=>$new
       );
       $this->db->insert("phones",$record);
      }
    }
    
    foreach($exist_phones as $exist)
    {
       if($exist != 0)
       {
        $this->db->where("clienteid",$clienteid);
        $this->db->where("phone",$exist);
        $this->db->delete("phones");
       }
    }
      
   
   }
   
   public function info()
   {
     $tel=$this->uri->segment(3);
     //se busca por telefono 
     $sql="select c.* from clientes c, phones t where t.clienteid = c.id  and t.phone='$tel'";
     $query=$this->db->query($sql);
     $cliente=$query->result();
     if (count($cliente) == 0)
      echo "no_exist"; 
     else
      {
        if ($cliente[0]->active == 0){
          echo "client_no_active";
        }
        elseif ($cliente[0]->borrado == 1){
            echo "client_borrado";
        }
        elseif ($cliente[0]->deudor == 1){
        	echo "client_deudor";
        }
     	else{
             echo json_encode($cliente);
     	}
      }
   
   }
  
}

?>

<?php

class Chofer extends Controller {

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
    /*$limit = 20;
    $inicio=0;
    if ($this->uri->segment(3))
      $inicio = $this->uri->segment(3);*/
    
    
    
    $sql="select c.*, m.movil,m.observacion_movil, 
          m.marca,m.exmovil  
          from choferes c, movil m, movil_chofer mc where 
          c.id = mc.choferid and m.movil != -1 "; 
          
    $sql.= " and m.id = mc.movilid  order by m.movil";
     
    $query=$this->db->query($sql);
    
    $choferes=$query->result();  
    
    $sql="select c.*, m.movil,m.observacion_movil, 
          m.marca,m.exmovil  
          from choferes c, movil m, movil_chofer mc where 
          c.id = mc.choferid and m.movil = -1 "; 
          
    $sql.= " and m.id = mc.movilid  order by m.movil";
    $query=$this->db->query($sql);
    
    foreach($query->result() as $c)
      $choferes[]=$c;
    
    $data["choferes"]=$choferes;
    /*$config['base_url'] = site_url()."chofer/index";
    $config['total_rows'] = $this->db->count_all('choferes');
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
    */
    
    
    
    $data["content"]="chofer_viewlist";
    $this->load->view("index",$data);
   
   }
   
    public function search()
   {
   
   $urlarray = $this->uri->uri_to_assoc(2);
   $search='';
   $name='';
   $patente='';
    if ($this->input->post("searchfield"))
       $search=$this->db->escape_str($this->input->post("searchfield"));
    else
    {   if (isset($urlarray["find"])) 
          $search=$this->db->escape_str($urlarray["find"]);
        else
          $search=0;
    
    } 
    
    if ($this->input->post("name"))
       $name=$this->db->escape_str($this->input->post("name"));
    else
    {   if (isset($urlarray["name"])) 
          $name=$this->db->escape_str($urlarray["name"]);
        else
          $name=0;
    
    }
    
    if ($this->input->post("patente"))
       $patente=$this->db->escape_str($this->input->post("patente"));
    else
    {   if (isset($urlarray["patente"])) 
          $patente=$this->db->escape_str($urlarray["patente"]);
        else
          $patente=0;
    
    }
    
    if ($search || $name || $patente )
    {
    
    $limit = 20;
    $inicio=0;
    
    if (isset($urlarray["page"]) && $urlarray["page"]!= '')
      $inicio=$urlarray["page"];
    $urlarray = $this->uri->uri_to_assoc(2);
    
    if ($search)
    {
    $array=array("find"=>$search);  
    
    $sql="select c.*, m.movil,m.observacion_movil, m.marca, m.exmovil  from choferes c, movil m, movil_chofer mc where 
          c.id = mc.choferid and m.id = mc.movilid 
          and m.movil=$search order by m.movil";
    }
    if ($name)
    {
    $array=array("name"=>$name);  
    
    $sql="select c.*, m.movil,m.observacion_movil, m.marca, m.exmovil  from choferes c, movil m, movil_chofer mc where 
          c.id = mc.choferid and m.id = mc.movilid 
          and c.name like '%".$name."' order by m.movil";
    
    }
    
    if ($patente)
    {
    $array=array("patente"=>$name);  
    
    $sql="select c.*, m.movil,m.observacion_movil, m.marca, m.exmovil  from choferes c, movil m, movil_chofer mc where 
          c.id = mc.choferid and m.id = mc.movilid 
          and m.patente like '%".$patente."' order by m.movil";
    
    }
          
    $sql_aux=$sql; 
          
     $sql .=" limit $inicio,$limit";
     
    $query=$this->db->query($sql);
    
    $data["choferes"]=$query->result();  
    
    $query=$this->db->query($sql_aux);
    
    $config['base_url'] = site_url()."chofer/search/".$this->uri->assoc_to_uri($array)."/page/";
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
    
    
    $data["content"]="chofer_viewlist";
    $data["search"]=$search;
    $data["patente"]=$patente;
    $data["name"]=$name;
    $this->load->view("index",$data);
    }
    else
     redirect("chofer");
   
   }
   
   public function active ()
   {
    if ( $this->Current_User->isHabilitado("DEL_MOVIL") )
    {
         $id = $this->db->escape_str($this->uri->segment(3));
         if ($id)
         {
           $record=array(
           "active"=>1
           );
           $this->db->where("id",$id);
           $this->db->where("borrado",0);
           $this->db->update("choferes",$record);
           
            $sql="select m.* from movil m, movil_chofer mc where m.id = mc.movilid
                  and mc.choferid = $id
            ";
            $query=$this->db->query($sql);
            $movil=$query->result();
            if (isset($movil[0]))
            {
            $record_movil=array();
            $record_movil["active"]=1;
            $record_movil["baseid"]=-2;
            $record_movil["ordenbase"]=0;
            $this->db->where("id",$movil[0]->id);
            $this->db->update("movil",$record_movil);
           }
         
         }
         
          redirect("chofer/index/".$this->uri->segment(4));
     }
     else
          redirect("inicio/denied");
   }
   
   public function noactive()
   {
   if ( $this->Current_User->isHabilitado("DEL_MOVIL") )
    {
       $id = $this->db->escape_str($this->uri->segment(3));
       if ($id)
       {
         $record=array(
         "active"=>0
         );
         $this->db->where("id",$id);
         $this->db->update("choferes",$record);
         
         $sql="select m.* from movil m, movil_chofer mc where m.id = mc.movilid
                  and mc.choferid = $id
            ";
            $query=$this->db->query($sql);
            $movil=$query->result();
            if (isset($movil[0]))
            {
            
            $record_movil=array();
            $record_movil["active"]=0;
            $record_movil["baseid"]=-2;
            $record_movil["ordenbase"]=0;
            $this->db->where("id",$movil[0]->id);
            $this->db->update("movil",$record_movil);
            if ($movil[0]->baseid > 0)
                $this->flete->ordenamiento($movil[0]->baseid);
           }
         
       
       }
       
        redirect("chofer/index/".$this->uri->segment(4));
    }
    else
       redirect("inicio/denied");
   }
  
   public function del()
   {
    if ( $this->Current_User->isHabilitado("DEL_MOVIL") )
    {
   
         //no se debe borrar debe quedar el historial
         //asi que el chofer queda borrado ->flag 
         // y el movil se llena el exmovil y se le asigna movil=0
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
            $this->db->update("choferes",$record);
            
            $sql="select m.* from movil m, movil_chofer mc where m.id = mc.movilid
                  and mc.choferid = $id
            ";
            $query=$this->db->query($sql);
            $movil=$query->result();
            $array=array(
            'exmovil'=>$movil[0]->movil,
            'movil'=>-1,
            'baseid'=>-2,
            'ordenbase'=>0,
            'active'=>0
            );
            $this->db->where("id",$movil[0]->id);
            $this->db->update("movil",$array);
            if ($movil[0]->baseid > 0)
                $this->flete->ordenamiento($movil[0]->baseid);
          }
          redirect('chofer/index/'.$this->uri->segment(4));
     }
     else
           redirect("inicio/denied");
   }
   
   
   public function reactivar()
   {
   
   if ( $this->Current_User->isHabilitado("REACTIVAR_MOVIL") )
    {
         $id = $this->db->escape_str($this->uri->segment(3));
         $movil = $this->db->escape_str($this->uri->segment(4));
          if ($id && $movil)
          {
           
           $query=$this->db->get_where("movil",array("movil"=>$movil));
           $exist=$query->result();
           if (count($exist) == 0)
           {
            
             $record=array(
             'borrado'=>0,
             'active'=>1,
             'delete_by'=>'',
             'fecha_delete'=>'',
            
            );         
           
            $this->db->update("choferes",$record,array("id"=>$id));
            
            $query=$this->db->get_where("movil_chofer",array("choferid"=>$id));
            $mc=$query->result();
            $m=array(
             'movil'=>$movil,
             'exmovil'=>0,
             'baseid'=>-2,
             'ordenbase'=>0,
             'active'=>1
            );
            
            $this->db->where("id",$mc[0]->movilid);
            $this->db->update("movil",$m);
             $data["message"]=$this->lang->line("movil_reactivado");
             $data["content"]="noaccess";
             $this->load->view("index",$data);
            
          }
          else
          {
             $data["message"]=$this->lang->line("exist_movil_reactivar");
             $data["content"]="noaccess";
             $this->load->view("index",$data);
               
          }
          
          }
          else
            redirect('chofer');
    
    }
   
    else
           redirect("inicio/denied");
   }
   
   public function add()
   {
     if ( $this->Current_User->isHabilitado("ADD_MOVIL") )
    {  
      
      $this->db->order_by("id");
      $query=$this->db->get("tipodoc");
      $data["tipodoc"]=$query->result();
      $this->db->order_by("name");
      $query=$this->db->get("regiones");
      $data["provincias"]=$query->result();
      //tomo a capital como region por default en todo
      $this->db->order_by("name");
      $query=$this->db->get_where("cities",array("regionid"=>$this->config->item("provincia")));
      $data["localidades"]=$query->result();
      
      
      
      $this->db->order_by("id");
      $query=$this->db->get("meses");
      $data["meses"]=$query->result();
      $data["content"]="chofer_viewadd";
      $query=$this->db->get("categorias");
      $data["categorias"]=$query->result();
      $this->load->view("index",$data);
     }
     else
        redirect("inicio/denied");  
   }
  
   public function addnew()
   {
       if ($this->_submit_validateChofer() === FALSE || $this->_submit_validateMovil() === FALSE ) {
            $this->add();
            return;
       }
       else
       {
         $record=array(
          'name'=>$this->input->post("name"),
          'lastname'=>$this->input->post("lastname"),
          'tipo_doc'=>$this->db->escape_str($this->input->post("tipodoc")),
          'nro_doc'=>$this->db->escape_str($this->input->post("nrodoc")),
          'comision'=>$this->db->escape_str($this->input->post("comefvo")),
          'comisionctacte'=>$this->db->escape_str($this->input->post("comctacte")),
          
          'active'=>1,
          'fecha_ingreso'=>date("Ymd"),
          'created_by'=>$this->Current_User->getUsername()
          
         );
         $fecha_nac=$this->input->post("fecnac_year").str_pad($this->input->post("fecnac_month"),2,"0",STR_PAD_LEFT).str_pad($this->input->post("fecnac_day"),2,"0",STR_PAD_LEFT);
         $record["fecha_nac"]=$this->db->escape_str($fecha_nac);
         
         $record["localidad"]=$this->db->escape_str($this->input->post("localidad"));
         $record["provincia"]=$this->db->escape_str($this->input->post("provincia"));
         $record["telefono"]=$this->db->escape_str($this->input->post("telefono"));
         $record["celular"]=$this->db->escape_str($this->input->post("celular"));
         $record["radio"]=$this->db->escape_str($this->input->post("radio"));
         $record["observacion"]=$this->input->post("observacion");
         $record["nroregistro"]=$this->db->escape_str($this->input->post("nroregistro"));
         $fecha_venceregistro=$this->input->post("venceregistro_year").str_pad($this->input->post("venceregistro_month"),2,"0",STR_PAD_LEFT).str_pad($this->input->post("venceregistro_day"),2,"0",STR_PAD_LEFT);
         $record["vence_registro"]=$this->db->escape_str($fecha_venceregistro);
         $record["referente"]=$this->input->post("referente");
         $record["calle"]=$this->input->post("calle");
         $record["altura"]=$this->db->escape_str($this->input->post("altura"));
         $record["piso"]=$this->db->escape_str($this->input->post("piso"));
         $record["dpto"]=$this->db->escape_str($this->input->post("dpto"));
         $record["address"]=$record["calle"]." ".$record["altura"]." ".$record["piso"]." ".$record["dpto"];
         $record["email"]=$this->input->post("email");
        
         if ($this->input->post("foto4x4"))
            $record["foto4x4"]="s";
         if ($this->input->post("fotoregistro"))
            $record["fotoregistro"]="s";
         
         
         $this->db->insert("choferes",$record);
         $choferid=$this->db->insert_id();
         $this->addmovil($choferid);
         redirect("chofer/addSuccess");
       }
        redirect("chofer"); 
   }
   
   public function addmovil($choferid)
   {
         $record=array(
          'movil'=>$this->db->escape_str($this->input->post("movil")),
          'patente'=>$this->input->post("patente"),
          'active'=>1,
          'created_by'=>$this->Current_User->getUsername(),
          'date_created'=>date("Ymd"),
          'medidas'=>$this->input->post("medidas"),
          'factura'=>$this->input->post("factura"),
          'marca'=>$this->input->post("marca"),
          'seguro'=>$this->input->post("nroseguro"),
          'company'=>$this->input->post("company"),
          'categoriaid'=>$this->db->escape_str($this->input->post("categoria")),
          'observacion_movil'=>$this->input->post("observacion2")
          
         
         );
          if ($this->input->post("propio"))
            $record["propio"]='s';  
         $fecha_vseguro=$this->input->post("venceseguro_year").str_pad($this->input->post("venceseguro_month"),2,"0",STR_PAD_LEFT).str_pad($this->input->post("venceseguro_day"),2,"0",STR_PAD_LEFT);
         $record["vence_seguro"]=$fecha_vseguro;
         $fecha_vruta=$this->input->post("venceruta_year").str_pad($this->input->post("venceruta_month"),2,"0",STR_PAD_LEFT).str_pad($this->input->post("venceruta_day"),2,"0",STR_PAD_LEFT);
         $record["vence_ruta"]=$fecha_vruta;
         $fecha_vsacta=$this->input->post("vencesacta_year").str_pad($this->input->post("vencesacta_month"),2,"0",STR_PAD_LEFT).str_pad($this->input->post("vencesacta_day"),2,"0",STR_PAD_LEFT);
         $record["vence_sacta"]=$fecha_vsacta;
         $fecha_vtv=$this->input->post("vencevtv_year").str_pad($this->input->post("vencevtv_month"),2,"0",STR_PAD_LEFT).str_pad($this->input->post("vencevtv_day"),2,"0",STR_PAD_LEFT);
         $record["vence_vtv"]=$fecha_vtv;
         $fecha_moyano=$this->input->post("vencemoy_year").str_pad($this->input->post("vencemoy_month"),2,"0",STR_PAD_LEFT).str_pad($this->input->post("vencemoy_day"),2,"0",STR_PAD_LEFT);
         $record["vence_moyano"]=$fecha_moyano;
         if ($this->input->post("fotocedula"))
            $record["fotocedula"]="s";
         if ($this->input->post("fototarjeta"))
            $record["fototarjeta"]="s"; 
         if ($this->input->post("fototitulo"))
            $record["fototitulo"]="s";   
          if ($this->input->post("fotoseguro"))
            $record["fotoseguro"]="s";  
            
         $this->db->insert("movil",$record);
         $movilid=$this->db->insert_id();
         
         $movil=array(
         'movilid'=>$movilid,
         'choferid'=>$choferid
         );
         
         $this->db->insert("movil_chofer",$movil);   
   }
   
   public function addSuccess()
   {
      $data["content"]="success";
      $data["message"]=$this->lang->line("message_success_add_chofer");
      $data["url_back"]=site_url()."chofer";
      $this->load->view("index",$data);
   }
   // ver que el chofer no este ya dado de alta
   public function _submit_validateChofer()
   {
     $this->form_validation->set_rules('name', $this->lang->line('title_name'),'trim|required|max_lenght[200]');
     $this->form_validation->set_rules('lastname', $this->lang->line('title_lastname'),'trim|required|max_lenght[200]');
     $this->form_validation->set_rules('tipodoc', $this->lang->line('title_tipodoc'),'trim|required');
     $this->form_validation->set_rules('nrodoc', $this->lang->line('title_nrodoc'),'trim|required|max_lenght[20]|callback_existDocumento');
     $this->form_validation->set_rules('comefvo', $this->lang->line('title_comisionefvo'),'trim|required|max_lenght[10]');
     $this->form_validation->set_rules('comctacte', $this->lang->line('title_comisionctacte'),'trim|required|max_lenght[10]');
     $this->form_validation->set_rules('fecnac_day', $this->lang->line('fecnac_day'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('fecnac_month', $this->lang->line('fecnac_month'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('fecnac_year', $this->lang->line('fecnac_year'),'trim|required|max_lenght[4]');
     $this->form_validation->set_rules('provincia', $this->lang->line('title_provincia'),'trim|required|is_natural_no_zero');
     $this->form_validation->set_rules('localidad', $this->lang->line('title_localidad'),'trim|required|is_natural_no_zero');
     $this->form_validation->set_rules('calle', $this->lang->line('title_street'),'trim|required|max_lenght[250]');
     $this->form_validation->set_rules('altura', $this->lang->line('title_altura'),'trim|required|max_lenght[10]');
     $this->form_validation->set_rules('piso', $this->lang->line('title_piso'),'trim|max_lenght[50]');
     $this->form_validation->set_rules('dpto', $this->lang->line('title_dpto'),'trim|max_lenght[50]');
     
     $this->form_validation->set_rules('telefono', $this->lang->line('title_telefono'),'trim|max_lenght[50]');
     $this->form_validation->set_rules('celular', $this->lang->line('title_celular'),'trim|max_lenght[50]');
     $this->form_validation->set_rules('radio', $this->lang->line('title_radio'),'trim|max_lenght[50]');
     $this->form_validation->set_rules('email', $this->lang->line('title_email'),'trim|max_lenght[250]|valid_email'); 
     $this->form_validation->set_rules('referente', $this->lang->line('title_referente'),'trim|max_lenght[250]');
     $this->form_validation->set_rules('nroregistro', $this->lang->line('title_nroregistro'),'trim|required|max_lenght[50]');
     $this->form_validation->set_rules('venceregistro_day', $this->lang->line('venceregistro_day'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('venceregistro_month', $this->lang->line('venceregistro_month'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('venceregistro_year', $this->lang->line('venceregistro_year'),'trim|required|max_lenght[4]');           
     
     $this->form_validation->set_rules('foto4x4','','');
     $this->form_validation->set_rules('fotoregistro','',''); 
     $this->form_validation->set_rules('observacion','','');      
     
     
           
     $this->form_validation->set_message('existDocumento',$this->lang->line("error_exist_dni"));
    
     
      return $this->form_validation->run();
   
   }
   
   public function existDocumento()
   {
     
     $this->db->where("tipo_doc",$this->db->escape_str($this->input->post('tipodoc')));
     $this->db->where("nro_doc",$this->db->escape_str($this->input->post('nrodoc')));
     $query=$this->db->get("choferes");
     
     if ( count($query->result()) == 0)
	     
          return true;
	    
	    else
          return false;
   
   }
   
    
   public function _submit_validateMovil()
   {
     $this->form_validation->set_rules('movil', $this->lang->line('title_movil'),'trim|required|is_natural_no_zero|max_lenght[10]|callback_notexistMovil');
     $this->form_validation->set_rules('patente', $this->lang->line('title_patente'),'trim|required|max_lenght[50]');
     $this->form_validation->set_rules('categoria', $this->lang->line('title_categoria'),'trim|required');
     
     $this->form_validation->set_rules('marca', $this->lang->line('title_marca'),'trim|max_lenght[250]');
     $this->form_validation->set_rules('medidas', $this->lang->line('title_medidas'),'trim|max_lenght[250]');
     $this->form_validation->set_rules('factura', $this->lang->line('title_factura'),'trim|max_lenght[250]');
     
     $this->form_validation->set_rules('nroseguro', $this->lang->line('title_nroseguro'),'trim|max_lenght[250]');
     $this->form_validation->set_rules('company', $this->lang->line('title_company'),'trim|max_lenght[250]');
     
     $this->form_validation->set_rules('venceseguro_day', $this->lang->line('venceseguro_day'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('venceseguro_month', $this->lang->line('venceseguro_month'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('venceseguro_year', $this->lang->line('venceseguro_year'),'trim|required|max_lenght[4]');           
     
     $this->form_validation->set_rules('venceruta_day', $this->lang->line('venceruta_day'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('venceruta_month', $this->lang->line('venceruta_month'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('venceruta_year', $this->lang->line('venceruta_year'),'trim|required|max_lenght[4]');           
     
     $this->form_validation->set_rules('vencesacta_day', $this->lang->line('vencesacta_day'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('vencesacta_month', $this->lang->line('vencesacta_month'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('vencesacta_year', $this->lang->line('vencesacta_year'),'trim|required|max_lenght[4]');           
     
     $this->form_validation->set_rules('vencevtv_day', $this->lang->line('vencevtv_day'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('vencevtv_month', $this->lang->line('vencevtv_month'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('vencevtv_year', $this->lang->line('vencevtv_year'),'trim|required|max_lenght[4]');           
     
     $this->form_validation->set_rules('vencemoy_day', $this->lang->line('vencemoy_day'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('vencemoy_month', $this->lang->line('vencemoy_month'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('vencemoy_year', $this->lang->line('vencemoy_year'),'trim|required|max_lenght[4]');           
     
     
     
     
     $this->form_validation->set_rules('propio','','');
     $this->form_validation->set_rules('fotocedula','','');
     $this->form_validation->set_rules('fototarjeta','','');
     $this->form_validation->set_rules('fototitulo','','');
     $this->form_validation->set_rules('fotoseguro','',''); 
     $this->form_validation->set_rules('observacion2','','');       
   
     
     $this->form_validation->set_message('notexistMovil',$this->lang->line("error_exist_movil"));
      return $this->form_validation->run();
   
   
   }
  
  public function notexistMovil()
  {
   $this->db->where("movil",$this->db->escape_str($this->input->post('movil')));
   $query=$this->db->get("movil");
   
   if ( count($query->result()) == 0)
	     
          return true;
	    
	    else
          return false;
  }
  
  
  public function notexistModMovil()
  {
   $movil=$this->db->escape_str($this->input->post('movil'));
   
   $choferid=$this->db->escape_str($this->uri->segment(3));
   
  
   $sql="select m.* from movil m, movil_chofer c 
          where m.movil = $movil
          and c.movilid= m.id and c.choferid != $choferid  
         ";
   $query=$this->db->query($sql); 
   echo $sql;
   if ( count($query->result()) == 0)
	     
          return true;
	    
	    else
          return false;
  }
  
  public function lock($id)
   {
      $this->db->trans_start();
      $query=$this->db->get_where("choferes",array("id"=>$id));
      $chofer=$query->result();
      $lockeo=false;
      if (isset( $chofer[0]) && $chofer[0]->bloqueado == 0)
      {
         $record=array(
          'bloqueado'=>1,
          'bloqueado_by'=>$this->Current_User->getUsername()
         );
         $this->db->update("choferes",$record,array("id"=>$id));
         $lockeo=true;
      }
      else{ //si soy yo el que lo lockeo me debe permitir ingresar
        if (isset($chofer[0]) && $chofer[0]->bloqueado == 1 && $chofer[0]->bloqueado_by == $this->Current_User->getUsername())
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
      $query=$this->db->get_where("choferes",array("id"=>$id));
      $chofer=$query->result();
      
      if (isset( $chofer[0]) && $chofer[0]->bloqueado == 1)
      {
         $record=array(
          'bloqueado'=>0,
          'bloqueado_by'=>''
         );
         $this->db->update("choferes",$record,array("id"=>$id));
       
      }
      $this->db->trans_complete();
     }
      redirect('chofer/index/'.$this->uri->segment(4));
   }
  
  
  
   public function mod()
   {
     
   if ( $this->Current_User->isHabilitado("MOD_MOVIL") )
    {
         $id = $this->db->escape_str($this->uri->segment(3));
          if ($id)
          {
          if ( $this->lock($id) )
         {  
            
            $this->db->order_by("id");
            $query=$this->db->get("tipodoc");
            $data["tipodoc"]=$query->result();
            
            
           
            $this->db->order_by("id");
            $query=$this->db->get("meses");
            $data["meses"]=$query->result();
            $this->db->order_by("name");
            $query=$this->db->get("regiones");
            $data["provincias"]=$query->result();
            
            $query=$this->db->get_where("choferes",array("id"=>$id));
            $chofer=$query->result();
            $data["chofer"]=$chofer; 
            $query=$this->db->get("categorias");
            $data["categorias"]=$query->result();
            $query=$this->db->get_where("cities",array("regionid"=>$chofer[0]->provincia));
            $data["localidades"]=$query->result();
            $sql="select m.* from movil m, movil_chofer mc where m.id = mc.movilid and mc.choferid=$id";
            $query=$this->db->query($sql);
            $data["movil"]=$query->result();
             $data["dir_desbloquea"]=site_url()."chofer/unlock/".$id;
            $data["content"]="chofer_viewmod";
            $this->load->view("index",$data);
           }
           else
            {  
                $data["content"]="lockeado";
                $data["message"]=$this->lang->line("chofer_lockeado");
                $this->load->view("index",$data);
             } 
            
          }
          else
             redirect('chofer/index/'.$this->uri->segment(4));
      }
      else
         redirect("inicio/denied"); 
             
   }
  
  
  public function _submit_validateModChofer()
  {
     $this->form_validation->set_rules('name', $this->lang->line('title_name'),'trim|required|max_lenght[200]');
     $this->form_validation->set_rules('lastname', $this->lang->line('title_lastname'),'trim|required|max_lenght[200]');
     $this->form_validation->set_rules('tipodoc', $this->lang->line('title_tipodoc'),'trim|required');
     $this->form_validation->set_rules('nrodoc', $this->lang->line('title_nrodoc'),'trim|required|max_lenght[20]');
     $this->form_validation->set_rules('comefvo', $this->lang->line('title_comisionefvo'),'trim|required|max_lenght[10]');
     $this->form_validation->set_rules('comctacte', $this->lang->line('title_comisionctacte'),'trim|required|max_lenght[10]');
     $this->form_validation->set_rules('fecnac_day', $this->lang->line('fecnac_day'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('fecnac_month', $this->lang->line('fecnac_month'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('fecnac_year', $this->lang->line('fecnac_year'),'trim|required|max_lenght[4]');
     $this->form_validation->set_rules('provincia', $this->lang->line('title_provincia'),'trim|required|is_natural_no_zero');
     $this->form_validation->set_rules('localidad', $this->lang->line('title_localidad'),'trim|required|is_natural_no_zero');
     $this->form_validation->set_rules('calle', $this->lang->line('title_street'),'trim|required|max_lenght[250]');
     $this->form_validation->set_rules('altura', $this->lang->line('title_altura'),'trim|required|max_lenght[10]');
     $this->form_validation->set_rules('piso', $this->lang->line('title_piso'),'trim|max_lenght[50]');
     $this->form_validation->set_rules('dpto', $this->lang->line('title_dpto'),'trim|max_lenght[50]');
     
     $this->form_validation->set_rules('telefono', $this->lang->line('title_telefono'),'trim|max_lenght[50]');
     $this->form_validation->set_rules('celular', $this->lang->line('title_celular'),'trim|max_lenght[50]');
     $this->form_validation->set_rules('radio', $this->lang->line('title_radio'),'trim|max_lenght[50]');
     $this->form_validation->set_rules('email', $this->lang->line('title_email'),'trim|max_lenght[250]|valid_email'); 
     $this->form_validation->set_rules('referente', $this->lang->line('title_referente'),'trim|max_lenght[250]');
     $this->form_validation->set_rules('nroregistro', $this->lang->line('title_nroregistro'),'trim|required|max_lenght[50]');
     $this->form_validation->set_rules('venceregistro_day', $this->lang->line('venceregistro_day'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('venceregistro_month', $this->lang->line('venceregistro_month'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('venceregistro_year', $this->lang->line('venceregistro_year'),'trim|required|max_lenght[4]');           
     
     $this->form_validation->set_rules('foto4x4','','');
     $this->form_validation->set_rules('fotoregistro','',''); 
     $this->form_validation->set_rules('observacion','','');   
     $this->form_validation->set_rules('passdocu', "Código Modificar",'trim|required|callback_validPassword');   
     $this->form_validation->set_message('validPassword',"El código no es válido");
   
    
     
      return $this->form_validation->run();
  
  }

  public function validPassword(){
    $codigo = $this->input->post("passdocu");
    $pass = sha1($codigo);
    $this->db->where("tipo","modificar_docu");
    $query=$this->db->get("passwords");
    $password = $query->row(0);
    $expire = strtotime($password->expire);
    $today = strtotime("now");

    if ($pass == $password->codigo && $today < $expire){
      return true;
    }else{
      return false;
    }
  }
  
   public function _submit_validateModMovil()
  {
  
     $this->form_validation->set_rules('movil', $this->lang->line('title_movil'),'trim|required|max_lenght[10]|is_natural_no_zero|callback_notexistModMovil');
     $this->form_validation->set_rules('patente', $this->lang->line('title_patente'),'trim|required|max_lenght[50]');
     $this->form_validation->set_rules('categoria', $this->lang->line('title_categoria'),'trim|required');
     
     $this->form_validation->set_rules('marca', $this->lang->line('title_marca'),'trim|max_lenght[250]');
     $this->form_validation->set_rules('medidas', $this->lang->line('title_medidas'),'trim|max_lenght[250]');
     $this->form_validation->set_rules('factura', $this->lang->line('title_factura'),'trim|max_lenght[250]');
     
     $this->form_validation->set_rules('nroseguro', $this->lang->line('title_nroseguro'),'trim|max_lenght[250]');
     $this->form_validation->set_rules('company', $this->lang->line('title_company'),'trim|max_lenght[250]');
     
     $this->form_validation->set_rules('venceseguro_day', $this->lang->line('venceseguro_day'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('venceseguro_month', $this->lang->line('venceseguro_month'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('venceseguro_year', $this->lang->line('venceseguro_year'),'trim|required|max_lenght[4]');           
     
     $this->form_validation->set_rules('venceruta_day', $this->lang->line('venceruta_day'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('venceruta_month', $this->lang->line('venceruta_month'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('venceruta_year', $this->lang->line('venceruta_year'),'trim|required|max_lenght[4]');           
     
     $this->form_validation->set_rules('vencesacta_day', $this->lang->line('vencesacta_day'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('vencesacta_month', $this->lang->line('vencesacta_month'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('vencesacta_year', $this->lang->line('vencesacta_year'),'trim|required|max_lenght[4]');           
     
     $this->form_validation->set_rules('vencevtv_day', $this->lang->line('vencevtv_day'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('vencevtv_month', $this->lang->line('vencevtv_month'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('vencevtv_year', $this->lang->line('vencevtv_year'),'trim|required|max_lenght[4]');           
     
     $this->form_validation->set_rules('vencemoy_day', $this->lang->line('vencemoy_day'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('vencemoy_month', $this->lang->line('vencemoy_month'),'trim|required|max_lenght[2]');
     $this->form_validation->set_rules('vencemoy_year', $this->lang->line('vencemoy_year'),'trim|required|max_lenght[4]');           
          
     $this->form_validation->set_rules('propio','','');
     $this->form_validation->set_rules('fotocedula','','');
     $this->form_validation->set_rules('fototarjeta','','');
     $this->form_validation->set_rules('fototitulo','','');
     $this->form_validation->set_rules('fotoseguro','',''); 
     $this->form_validation->set_rules('observacion2','','');       
   
     $this->form_validation->set_message('notexistModMovil',$this->lang->line("error_exist_movil"));
      return $this->form_validation->run();
  }
  
   public function update()
   {
    $id=$this->db->escape_str($this->uri->segment(3));
    if ($id)
    {
       if ($this->_submit_validateModChofer() === FALSE || $this->_submit_validateModMovil() === FALSE ) {
            $this->mod();
            return;
       }
       else
       {
       
        $record=array();
        $record['name']=$this->input->post("name");
        $record['lastname']=$this->input->post("lastname");
        $record['tipo_doc']=$this->db->escape_str($this->input->post("tipodoc"));
        $record['nro_doc']=$this->db->escape_str($this->input->post("nrodoc"));
        $record['comision']=$this->db->escape_str($this->input->post("comefvo"));
        $record['comisionctacte']=$this->db->escape_str($this->input->post("comctacte"));
        
        $fecha_nac=$this->input->post("fecnac_year").str_pad($this->input->post("fecnac_month"),2,"0",STR_PAD_LEFT).str_pad($this->input->post("fecnac_day"),2,"0",STR_PAD_LEFT);
        $record["fecha_nac"]=$this->db->escape_str($fecha_nac);
         
         $record["localidad"]=$this->db->escape_str($this->input->post("localidad"));
         $record["provincia"]=$this->db->escape_str($this->input->post("provincia"));
         $record["telefono"]=$this->db->escape_str($this->input->post("telefono"));
         $record["celular"]=$this->db->escape_str($this->input->post("celular"));
         $record["radio"]=$this->db->escape_str($this->input->post("radio"));
         $record["observacion"]=$this->input->post("observacion");
         $record["nroregistro"]=$this->db->escape_str($this->input->post("nroregistro"));
         $fecha_venceregistro=$this->input->post("venceregistro_year").str_pad($this->input->post("venceregistro_month"),2,"0",STR_PAD_LEFT).str_pad($this->input->post("venceregistro_day"),2,"0",STR_PAD_LEFT);
         $record["vence_registro"]=$this->db->escape_str($fecha_venceregistro);
         $record["referente"]=$this->input->post("referente");
         $record["calle"]=$this->input->post("calle");
         $record["altura"]=$this->db->escape_str($this->input->post("altura"));
         $record["piso"]=$this->db->escape_str($this->input->post("piso"));
         $record["dpto"]=$this->db->escape_str($this->input->post("dpto"));
         $record["address"]=$record["calle"]." ".$record["altura"]." ".$record["piso"]." ".$record["dpto"];
         $record["email"]=$this->db->escape_str($this->input->post("email"));
         
         $query=$this->db->get_where("cities",array("id"=>$this->db->escape_str($this->input->post("localidad"))));
         $loc=$query->result();
         if (isset($loc[0]))
            $record["localidad_name"]=$loc[0]->name;
          
            
        
         if ($this->input->post("foto4x4"))
            $record["foto4x4"]="s";
         else
            $record["foto4x4"]="n";
         if ($this->input->post("fotoregistro"))
            $record["fotoregistro"]="s";
        else
            $record["fotoregistro"]="n";
       
       $record["bloqueado"]=0;
        $record["bloqueado_by"]='';  
       
       $this->db->where("id",$id);
       $this->db->update("choferes",$record);
       $this->modMovil($id);
       
         redirect("chofer/index/".$this->uri->segment(4));
       }  
    }
    else
      redirect("chofer/index/".$this->uri->segment(4)); 
   }
   
   public function modMovil($choferid)
   {
   
    $record=array();
    $record['movil']=$this->db->escape_str($this->input->post("movil"));
    $record['patente']=$this->input->post("patente");
    
    $record['marca']=$this->input->post("marca");
    $record['seguro']=$this->input->post("nroseguro");
    $record['company']=$this->input->post("company");
    $record['categoriaid']=$this->db->escape_str($this->input->post("categoria"));
    $record['observacion_movil']=$this->input->post("observacion2");
       
    if ($this->input->post("verifica"))
        $record["noverifica_documentacion"]=1;
           
    if ($this->input->post("propio"))
            $record["propio"]='s';
    else
           $record["propio"]='n';
                     
         
         
         $fecha_vseguro=$this->input->post("venceseguro_year").str_pad($this->input->post("venceseguro_month"),2,"0",STR_PAD_LEFT).str_pad($this->input->post("venceseguro_day"),2,"0",STR_PAD_LEFT);
         $record["vence_seguro"]=$fecha_vseguro;
         $fecha_vruta=$this->input->post("venceruta_year").str_pad($this->input->post("venceruta_month"),2,"0",STR_PAD_LEFT).str_pad($this->input->post("venceruta_day"),2,"0",STR_PAD_LEFT);
         $record["vence_ruta"]=$fecha_vruta;
         $fecha_vsacta=$this->input->post("vencesacta_year").str_pad($this->input->post("vencesacta_month"),2,"0",STR_PAD_LEFT).str_pad($this->input->post("vencesacta_day"),2,"0",STR_PAD_LEFT);
         $record["vence_sacta"]=$fecha_vsacta;
         $fecha_vtv=$this->input->post("vencevtv_year").str_pad($this->input->post("vencevtv_month"),2,"0",STR_PAD_LEFT).str_pad($this->input->post("vencevtv_day"),2,"0",STR_PAD_LEFT);
         $record["vence_vtv"]=$fecha_vtv;
         $fecha_moyano=$this->input->post("vencemoy_year").str_pad($this->input->post("vencemoy_month"),2,"0",STR_PAD_LEFT).str_pad($this->input->post("vencemoy_day"),2,"0",STR_PAD_LEFT);
         $record["vence_moyano"]=$fecha_moyano;
         
         
         if ($this->input->post("fotocedula"))
            $record["fotocedula"]="s";
         else
            $record["fotocedula"]="n";
            
         if ($this->input->post("fototarjeta"))
            $record["fototarjeta"]="s"; 
         else
            $record["fototarjeta"]="n";
            
         if ($this->input->post("fototitulo"))
            $record["fototitulo"]="s";
         else      
            $record["fototitulo"]="n";
            
         if ($this->input->post("fotoseguro"))
            $record["fotoseguro"]="s";  
         else
            $record["fotoseguro"]="n";
       
       $query=$this->db->get_where("movil_chofer",array("choferid"=>$choferid));
       $movil=$query->result();
               
         $this->db->where("id",$movil[0]->movilid);      
         $this->db->update("movil",$record);
         
         
       
   
   }
   //busco el movil y que este activo sino no le puedo asignar viajes
   function getInfo()
   {
     $id=$this->uri->segment(3);
     //se busca por movil
     $sql="select c.name, c.lastname, m.marca,m.id as movilid from choferes c, movil m, movil_chofer mc 
          where 
           m.movil=$id and mc.choferid=c.id and mc.movilid = m.id and m.active=1
     ";
     $query=$this->db->query($sql);
     $movil=$query->result();
     if (count($movil) == 0)
      echo "no_exist"; 
     else
      echo json_encode($movil);
   
   }
  
}

?>

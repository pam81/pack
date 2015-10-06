<?php

class Search extends Controller {

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
   
   function index()
   {
     $data["content"]="search_viewlist";
    $this->load->view("index",$data);
   
   }
   
   function viaje()
   {
   
    $sql="select distinct v.*,r.codigo_excedente,r.desde, r.destino,m.movil,c.name as cliente from viajes v, movil m, clientes c, phones p,reservas r
          where v.movilid = m.id and v.clienteid = c.id 
          and p.clienteid = c.id
          and v.reservaid = r.id
          ";
    if ($this->input->post("movil"))
    { $movil=$this->input->post("movil");
      $sql .= " and m.movil=$movil ";
    }      
    
    if ($this->input->post("desde_day") && $this->input->post("desde_month") && $this->input->post("desde_year"))
    { $fecha=$this->input->post("desde_year").$this->input->post("desde_month").$this->input->post("desde_day");
      $sql .= " and v.fecha_despacho=$fecha ";
    }
    
    if ($this->input->post("cliente"))
    { $cliente=$this->input->post("cliente");
      $sql .= " and c.name like '%".$cliente."%' ";
    }      
    
    if ($this->input->post("phone"))
    { $tel=$this->input->post("phone");
      $sql .= " and p.phone=$tel ";
    } 
    
    if ($this->input->post("desde"))
    { $desde=$this->input->post("desde");
      $sql .= " and r.desde like '%".$desde."%' ";
    }
    
    if ($this->input->post("hasta"))
    { $hasta=$this->input->post("hasta");
      $sql .= " and r.destino like '%".$hasta."%' ";
    }
     if ($this->input->post("seguro"))
    { $seguro=$this->input->post("seguro");
      $sql .= " and r.codigo_excedente like '".$seguro."'";
    } 
    
    
    if ($this->input->post("voucher"))
    {
      $voucher=$this->input->post("voucher");
      $sql .=" and v.voucher like '".$voucher."'";
    
    }
    
    if ($this->input->post("nroviaje"))
    {
      $nroviaje=$this->input->post("nroviaje");
      $sql .=" and v.id =$nroviaje" ;
    
    }
    
      
    $query=$this->db->query($sql);
    $data["viajes"]=$query->result();
    $data["content"]="searchlist_viewlist";
    $this->load->view("index",$data);
   }


 }
 ?>

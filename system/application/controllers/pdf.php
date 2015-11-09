<?php

class Pdf extends Controller {

   function __construct()
   {
    parent::Controller();
    $this->lang->load("fletpack_site");
    $this->load->library('form_validation');
    
    $this->load->model("Current_User");
    $this->load->model("User_model");
    $this->load->model("Flete_model","flete");
    $this->load->config("site");
    
   
   
   }


function makepdfxday()
   {
       $movil=$this->db->escape_str($this->uri->segment(3));
     $fecha=$this->db->escape_str($this->uri->segment(4)); 
     $tipo=$this->db->escape_str($this->uri->segment(5));
     $data["see"]=$this->uri->segment(6);
      
      
      
     $data["viajes"]=$this->flete->getRecaudacionxDay($fecha, $movil, $tipo);
      
   
      $this->load->view("pdfrecaudacionxday",$data); 
   }
   
   
  function makepdfreca()
  {
  
     $movil=$this->db->escape_str($this->uri->segment(3));
     $fdesde=$this->db->escape_str($this->uri->segment(4)); 
     $fhasta=$this->db->escape_str($this->uri->segment(5));
     $data["see"]=$this->uri->segment(6);
    
    $data["viajes"]= $this->flete->getRecaudacionMovil($fdesde,$fhasta,$movil);
    $this->load->view("pdfrecaudacion",$data);
  
  }
  
  function makepdfctaCliente()
  {
    
     $telefono=$this->db->escape_str($this->uri->segment(3));
      $data["telefono"]=$telefono;
     $fdesde=$this->db->escape_str($this->uri->segment(4));
      $data["fdesde"]=$fdesde; 
     $fhasta=$this->db->escape_str($this->uri->segment(5));
     $data["fhasta"]=$fhasta;
     $tipo=$this->db->escape_str($this->uri->segment(6));
     $data["see"]=$this->uri->segment(7);
     $data["viajes"]=$this->flete->getCtaCteCliente($fdesde,$fhasta,$tipo,$telefono);
      $sql="select c.* from clientes c, phones p where p.clienteid=c.id and
       p.phone = $telefono";
       $query=$this->db->query($sql);
      
      $data["cliente"]=$query->result();
      
       $this->load->view("pdfctaCliente",$data);
  
  
  
  }
  
  function makereservaListado()
  {
    
     
     $fdesde=$this->db->escape_str($this->uri->segment(3));
      $data["fdesde"]=$fdesde; 
     $fhasta=$this->db->escape_str($this->uri->segment(4));
     $data["fhasta"]=$fhasta;
     
  
   $sql="  SELECT  
    r.id,r.fecha,r.hsalida,r.hpuerta,r.destino,r.desde,r.observaciones,
          r.empresa as name,r.clienteid,r.despachado, r.forma_pago,c.name as categoria,
          r.cancelado, r.bloqueado,r.bloqueado_by, t.phone
          FROM   reservas r,phones t, categorias c";
   $sql .="              WHERE 
                   t.principal=1
                  and t.clienteid = r.clienteid
                   and r.categoriaid = c.id";
    $sql .=" and r.fecha between $fdesde and $fhasta
                  order by r.fecha asc ,r.hsalida asc 
    ";
     $query=$this->db->query($sql);      
      $data["reservas"]=$query->result();
       $this->load->view("pdfreservaListado",$data);
  
  }
  
  
  public function makepdfmovil()
   {
   
   $movil=0;
   $fdesde=date("Ymd");
   $fhasta=date("Ymd");
   
   $movil=$this->db->escape_str($this->uri->segment(3));
   $fdesde=$this->db->escape_str($this->uri->segment(4));
   $fhasta=$this->db->escape_str($this->uri->segment(5));
   $see=$this->db->escape_str($this->uri->segment(6));
   
    $data["fdesde"]=$fdesde;
    $data["movil"]=$movil;
    $data["see"]=$see; 
    
    $data["viajes"]=$this->flete->getDataMoviles($fdesde,$fhasta,$movil);
    
   
    $this->load->view("pdfmovil",$data);
   
   }
  
  public function makepdfranking()
   {
   
  
   $fdesde=date("Ymd");
   $fhasta=date("Ymd");
   
   if ($this->uri->segment(3))
      $fdesde=$this->db->escape_str($this->uri->segment(3));
   if ($this->uri->segment(4))   
      $fhasta=$this->db->escape_str($this->uri->segment(4));
   
   
  $data["fdesde"]=$fdesde;
  $data["fhasta"]=$fhasta;
    
  $data["usuarios"]=$this->flete->getRankingUsuario($fdesde,$fhasta);
        
   
    $this->load->view("pdfranking",$data);
   
   }
  
  public function makepdfrankingcliente()
   {
   
  
   $fdesde=date("Ymd");
   $fhasta=date("Ymd");
   
   if ($this->uri->segment(3))
      $fdesde=$this->db->escape_str($this->uri->segment(3));
   if ($this->uri->segment(4))   
      $fhasta=$this->db->escape_str($this->uri->segment(4));
   
   
  $data["fdesde"]=$fdesde;
  $data["fhasta"]=$fhasta;
    
  $query=$this->flete->getRankingCliente($fdesde,$fhasta);
 
    $listado=$query->result();
    $encabezado=array(mb_convert_case("ID",MB_CASE_UPPER,"UTF-8"),
    mb_convert_case($this->lang->line("title_cliente"),MB_CASE_UPPER,"UTF-8"),
    mb_convert_case($this->lang->line("title_telefono"),MB_CASE_UPPER,"UTF-8"),
    mb_convert_case($this->lang->line("cant_viajes"),MB_CASE_UPPER,"UTF-8"),
    mb_convert_case($this->lang->line("title_total"),MB_CASE_UPPER,"UTF-8")
    );
     $this->load->plugin('to_excel');
     to_excel($query,"rankingCliente_".$fdesde."_".$fhasta,$encabezado);
  /*  $ranking=array();
    $r=array();
     foreach($listado as $v)
     {  
        $r["cliente"]=$v->cliente;
        $r["tel"]=$v->tel;
        $r["cantidad"]=$v->cantidad;
        $r["total"]=$v->total;
        $ranking[]=$r;
     }  
       
    $data["listado"]=$ranking;
        
   
    $this->load->view("pdfrankingCliente",$data);*/
   
   }
   
     function makepdfgral()
  {
    
     
     $fdesde=$this->db->escape_str($this->uri->segment(3));
      $data["fdesde"]=$fdesde; 
     $fhasta=$this->db->escape_str($this->uri->segment(4));
     $data["fhasta"]=$fhasta;
     $data["see"]=$this->uri->segment(5);  
  
     
     
    $data["viajes"]= $this->flete->getRecaudacionGral($fdesde,$fhasta);
      
       $this->load->view("pdfgral",$data);
  
  
  
  }
  
     function makeExcellgral()
  {
    
     
     $fdesde=$this->db->escape_str($this->uri->segment(3));
      $data["fdesde"]=$fdesde; 
     $fhasta=$this->db->escape_str($this->uri->segment(4));
     $data["fhasta"]=$fhasta;
     $data["see"]=$this->uri->segment(5);  
  
     
     
    $data["viajes"]= $this->flete->getRecaudacionGral($fdesde,$fhasta);
      
     $filename = "recaudacionGral_".$fdesde."_".$fhasta; 
      
       $this->load->plugin('to_excel');
       to_excel_gral($data,$filename);
  
  }
  
    function makepdfarendir()
  {
    
     
     $fdesde=$this->db->escape_str($this->uri->segment(3));
      $data["fdesde"]=$fdesde; 
     $fhasta=$this->db->escape_str($this->uri->segment(4));
     $data["fhasta"]=$fhasta;
     $data["see"]=$this->uri->segment(5);  
  
     
     
    $data["viajes"]= $this->flete->getRecaudacionGral($fdesde,$fhasta);
      
       $this->load->view("pdfarendir",$data);
  
  
  
  }
  
   function makeExcellRendir()
  {
    
     
     $fdesde=$this->db->escape_str($this->uri->segment(3));
      $data["fdesde"]=$fdesde; 
     $fhasta=$this->db->escape_str($this->uri->segment(4));
     $data["fhasta"]=$fhasta;
     $data["see"]=$this->uri->segment(5);  
  
     
     
    $data["viajes"]= $this->flete->getRecaudacionGral($fdesde,$fhasta);
      
     
     $filename = "recaudacionRendir_".$fdesde."_".$fhasta; 
      
       $this->load->plugin('to_excel');
       to_excel_rendir($data,$filename);
  
  
  }
  
  
  public function makepdfultimoviaje()
  {
  
     $tiempo=$this->uri->segment(3);
     $data["viajes"]=$this->flete->getUltimoViaje($tiempo);
     $data["tiempo"]=$tiempo;
     $this->load->view("pdfultimoviaje",$data);
  
  }
   
   
   
 }
 ?>

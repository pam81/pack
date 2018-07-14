<?php

class Inicio extends Controller {

   function __construct()
   {
    parent::Controller();
    $this->lang->load("fletpack_site");
    $this->load->library('form_validation');
     $this->load->helper(array('form'));
    $this->load->model("Current_User");
    $this->load->model("User_model");
    $this->load->model("Flete_model","flete");
    $this->User_model->verified_login();
   
   }
   
   public function index()
   {   
    $query=$this->db->get("bases");
    $data["bases"]=$query->result();
    $this->db->select("movil,baseid");
    $this->db->orderby("baseid,ordenbase");
    $query=$this->db->get_where("movil",array("active"=>1));
    
    $data["moviles"]=$query->result();
    //muestro las 10 reservas del dia solamente si no se cancelaron o despacharon
    $sql="  SELECT  c.name,c.id as clienteid, r.*,t.phone, a.name as movil
                  FROM  clientes c, reservas r,phones t, categorias a
                  WHERE 
                  t.clienteid = c.id and
                   c.id = r.clienteid
                   and r.despachado=0
                   and cancelado=0
                   and t.principal=1
                   and a.id = r.categoriaid
                   and r.fecha >= ".date("Ymd")." 
                  order by r.fecha asc ,r.hsalida asc 
                  limit 0,10
    "; //limit 0,10
    $query=$this->db->query($sql);
    
    $data["reservas"]=$query->result();
    //muestro los  viajes del dia mientras no esten cancelados ni cerrados o regresando
    $sql="select v.*,r.desde, r.destino,r.hasMudanza, m.movil from viajes v, reservas r,movil m where v.reservaid=r.id";
    // esto se quita para mostrar viajes que no se han cerrado
    //   and v.fecha_despacho = ".date("Ymd")."
       
    $sql.="  and v.movilid = m.id
       and (v.cancelado = 0
       and v.cerrado=0
       or v.regresando=1)
       order by r.fecha desc, r.hsalida asc 
    ";
    //limit 0,30
    $query=$this->db->query($sql);
    $data["viajes"]=$query->result();
    $data["content"]="inicio";
    $this->load->view("index",$data);
   
   }

   public function avisoAbordo(){
    //busco los viajes del dia mientras no esten cancelados ni cerrados ni despachados
   //asi me fijo si no se dio el abordo el horario en puerta que no se haya pasado
   
   $sql="select v.*,r.hpuerta, m.movil 
      from viajes v,reservas r, movil m where 
    v.reservaid=r.id and
    v.fecha_despacho = ".date("Ymd")."
    and v.movilid = m.id
    and (v.cancelado = 0
    and v.cerrado=0
    or v.regresando=1)
    and v.habordo is null
    order by v.hora_despacho  
    ";

    $query=$this->db->query($sql);
    $listado=array();
    $listado["resultado"]="no_ok";
    foreach( $query->result() as $v)
    {
        $hora=date("Hi");

        if ( $v->hpuerta <= $hora ){
          $listado[]=array("texto"=>$v->movil." NO DIO ABORDO","className"=>"default");
        }
    }
    return $listado;
   }

   public function avisoVencimiento(){
     //listado de vencimientos de documentación
     $listado = array();
     $query=$this->db->get_where("movil",array("active"=>1));
     $moviles=$query->result();
     foreach($moviles as $movil){
      $vencimiento=$this->flete->DocMovilVencida($movil->id);
      if ($vencimiento){
        $listado=array_merge($listado,$vencimiento);
      }
     }
     return $listado;
   }
   
   public function showAviso()
   {
      $listado = $this->avisoAbordo();
      $listado = array_merge($listado,$this->avisoVencimiento());
      if ( count($listado) > 1){
        $listado["resultado"]="ok";
      }
    
     echo json_encode($listado);
   }
   
   public function denied()
   {
      $data["content"]="noaccess";
      $data["message"]=$this->lang->line("access_denied");
    $this->load->view("index",$data);
   }
   
  
}

?>

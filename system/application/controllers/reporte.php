<?php

class Reporte extends Controller {

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
     
        $data["content"]="reporte_viewlist";
        $this->load->view("reporteindex",$data);
    
   }
   
   function recaudacionxday()
   {
      if ( $this->Current_User->isHabilitado("RECAUDACIONDAY") )
    {
      
        $query=$this->db->get("meses");
        $data["meses"]=$query->result();
        $data["content"]="recaudacion";
        $this->load->view("reporteindex",$data);
     }
     else
        redirect("inicio/denied");    
   
   }
   
   function generateRecaudacionxday()
   {
      $movil=$this->db->escape_str($this->input->post("movil"));
      $fecha=$this->db->escape_str($this->input->post("year")).str_pad($this->db->escape_str($this->input->post("month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("day")),2,"0",STR_PAD_LEFT); 
      $tipo=$this->db->escape_str($this->input->post("tipo"));
      
      
      $data["viajes"]=$this->flete->getRecaudacionxDay($fecha, $movil, $tipo);
      $data["opciones"]=$movil."/".$fecha."/".$tipo;
      $data["content"]="recaudacionxday";
      $this->load->view("reporteindex",$data);         
   
   
   }
   
   public function recaudaciongral()
   {
  if ( $this->Current_User->isHabilitado("RECAUDACIONGRAL") )
  {
    $fdesde=date("Ymd");
    $fhasta=date("Ymd");
   
    
    
     if ($this->input->post("desde_day") && $this->input->post("desde_month") && $this->input->post("desde_year"))
       $fdesde=$this->db->escape_str($this->input->post("desde_year")).str_pad($this->db->escape_str($this->input->post("desde_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("desde_day")),2,"0",STR_PAD_LEFT);
    
     $data["fdesde"]=$fdesde;
    
    if ($this->input->post("hasta_day") && $this->input->post("hasta_month") && $this->input->post("hasta_year"))
       $fhasta=$this->db->escape_str($this->input->post("hasta_year")).str_pad($this->db->escape_str($this->input->post("hasta_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("hasta_day")),2,"0",STR_PAD_LEFT);
    
   $data["fhasta"]=$fhasta;
    
    $data["viajes"]= $this->flete->getRecaudacionGral($fdesde,$fhasta);
 
    
    $data["opciones"]=$fdesde."/".$fhasta;
    
    
    
    $query=$this->db->get("meses");
    $data["meses"]=$query->result();
    
    $data["content"]="reportegral_viewlist";
    $this->load->view("reporteindex",$data);
    }
     else
        redirect("inicio/denied");
   
   }
   
    public function pdfgral()
   {
      if ( $this->Current_User->isHabilitado("PRINTGRAL") )
    {
    if ($this->uri->segment(3)){
     
     $fdesde=$this->db->escape_str($this->uri->segment(3)); 
     $fhasta=$this->db->escape_str($this->uri->segment(4));
     $see=0;
     if ($this->Current_User->isHabilitado("TOTALRECGRAL"))
        $see=1;
     
     
     $this->load->plugin('to_pdf');
     $html = file_get_contents(site_url()."pdf/makepdfgral/$fdesde/$fhasta/$see");
     pdf_create($html, "recaudacionGral_$fdesde");
     
    }
      
    else
       show_404();
    }
     else
        redirect("inicio/denied");    
   }
   
   
   public function aRendir()
   {
  if ( $this->Current_User->isHabilitado("RECAUDACIONGRAL") )
    {
   $fdesde=date("Ymd");
   $fhasta=date("Ymd");
   
    
    
     if ($this->input->post("desde_day") && $this->input->post("desde_month") && $this->input->post("desde_year"))
       $fdesde=$this->db->escape_str($this->input->post("desde_year")).str_pad($this->db->escape_str($this->input->post("desde_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("desde_day")),2,"0",STR_PAD_LEFT);
    
     $data["fdesde"]=$fdesde;
    
    if ($this->input->post("hasta_day") && $this->input->post("hasta_month") && $this->input->post("hasta_year"))
       $fhasta=$this->db->escape_str($this->input->post("hasta_year")).str_pad($this->db->escape_str($this->input->post("hasta_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("hasta_day")),2,"0",STR_PAD_LEFT);
    
   $data["fhasta"]=$fhasta;
    
       
    
     
     
    $data["viajes"]= $this->flete->getRecaudacionGral($fdesde,$fhasta);
 
    
    $data["opciones"]=$fdesde."/".$fhasta;
    
    
    
    $query=$this->db->get("meses");
    $data["meses"]=$query->result();
    
    $data["content"]="reportearendir_viewlist";
    $this->load->view("reporteindex",$data);
    }
     else
        redirect("inicio/denied");
   
   }
   
    public function pdfARendir()
   {
      if ( $this->Current_User->isHabilitado("PRINTGRAL") )
    {
    if ($this->uri->segment(3)){
     
     $fdesde=$this->db->escape_str($this->uri->segment(3)); 
     $fhasta=$this->db->escape_str($this->uri->segment(4));
     $see=0;
     if ($this->Current_User->isHabilitado("TOTALRECGRAL"))
        $see=1;
     
     
     $this->load->plugin('to_pdf');
     $html = file_get_contents(site_url()."pdf/makepdfarendir/$fdesde/$fhasta/$see");
     pdf_create($html, "aRendir_$fdesde");
     
    }
      
    else
       show_404();
    }
     else
        redirect("inicio/denied");    
   }

   public function getSaldoMesAnterior($month, $year, $movilid){

            

            $fecha=$year.str_pad($month,2,0,STR_PAD_LEFT).str_pad(1,2,0,STR_PAD_LEFT);

            $sql="select c.* from cajas c where c.borrado=0 and c.created_at='$fecha' and tipo=4 and c.idmovil = ".$movilid;
           
            $query=$this->db->query($sql);
            $caja=$query->result();
            $saldo=0;
            if (isset($caja[0])){
              $saldo=$caja[0]->monto;
            }

          return $saldo;

   }
   
   public function rendicion(){
    if ( $this->Current_User->isHabilitado("RECAUDACIONGRAL") ){
      $month=date("m");
      if ( $this->input->post("month")){
        $month = str_pad($this->db->escape_str($this->input->post("month")),2,"0",STR_PAD_LEFT);
      }
      $year=date("Y");
      if ($this->input->post("year")){
        $year=$this->input->post("year");
      }
      $movil='';
      if ($this->input->post("movil")){
        $movil=$this->input->post("movil");
      }
      
      $nroDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
      $inicio=$year."-".$month."-01";
      $final=$year."-".$month."-".$nroDays;
      
      $listado=array();
      if ($movil != ''){

        $sql="select m.id  from  movil m where m.movil=$movil";
        $query=$this->db->query($sql);
        $movilData=$query->result();

        if (isset($movilData[0])){
            
          $sql="select * from recaudacion where idmovil=".$movilData[0]->id." and fecha between \"$inicio\" and \"$final\" order by fecha asc";
          $query=$this->db->query($sql);
          $listado= $query->result();
        }
      }

      $data["year"]=$year;
      $data["month"]=$month;
      $data["movil"]=$movil;
      $data["content"]="recaudacion/reporte_recaudacion_viewlist";
      $data["listado"]=$listado;
      $this->load->view("reporteindex",$data);

    }else{
      redirect("inicio/denied");
    }
   }
   public function mensual(){
    if ( $this->Current_User->isHabilitado("RECAUDACIONGRAL") ){
      $month=date("m");
      if ( $this->input->post("month")){
        $month = $this->input->post("month");
      }
      $year=date("Y");
      if ($this->input->post("year")){
        $year=$this->input->post("year");
      }
      $movil='';
      if ($this->input->post("movil")){
        $movil=$this->input->post("movil");
      }
      
      $nroDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
       
      
      $listado=array();
      if ($movil != ''){

        $sql="select c.*,m.id as movilid from choferes c, movil_chofer mc, movil m where m.id = mc.movilid and mc.choferid=c.id and m.movil=$movil";

        $query=$this->db->query($sql);
        $chofer=$query->result();
        if (isset($chofer[0])){
            $comision=$chofer[0]->comision;
            
            $sql="select c.* from comision c ";
            $query=$this->db->query($sql);
            $valores=$query->result();
            

            $acuenta=$this->getSaldoMesAnterior($month, $year, $chofer[0]->movilid);
            


            $listado[0]=array("recauda"=>0,"iva"=>0,"radio"=>0,"porcentaje"=>0,
                "peon"=>0,"km"=>0,"peaje"=>0,"cochera"=>0,"mudanza"=>0,"art"=>0,"pmovil"=>0,
                "pagencia"=>0,"cco"=>0, "saldo"=>$acuenta);

            $anterior=$acuenta;
             
            for($i=1; $i<= $nroDays; $i++){
              $fecha=$year.str_pad($month,2,0,STR_PAD_LEFT).str_pad($i,2,0,STR_PAD_LEFT);

              if ($this->diaNoLaborable($fecha)){
                    $recauda=0;
                    $porcentaje=0;
                    $peon=0;
                    $km=0;
                    $cochera=0;
                    $art=0;
                    $pmovil=0;
                    $pagencia=0;
                    $cco=0;
                    $saldo=$anterior;
                    $peaje=0;
                    $mudanza=0;
                    $iva=0;
                    $radio=0;
              }else{

                    $sql="select v.*, r.art_valor, r.hasMudanza from viajes v inner join reservas r on r.id = v.reservaid 
                          where v.movilid=".$chofer[0]->movilid." and  v.cerrado = 1 and v.fecha_comisionar='$fecha' ";
                      
                    $query=$this->db->query($sql);
                    $viajes=$query->result();
                    //itero por cada dia para obtener la recaudación diaria
                    $recauda=0;
                    $porcentaje=0;
                    $peon=0;
                    $km=0;
                    $cochera=0;
                    $mudanza=0;
                    $art=0;
                    $pmovil=0;
                    $pagencia=0;
                    $cco=0;
                    $saldo=0;
                    $peaje=0;
                    $iva=0;
                    $radio=$valores[0]->radio; 
                    foreach($viajes as $v){

                        if ($v->hasMudanza == 0){ //solo lo sumo en el caso que no sea mudanza
                          //porque la mudanza se quita ya el 30% de comisión
                          $recauda +=$v->valor + $v->espera; //el valor es el subtotal + sumar el tiempo de espera
                        }
                        if ($v->forma_pago == 1){
                          $iva += $v->iva; //sumar el iva solo si el viaje es en efectivo
                        }  
                        if ($v->forma_pago == 2){ //si es en cta cte el viaje hay que retornarle peon peaje cochera al movil
                          $peaje +=$v->peaje;
                          $peon +=$v->peones;
                          $cochera +=$v->estacionamiento;
                          $cco += $recauda; // resto tiempo espera + subtotal cuando es cuenta corriente
                        }
                        $art +=$v->art_valor;
                        $mudanza += $v->mudanza;

                    }
                    $porcentaje= round( ($recauda  * $comision) / 100, 2);
                    $sql="select c.* from cajas c where c.borrado=0 and c.created_at='$fecha' and c.idmovil=".$chofer[0]->movilid;

                    $query=$this->db->query($sql);
                    $cajas=$query->result();
                    foreach($cajas as $c){
                      if ($c->tipo == 1){
                        $pagencia += $c->monto;
                      }
                      if ($c->tipo == 2){
                        $pmovil += $c->monto;
                      }
                      /*if ($c->tipo == 3){
                        $cco += $c->monto;
                      }*/
                    }

                    $saldo=$radio+$porcentaje+$pagencia+$mudanza-$pmovil-$cco-$peon-$peaje-$cochera+$iva+$art+$anterior;
                    $anterior=$saldo;
              }
              $listado[$i]=array("recauda"=>$recauda,"iva"=>$iva,"radio"=>$radio,"porcentaje"=>$porcentaje,
                "peon"=>$peon,"peaje"=>$peaje,"cochera"=>$cochera,"mudanza"=>$mudanza,"art"=>$art,"pmovil"=>$pmovil,
                "pagencia"=>$pagencia,"cco"=>$cco, "saldo"=>$saldo);
            }
        }
      }
      $data["year"]=$year;
      $data["month"]=$month;
      $data["movil"]=$movil;
      $data["content"]="reportemensual_viewlist";
      $data["listado"]=$listado;
      $this->load->view("reporteindex",$data);

    }else{
      redirect("inicio/denied");
    }
   }

   public function diaNoLaborable($fecha){
     
     $query=$this->db->get_where("dias",array("dia"=>$fecha));
     $resultado=$query->result();
     if ( isset($resultado[0]) && count($resultado) > 0 )
     {
        
            return true; //existe la fecha
            
     }else{
     
         return false; //no existe
      }
   }
   
    public function seguro()
   {
   if ( $this->Current_User->isHabilitado("SEGURO")) {
 
   $seguro=0;
   $fdesde=date("Ymd");
   $fhasta=date("Ymd");
 
    if ($this->input->post("seguro"))
       $seguro=$this->db->escape_str($this->input->post("seguro"));
   
     $data["seguro"]=$seguro;
    
     if ($this->input->post("desde_day") && $this->input->post("desde_month") && $this->input->post("desde_year"))
       $fdesde=$this->db->escape_str($this->input->post("desde_year")).str_pad($this->db->escape_str($this->input->post("desde_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("desde_day")),2,"0",STR_PAD_LEFT);
    
     $data["fdesde"]=$fdesde;
    
    if ($this->input->post("hasta_day") && $this->input->post("hasta_month") && $this->input->post("hasta_year"))
       $fhasta=$this->db->escape_str($this->input->post("hasta_year")).str_pad($this->db->escape_str($this->input->post("hasta_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("hasta_day")),2,"0",STR_PAD_LEFT);
    
   $data["fhasta"]=$fhasta;
    
       
    
    $sql="select v.*,r.desde, r.destino,r.codigo_excedente,r.monto_excedente,
     r.art_valor, m.movil,c.name as cliente 
    from viajes v, reservas r, movil m,
          clientes c where 
            ";
     //fecha_abordo ?
    $sql .="  (v.cerrado=1 or v.cancelado =1)
                and v.fecha_abordo between $fdesde and $fhasta    
                and v.movilid=m.id
                and v.reservaid = r.id
                and v.clienteid = c.id";

    if ($seguro == '0')
         $sql .=" and r.codigo_excedente is not null ";
    else
         $sql .=" and r.codigo_excedente like '$seguro' ";     
                     
    $sql .="     order by r.fecha desc, r.hsalida asc  ";      
    
  
   
    $query=$this->db->query($sql);
    $viajes=$query->result(); 
    $data["viajes"]= $viajes;
    
    $data["opciones"]=$seguro."/".$fdesde."/".$fhasta;
    
    
    
    $query=$this->db->get("meses");
    $data["meses"]=$query->result();
    
    $data["content"]="seguroviaje_viewlist";
    $this->load->view("reporteindex",$data);
   }
   else 
    redirect("inicio/denied");
   }
   
   
   public function movil()
   {
    if ( $this->Current_User->isHabilitado("MOVIL")) {
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
     $data["opciones"]=$movil."/".$fdesde."/".$fhasta;
    
    
    
    $data["viajes"]=$this->flete->getDataMoviles($fdesde,$fhasta,$movil);
    
    $data["content"]="movilviaje_viewlist";
    $this->load->view("reporteindex",$data);
   }
    else 
    redirect("inicio/denied");
   
   }
   
   
   public function sesiones()
   {
    if ( $this->Current_User->isHabilitado("SESIONES")) {
   $user="";
   $fdesde=date("Ymd");
   $fhasta=date("Ymd");
   
    if ($this->input->post("user"))
       $user=$this->db->escape_str($this->input->post("user"));
       
     $data["user"]=$user;
    
     if ($this->input->post("desde_day") && $this->input->post("desde_month") && $this->input->post("desde_year"))
       $fdesde=$this->db->escape_str($this->input->post("desde_year")).str_pad($this->db->escape_str($this->input->post("desde_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("desde_day")),2,"0",STR_PAD_LEFT);
    
     $data["fdesde"]=$fdesde;
    
    if ($this->input->post("hasta_day") && $this->input->post("hasta_month") && $this->input->post("hasta_year"))
       $fhasta=$this->db->escape_str($this->input->post("hasta_year")).str_pad($this->db->escape_str($this->input->post("hasta_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("hasta_day")),2,"0",STR_PAD_LEFT);
    
   $data["fhasta"]=$fhasta;
     $data["opciones"]=$user."/".$fdesde."/".$fhasta;
    
    
    
    $data["sesiones"]=$this->flete->getDataSesiones($fdesde,$fhasta,$user);
    
    $data["content"]="sessiones_viewlist";
    $this->load->view("reporteindex",$data);
   }
    else 
    redirect("inicio/denied");
   
   }
   
   public function ranking()
   {
   
    if ( $this->Current_User->isHabilitado("RANKINGUSUARIO")) {
   
     $fdesde=date("Ymd");
     $fhasta=date("Ymd");
     
     if ($this->input->post("desde_day") && $this->input->post("desde_month") && $this->input->post("desde_year"))
       $fdesde=$this->db->escape_str($this->input->post("desde_year")).str_pad($this->db->escape_str($this->input->post("desde_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("desde_day")),2,"0",STR_PAD_LEFT);
    
     $data["fdesde"]=$fdesde;
    
    if ($this->input->post("hasta_day") && $this->input->post("hasta_month") && $this->input->post("hasta_year"))
       $fhasta=$this->db->escape_str($this->input->post("hasta_year")).str_pad($this->db->escape_str($this->input->post("hasta_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("hasta_day")),2,"0",STR_PAD_LEFT);
    
   $data["fhasta"]=$fhasta;
 
     
     
    
     $data["opciones"]=$fdesde."/".$fhasta;
     
    $data["usuarios"]=$this->flete->getRankingUsuario($fdesde,$fhasta);
    $data["content"]="ranking_viewlist";
    $this->load->view("reporteindex",$data);
          
          
    }
     else 
    redirect("inicio/denied");
   
   
   
   
   }
   
   public function rankingCliente()
   {
    if ( $this->Current_User->isHabilitado("RANKINGCLIENTE")) {
      
     $fdesde=date("Ymd");
     $fhasta=date("Ymd");
     
     if ($this->input->post("desde_day") && $this->input->post("desde_month") && $this->input->post("desde_year"))
       $fdesde=$this->db->escape_str($this->input->post("desde_year")).str_pad($this->db->escape_str($this->input->post("desde_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("desde_day")),2,"0",STR_PAD_LEFT);
    
     $data["fdesde"]=$fdesde;
    
    if ($this->input->post("hasta_day") && $this->input->post("hasta_month") && $this->input->post("hasta_year"))
       $fhasta=$this->db->escape_str($this->input->post("hasta_year")).str_pad($this->db->escape_str($this->input->post("hasta_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("hasta_day")),2,"0",STR_PAD_LEFT);
    
      $data["fhasta"]=$fhasta;
      
      $query=$this->flete->getRankingCliente($fdesde,$fhasta);
      $data["listado"]=$query->result();
      $data["opciones"]=$fdesde."/".$fhasta; 
      $data["referidos"]=$this->flete->referidosEstadisticas($data["fdesde"], $data["fhasta"]);
      $data["content"]="rankingcliente_viewlist";
      $this->load->view("reporteindex",$data); 
    }
     else 
    redirect("inicio/denied");
   } 
   
   public function recaudacion()
   {
     if ( $this->Current_User->isHabilitado("RECAUDACIONMOVIL")) {
    
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
      
         
      
       
      $data["viajes"]= $this->flete->getRecaudacionMovil($fdesde,$fhasta,$movil);
      
      $data["opciones"]=$movil."/".$fdesde."/".$fhasta;
      
      
      
      $query=$this->db->get("meses");
      $data["meses"]=$query->result();
      
      $data["content"]="reporteviaje_viewlist";
      $this->load->view("reporteindex",$data);
     }
     else 
      redirect("inicio/denied");
   }
   
   
     public function pdfranking()
   {
    if ( $this->Current_User->isHabilitado("PRINTRKUSUARIO")) {
     $fecha=$this->db->escape_str($this->uri->segment(3)); 
     $fhasta=$this->db->escape_str($this->uri->segment(4));
     
     $this->load->plugin('to_pdf');
     $html = file_get_contents(site_url()."pdf/makepdfranking/$fecha/$fhasta");
     pdf_create($html, "ranking_$fecha");
    }
    else
     redirect("inicio/denied");
   }
   
      public function pdfrankingCliente()
   {
     if ( $this->Current_User->isHabilitado("PRINTRKCLIENTE")) {
    ini_set('memory_limit','128M');
     $this->load->helper('file'); 
     $fecha=$this->db->escape_str($this->uri->segment(3)); 
     $fhasta=$this->db->escape_str($this->uri->segment(4));
     
     $this->load->plugin('to_pdf');
     $html = file_get_contents(site_url()."pdf/makepdfrankingcliente/$fecha/$fhasta");
     
     pdf_create($html, "rankingCliente_$fecha",false);
     }
     else
         redirect("inicio/denied");
   }
   
    public function pdfmovil()
   {
     if ( $this->Current_User->isHabilitado("PRINTMOVIL")) {
    if ($this->uri->segment(4)){
     $movil=$this->db->escape_str($this->uri->segment(3));
     $fecha=$this->db->escape_str($this->uri->segment(4)); 
     $fhasta=$this->db->escape_str($this->uri->segment(5));
     $see=0;
     if ($this->Current_User->isHabilitado("TOTALMOVIL"))
        $see=1;
     
     $this->load->plugin('to_pdf');
     $html = file_get_contents(site_url()."pdf/makepdfmovil/$movil/$fecha/$fhasta/$see");
     pdf_create($html, "movil_recaudacion$fecha");
     
    }
      
    else
       show_404();
    }
    else
         redirect("inicio/denied"); 
   }
   
   
   public function pdfxday()
   {
    
    if ( $this->Current_User->isHabilitado("PRINTRECDAY")) {
    if ($this->uri->segment(4)){
     $movil=$this->db->escape_str($this->uri->segment(3));
     $fecha=$this->db->escape_str($this->uri->segment(4)); 
     $tipo=$this->db->escape_str($this->uri->segment(5));
     $see=0;
     if ($this->Current_User->isHabilitado("TOTALRECMOVILDIA"))
        $see=1;
     
     $this->load->plugin('to_pdf');
     $html = file_get_contents(site_url()."pdf/makepdfxday/$movil/$fecha/$tipo/$see");
     pdf_create($html, "recaudacion$fecha");
     
    }
      
    else
       show_404();
    }
    else
        redirect("inicio/denied"); 
       
   }
   
   public function pdfreca()
   {
    if ( $this->Current_User->isHabilitado("PRINTRECMOVIL")) {
    if ($this->uri->segment(4)){
     $movil=$this->db->escape_str($this->uri->segment(3));
     $fdesde=$this->db->escape_str($this->uri->segment(4)); 
     $fhasta=$this->db->escape_str($this->uri->segment(5));
     $see=0;
     if ($this->Current_User->isHabilitado("TOTALRECMOVIL"))
        $see=1;
     
     $this->load->plugin('to_pdf');
     $html = file_get_contents(site_url()."pdf/makepdfreca/$movil/$fdesde/$fhasta/$see");
     pdf_create($html, "recaudacion$fdesde");
     
    }
      
    else
       show_404();
    }
    else
        redirect("inicio/denied"); 
   }
   
   public function ctaCliente()
   {
     if ( $this->Current_User->isHabilitado("CTACLIENTE") )
    {
      
        $query=$this->db->get("meses");
        $data["meses"]=$query->result();
        $data["content"]="cta_cliente";
        $this->load->view("reporteindex",$data);
     }
     else
        redirect("inicio/denied");
   
   
   }
   
   public function generateCtaCliente()
   {
    
   
       $telefono='';
       $fdesde=date("Ymd");
       $fhasta=date("Ymd");
       $tipo='';
   
    if ($this->input->post("telefono"))
       $telefono=$this->db->escape_str($this->input->post("telefono"));
       
     $data["telefono"]=$telefono;
    
     if ($this->input->post("day") && $this->input->post("month") && $this->input->post("year"))
       $fdesde=$this->db->escape_str($this->input->post("year")).str_pad($this->db->escape_str($this->input->post("month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("day")),2,"0",STR_PAD_LEFT);
    
     $data["fdesde"]=$fdesde;
    
    if ($this->input->post("hday") && $this->input->post("hmonth") && $this->input->post("hyear"))
       $fhasta=$this->db->escape_str($this->input->post("hyear")).str_pad($this->db->escape_str($this->input->post("hmonth")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("hday")),2,"0",STR_PAD_LEFT);
    
     $data["fhasta"]=$fhasta;
    if ($this->input->post("tipo"))
       $tipo=$this->db->escape_str($this->input->post("tipo"));
      
      
      
      $data["viajes"]=$this->flete->getCtaCteCliente($fdesde,$fhasta,$tipo,$telefono);
      $sql="select c.* from clientes c, phones p where p.clienteid=c.id and
       p.phone = '".$telefono."'";
       $query=$this->db->query($sql);
      
      $data["cliente"]=$query->result();
       
      $data["opciones"]=$telefono."/".$fdesde."/".$fhasta."/".$tipo;
      $data["content"]="cta_clienteview";
      $this->load->view("reporteindex",$data); 
   
   
   }
   
    public function pdfctaCliente()
   {
    
      if ( $this->Current_User->isHabilitado("PRINTCTACLIENTE") )
    {
    if ($this->uri->segment(4)){
     $telefono=$this->db->escape_str($this->uri->segment(3));
     $fdesde=$this->db->escape_str($this->uri->segment(4)); 
     $fhasta=$this->db->escape_str($this->uri->segment(5));
     $tipo=$this->db->escape_str($this->uri->segment(6));
     $see=0;
     if ($this->Current_User->isHabilitado("TOTALCTACLIENTE"))
        $see=1;
    
     $this->load->plugin('to_pdf');
     $html = file_get_contents(site_url()."pdf/makepdfctaCliente/$telefono/$fdesde/$fhasta/$tipo/$see");
     pdf_create($html, "ctaCliente_$telefono");
     
    }
      
    else
       show_404();
    }
    else
        redirect("inicio/denied");
   }
   
   public function tiempoUltimoViaje()
   {
        if ( $this->Current_User->isHabilitado("TIEMPOULTVIAJE") )
    {
      $tiempo=7; //por default hace + 7 días
      
      if ($this->input->post("days") )
       $tiempo=$this->db->escape_str($this->input->post("days"));
    
      $data["tiempo"]=$tiempo;
        
          
         $data["viajes"]= $this->flete->getUltimoViaje($tiempo);
          
        $data["opciones"]=$tiempo;
          $data["content"]="reporteultimoViaje";
          $this->load->view("reporteindex",$data);
    }
        else
        redirect("inicio/denied");
   
   }
   
   public function pdfultimoviaje()
   {
         if ( $this->Current_User->isHabilitado("PRINTULTVIAJE") )
    {
       $tiempo=$this->uri->segment(3);
       $this->load->plugin('to_pdf');
       $html = file_get_contents(site_url()."pdf/makepdfultimoviaje/$tiempo");
       pdf_create($html, "ultimoViaje");
    
     }
     else
       redirect("inicio/denied");
   }
   
   
  }
?>

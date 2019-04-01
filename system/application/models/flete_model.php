<?php
class Flete_model extends Model{

	

	function __construct() {
    parent::Model();  
    
  }
  
  function fechaVencida($fecha){
     $year=substr($fecha,0,4);
     $day=substr($fecha,6,2);
     $month=substr($fecha,4,2);
     $timestamp1= mktime(0,0,0,$month,$day,$year);
     $timestamp2=strtotime("now");
     
       if ($timestamp1 <= $timestamp2)
         return false;
       else
         return true;  
  
  }

  function fecha24XVencer($fecha){
    $year=substr($fecha,0,4);
    $day=substr($fecha,6,2);
    $month=substr($fecha,4,2);
    $timestamp1= mktime(0,0,0,$month,$day,$year);
    $timestamp2=strtotime("+1 day");
    
      if ($timestamp1 <= $timestamp2)
        return false;
      else
        return true;  
 
 }

 function fecha48XVencer($fecha){
  $year=substr($fecha,0,4);
  $day=substr($fecha,6,2);
  $month=substr($fecha,4,2);
  $timestamp1= mktime(0,0,0,$month,$day,$year);
  $timestamp2=strtotime("+2 day");
  
    if ($timestamp1 <= $timestamp2)
      return false;
    else
      return true;  

}
  
  
  public function reservalock($id)
   {
      $this->db->trans_start();
      $query=$this->db->get_where("reservas",array("id"=>$id));
      $reserva=$query->result();
      $lockeo=false;
      if (isset( $reserva[0]) && $reserva[0]->bloqueado == 0)
      {
         $record=array(
          'bloqueado'=>1,
          'bloqueado_by'=>$this->Current_User->getUsername()
         );
         $this->db->update("reservas",$record,array("id"=>$id));
         $lockeo=true;
      }
      else{ //si soy yo el que lo lockeo me debe permitir ingresar
        if (isset($reserva[0]) && $reserva[0]->bloqueado == 1 && $reserva[0]->bloqueado_by == $this->Current_User->getUsername())
           $lockeo=true;
      }
      $this->db->trans_complete();
      return $lockeo;
   }
   
   function verificaDocMovil($nromovil){
        $query=$this->db->get_where("movil",array("active"=>1,"movil"=>$nromovil));
        $movil=$query->result();
        if (isset($movil[0]))
        {
          if ($movil[0]->noverifica_documentacion == 1)
            return true;
          else{
            
              $vence_seguro = $this->flete->fechaVencida($movil[0]->vence_seguro);
              $vence_ruta = $this->flete->fechaVencida($movil[0]->vence_ruta);
              $vence_vtv = $this->flete->fechaVencida($movil[0]->vence_vtv);
              $vence_moyano = $this->flete->fechaVencida($movil[0]->vence_moyano);
              $vence_sacta = $this->flete->fechaVencida($movil[0]->vence_sacta);
              $sql="select c.* from choferes c, movil_chofer m where m.movilid=".$movil[0]->id." and m.choferid=c.id";
              $query=$this->db->query($sql);
              $chofer=$query->result();
              $vence_registro = $this->flete->fechaVencida($chofer[0]->vence_registro);
              return ($vence_seguro && $vence_ruta && $vence_vtv && $vence_moyano && $vence_sacta && $vence_registro);
          
          }
       } else{
          return false;
       }
 
   }

   function DocMovilVencida($nromovil){
      $query=$this->db->get_where("movil",array("active"=>1,"movil"=>$nromovil));
      $movil=$query->result();
      $vencido=array();
      if (isset($movil[0])){
        $vence_seguro = $this->flete->fechaVencida($movil[0]->vence_seguro);
        if(!$vence_seguro){
          $vencido[]=array("texto"=>$nromovil." VENCIDO SEGURO ","className"=>"error");
        }elseif(!$this->flete->fecha24XVencer($movil[0]->vence_seguro)){
          $vencido[]=array("texto"=>$nromovil." VENCE SEGURO 24HS","className"=>"warning1");
        }else{
          if (!$this->flete->fecha48XVencer($movil[0]->vence_seguro)){
            $vencido[]=array("texto"=>$nromovil." VENCE SEGURO 48HS","className"=>"warning2");
          }
        }
        $vence_ruta = $this->flete->fechaVencida($movil[0]->vence_ruta);
        if(!$vence_ruta){
          $vencido[]=array("texto"=>$nromovil." VENCIDO RUTA ","className"=>"error");
        }elseif(!$this->flete->fecha24XVencer($movil[0]->vence_ruta)){
          $vencido[]=array("texto"=>$nromovil." VENCE RUTA 24HS","className"=>"warning1");
        }else{
          if (!$this->flete->fecha48XVencer($movil[0]->vence_ruta)){
            $vencido[]=array("texto"=>$nromovil." VENCE RUTA 48HS","className"=>"warning2");
          }
        }
        $vence_vtv = $this->flete->fechaVencida($movil[0]->vence_vtv);
        if(!$vence_vtv){
          $vencido[]=array("texto"=>$nromovil." VENCIDO VTV ","className"=>"error");
        }elseif(!$this->flete->fecha24XVencer($movil[0]->vence_vtv)){
          $vencido[]=array("texto"=>$nromovil." VENCE VTV 24HS","className"=>"warning1");
        }else{
          if (!$this->flete->fecha48XVencer($movil[0]->vence_vtv)){
            $vencido[]=array("texto"=>$nromovil." VENCE VTV 48HS","className"=>"warning2");
          }
        }
        $vence_moyano = $this->flete->fechaVencida($movil[0]->vence_moyano);
        if(!$vence_moyano){
          $vencido[]=array("texto"=>$nromovil." VENCIDO MOYANO ","className"=>"error");
        }elseif(!$this->flete->fecha24XVencer($movil[0]->vence_moyano)){
          $vencido[]=array("texto"=>$nromovil." VENCE MOYANO 24HS","className"=>"warning1");
        }else{
          if (!$this->flete->fecha48XVencer($movil[0]->vence_moyano)){
            $vencido[]=array("texto"=>$nromovil." VENCE MOYANO 48HS","className"=>"warning2");
          }
        }
        $vence_sacta = $this->flete->fechaVencida($movil[0]->vence_sacta);
        if(!$vence_sacta){
          $vencido[]=array("texto"=>$nromovil." VENCIDO SACTA ","className"=>"error");
        }elseif(!$this->flete->fecha24XVencer($movil[0]->vence_sacta)){
          $vencido[]=array("texto"=>$nromovil." VENCE SACTA 24HS","className"=>"warning1");
        }else{
          if (!$this->flete->fecha48XVencer($movil[0]->vence_sacta)){
            $vencido[]=array("texto"=>$nromovil." VENCE SACTA 48HS","className"=>"warning2");
          }
        }
        $sql="select c.* from choferes c, movil_chofer m where m.movilid=".$movil[0]->id." and m.choferid=c.id";
        $query=$this->db->query($sql);
        $chofer=$query->result();
        $vence_registro = $this->flete->fechaVencida($chofer[0]->vence_registro);
        if(!$vence_registro){
          $vencido[]=array("texto"=>$nromovil." VENCIDO REGISTRO ","className"=>"error");
        }elseif(!$this->flete->fecha24XVencer($chofer[0]->vence_registro)){
          $vencido[]=array("texto"=>$nromovil." VENCE REGISTRO 24HS","className"=>"warning1");
        }else{
          if (!$this->flete->fecha48XVencer($chofer[0]->vence_registro)){
            $vencido[]=array("texto"=>$nromovil." VENCE REGISTRO 48HS","className"=>"warning2");
          }
        }
        return $vencido;
      }else{
        return null;
      }
   }
   
   function ordenamiento($base)
   {
       $this->db->order_by("ordenbase asc");
       $query=$this->db->get_where("movil",array("baseid"=>$base,"active"=>1));
       $i=1;
       foreach($query->result() as $row)
       {
       
          $this->db->update("movil",array("ordenbase"=>$i),array("id"=>$row->id)); 
           $i++;
       
       }
   
   
   }
  
  function getReservasTotal()
  {  //reservas aun sin despachar ni cancelar
    $fdesde=date("Ymd");
     $sql="select count(*) as total from reservas 
            where  
            fecha = $fdesde
            and  cancelado=0 and despachado = 0
            ";
     $query=$this->db->query($sql);
     $total=$query->result();
     $reservas=$total[0]->total;
     
     $sql="select count(*) as total from viajes 
            where viajes.cerrado = 0 and viajes.cancelado = 0 and 
            viajes.fecha_despacho=$fdesde";
     $query=$this->db->query($sql);
     $total=$query->result();
     
     $despachados=$total[0]->total;
     
     $realizados=$this->getViajesRealizados();
     $cancelados=$this->getViajesCancelados();
     
     $totalviajes=$reservas+ $despachados +  $realizados+ $cancelados ; 
      
     
     return $totalviajes;
  
  }
  
  function getViajesRealizados()
  {  
    $fdesde=date("Ymd");
     $sql="select count(*) as total from viajes 
            where viajes.cerrado = 1 and 
            viajes.fecha_despacho=$fdesde";
     $query=$this->db->query($sql);
     $total=$query->result();
     return $total[0]->total;
  
  }
  
  function getViajesCancelados()
  {
     $fdesde=date("Ymd");
     $sql="select count(*) as total from viajes 
            where viajes.cancelado = 1 and 
            viajes.fecha_despacho=$fdesde";
     $query=$this->db->query($sql);
     $total=$query->result();
     $viajes_cancelados=$total[0]->total;
     
     $sql="select count(*) as total from reservas 
            where cancelado = 1 and 
            fecha = $fdesde";
     $query=$this->db->query($sql);
     $total=$query->result();
     $reserva_cancelados=$total[0]->total;
     
     return ($viajes_cancelados+$reserva_cancelados);
  }
  
  function startPost() {
        echo "<input type='hidden' name='postID' ";
        echo "value='".md5(uniqid(rand(), true))."'>";
    }
    
   function postBlock($postID) {
        
        if($this->session->userdata('postID')) {
            if ($postID == $this->session->userdata('postID')) {
                return false;
            } else {
                $this->session->set_userdata('postID',$postID);
                return true;
            }
        } else {
            $this->session->set_userdata('postID',$postID);
            return true;
        }
    }
    
    public function getRankingCliente($fdesde,$fhasta)
    {
      $sql="SELECT  c.id as clienteid, c.name as cliente, p.phone as tel,count( * ) as cantidad , sum(v.valor) as total 
           FROM viajes v
           inner join clientes c on v.clienteid=c.id
           inner join phones p on p.clienteid=c.id  
           
           where v.fecha_despacho between '$fdesde' and '$fhasta'
           and p.principal=1
           GROUP BY v.clienteid
           order by cantidad desc, total desc
          ";  
      $query=$this->db->query($sql);
      return $query;
    
    } 
    
    
    public function getRecaudacionGralMudanza($fdesde,$fhasta){
       //SUMO TODOS LAS MUDANZAS DE LOS VIAJES 
       //NO DISTINGO EFVO Y CTA CTE
        $sql= "SELECT 
            sum(v.mudanza) as total_mudanza,
            m.movil as movil, v.movilid
            FROM `viajes` v,movil m, reservas r
            where v.cerrado=1  and v.movilid=m.id 
            and r.id=v.reservaid and r.hasMudanza=1
            and v.fecha_comisionar between $fdesde and $fhasta
            group by v.movilid, movil
            order by movil
            ";
          $query=$this->db->query($sql);
          $viajes=$query->result(); 
          $mudanza=array();
          foreach($viajes as $v){
              
              $mudanza[$v->movil]["total_mudanza"]=$v->total_mudanza;
          
          }
          return $mudanza;
    }
    
    public function getRecaudacionGral($fdesde,$fhasta)
    {
    //obtengo cantidad de viajes - total de lo que se pone en subtotal y datos del chofer y movil
    $sql= "
            SELECT  count(v.id) as cant_viajes,sum(v.valor) as total,
            m.movil as movil, c.name as name, c.lastname as lastname, v.movilid
            FROM `viajes` v,reservas r,movil m,choferes c, movil_chofer mc
            where v.cerrado=1  and v.movilid=m.id 
            and v.fecha_comisionar between $fdesde and $fhasta
            and m.id=mc.movilid and c.id=mc.choferid
            and r.id=v.reservaid 
            group by v.movilid, movil, name, lastname
            order by movil
            ";

   
   
    $query=$this->db->query($sql);
    $viajes=$query->result(); 
    
    
    
    //obtener los viajes del periodo que se pagan en efectivo
     $sql= "SELECT sum(v.valor) as total_efvo,
            sum(v.peones) as total_peon,
            sum(v.km) as total_km,
            sum(v.peaje) as total_peaje,
            sum(v.estacionamiento) as total_estac,
            sum(v.otros) as total_otros,
            sum(v.espera) as total_espera,
            sum(r.monto_excedente) as total_seguro,
            sum(r.art_valor) as total_art,
            sum(v.porcentaje_ctacte) as total_porcentajecc,
            sum(v.iva) as total_iva,
            m.movil as movil, v.movilid
            FROM `viajes` v,movil m, reservas r
            where v.cerrado=1  and v.movilid=m.id 
            and r.id=v.reservaid
            and v.fecha_comisionar between $fdesde and $fhasta
            and v.forma_pago=1
            group by v.movilid, movil
            order by movil
            ";
    $query=$this->db->query($sql);
    $viajes_efvo=$query->result(); 
   
     //obtener los viajes del periodo que se pagan en cc
     $sql= "SELECT sum(v.valor) as total_ctacte,
            sum(v.peones) as total_peon,
            sum(v.km) as total_km,
            sum(v.peaje) as total_peaje,
            sum(v.estacionamiento) as total_estac,
            sum(v.otros) as total_otros,
            sum(v.espera) as total_espera,
            sum(r.monto_excedente) as total_seguro,
            sum(r.art_valor) as total_art,
            sum(v.porcentaje_ctacte) as total_porcentajecc,
            sum(v.iva) as total_iva,
            m.movil as movil, 
            v.movilid
            FROM `viajes` v,movil m, reservas r
            where v.cerrado=1  and v.movilid=m.id 
            and r.id=v.reservaid 
            and v.fecha_comisionar between $fdesde and $fhasta
            and v.forma_pago=2
            group by v.movilid, movil
            order by movil
            ";
            
    $query=$this->db->query($sql);
    $viajes_ctacte=$query->result();
    
     $listado=array(); 
     foreach($viajes as $v)
     {
           $listado[$v->movil]["total"]=$v->total;
           $listado[$v->movil]["cant_viajes"]=$v->cant_viajes;
           $listado[$v->movil]["movil"]=$v->movil;
           $listado[$v->movil]["chofer"]=$v->name." ".$v->lastname;
           $listado[$v->movil]["total_peon_efvo"]=0;
           $listado[$v->movil]["total_peon_cc"]=0;
           $listado[$v->movil]["total_km_efvo"]=0;
           $listado[$v->movil]["total_km_cc"]=0;
           $listado[$v->movil]["total_espera_efvo"]=0;
           $listado[$v->movil]["total_espera_cc"]=0;
           $listado[$v->movil]["total_estac_efvo"]=0;
           $listado[$v->movil]["total_estac_cc"]=0;
           $listado[$v->movil]["total_otro_efvo"]=0;
           $listado[$v->movil]["total_otro_cc"]=0;
           $listado[$v->movil]["total_peaje_efvo"]=0;
           $listado[$v->movil]["total_peaje_cc"]=0;
           $listado[$v->movil]["total_seguro_efvo"]=0;
           $listado[$v->movil]["total_seguro_cc"]=0;
           $listado[$v->movil]["total_ctacte"]=0;
           $listado[$v->movil]["total_efvo"]=0;
           $listado[$v->movil]["total_art_efvo"]=0;
           $listado[$v->movil]["total_art_cc"]=0;
           $listado[$v->movil]["total_art"]=0;
           $listado[$v->movil]["total_porcentajecc_cc"]=0;
           $listado[$v->movil]["total_porcentajecc"]=0;
           $listado[$v->movil]["total_iva_efvo"]=0;
           $listado[$v->movil]["total_iva_cc"]=0;
           $listado[$v->movil]["total_iva"]=0;
           $listado[$v->movil]["totalcc"]=0;
           $listado[$v->movil]["total_contado"]=0;
           $listado[$v->movil]["parcial_cc"]=0;
           $listado[$v->movil]["parcial_efvo"]=0;           
           $listado[$v->movil]["total_mudanza"]=0;
           foreach($viajes_efvo as $e)
            {
                if ($e->movil == $v->movil)
                 { $listado[$v->movil]["total_efvo"]=$e->total_efvo;
                   $listado[$v->movil]["total_peon_efvo"]=$e->total_peon;
                   $listado[$v->movil]["total_km_efvo"]=$e->total_km;
                   $listado[$v->movil]["total_espera_efvo"]=$e->total_espera;
                   $listado[$v->movil]["total_estac_efvo"]=$e->total_estac;
                   $listado[$v->movil]["total_otro_efvo"]=$e->total_otros;
                   $listado[$v->movil]["total_peaje_efvo"]=$e->total_peaje;
                   $listado[$v->movil]["total_seguro_efvo"]=$e->total_seguro;
                   $listado[$v->movil]["total_art_efvo"]=$e->total_art;
                   $listado[$v->movil]["total_iva_efvo"]=$e->total_iva;
                 }
              
            }
          foreach($viajes_ctacte as $c)
            {
                if ($c->movil == $v->movil)
                {  $listado[$v->movil]["total_ctacte"]=$c->total_ctacte;
                   $listado[$v->movil]["total_peon_cc"]=$c->total_peon;
                   $listado[$v->movil]["total_km_cc"]=$c->total_km;
                   $listado[$v->movil]["total_espera_cc"]=$c->total_espera;
                   $listado[$v->movil]["total_estac_cc"]=$c->total_estac;
                   $listado[$v->movil]["total_otro_cc"]=$c->total_otros;
                   $listado[$v->movil]["total_peaje_cc"]=$c->total_peaje;
                   $listado[$v->movil]["total_seguro_cc"]=$c->total_seguro;
                   $listado[$v->movil]["total_art_cc"]=$c->total_art;
                   $listado[$v->movil]["total_porcentajecc_cc"]=$c->total_porcentajecc;
                   $listado[$v->movil]["total_iva_cc"]=$c->total_iva;
                }
              
            }
         
         $listado[$v->movil]["total_peon"]=$listado[$v->movil]["total_peon_cc"]+ $listado[$v->movil]["total_peon_efvo"];
         $listado[$v->movil]["total_km"]=$listado[$v->movil]["total_km_cc"]+ $listado[$v->movil]["total_km_efvo"];
         $listado[$v->movil]["total_espera"]=$listado[$v->movil]["total_espera_cc"]+$listado[$v->movil]["total_espera_efvo"];
         $listado[$v->movil]["total_estac"]=$listado[$v->movil]["total_estac_cc"]+$listado[$v->movil]["total_estac_efvo"];
         $listado[$v->movil]["total_otro"]=$listado[$v->movil]["total_otro_cc"]+$listado[$v->movil]["total_otro_efvo"];
         $listado[$v->movil]["total_peaje"]=$listado[$v->movil]["total_peaje_cc"]+$listado[$v->movil]["total_peaje_efvo"];
         $listado[$v->movil]["total_seguro"]=$listado[$v->movil]["total_seguro_cc"]+$listado[$v->movil]["total_seguro_efvo"];
         $listado[$v->movil]["total_art"]=$listado[$v->movil]["total_art_cc"]+$listado[$v->movil]["total_art_efvo"];
        
         $listado[$v->movil]["total_porcentajecc"]=$listado[$v->movil]["total_porcentajecc_cc"];
         $listado[$v->movil]["total_iva"]=$listado[$v->movil]["total_iva_cc"]+$listado[$v->movil]["total_iva_efvo"];
          //REVISAR  
          //total de cc suma todo  
         $listado[$v->movil]["totalcc"]=$listado[$v->movil]["total_ctacte"]+$listado[$v->movil]["total_peon_cc"]+$listado[$v->movil]["total_espera_cc"] + $listado[$v->movil]["total_km_cc"]+
                                 $listado[$v->movil]["total_estac_cc"]+$listado[$v->movil]["total_otro_cc"]+$listado[$v->movil]["total_peaje_cc"]+
                                 $listado[$v->movil]["total_seguro_cc"]+$listado[$v->movil]["total_art_cc"]+$listado[$v->movil]["total_porcentajecc_cc"]
                                 ;
          //REVISAR        
          //total de contado suma todo               
         $listado[$v->movil]["total_contado"]=$listado[$v->movil]["total_efvo"]+$listado[$v->movil]["total_espera_efvo"]+$listado[$v->movil]["total_peon_efvo"]+$listado[$v->movil]["total_km_efvo"]+
                                              $listado[$v->movil]["total_estac_efvo"]+$listado[$v->movil]["total_otro_efvo"]+$listado[$v->movil]["total_peaje_efvo"]+
                                              $listado[$v->movil]["total_seguro_efvo"]+$listado[$v->movil]["total_art_efvo"]+
                                              $listado[$v->movil]["total_iva_efvo"];
                                
         
         
     }
       
       $mudanza=$this->getRecaudacionGralMudanza($fdesde,$fhasta);
     
       foreach($mudanza as $k=>$v){
        $listado[$k]["total_mudanza"]=$v["total_mudanza"];
       }
       $comisionar = $this->getComisionar($fdesde,$fhasta);
       foreach($comisionar as $k=>$v){
        $listado[$k]["parcial_cc"]=$v["parcial_cc"];
        $listado[$k]["parcial_efvo"]=$v["parcial_efvo"];
       }
       
      
      return $listado;
    }
    
    public function getComisionar($fdesde,$fhasta){
        // NO DEBERIA SUMAR PEONES Y KM ??
    
         $sql= "SELECT count(v.id) as cant_viajes,sum(v.valor) as total,
            m.movil as movil, c.name as name, c.lastname as lastname, v.movilid
            FROM `viajes` v,reservas r,movil m,choferes c, movil_chofer mc
            where v.cerrado=1  and v.movilid=m.id 
            and v.fecha_comisionar between $fdesde and $fhasta
            and m.id=mc.movilid and c.id=mc.choferid
            and r.id=v.reservaid and r.hasMudanza=0
            group by v.movilid, movil, name, lastname
            order by movil
            ";

   
   
    $query=$this->db->query($sql);
    $viajes=$query->result(); 
    
    
    
    
     $sql= "SELECT sum(v.valor) as total_efvo,
            sum(v.peones) as total_peon,
            sum(v.km) as total_km,
            sum(v.peaje) as total_peaje,
            sum(v.estacionamiento) as total_estac,
            sum(v.otros) as total_otros,
            sum(v.espera) as total_espera,
            sum(r.monto_excedente) as total_seguro,
            sum(r.art_valor) as total_art,
            sum(v.porcentaje_ctacte) as total_porcentajecc,
            sum(v.iva) as total_iva,
            m.movil as movil, 
            v.movilid
            FROM `viajes` v,movil m, reservas r
            where v.cerrado=1  and v.movilid=m.id 
            and r.id=v.reservaid and r.hasMudanza=0
            and v.fecha_comisionar between $fdesde and $fhasta
            and v.forma_pago=1
            group by v.movilid, movil
            order by movil
            ";
    $query=$this->db->query($sql);
    $viajes_efvo=$query->result(); 
   
    
     $sql= "SELECT sum(v.valor) as total_ctacte,
            sum(v.peones) as total_peon,
            sum(v.km) as total_km,
            sum(v.peaje) as total_peaje,
            sum(v.estacionamiento) as total_estac,
            sum(v.otros) as total_otros,
            sum(v.espera) as total_espera,
            sum(r.monto_excedente) as total_seguro,
            sum(r.art_valor) as total_art,
            sum(v.porcentaje_ctacte) as total_porcentajecc,
            sum(v.iva) as total_iva,
            m.movil as movil,
            v.movilid
            FROM `viajes` v,movil m, reservas r
            where v.cerrado=1  and v.movilid=m.id 
            and r.id=v.reservaid  and r.hasMudanza=0
            and v.fecha_comisionar between $fdesde and $fhasta
            and v.forma_pago=2
            group by v.movilid, movil
            order by movil
            ";
            
    $query=$this->db->query($sql);
    $viajes_ctacte=$query->result();
    
     $listado=array(); 
     foreach($viajes as $v)
     {
          
           $listado[$v->movil]["total_peon_efvo"]=0;
           $listado[$v->movil]["total_peon_cc"]=0;
           $listado[$v->movil]["total_km_efvo"]=0;
           $listado[$v->movil]["total_km_cc"]=0;
           $listado[$v->movil]["total_espera_efvo"]=0;
           $listado[$v->movil]["total_espera_cc"]=0;
           $listado[$v->movil]["total_otro_efvo"]=0;
           $listado[$v->movil]["total_otro_cc"]=0;
           $listado[$v->movil]["total_ctacte"]=0;
           $listado[$v->movil]["total_efvo"]=0;
           $listado[$v->movil]["totalcc"]=0;
           $listado[$v->movil]["total_contado"]=0;
           $listado[$v->movil]["parcial_cc"]=0;
           $listado[$v->movil]["parcial_efvo"]=0;
           $listado[$v->movil]["total_porcentajecc_cc"]=0; 
          
          foreach($viajes_efvo as $e)
            {
                if ($e->movil == $v->movil)
                 { $listado[$v->movil]["total_efvo"]=$e->total_efvo;
                   $listado[$v->movil]["total_peon_efvo"]=$e->total_peon;
                   $listado[$v->movil]["total_km_efvo"]=$e->total_km;
                   $listado[$v->movil]["total_espera_efvo"]=$e->total_espera;
                   $listado[$v->movil]["total_otro_efvo"]=$e->total_otros;
                 }
              
            }
          foreach($viajes_ctacte as $c)
            {
                if ($c->movil == $v->movil)
                {  $listado[$v->movil]["total_ctacte"]=$c->total_ctacte;
                   $listado[$v->movil]["total_peon_cc"]=$c->total_peon;
                   $listado[$v->movil]["total_km_cc"]=$c->total_km;
                   $listado[$v->movil]["total_espera_cc"]=$c->total_espera;
                   $listado[$v->movil]["total_otro_cc"]=$c->total_otros;
                   $listado[$v->movil]["total_porcentajecc_cc"]=$c->total_porcentajecc;
                
                }
              
            } 
       
         $listado[$v->movil]["parcial_cc"]= $listado[$v->movil]["total_ctacte"] + $listado[$v->movil]["total_espera_cc"] + 
                                            $listado[$v->movil]["total_otro_cc"] + $listado[$v->movil]["total_peon_cc"] +
                                            $listado[$v->movil]["total_km_cc"] ;
         $listado[$v->movil]["parcial_efvo"]= $listado[$v->movil]["total_efvo"] + $listado[$v->movil]["total_espera_efvo"] 
                                            + $listado[$v->movil]["total_otro_efvo"] + $listado[$v->movil]["total_peon_efvo"] +
                                            $listado[$v->movil]["total_km_efvo"]  ;
      }
      
      return $listado;
    }
    
    public function getRecaudacionxDay($fecha, $movil, $tipo)
    {
    $sql =" select v.*,r.desde, r.destino,r.monto_excedente,r.art_valor,
              m.movil, c.name as cliente  from viajes v,reservas r, movil m, 
               clientes c where
              r.id=v.reservaid and m.id=v.movilid and v.clienteid = c.id
              and fecha_comisionar=$fecha and (v.cerrado=1 or v.cancelado =1)
       ";
     
    
      if ($movil) //muestro viajes de un solo movil
         $sql .=" and m.movil=$movil";
      if ($tipo == 1) //solo los viajes al contado
         $sql .= " and v.forma_pago = 1"; 
      if ($tipo == 2) //solo los viajes en cta cte
         $sql .= " and v.forma_pago = 2";
       
          
      $query=$this->db->query($sql);
      return $query->result();
    
    }
    
    public function getRecaudacionMovil($fdesde,$fhasta,$movil)
    {
        $sql="select v.*,r.desde, r.destino,r.monto_excedente, m.movil,c.name as cliente,
        r.art_valor 
        from viajes v, reservas r, movil m,
              clientes c where 
                ";
         
        $sql .="  (v.cerrado=1 or v.cancelado =1)
                    and v.fecha_comisionar between $fdesde and $fhasta    
                    and v.movilid=m.id
                    and v.reservaid = r.id
                    and v.clienteid = c.id";
        if ($movil != 0)
             $sql .=" and m.movil=$movil ";
                         
        $sql .="     order by r.fecha desc, r.hsalida asc  ";      
           
         $query=$this->db->query($sql);
          return $query->result();
    }
    
    public function getCtaCteCliente($fdesde,$fhasta,$tipo,$telefono)
    {
    
    $sql="select distinct v.id as viaje, c.name as cliente,r.desde, r.destino, r.monto_excedente as seguro,
            r.art_valor, v.valor,v.voucher,v.fecha_despacho,v.fecha_comisionar,v.fecha_abordo,v.habordo, v.km,
            m.movil , v.forma_pago, v.peones, v.otros, v.espera, v.estacionamiento, v.peaje,
            v.mudanza, v.porcentaje_mudanza, v.porcentaje_ctacte, v.iva
            from viajes v,reservas r, clientes c,phones p,movil m where v.clienteid=c.id
            and p.phone='".$telefono."' and p.clienteid=c.id 
            and v.fecha_despacho between $fdesde and $fhasta ";
     if ($tipo !=3)       
            $sql .=" and v.forma_pago=$tipo ";
     
     $sql.=" and v.reservaid=r.id
            and v.cerrado=1
            and v.movilid = m.id
            order by v.fecha_despacho 
      ";
      
      
       
          
      $query=$this->db->query($sql);
      return $query->result();
    }
    
    public function getDataSesiones($fdesde,$fhasta,$user){
    
    $sql="select s.*,a.username from sessiones s, admusers a
           where a.id = s.iduser";
    
     if ($user != ""){
        $sql.=" and a.username like '%".$user."%'";
     }  
     if ($fdesde != "" && $fhasta != ""){
        $sql.=" and date_begin between '".$fdesde."' and '".$fhasta."'";
     }
     if ($fdesde != "" && $fhasta == ""){
        $sql.=" and date_begin >= '".$fdesde."'";
     }
     if ($fdesde == "" && $fhasta != ""){
        $sql.=" and date_begin <= '".$fhasta."'";
     }  
        $query=$this->db->query($sql);
        $users=$query->result();
        return $users;
    
    }
    
    public function getDataMoviles($fdesde,$fhasta,$movil)
    {
      $sql=" select t.*,  m.movil
          from  movil_trabaja t, movil m where 
          t.idmovil = m.id  
          and t.fecha_ingreso between $fdesde and $fhasta " ;
   if ($movil != 0)
      $sql.=" and m.movil = $movil ";
               
    
    $sql.="   order by t.hora_ingreso,m.movil ";        
 
    $query=$this->db->query($sql);
    $moviles=$query->result();
    
   
    $viajes=array();
    
    foreach($moviles as $m)
    {
      $viaje=array();
      
      $viaje["fecha_ingreso"]=$m->fecha_ingreso;
      $viaje["hora_ingreso"]=$m->hora_ingreso;
      $viaje["hora_egreso"]=$m->hora_egreso;
      $viaje["movil"]=$m->movil;
      $viaje["idmovil"]=$m->idmovil;
      $sql= "SELECT count(v.id) as cant_viajes,sum(v.valor) as total,
            sum(v.peones) as total_peon,
            sum(v.km) as total_km,
            sum(v.peaje) as total_peaje,
            sum(v.estacionamiento) as total_estac,
            sum(v.otros) as total_otros,
            sum(v.espera) as total_espera,
            sum(v.mudanza) as total_mudanza,
            sum(v.porcentaje_ctacte) as total_porcentajectacte,
            sum(r.monto_excedente) as total_seguro,
            sum(r.art_valor) as total_art,
            sum(v.iva) as total_iva
            FROM viajes v,reservas r
            where v.cerrado=1   
            and v.fecha_despacho=$m->fecha_ingreso ";
     if ($m->hora_egreso != '')       
           $sql .=" and v.hora_despacho between $m->hora_ingreso and $m->hora_egreso";
     else
           $sql .=" and v.hora_despacho >= $m->hora_ingreso";      
      $sql.="  and v.movilid=$m->idmovil            
            and r.id=v.reservaid
            group by v.movilid
            
            ";
           
     $query=$this->db->query($sql);
    
     $v=$query->result();
     if (isset($v[0])){
     $viaje["cant_viajes"]=$v[0]->cant_viajes;
     $viaje["peones"]=$v[0]->total_peon;
     $viaje["km"]=$v[0]->total_km;
     $viaje["peaje"]=$v[0]->total_peaje;
     $viaje["estac"]=$v[0]->total_estac;
     $viaje["otros"]=$v[0]->total_otros;
     $viaje["espera"]=$v[0]->total_espera;
     $viaje["seguro"]=$v[0]->total_seguro;
     $viaje["art"]=$v[0]->total_art;
     $viaje["mudanza"]=$v[0]->total_mudanza;
     $viaje["porcentaje_ctacte"]=$v[0]->total_porcentajectacte;
     $viaje["iva"]=$v[0]->total_iva;
     $t=$v[0]->total+$v[0]->total_peon+$v[0]->total_km+$v[0]->total_peaje+$v[0]->total_estac+$v[0]->total_otros+$v[0]->total_espera+$v[0]->total_seguro+$v[0]->total_art+$v[0]->total_porcentajectacte+$v[0]->total_iva;
     $viaje["total"]=$t;
       $sql= "SELECT sum(v.valor) as total_efvo,
            m.movil as movil
            FROM `viajes` v,movil m
            where v.cerrado=1  and v.movilid=m.id 
            and v.fecha_despacho=$m->fecha_ingreso";
          if ($m->hora_egreso != '')       
           $sql .=" and v.hora_despacho between $m->hora_ingreso and $m->hora_egreso";
         else
           $sql .=" and v.hora_despacho >= $m->hora_ingreso"; 
       
       $sql .="   and v.forma_pago=1
            and v.movilid = $m->idmovil
            group by v.movilid ";
            
    $query=$this->db->query($sql);
    $viajes_efvo=$query->result();
    if (isset($viajes_efvo[0])) 
      $viaje["efvo"]=$viajes_efvo[0]->total_efvo;
    else
      $viaje["efvo"]=0;
    
     $sql= "SELECT sum(v.valor) as total_ctacte,
            m.movil as movil
            FROM `viajes` v,movil m
            where v.cerrado=1  and v.movilid=m.id 
            and v.fecha_despacho= $m->fecha_ingreso";
       if ($m->hora_egreso != '')       
           $sql .=" and v.hora_despacho between $m->hora_ingreso and $m->hora_egreso";
      else
           $sql .=" and v.hora_despacho >= $m->hora_ingreso"; 
                
      $sql.="     and v.forma_pago=2
            and v.movilid = $m->idmovil
            group by v.movilid
            
            ";
    $query=$this->db->query($sql);
    $viajes_ctacte=$query->result();
    if (isset($viajes_ctacte[0]))
      $viaje["ctacte"]=$viajes_ctacte[0]->total_ctacte;
    else
    $viaje["ctacte"]=0;   
     
     
     $sql="select v.hora_despacho,v.id from viajes v where v.fecha_despacho = $m->fecha_ingreso";
     if ($m->hora_egreso != '')       
           $sql .=" and v.hora_despacho between $m->hora_ingreso and $m->hora_egreso";
     else
           $sql .=" and v.hora_despacho >= $m->hora_ingreso"; 
           
     $sql.="  and v.movilid=$m->idmovil order by v.id";
     
     $query=$this->db->query($sql);
     $t=$query->result();
     if (isset($t[0]))
     { $viaje["primero"]=$t[0]->hora_despacho;
       $viaje["idprimero"]=$t[0]->id;
     }
     else{
       $viaje["primero"]='';
       $viaje["idprimero"]='';
     } 
     }
     else{
     $viaje["cant_viajes"]=0;
     $viaje["peones"]=0;
     $viaje["km"]=0;
     $viaje["peaje"]=0;
     $viaje["estac"]=0;
     $viaje["otros"]=0;
     $viaje["espera"]=0;
     $viaje["seguro"]=0;
     $viaje["art"]=0;
     $viaje["total"]=0;
     $viaje["efvo"]=0;
     $viaje["ctacte"]=0;
     $viaje["primero"]=0;
     $viaje["idprimero"]=0;
     $viaje["iva"]=0;
     $viaje["mudanza"]=0;
    
     $viaje["porcentaje_ctacte"]=0;
     }
     $viajes[]=$viaje;
    }
    
    return $viajes;
    
    }
    
    public function getRankingUsuario($fdesde,$fhasta)
    {
    //repeticion=0 para que solo cuente una sola vez 
    // y no todas las repeticiones
    $sql="SELECT count( * ) as cantidad , reservo
           FROM reservas
           where fecha_reserva between $fdesde and $fhasta
           and repeticionid = 0
           GROUP BY reservo
           order by cantidad desc
          ";
    
     $query=$this->db->query($sql);
     $reservas=$query->result();
     
     $sql="SELECT count( * ) as cantidad , despacho
           FROM viajes
           where fecha_despacho between $fdesde and $fhasta
           GROUP BY despacho 
           order by cantidad desc
          ";
    $query=$this->db->query($sql);
    $despachos=$query->result();
    
    $sql="SELECT count( * ) as cantidad , cerrado_by
           FROM viajes
           where fecha_regreso between $fdesde and $fhasta
           GROUP BY cerrado_by
           order by cantidad desc
          ";      
    $query=$this->db->query($sql);
    $cerrados=$query->result();      
   
    
    $usuarios=array();
    
    foreach($reservas as $r)
    {
      
      $usuarios  [$r->reservo]["reservas"]=$r->cantidad;
    
    }
    
    foreach($despachos as $d)
    {
      
      $usuarios  [$d->despacho]["despachados"]=$d->cantidad;
    
    }
          
    foreach($cerrados as $c)
    {
      
      $usuarios  [$c->cerrado_by]["cerrados"]=$c->cantidad;
    
    }
      return $usuarios;
    }
    
    public function getSubpermisos($macro)
    {
      $query=$this->db->get_where("permisos",array("parentid"=>$macro));
        $subpermisos=$query->result();
        return $subpermisos;
      
    
    }

    public function referidosEstadisticas($fdesde, $fhasta){
      $sql="SELECT r.tipo, count(r.id) as total FROM `referidos` r INNER JOIN  clientes c ON c.id = r.clienteid 
               where c.fecha_ingreso between '$fdesde' and '$fhasta'
              group by r.tipo";
              
      $query=$this->db->query($sql);
      $resultados=$query->result(); 
      $referidos = array();
      foreach($resultados as $r){
        $referidos[$r->tipo]=$r->total;
      }
      return $referidos;
    }
    
    public function getUltimoViaje($days)
    {
        $inicio='';
        $fin='';
        
        switch ($days) {
          
          case 7:  $i=mktime(0,0,0,date("m"),date("d")-14,date("Y"));
                   $f=mktime(0,0,0,date("m"),date("d")-7,date("Y"));  
                   $inicio=date("Ymd",$i);
                   $final=date("Ymd",$f);
                   break;
          case 15: $i=mktime(0,0,0,date("m"),date("d")-19,date("Y"));
                   $f=mktime(0,0,0,date("m"),date("d")-15,date("Y"));  
                   $inicio=date("Ymd",$i);
                   $final=date("Ymd",$f);
                   break;
          
          case 20: $i=mktime(0,0,0,date("m"),date("d")-29,date("Y"));
                   $f=mktime(0,0,0,date("m"),date("d")-20,date("Y"));  
                   $inicio=date("Ymd",$i);
                   $final=date("Ymd",$f);
                   break;
          case 30: 
                   $f=mktime(0,0,0,date("m"),date("d")-30,date("Y"));  
                   
                   $final=date("Ymd",$f);
                   break;       
        
        
        }
        
        $sql=" select max(v.fecha_despacho) as fecha, v.clienteid as clienteid, c.name as nombre from viajes v inner join clientes c
               on v.clienteid = c.id where v.cerrado = 1";
        if ($inicio != '')
           $sql .= " and v.fecha_despacho between $inicio and $final";
        else
           $sql .= " and v.fecha_despacho <= $final ";     
      
       $sql .= " group by v.clienteid order by fecha";
      $query=$this->db->query($sql);
      $viajes=$query->result(); 
    
      return $viajes;
    }
  
  }
?>

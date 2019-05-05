<?php

class Viaje_model extends Model {

    function Viaje_model()
    {
     parent::Model();
  
     
    }    
    
  public function viajeAbiertos($user_id){

    $sql="select r.*, v.* from viajes v, reservas r where v.reservaid = r.id and v.clienteid = ".$user_id." 
                and v.cerrado=0 and v.cancelado = 0 order by fecha_despacho, hora_despacho";

    $query=$this->db->query($sql);
    return $query->result();
   
 }  



public function calcularComision($comision, $v){

  $recauda=0;
  $porcentaje=0;
  $peon=0;
  $km=0;
  $estacionamiento=0;
  $mudanza=0;
  $art=0;
  $pmovil=0;
  $pagencia=0;
  $cco=0;
  $saldo=0;
  $peaje=0;
  $iva=0;
  
 

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
    $estacionamiento +=$v->estacionamiento;
    $cco += $recauda; // resto tiempo espera + subtotal cuando es cuenta corriente
  }
  $art +=$v->art_valor;
  $mudanza += $v->mudanza;

  

  $porcentaje= round( ($recauda  * $comision) / 100, 2); 
 
  $data = array(
    'recaudacion'=>$recauda,
    'porcentaje'=>$porcentaje,
    'comision'=>$comision,
    'fecha'=>$v->fecha_comisionar,
    'viaje'=>$v->id,
    'descripcion'=> 'Recauda viaje ID '.$v->id,
    'idmovil'=>$v->movilid,
    'cco'=>$cco,
    'peon'=>$peon,
    'peaje'=>$peaje,
    'estacionamiento'=>$estacionamiento,
    'iva'=>$iva,
    'mudanza'=>$mudanza,
    'art'=>$art,
    'total'=>$porcentaje+$mudanza-$cco-$peon-$peaje-$estacionamiento+$iva+$art
  );
  return $data;
}
  //cada vez que se cierra un viaje hay que crear un ingreso en la diaria
//para calcular la comision de ese viaje
 public function updateDiaria($viajeId){
  $sql="select v.*, r.art_valor, r.hasMudanza from viajes v inner join reservas r on r.id = v.reservaid 
  where v.id = $viajeId";

  $query=$this->db->query($sql);
  $viajes=$query->result();



  $sql="select c.*,mc.movilid from choferes c, movil_chofer mc  
  where mc.choferid=c.id and mc.movilid=".$viajes[0]->movilid;
  //valor de comision de ese momento para el chofer
  $query=$this->db->query($sql);
  $chofer=$query->result();
  $comision=$chofer[0]->comision;

  $data = $this->calcularComision($comision, $viajes[0]);
  $this->db->insert("diaria",$data);
  $this->updateRecaudacion($data);
 }
 
 //cada vez que se modifica el valor de algun viaje hay que re-calcular todo
 //ingresarlo como movimiento pero restando del saldo y generar un nuevo movimiento
public function diffDiaria($viajeId){
  //resto lo anterior
  $sql=" select * from diaria WHERE viaje=".$viajeId." order by id desc limit 1";
  $query=$this->db->query($sql);
  $diaria=$query->result();
  if (count($diaria) == 1){
  $data = array(
      'recaudacion'=> ($diaria[0]->recaudacion * -1),
      'porcentaje'=> ($diaria[0]->porcentaje * -1),
      'comision'=> $diaria[0]->comision,
      'fecha'=> $diaria[0]->fecha, //lo quiero modificar para que afecte el mismo dia de comisionar ?
      'viaje'=>$viajeId,
      'descripcion'=> 'Modificación viaje ID '.$viajeId,
      'idmovil'=>$diaria[0]->idmovil,
      'cco'=> ($diaria[0]->cco * -1),
      'peon'=> ($diaria[0]->peon * -1),
      'peaje'=> ($diaria[0]->peaje * -1),
      'estacionamiento'=> ( $diaria[0]->estacionamiento * -1),
      'iva'=> ($diaria[0]->iva * -1),
      'mudanza'=> ($diaria[0]->mudanza * -1),
      'art'=> ($diaria[0]->art * -1),
      'total'=> ($diaria[0]->total * -1)
    );
    $this->db->insert("diaria",$data);
    $this->updateRecaudacion($data);

    //lo modificado calculo y hago un ingreso nuevo
    $this->updateDiaria($viajeId);
  }
}

 //actualizo la recaudacion general del movil con su saldo 
 //luego de cerrar cada viaje              
 public function updateRecaudacion($data){
  $sql="select * from recaudacion where fecha ='".$data["fecha"]."' and idmovil = ".$data["idmovil"];
  $query=$this->db->query($sql);
  $recaudacion=$query->result();
  if (count($recaudacion) == 1){
    //actualizar valores y calcular saldo
    $record=array();
    $record["recaudacion"] = $recaudacion[0]->recaudacion + $data["recaudacion"];
    $record["porcentaje"] = $recaudacion[0]->porcentaje + $data["porcentaje"];
    $record["cco"] = $recaudacion[0]->cco + $data["cco"];
    $record["peon"] = $recaudacion[0]->peon + $data["peon"];
    $record["peaje"] = $recaudacion[0]->peaje + $data["peaje"];
    $record["estacionamiento"] = $recaudacion[0]->estacionamiento + $data["estacionamiento"];
    $record["iva"] = $recaudacion[0]->iva + $data["iva"];
    $record["mudanza"] =$recaudacion[0]->mudanza + $data["mudanza"];
    $record["art"] = $recaudacion[0]->art + $data["art"];
    $record["saldo"] = $data["total"]+$recaudacion[0]->saldo;

    $this->db->update('recaudacion',$record, array("id"=>$recaudacion[0]->id));
  }else{
    //debo crear la recaudacion y le cargo el valor de radio por al menos hay un viaje
    //con lo cual esta trabajando
    $sql="select c.* from comision c ";
    $query=$this->db->query($sql);
    $valores=$query->result();
    $record=array();
    $record["radio"] = $valores[0]->radio; 
    $record["recaudacion"] = $data["recaudacion"];
    $record["porcentaje"] = $data["porcentaje"];
    $record["cco"] = $data["cco"];
    $record["peon"] = $data["peon"];
    $record["peaje"] = $data["peaje"];
    $record["estacionamiento"] = $data["estacionamiento"];
    $record["iva"] = $data["iva"];
    $record["mudanza"] = $data["mudanza"];
    $record["art"] = $data["art"];
    $record["fecha"] = $data["fecha"];
    $record["idmovil"] = $data["idmovil"];
    //calcular el saldo 
    //tener en cuenta el anterior
    $anterior = $this->getSaldoAnterior($data["idmovil"]);
    $record["saldo"] = $record["radio"] + $data["total"] + $anterior;
    $this->db->insert('recaudacion',$record);
  }

 }

 public function getSaldoAnterior($idmovil){
   $sql=" select * from recaudacion WHERE idmovil=".$idmovil." order by id desc limit 1";
   $query=$this->db->query($sql);
   $recaudacion=$query->result();
   if (count($recaudacion) == 1){
    return $recaudacion[0]->saldo;
   }else{
     return 0;
   }

 }

}

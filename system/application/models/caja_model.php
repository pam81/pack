<?php

class Caja_model extends Model {

  function Caja_model()
  {
    parent::Model();
  }

  public function updateRecaudacion($data){
    $pagencia=0;
    $pmovil=0;
    $iva=0;
    $ajuste=0;
    switch($data["tipo"]){
      case 1: //PAGA AGENCIA
              $pagencia = $data["monto"];
              break;
      case 2: //PAGA MOVIL
              $pmovil = $data["monto"];
              break;
      case 3: //IVA
              $iva = $data["monto"];
              break;
      default: // AJUSTE
              $ajuste = $data["monto"];
              break;

    }

    $dia=substr($data["created_at"],6,2);
    $mes=substr($data["created_at"],4,2);
    $year=substr($data["created_at"],0,4);
    $fecha=$year."-".$mes."-".$dia;

    $sql="select * from recaudacion where fecha ='".$fecha."' and idmovil = ".$data["idmovil"];
    $query=$this->db->query($sql);
    $recaudacion=$query->result();
    if (count($recaudacion) == 1){
      $record=array();
      $record["pagencia"] = $recaudacion[0]->pagencia + $pagencia;
      $record["pmovil"] =$recaudacion[0]->pmovil + $pmovil;
      $record["iva"] = $recaudacion[0]->iva + $iva;
      $record["ajuste"] = $recaudacion[0]->ajuste + $ajuste;
      $record["saldo"] = $recaudacion[0]->saldo + $pagencia - $pmovil + $ajuste + $iva; 
      $this->db->update('recaudacion',$record, array("id"=>$recaudacion[0]->id));
    }else{
      $anterior = $this->getSaldoAnterior($data["idmovil"]);
      $record["saldo"] = $anterior + $pagencia - $pmovil + $ajuste + $iva;
      $record["fecha"] = $data["created_at"];
      $record["idmovil"] = $data["idmovil"];
      $record["pagencia"] = $pagencia;
      $record["pmovil"] = $pmovil;
      $record["iva"] = $iva;
      $record["ajuste"] = $ajuste;
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
?> 

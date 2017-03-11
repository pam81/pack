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

}

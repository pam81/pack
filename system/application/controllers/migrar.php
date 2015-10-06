<?php

class Migrar extends Controller {

   function __construct()
   {
    parent::Controller();
    
   
   }
   
   function clientes()
   {
   
    $query=$this->db->get("migracliente",10000,42000);
     foreach($query->result() as $cliente)
     {
     
       $record=array(
          'name'=>$cliente->name,
          'piso'=>$cliente->piso,
          'dpto'=>$cliente->dto,
          'email'=>$cliente->email,
          'observaciones'=>$cliente->observac,
          'cuit'=>$cliente->cuit,
          
          'created_by'=>'admin',
          'mensaje'=>$cliente->mensaje
         );
     
      $fecha_ing=explode("/",$cliente->fechain);
      if (count($fecha_ing) == 3) 
          $record['fecha_ingreso']=$fecha_ing[2].$fecha_ing[1].$fecha_ing[0];
          
      
      if ($cliente->ctacte == 'S')
        $record["ctacte"]=1;
     else
        $record['ctacte']=0;
      
    $record["autorizactacte"]=$cliente->autorizocc;
    $record["address"]=$cliente->calle_cli;
    $record["entrecalles"]=$cliente->entre;
    
         
    $this->db->insert("clientes",$record);
    $clienteid=$this->db->insert_id();
    
    $phone=array(
     'clienteid'=>$clienteid,
     'phone'=>str_replace("-","",$cliente->telef),
     'principal'=>1
    );
    
    $this->db->insert("phones",$phone);
    
    if ($cliente->telef2 != '    -')
    {
    $phone=array(
     'clienteid'=>$clienteid,
     'phone'=>str_replace("-","",$cliente->telef2),
     'principal'=>0
    );
    
    $this->db->insert("phones",$phone);
    }
    
    if ($cliente->telef3 != '    -')
    {
    $phone=array(
     'clienteid'=>$clienteid,
     'phone'=>str_replace("-","",$cliente->telef3),
     'principal'=>0
    );
    
    $this->db->insert("phones",$phone);
    }
    
    if ($cliente->telef4 != '    -')
    {
    $phone=array(
     'clienteid'=>$clienteid,
     'phone'=>str_replace("-","",$cliente->telef4),
     'principal'=>0
    );
    
    $this->db->insert("phones",$phone);
    }
    
    if ($cliente->telef5 != '    -')
    {
    $phone=array(
     'clienteid'=>$clienteid,
     'phone'=>str_replace("-","",$cliente->telef5),
     'principal'=>0
    );
    
    $this->db->insert("phones",$phone);
    }
    
    if ($cliente->telef6 != '    -')
    {
    $phone=array(
     'clienteid'=>$clienteid,
     'phone'=>str_replace("-","",$cliente->telef6),
     'principal'=>0
    );
    
    $this->db->insert("phones",$phone);
    }
    
    if ($cliente->telef7 != '    -')
    {
    $phone=array(
     'clienteid'=>$clienteid,
     'phone'=>str_replace("-","",$cliente->telef7),
     'principal'=>0
    );
    
    $this->db->insert("phones",$phone);
    }
    
    if ($cliente->telef8 != '    -')
    {
    $phone=array(
     'clienteid'=>$clienteid,
     'phone'=>str_replace("-","",$cliente->telef8),
     'principal'=>0
    );
    
    $this->db->insert("phones",$phone);
    }
         
     if ($cliente->telef9 != '    -')
    {
    $phone=array(
     'clienteid'=>$clienteid,
     'phone'=>str_replace("-","",$cliente->telef9),
     'principal'=>0
    );
    
    $this->db->insert("phones",$phone);
    }
     
     
     if ($cliente->telef10 != '    -')
    {
    $phone=array(
     'clienteid'=>$clienteid,
     'phone'=>str_replace("-","",$cliente->telef10),
     'principal'=>0
    );
    
    $this->db->insert("phones",$phone);
    }
     
     
     }
   
   
   
   }
   
   function choferes()
   {
     $query=$this->db->get("migrachofer");
     foreach($query->result() as $chofer)
     {
     
       $record=array(
          'name'=>$chofer->nombre,
          'lastname'=>$chofer->apell,
          'nro_doc'=>$chofer->nrodoc,
          'comision'=>$chofer->comis,
          'comisionctacte'=>$chofer->comisctacte,
          
         
          'created_by'=>'admin'
          
         );
     
      if ($chofer->activo == 'S') 
         $record["active"]=1;
      else
         $record["active"]=0;
            
     if ($chofer->tipodoc == 'DNI')
        $record['tipo_doc']=1;
    if ($chofer->tipodoc == 'L.E')
        $record['tipo_doc']=2;
        
         $record["localidad_name"]=$chofer->localidad;
         $record["telefono"]=$chofer->tel_chof;
         $record["radio"]=$chofer->radio_nro;
         
         $record["nroregistro"]=$chofer->nroregis;
         
         $fecha_ing=explode("/",$chofer->fecing); 
        $record['fecha_ingreso']=$fecha_ing[2].$fecha_ing[1].$fecha_ing[0];
          
         $fecha_venceregistro=explode("/",$chofer->vencregis);
         
         if (count($fecha_venceregistro) == 3)
            $record["vence_registro"]=$fecha_venceregistro[2].$fecha_venceregistro[1].$fecha_venceregistro[0];
         
         $record["referente"]=$chofer->referen;
         $record["address"]=$chofer->direccion;
        
         
            $record["foto4x4"]=$chofer->fotocar4x4;
         
            $record["fotoregistro"]=$chofer->fotoregist;
             
       $this->db->insert("choferes",$record);
       $choferid=$this->db->insert_id();
       
       $movil=array(
          'movil'=>$chofer->movil,
          'patente'=>$chofer->nropat,
          'created_by'=>'admin',
          'date_created'=>$chofer->fecing,
          'marca'=>$chofer->marcaut,
          'company'=>$chofer->compania,
          'observacion_movil'=>$chofer->observac
       
         );
      if ($chofer->activo == 'S')   
       $movil['active']=1;
     else
         $movil['active']=0;
    
    $movil["propio"]=$chofer->propio;   
    $fecha_seguro=explode("/",$chofer->vencsegu);
    $fecha_ruta=explode("/",$chofer->vencerut);
    $fecha_sacta=explode("/",$chofer->vencsacta);
    $fecha_vtv=explode("/",$chofer->vencevtv);
    $fecha_moyano=explode("/",$chofer->vencemoy);
    
    if (count($fecha_seguro) == 3)
       $movil["vence_seguro"]=$fecha_seguro[2].$fecha_seguro[1].$fecha_seguro[0];
    if(count($fecha_ruta) == 3)   
    $movil["vence_ruta"]=$fecha_ruta[2].$fecha_ruta[1].$fecha_ruta[0];
    if(count($fecha_sacta) == 3)
    $movil["vence_sacta"]=$fecha_sacta[2].$fecha_sacta[1].$fecha_sacta[0];
    if(count($fecha_vtv) == 3)
    $movil["vence_vtv"]=$fecha_vtv[2].$fecha_vtv[1].$fecha_vtv[0];
    if(count($fecha_moyano) == 3)
    $movil["vence_moyano"]=$fecha_moyano[2].$fecha_moyano[1].$fecha_moyano[0];
    
    $movil["fotocedula"]=$chofer->fotocedula;
    $movil["fototarjeta"]=$chofer->fototarjet;
    $movil["fototitulo"]=$chofer->fototitulo;
    $movil["fotoseguro"]=$chofer->fotoseguro;
      
     $this->db->insert("movil",$movil);
     $movilid=$this->db->insert_id();
     
     $mc=array(
     'movilid'=>$movilid,
     'choferid'=>$choferid
     );
     
     $this->db->insert("movil_chofer",$mc);
     
     }
   
   
   }
} 
?>

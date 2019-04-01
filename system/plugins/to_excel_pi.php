<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
* Excel library for Code Igniter applications
* Author: Derek Allard, Dark Horse Consulting, www.darkhorse.to, April 2006
*/

function to_excel($query, $filename='exceloutput',$titulos='')
{
     $headers = ''; // just creating the var for field headers to append to below
     $data = ''; // just creating the var for field data to append to below
     
     $obj =& get_instance();
     
     $fields = $query->field_data();
     if ($query->num_rows() == 0) {
          echo '<p>The table appears to have no data.</p>';
     } 
     else {
         if ($titulos == ''){
          foreach ($fields as $field) 
             $headers .= $field->name . "\t";
          
          }
          else{
            foreach($titulos as $e)
              $headers .= $e."\t";
          }
               
     
     
          foreach ($query->result() as $row) {
               $line = '';
               foreach($row as $value) {                                            
                    if ((!isset($value)) OR ($value == "")) {
                         $value = "\t";
                    } else {
                         $value = str_replace('"', '""', $value);
                         $value = '"' . $value . '"' . "\t";
                    }
                    $line .= $value;
               }
               $data .= trim($line)."\n";
          }
          
          $data = str_replace("\r","",$data);
          $data=iconv ( "UTF-8", "ISO-8859-1", $data );               
          header("Content-type: application/x-msdownload");
          header("Content-Disposition: attachment; filename=$filename.xls");
          echo "$headers\n$data";  
     }
}

function to_excel_gral($datos,$filename){
 $desde=substr($datos["fdesde"],6,2)."-".substr($datos["fdesde"],4,2)."-".substr($datos["fdesde"],0,4);
 $hasta= substr($datos["fhasta"],6,2)."-".substr($datos["fhasta"],4,2)."-".substr($datos["fhasta"],0,4); 
 $headers="Desde\t $desde \n Hasta\t $hasta\n";
 $headers.="Cant. Viajes \t Chofer \t Movil \t Contado \t Cta Cte \t Peones \t Km \t";
 $headers .=" Tiempo Espera \t Peaje \t Estacionamiento \t Otros \t Seguro \t ";
 $headers .=" Mudanza \t I.V.A \t %Cta Cte \t ART \t A comisión \t A cliente \t";
 $headers=iconv ( "UTF-8", "ISO-8859-1", $headers );
 $data='';
 $totalviajes=0;
  $efvo=0;
  $ctacte=0;
  $peones=0;
  $km=0;
  $espera=0;
  $peaje=0;
  $estacionamiento=0;
  $otros=0;
  $seguro=0;
  $totalart=0;
  $totalmudanza=0;
  $total_porcentajecc=0;
  $total_iva=0;
  $total_contado=0;
  $total_parcial_efvo = 0;

 foreach($datos["viajes"] as $k=>$u){
    
    $data .=$u["cant_viajes"]."\t".$u["chofer"]."\t".$u["movil"]."\t".number_format($u["total_efvo"],2,".",'');
    $data .="\t".number_format($u["total_ctacte"],2,".",'')."\t"."Efvo: ".number_format($u["total_peon_efvo"],2,".",'')." CC: ".number_format($u["total_peon_cc"],2,".",'');
    
    $data .="\t"."Efvo: ".number_format($u["total_km_efvo"],2,".",'')." CC: ".number_format($u["total_km_cc"],2,".",'')."\t";

    $data .="\t"."Efvo: ".number_format($u["total_espera_efvo"],2,".",'')." CC: ".number_format($u["total_espera_cc"],2,".",'')."\t"."Efvo: ".number_format($u["total_peaje_efvo"],2,".",'')." CC: ".number_format($u["total_peaje_cc"],2,".",'');
    $data .="\t"."Efvo: ".number_format($u["total_estac_efvo"],2,".",'')." CC: ".number_format($u["total_estac_cc"],2,".",'')."\t"."Efvo: ".number_format($u["total_otro_efvo"],2,".",'')." CC: ".number_format($u["total_otro_cc"],2,".",'');
    $data .="\t"."Efvo: ".number_format($u["total_seguro_efvo"],2,".",'')." CC: ".number_format($u["total_seguro_cc"],2,".",'')."\t".number_format($u["total_mudanza"],2,".",'');
    $data .="\t"."Efvo: ".number_format($u["total_iva_efvo"],2,".",'')." CC: ".number_format($u["total_iva_cc"],2,".",'')."\t".number_format($u["total_porcentajecc_cc"],2,".",'');
    $data .="\t"."Efvo: ".number_format($u["total_art_efvo"],2,".",'')." CC: ".number_format($u["total_art_cc"],2,".",'')."\t"."Efvo:".number_format($u["parcial_efvo"],2,".",'')." CC:".number_format($u["parcial_cc"],2,".",'');
    $data .="\t"."Efvo: ".number_format($u["total_contado"],2,".",'')." CC:".number_format($u["totalcc"],2,".",'');
    $data .="\n";
    
    $totalviajes += $u["cant_viajes"];
    $efvo += $u["total_efvo"];
    $ctacte += $u["total_ctacte"];
    $peones += $u["total_peon"];
    $km += $u["total_km"];
    $espera += $u["total_espera"];
    $peaje += $u["total_peaje"];
    $estacionamiento += $u["total_estac"];
     $otros += $u["total_otro"];
     $seguro += $u["total_seguro"];
     $totalart += $u["total_art"];
      $totalmudanza += $u["total_mudanza"];
      $total_porcentajecc += $u["total_porcentajecc"];
      $total_iva += $u["total_iva"];
      $total_contado +=$u["total_contado"];
      $total_parcial_efvo +=$u["parcial_efvo"];
    
 }
  $data .="\nViajes Realizados: \t $totalviajes\n";
  $data .="Total Efectivo: \t $ ".number_format($efvo,2,".",'')."\n";
  $data .="Total Cta. Cte: \t $ ".number_format($ctacte,2,".",'')."\n";
  $data .="Total Peones: \t $ ".number_format($peones,2,".",'')."\n";
  $data .="Total Km: \t $ ".number_format($km,2,".",'')."\n";
  $data .="Total T. Espera: \t $ ".number_format($espera,2,".",'')."\n";
  $data .="Total Peaje: \t $ ".number_format($peaje,2,".",'')."\n";
  $data .="Total Estac: \t $ ".number_format($estacionamiento,2,".",'')."\n";
  $data .="Total Otros: \t $ ".number_format($otros,2,".",'')."\n";
  $data .="Total Seguro: \t $ ".number_format($seguro,2,".",'')."\n";
  $data .="Total ART: \t $ ".number_format($totalart,2,".",'')."\n";
  $data .="Total Mudanza: \t $ ".number_format($totalmudanza,2,".",'')."\n";
  $data .="Total % CtaCte: \t $ ".number_format($total_porcentajecc,2,".",'')."\n";
  $data .="Total IVA: \t $ ".number_format($total_iva,2,".",'')."\n";
  $data .="A comisión: \t $ ".number_format($total_parcial_efvo,2,".",'')."\n";
  $data .="A cliente: \t $ ".number_format($total_contado,2,".",'')."\n";
  $data=iconv ( "UTF-8", "ISO-8859-1", $data ); 
  header("Content-type: application/x-msdownload");
  header("Content-Disposition: attachment; filename=$filename.xls");
  echo "$headers\n$data"; 
   
}

function to_excel_rendir($datos,$filename){
 $desde=substr($datos["fdesde"],6,2)."-".substr($datos["fdesde"],4,2)."-".substr($datos["fdesde"],0,4);
 $hasta= substr($datos["fhasta"],6,2)."-".substr($datos["fhasta"],4,2)."-".substr($datos["fhasta"],0,4); 
 $headers="Desde\t $desde \n Hasta\t $hasta\n";
 $headers.="Cant. Viajes \t Movil \t Recaudación \t Cta Cte \t  ";
 $headers .=" \t I.V.A \t ART \t Mudanza \t";
 $headers=iconv ( "UTF-8", "ISO-8859-1", $headers );
 $data='';
 $totalviajes=0;
  $totalart=0;
  $totalmudanza=0;
  $total_iva=0;
  $total_recaudacion = 0;
  $total_ctacte=0;

 foreach($datos["viajes"] as $k=>$u){
 
    $parcial_ctacte=0;
    $parcial_ctacte += $u["total_ctacte"] + $u["total_espera_cc"] + $u["total_peon_cc"]+$u["total_km_cc"]+$u["total_peaje_cc"]+$u["total_estac_cc"]+$u["total_seguro_cc"]+$u["total_otro_cc"]; 
    $total_ctacte += $parcial_ctacte; 
    
    $parcial_recaudacion=0;
    if (isset($u["parcial_efvo"])) { $parcial_recaudacion += $u["parcial_efvo"]; }   
    if (isset($u["parcial_cc"])) {   $parcial_recaudacion += $u["parcial_cc"]; }
                
    $total_recaudacion += $parcial_recaudacion;   
 
   
 
    $data .=$u["cant_viajes"]."\t".$u["movil"];
    $data .="\t".number_format($parcial_recaudacion,2,".",'')."\t".number_format($parcial_ctacte,2,".",'')."\t";
    $data .="\t".number_format($u["total_iva"],2,".",'')."\t".number_format($u["total_art"],2,".",'')."\t".number_format($u["total_mudanza"],2,".",'');
    

    $data .="\n";
    
    $totalviajes += $u["cant_viajes"];
    $totalart += $u["total_art"];
    $totalmudanza += $u["total_mudanza"];
    $total_iva += $u["total_iva"];

    
 }
  $data .="\nViajes Realizados: \t $totalviajes\n";
  $data .="Total Recaudación: \t $".number_format($total_recaudacion,2,".",'')."\n";
  $data .="Total Cta. Cte.: \t $".number_format($total_ctacte,2,".",'')."\n";
  $data .="Total IVA: \t $ ".number_format($total_iva,2,".",'')."\n";
  $data .="Total ART: \t $ ".number_format($totalart,2,".",'')."\n";
  $data .="Total Mudanza: \t $ ".number_format($totalmudanza,2,".",'')."\n";
  


  $data=iconv ( "UTF-8", "ISO-8859-1", $data ); 
  header("Content-type: application/x-msdownload");
  header("Content-Disposition: attachment; filename=$filename.xls");
  echo "$headers\n$data"; 
   
}

function to_excel_ctacliente($datos,$filename){

  $desde=substr($datos["fdesde"],6,2)."-".substr($datos["fdesde"],4,2)."-".substr($datos["fdesde"],0,4);
  $hasta= substr($datos["fhasta"],6,2)."-".substr($datos["fhasta"],4,2)."-".substr($datos["fhasta"],0,4);
  $cliente=$datos["cliente"][0]; 
  $headers="Cliente:\t".mb_convert_case($cliente->name,MB_CASE_TITLE)."\t\t CUIT:".$cliente->cuit."\n";
  $headers.="Teléfono\t".$datos["telefono"]."\t\t Observaciones:".$cliente->observaciones."\n";
  $headers.="Dirección\t".$cliente->address."\n";
  $headers .="Desde:\t $desde \t\t Hasta:\t $hasta\n\n";
  $headers .="Fecha \t Hora \t Nro. Viaje \t Movil \t Nro. Voucher\t Cta Cte \t Contado \t Peones \t KM \t Peaje \t Estacionamiento\t Tiempo Espera \t ";
  $headers .="Otros\t Seguro \t ART \t IVA \t Desde \t Destino \t Total\n";
  $headers=iconv ( "UTF-8", "ISO-8859-1", $headers );
  $viajes = $datos["viajes"];
  $data='';
  $efvo=0;
  $ctacte=0;
  $peaje=0;
  $peones=0;
  $estacionamiento=0;
  $espera=0;
  $otros=0;
  $seguro=0;
  $art=0;
  $iva=0;
  $km=0;
  $total_subtotales=0;
 
 foreach($viajes as $v){
    
    $year=substr($v->fecha_despacho,0,4);
    $year=substr($year,2,2);
    $mes=substr($v->fecha_despacho,4,2);
    $day=substr($v->fecha_despacho,6,2);
    
    $h=substr($v->habordo,0,2);
    $m=substr($v->habordo,2,2);
    
    $data .= $day."-".$mes."-".$year."\t $h:$m\t".$v->viaje."\t". $v->movil."\t".$v->voucher."\t";
    $ctacteTotal = 0;
    if ($v->forma_pago == 2) { 
        $ctacteTotal=$v->valor+$v->porcentaje_ctacte; //suma el precio % de cta cte
        $ctacte +=$ctacteTotal; 
    }
    
    $data .=number_format($ctacteTotal,2,".",'')."\t";
    if ($v->forma_pago == 1) {  $efvo += $v->valor; }
    $data .=number_format($v->valor,2,".",'')."\t";
    $data .=number_format($v->peones,2,".",'')."\t"; 
    $peones += $v->peones;
    $data .=number_format($v->km,2,".",'')."\t";
    $km += $v->km;
    $data .=number_format($v->peaje,2,".",'')."\t"; $peaje += $v->peaje;
    $data .=number_format($v->estacionamiento,2,".",'')."\t"; $estacionamiento += $v->estacionamiento;
    $data .=number_format($v->espera,2,".",'')."\t"; $espera += $v->espera;
    $data .=number_format($v->otros,2,".",'')."\t"; $otros += $v->otros;
    $data .=number_format($v->seguro,2,".",'')."\t"; $seguro += $v->seguro;
    $data .=number_format($v->art_valor,2,".",'')."\t"; $art += $v->art_valor;
    $data .=number_format($v->iva,2,".",'')."\t"; $iva += $v->iva;
    $data .=$v->desde."\t".$v->destino."\t";
    $subtotal= $v->valor + $v->peones + $v->peaje + $v->estacionamiento+$v->espera + $v->otros 
                + $v->seguro + $v->art_valor + $v->km;   //no suma mudanza ni % mudanza
     if ($v->forma_pago == 2){  // suma el % cta cte
       $subtotal += $v->porcentaje_ctacte;
     }else{
       $subtotal +=$v->iva; //solo en efvo suma el iva 
     }
    $data .=number_format($subtotal,2,".",'')."\n\n"; 
    $total_subtotales += $subtotal; 
     
  }
  if ($datos["see"] == 1 ) {
     $data.="Viajes Realizados:\t".count($viajes)."\n";
     $data.="Total Efectivo:\t"."$ ".number_format($efvo,2,".",'')."\n";
     $data.="Total Cta Cte:\t"."$ ".number_format($ctacte,2,".",'')."\n";
     $data.="Total Peones:\t"."$ ".number_format($peones,2,".",'')."\n";
     $data.="Total KM:\t"."$ ".number_format($km,2,".",'')."\n";
     $data.="Total Peaje:\t"."$ ".number_format($peaje,2,".",'')."\n";
     $data.="Total Estacionamiento:\t"."$ ".number_format($estacionamiento,2,".",'')."\n";
     $data.="Total T. Espera:\t"."$ ".number_format($espera,2,".",'')."\n";
     $data.="Total Otros:\t"."$ ".number_format($otros,2,".",'')."\n";
     $data.="Total Seguros:\t"."$ ".number_format($seguro,2,".",'')."\n";
     $data.="Total ART:\t"."$ ".number_format($art,2,".",'')."\n";
     $data.="Total IVA:\t"."$ ".number_format($iva,2,".",'')."\n";
     $data.="Total :\t"."$ ".number_format($total_subtotales,2,".",'')."\n";
  
  }
  $data=iconv ( "UTF-8", "ISO-8859-1", $data ); 
  header("Content-type: application/x-msdownload");
  header("Content-Disposition: attachment; filename=$filename.xls");
  echo "$headers\n$data";

}

function to_excel_cliente($datos,$filename){
  
  $headers="Nombre\t Email\t \n";

  $headers=iconv ( "UTF-8", "ISO-8859-1", $headers );
  $data='';


  foreach($datos["clientes"] as $k=>$u){
    $data .=str_replace(',', '', $u->name)."\t".$u->email."\t \n";
  }
 
  $data=iconv ( "UTF-8", "ISO-8859-1", $data ); 
  header("Content-type: application/x-msdownload");
  header("Content-Disposition: attachment; filename=$filename.xls");
  echo "$headers\n$data"; 
   
}

function to_excel_referidos($datos,$filename){
  
  $headers="Medio\t Total\t \n";

  $headers=iconv ( "UTF-8", "ISO-8859-1", $headers );
  $data='';


  foreach($datos as $k=>$u){
    $data .=$k."\t".$u."\t \n";
  }
 
  $data=iconv ( "UTF-8", "ISO-8859-1", $data ); 
  header("Content-type: application/x-msdownload");
  header("Content-Disposition: attachment; filename=$filename.xls");
  echo "$headers\n$data"; 
   
}

?>

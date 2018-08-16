<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->lang->line('name_empresa');?></title>
<style>

.listado {
 border: 1px solid #333;

}

.listado thead tr th{
 border-bottom: 1px solid #333;
 
}

.listado tr td{
 text-align: center;
 border-bottom: 1px solid #333;
 font-size: 12px;
 
}

</style>
</head>
  <body>
  <h2> <?php echo $this->lang->line("cta_x_cliente");?></h2>
  <br>
  <br>
  <table>
   <tr> <td> Cliente:</td> <td> <?php echo mb_convert_case($cliente[0]->name,MB_CASE_TITLE);?></td> 
        <td> CUIT: </td> <td><?php echo $cliente[0]->cuit;?>   </td>
   </tr>
   <tr> <td> Teléfono:</td> <td><?php echo $telefono;?> </td> 
        <td> Observaciones: </td> <td> <?php echo $cliente[0]->observaciones;?> </td>
   </tr>
   <tr> <td> Dirección: </td> <td><?php echo $cliente[0]->address;?> </td> </tr>
   <tr> <td> Desde Fecha: </td> <td><?php
      $year=substr($fdesde,0,4);
                   $mes=substr($fdesde,4,2);
                   $day=substr($fdesde,6,2);
         echo $day."-".$mes."-".$year;
      
      ;?> </td> 
    <td> Hasta Fecha: </td> <td><?php 
      $year=substr($fhasta,0,4);
                   $mes=substr($fhasta,4,2);
                   $day=substr($fhasta,6,2);
         echo $day."-".$mes."-".$year;
      
      ?> </td> </tr>
  </table>

  <br>
  <br>
  <table class="listado" cellspacing="0" cellpadding="0" >
   <thead>
    <tr>
        <th> <?php echo $this->lang->line("title_fecha");?> </th>
        <th> <?php echo $this->lang->line("title_hora");?> </th>
        <th> <?php echo $this->lang->line("nro_viaje");?> </th>
        <th> <?php echo $this->lang->line("title_movil");?> </th>
      
        <th> <?php echo $this->lang->line("title_voucher");?> </th>
        <th> <?php echo $this->lang->line("title_ctacte");?> </th>
      
        <th> <?php echo $this->lang->line("title_contado");?> </th>
       
        <th > <?php echo $this->lang->line("title_peones");?> </th>
        <th > <?php echo $this->lang->line("title_km");?> </th>
        <th > <?php echo $this->lang->line("title_peaje");?> </th>
        <th > <?php echo substr($this->lang->line("title_estacionamiento"),0,4).".";?> </th>
        <th > <?php echo $this->lang->line("title_espera");?> </th>
        <th > <?php echo $this->lang->line("title_otros");?> </th>
        <th > <?php echo $this->lang->line("title_seguro");?> </th>
        <th > <?php echo $this->lang->line("title_art");?> </th>
       
       
       <th> <?php echo $this->lang->line("title_iva");?></th>
        <th> <?php echo $this->lang->line("title_desde");?> </th>
        <th> <?php echo $this->lang->line("title_hasta");?> </th>
        <th>Total</th>
        
    </tr>    
   </thead>
   <tbody>
     <?php
     
     
      
      $efvo=0;
      $ctacte=0;
      $peaje=0;
     $peones=0;
     $estacionamiento=0;
     $espera=0;
     $otros=0;
     $seguro=0;
     $art=0;
     $km=0;
     $iva=0;
     $total_subtotales=0;
      foreach($viajes as $v) {
         
     ?>
       <tr >
         
         <td> <?php 
                   $year=substr($v->fecha_despacho,0,4);
                   $year=substr($year,2,2);
                   $mes=substr($v->fecha_despacho,4,2);
                   $day=substr($v->fecha_despacho,6,2);
         echo $day."-".$mes."-".$year; ?>    </td>
             <td>
          <?php $h=substr($v->habordo,0,2);
                $m=substr($v->habordo,2,2);
                echo "$h:$m";
          ?>
          </td>
        <td>   <?php  echo $v->viaje; ?>    </td>
         <td> <?php echo $v->movil;?> </td>
         
         <td> <?php echo $v->voucher;?> </td>
          <td> <?php if ($v->forma_pago == 2) { 
          
               $ctacteTotal=$v->valor+$v->porcentaje_ctacte; //suma el precio % de cta cte
                echo number_format($ctacteTotal,2,".",''); 
                $ctacte +=$ctacteTotal; }?> </td>
         
           <td> <?php if ($v->forma_pago == 1) { echo number_format($v->valor,2,".",''); $efvo += $v->valor; }?> </td>
         
         <td> <?php echo number_format($v->peones,2,".",''); $peones += $v->peones; ?></td>
         <td> <?php echo number_format($v->km,2,".",''); $km += $v->km; ?></td>
        <td> <?php echo number_format($v->peaje,2,".",''); $peaje += $v->peaje; ?></td>
        <td> <?php echo number_format($v->estacionamiento,2,".",''); $estacionamiento += $v->estacionamiento;?></td>
        <td> <?php echo number_format($v->espera,2,".",''); $espera += $v->espera;?></td>
        <td> <?php echo number_format($v->otros,2,".",''); $otros += $v->otros;?></td>
        <td> <?php echo number_format($v->seguro,2,".",''); $seguro += $v->seguro;?></td>
        <td> <?php echo number_format($v->art_valor,2,".",''); $art += $v->art_valor;?></td>
        
        <td> <?php echo number_format($v->iva,2,".",''); $iva += $v->iva;?></td>
         <td> <?php echo $v->desde;?> </td>
         <td> <?php echo $v->destino;?> </td>
         <td> <?php $subtotal= $v->valor + $v->peones + $v->km + $v->peaje + $v->estacionamiento+$v->espera + $v->otros
                     + $v->seguro + $v->art_valor ;   //no suma mudanza ni % mudanza
                     if ($v->forma_pago == 2){  // suma el % cta cte
                       $subtotal += $v->porcentaje_ctacte;
                     }else{
                       $subtotal +=$v->iva; //solo en efvo suma el iva 
                     }
                    echo number_format($subtotal,2,".",''); 
                    $total_subtotales += $subtotal; 
                       ?></td>
        
          
        
       </tr>
     <?php 
     
     }?>
   </tbody>
  </table>
  <br>
  <br>
   <?php if ($see == 1 ) { ?>
    <table>
    <tr>
     <td>  Viajes Realizados:</td> <td><?php echo count($viajes);?> </td>
    </tr>
   
    <tr>
     <td> <?php echo $this->lang->line("title_total_efectivo"); ?>: </td> <td> <?php echo "$ ".number_format($efvo,2,".",'');?> </td>
    </tr>
    
    <tr>
     <td> <?php echo $this->lang->line("title_total_ctacte"); ?>:</td> <td><?php echo "$ ".number_format($ctacte,2,".",'');?> </td>
    </tr>
  
    <tr>
     <td> <?php echo $this->lang->line("title_total_peones"); ?>:</td> <td><?php echo "$ ".number_format($peones,2,".",'');?> </td>
    </tr>
    <tr>
     <td> <?php echo "Total KM"; ?>:</td> <td><?php echo "$ ".number_format($km,2,".",'');?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_peaje"); ?>:</td> <td><?php echo "$ ".number_format($peaje,2,".",'');?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_estacionamiento"); ?>:</td> <td><?php echo "$ ".number_format($estacionamiento,2,".",'');?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_tespera"); ?>:</td> <td><?php echo "$ ".number_format($espera,2,".",'');?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_otros"); ?>:</td> <td><?php echo "$ ".number_format($otros,2,".",'');?> </td>
     
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_seguro"); ?>:</td> <td><?php echo "$ ".number_format($seguro,2,".",'');?> </td>
     
    </tr>
   <tr>
     <td> <?php echo $this->lang->line("title_total_art"); ?>:</td> <td><?php echo "$ ".number_format($art,2,".",'');?> </td>
    </tr>
    
    
    <tr>
     <td> <?php echo $this->lang->line("title_total_iva"); ?>:</td> <td><?php echo "$ ".number_format($iva,2,".",'');?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total"); ?>:</td> <td><?php echo "$ ".number_format($total_subtotales,2,".",'');?> </td>
    </tr>
    
    </table>
    <?php } ?>
</body>
</html>

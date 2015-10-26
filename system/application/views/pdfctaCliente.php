<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
                echo $ctacteTotal; 
                $ctacte +=$ctacteTotal; }?> </td>
         
           <td> <?php if ($v->forma_pago == 1) { echo $v->valor; $efvo += $v->valor; }?> </td>
         
         <td> <?php echo $v->peones; $peones += $v->peones; ?></td>
        <td> <?php echo $v->peaje; $peaje += $v->peaje; ?></td>
        <td> <?php echo $v->estacionamiento; $estacionamiento += $v->estacionamiento;?></td>
        <td> <?php echo $v->espera; $espera += $v->espera;?></td>
        <td> <?php echo $v->otros; $otros += $v->otros;?></td>
        <td> <?php echo $v->seguro; $seguro += $v->seguro;?></td>
        <td> <?php echo $v->art_valor; $art += $v->art_valor;?></td>
        
        <td> <?php echo $v->iva; $iva += $v->iva;?></td>
         <td> <?php echo $v->desde;?> </td>
         <td> <?php echo $v->destino;?> </td>
         <td> <?php $subtotal= $v->valor + $v->peones + $v->peaje + $v->estacionamiento+$v->espera + $v->otros
                     + $v->seguro + $v->art_valor ;   //no suma mudanza ni % mudanza
                     if ($v->forma_pago == 2){  // suma el % cta cte
                       $subtotal += $v->porcentaje_ctacte;
                     }else{
                       $subtotal +=$v->iva; //solo en efvo suma el iva 
                     }
                    echo $subtotal; 
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
     <td> <?php echo $this->lang->line("title_total_efectivo"); ?>: </td> <td> <?php echo $efvo;?> </td>
    </tr>
    
    <tr>
     <td> <?php echo $this->lang->line("title_total_ctacte"); ?>:</td> <td><?php echo $ctacte;?> </td>
    </tr>
  
    <tr>
     <td> <?php echo $this->lang->line("title_total_peones"); ?>:</td> <td><?php echo $peones;?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_peaje"); ?>:</td> <td><?php echo $peaje;?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_estacionamiento"); ?>:</td> <td><?php echo $estacionamiento;?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_tespera"); ?>:</td> <td><?php echo $espera;?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_otros"); ?>:</td> <td><?php echo $otros;?> </td>
     
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_seguro"); ?>:</td> <td><?php echo $seguro;?> </td>
     
    </tr>
   <tr>
     <td> <?php echo $this->lang->line("title_total_art"); ?>:</td> <td><?php echo $art;?> </td>
    </tr>
    
    
    <tr>
     <td> <?php echo $this->lang->line("title_total_iva"); ?>:</td> <td><?php echo $iva;?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total"); ?>:</td> <td><?php echo $total_subtotales;?> </td>
    </tr>
    
    </table>
    <?php } ?>
</body>
</html>

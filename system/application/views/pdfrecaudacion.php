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
  <h2> <?php echo $this->lang->line("recaudacionxday");?></h2>
  <br>
  <br>

  <table class="listado" cellspacing="0" cellpadding="0" >
   <thead>
    <tr>
        <th> <?php echo $this->lang->line("nro_viaje");?> </th>
        <th> <?php echo $this->lang->line("title_fecha");?> </th>
        <th> <?php echo $this->lang->line("title_movil");?> </th>
        <th> <?php echo $this->lang->line("title_cliente");?> </th>
        <th> <?php echo $this->lang->line("title_desde");?> </th>
         <th> <?php echo $this->lang->line("title_hasta");?> </th>
       
         <th> <?php echo $this->lang->line("title_contado");?> </th>
       
         
         <th> <?php echo $this->lang->line("title_voucher");?> </th>
         <th> <?php echo $this->lang->line("title_ctacte");?> </th>
        
         <th> <?php echo $this->lang->line("title_peones");?> </th>
         <th> <?php echo $this->lang->line("title_espera");?> </th>
          <th> <?php echo $this->lang->line("title_peaje");?> </th>
          <th> <?php echo $this->lang->line("estacionamiento_short");?> </th>
          <th> <?php echo $this->lang->line("title_otros");?> </th>
          <th> <?php echo $this->lang->line("title_seguro");?> </th>
          <th> <?php echo $this->lang->line("title_art");?> </th>
          <th> <?php echo $this->lang->line("title_mudanza");?></th>
        
         
         <th>% <?php echo $this->lang->line("title_ctacte");?></th>
         <th><?php echo $this->lang->line("title_iva");?></th>
        
    </tr>    
   </thead>
   <tbody>
     <?php
     
      $anulados=0;
      $totalviajes=count($viajes);
      $efvo=0;
      $ctacte=0;
      $peones=0;
      $espera=0;
      $estacionamiento=0;
      $otros=0;
      $peaje=0;
      $seguro=0;
      $art=0;
      $mudanza=0;
     
      $porcentaje_ctacte=0;
      $iva=0;
      foreach($viajes as $v) {
          if ($v->cancelado == 1)
             $anulados++;
     ?>
       <tr >
         <td>   <?php  echo $v->id; ?>    </td>
         <td> <?php 
                   $year=substr($v->fecha_despacho,0,4);
                   $mes=substr($v->fecha_despacho,4,2);
                   $day=substr($v->fecha_despacho,6,2);
         echo $day."-".$mes."-".$year; ?>    </td>
        
         <td> <?php echo $v->movil;?> </td>
         <td> <?php echo $v->cliente;?> </td>
         <td> <?php echo $v->desde;?> </td>
         <td> <?php echo $v->destino;?> </td>
       
      
         <td> <?php if ($v->forma_pago == 1) { echo $v->valor; $efvo += $v->valor; }?> </td>
       
          <td> <?php echo $v->voucher;?> </td>
         <td> <?php if ($v->forma_pago == 2) { echo $v->valor; $ctacte += $v->valor; }?> </td>
      
       <td><?php echo $v->peones; $peones += $v->peones;?></td>
       <td> <?php echo $v->espera; $espera +=$v->espera; ?>  </td>
          <td> <?php echo $v->peaje; $peaje +=$v->peaje; ?>  </td>
          <td> <?php echo $v->estacionamiento; $estacionamiento +=$v->estacionamiento; ?>  </td>
          <td> <?php echo $v->otros; $otros +=$v->otros; ?>  </td>
          <td> <?php echo $v->monto_excedente; $seguro +=$v->monto_excedente; ?>  </td>
          <td> <?php echo $v->art_valor; $art +=$v->art_valor; ?>  </td>
          <td><?php echo $v->mudanza; $mudanza +=$v->mudanza; ?></td>
        
         <td><?php echo $v->porcentaje_ctacte; $porcentaje_ctacte +=$v->porcentaje_ctacte; ?></td>
        <td><?php echo $u->iva; $iva +=$u->iva; ?></td>
       </tr>
     <?php 
     
     } ?>
   </tbody>
  </table>
  <br>
  <br>
  <?php if($see == 1){ ?>
    <table>
    <tr>
     <td>  Viajes Realizados:</td> <td><?php echo ($totalviajes - $anulados);?> </td>
    </tr>
    <tr>
     <td> Viajes Anulados:</td> <td><?php echo $anulados; ?> </td>
    </tr>
    
    <tr>
     <td> <?php echo $this->lang->line("title_total_efectivo"); ?>: </td> <td> <?php echo $efvo;?> </td>
    </tr>
   
    <tr>
     <td> <?php echo $this->lang->line("title_total_ctacte"); ?>:</td> <td><?php echo $ctacte;?> </td>
    </tr>
   
    <tr>
     <td> <?php echo $this->lang->line("title_total_peones"); ?>:</td> <td><?php echo $peones; ?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_tespera"); ?>:</td> <td><?php echo $espera; ?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_peaje"); ?>:</td> <td><?php echo $peaje; ?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_estacionamiento"); ?>:</td> <td><?php echo $estacionamiento; ?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_otros"); ?>:</td> <td><?php echo $otros; ?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_seguro"); ?>:</td> <td><?php echo $seguro; ?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_art"); ?>:</td> <td><?php echo $art; ?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_mudanza"); ?>:</td> <td><?php echo $mudanza; ?> </td>
    </tr>
   
    <tr>
     <td> <?php echo $this->lang->line("title_total_porcentaje_ctacte"); ?>:</td> <td><?php echo $porcentaje_ctacte; ?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_iva"); ?>:</td> <td><?php echo $iva; ?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total"); ?>:</td> <td><?php echo ($efvo + $ctacte + $peones+ $espera + $peaje + $estacionamiento + $otros + $seguro + $art + $porcentaje_ctacte+$iva); ?> </td>
    </tr>
    
    </table>
    <?php } ?>
</body>
</html>

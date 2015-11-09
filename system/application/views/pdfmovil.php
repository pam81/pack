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
  <h2> <?php echo $this->lang->line("title_list_viaje"); ?></h2>
  <br>
  <br>

  <table class="listado" cellspacing="0" cellpadding="0" >
   <thead>
    <tr>
        <th> <?php echo $this->lang->line("title_fecha");?> </th>
        <th> <?php echo $this->lang->line("title_hora_ingreso");?> </th>
        <th> <?php echo $this->lang->line("title_hora_egreso");?> </th>
        <th> <?php echo $this->lang->line("title_movil");?> </th>
        <th> <?php echo $this->lang->line("title_primer_servicio");?> </th>
        <th> <?php echo $this->lang->line("cant_viajes");?> </th>
       
         <th> <?php echo $this->lang->line("title_contado");?> </th>
         
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
       <th> <?php echo $this->lang->line("title_iva");?></th>
        <th> <?php echo $this->lang->line("title_total");?> </th>
      
        
    </tr>    
   </thead>
   <tbody>
     <?php 
     
      
      $efvo=0;
      $ctacte=0;
      $peones=0;
      $espera=0;
      $peaje=0;
      $estacionamiento=0;
      $otros=0;
      $seguro=0;
      $art=0;
      $mudanza=0;
     
     $porcentaje_ctacte=0;
     $iva=0;
         foreach($viajes as $u) {
          
         ?> 
           
         
         
       <tr >
        
         <td> <?php 
         $year=substr($u["fecha_ingreso"],0,4);
          $mes=substr($u["fecha_ingreso"],4,2);
          $dia=substr($u["fecha_ingreso"],6,2);
          $today=date("Ymd");
          
         echo $dia."-".$mes."-".$year;?> </td>
        <td> <?php 
         $hora=substr($u["hora_ingreso"],0,2);
         $min=substr($u["hora_ingreso"],2,2);
         echo $hora.":".$min;?></td>
         
         <td> <?php 
         $hora=substr($u["hora_egreso"],0,2);
         $min=substr($u["hora_egreso"],2,2);
         echo $hora.":".$min;?></td>   
        
         <td> <?php if (isset($u["movil"])) echo $u["movil"];?></td>
          <td> <?php $hora=substr($u["primero"],0,2);
                     $min=substr($u["primero"],2,2);
                     echo $hora.":".$min;
          ?>  </td>
          <td> <?php echo $u["cant_viajes"];?> </td>
       
         <td> <?php if(isset($u["efvo"])) {echo number_format($u["efvo"],2,".",''); $efvo += $u["efvo"];}?> </td>
        
         <td> <?php if (isset($u["ctacte"])) {echo number_format($u["ctacte"],2,".",''); $ctacte += $u["ctacte"]; }?> </td>
              
         <td><?php if (isset($u["peones"])) {echo number_format($u["peones"],2,".",''); $peones += $u["peones"]; }?>  </td>
         <td><?php if (isset($u["espera"])) {echo number_format($u["espera"],2,".",''); $espera += $u["espera"]; }?>  </td>
         <td><?php if (isset($u["peaje"])) {echo number_format($u["peaje"],2,".",''); $peaje += $u["peaje"]; }?>  </td><br>
         <td><?php if (isset($u["estac"])) {echo number_format($u["estac"],2,".",''); $estacionamiento += $u["estac"]; }?>  </td>
         <td><?php if (isset($u["otros"])) {echo number_format($u["otros"],2,".",''); $otros += $u["otros"]; }?>  </td>
         <td><?php if (isset($u["seguro"])) {echo number_format($u["seguro"],2,".",''); $seguro += $u["seguro"]; }?>  </td>
          <td><?php if (isset($u["art"])) {echo number_format($u["art"],2,".",''); $art += $u["art"]; }?>  </td>
         <td> <?php if (isset($u["mudanza"])) { echo number_format($u["mudanza"],2,".",''); $mudanza += $u["mudanza"]; } ?></td>
       
        <td> <?php if (isset($u["porcentaje_ctacte"])){ echo number_format($u["porcentaje_ctacte"],2,".",''); $porcentaje_ctacte += $u["porcentaje_ctacte"];}?></td>
        <td> <?php if (isset($u["iva"])){ echo number_format($u["iva"],2,".",''); $iva += $u["iva"];}?></td>
         <td> <?php if (isset($u["total"])) echo number_format($u["total"],2,".",''); ?> </td> 
                      
       </tr>
    <?php } ?>
   </tbody>
  </table>
  <br>
  <br>
   <?php if ($see == 1) { ?>
    <table>
   
   
    <tr>
     <td> <?php echo $this->lang->line("title_total_efectivo"); ?>: </td> <td> <?php echo "$ ".number_format($efvo,2,".",'');?>  </td>
    </tr>
    
    <tr>
     <td> <?php echo $this->lang->line("title_total_ctacte"); ?>:</td> <td><?php echo "$ ".number_format($ctacte,2,".",'');?> </td>
    </tr>
   
    <tr>
     <td> <?php echo $this->lang->line("title_total_peones"); ?>:</td> <td><?php echo "$ ".number_format($peones,2,".",'');?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_tespera"); ?>:</td> <td><?php echo "$ ".number_format($espera,2,".",'');?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_peaje"); ?>:</td> <td><?php echo "$ ".number_format($peaje,2,".",'');?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_estacionamiento"); ?>:</td> <td><?php echo "$ ".number_format($estacionamiento,2,".",'');?> </td>
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
     <td> <?php echo $this->lang->line("title_total_mudanza"); ?>:</td> <td><?php echo "$ ".number_format($mudanza,2,".",'');?> </td>
    </tr>
   
    <tr>
     <td> <?php echo $this->lang->line("title_total_porcentaje_ctacte"); ?>:</td> <td><?php echo "$ ".number_format($porcentaje_ctacte,2,".",'');?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_iva"); ?>:</td> <td><?php echo "$ ".number_format($iva,2,".",'');?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total"); ?>:</td> <td><?php echo "$ ".number_format(($efvo + $ctacte+$peones+$espera+$peaje+$estacionamiento+$otros+$seguro+$art+$porcentaje_ctacte+$iva),2,".",''); ?> </td>
    </tr>
   
    </table>
     <?php } ?>
</body>
</html>

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
  <h2> Rendición Mensual - <?php echo $movil." ".$date; ?> </h2>
  <br>
  <br>

  <table class="listado" cellspacing="0" cellpadding="0" >
   <thead>
    <tr>
        <th>Día</th>
        <th>Recauda</th>
        <th>Porcentaje</th>
        <th>Radio</th>
        <th>P Movil</th>
        <th>P Agencia</th>
        <th>C/ CO</th>
        <th>Peón</th>
        <th>Peaje</th>
        <th>Estacionam.</th>
        <th>Mudanza</th>
        <th>IVA</th>
        <th>ART</th>
        <th>Saldo</th>
        
    </tr>    
   </thead>
   <tbody>
   <?php 
     
      
     foreach($listado as $v) {
      $fecha = strtotime($v->fecha);
     ?> 
      <tr class="modotr">
        <td><?php echo date("d-m-Y",$fecha); ?></td>
        <td><?php echo number_format($v->recaudacion,2,".",''); ?></td>
        <td><?php echo number_format($v->porcentaje,2,".",''); ?></td>
        <td><?php echo number_format($v->radio,2,".",''); ?></td>
        <td><?php echo number_format($v->pmovil,2,".",''); ?></td>
        <td><?php echo number_format($v->pagencia,2,".",''); ?></td>
        <td><?php echo number_format($v->cco,2,".",''); ?></td>
        <td><?php echo number_format($v->peon,2,".",''); ?></td>
        <td><?php echo number_format($v->peaje,2,".",''); ?></td>
        <td><?php echo number_format($v->estacionamiento,2,".",''); ?></td>
        <td><?php echo number_format($v->mudanza,2,".",''); ?></td>
        <td><?php echo number_format($v->iva,2,".",''); ?></td>
        <td><?php echo number_format($v->art,2,".",''); ?></td>
        <td><?php echo number_format($v->saldo,2,".",''); ?></td>
       
      </tr> 
    <?php } ?>
   </tbody>
  </table>
  
</body>
</html>

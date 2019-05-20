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
  <h2> Rendición Mensual - <?php echo $date; ?> </h2>
  <br>
  <br>

  <table class="listado" cellspacing="0" cellpadding="0" >
   <thead>
    <tr>
        <th>Al Día</th>
        <th>Movil</th>
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
        <td><?php echo $v->movil; ?></td>
        <td><?php echo number_format($v->saldo,2,".",''); ?></td>
       
      </tr> 
    <?php } ?>
   </tbody>
  </table>
  
</body>
</html>

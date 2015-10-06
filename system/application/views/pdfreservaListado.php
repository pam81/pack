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
  <h2> <?php echo $this->lang->line("title_list_reserva");?></h2>
  <br>
  <br>
  <table>
   
   <tr> <td> Desde Fecha: </td> <td><?php
      $year=substr($fdesde,0,4);
                   $mes=substr($fdesde,4,2);
                   $day=substr($fdesde,6,2);
         echo $day."-".$mes."-".$year;
      
      ;?> </td> </tr>
   <tr> <td> Hasta Fecha: </td> <td><?php 
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
        <th > <?php echo  mb_convert_case($this->lang->line("title_hora_salida"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th > <?php echo mb_convert_case($this->lang->line("title_fecha"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th > <?php echo mb_convert_case($this->lang->line("title_puerta"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th > <?php echo mb_convert_case($this->lang->line("title_name"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th > <?php echo mb_convert_case($this->lang->line("title_phone"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th > <?php echo mb_convert_case($this->lang->line("title_desde"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th > <?php echo mb_convert_case($this->lang->line("title_hasta"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th > <?php echo mb_convert_case($this->lang->line("title_observacion"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th > <?php echo mb_convert_case($this->lang->line("title_categoria"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th > <?php echo mb_convert_case($this->lang->line("title_forma_pago"),MB_CASE_UPPER,"UTF-8");?> </th>
         
    </tr>    
   </thead>
   <tbody>
     <?php 
          
         foreach($reservas as $u) {
         $year=substr($u->fecha,0,4);
          $year=substr($year,2,2);
          $mes=substr($u->fecha,4,2);
          $dia=substr($u->fecha,6,2);
         
         ?>
       <tr>
       <td> <?php 
         $h=substr($u->hsalida,0,2);
         $m=substr($u->hsalida,2,2);
         
         echo $h.":".$m;
       ?></td>
         <td> <?php 
         
         echo $dia."-".$mes."-".$year;?> </td>
         <td> <?php 
         $h=substr($u->hpuerta,0,2);
         $m=substr($u->hpuerta,2,2);
         echo $h.":".$m;?></td>
         
         <td> <?php echo mb_substr($u->name,0,15);?>  </td>
          <td> <?php echo $u->phone;?></td>
         <td> <?php echo mb_substr($u->desde,0,20);?> </td>
         <td> <?php echo mb_substr($u->destino,0,20); ?> </td>
         <td> <?php echo mb_substr($u->observaciones,0,20);?> </td>
         <td> <?php echo $u->categoria;?> </td>
         <td> <?php 
           if ($u->forma_pago ==1 )
              echo $this->lang->line("title_contado");
           else
              echo $this->lang->line("title_ctacte"); 
              ?> </td>
          
                   
       </tr>
     <?php   }?>
   </tbody>
  </table>
  
</body>
</html>

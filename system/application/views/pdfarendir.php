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
  <h2> <?php echo $this->lang->line("title_list_viaje")." a Rendir"; ?></h2>
  <br>
  <br>
  <table>
  <tr>
   <td> Desde :</td> <td> <?php  echo substr($fdesde,6,2)."-".substr($fdesde,4,2)."-".substr($fdesde,0,4); ?>   </td>
  </tr>
  <tr>
   <td> Hasta : </td> <td> <?php  echo substr($fhasta,6,2)."-".substr($fhasta,4,2)."-".substr($fhasta,0,4); ?> </td>
   </tr>
  </table>
  <br>
  <br>
  <table class="listado" cellspacing="0" cellpadding="0" >
   <thead>
    <tr>
        <th> <?php echo $this->lang->line("cant_viajes");?> </th>
       
        <th> <?php echo $this->lang->line("title_movil");?> </th>
        <th>Recaudación</th>
        <th>Cta. Cte.</th> 
       <th><?php echo $this->lang->line("title_iva");?></th>
       
       <th> <?php echo $this->lang->line("title_art");?> </th>
       <th> <?php echo $this->lang->line("title_mudanza");?></th>
       
      
        
    </tr>    
   </thead>
   <tbody>
     <?php 
     
      $totalviajes=0;
      $totalart=0;
      $total_mudanza=0;
      $total_iva=0;
      $total_recaudacion = 0;
      $total_ctacte=0;
         foreach($viajes as $u) {
          
         ?> 
           
         
         
       <tr >
        
         <td> <?php if (isset($u["cant_viajes"])) { echo $u["cant_viajes"]; $totalviajes += $u["cant_viajes"];}?> </td>
         
         <td> <?php if (isset($u["movil"])) echo $u["movil"];?></td>
         <td> <?php $parcial_recaudacion=0;
                 if (isset($u["parcial_efvo"])) { $parcial_recaudacion += $u["parcial_efvo"]; }   
                 if (isset($u["parcial_cc"])) {   $parcial_recaudacion += $u["parcial_cc"]; }
                  echo $parcial_recaudacion;
                  $total_recaudacion += $parcial_recaudacion;                                                               
                   ?> </td>
         <td> 
         <?php 
            $parcial_ctacte=0;
            $parcial_ctacte += $u["total_ctacte"] + $u["total_espera_cc"] + $u["total_peon_cc"]+$u["total_peaje_cc"]+$u["total_estac_cc"]+$u["total_seguro_cc"]+$u["total_otro_cc"]; 
            echo $parcial_ctacte;
            $total_ctacte += $parcial_ctacte;
          
         
         ?>
         
         </td>        
        
          <td><?php if (isset($u["total_iva"])) {echo $u["total_iva"]; $total_iva += $u["total_iva"];  }?>  </td>
          <td><?php if (isset($u["total_art"])) {echo $u["total_art"]; $totalart += $u["total_art"]; }?>  </td>
          <td><?php if (isset($u["total_mudanza"])) {echo $u["total_mudanza"]; $total_mudanza += $u["total_mudanza"]; }?>  </td>
           
         
                      
       </tr>
    <?php } ?>
   </tbody>
  </table>
  <br>
  <br>
  <?php if ($see == 1 ) { ?>
    <table>
    <tr>
     <td>  Viajes Realizados:</td> <td> <?php echo $totalviajes ;?> </td>
    </tr>
    
    <tr>
     <td> <?php echo "Total Recaudación"; ?>:</td> <td><?php echo $total_recaudacion; ?></td>
    </tr>
    
    <tr>
     <td> <?php echo "Total Cta. Cte."; ?>:</td> <td><?php echo $total_ctacte; ?></td>
    </tr>
    
    <tr>
     <td> <?php echo $this->lang->line("title_total_iva"); ?>:</td> <td><?php echo $total_iva; ?></td>
    </tr>
    
    <tr>
     <td> <?php echo $this->lang->line("title_total_art"); ?>:</td> <td><?php echo $totalart;?> </td>
    </tr>
    
    
    <tr>
     <td> <?php echo $this->lang->line("title_total_mudanza"); ?>:</td> <td><?php echo $total_mudanza; ?> </td>
    </tr>
    
    
    
    
    
    
    </table>
    <?php } ?>
</body>
</html>

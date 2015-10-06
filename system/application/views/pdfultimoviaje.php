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
  <h2> <?php echo $this->lang->line("title_ultimoviaje"); ?></h2>
  <br>
  <br>
  <table>
  <tr>
   <td> Hace más de </td> <td> <?php  echo $tiempo; ?>  días </td>
  </tr>
 
  </table>
  <br>
  <br>
  <table class="listado" cellspacing="0" cellpadding="0" >
   <thead>
    <tr>
        <th> <?php echo $this->lang->line("title_cliente");?> </th>
        <th> <?php echo $this->lang->line("title_fechaultimoviaje");?> </th>
        
        
    </tr>    
   </thead>
   <tbody>
     <?php 
     
    
         foreach($viajes as $u) {
          
         ?> 
           
         
         
       <tr >
        
         <td> <?php if (isset($u->nombre)) { echo $u->nombre; }?> </td>
         <td> <?php if (isset($u->fecha)){ 
         $year=substr($u->fecha,0,4);
         
          $mes=substr($u->fecha,4,2);
          $dia=substr($u->fecha,6,2);
         
          echo $dia."-".$mes."-".$year;}?></td>
                   
       </tr>
    <?php } ?>
   </tbody>
  </table>

  
</body>
</html>

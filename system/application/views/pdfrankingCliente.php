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
  <?php $yd=substr($fdesde,0,4);
          $md=substr($fdesde,4,2);
          $dd=substr($fdesde,6,2);
          
         $yh=substr($fhasta,0,4);
          $mh=substr($fhasta,4,2);
          $dh=substr($fhasta,6,2); 
          ?>
  
  <h2> <?php echo $this->lang->line("title_list_ranking_cliente")." Período: ".$dd."/".$md."/".$yd." - ".$dh."/".$mh."/".$yh; ?></h2>
  <br>
  <br>

  <table class="listado" cellspacing="0" cellpadding="0" >
   <thead>
    <tr>
        <th> <?php echo mb_convert_case($this->lang->line("title_cliente"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th> <?php echo mb_convert_case($this->lang->line("title_telefono"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th> <?php echo mb_convert_case($this->lang->line("cant_viajes"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th> <?php echo mb_convert_case($this->lang->line("title_total"),MB_CASE_UPPER,"UTF-8");?> </th>
       
      
        
    </tr>    
   </thead>
   <tbody>
     
         <?php 
     
         foreach($listado as $v) {
        
         ?>
         
       <tr>
        
         <td> <?php echo $v["cliente"];?></td>
         <td> <?php echo $v["tel"];?></td>
         
         <td> <?php echo $v["cantidad"];?> </td>
         <td> <?php echo $v["total"]; ?> </td>
        
          
                      
       </tr>
    <?php } ?>
   </tbody>
  </table>
 
</body>
</html>

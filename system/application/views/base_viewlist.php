
<script type="text/javascript">
	jQuery.tableNavigation();
</script>

<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("title_list_base");?></h2>
  
  </div>
   <hr class="separador">
  <div>
   <div>
    <h3> <?php echo $this->lang->line("moviles_en_viaje");?></h3>
    
    
  <table class="table_base navigateable" cellspacing="0" cellpadding="0">
  <thead>
   <tr>
   <th width="100">Movil</th>
   <th width="100">Patente</th>
   <th>Chofer</th>
   </tr>
  </thead>
  <tbody> 
   <?php foreach($enviaje as $m){
   echo "<tr>
    <td > <a href=\"#\" class=\"activation\"> $m->movil</a></td> ";
    
   echo "<td>$m->patente </td> <td> $m->name $m->lastname </td> </tr>";
   } ?>
   </tbody>
  </table>
    
   </div>
   
  </div>
  <br> <br>
  <h3> <?php echo $this->lang->line("moviles_en_base");?></h3>
  <div>  
  <table class="table_base navigateable" cellspacing="0" cellpadding="0">
  <thead>
   <tr>
   <th width="100">Base</th>
   <th>Moviles</th>
   </tr>
  </thead>
  <tbody> 
   <?php foreach($bases as $b){ 
   echo "<tr>
    <td > <a href=\"#\" class=\"activation\"> $b->name</a></td> <td>";
    foreach($moviles as $m)
    {
      if ($m->baseid == $b->id) 
       echo $m->movil." ";
      
    }
   echo "</td> </tr>";
   } ?>
   </tbody>
  </table>
 </div>
  
  
</div>

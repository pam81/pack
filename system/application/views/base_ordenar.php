<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#movil").focus();
 });

</script>

<script type="text/javascript">
	jQuery.tableNavigation();
</script>

<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("ordena_vehiculo");?></h2>
  
  </div>
   <hr class="separador">
  <form name="formbase" id="formbase" method="post" action="<?php echo site_url()."base/ordenar";?>">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
     <div class="rowform">
   <div class="rowform-label"> 
   <label for="movil"> <?php echo $this->lang->line("title_movil"); ?>  </label>
   </div>
   <input type="text" tabindex="1" id="movil" name="movil" value="<?php echo set_value("movil");?>" />
   
   </div> 
    <div class="rowform">
   <div class="rowform-label"> 
   <label for="movil"> <?php echo $this->lang->line("title_movil_position"); ?>  </label>
   </div>
   <input type="text" tabindex="2" id="position" name="position" value="<?php echo set_value("position"); ?>" />
   
   </div>

  <div class="rowform">
   <input type="submit" tabindex="3" id="send" accesskey="e" name="send" value="<?php echo $this->lang->line("button_send");?>" onclick="return confirm('<?php echo $this->lang->line("ask_ordenar_movil_base");?>'); "/>
    <input type="reset" tabindex="4" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
   </div>
   </form>
    <div style="clear:both; margin-top: 200px; position:relative;">  
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

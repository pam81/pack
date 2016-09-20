<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#movil").focus();
 });

</script>



<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("ingresa_vehiculo");?></h2>
  
  </div>
   <hr class="separador">
     <form class="form-inline" name="formbase" id="formbase" method="post" action="<?php echo site_url()."base/addmovil";?>">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
     <div class="rowform">
   <div class="rowform-label"> 
   <label for="movil"> <?php echo $this->lang->line("title_movil"); ?>  </label>
   </div>
   <input type="text" class="form-control" tabindex="1" id="movil" name="movil" value="<?php echo set_value("movil");?>" />
   
   </div> 
  <div class="rowform">
   <div class="rowform-label"> 
   <label for="base"> <?php echo $this->lang->line("title_base"); ?>  </label>
   </div>
   <select name="base" tabindex="2" class="form-control">
          <option value="0"><?php echo $this->lang->line("select_option");?> </option>
         <?php 
             foreach($bases as $b)
             {
                 echo "<option value=\"$b->id\" ".set_select("base",$b->id)." > $b->name </option>";
             
             }
         
         ?> 
    </select>
   
   </div>
  <div class="rowform">
   <button type="submit" class="btn btn-primary" tabindex="3" id="send" accesskey="e" name="send" onclick="return confirm('<?php echo $this->lang->line("ask_add_movil_base");?>'); "><?php echo $this->lang->line("button_send");?></button>
    <button type="reset" class="btn btn-warning" tabindex="4" id="clean" accesskey="l" name="clean" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); "><?php echo $this->lang->line("button_clean");?></button>
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

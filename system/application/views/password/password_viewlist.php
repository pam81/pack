<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#pass").focus();
 });

</script>



<div id="content">

  
   <div id="top-bar">
    <h2> Contraseñas</h2>
    </div>
   <hr class="separador">
  <form name="formusuario"  class="form_col" method="post" action="<?php echo site_url()."pass/save/";?>" >
   <?php echo validation_errors('<p class="error">','</p>'); ?>
   <?php 
   if ($message) { echo '<p> '.$message.' </p>'; }
   ?>
   
   <?php 
   $i=1;
   foreach($codigos as $codigo){
      ?>
   <div class="rowform">
   <div class="rowform-label"> <label for=" <?php echo $codigo->tipo; ?>"> <?php echo $codigo->descripcion; ?> </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="<?php echo $i; $i++; ?>" name="<?php echo $codigo->tipo; ?>" id=" <?php echo $codigo->tipo; ?>" value=""  maxsize="10" />
   </div>
   </div>
   
   <?php } ?>
   
    <div class="rowform">
   <input type="submit" tabindex="<?php echo $i; $i++; ?>" accesskey="e" id="send" name="send" value="<?php echo $this->lang->line("button_send");?>" onclick="return confirm('<?php echo $this->lang->line("ask_mod_seguro");?>'); "/>
    <input type="reset" tabindex="<?php echo $i; $i++; ?>" accesskey="l" id="clear" name="clean" value="<?php echo $this->lang->line("button_clean");?>" />
   </div>
  </form>
  
</div>

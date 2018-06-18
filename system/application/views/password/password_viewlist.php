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
  <form name="formusuario"  class="form_col" method="post" action="<?php echo site_url()."pass/save/".$pass[0]->id;?>" >
   <?php echo validation_errors('<p class="error">','</p>'); ?>
   
   
   
   <div class="rowform">
   <div class="rowform-label"> <label for="inhabilitar"> Inhabilitar Cliente </label>
   </div>
   <div class="rowform-input">
   <input type="password" tabindex="1" name="inhabilitar" id="inhabilitar" value=""  maxsize="10" />
   </div>
   </div>
   
   
   
    <div class="rowform">
   <input type="submit" tabindex="3" accesskey="e" id="send" name="send" value="<?php echo $this->lang->line("button_send");?>" onclick="return confirm('<?php echo $this->lang->line("ask_mod_seguro");?>'); "/>
    <input type="reset" tabindex="4" accesskey="l" id="clear" name="clean" value="<?php echo $this->lang->line("button_clean");?>" />
   </div>
  </form>
  
</div>

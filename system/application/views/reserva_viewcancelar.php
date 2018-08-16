<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#motivo").focus();
 });

</script>



<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("cancelar_reserva");?></h2>
  
  </div>
   <hr class="separador">
   <?php echo "Nro de Reserva: ".$nroreserva;?>
  <form name="formbase" method="post" action="<?php echo site_url()."reserva/cancel/$nroreserva";?>" onsubmit=" if ( document.getElementById('motivo').value.length > 20) return true; else  { swal(messages.lengthminimo); return false;} ">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
     <div class="rowform">
   <div class="rowform-label"> 
   <label for="movil"> <?php echo $this->lang->line("title_motivo"); ?>  </label>
   </div>
   </div> 
   <div >
  <textarea name="motivo" id="motivo" rows="10" cols="50" tabindex="1"></textarea>
   </div>
   

  <div class="rowform-button">
   <input type="submit" tabindex="2" id="send" accesskey="e" name="send" value="<?php echo $this->lang->line("button_send");?>" onclick="return confirm('<?php echo $this->lang->line("ask_add_motivo");?>'); "/>
    <input type="reset" tabindex="3" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
   </div>
   </form>
  
  
</div>

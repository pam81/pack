<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#repeticion_day").focus();
 });

</script>



<div id="content">

 
   <div id="top-bar">
    <h2> <?php echo $this->lang->line("title_add_reserva_repetir");?></h2>
    </div>
   <hr class="separador">
   <div id="left_reserva"> 
  <form name="formusuario" method="post" action="<?php echo site_url()."reserva/makeRepeticion";?>" onsubmit="return flete.validarRepetirReserva();">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
  
    
   <div class="rowform">
   <div class="rowform-label"> <label for="fecha"> <?php echo $this->lang->line("title_fecha"); ?>  </label>
   </div>
  <div class="rowform-input">
  <input type="text" name="repeticion_day" id="repeticion_day" tabindex="1" size="2" maxsize="2" value="<?php echo set_value("repeticion_day",date("d"));?>" />
   <input type="text" name="repeticion_month" id="repeticion_month" tabindex="2" size="2" maxsize="2" value="<?php echo set_value("repeticion_month",date("m"));?>" />    
   <input type="text" name="repeticion_year" id="repeticion_year" tabindex="3" size="4" maxsize="4" value="<?php echo set_value("repeticion_year",date("Y"));?>" />
    <span><?php echo $this->lang->line("fecha_formato");?></span>
   </div>
   </div>
   
     
   <div class="rowform">
   <input type="submit" tabindex="4" id="send" accesskey="e" name="send" value="<?php echo $this->lang->line("button_add");?>" onclick="return confirm('<?php echo $this->lang->line("ask_add_reserva_repeticion");?>'); " />
    <input type="reset" tabindex="5" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
   </div>
  </form>
  </div>
  <div  id="right_reserva">
  
  </div>
</div>

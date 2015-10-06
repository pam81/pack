<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#monto").focus();
 });

</script>



<div id="content">

  
   <div id="top-bar">
    <h2> <?php echo $this->lang->line("title_mod_costos");?></h2>
    </div>
   <hr class="separador">
  <form name="formusuario"  class="form_col" method="post" action="<?php echo site_url()."costo/save/".$seguro[0]->id;?>" >
   <?php echo validation_errors('<p class="error">','</p>'); ?>
   
   
   
   <div class="rowform">
   <div class="rowform-label"> <label for="monto"> <?php echo $this->lang->line("title_monto"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="1" name="monto" id="monto"  value="<?php if(isset($seguro[0]->monto)) echo set_value("monto",$seguro[0]->monto); ?>" maxsize="10" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="valor"> <?php echo $this->lang->line("title_valor"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="2"  name="valor" id="valor" value="<?php if(isset($seguro[0]->valor)) echo set_value("valor",$seguro[0]->valor); ?>" maxsize="10" />
   </div>
   </div>
   
   
    <div class="rowform">
   <input type="submit" tabindex="3" accesskey="e" id="send" name="send" value="<?php echo $this->lang->line("button_send");?>" onclick="return confirm('<?php echo $this->lang->line("ask_mod_seguro");?>'); "/>
    <input type="reset" tabindex="4" accesskey="l" id="clear" name="clean" value="<?php echo $this->lang->line("button_clean");?>" />
   </div>
  </form>
  
</div>

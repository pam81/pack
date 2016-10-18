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
  <form name="formusuario"  class="form-horizontal col-md-8" method="post" action="<?php echo site_url()."costo/save/".$seguro[0]->id;?>" >
   <?php echo validation_errors('<p class="error">','</p>'); ?>
   
   
   
   <div class="form-group">
    <label for="monto" class="col-md-4 control-label"> <?php echo $this->lang->line("title_monto"); ?>  </label>
   
    <div class="col-md-8">
      <input type="text" tabindex="1" name="monto" id="monto"  value="<?php if(isset($seguro[0]->monto)) echo set_value("monto",$seguro[0]->monto); ?>" maxsize="10" />
    </div>
   </div>
   <div class="form-group">
    <label for="valor" class="col-md-4 control-label" > <?php echo $this->lang->line("title_valor"); ?>  </label>
  
   <div class="col-md-8">
   <input type="text" tabindex="2"  name="valor" id="valor" value="<?php if(isset($seguro[0]->valor)) echo set_value("valor",$seguro[0]->valor); ?>" maxsize="10" />
   </div>
   </div>
   
   
    <div class="form-group">
   <button type="submit" class="btn btn-primary col-md-offset-4" tabindex="3" accesskey="e" id="send" name="send" onclick="return confirm('<?php echo $this->lang->line("ask_mod_seguro");?>'); "><?php echo $this->lang->line("button_send");?></button>
    <button type="reset" class="btn btn-warning" tabindex="4" accesskey="l" id="clear" name="clean" ><?php echo $this->lang->line("button_clean");?></button>
   </div>
  </form>
  
</div>

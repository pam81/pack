<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#mudanza").focus();
 });

</script>



<div id="content">

  
   <div id="top-bar">
    <h2> <?php echo $this->lang->line("title_mod_comision");?></h2>
    </div>
   <hr class="separador">
  <form name="formusuario"  class="form-horizontal col-md-8" method="post" action="<?php echo site_url()."costo/saveComision/".$comision[0]->id;?>" >
   <?php echo validation_errors('<p class="error">','</p>'); ?>
   
   
   
   <div class="form-group">
     <label for="mudanza" class="col-md-4 control-label"> <?php echo $this->lang->line("title_mudanza"); ?> % </label>
  
   <div class="col-md-8">
   <input type="text" tabindex="1" class="form-control" name="mudanza" id="mudanza"  value="<?php if(isset($comision[0]->mudanza)) echo set_value("mudanza",$comision[0]->mudanza); ?>" maxsize="10" />
   </div>
   </div>
   <div class="form-group">
    <label for="ctacte" class="col-md-4 control-label"> <?php echo $this->lang->line("title_cta_cte"); ?> % </label>
   
   <div class="col-md-8">
   <input type="text" tabindex="2" class="form-control" name="ctacte" id="ctacte" value="<?php if(isset($comision[0]->cta_cte)) echo set_value("cta_cte",$comision[0]->cta_cte); ?>" maxsize="10" />
   </div>
   </div>

   <div class="form-group">
    <label for="ctacte" class="col-md-4 control-label"> Radio </label>
   
   <div class="col-md-8">
   <input type="text" tabindex="2" class="form-control" name="radio" id="radio" value="<?php if(isset($comision[0]->radio)) echo set_value("radio",$comision[0]->radio); ?>" maxsize="10" />
   </div>
   </div>
   
   
    <div class="form-group">
   <button type="submit" class="btn btn-primary" tabindex="3" accesskey="e" id="send" name="send" onclick="return confirm('<?php echo $this->lang->line("ask_mod_seguro");?>'); "><?php echo $this->lang->line("button_send");?></button>
    <button type="reset" class="btn btn-warning" tabindex="4" accesskey="l" id="clear" name="clean" ><?php echo $this->lang->line("button_clean");?></button>
   </div>
  </form>
  
</div>

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
  <form name="formusuario"  class="form_col" method="post" action="<?php echo site_url()."costo/saveComision/".$comision[0]->id;?>" >
   <?php echo validation_errors('<p class="error">','</p>'); ?>
   
   
   
   <div class="rowform">
   <div class="rowform-label"> <label for="mudanza"> <?php echo $this->lang->line("title_mudanza"); ?> % </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="1" name="mudanza" id="mudanza"  value="<?php if(isset($comision[0]->mudanza)) echo set_value("mudanza",$comision[0]->mudanza); ?>" maxsize="10" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="ctacte"> <?php echo $this->lang->line("title_cta_cte"); ?> % </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="2"  name="ctacte" id="ctacte" value="<?php if(isset($comision[0]->cta_cte)) echo set_value("cta_cte",$comision[0]->cta_cte); ?>" maxsize="10" />
   </div>
   </div>

   <div class="rowform">
   <div class="rowform-label"> <label for="ctacte"> Radio </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="2"  name="radio" id="radio" value="<?php if(isset($comision[0]->radio)) echo set_value("radio",$comision[0]->radio); ?>" maxsize="10" />
   </div>
   </div>
   
   
    <div class="rowform">
   <input type="submit" tabindex="3" accesskey="e" id="send" name="send" value="<?php echo $this->lang->line("button_send");?>" onclick="return confirm('<?php echo $this->lang->line("ask_mod_seguro");?>'); "/>
    <input type="reset" tabindex="4" accesskey="l" id="clear" name="clean" value="<?php echo $this->lang->line("button_clean");?>" />
   </div>
  </form>
  
</div>

<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#fecha_day").focus();
 });

</script>




<div id="content">

 
   <div id="top-bar">
    <h2> <?php echo $this->lang->line("title_add_dia");?></h2>
    </div>
   <hr class="separador">
  <form name="formusuario" method="post" action="<?php echo site_url()."dia/addnew";?>" >
   <?php echo validation_errors('<p class="error">','</p>'); ?>
   <div id="form_left">
       
   

    <div class="rowform">
   <div class="rowform-label"> <label for="fecha"> <?php echo $this->lang->line("title_fecha"); ?>  </label>
   </div>
   <input type="text" name="fecha_day" id="fecha_day" tabindex="3" size="2" maxsize="2" value="<?php echo set_value("fecha_day");?>" />
   <input type="text" name="fecha_month" id="fecha_month" tabindex="4" size="2" maxsize="2" value="<?php echo set_value("fecha_month");?>" />    
   <input type="text" name="fecha_year" id="fecha_year" tabindex="5" size="4" maxsize="2" value="<?php echo set_value("fecha_year");?>" />
   <span> <?php echo $this->lang->line("fecha_formato");?></span>
   
   </div>

  

   

   
   
  
   <div class="rowform">
   <input type="submit" tabindex="8" id="send" accesskey="e" name="send" value="<?php echo $this->lang->line("button_add");?>" onclick="return confirm('<?php echo $this->lang->line("ask_add_dia");?>'); "/>
    <input type="reset" tabindex="9" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
   </div>
   
 </div>
  </form>
  
</div>

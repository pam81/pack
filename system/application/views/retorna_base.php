<script>

$(window).bind('beforeunload', function() {
                if(confirm("Debe Asignar Movil a Base"))
                {
                       window.setTimeout(function() {    window.stop();  }, 1);
                }
                else
                {
                    window.setTimeout(function() {    window.stop();  }, 1);
                }
});

//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#base").focus();
 });


function validarAsignar()
{
  if (flete.validarAsignarBase())
  {
    $(window).unbind('beforeunload');  
    return true;
  }
  else
   return false;  

}

</script>



<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("asignarbase_vehiculo");?></h2>
  
  </div>
   <hr class="separador">
     <form name="formbase" id="formbase" method="post" action="<?php echo site_url()."base/asignar/".$movil[0]->viajeid;?>" onsubmit=" return validarAsignar(); ">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
     <div class="rowform">
   <div class="rowform-label"> 
   <label for="movil"> <?php echo $this->lang->line("title_movil"); ?>  </label>
   </div>
   <input type="text" tabindex="1" readonly="true" id="movil" name="movil" value="<?php echo $movil[0]->movil;?>" />
   
   </div> 
  <div class="rowform">
   <div class="rowform-label"> 
   <label for="base"> <?php echo $this->lang->line("title_base"); ?>  </label>
   </div>
   <select name="base" tabindex="2" id="base">
          <option value="0"><?php echo $this->lang->line("select_option");?> </option>
         <?php 
             foreach($bases as $b)
             {
                 echo "<option value=\"$b->id\"> $b->name </option>";
             
             }
         
         ?> 
    </select>
   
   </div>
   
     <div class="rowform">
   <div class="rowform-label"> 
   <label for="movil"> <?php echo $this->lang->line("title_movil_position"); ?>  </label>
   </div>
   <input type="text" tabindex="3" id="position" name="position" value="0" />
   
   </div>
   
 
   
  <div class="rowform">
   <input type="submit" tabindex="4" id="send" accesskey="a" name="send" value="<?php echo $this->lang->line("button_send");?>" onclick="return confirm('<?php echo $this->lang->line("ask_add_movil_base");?>'); "/>
    <input type="reset" tabindex="5" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
   </div>
   </form>
  
  
  
</div>

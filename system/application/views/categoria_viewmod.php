<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("title_categorias");?></h2>
  
  </div>
   <hr class="separador">
   <div id="left_reserva"> 
  <form name="formloc" id="formloc" method="post" action="<?php echo site_url()."categoria/update/".$categoria[0]->id;?>">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
 
    
     <div class="rowform">
   <div class="rowform-label"> 
   <label for="name"> <?php echo $this->lang->line("title_name"); ?>  </label>
   </div>
   <input type="text" tabindex="1" id="name" name="name" value="<?php echo set_value("name",$categoria[0]->name);?>" />
   
   </div> 

  <div class="rowform">
   <input type="submit" tabindex="2" id="send" accesskey="e" name="send" value="<?php echo $this->lang->line("button_send");?>" onclick="return confirm('<?php echo $this->lang->line("ask_mod_categoria");?>'); "/>
    <input type="reset" tabindex="3" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
   </div>
   </form>
  </div>
  
</div>

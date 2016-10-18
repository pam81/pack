<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("title_categorias");?></h2>
  
  </div>
   <hr class="separador">
   <div id="left_reserva"> 
  <form name="formloc" id="formloc" class="form-horizontal col-md-8" method="post" action="<?php echo site_url()."categoria/update/".$categoria[0]->id;?>">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
 
    
     <div class="form-group">
 
   <label for="name" class="col-md-4 control-label"> <?php echo $this->lang->line("title_name"); ?>  </label>
   <div class="col-md-8">
    <input type="text" tabindex="1" id="name" class="form-control"  name="name" value="<?php echo set_value("name",$categoria[0]->name);?>" />
   </div>
   </div> 

  <div class="form-group">
   <button type="submit" class="btn btn-primary col-md-offset-4" tabindex="2" id="send" accesskey="e" name="send" onclick="return confirm('<?php echo $this->lang->line("ask_mod_categoria");?>'); "><?php echo $this->lang->line("button_send");?></button>
    <button type="reset" class="btn btn-warning" tabindex="3" id="clean" accesskey="l" name="clean" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " ><?php echo $this->lang->line("button_clean");?></button>
   </div>
   </form>
  </div>
  
</div>

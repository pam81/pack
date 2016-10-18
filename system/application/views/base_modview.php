<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#name").focus();
 });

</script>



<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("mod_bases");?></h2>
  
  </div>
   <hr class="separador">
  <form name="formbase" class="form-horizontal col-md-8" id="formbase" method="post" action="<?php echo site_url()."base/change/".$base[0]->id."/".$this->uri->segment(4);?>">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
     <div class="form-group">
   
   <label for="name" class="col-md-4 control-label"> <?php echo $this->lang->line("title_base"); ?>  </label>
   <div class="col-md-8">
   <input type="text" class="form-control" tabindex="1" id="name" name="name" value="<?php echo $base[0]->name?>" />
   </div>
   </div> 

  <div class="form-group">
   <button type="submit" class="btn btn-primary col-md-offset-4" tabindex="2" id="send" accesskey="e" name="send" onclick="return confirm('<?php echo $this->lang->line("ask_mod_base");?>'); "><?php echo $this->lang->line("button_send");?></button>
    <button type="reset" class="btn btn-warning" tabindex="3"  id="clean" accesskey="l" name="clean" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); "><?php echo $this->lang->line("button_clean");?></button>
   </div>
   </form>
  
  
</div>

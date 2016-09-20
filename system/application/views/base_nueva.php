<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#name").focus();
 });

</script>

<script type="text/javascript">
	jQuery.tableNavigation();
</script>

<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("nueva_bases");?></h2>
  
  </div>
   <hr class="separador">
  <form name="formbase" class="form-inline" id="formbase" method="post" action="<?php echo site_url()."base/addbase";?>">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
     <div class="rowform">
   <div class="rowform-label"> 
   <label for="name"> <?php echo $this->lang->line("title_base"); ?>  </label>
   </div>
   <input type="text" class="form-control" tabindex="1" id="name" name="name" value="" />
   
   </div> 

  <div class="rowform">
   <button type="submit" class="btn btn-primary" tabindex="2" id="send" accesskey="e" name="send" onclick="return confirm('<?php echo $this->lang->line("ask_add_base");?>'); "><?php echo $this->lang->line("button_send");?></button>
    <button type="reset" class="btn btn-warning" tabindex="3" id="clean" accesskey="l" name="clean" value="" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " ><?php echo $this->lang->line("button_clean");?></button>
   </div>
   </form>
  
  
</div>

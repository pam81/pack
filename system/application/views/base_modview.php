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
  
  <h2> <?php echo $this->lang->line("mod_bases");?></h2>
  
  </div>
   <hr class="separador">
  <form name="formbase" id="formbase" method="post" action="<?php echo site_url()."base/change/".$base[0]->id."/".$this->uri->segment(4);?>">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
     <div class="rowform">
   <div class="rowform-label"> 
   <label for="name"> <?php echo $this->lang->line("title_base"); ?>  </label>
   </div>
   <input type="text" tabindex="1" id="name" name="name" value="<?php echo $base[0]->name?>" />
   
   </div> 

  <div class="rowform">
   <input type="submit" tabindex="2" id="send" accesskey="e" name="send" value="<?php echo $this->lang->line("button_send");?>" onclick="return confirm('<?php echo $this->lang->line("ask_mod_base");?>'); "/>
    <input type="reset" tabindex="3"  id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
   </div>
   </form>
  
  
</div>

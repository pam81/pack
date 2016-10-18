<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#provincia").focus();
 });

</script>

<script type="text/javascript">
	jQuery.tableNavigation();
</script>

<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("title_localidad");?></h2>
  
  </div>
   <hr class="separador">
   <div id="left_reserva"> 
  <form name="formloc" id="formloc" class="form-horizontal col-md-8" method="post" action="<?php echo site_url()."localidad/update/".$localidad[0]->id;?>">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
    <div class="form-group">
  
   <label for="provincia" class="col-md-4 control-label"> <?php echo $this->lang->line("title_provincia"); ?>  </label>
  <div class="col-md-8">
   <select name="provincia" id="provincia" tabindex="1" class="form-control">
   <?php foreach($provincias as $p){ 
       $select=false;
       if($p->id == $localidad[0]->regionid)
         $select=true;
   ?>
      <option value="<?php echo $p->id;?>" <?php echo set_select("provincia",$p->id,$select);?>  ><?php echo $p->name;?></option>
   <?php }?>
   </select>
   </div>
   </div>
    
     <div class="form-group">
  
   <label for="name" class="col-md-4 control-label"> <?php echo $this->lang->line("title_localidad"); ?>  </label>
  <div class="col-md-8">
   <input type="text" tabindex="2" class="form-control" id="name" name="name" value="<?php echo set_value("name",$localidad[0]->name);?>" />
   </div>
   </div> 

  <div class="form-group">
   <button type="submit" class="btn btn-primary col-md-offset-5" tabindex="2" id="send" accesskey="e" name="send" onclick="return confirm('<?php echo $this->lang->line("ask_mod_localidad");?>'); "><?php echo $this->lang->line("button_send");?></button>
    <button type="reset" class="btn btn-warning" tabindex="3" id="clean" accesskey="l" name="clean" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " ><?php echo $this->lang->line("button_clean");?></button>
   </div>
   </form>
  </div>
  
</div>

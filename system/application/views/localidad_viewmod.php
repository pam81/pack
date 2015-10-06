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
  <form name="formloc" id="formloc" method="post" action="<?php echo site_url()."localidad/update/".$localidad[0]->id;?>">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
    <div class="rowform">
   <div class="rowform-label"> 
   <label for="name"> <?php echo $this->lang->line("title_provincia"); ?>  </label>
   </div>
   <select name="provincia" id="provincia" tabindex="1">
   <?php foreach($provincias as $p){ 
       $select=false;
       if($p->id == $localidad[0]->regionid)
         $select=true;
   ?>
      <option value="<?php echo $p->id;?>" <?php echo set_select("provincia",$p->id,$select);?>  ><?php echo $p->name;?></option>
   <?php }?>
   </select>
   
   </div>
    
     <div class="rowform">
   <div class="rowform-label"> 
   <label for="name"> <?php echo $this->lang->line("title_localidad"); ?>  </label>
   </div>
   <input type="text" tabindex="2" id="name" name="name" value="<?php echo set_value("name",$localidad[0]->name);?>" />
   
   </div> 

  <div class="rowform">
   <input type="submit" tabindex="2" id="send" accesskey="e" name="send" value="<?php echo $this->lang->line("button_send");?>" onclick="return confirm('<?php echo $this->lang->line("ask_mod_localidad");?>'); "/>
    <input type="reset" tabindex="3" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
   </div>
   </form>
  </div>
  
</div>

<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#user").focus();
 });

</script>
<div id="left">
</div>


<div id="right">
</div>

<div id="content" style="width:300px;">

  <form method="post" id="formlogin" name="formlogin" action="<?php echo site_url()."home/logear";?>">
  <div >
<?php echo validation_errors('<p class="error">','</p>'); ?>
</div>
  <div class="rowform">
   <div class="rowform-label"> <label> <?php echo $this->lang->line("user"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="1" name="user" id="user" value="" maxsize="100" />
   </div>
   </div>
   <div class="rowform">
    <div class="rowform-label"><label> <?php echo $this->lang->line("password"); ?>  </label> </div>
    <div class="rowform-input">
   <input type="password"  tabindex="2" name="password" value="" maxsize="100" />
   </div>
   </div>
   <div class="rowform">
   <input type="submit" tabindex="3" name="send" value="<?php echo $this->lang->line("button_send");?>" />
    <input type="reset" tabindex="4" name="clean" value="<?php echo $this->lang->line("button_clean");?>" />
   </div>
  </form>
  
</div>

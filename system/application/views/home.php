<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#user").focus();
 });

</script>


<div id="container" >

  <form method="post" id="formlogin" class="form-horizontal col-md-6" name="formlogin" action="<?php echo site_url()."home/logear";?>">
    <div >
      <?php echo validation_errors('<p class="error">','</p>'); ?>
    </div>
    <div class="form-group">
      <label for="user" class="col-md-4 control-label"> <?php echo mb_convert_case($this->lang->line("user"),MB_CASE_TITLE); ?>  </label>
  
      <div class="col-md-8">
        <input type="text" tabindex="1" class="form-control" name="user" id="user" value="" maxsize="100" />
      </div>
    </div>

   <div class="form-group">
      <label for="password" class="col-md-4 control-label"> <?php echo mb_convert_case($this->lang->line("password"),MB_CASE_TITLE); ?>  </label> 
      <div class="col-md-8">
        <input type="password" class="form-control" tabindex="2" name="password" value="" maxsize="100" />
      </div>
   </div>

   <div class="form-group">
    <button type="submit" class="btn btn-primary col-md-offset-5" tabindex="3" name="send"><?php echo $this->lang->line("button_send");?></button>
    <button type="reset" class="btn btn-warning" tabindex="4" name="clean"><?php echo $this->lang->line("button_clean");?></button>
   </div>
  </form>
  
</div>

<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#backurl").focus();
 });
<?php if (isset($popup)) { ?>
   window.onload=self.close();
<?php }?>
</script>
<div id="left">
  
</div>



<div id="content">

  <p> <?php echo $message; ?> </p>
  <?php 
   if (!isset($popup)){ ?>
  <a href="<?php echo $url_back;?>" id="backurl" tabindex="1"> <?php echo $this->lang->line("go_back"); ?> </a>
  <?php } ?>
  
</div>

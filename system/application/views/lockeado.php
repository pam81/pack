<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#backurl").focus();
 });

</script>
<div id="left">
  
</div>


<div id="content">

  <p> <?php echo $message; ?> </p>
  <input type="button" class="desbloquea" data-url="<?php echo $dir_desbloquea;?>" value="Desbloquear" />
  
</div>

<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#send").focus();
 });

</script>



<div id="content">

  
   <div id="top-bar">
    <h2> Token</h2>
    <a href="<?php echo site_url()."token/listado";?>" class="button"> Listado</a>
    </div>
   <hr class="separador">
  <form name="formtoken"  class="form_col" method="post" action="" >

     <br>
    <h4>Si quiere generar otro token en esta máquina toque el boton.</h4>   
    <br>
    <div class="rowform">
    <input type="text" name="maquina" value="" placeholder="nombre maquina">
   <input type="submit" 
          accesskey="e" id="send" name="send" 
          value="<?php echo $this->lang->line("btn_generate_token");?>" 
          onclick="return confirm('<?php echo $this->lang->line("ask_generate_token");?>'); "/>
   </div>
   <?php 
     if ($message) { echo '<p class="success"> '.$message.' </p>'; }
     if ($error) { echo '<p class="error">'.$error.'</p>';}
   ?>
  </form>
  
  <?php 
    if ($token){
  ?>
  <script>
    function setCookie(cname, cvalue, exdays) {
          var d = new Date();
          d.setTime(d.getTime() + (exdays*24*60*60*1000));
          var expires = "expires="+ d.toUTCString();
          document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
      }
      setCookie('flet-token','<?php echo $token;?>',100);
  </script>
  <?php }?>

</div>

<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#telefono").focus();
 });

</script>



<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("cta_x_cliente");?></h2>
  
  </div>
   <hr class="separador">
     <form name="formbase" id="formbase" method="post" action="<?php echo site_url()."reporte/generateCtaCliente";?>" onsubmit=" return flete.validarCtacte();  ">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
     <div class="rowform">
   <div class="rowform-label"> 
   <label for="telefono"> <?php echo $this->lang->line("title_phone"); ?>  </label>
   </div>
   <input type="text" tabindex="1" id="telefono" name="telefono" value="<?php echo set_value("telefono");?>" />
   
   </div> 
  <div class="rowform">
   <div class="rowform-label"> 
   <label for="fecha"> <?php echo $this->lang->line("title_fecha_desde"); ?>  </label>
   </div>
   <?php 
   $dia=date("d");
   $mes=date("m");
   $year=date("Y");
   ?>
   <input type="text" name="day" id="day" tabindex="2" size="2" maxsize="2" value="<?php echo set_value("day",$dia);?>" />
   <input type="text" name="month" id="month" tabindex="3" size="2" maxsize="2" value="<?php echo set_value("month",$mes);?>" />    
   <input type="text" name="year" id="year" tabindex="4" size="4" maxsize="4" value="<?php echo set_value("year",$year);?>" />
   
   </div>
   
   
   <div class="rowform">
   <div class="rowform-label"> 
   <label for="fecha"> <?php echo $this->lang->line("title_fecha_hasta"); ?>  </label>
   </div>
   <?php 
   $dia=date("d");
   $mes=date("m");
   $year=date("Y");
   ?>
   
   <input type="text" name="hday" id="hday" tabindex="5" size="2" maxsize="2" value="<?php echo set_value("hday",$dia);?>" />
   <input type="text" name="hmonth" id="hmonth" tabindex="6" size="2" maxsize="2" value="<?php echo set_value("hmonth",$mes);?>" />    
   <input type="text" name="hyear" id="hyear" tabindex="7" size="4" maxsize="4" value="<?php echo set_value("hyear",$year);?>" />
   
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> 
   <label for="tipo"> <?php echo $this->lang->line("title_tipo_pago"); ?>  </label>
   </div>
   <select name="tipo" tabindex="8">
    
  
   
    <option value="1"> Contado </option>
   
    <option value="2"> Cuenta Corriente </option>
  
    <option value="3"> Contado y Cuenta Corriente </option>
  
   </select>
   
   </div>
   
  <div class="rowform">
   <input type="submit" tabindex="9" id="send" accesskey="e" name="send" value="<?php echo $this->lang->line("button_send");?>" onclick="return confirm('<?php echo $this->lang->line("ask_generar_reporte");?>'); "/>
    <input type="reset" tabindex="10" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
   </div>
   </form>
  
  
  
</div>

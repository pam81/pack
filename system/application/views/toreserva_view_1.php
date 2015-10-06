<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#reserva_day").focus();
 });

</script>

<SCRIPT TYPE="text/javascript">
<!--
var downStrokeField;

function autojump(fieldName,nextFieldName,fakeMaxLength){
         var myForm=document.forms[document.forms.length - 1];
         var myField=myForm.elements[fieldName];
         myField.nextField=myForm.elements[nextFieldName];
if (myField.maxLength == null)
         myField.maxLength=fakeMaxLength;
         myField.onkeydown=autojump_keyDown;
         myField.onkeyup=autojump_keyUp;
}

function autojump_keyDown(){
         this.beforeLength=this.value.length;
         downStrokeField=this;
 }

function autojump_keyUp(){
         if (
                  (this == downStrokeField) && 
                  (this.value.length > this.beforeLength) && 
                  (this.value.length >= this.maxLength)
         )
         this.nextField.focus();
         downStrokeField=null;
}
  //-->

</SCRIPT>

<div id="content">

 
   <div id="top-bar">
    <h2> <?php echo $this->lang->line("title_add_reserva");?></h2>
    </div>
   <hr class="separador">
   <div id="left_reserva"> 
  <form name="formusuario" method="post" action="<?php echo site_url()."viaje/replicar/".$this->uri->segment(3);?>" onsubmit="return flete.validarReserva();">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
  
    <div class="rowform">
   <div class="rowform-label"> <label for="telefono"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="1" id="telefono"  name="telefono" value="<?php echo set_value("telefono",$reserva[0]->phone);?>" maxlength="8"  />
   <input type="hidden" name="clienteid" id="clienteid" value="<?php echo set_value("clienteid",$reserva[0]->clienteid);?>"/>
    </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="fecha"> <?php echo $this->lang->line("title_fecha"); ?>  </label>
   </div>
  <div class="rowform-input">
  <input type="text" name="reserva_day" id="reserva_day" tabindex="2" size="2" maxlength="2" value="<?php echo set_value("reserva_day",date("d"));?>" />
   <input type="text" name="reserva_month" id="reserva_month" tabindex="3" size="2" maxlength="2" value="<?php echo set_value("reserva_month",date("m"));?>" />    
   <input type="text" name="reserva_year" id="reserva_year" tabindex="4" size="4" maxlength="4" value="<?php echo set_value("reserva_year",date("Y"));?>" />
    <span><?php echo $this->lang->line("fecha_formato");?></span>
   </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label for="hora"> <?php echo $this->lang->line("title_hora_puerta"); ?>  </label>
   </div>
   <div class="rowform-input">
   
   <input type="text" name="puerta_hour" id="puerta_hour" tabindex="5" size="2" maxlength="2" value="<?php echo set_value("puerta_hour");?>" />
   
   :
   <input type="text" name="puerta_min" id="puerta_min" tabindex="6" size="2" maxlength="2" value="<?php echo set_value("puerta_min");?>" />
    <span><?php echo $this->lang->line("hora_formato");?></span>
   </div>
   </div>
  
    <div class="rowform">
   <div class="rowform-label"> <label for="alarma"> <?php echo $this->lang->line("title_hora_alarma"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" name="alarma_hour" id="alarma_hour" tabindex="7" size="2" maxlength="2" value="<?php echo set_value("alarma_hour");?>" />
   
   :
   <input type="text" name="alarma_min" id="alarma_min" tabindex="8" size="2" maxlength="2" value="<?php echo set_value("alarma_min");?>" />
   <span><?php echo $this->lang->line("hora_formato");?></span>
   
   </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="name"> <?php echo $this->lang->line("title_name"); ?>  </label>
   </div>
  <div class="rowform-input">
   <input type="text" tabindex="9" readonly="true" id="name" name="name" value="<?php echo set_value("name",$reserva[0]->name);?>" maxlength="250" size="50" />
   </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="desde"> <?php echo $this->lang->line("title_desde"); ?>  </label>
   </div>
   <div class="rowform-input">
   <textarea name="desde" rows="3" cols="40" id="desde" tabindex="10"><?php echo set_value("desde",$reserva[0]->desde);?></textarea>
   </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="destino"> <?php echo $this->lang->line("title_hasta"); ?>  </label>
   </div>
   <div class="rowform-input">
   <textarea name="destino" rows="3" cols="40" id="destino" tabindex="11"><?php echo set_value("hasta",$reserva[0]->destino);?></textarea>
   </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label for="presupuesto"> <?php echo $this->lang->line("title_presupuesto_aprox"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="12" id="presupuesto"  name="presupuesto" value="<?php echo set_value("presupuesto",$reserva[0]->presupuesto_aprox);?>" maxlength="250" />
   </div>
   </div>
   
  
   
   <div class="rowform">
   <div class="rowform-label"> <label for="observacion"> <?php echo $this->lang->line("title_observacion"); ?>  </label>
   </div>
   <div class="rowform-input">
   <textarea name="observacion" rows="3" cols="40" tabindex="13" rows="4" cols="15"><?php echo set_value("observacion",$reserva[0]->observaciones);?></textarea>
   </div>
   </div>
  
      <div class="rowform">
   <div class="rowform-label"> <label for="categoria"> <?php echo $this->lang->line("title_categoria"); ?>  </label>
   </div>
   <div class="rowform-input">
    <select name="categoria" tabindex="14">
     <?php 
      foreach($categorias as $c)
      {
        $select=false;
        if ($reserva[0]->categoriaid == $c->id)
          $select=true;
        echo "<option value=\"$c->id\" ".set_select("categoria",$c->id,$select).">$c->name</option>";
      }
       
     ?>
    </select>
    </div>
   </div>
  
   <div class="rowform">
   <div class="rowform-label"> <label for="pago"> <?php echo $this->lang->line("title_contado"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="checkbox" tabindex="15" id="contado" <?php if ($reserva[0]->forma_pago == 1) echo "checked=\"checked\"";?>  name="pago" value="1"  />
   </div>
   </div>
   

   
    <div class="rowform">
   <div class="rowform-label"> <label for="pago"> <?php echo $this->lang->line("title_ctacte"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="checkbox" tabindex="16" id="ctacte" <?php if ($reserva[0]->forma_pago == 2) echo "checked=\"checked\"";?>  name="pago" value="2" />
   </div>
   </div>
   
  
     
   <div class="rowform">
   <input type="submit" tabindex="17" id="send" accesskey="e" name="send" value="<?php echo $this->lang->line("button_add");?>" onclick="return confirm('<?php echo $this->lang->line("ask_add_reserva");?>'); " />
    <input type="reset" tabindex="18" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
   </div>
  </form>
  <SCRIPT TYPE="text/javascript">
<!--
  autojump('reserva_day', 'reserva_month', 2);
  autojump('reserva_month', 'reserva_year', 2);
  autojump('reserva_year', 'puerta_hour', 4);
  autojump('puerta_hour', 'puerta_min', 2);
  autojump('puerta_min', 'alarma_hour', 2);
  autojump('alarma_hour', 'alarma_min', 2);
  autojump('alarma_min', 'desde', 2);
  autojump('r_desde_day', 'r_desde_month', 2);
  autojump('r_desde_month', 'r_desde_year', 2);
  autojump('r_desde_year', 'r_hasta_day', 4);
  autojump('r_hasta_day', 'r_hasta_month', 2);
  autojump('r_hasta_month', 'r_hasta_year', 2);
  autojump('r_hasta_year', 'send', 4);
  //-->
</SCRIPT>
  </div>
  <div  id="right_reserva">
   
  <div id="info_ctacte"> </div>
  <div id="observaciones"> </div>
  <div id="mensaje"> </div>
  </div>
</div>

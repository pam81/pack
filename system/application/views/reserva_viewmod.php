<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#telefono").focus();
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
    <h2> <?php echo $this->lang->line("title_mod_reserva");?></h2>
    </div>
   <hr class="separador">
   <div id="left_reserva"> 
  <form name="formusuario" method="post" action="<?php echo site_url()."reserva/update/".$reserva[0]->id."/".$this->uri->segment(4);?>" onsubmit=" if (flete.validarReserva()) { document.getElementById('send').disabled=true;  return true;} else return false;" >
   <?php echo validation_errors('<p class="error">','</p>'); ?>
  
    <div class="rowform">
   <div class="rowform-label"> <label for="telefono"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="1" id="telefono" readonly="true" name="telefono" value="<?php echo set_value("telefono",$reserva[0]->phone);?>" maxlength="8"  />
   </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="fecha"> <?php echo $this->lang->line("title_fecha"); ?>  </label>
   </div>
  <div class="rowform-input">
  <?php
         $dia=substr($reserva[0]->fecha,6,2);
         $mes=substr($reserva[0]->fecha,4,2);
         $year=substr($reserva[0]->fecha,0,4);
         
  ?>       
   <input type="text" name="reserva_day" id="reserva_day" tabindex="2" size="2" maxlength="2" value="<?php echo set_value("reserva_day",$dia);?>" />
   <input type="text" name="reserva_month" id="reserva_month" tabindex="3" size="2" maxlength="2" value="<?php echo set_value("reserva_month",$mes);?>" />    
   <input type="text" name="reserva_year" id="reserva_year" tabindex="4" size="4" maxlength="4" value="<?php echo set_value("reserva_year",$year);?>" />
  
   </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label for="hora"> <?php echo $this->lang->line("title_hora_puerta"); ?>  </label>
   </div>
   <div class="rowform-input">
   <?php 
   $h=substr($reserva[0]->hpuerta,0,2);
   $m=substr($reserva[0]->hpuerta,2,2);
   ?>
   
    <input type="text" name="puerta_hour" id="puerta_hour" tabindex="5" size="2" maxlength="2" value="<?php echo set_value("puerta_hour",$h);?>" />
   
   :
   <input type="text" name="puerta_min" id="puerta_min" tabindex="6" size="2" maxlength="2" value="<?php echo set_value("puerta_min",$m);?>" />
   
   
     
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="alarma"> <?php echo $this->lang->line("title_hora_alarma"); ?>  </label>
   </div>
   <div class="rowform-input">
   <?php 
   $h=substr($reserva[0]->hsalida,0,2);
   $m=substr($reserva[0]->hsalida,2,2);
   
   ?>
   <input type="text" name="alarma_hour" id="alarma_hour" tabindex="7" size="2" maxlength="2" value="<?php echo set_value("alarma_hour",$h);?>" />
   
   :
   <input type="text" name="alarma_min" id="alarma_min" tabindex="8" size="2" maxlength="2" value="<?php echo set_value("alarma_min",$m);?>" />
   
   </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="name"> <?php echo $this->lang->line("title_name"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="9" readonly="true" id="name" name="name" value="<?php echo $reserva[0]->name;?>" maxlength="250" size="50" />
   </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="desde"> <?php echo $this->lang->line("title_desde"); ?>  </label>
   </div>
   <div class="rowform-input">
   <textarea name="desde" rows="3" cols="40" id="desde" tabindex="10"><?php echo set_value("desde",$reserva[0]->desde);?></textarea>
   <input type="button" name="udesde" id="udesde" value="Ubicar" onclick="flete.showLugar('<?php echo base_url()."mapa.php";?>','desde');"/>
   </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="destino"> <?php echo $this->lang->line("title_hasta"); ?>  </label>
   </div>
   <div class="rowform-input">
   <textarea name="destino" rows="3" cols="40" id="destino" tabindex="11"><?php echo set_value("destino",$reserva[0]->destino);?></textarea>
   <input type="button" name="udesde" id="udesde" value="Ubicar" onclick="flete.showLugar('<?php echo base_url()."mapa.php";?>','destino');"/>
   <input type="button" name="ruta" id="ruta" value="Calcular ruta" onclick="flete.showRuta('<?php echo base_url()."ruta.php";?>')" />
   </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> 
   <input type="checkbox" id="hasMudanza" name="hasMudanza" value="1" tabindex="12" <?php if ($reserva[0]->hasMudanza == 1) echo "checked=\"checked\""; ?>  />
   <label for="hasMudanza"> <?php echo $this->lang->line("title_mudanza"); ?>  </label>
   
   </div>
   </div>
   
     <div class="rowform">
   <div class="rowform-label"> 
   <input tabindex="12" type="checkbox" id="art" name="art" value="1" <?php if ($reserva[0]->art == 1) echo "checked=\"checked\""; ?>  />
   <label for="art"> <?php echo $this->lang->line("title_art"); ?>  </label>
   
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="13" id="art_valor"  name="art_valor" value="<?php echo set_value("art_valor",$reserva[0]->art_valor);?>" maxlength="250" />
   </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label for="presupuesto"> <?php echo $this->lang->line("title_presupuesto_aprox"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="14" id="presupuesto"  name="presupuesto" value="<?php echo set_value("presupuesto",$reserva[0]->presupuesto_aprox);?>" maxlength="250" />
   </div>
   </div>
   
  
   
   <div class="rowform">
   <div class="rowform-label"> <label for="observacion"> <?php echo $this->lang->line("title_observacion"); ?>  </label>
   </div>
   <div class="rowform-input">
   <textarea name="observacion" rows="3" cols="40" tabindex="15" rows="4" cols="15"><?php echo set_value("observacion",$reserva[0]->observaciones);?></textarea>
   </div>
   </div>
  <!--
   <div class="rowform">
   <div class="rowform-label"> <label for="valor_mercaderia"> <?php echo $this->lang->line("title_valor_mercaderia"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="16" id="valor_mercaderia"  name="valor_mercaderia" value="<?php echo set_value("valor_mercaderia",$reserva[0]->valor_mercaderia);?>" maxlength="250" />
   </div>
   </div>
  
  <div class="rowform">
   <div class="rowform-label"> <label for="excedente_mercaderia"> <?php echo $this->lang->line("title_excedente_mercaderia"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="17" id="excedente_mercaderia" onblur="flete.getExcedente('<?php echo site_url()."reserva/getExcedente";?>');"   name="excedente_mercaderia" value="<?php echo set_value("excedente_mercaderia",$reserva[0]->mercaderia_excedente);?>" maxlength="10" />
   </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label for="excedente_monto"> <?php echo $this->lang->line("title_excedente_monto"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="18" id="excedente_monto"  name="excedente_monto" value="<?php echo set_value("excedente_monto",$reserva[0]->monto_excedente);?>" maxlength="10" />
   </div>
   </div>
   <?php if ($reserva[0]->codigo_excedente) { ?>
    <div class="rowform">
   <div class="rowform-label"> <label for="excedente_codigo"> <?php echo $this->lang->line("title_excedente_codigo"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="19"  id="excedente_codigo"  name="excedente_codigo" value="<?php echo set_value("excedente_codigo",$reserva[0]->codigo_excedente);?>" maxlength="10" />
   </div>
   </div>
  <?php } ?>
     -->
    <div class="rowform">
   <div class="rowform-label"> <label for="categoria"> <?php echo $this->lang->line("title_categoria"); ?>  </label>
   </div>
    <div class="rowform-input">
    <select name="categoria" tabindex="20">
     <?php 
      foreach($categorias as $c)
      {
        $seleccionar=false;
        if ($c->id == $reserva[0]->categoriaid)
         $seleccionar=true;
       
          echo "<option value=\"$c->id\" ".set_select("categoria",$c->id,$seleccionar).">$c->name</option>";
      }
       
     ?>
    </select>
    </div>
   </div>
  
   <div class="rowform">
   <div class="rowform-label"> <label for="pago"> <?php echo $this->lang->line("title_contado"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="radio" tabindex="21" id="contado" <?php if ($reserva[0]->forma_pago == 1) echo "checked=\"checked\""; ?>  name="pago" value="1"  />
   </div>
   </div>
      
    <div class="rowform">
   <div class="rowform-label"> <label for="pago"> <?php echo $this->lang->line("title_ctacte"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="radio" tabindex="22" id="ctacte" <?php if ($reserva[0]->forma_pago == 2) echo "checked=\"checked\""; ?>   name="pago" value="2" />
   </div>
   </div>
  
  <div class="rowform">
   <div class="rowform-label">
    <?php echo $this->lang->line("repeticion");?>
   </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="fecha"> <?php echo $this->lang->line("title_fecha_desde"); ?>  </label>
   </div>
  <div class="rowform-input">
  <?php 
   $dd=substr($reserva[0]->repeticion_desde,6,2);
   $md=substr($reserva[0]->repeticion_desde,4,2);
   $yd=substr($reserva[0]->repeticion_desde,0,4);
  ?>
  <input readonly="readonly" type="text" name="r_desde_day" id="r_desde_day" tabindex="25" size="2" maxlength="2" value="<?php echo set_value("r_desde_day",$dd);?>" />
   <input readonly="readonly" type="text" name="r_desde_month" id="r_desde_month" tabindex="26" size="2" maxlength="2" value="<?php echo set_value("r_desde_month",$md);?>" />    
   <input readonly="readonly" type="text" name="r_desde_year" id="r_desde_year" tabindex="27" size="4" maxlength="4" value="<?php echo set_value("r_desde_year",$yd);?>" />
    <span><?php echo $this->lang->line("fecha_formato");?></span>
   </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="fecha"> <?php echo $this->lang->line("title_fecha_hasta"); ?>  </label>
   </div>
  <div class="rowform-input">
  <?php 
   $dh=substr($reserva[0]->repeticion_hasta,6,2);
   $mh=substr($reserva[0]->repeticion_hasta,4,2);
   $yh=substr($reserva[0]->repeticion_hasta,0,4);
  ?>
  <input readonly="readonly" type="text" name="r_hasta_day" id="r_hasta_day" tabindex="28" size="2" maxlength="2" value="<?php echo set_value("r_hasta_day",$dh);?>" />
   <input readonly="readonly" type="text" name="r_hasta_month" id="r_hasta_month" tabindex="29" size="2" maxlength="2" value="<?php echo set_value("r_hasta_month",$mh);?>" />    
   <input readonly="readonly" type="text" name="r_hasta_year" id="r_hasta_year" tabindex="30" size="4" maxlength="4" value="<?php echo set_value("r_hasta_year",$yh);?>" />
    <span><?php echo $this->lang->line("fecha_formato");?></span>
   </div>
   </div>
   
   
   <!-- <div class="rowform-repeticion">
   <div class="rowform-label-repeticion"> <label >Todos</label>
   </div>
   <div class="rowform-input-repeticion">
   <input type="checkbox" tabindex="25" id="todos"   name="todos" value="" onclick="flete.allDays(this.form);" />
   </div>
   </div>-->
   
   <div class="rowform-repeticion">
   <div class="rowform-label-repeticion"> <label >Lunes</label>
   </div>
   <div class="rowform-input-repeticion">
   <input disabled="disabled" type="checkbox" tabindex="31" id="day1" <?php foreach($repeticion as $r) { if ($r->dia == 1)  echo "checked=\"checked\""; }?>   name="day1" value="1" />
   </div>
   </div>
   
   <div class="rowform-repeticion">
   <div class="rowform-label-repeticion"> <label >Martes </label>
   </div>
   <div class="rowform-input-repeticion">
   <input disabled="disabled" type="checkbox" tabindex="32" id="day2"  <?php foreach($repeticion as $r) { if ($r->dia == 2)  echo "checked=\"checked\""; }?>   name="day2" value="2" />
   </div>
   </div>
   
   <div class="rowform-repeticion">
   <div class="rowform-label-repeticion"> <label >Miércoles</label>
   </div>
   <div class="rowform-input-repeticion">
   <input disabled="disabled" type="checkbox" tabindex="33" id="day3" <?php foreach($repeticion as $r) { if ($r->dia == 3)  echo "checked=\"checked\""; }?>    name="day3" value="3" />
   </div>
   </div>
   
   <div class="rowform-repeticion">
   <div class="rowform-label-repeticion"> <label >Jueves</label>
   </div>
   <div class="rowform-input-repeticion">
   <input disabled="disabled" type="checkbox" tabindex="34" id="day4" <?php foreach($repeticion as $r) { if ($r->dia == 4)  echo "checked=\"checked\""; }?>   name="day4" value="4" />
   </div>
   </div>
   
   <div class="rowform-repeticion">
   <div class="rowform-label-repeticion"> <label >Viernes</label>
   </div>
   <div class="rowform-input-repeticion">
   <input disabled="disabled" type="checkbox" tabindex="35" id="day5" <?php foreach($repeticion as $r) { if ($r->dia == 5)  echo "checked=\"checked\""; }?>   name="day5" value="5" />
   </div>
   </div>
  
    <div class="rowform-repeticion">
   <div class="rowform-label-repeticion"> <label >Sábado</label>
   </div>
   <div class="rowform-input-repeticion">
   <input disabled="disabled" type="checkbox" tabindex="36" id="day6" <?php foreach($repeticion as $r) { if ($r->dia == 6)  echo "checked=\"checked\""; }?>   name="day6" value="6" />
   </div>
   </div>
   
    <div class="rowform-repeticion">
   <div class="rowform-label-repeticion"> <label >Domingo</label>
   </div>
   <div class="rowform-input-repeticion">
   <input disabled="disabled" type="checkbox" tabindex="37" id="day7" <?php foreach($repeticion as $r) { if ($r->dia == 7)  echo "checked=\"checked\""; }?>   name="day7" value="7" />
   </div>
   </div>
   
  
   <div class="rowform">
   <input type="submit" tabindex="23" id="send" accesskey="e" name="send" value="<?php echo $this->lang->line("button_mod");?>" onclick="return confirm('<?php echo $this->lang->line("ask_mod_reserva");?>'); " />
    <input type="reset" tabindex="24" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
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
  <div id="nro_reserva"><?php echo $this->lang->line("nro_reserva").": ".$reserva[0]->id;?> </div>
  <div id="info_ctacte"> <?php if($reserva[0]->ctacte == "s") echo $this->lang->line("ctacte_habilitada"); else echo $this->lang->line("solo_efectivo");?></div>
  <div id="observaciones"><?php echo $reserva[0]->cobser; ?> </div>
  <div id="mensaje"><?php echo $reserva[0]->mensaje; ?> </div>
  <div ><?php echo $this->lang->line("title_reserved_by")." ".$reserva[0]->reservo; ?> </div>
  </div>
</div>

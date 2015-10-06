<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#telefono").focus();
  
  
  
    flete.getCliente2('<?php echo site_url()."cliente/info/"?>','<?php echo site_url()."cliente/reservaadd/";?>','<?php echo $this->lang->line("title_add_cliente");?>');
  
  
  
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
  <form name="formusuario" method="post" action="<?php echo site_url()."reserva/addnew/".$this->uri->segment(3);?>" onsubmit=" if (flete.validarReserva()) { document.getElementById('send').disabled=true;  return true;} else return false;">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
  
  <?php $this->flete->startPost();?>
    <div class="rowform">
   <div class="rowform-label"> <label for="telefono"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="1" id="telefono"  name="telefono" value="<?php echo set_value("telefono",$reserva[0]->phone);?>" maxlength="8"  />
  <!-- <button tabindex="1" type="button" onclick="flete.getCliente('<?php echo site_url()."cliente/info/"?>','<?php echo site_url()."cliente/reservaadd/";?>','<?php echo $this->lang->line("title_add_cliente");?>');"  ><img src="<?php echo base_url()."images/img/search_16x16.png";?>" alt="buscar" width="16" height="16"></button>
    lo quite porque sino me trae los datos de la base.
  -->
   <input type="hidden" data-server="<?php echo site_url();?>" data-url="<?php echo site_url()."reserva/getClientReservas"?>"  name="clienteid" id="clienteid" value="<?php echo set_value("clienteid",$reserva[0]->clienteid);?>"/>
   
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
   <input type="text" tabindex="9" readonly="true" id="name" name="name" value="<?php echo set_value("name",$reserva[0]->name);?>" maxlength="250"  />
   </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="desde"> <?php echo $this->lang->line("title_desde"); ?>  </label>
   </div>
   <div class="rowform-input">
   <textarea name="desde"  id="desde" tabindex="10"><?php echo set_value("desde",$reserva[0]->desde);?></textarea>
   <input type="button" name="udesde" id="udesde" value="Ubicar" onclick="flete.showLugar('<?php echo base_url()."mapa.php";?>','desde');"/>
   </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="destino"> <?php echo $this->lang->line("title_hasta"); ?>  </label>
   </div>
   <div class="rowform-input">
   <textarea name="destino"  id="destino" tabindex="11"><?php echo set_value("destino",$reserva[0]->destino);?></textarea>
   <input type="button" name="udesde" id="udesde" value="Ubicar" onclick="flete.showLugar('<?php echo base_url()."mapa.php";?>','destino');"/>
   <input type="button" name="ruta" id="ruta" value="Calcular ruta" onclick="flete.showRuta('<?php echo base_url()."ruta.php";?>')" />
   </div> 
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> 
   <input type="checkbox" id="art" name="art" value="1" tabindex="12"  <?php if ($reserva[0]->art == 1) echo "checked=\"checked\""; ?> />
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
   <input type="text" tabindex="17" id="excedente_mercaderia" onblur="flete.getExcedente('<?php echo site_url()."reserva/getExcedente";?>');"  name="excedente_mercaderia" value="<?php echo set_value("excedente_mercaderia",$reserva[0]->mercaderia_excedente);?>" maxlength="10" />
   </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label for="excedente_monto"> <?php echo $this->lang->line("title_excedente_monto"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="18" id="excedente_monto"  name="excedente_monto" value="<?php echo set_value("excedente_monto",$reserva[0]->monto_excedente);?>" maxlength="10" />
   </div>
   </div>
   
   -->
  
  
      <div class="rowform">
   <div class="rowform-label"> <label for="categoria"> <?php echo $this->lang->line("title_categoria"); ?>  </label>
   </div>
   <div class="rowform-input">
    <select name="categoria" tabindex="19">
     <?php 
      foreach($categorias as $c)
      {
        $selected='';
        if ($c->id == $reserva[0]->categoriaid)
           $selected="selected=\"selected\"";
           
        echo "<option $selected value=\"$c->id\">$c->name</option>";
      }
       
     ?>
    </select>
    </div>
   </div>
  
   <div class="rowform">
   <div class="rowform-label"> <label for="pago"> <?php echo $this->lang->line("title_contado"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="radio" tabindex="20" id="contado" <?php if ($reserva[0]->forma_pago == 1) echo "checked=\"checked\""; ?>  name="pago" value="1"   />
   </div>
   </div>
   

   
    <div class="rowform">
   <div class="rowform-label"> <label for="pago"> <?php echo $this->lang->line("title_ctacte"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="radio" tabindex="21" id="ctacte" <?php if ($reserva[0]->forma_pago == 2) echo "checked=\"checked\""; ?>  name="pago" value="2" />
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
  <input type="text" name="r_desde_day" id="r_desde_day" tabindex="24" size="2" maxlength="2" value="<?php echo set_value("r_desde_day",date("d",mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"))));?>" />
   <input type="text" name="r_desde_month" id="r_desde_month" tabindex="25" size="2" maxlength="2" value="<?php echo set_value("r_desde_month",date("m"));?>" />    
   <input type="text" name="r_desde_year" id="r_desde_year" tabindex="26" size="4" maxlength="4" value="<?php echo set_value("r_desde_year",date("Y"));?>" />
    <span><?php echo $this->lang->line("fecha_formato");?></span>
   </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="fecha"> <?php echo $this->lang->line("title_fecha_hasta"); ?>  </label>
   </div>
  <div class="rowform-input">
  <input type="text" name="r_hasta_day" id="r_hasta_day" tabindex="27" size="2" maxlength="2" value="<?php echo set_value("r_hasta_day",date("d",mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"))));?>" />
   <input type="text" name="r_hasta_month" id="r_hasta_month" tabindex="28" size="2" maxlength="2" value="<?php echo set_value("r_hasta_month",date("m"));?>" />    
   <input type="text" name="r_hasta_year" id="r_hasta_year" tabindex="29" size="4" maxlength="4" value="<?php echo set_value("r_hasta_year",date("Y"));?>" />
    <span><?php echo $this->lang->line("fecha_formato");?></span>
   </div>
   </div>
   
   
    <div class="rowform-repeticion">
   <div class="rowform-label-repeticion"> <label >Todos</label>
   </div>
   <div class="rowform-input-repeticion">
   <input type="checkbox" tabindex="30" id="todos"   name="todos" value="" onclick="flete.allDays(this.form);" />
   </div>
   </div>
   
   <div class="rowform-repeticion">
   <div class="rowform-label-repeticion"> <label >Lunes</label>
   </div>
   <div class="rowform-input-repeticion">
   <input type="checkbox" tabindex="31" id="day1"   name="day1" value="1" />
   </div>
   </div>
   
   <div class="rowform-repeticion">
   <div class="rowform-label-repeticion"> <label >Martes </label>
   </div>
   <div class="rowform-input-repeticion">
   <input type="checkbox" tabindex="32" id="day2"   name="day2" value="2" />
   </div>
   </div>
   
   <div class="rowform-repeticion">
   <div class="rowform-label-repeticion"> <label >Miércoles</label>
   </div>
   <div class="rowform-input-repeticion">
   <input type="checkbox" tabindex="33" id="day3"   name="day3" value="3" />
   </div>
   </div>
   
   <div class="rowform-repeticion">
   <div class="rowform-label-repeticion"> <label >Jueves</label>
   </div>
   <div class="rowform-input-repeticion">
   <input type="checkbox" tabindex="34" id="day4"   name="day4" value="4" />
   </div>
   </div>
   
   <div class="rowform-repeticion">
   <div class="rowform-label-repeticion"> <label >Viernes</label>
   </div>
   <div class="rowform-input-repeticion">
   <input type="checkbox" tabindex="35" id="day5"   name="day5" value="5" />
   </div>
   </div>
  
    <div class="rowform-repeticion">
   <div class="rowform-label-repeticion"> <label >Sábado</label>
   </div>
   <div class="rowform-input-repeticion">
   <input type="checkbox" tabindex="36" id="day6"   name="day6" value="6" />
   </div>
   </div>
   
    <div class="rowform-repeticion">
   <div class="rowform-label-repeticion"> <label >Domingo</label>
   </div>
   <div class="rowform-input-repeticion">
   <input type="checkbox" tabindex="37" id="day7"   name="day7" value="7" />
   </div>
   </div>
   
     
   <div class="rowform">
   <input type="submit" tabindex="22" id="send"  accesskey="e" name="send" value="<?php echo $this->lang->line("button_add");?>" onclick="return confirm('<?php echo $this->lang->line("ask_add_reserva");?>'); " />
    <input type="reset" tabindex="23" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick=" if (confirm('<?php echo $this->lang->line("ask_clean");?>')){ document.getElementById('send').disabled=false; return true;} else return false;  " />
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
  
  <div id="previus_reservas">
  <table id="table_previus_reservas" class="tablelist">
   <thead>
    <tr> 
    <th width="70"> <?php echo mb_convert_case($this->lang->line("title_fecha"),MB_CASE_UPPER,"UTF-8");?></th>
    <th width="40" > <?php echo mb_convert_case($this->lang->line("title_puerta"),MB_CASE_UPPER,"UTF-8");?> </th>
    <th width="35"> <?php echo mb_convert_case($this->lang->line("title_categoria"),MB_CASE_UPPER,"UTF-8");?> </th>
    <th> <?php echo mb_convert_case($this->lang->line("title_desde"),MB_CASE_UPPER,"UTF-8");?> </th>
    <th> <?php echo mb_convert_case($this->lang->line("title_hasta"),MB_CASE_UPPER,"UTF-8");?> </th>
    <tr>
   </thead>
   <tbody> 
   
   </tbody>
   </table>
  
  </div>
  
  </div>
  <div id="banner_red" style=" display:none; padding: 10px; background-color: #eee; color: #D56C5B; min-width: 200px; min-height: 100px; position: fixed; left: 200px; top: 100px; z-index: 100;font-family: 'Sentinel-Medium';
	font-size: 20px;
	font-weight: bold;
  text-align: center;
  ">
    <span id="banner_msg" >No puede asignarle una reserva. El cliente esta suspendido</span>
    <br>
    <input type="button" name="send" id="send_banner" value="Aceptar" onclick="window.location.href='<?php echo site_url()."inicio";?>'">
  </div>
</div>


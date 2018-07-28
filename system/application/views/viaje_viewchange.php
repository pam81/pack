<script>
//al entrar pongo foco en primer campo

$(document).ready(function(){
  $("#hora_abordo").focus();
 });
</script>




<div id="content">

 
   <div id="top-bar">
    <h2 > <?php echo $this->lang->line("title_mod_viaje");?></h2>
  
     <div class="tiempo_abordo" >
      <div> TIEMPO DESDE ABORDO : <?php if (isset($tiempo)) { if ($tiempo["dias"] != 0) echo $tiempo["dias"]." días "; if ($tiempo["horas"] != 0) echo $tiempo["horas"]." hs ";if ($tiempo["minutos"] != 0) echo $tiempo["minutos"]." min "; if ($tiempo["segundos"] != 0) echo $tiempo["segundos"]." seg "; }?> </div>
      </div>
      <div class="tiempo_abordo" >
     <div> TOTAL= $ <?php if (isset($total_viaje)) echo $total_viaje;?> </div>
     </div> 
    
    </div>
   <hr class="separador">
  <form name="formusuario" method="post" action="<?php echo site_url()."viaje/changeData/".$viaje[0]->id."/".$this->uri->segment(4);?>">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
   
  <div class="first_row"> 
   <div class="form_left">
   <div class="rowform">
   <div class="rowform-label"> <label for="fecha"> <?php echo $this->lang->line("title_fecha"); ?>  </label>
   </div>
   <div class="rowform-text">
    <?php 
    $year=substr($viaje[0]->fecha_despacho,0,4);
    $month=substr($viaje[0]->fecha_despacho,4,2);
    $day=substr($viaje[0]->fecha_despacho,6,2);
    echo $day."-".$month."-".$year;?>
    </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="phone"> <?php echo $this->lang->line("title_phone"); ?>  </label>
   </div>
    <div class="rowform-text"><?php echo $viaje[0]->phone;?></div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="name"> <?php echo $this->lang->line("title_name"); ?>  </label>
   </div>
   
    <div class="rowform-text"> <?php echo $viaje[0]->cliente;?> </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="desde"> <?php echo $this->lang->line("title_desde"); ?>  </label>
   </div>
   <div class="rowform-text"> <?php echo $viaje[0]->desde;?> 
   <input type="hidden"  name="desde" id="desde" value="<?php echo $viaje[0]->desde;?> " />
   <input type="button" name="udesde" id="udesde" value="Ubicar" onclick="flete.showLugar('<?php echo base_url()."mapa.php";?>','desde');"/>
   </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label for="hasta"> <?php echo $this->lang->line("title_hasta"); ?>  </label>
   </div>
   <div class="rowform-text"> <?php echo $viaje[0]->destino;?> 
    <input type="hidden" name="destino" id="destino" value="<?php echo $viaje[0]->destino;?>" />
   <input type="button" name="udesde" id="udesde" value="Ubicar" onclick="flete.showLugar('<?php echo base_url()."mapa.php";?>','destino');"/>
   </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="movil"> <?php echo $this->lang->line("title_movil"); ?>  </label>
   </div>
   <div class="rowform-text"><?php echo $viaje[0]->movil." ".$viaje[0]->marca;?></div>
    
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="chofer"> <?php echo $this->lang->line("title_chofer"); ?>  </label>
   </div>
   <div class="rowform-text"> <?php echo $viaje[0]->name." ".$viaje[0]->lastname;?> </div>
    
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="chofer"> <?php echo $this->lang->line("title_categoria"); ?>  </label>
   </div>
   <div class="rowform-text"> <?php echo $viaje[0]->categoria;?> </div>
    
   </div>
  
     
   <div class="rowform">
   <div class="rowform-label"> <label for="presupuesto"> <?php echo $this->lang->line("title_presupuesto_aprox"); ?>  </label>
   </div>
   <div class="rowform-text"> <?php echo "$".$viaje[0]->presupuesto_aprox;?> </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="presupuesto"> <?php echo $this->lang->line("title_valor_mercaderia"); ?>  </label>
   </div>
   <div class="rowform-text"> <?php echo $viaje[0]->valor_mercaderia;?> </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label > <?php echo $this->lang->line("title_excedente_mercaderia"); ?>  </label>
   </div>
   <div class="rowform-text"> <?php echo $viaje[0]->mercaderia_excedente;?> </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label > <?php echo $this->lang->line("title_excedente_monto"); ?>  </label>
   </div>
   <div class="rowform-text"> <?php echo $viaje[0]->monto_excedente;?> </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label > <?php echo $this->lang->line("title_excedente_codigo"); ?>  </label>
   </div>
   <div class="rowform-text"> <?php echo $viaje[0]->codigo_excedente;?> </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="observacion"> <?php echo $this->lang->line("title_observacion"); ?>  </label>
   </div>
    <div class="rowform-input"> 
    <textarea name="observacion" tabindex="9"><?php echo set_value("observacion",$viaje[0]->observaciones);?></textarea> 
    </div>
   </div>
    
   </div>
   
   
   <div class="form_rigth">
     
   
   <div class="rowform">
   <div class="rowform-label"> <label for="viaje"> <?php echo $this->lang->line("nro_viaje"); ?>  </label>
   </div>
   <div class="rowform-text"><?php echo $viaje[0]->id;?></div>
   </div>
   
  <div class="rowform">
   <div class="rowform-label"> <label for="nroreserva"> <?php echo $this->lang->line("nro_reserva"); ?>  </label>
   </div>
   <div class="rowform-text"><?php echo $viaje[0]->nro_reserva;?></div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="hora_despacho"> <?php echo $this->lang->line("hora_despacho"); ?>  </label>
   </div>
   <div class="rowform-text"><?php 
   
   $h=substr($viaje[0]->hora_despacho,0,2);
    $m=substr($viaje[0]->hora_despacho,2,2);
   
   echo "$h:$m";?></div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="hora_puerta"> <?php echo $this->lang->line("hora_exacta_puerta"); ?>  </label>
   </div>
   <div class="rowform-text"><?php 
    $h=substr($viaje[0]->hexacta_puerta,0,2);
    $m=substr($viaje[0]->hexacta_puerta,2,2);
    echo "$h:$m";?></div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="hora_abordo"> <?php echo $this->lang->line("hora_abordo"); ?>  </label>
   </div>
       
     <div class="rowform-input">
     <?php 
     $h=date("H");
      if ($viaje[0]->habordo != '')
      {
         $h=substr($viaje[0]->habordo,0,2);
      }   
     $m=date("i");
    if ($viaje[0]->habordo != '')
     {
         $m=substr($viaje[0]->habordo,2,2);
     }
     
     ?>
     
     <input type="text" name="hora_abordo" id="hora_abordo" tabindex="1" size="2" value="<?php echo set_value("hora_abordo",$h);?>" />
     :
     <input type="text" name="min_abordo" id="min_abordo" tabindex="2" size="2" value="<?php echo set_value("min_abordo",$m);?>" />
   
     
     
   
   </div>
   
   
   </div>
    
      <div class="rowform">
   <div class="rowform-label"> <label for="hora_regreso"> <?php echo $this->lang->line("hora_regreso"); ?>  </label>
   </div>
    <div class="rowform-input">
    <?php 
     $h=date("H");
      if ($viaje[0]->hregreso != '')
      {
         $h=substr($viaje[0]->hregreso,0,2);
      }   
     $m=date("i");
    if ($viaje[0]->hregreso != '')
     {
         $m=substr($viaje[0]->hregreso,2,2);
     }
    ?>
    <input type="text" name="hora_regreso" id="hora_regreso" tabindex="3" size="2" value="<?php echo set_value("hora_regreso",$h);?>" />
     :
     <input type="text" name="min_regreso" id="min_regreso" tabindex="4" size="2" value="<?php echo set_value("min_regreso",$m);?>" />
   
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="fecha"> <?php echo $this->lang->line("title_fecha_regreso"); ?>  </label>
   </div>
   <div class="rowform-input">
   <?php 
         if ($viaje[0]->fecha_regreso != ''){
        
         $yr=substr($viaje[0]->fecha_regreso,0,4);
         $mr=substr($viaje[0]->fecha_regreso,4,2);
         $dr=substr($viaje[0]->fecha_regreso,6,2);
         }
         else
         { $yr=date("Y");
           $mr=date("m");
           $dr=date("d");
         }
          
   ?>
   <input type="text" name="regreso_day" id="regreso_day" tabindex="5" size="2" value="<?php echo set_value("regreso_day",$dr);?>" />
   <input type="text" name="regreso_month" id="regreso_month" tabindex="6" size="2" value="<?php echo set_value("regreso_month",$mr);?>" />
   <input type="text" name="regreso_year" id="regreso_year" tabindex="7" size="4" value="<?php echo set_value("regreso_year",$yr);?>" />
   
   </div>
   </div>
   
   
    <div class="rowform">
   <div > 
   <?php if ($viaje[0]->forma_pago == 2) {?>
   <label for="comefvo"> <?php echo $this->lang->line("pago_ctacte"); ?>  </label>
   <?php } else {?>
   <label for="comefvo"> <?php echo $this->lang->line("pago_efvo"); ?>  </label>
   <?php }?>
   </div>
  
   </div>
   
   <?php if ($viaje[0]->cancelado == 1) { ?>
   <div class="rowform">
   <div class="rowform-label"> <label for="cancelado"> <?php echo $this->lang->line("title_causa_cancelado"); ?>  </label>
   </div>
    <div class="rowform-input"> 
    <textarea name="cancelado" tabindex="9"><?php echo $viaje[0]->causa_cancel;?></textarea> 
    </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="reservado"> <?php echo $this->lang->line("title_cancel_by"); ?>  </label>
   </div>
    <div class="rowform-text"><?php echo $viaje[0]->cancelo;?></div>
   </div>
   
   <?php } ?>
   
   <?php if ($this->Current_User->isHabilitado("MOD_VIAJE") ) {?> 
   <div class="rowform-button">
   
  <?php if ($viaje[0]->cancelado != 1) { ?>
    <?php if ($viaje[0]->forma_pago == 2) {?>
    <input type="button" tabindex="8" id="change" accesskey="c" name="change" value="<?php echo $this->lang->line("title_change_efvo");?>" onclick="if(confirm('<?php echo $this->lang->line("ask_mod_forma_pago");?>')) {form.action='<?php echo site_url()."viaje/change/1/".$viaje[0]->id; ?>'; form.submit();  } " />
    <?php } if ($viaje[0]->forma_pago == 1) { ?>
    <input type="button" tabindex="8" id="change" accesskey="c" name="change" value="<?php echo $this->lang->line("title_change_ctacte");?>" onclick="if(confirm('<?php echo $this->lang->line("ask_mod_forma_pago");?>')) {form.action='<?php echo site_url()."viaje/change/2/".$viaje[0]->id; ?>'; form.submit(); }" />
    <?php } }?>
  
    <?php if($viaje[0]->cerrado == 0){ ?>
    <input type="submit" tabindex="27" id="send" accesskey="e" name="send" value="<?php echo $this->lang->line("title_close");?>" onclick="if ( flete.validarCloseViaje('<?php echo $this->lang->line("ask_close_viaje");?>','<?php echo $viaje[0]->forma_pago;?>') ) { form.action='<?php echo site_url()."viaje/update/".$viaje[0]->id;?>'; form.submit();}  " />
    <?php } ?>
    <input type="submit" tabindex="25" id="mod" accesskey="e" name="mod" value="<?php echo $this->lang->line("title_mod");?>" onclick="return confirm('<?php echo $this->lang->line("ask_mod_viaje");?>'); " />
    <input type="reset" tabindex="26" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
   <input type="button" name="ruta" id="ruta" value="Calcular ruta" onclick="flete.showRuta('<?php echo base_url()."ruta.php";?>')" />
   </div>
   <?php } ?>
   
   
   </div> <!-- rigth-->
  </div> <!-- first_row --> 
  
   <div class="form_left">
       <div class="rowformMiddle">
   
    <span class="span_total_viaje">TOTAL $</span> 
      <span class="span_total_viaje"  id="total_viaje"> 
      <?php
        $total= $viaje[0]->valor + $viaje[0]->espera + $viaje[0]->peones + $viaje[0]->km +
            $viaje[0]->estacionamiento + $viaje[0]->peaje +   $viaje[0]->art_valor + $viaje[0]->otros +
            $viaje[0]->iva;
            
        echo $total;
       ?>
       </span> 
       <?php if ($viaje[0]->forma_pago == 2){
            $total_ctacte = $total + $viaje[0]->porcentaje_ctacte;
         
            echo "<br><span class=\"span_total_viaje\">TOTAL Cta. Cte. = $</span><span class=\"span_total_viaje\" 
            id=\"total_viaje_ctacte\"> $total_ctacte</span>";
       
       
        }?>
        
        <?php if ($viaje[0]->hasMudanza ){
            $total_mudanza = $total - $viaje[0]->mudanza;
            echo '<input type="hidden" name="comision_mudanza" id="comision_mudanza" value="'.$comision->mudanza.'">';
            echo "<br><span class=\"span_total_viaje\">TOTAL Chofer = $</span><span class=\"span_total_viaje\" id=\"total_viaje_mudanza\"> $total_mudanza</span>";
       
       
        }?>
   
  
  </div>
   
     <div class="rowform">
   <div class="rowform-label"> <label for="subtotal"> <?php echo $this->lang->line("title_subtotal")." $"; ?>  </label>
   </div>
     <div class="rowform-input">
    <input type="text" name="subtotal" id="subtotal" value="<?php echo set_value("subtotal",$viaje[0]->valor);?>" tabindex="10" onKeyUp="getTotal()"/>
    </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="espera"> <?php echo $this->lang->line("title_espera")." $"; ?>  </label>
   </div>
    <div class="rowform-input">
    <input type="text" name="espera" id="espera" value="<?php echo set_value("espera",$viaje[0]->espera);?>" tabindex="11" onKeyUp="getTotal()"/>
    </div>
   </div>
   
    <div class="rowform">
      <div class="rowform-label"> 
        <label for="km"> <?php echo $this->lang->line("title_km")." $"; ?>  </label>
      </div>
      <div class="rowform-input">
        <input type="text" id="km" name="km" value="<?php echo set_value("km",$viaje[0]->km);?>" tabindex="12" onKeyUp="getTotal()"  />
      </div>
    </div>
    <div class="rowform">
      <div class="rowform-label"> 
        <label for="cantkm"> <?php echo $this->lang->line("title_cantkm"); ?>  </label>
      </div>
      <div class="rowform-input">
        <input type="text" id="cantkm" name="cantkm" value="<?php echo set_value("cantkm",$viaje[0]->cant_km);?>" tabindex="13" />
      </div>
    </div>
    
  
     
    <div class="rowform">
   <div class="rowform-label"> <label for="iva"> <?php echo $this->lang->line("title_iva")." $"; ?>  </label>
   </div>
    <div class="rowform-input">
    <input type="text" id="iva" name="iva" value="<?php echo set_value("iva",$viaje[0]->iva);?>" tabindex="14" onKeyUp="getTotal()"/>
    </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="mudanza"> - <?php echo $this->lang->line("title_mudanza")." $"; ?>  </label>
   </div>
    <div class="rowform-input">
    <input type="text" name="mudanza" readonly id="mudanza" value="<?php echo set_value("mudanza",$viaje[0]->mudanza);?>" tabindex="15" onKeyUp="getTotal()"/>
    </div>
   </div>
 
    <div class="rowform">
   <div class="rowform-label"> <label for="reservado"> <?php echo $this->lang->line("title_reserved_by"); ?>  </label>
   </div>
    <div class="rowform-text"><?php echo $viaje[0]->reservo;?></div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label for="despacho"> <?php echo $this->lang->line("title_despached_by"); ?>  </label>
   </div>
    <div class="rowform-text"><?php echo $viaje[0]->despacho;?></div>
   </div>
     <div class="rowform">
   <div class="rowform-label"> <label for="reserva"> <?php echo $this->lang->line("title_reserva_take"); ?>  </label>
   </div>
   <div class="rowform-text"> <?php 
    $year=substr($viaje[0]->fecha_reserva,0,4);
    $month=substr($viaje[0]->fecha_reserva,4,2);
    $day=substr($viaje[0]->fecha_reserva,6,2);
    $h=substr($viaje[0]->hora_reserva,0,2);
    $m=substr($viaje[0]->hora_reserva,2,2);
    echo "$day-$month-$year  a las $h:$m";?></div>
   </div>
   <?php  if ($viaje[0]->cerrado == 1) { ?>
     <div class="rowform">
   <div class="rowform-label"> <label for="cerrado_by"> <?php echo $this->lang->line("title_cerrado_by"); ?>  </label>
   </div>
    <div class="rowform-text"><?php echo $viaje[0]->cerrado_by;?></div>
   </div> 
   <?php } ?>
   </div>
   <div class="form_right">
  
  <div class="rowform">
   <div class="rowform-label"> <label for="peones"> <?php echo $this->lang->line("title_peones")." $"; ?>  </label>
   </div>
    <div class="rowform-input">
    <input type="text" name="peones" id="peones" value="<?php echo set_value("peones",$viaje[0]->peones);?>" tabindex="16" onKeyUp="getTotal()"/>
    </div>
   </div>
     <div class="rowform">
   <div class="rowform-label"> <label for="estacionamiento"> <?php echo $this->lang->line("title_estacionamiento")." $"; ?>  </label>
   </div>
    <div class="rowform-input">
    <input type="text" id="estacionamiento" name="estacionamiento" value="<?php echo set_value("estacionamiento",$viaje[0]->estacionamiento);?>" tabindex="17" onKeyUp="getTotal()"/>
    </div>
   </div>
  
  <div class="rowform">
   <div class="rowform-label"> <label for="peaje"> <?php echo $this->lang->line("title_peaje")." $"; ?>  </label>
   </div>
    <div class="rowform-input">
    <input type="text" id="peaje" name="peaje" value="<?php echo set_value("peaje",$viaje[0]->peaje);?>" tabindex="18" onKeyUp="getTotal()"/>
    </div>
   </div>
   
      <div class="rowform">
   <div class="rowform-label"> <label for="art"> <?php echo $this->lang->line("title_art"); ?>  </label>
   </div>
   <div class="rowform-text"> 
   <input type="text" readonly name="art" id="art" value="<?php echo $viaje[0]->art_valor;?>" /> 
   </div>
   </div>
   
   
   <div class="rowform">
      <div class="rowform-label"> 
        <label for="otro"> <?php echo $this->lang->line("title_otros")." $"; ?>  </label>
      </div>
      <div class="rowform-input">
        <input type="text" id="otro" name="otro" value="<?php echo set_value("otro",$viaje[0]->otros);?>" tabindex="19" onKeyUp="getTotal()"/>
      </div>
   </div>

   <div class="rowform">
      <div class="rowform-label"> 
        <label for="comisionar"> Fecha Comisionar </label>
      </div>
      <?php
         $dia=substr($viaje[0]->fecha_comisionar,6,2);
         $mes=substr($viaje[0]->fecha_comisionar,4,2);
         $year=substr($viaje[0]->fecha_comisionar,0,4);
         
  ?> 
      <div class="rowform-input">
        <input type="text" name="comisionar_day" id="comisionar_day" 
           size="2" maxlength="2" tabindex="22" 
          value="<?php echo set_value("comisionar_day",$dia);?>" />
        <input type="text" name="comisionar_month" id="comisionar_month" 
          tabindex="3" size="2" maxlength="23" 
          value="<?php echo set_value("comisionar_month",$mes);?>" />    
        <input type="text" name="comisionar_year" id="comisionar_year" 
          tabindex="4" size="4" maxlength="24" 
          value="<?php echo set_value("comisionar_year",$year);?>" />
        <span><?php echo $this->lang->line("fecha_formato");?></span>
      </div>
   </div>
   
   <?php if ($viaje[0]->forma_pago == 2) {?>
   <div class="rowform">
   <div class="rowform-label"> <label for="porcentaje_ctacte"> %<?php echo $this->lang->line("title_cta_cte"); ?> $ </label>
   </div>
    <div class="rowform-input">
    <input type="text" readonly="true" id="porcentaje_ctacte" name="porcentaje_ctacte" value="<?php echo set_value("porcentaje_ctacte",$viaje[0]->porcentaje_ctacte);?>" tabindex="20"/>
    <input type="hidden" name="comision_ctacte" id="comision_ctacte" value="<?php echo $comision->cta_cte; ?>">
    </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="voucher"> <?php echo $this->lang->line("title_voucher"); ?>  </label>
   </div>
    <div class="rowform-input">
    <input type="text" name="voucher" value="<?php echo set_value("voucher",$viaje[0]->voucher);?>" tabindex="21"/>
    </div>
   </div>
   <?php }?>
   </div>
   
  
  </form>
  
</div>

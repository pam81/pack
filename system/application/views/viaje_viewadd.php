<script>


//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#movil").focus();
  
  <?php if ($reserva[0]->show_banner) { ?>
  swal("<?php echo str_replace("\r\n", " ", $reserva[0]->banner); ?>");
    
  <?php } ?>
  
  <?php if($reserva[0]->art) { ?>
  
   swal("<?php echo "VIAJE CON ART: $".$reserva[0]->art_valor; ?>");
  <?php } ?>
  
 });

</script>



<div id="content">

 
   <div id="top-bar">
    <h2> <?php echo $this->lang->line("title_despachar_reserva");?></h2>
    </div>
   <hr class="separador">
   <div id="left_reserva"> 
  <form name="formusuario" method="post" action="<?php echo site_url()."viaje/nuevo";?>" onsubmit="return flete.validarViaje();">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
  <?php $this->flete->startPost();?>
    <div class="rowform">
   <div class="rowform-label"> <label for="telefono"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
   <div class="rowform-text"><?php echo $reserva[0]->phone; ?></div>
   <input type="hidden" name="clienteid" id="clienteid" value="<?php echo $reserva[0]->clienteid;?>"/>
   <input type="hidden" name="reservaid" id="reservaid" value="<?php echo $reserva[0]->id;?>"/>
   <input type="hidden" name="pago" id="pago" value="<?php echo $reserva[0]->forma_pago;?>"/>
   <input type="hidden" name="hpuerta" id="hpuerta" value="<?php echo $reserva[0]->hpuerta;?>"/>
   </div>

   <div class="rowform">
   <div class="rowform-label"> <label for="name"> <?php echo $this->lang->line("title_name"); ?>  </label>
   </div>
   <div class="rowform-text"><?php echo $reserva[0]->name;?></div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="desde"> <?php echo $this->lang->line("title_desde"); ?>  </label>
   </div>
   
   <div class="rowform-text">
   <?php echo $reserva[0]->desde;?>
   <input type="hidden"  name="desde" id="desde" value="<?php echo $reserva[0]->desde;?>" />
   <input type="button" name="udesde" id="udesde" value="Ubicar" onclick="flete.showLugar('<?php echo base_url()."mapa.php";?>','desde');"/>
   </div>
   </div>
   
     <div class="rowform">
   <div class="rowform-label"> <label for="presupuesto"> <?php echo $this->lang->line("title_presupuesto_aprox")."$ "; ?>  </label>
   </div>
   
   
   <div class="rowform-text">
   <?php echo $reserva[0]->presupuesto_aprox;?>
   </div>
   </div>
   
     <div class="rowform">
   <div class="rowform-label"> <label > <?php echo $this->lang->line("title_valor_mercaderia"); ?>  </label>
   </div>
   
   
   <div class="rowform-text">
   <?php echo $reserva[0]->valor_mercaderia;?>
   </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label > <?php echo $this->lang->line("title_excedente_mercaderia"); ?>  </label>
   </div>
   
   
   <div class="rowform-text">
   <?php echo $reserva[0]->mercaderia_excedente;?>
   </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label > <?php echo $this->lang->line("title_excedente_monto"); ?>  </label>
   </div>
   
   
   <div class="rowform-text">
   <?php echo $reserva[0]->monto_excedente;?>
   </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label > <?php echo $this->lang->line("title_excedente_codigo"); ?>  </label>
   </div>
   
   
   <div class="rowform-text">
   <?php echo $reserva[0]->codigo_excedente;?>
   </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label > <?php echo $this->lang->line("title_art"); ?>  </label>
   </div>
   
   
   <div class="rowform-text">
   <?php echo $reserva[0]->art_valor;?>
   </div>
   </div>
   
   
   
   <div class="rowform">
   <div class="rowform-label"> <label for="destino"> <?php echo $this->lang->line("title_hasta"); ?>  </label>
   </div>
  <div class="rowform-text">
   <?php echo $reserva[0]->destino;?>
   <input type="hidden" name="destino" id="destino" value="<?php echo $reserva[0]->destino;?>" />
   <input type="button" name="udesde" id="udesde" value="Ubicar" onclick="flete.showLugar('<?php echo base_url()."mapa.php";?>','destino');"/>
   <input type="button" name="ruta" id="ruta" value="Calcular ruta" onclick="flete.showRuta('<?php echo base_url()."ruta.php";?>')" />
  </div>
   </div>
   
  <div class="rowform">
   <div class="rowform-label"> <label for="destino"> <?php echo $this->lang->line("title_categoria"); ?>  </label>
   </div>
  <div class="rowform-text">
   <?php echo $reserva[0]->categoria;?>
  </div>
   </div>
 
   
     <div class="rowform">
   <div class="rowform-label"> <label for="movil"> <?php echo $this->lang->line("title_movil"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" name="movil" id="movil" value="<?php echo set_value("movil");?>" tabindex="1" onblur="flete.getMovil('<?php echo site_url()."chofer/getInfo/";?>');" />
  </div>
  </div>
   
    <div class="rowform rowempty">
    <div class="rowform-label">
    <label for="marca"> <?php echo $this->lang->line("title_lmarca"); ?>  </label>
    </div>
     <div id="marca"> </div>
    </div> 
    
    <div class="rowform rowempty">
    <div class="rowform-label"><label for="chofer"> <?php echo $this->lang->line("title_chofer"); ?>  </label>
    </div>
       <div  id="chofer"> </div> 
   </div>
    
     <div class="rowform">
   <div class="rowform-label"> <label for="observacion"> <?php echo $this->lang->line("title_observacion"); ?>  </label>
   </div>
   <div class="rowform-input">
   <textarea name="observacion" id="observacion" rows="3" cols="40" tabindex="2" rows="4" cols="15"><?php echo set_value("observacion",$reserva[0]->observaciones);?></textarea>
   </div>
   </div>
    
    <div class="rowform">
   <div class="rowform-label"> <label for="hora"> <?php echo $this->lang->line("title_hora_alarma"); ?>  </label>
   </div>
     <div  id="hora"><?php echo substr($reserva[0]->hsalida,0,2).":".substr($reserva[0]->hsalida,2,2);?> </div>
      
   </div>
    
    
      <div class="rowform">
   <div class="rowform-label"> <label for="hora"> <?php echo $this->lang->line("title_ask_hour"); ?>  </label>
   </div>
     <div  id="hora"><?php echo substr($reserva[0]->hpuerta,0,2).":".substr($reserva[0]->hpuerta,2,2);?> </div>
      
   </div>
    
   <div class="rowform">
    <div class="rowform-label"> 
        <label for="aprox_hour"> <?php echo $this->lang->line("title_hora_llegada_aprox"); ?>  </label>
    </div>
    <div class="rowform-input">
    
    <input type="aprox_hour" id="aprox_hour" tabindex="3" value="<?php echo set_value("aprox_hour",00);?>" size="2"/>
    :
    <input type="aprox_min" id="aprox_min" tabindex="4" value="<?php echo set_value("aprox_min",00);?>" size="2"/>
      
    </div>
   </div>
   <div class="rowform">
    <div class="rowform-label">
      <label>Código Asignar Movil</label>
    </div>
    <div class="rowform-input">
    <input type="text" name="passmovil" value="">
    </div>
   </div>
   
  
  
  
   <div class="rowform">
   <input type="submit" tabindex="5" id="send" accesskey="e" name="send" value="<?php echo $this->lang->line("button_send");?>" onclick="return confirm('<?php echo $this->lang->line("ask_despachar_viaje");?>'); " />
    <input type="reset" tabindex="6"  id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
   </div>
  </form>
  </div>
  <div  id="right_reserva">
   <div> <?php echo $this->lang->line("title_fecha").": ".substr($reserva[0]->fecha,6,2)."-".substr($reserva[0]->fecha,4,2)."-".substr($reserva[0]->fecha,0,4);?> </div>
   <div id="nro_reserva"> <?php echo $this->lang->line("nro_reserva").": ".$reserva[0]->id;?> </div>
   
  <div id="nro_viaje"> <?php  if ($reserva[0]->forma_pago == 1)echo $this->lang->line("pago_efvo"); else echo $this->lang->line("pago_ctacte");?> </div>
  <div ><?php echo $this->lang->line("title_reserved_by")." ".$reserva[0]->reservo; ?> </div>
  </div>
</div>

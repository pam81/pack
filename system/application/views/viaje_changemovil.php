<script>
//al entrar pongo foco en primer campo

$(document).ready(function(){
  $("#movil").focus();
 });

</script>




<div id="content">

 
   <div id="top-bar">
    <h2 > <?php echo $this->lang->line("title_mod_viaje");?></h2>
    
    </div>
   <hr class="separador">
  <form name="formusuario" method="post" action="<?php   echo site_url()."viaje/updatemovil/".$viaje[0]->id; ?>">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
   <div id="form_left">
   <div class="rowform">
   <div class="rowform-label"> <label for="fecha"> <?php echo $this->lang->line("title_fecha"); ?>  </label>
   </div>
   <div class="rowform-text">
    <?php 
    $year=substr($viaje[0]->fecha,0,4);
    $month=substr($viaje[0]->fecha,4,2);
    $day=substr($viaje[0]->fecha,6,2);
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
   <div class="rowform-text"> <?php echo $viaje[0]->desde;?> </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label for="hasta"> <?php echo $this->lang->line("title_hasta"); ?>  </label>
   </div>
   <div class="rowform-text"> <?php echo $viaje[0]->destino;?> </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="movil"> <?php echo $this->lang->line("title_movil"); ?>  </label>
   </div>
   <div class="rowform-text"><input type="text" value="<?php echo $viaje[0]->movil;?>" name="movil" id="movil" onblur="flete.getMovil('<?php echo site_url()."chofer/getInfo/";?>');" /></div>
    
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="marca"> <?php echo $this->lang->line("title_marca"); ?>  </label>
   </div>
   <div id="marca" class="rowform-text"><?php echo $viaje[0]->marca;?></div>
    
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="chofer"> <?php echo $this->lang->line("title_chofer"); ?>  </label>
   </div>
   <div id="chofer" class="rowform-text"> <?php echo $viaje[0]->name." ".$viaje[0]->lastname;?> </div>
    
   </div>
     <div class="rowform">
   <div class="rowform-label"> <label for="presupuesto"> <?php echo $this->lang->line("title_presupuesto_aprox"); ?>  </label>
   </div>
   <div class="rowform-text"> <?php echo "$".$viaje[0]->presupuesto_aprox;?> </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="observacion"> <?php echo $this->lang->line("title_observacion"); ?>  </label>
   </div>
    <div class="rowform-input"> 
    <textarea name="observacion" tabindex="9"><?php echo set_value("observacion",$viaje[0]->observaciones);?></textarea> 
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
   
   </div>
   <div id="form_rigth">
     
   
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
  
 

   
   </div> <!-- rigth-->
   
  
  
   
   
   <div class="rowform-button">
    <input type="submit" tabindex="18" id="changemovil"  name="changemovil" value="<?php echo $this->lang->line("button_changemovil");?>" onclick="return confirm('<?php echo $this->lang->line("ask_change_movil");?>') " />  
    <input type="reset" tabindex="19" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
   </div>

  </form>
  
</div>

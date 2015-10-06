<div id="content">

 
   <div id="top-bar">
    <h2> <?php echo "Reserva";?></h2>
    </div>
   <hr class="separador">
   <div id="left_reserva"> 
  
  
  
    <div class="rowform">
   <div class="rowform-label"> <label for="telefono"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
   <div class="rowform-input">
   <?php echo $reserva[0]->phone;?>
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
   <?php echo $dia;?>-
   <?php echo $mes;?>-    
   <?php echo $year;?>
  
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
   
    <?php echo $h;?>
   
   :
   <?php echo $m;?>
   
   
     
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
   <?php echo $h;?>
   
   :
   <?php echo $m;?>
   
   </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="name"> <?php echo $this->lang->line("title_name"); ?>  </label>
   </div>
   <div class="rowform-input">
   <?php echo $reserva[0]->name;?>
   </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="desde"> <?php echo $this->lang->line("title_desde"); ?>  </label>
   </div>
   <div class="rowform-input">
   <?php echo $reserva[0]->desde;?>
   </div>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="destino"> <?php echo $this->lang->line("title_hasta"); ?>  </label>
   </div>
   <div class="rowform-input">
   <?php echo $reserva[0]->destino;?>
   </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label for="presupuesto"> <?php echo $this->lang->line("title_presupuesto_aprox"); ?>  </label>
   </div>
   <div class="rowform-input">
   <?php echo $reserva[0]->presupuesto_aprox;?>
   </div>
   </div>
   
  
   
   <div class="rowform">
   <div class="rowform-label"> <label for="observacion"> <?php echo $this->lang->line("title_observacion"); ?>  </label>
   </div>
   <div class="rowform-input">
   <?php echo $reserva[0]->observaciones;?>
   </div>
   </div>
   <!--
   <div class="rowform">
   <div class="rowform-label"> <label for="valor_mercaderia"> <?php echo $this->lang->line("title_valor_mercaderia"); ?>  </label>
   </div>
   <div class="rowform-input">
   <?php echo $reserva[0]->valor_mercaderia;?>
   </div>
   </div>
  
  <div class="rowform">
   <div class="rowform-label"> <label for="excedente_mercaderia"> <?php echo $this->lang->line("title_excedente_mercaderia"); ?>  </label>
   </div>
   <div class="rowform-input">
   <?php echo $reserva[0]->mercaderia_excedente;?>
   </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label for="excedente_monto"> <?php echo $this->lang->line("title_excedente_monto"); ?>  </label>
   </div>
   <div class="rowform-input">
   <?php echo $reserva[0]->monto_excedente;?>
   </div>
   </div>
   
    <div class="rowform">
   <div class="rowform-label"> <label for="excedente_codigo"> <?php echo $this->lang->line("title_excedente_codigo"); ?>  </label>
   </div>
   <div class="rowform-input">
   <?php echo $reserva[0]->codigo_excedente;?>
   </div>
   </div>
     -->
  
   <div class="rowform">
   <div class="rowform-label"> <label for="categoria"> <?php echo $this->lang->line("title_categoria"); ?>  </label>
   </div>
    <div class="rowform-input">
    
     <?php 
      foreach($categorias as $c)
      {
        
        if ($c->id == $reserva[0]->categoriaid)
             echo $c->name;
      }
       
     ?>
    
    </div>
   </div>
  <?php if ($reserva[0]->forma_pago == 1) { ?>
  <div class="rowform">
   <div class="rowform-label"> <label > <?php echo $this->lang->line("title_contado"); ?>  </label>
   </div>
  </div>

<?php 
   }
if ($reserva[0]->forma_pago == 2) { ?>
  <div class="rowform">
   <div class="rowform-label"> <label > <?php echo $this->lang->line("title_ctacte"); ?>  </label>
   </div>
  </div>
  <?php } ?> 
  
  <div class="rowform">
   <div class="rowform-label"> <label for="motivo"> <?php echo $this->lang->line("title_causa_cancelado"); ?>  </label>
   </div>
   <div class="rowform-input">
   <?php echo $reserva[0]->causa_cancel;?>
   </div>
   </div>
  
  <div class="rowform">
   <div class="rowform-label"> <label > <?php echo $this->lang->line("title_cancel_by"); ?>  </label>
   </div>
   <div class="rowform-input">
   <?php echo $reserva[0]->cancelo;?>
   </div>
   </div>
  
  
  </div>
  <div  id="right_reserva">
  <div id="nro_reserva"><?php echo $this->lang->line("nro_reserva").": ".$reserva[0]->id;?> </div>
  <div id="info_ctacte"> <?php if($reserva[0]->ctacte == "s") echo $this->lang->line("ctacte_habilitada"); else echo $this->lang->line("solo_efectivo");?></div>
  <div id="observaciones"><?php echo $reserva[0]->cobser; ?> </div>
  <div id="mensaje"><?php echo $reserva[0]->mensaje; ?> </div>
  <div ><?php echo $this->lang->line("title_reserved_by")." ".$reserva[0]->reservo; ?> </div>
  </div>
</div>

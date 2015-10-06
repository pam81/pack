<script>
window.onload=doLoad();

</script>

  <script type="text/javascript">
	jQuery.tableNavigation();
</script>
<div id="content">

  <div id="panel_viajes">
   <table id="tableviaje" class="tablelist navigateable" cellspacing="0" cellpadding="0">
    <thead>
    <tr>
    <th width="40"><?php echo mb_convert_case($this->lang->line("title_movil"),MB_CASE_UPPER,"UTF-8");?> </th>
    <th width="50"><?php echo mb_convert_case($this->lang->line("title_h_puerta"),MB_CASE_UPPER,"UTF-8");?> </th>
    <th width="50"><?php echo mb_convert_case($this->lang->line("title_h_abordo"),MB_CASE_UPPER,"UTF-8");?> </th>
    <th width="200"><?php echo mb_convert_case($this->lang->line("title_desde"),MB_CASE_UPPER,"UTF-8");?> </th>
    <th width="200"><?php echo mb_convert_case($this->lang->line("title_hasta"),MB_CASE_UPPER,"UTF-8");?> </th>
    <th width="200"><?php echo mb_convert_case($this->lang->line("title_observacion"),MB_CASE_UPPER,"UTF-8");?> </th>
    <th width="30"><?php echo mb_convert_case($this->lang->line("title_mod"),MB_CASE_UPPER,"UTF-8");?> </th>
    <th width="40"><?php echo mb_convert_case($this->lang->line("title_cancelar"),MB_CASE_UPPER,"UTF-8");?> </th>
    <th width="25"> <?php echo mb_convert_case($this->lang->line("title_bloqueado"),MB_CASE_UPPER,"UTF-8");?> </th>
    </tr>
    </thead>
    <tbody>
      <?php foreach($viajes as $v) {?>
        <tr class="modotr">
         <td> <?php echo $v->movil; ?> </td>
         <td> <?php 
          $h=substr($v->hexacta_puerta,0,2);
          $m=substr($v->hexacta_puerta,2,2);
         echo "$h:$m"; ?> </td>
         <td> <?php 
         $h=substr($v->habordo,0,2);
          $m=substr($v->habordo,2,2);
         echo "$h:$m"; ?> </td>
         <td> <?php echo mb_substr($v->desde,0,20); ?> </td>
         <td> <?php echo mb_substr($v->destino,0,20); ?> </td>
         <td> 
         <?php 
            if ($v->regresando == 1)
              echo mb_substr($this->lang->line("title_regresando_desde")." ".$v->regresando_desde,0,30);
            else   
              echo mb_substr($v->observaciones,0,20); ?> 
         </td>
         <td> 
         <?php 
           
            if($v->cerrado == 0){?>
               <a href="<?php echo site_url()."viaje/mod/$v->id/".$this->uri->segment(3);?>" class="activation"> <img src="<?php echo base_url()."images/img/edit-icon.gif";?>" width="16" height="16" alt="modificar" title="modificar" /> </a> 
  <?php } else { 
             echo "<a href=\"".site_url()."viaje/retornaBase/$v->id\" class=\"activation\"><img src=\"".base_url()."images/cerrado.jpg\" width=\"30\" height=\"16\" title=\"cerrado\" alt=\"cerrado\" /></a>";    }
             
             ?>
          </td>
           <td>
         <?php if($v->cancelado == 0 && $v->cerrado == 0){?>
          <a href="<?php echo site_url()."viaje/cancelar/$v->id";?>" onclick=" return confirm('<?php echo $this->lang->line("ask_cancel_viaje");?>') ;" > <img src="<?php echo base_url()."images/img/hr.gif";?>" width="16" height="16" alt="borrar"  title="cancelar"/> </a> 
          <?php } else
            if ($v->cerrado == 1)
              echo "<img src=\"".base_url()."images/cerrado.jpg\" width=\"40\" height=\"16\" alt=\"cerrado\" />";
            else  
               echo "cancelado";?>
         </td> 
           <td>
           <?php if ($v->bloqueado == 1){ ?>
           <a href="<?php echo site_url()."viaje/unlock/$v->id";?>" onclick=" return confirm('<?php echo $this->lang->line("ask_debloquear_viaje");?>') ;" > <img src="<?php echo base_url()."images/img/lock.png";?>" width="16" height="16" alt="bloqueado" title="bloqueado por <?php echo $v->bloqueado_by;?>" /> </a>
           <?php }?>
         </td>
         </tr>
      <?php }?>     
    </tbody>
   </table>
  
  </div>

  

  <div id="panel_bottom">
  <div id="panel_base">

<div id="navigation">
    <ul class="top-level">
       <?php foreach($bases as $b) 
          {  echo "<li> <a href=\"#\">".mb_substr($b->name,0,15)." </a> ";
           echo "<ul class=\"sub-level\"> <li>";
                foreach($moviles as $m)
                {
                  if ($m->baseid == $b->id) 
                  echo "  $m->movil  ";
                  
                }
           echo "</li> </ul> </li>";     
          } 
           
       ?>   
       
     </ul>   
  </div> 
  
  
  </div>
  <div id="panel_reserva">
  <table  class="tablelistpanel navigateable" cellspacing="0" cellpadding="0" >
   <thead>
    <tr>
       <th width="40"> <?php echo mb_convert_case($this->lang->line("title_hora_salida"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="40"> <?php echo mb_convert_case($this->lang->line("title_puerta"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="200"> <?php echo mb_convert_case($this->lang->line("title_desde"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="200"> <?php echo mb_convert_case($this->lang->line("title_hasta"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="175"> <?php echo mb_convert_case($this->lang->line("title_observacion"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="40"> <?php echo mb_convert_case($this->lang->line("title_movil"),MB_CASE_UPPER,"UTF-8");?> </th>
          <th width="25"> <?php echo mb_convert_case($this->lang->line("title_despachar"),MB_CASE_UPPER,"UTF-8");?> </th>
          <th width="25"> <?php echo mb_convert_case($this->lang->line("title_bloqueado"),MB_CASE_UPPER,"UTF-8");?> </th>
    </tr>    
   </thead>
   <tbody>
     <?php 
          
         foreach($reservas as $u) {?>
       <tr class="modotr 
       <?php   
          $year=substr($u->fecha,0,4);
          $mes=substr($u->fecha,4,2);
          $dia=substr($u->fecha,6,2);
          $today=date("Ymd");
          
       if ($u->cancelado==1) 
                   echo "borrado";
               else{
               if ($u->despachado == 0){
               //las reservas de hoy se ponen en verde
                 if ( ($u->hsalida-15) > date("Hi") && $today == $u->fecha)
                   echo "green";
               //15 minutos antes de la hora de alarma
                  if ( ($u->hsalida - 15) <= date("Hi") && date("Hi") < $u->hsalida && $today == $u->fecha)
                   echo "green2";   
               //si paso la alarma se pone en rojo
                    
                 if ( $today == $u->fecha && $u->hsalida <= date("Hi") && $u->hpuerta > date("Hi") )
                    echo "red";  
               //si paso la hora en puerta se pone en negro
                 if ( $today == $u->fecha && $u->hpuerta <= date("Hi")  )
                    echo "incumplido";   
                }
               }    
       
       ?>   
       
       ">
       <td> <?php 
         $h=substr($u->hsalida,0,2);
         $m=substr($u->hsalida,2,2);
         echo $h.":".$m;
       ?></td>
        
         <td> <?php 
         $h=substr($u->hpuerta,0,2);
         $m=substr($u->hpuerta,2,2);
         echo $h.":".$m;?></td>
        
      
         <td> <?php echo mb_substr($u->desde,0,20);?>  </td>
         <td> <?php echo mb_substr($u->destino,0,20); ?> </td>
         <td> <?php echo mb_substr($u->observaciones,0,20);?> </td>
         <td> </td>
         <td> <a href="<?php echo site_url()."viaje/despachar/$u->id";?>" class="activation" > <img src="<?php echo base_url()."images/img/camion4.jpg";?>" width="20" height="20" alt="despachar" title="despachar" /> </a></td>
         <td>
           <?php if ($u->bloqueado == 1){ ?>
           <a href="<?php echo site_url()."reserva/unlock/$u->id";?>" onclick=" return confirm('<?php echo $this->lang->line("ask_debloquear_reserva");?>') ;" > <img src="<?php echo base_url()."images/img/lock.png";?>" width="16" height="16" alt="bloqueado" title="bloqueado por <?php echo $u->bloqueado_by;?>" /> </a>
           <?php }?>
         </td>
                      
       </tr>
     <?php   }?>
   </tbody>
  </table>
  </div>
  </div>
</div>

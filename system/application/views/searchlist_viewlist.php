
<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("title_list_viaje");?></h2>
  
  </div>
   <hr class="separador">
    
   <script type="text/javascript">
	jQuery.tableNavigation();
</script>
  <table  class="tablelist navigateable myTable02"  >
   <thead>
    <tr>
        <th width="45"> <?php echo mb_convert_case($this->lang->line("title_fecha"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="50"> <?php echo mb_convert_case($this->lang->line("title_cliente"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="30"> <?php echo mb_convert_case($this->lang->line("title_movil"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="150"> <?php echo mb_convert_case($this->lang->line("title_desde"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="150"> <?php echo mb_convert_case($this->lang->line("title_hasta"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="150"> <?php echo mb_convert_case($this->lang->line("title_observacion"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="50"> <?php echo mb_convert_case($this->lang->line("title_contado"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="50"> <?php echo mb_convert_case($this->lang->line("title_ctacte"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="50"> <?php echo mb_convert_case("seguro",MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="25"> <?php echo mb_convert_case($this->lang->line("title_mod"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="30"> <?php echo mb_convert_case($this->lang->line("title_cancelar"),MB_CASE_UPPER,"UTF-8");?> </th>
           <th width="25"> <?php echo mb_convert_case($this->lang->line("title_bloqueado"),MB_CASE_UPPER,"UTF-8");?> </th>
        
    </tr>    
   </thead>
   <tbody>
     <?php 
         foreach($viajes as $u) {?>
       <tr class="modotr">
      
         <td> <?php 
         $year=substr($u->fecha_despacho,0,4);
         $year=substr($year,2,2);
          $mes=substr($u->fecha_despacho,4,2);
          $dia=substr($u->fecha_despacho,6,2);
          $today=date("Ymd");
          
         echo $dia."-".$mes."-".$year;?> </td>
         <td> <?php echo $u->cliente;?></td>
         <td> <?php echo $u->movil;?></td>
         
         
         <td> <?php echo mb_substr($u->desde,0,30);?> </td>
         <td> <?php echo mb_substr($u->destino,0,30); ?> </td>
         <td> <?php echo mb_substr($u->observaciones,0,30);?> </td>
         <td> <?php if ($u->forma_pago == 1) { echo $u->valor; }?> </td>
         <td> <?php if ($u->forma_pago == 2) { echo $u->valor;  }?> </td>
         <td> <?php echo $u->codigo_excedente;  ?> </td>                   
         <td> 
         
         <a href="<?php echo site_url()."viaje/visualiza/$u->id/".$this->uri->segment(3);?>"  class="activation"> <img src="<?php echo base_url()."images/img/edit-icon.gif";?>" width="16" height="16" alt="modificar" title="modificar" /> </a> 
         
         </td>
         <td>
         <?php if($u->cancelado == 0 && $u->cerrado == 0){?>
          <a href="<?php echo site_url()."viaje/cancelar/$u->id/".$this->uri->segment(3);?>" onclick=" return confirm('<?php echo $this->lang->line("ask_cancel_viaje");?>') ;" > <img src="<?php echo base_url()."images/img/hr.gif";?>" width="16" height="16" alt="borrar" title="cancelar" /> </a> 
          <?php } else
            if ($u->cerrado == 1)
              echo "cerrado";
            else  
               echo "<img src=\"".base_url()."images/img/resta.png\" width=\"16\" height=\"16\" title=\"cancelado\" />";?>
         </td> 
          <td>
           <?php if ($u->bloqueado == 1){ ?>
           <a href="<?php echo site_url()."viaje/unlock/$u->id/".$this->uri->segment(3);?>" onclick=" return confirm('<?php echo $this->lang->line("ask_debloquear_viaje");?>') ;" > <img src="<?php echo base_url()."images/img/lock.png";?>" width="16" height="16" alt="bloqueado" title="bloqueado por <?php echo $u->bloqueado_by;?>" /> </a>
           <?php }?>
          </td>            
       </tr>
     <?php   }?>
   </tbody>
  </table>
  
  <div class="link_pages pagination">
					<?php echo $this->pagination->create_links(); ?>
	</div>
</div>

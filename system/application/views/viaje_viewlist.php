<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
    
    

    if (code.toString() == 66 && e.altKey ) //alt+b buscar viaje
       $("#searchfield").focus();               
    
});



function searching(e)
{
  var tecla = (document.all) ? e.keyCode : e.which;
  if (tecla.toString() == 13)
    $("#searchfield").focus();
}

</script>






<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("title_list_viaje");?></h2>
  
  </div>
   <hr class="separador">
    <div class="select-bar">
		 <form name="formsearch" id="formsearch" method="post" action="<?php echo site_url()."viaje/index";?>" onsubmit="return flete.validarSearch(3);">  
        <label> <?php echo mb_convert_case($this->lang->line("title_movil"),MB_CASE_TITLE,"utf-8");?>
		    <input size="10"  type="text" tabindex="1" name="searchfield" id="searchfield" value="<?php if (isset($movil)) echo $movil; else echo 0;?>" onkeypress="searching(event); " />
		    </label>
		   
        <label> <?php echo "Código";?>
		    <input size="10" type="text" tabindex="11" name="code" id="code" value="<?php if (isset($code)) echo set_value("code",$code); ?>"  />
		    </label>
       <label>
			<input type="checkbox" tabindex="12" name="checkart" value="1" <?php if (isset($art) && $art) echo "checked";?> />
			<?php echo "ART";?>
			</label>
			  <label> <?php echo mb_convert_case($this->lang->line("title_fecha_desde"),MB_CASE_TITLE,"utf-8");?>
		   
		   <?php 
       $dia=date("d");
        if (isset($fdesde)){
           $dia=substr($fdesde,6,2);
        }
        
        $mes=date("m");
        if (isset($fdesde))
        {
         $mes=substr($fdesde,4,2);
        }
        $year=date("Y");
        if (isset($fdesde)) 
         $year=substr($fdesde,0,4);
        
       ?>
		   
		   <input type="text" name="desde_day" id="desde_day" tabindex="2" size="2" maxsize="2" value="<?php echo set_value("desde_day",$dia);?>" />
       <input type="text" name="desde_month" id="desde_month" tabindex="3" size="2" maxsize="2" value="<?php echo set_value("desde_month",$mes);?>" />    
       <input type="text" name="desde_year" id="desde_year" tabindex="4" size="4" maxsize="4" value="<?php echo set_value("desde_year",$year);?>" />
	
		    </label>
		  
        <label> <?php echo mb_convert_case($this->lang->line("title_fecha_hasta"),MB_CASE_TITLE,"utf-8");?>
		    <?php 
         $dia=date("d");
        if (isset($fhasta)){
           $dia=substr($fhasta,6,2);
        }
        
        $mes=date("m");
        if (isset($fhasta))
        {
         $mes=substr($fhasta,4,2);
        }
        $year=date("Y");
        if (isset($fhasta)) 
         $year=substr($fhasta,0,4);
        
        ?>
        
         <input type="text" name="hasta_day" id="hasta_day" tabindex="5" size="2" maxsize="2" value="<?php echo set_value("hasta_day",$dia);?>" />
       <input type="text" name="hasta_month" id="hasta_month" tabindex="6" size="2" maxsize="2" value="<?php echo set_value("hasta_month",$mes);?>" />    
       <input type="text" name="hasta_year" id="hasta_year" tabindex="7" size="4" maxsize="4" value="<?php echo set_value("hasta_year",$year);?>" />
	
		    </label>
		  
		  <label>
		  
			<input type="checkbox" tabindex="8" name="checkcancel" value="1" <?php if (isset($cancelado) && $cancelado) echo "checked";?> />
			<?php echo $this->lang->line("title_cancelado");?>
			</label>
		  
			<label>
			<input type="submit" tabindex="9" name="search" value="<?php echo $this->lang->line("button_search");?>" />
			</label>
		</form>	
		  </div>
   <script type="text/javascript">
	jQuery.tableNavigation();
</script>
  <table  class="tablelist navigateable myTable02"  >
   <thead>
    <tr>
        <th width="45"> <?php echo mb_convert_case($this->lang->line("title_fecha"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="30"> <?php echo mb_convert_case($this->lang->line("title_movil"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="150"> <?php echo mb_convert_case($this->lang->line("title_desde"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="150"> <?php echo mb_convert_case($this->lang->line("title_hasta"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="150"> <?php echo mb_convert_case($this->lang->line("title_observacion"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="50"> <?php echo mb_convert_case($this->lang->line("title_contado"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="50"> <?php echo mb_convert_case($this->lang->line("title_ctacte"),MB_CASE_UPPER,"UTF-8");?> </th>
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
         
         <td> <?php echo $u->movil;?></td>
         
         <?php $total= $u->valor + $u->espera + $u->peones + $u->km +
            $u->estacionamiento + $u->peaje + $u->art_valor + $u->otros + $u->iva;
            $total_ctacte = $total + $u->porcentaje_ctacte;
             ?>
         <td> <?php echo mb_substr($u->desde,0,30);?> </td>
         <td> <?php echo mb_substr($u->destino,0,30); ?> </td>
         <td> <?php echo mb_substr($u->observaciones,0,30);?> </td>
         <td> <?php if ($u->forma_pago == 1) { echo $total; }?> </td>
         <td> <?php if ($u->forma_pago == 2) { echo $total_ctacte;  }?> </td>          
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
           <a class="desbloquea" data-url="<?php echo site_url()."viaje/unlock/$u->id/".$this->uri->segment(3);?>" onclick=" return confirm('<?php echo $this->lang->line("ask_debloquear_viaje");?>') ;" > <img src="<?php echo base_url()."images/img/lock.png";?>" width="16" height="16" alt="bloqueado" title="bloqueado por <?php echo $u->bloqueado_by;?>" /> </a>
           <?php }?>
          </td>            
       </tr>
     <?php   }?>
   </tbody>
  </table>
  
  <div class="link_pages">
					<?php echo $this->pagination->create_links(); ?>
	</div>
</div>

<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
  if (code.toString() == 80 && e.altKey ) //alt+p pdf
       document.location.href='<?php echo site_url()."reporte/pdfreca/$opciones";?>';
  
  if(code.toString() == 78 && e.altKey)  //alt + n accesar viaje por numero
       flete.findViaje('<?php echo site_url()."viaje/visualiza/";?>'); 
       
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
		 <form name="formsearch" id="formsearch" method="post" action="<?php echo site_url()."reporte/recaudacion";?>" onsubmit="return flete.validarSearch(3);">  
        <label> <?php echo mb_convert_case($this->lang->line("title_movil"),MB_CASE_TITLE,"utf-8");?>
		    <input type="text" tabindex="1" name="movil" id="searchfield" value="<?php if (isset($movil)) echo $movil;?>" onkeypress="searching(event); " />
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
			<input type="submit" tabindex="4" name="search" value="<?php echo $this->lang->line("button_search");?>" />
			</label>
		</form>	
		  </div>
   <script type="text/javascript">
	     jQuery.tableNavigation();      
    </script>
  <table  class="tablelist navigateable myTable02 tableReporte"  >
   <thead>
    <tr><th> <?php echo $this->lang->line("nro_viaje");?> </th>
        <th> <?php echo $this->lang->line("title_fecha");?> </th>
        <th> <?php echo $this->lang->line("title_movil");?> </th>
        <th> <?php echo $this->lang->line("title_cliente");?> </th>
        <th> <?php echo $this->lang->line("title_desde");?> </th>
        <th> <?php echo $this->lang->line("title_hasta");?> </th>
       <th> <?php echo substr($this->lang->line("title_contado"),0,4);?> </th>
       <th> <?php echo $this->lang->line("title_voucher");?> </th>
       <th> <?php echo $this->lang->line("title_ctacte");?> </th>
        <th> <?php echo $this->lang->line("title_peones");?> </th>
        <th> <?php echo $this->lang->line("title_km");?> </th>
        <th> <?php echo $this->lang->line("title_espera");?> </th>
        <th> <?php echo $this->lang->line("title_peaje");?> </th>
        <th> <?php echo $this->lang->line("estacionamiento_short");?> </th>
        <th> <?php echo $this->lang->line("title_otros");?> </th>
        <th> <?php echo $this->lang->line("title_seguro");?> </th>
       <th> <?php echo $this->lang->line("title_art");?> </th>
       <th> <?php echo substr($this->lang->line("title_mudanza"),0,4);?></th>
       
       <th>% <?php echo $this->lang->line("title_ctacte");?></th>
       <th><?php echo $this->lang->line("title_iva");?></th>
        <th> <?php echo $this->lang->line("title_cancelar");?> </th>
        
    </tr>    
   </thead>
   <tbody>
     <?php 
      $anulados=0;
      $totalviajes=count($viajes);
      $efvo=0;
      $ctacte=0;
      $peones=0;
      $espera=0;
      $peaje=0;
      $estacionamiento=0;
      $otros=0;
      $seguro=0;
      $art=0;
      $mudanza=0;
      $km=0;
     
      $porcentaje_ctacte=0;
      $iva=0;
         foreach($viajes as $u) {
         
         if ($u->cancelado == 1)
             $anulados++;
         
         ?>
         
         
       <tr class="modotr">
         <td> <a href="<?php echo site_url()."viaje/visualiza/$u->id/".$this->uri->segment(3);?>"  class="activation">  <?php  echo $u->id; ?> </a>  </td>
         <td> <?php 
         $year=substr($u->fecha_despacho,0,4);
          $mes=substr($u->fecha_despacho,4,2);
          $dia=substr($u->fecha_despacho,6,2);
          $today=date("Ymd");
          
         echo $dia."-".$mes."-".$year;?> </td>
         
         <td> <?php echo $u->movil;?></td>
         <td> <?php echo $u->cliente;?></td>
         
         <td> <?php echo $u->desde;?> </td>
         <td> <?php echo $u->destino; ?> </td>
         
         <td> <?php if ($u->forma_pago == 1) { echo number_format($u->valor,2,".",''); $efvo += $u->valor;}?> </td>
         
          <td> <?php echo $u->voucher;?> </td>
         <td> <?php if ($u->forma_pago == 2) { echo number_format($u->valor,2,".",''); $ctacte += $u->valor; }?> </td>          
         
         <td> <?php echo number_format($u->peones,2,".",''); $peones +=$u->peones; ?>  </td>
         <td> <?php echo number_format($u->km,2,".",''); $km +=$u->km; ?>  </td>
         
          <td> <?php echo number_format($u->espera,2,".",''); $espera +=$u->espera; ?>  </td>
          <td> <?php echo number_format($u->peaje,2,".",''); $peaje +=$u->peaje; ?>  </td>
          <td> <?php echo number_format($u->estacionamiento,2,".",''); $estacionamiento +=$u->estacionamiento; ?>  </td>
          <td> <?php echo number_format($u->otros,2,".",''); $otros +=$u->otros; ?>  </td>
          <td> <?php if ($u->monto_excedente != NULL ) { echo number_format($u->monto_excedente,2,".",''); $seguro +=$u->monto_excedente; }?>  </td>
           <td> <?php echo number_format($u->art_valor,2,".",''); $art +=$u->art_valor; ?>  </td>
           <td><?php echo number_format($u->mudanza,2,".",''); $mudanza +=$u->mudanza; ?></td>
           <td><?php echo number_format($u->porcentaje_ctacte,2,".",''); $porcentaje_ctacte +=$u->porcentaje_ctacte; ?></td>
           <td><?php echo number_format($u->iva,2,".",''); $iva +=$u->iva; ?></td>
           
         <td>
         <?php if($u->cancelado == 0 && $u->cerrado == 0){?>
          <a href="<?php echo site_url()."viaje/cancelar/$u->id/".$this->uri->segment(3);?>" onclick=" return confirm('<?php echo $this->lang->line("ask_cancel_viaje");?>') ;" > <img src="<?php echo base_url()."images/img/hr.gif";?>" width="16" height="16" alt="borrar" /> </a> 
          <?php } else
            if ($u->cerrado == 1)
              echo "cerrado";
            else  
               echo "cancelado";?>
         </td>             
       </tr>
     <?php   }?>
   </tbody>
  </table>
   
 
  <div class="resumen_recaudacion">
   <?php 
   if ( $this->Current_User->isHabilitado("TOTALRECMOVIL") ) {
   ?>
	   <div class="rowform">
	   <div class="rowform-label"> <label> Viajes Realizados: </label> </div> 
     <div class="rowform-text"> <?php echo ($totalviajes - $anulados);?> </div>
	   </div>
	   <div class="rowform">
	    <div class="rowform-label"> <label> Viajes Anulados:  </label></div> 
      <div class="rowform-text">  <?php echo $anulados; ?> </div>
	    </div>
	   
	   <div class="rowform">
	    <div class="rowform-label"> <label><?php echo $this->lang->line("title_total_efectivo"); ?>: </label></div>
      <div class="rowform-text">  <?php echo "$ ".number_format($efvo,2,".",'');?> </div>
	    </div>
	   
     <div class="rowform">
	    <div class="rowform-label"> <label>  <?php echo $this->lang->line("title_total_ctacte"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo "$ ".number_format($ctacte,2,".",'');?> </div>
	    </div>
	  
	    <div class="rowform">
  	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_peones"); ?>: </label></div> 
        <div class="rowform-text"> <?php echo "$ ".number_format($peones,2,".",'');?> </div>
	    </div>

      <div class="rowform">
        <div class="rowform-label"> <label> <?php echo "Total Km: " ?> </label></div> 
        <div class="rowform-text"> <?php echo "$ ".number_format($km,2,".",'');?> </div>
      </div>

	     <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_tespera"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo "$ ".number_format($espera,2,".",'');?> </div>
	    </div>
	     <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_peaje"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo "$ ".number_format($peaje,2,".",'');?> </div>
	    </div>
	     <div class="rowform">
	    <div class="rowform-label"> <label><?php echo $this->lang->line("title_total_estacionamiento"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo "$ ".number_format($estacionamiento,2,".",'');?> </div>
	    </div>
	     <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_otros"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo "$ ".number_format($otros,2,".",'');?> </div>
	    </div>
	     <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_seguro"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo "$ ".number_format($seguro,2,".",'');?> </div>
	    </div>
	     <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_art"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo "$ ".number_format($art,2,".",'');?> </div>
	    </div>
      <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_mudanza"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo "$ ".number_format($mudanza,2,".",'');?> </div>
	    </div>
      
      <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_porcentaje_ctacte"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo "$ ".number_format($porcentaje_ctacte,2,".",'');?> </div>
	    </div>
      <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_iva"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo "$ ".number_format($iva,2,".",'');?> </div>
	    </div>
	    
     <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo "$ ".number_format(($efvo + $ctacte+$peones+$km+$espera+$peaje+$estacionamiento+$otros+$art+$seguro+$porcentaje_ctacte+$iva),2,".",''); ?> </div>
	    </div>
	   <?php } 
       if ( $this->Current_User->isHabilitado("PRINTRECMOVIL") ) {
     ?>
	    <a href="<?php echo site_url()."reporte/pdfreca/$opciones";?>"> <img src="<?php echo base_url()."images/img/pdf_icon.png";?>" width="50" height="50" alt="pdf" />
	    </a>
	    <?php }?>
	</div>
	
</div>

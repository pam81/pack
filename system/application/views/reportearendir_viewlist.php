<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
  if (code.toString() == 80 && e.altKey ) //alt+p pdf
       document.location.href='<?php echo site_url()."reporte/pdfARendir/$opciones";?>';
                     
    
});



</script>


<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("title_list_viaje"). " a Rendir";?></h2> 
  
  </div>
   <hr class="separador">
    <div class="select-bar">
		 <form name="formsearch" id="formsearch" method="post" action="<?php echo site_url()."reporte/aRendir";?>" onsubmit="return flete.validarRecaudacionGral();">  
      
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
		   
		   
		   <input type="text" name="desde_day" id="desde_day" tabindex="1" size="2" maxsize="2" value="<?php echo set_value("desde_day",$dia);?>" />
       <input type="text" name="desde_month" id="desde_month" tabindex="2" size="2" maxsize="2" value="<?php echo set_value("desde_month",$mes);?>" />    
       <input type="text" name="desde_year" id="desde_year" tabindex="3" size="4" maxsize="4" value="<?php echo set_value("desde_year",$year);?>" />
	
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
        <input type="text" name="hasta_day" id="hasta_day" tabindex="4" size="2" maxsize="2" value="<?php echo set_value("hasta_day",$dia);?>" />
       <input type="text" name="hasta_month" id="hasta_month" tabindex="5" size="2" maxsize="2" value="<?php echo set_value("hasta_month",$mes);?>" />    
       <input type="text" name="hasta_year" id="hasta_year" tabindex="6" size="4" maxsize="4" value="<?php echo set_value("hasta_year",$year);?>" />
   
		    </label>
		  
			<label>
			<input type="submit" tabindex="7" name="search" value="<?php echo $this->lang->line("button_search");?>" />
			</label>
		</form>	
		  </div>

  <table  class="tablelist navigateable myTable02 tableReporte"  >
   <thead>
    <tr>
        <th> <?php echo $this->lang->line("cant_viajes");?> </th>
        <th> <?php echo $this->lang->line("title_movil");?> </th>
        <th>Recaudación</th>
        <th>Cta. Cte.</th>        
        <th><?php echo $this->lang->line("title_iva");?></th>
        <th> <?php echo $this->lang->line("title_art");?> </th>
        <th> %<?php echo $this->lang->line("title_mudanza");?></th>
        
    </tr>    
   </thead>
   <tbody>
     <?php 
     
      $totalviajes=0;
      $totalart=0;
      $total_porcentajemudanza=0;
      $total_iva=0;
      $total_recaudacion = 0;
      $total_ctacte=0;
         foreach($viajes as $u) {
          
         ?> 
           
         
         
       <tr class="modotr">
        
         <td> <?php if (isset($u["cant_viajes"])) { echo $u["cant_viajes"]; $totalviajes += $u["cant_viajes"];}?> </td>
         
         <td> <?php if (isset($u["movil"])) echo $u["movil"];?></td>
         <td> <?php $parcial_recaudacion=0;
                 if (isset($u["parcial_efvo"])) { $parcial_recaudacion += $u["parcial_efvo"]; }   
                 if (isset($u["parcial_cc"])) {   $parcial_recaudacion += $u["parcial_cc"]; }
                  echo $parcial_recaudacion;
                  $total_recaudacion += $parcial_recaudacion;                                                               
                   ?> </td>
         <td> 
         <?php 
            $parcial_ctacte=0;
            $parcial_ctacte += $u["total_ctacte"] + $u["total_espera_cc"] + $u["total_peon_cc"]+$u["total_peaje_cc"]+$u["total_estac_cc"]+$u["total_seguro_cc"]+$u["total_otro_cc"]; 
            echo $parcial_ctacte;
            $total_ctacte += $parcial_ctacte;
          
         
         ?>
         
         </td>        
        
          <td><?php if (isset($u["total_iva"])) {echo $u["total_iva"]; $total_iva += $u["total_iva"];  }?>  </td>
          <td><?php if (isset($u["total_art"])) {echo $u["total_art"]; $totalart += $u["total_art"]; }?>  </td>
          <td><?php if (isset($u["total_porcentajemudanza"])) {echo $u["total_porcentajemudanza"]; $total_porcentajemudanza += $u["total_porcentajemudanza"]; }?>  </td>
                            
       </tr>
    <?php } ?>
   </tbody>
  </table>
  
  <div class="resumen_recaudacion">
  <?php 
   if ( $this->Current_User->isHabilitado("TOTALRECGRAL") )
    { ?>
	   <div class="rowform">
	   <div class="rowform-label"> <label> Viajes Realizados: </label> </div> 
     <div class="rowform-text"> <?php echo $totalviajes ;?> </div>
	   </div>
	
  <div class="rowform">
	    <div class="rowform-label"><label><?php echo "Total Recaudación"; ?>: </label></div> 
      <div class="rowform-text">  <?php echo $total_recaudacion; ?> </div>
	</div>
  
  
  <div class="rowform">
	    <div class="rowform-label"><label><?php echo "Total Cta. Cte."; ?>: </label></div> 
      <div class="rowform-text">  <?php echo $total_ctacte; ?> </div>
	</div>
  
  
	<div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_iva"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo $total_iva; ?> </div>
	</div>  
  
  <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_art"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo $totalart; ?> </div>
	</div>
	
 
  
  <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_porcentaje_mudanza"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo $total_porcentajemudanza; ?> </div>
	</div>
  
  
  
  
  
	  
	    
	    
     
	  <?php  }
	   
   if ( $this->Current_User->isHabilitado("PRINTGRAL") ) {
     ?>
	    <a href="<?php echo site_url()."reporte/pdfARendir/$opciones";?>"> <img src="<?php echo base_url()."images/img/pdf_icon.png";?>" width="50" height="50" alt="pdf" />
	    </a>
	    <?php } ?>
	</div>
	
</div>

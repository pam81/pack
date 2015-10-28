<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
  if (code.toString() == 80 && e.altKey ) //alt+p pdf
       document.location.href='<?php echo site_url()."reporte/pdfmovil/$opciones";?>';
  
   
       
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
  
  <h2> <?php echo "Moviles ";?></h2>
  
  </div>
   <hr class="separador">
    <div class="select-bar">
		 <form name="formsearch" id="formsearch" method="post" action="<?php echo site_url()."reporte/movil";?>" onsubmit="return flete.validarSearch(3);">  
        <label> <?php echo mb_convert_case($this->lang->line("title_movil"),MB_CASE_TITLE,"utf-8");?>
		    <input type="text" tabindex="1" name="movil" id="searchfield" value="<?php if (isset($movil)) echo $movil;?>" onkeypress="searching(event); " />
		    </label>
		  
      
			  <label> <?php echo mb_convert_case($this->lang->line("title_fecha"),MB_CASE_TITLE,"utf-8");?>
		   
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
    <tr>
        <th> <?php echo $this->lang->line("title_fecha");?> </th>
        <th> <?php echo $this->lang->line("title_hora_ingreso");?> </th>
        <th> <?php echo $this->lang->line("title_hora_egreso");?> </th>
        <th> <?php echo $this->lang->line("title_movil");?> </th>
        <th> <?php echo $this->lang->line("title_primer_servicio");?></th>
        <th> <?php echo $this->lang->line("cant_viajes");?></th>
        
         <th> <?php echo substr($this->lang->line("title_contado"),0,4);?> </th>
         
        
         <th> <?php echo $this->lang->line("title_ctacte");?> </th>
        
          <th> <?php echo $this->lang->line("title_peones");?> </th>
          <th> <?php echo $this->lang->line("title_espera");?> </th>
          <th> <?php echo $this->lang->line("title_peaje");?> </th>
          <th> <?php echo $this->lang->line("estacionamiento_short");?> </th>
          <th> <?php echo $this->lang->line("title_otros");?> </th>
          <th> <?php echo $this->lang->line("title_seguro");?> </th>
          <th> <?php echo $this->lang->line("title_art");?> </th>
           <th> <?php echo substr($this->lang->line("title_mudanza"),0,4);?></th>
      
       <th>% <?php echo $this->lang->line("title_ctacte");?></th>
       <th>% <?php echo $this->lang->line("title_iva");?></th>
          <th> <?php echo $this->lang->line("title_total");?> </th>
        
    </tr>    
   </thead>
   <tbody>
     <?php 
    
     
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
    
     $porcentaje_ctacte=0;
     $iva=0;
         foreach($viajes as $u) {
         
         
         ?>
         
         
       <tr class="modotr">
        
         <td> <?php 
         $year=substr($u["fecha_ingreso"],0,4);
          $mes=substr($u["fecha_ingreso"],4,2);
          $dia=substr($u["fecha_ingreso"],6,2);
          $today=date("Ymd");
          
         echo $dia."-".$mes."-".$year;?> </td>
         
         <td> <?php 
         $hora=substr($u["hora_ingreso"],0,2);
         $min=substr($u["hora_ingreso"],2,2);
         echo $hora.":".$min;?></td>
         
         <td> <?php 
         $hora=substr($u["hora_egreso"],0,2);
         $min=substr($u["hora_egreso"],2,2);
         echo $hora.":".$min;?></td>
         <td> <?php echo $u["movil"];?></td>
         
         <td> <?php $hora=substr($u["primero"],0,2);
                    $min=substr($u["primero"],2,2);
                    echo $hora.":".$min; 
         ?>  </td>
          <td> <?php echo $u["cant_viajes"];?> </td>
         
         <td> <?php echo $u["efvo"]; $efvo += $u["efvo"];?> </td>
         
         
         <td> <?php  echo $u["ctacte"]; $ctacte += $u["ctacte"]; ?> </td>          
        
         <td> <?php echo $u["peones"]; $peones +=$u["peones"]; ?>  </td>
         
          <td> <?php echo $u["espera"]; $espera +=$u["espera"]; ?>  </td>
          <td> <?php echo $u["peaje"]; $peaje +=$u["peaje"]; ?>  </td>
          <td> <?php echo $u["estac"]; $estacionamiento +=$u["estac"]; ?>  </td>
          <td> <?php echo $u["otros"]; $otros +=$u["otros"]; ?>  </td>
          <td> <?php echo $u["seguro"]; $seguro +=$u["seguro"]; ?>  </td>
           <td> <?php echo $u["art"]; $art +=$u["art"]; ?>  </td>
           <td> <?php echo $u["mudanza"]; $mudanza += $u["mudanza"];?></td>
        
        <td> <?php echo $u["porcentaje_ctacte"]; $porcentaje_ctacte += $u["porcentaje_ctacte"];?></td>
        <td> <?php echo $u["iva"]; $iva += $u["iva"];?></td>
        <td>   <?php echo $u["total"];  ?>  </td>
                    
       </tr>
     <?php   }?>
   </tbody>
  </table>
   
  
  <div class="resumen_recaudacion">
	   <?php 
   if ( $this->Current_User->isHabilitado("TOTALMOVIL") )
    { ?>
	  
	   <div class="rowform">
	    <div class="rowform-label"> <label><?php echo $this->lang->line("title_total_efectivo"); ?>: </label></div>
      <div class="rowform-text">  <?php echo $efvo;?> </div>
	    </div>
	  
     <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_ctacte"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $ctacte;?> </div>
	    </div>
	  
	    <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_peones"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $peones;?> </div>
	    </div>
	     <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_tespera"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $espera;?> </div>
	    </div>
	     <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_peaje"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $peaje;?> </div>
	    </div>
	     <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_estacionamiento"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $estacionamiento;?> </div>
	    </div>
	     <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_otros"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $otros;?> </div>
	    </div>
	     <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_seguro"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $seguro;?> </div>
	    </div>
	      <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_art"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $art;?> </div>
	    </div>
	   <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_mudanza"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $mudanza;?> </div>
	    </div>
     
      <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_porcentaje_ctacte"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $porcentaje_ctacte;?> </div>
	    </div>
      <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_iva"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $iva;?> </div>
	    </div>
     <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo ($efvo + $ctacte+$peones+$espera+$peaje+$estacionamiento+$otros+$seguro+$art+$porcentaje_ctacte+$iva); ?> </div>
	    </div>
	    	<?php } 
   if ( $this->Current_User->isHabilitado("PRINTMOVIL") )
    { ?>
	    <a href="<?php echo site_url()."reporte/pdfmovil/$opciones";?>"> <img src="<?php echo base_url()."images/img/pdf_icon.png";?>" width="50" height="50" alt="pdf" />
	    </a>
	    <?php } ?>
	</div>

</div>

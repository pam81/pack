<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
  if (code.toString() == 80 && e.altKey ) //alt+p pdf
       document.location.href='<?php echo site_url()."reporte/pdfgral/$opciones";?>';
                     
    
});



</script>


<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("title_list_viaje");?></h2> <div class="link_reporte_rendir"><a href="<?php echo site_url()."reporte/aRendir";?>">Reporte A Rendir</a></div>
  
  </div>
   <hr class="separador">
    <div class="select-bar">
		 <form name="formsearch" id="formsearch" method="post" action="<?php echo site_url()."reporte/recaudaciongral";?>" onsubmit="return flete.validarRecaudacionGral();">  
      
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
        <th> <?php echo substr($this->lang->line("choferes"),0,4);?> </th>
        <th> <?php echo $this->lang->line("title_movil");?> </th>
        
        <th> <?php echo substr($this->lang->line("title_contado"),0,4);?> </th>
        
        <th> <?php echo $this->lang->line("title_ctacte");?> </th>
        
        <th> <?php echo $this->lang->line("title_peones");?> </th>
        <th> <?php echo $this->lang->line("title_espera");?> </th>
        <th> <?php echo $this->lang->line("title_peaje");?> </th>
        <th> <?php echo $this->lang->line("estacionamiento_short");?> </th>
        <th> <?php echo $this->lang->line("title_otros");?> </th>
        <th> <?php echo $this->lang->line("title_seguro");?> </th>
        <th> <?php echo substr($this->lang->line("title_mudanza"),0,4);?></th>
       <th><?php echo $this->lang->line("title_iva");?></th>
       <th>% <?php echo $this->lang->line("title_ctacte");?></th>

       <th> <?php echo $this->lang->line("title_art");?> </th>
       
        <th> <?php echo $this->lang->line("title_comisionar");?> </th>
        <th> <?php echo $this->lang->line("title_acliente");?> </th>
      
       
        
    </tr>    
   </thead>
   <tbody>
     <?php 
     
      $totalviajes=0;
      $efvo=0;
      $ctacte=0;
      $peones=0;
      $peonescc=0;
      $peonesefvo=0;
      $espera=0;
      $esperaefvo=0;
      $esperacc=0;
      $peaje=0;
      $peajeefvo=0;
      $peajecc=0;
      $estacionamiento=0;
      $estacefvo=0;
      $estaccc=0;
      $otros=0;
      $otrosefvo=0;
      $otroscc=0;
      $seguro=0;
      $seguroefvo=0;
      $artcc=0;
      $artefvo=0;
      $mudanzacc=0;
      $mudanzaefvo=0;
      
      $porcentaje_ctactecc=0;
      $porcentaje_ctacteefvo=0;
      $ivacc=0;
      $ivaefvo=0;
      $segurocc=0;
      $totalcc=0;
      $totalart=0;
      $totalmudanza=0;
      $total_porcentajemudanza=0;
      $total_porcentajecc=0;
      $total_iva=0;
      $total_contado=0;
      $total_parcial_efvo = 0;
      $total_parcial_cc = 0;
         foreach($viajes as $u) {
          
         ?> 
           
         
         
       <tr class="modotr">
        
         <td> <?php if (isset($u["cant_viajes"])) { echo $u["cant_viajes"]; $totalviajes += $u["cant_viajes"];}?> </td>
         <td> <?php if (isset($u["chofer"])) echo $u["chofer"];?></td>
         <td> <?php if (isset($u["movil"])) echo $u["movil"];?></td>
        
         <td> <?php if(isset($u["total_efvo"])) {echo $u["total_efvo"]; $efvo += $u["total_efvo"];}?> </td>
        
         <td> <?php if (isset($u["total_ctacte"])) {echo $u["total_ctacte"]; $ctacte += $u["total_ctacte"]; }?> </td>          
        
         <td><?php if (isset($u["total_peon"])) {echo  "Efvo: ".$u["total_peon_efvo"]." <br> CC: ".$u["total_peon_cc"]; $peones += $u["total_peon"]; $peonescc += $u["total_peon_cc"]; $peonesefvo += $u["total_peon_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_espera"])) {echo "Efvo: ".$u["total_espera_efvo"]." <br> CC: ".$u["total_espera_cc"]; $espera += $u["total_espera"]; $esperacc += $u["total_espera_cc"]; $esperaefvo += $u["total_espera_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_peaje"])) {echo  "Efvo: ".$u["total_peaje_efvo"]." <br> CC: ".$u["total_peaje_cc"];$peaje += $u["total_peaje"]; $peajecc += $u["total_peaje_cc"]; $peajeefvo += $u["total_peaje_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_estac"])) {echo "Efvo: ".$u["total_estac_efvo"]." <br> CC: ".$u["total_estac_cc"]; $estacionamiento += $u["total_estac"]; $estaccc+=$u["total_estac_cc"]; $estacefvo += $u["total_estac_efvo"];  }?>  </td>
         <td><?php if (isset($u["total_otro"])) {echo "Efvo: ".$u["total_otro_efvo"]." <br> CC: ".$u["total_otro_cc"]; $otros += $u["total_otro"]; $otroscc += $u["total_otro_cc"]; $otrosefvo += $u["total_otro_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_seguro"])) {echo "Efvo: ".$u["total_seguro_efvo"]." <br> CC: ".$u["total_seguro_cc"]; $seguro += $u["total_seguro"]; $segurocc += $u["total_seguro_cc"]; $seguroefvo += $u["total_seguro_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_mudanza"])) {echo "Efvo: ".$u["total_mudanza_efvo"]." <br> CC: ".$u["total_mudanza_cc"]; $totalmudanza += $u["total_mudanza"]; $mudanzacc += $u["total_mudanza_cc"]; $mudanzaefvo += $u["total_mudanza_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_iva"])) {echo "Efvo: ".$u["total_iva_efvo"]." <br> CC: ".$u["total_iva_cc"]; $total_iva += $u["total_iva"]; $ivacc += $u["total_iva_cc"]; $ivaefvo += $u["total_iva_efvo"]; }?>  </td>
         
         
         <td><?php if (isset($u["total_porcentajecc"])) {echo "Efvo: 0 <br> CC: ".$u["total_porcentajecc_cc"]; $total_porcentajecc += $u["total_porcentajecc"]; $porcentaje_ctactecc += $u["total_porcentajecc_cc"];  }?>  </td>
        
          <td><?php if (isset($u["total_art"])) {echo "Efvo: ".$u["total_art_efvo"]." <br> CC: ".$u["total_art_cc"]; $totalart += $u["total_art"]; $artcc += $u["total_art_cc"]; $artefvo += $u["total_art_efvo"]; }?>  </td>
          
         <td>
           <?php echo "Efvo:"; ?>
           <?php if (isset($u["parcial_efvo"])) echo $u["parcial_efvo"]; $total_parcial_efvo +=$u["parcial_efvo"];  ?>
          
           <?php echo "<br> CC:"; ?>
          <?php if (isset($u["parcial_cc"])) echo $u["parcial_cc"]; $total_parcial_cc +=$u["parcial_cc"];  ?> 
         
         </td>
         
         <td>
           <?php echo "Efvo:"; ?>
           <?php if (isset($u["total_contado"])) echo $u["total_contado"]; $total_contado +=$u["total_contado"];  ?>
          
           <?php echo "<br> CC:"; ?>
          <?php if (isset($u["totalcc"])) echo $u["totalcc"]; $totalcc +=$u["totalcc"];  ?> 
         
         </td>  
        
        
                      
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
	    <div class="rowform-label"> <label><?php echo $this->lang->line("title_total_efectivo"); ?>: </label></div>
      <div class="rowform-text">  <?php echo $efvo;?> </div>
	  </div>
	  
     <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_ctacte"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $ctacte;?> </div>
	    </div>
	  
	
	<div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_peones"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo $peones." <br> [Efvo: $peonesefvo + Cta Cte: $peonescc  ]"; ?> </div>
      
	</div>
	<div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_tespera"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo $espera."<br> [Efvo: $esperaefvo + Cta Cte: $esperacc ]"; ?> </div>
	</div>
	<div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_peaje"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo $peaje."<br> [Efvo: $peajeefvo + Cta Cte: $peajecc  ]"; ?> </div>
     
      
	</div>
	<div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_estacionamiento"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo $estacionamiento."<br> [Efvo: $estacefvo + Cta Cte: $estaccc; ]"; ?> </div>
	</div>
	<div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_otros"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo $otros."<br> [Efvo: $otrosefvo + Cta Cte: $otroscc ]"; ?> </div>
	</div>
	<div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_seguro"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo $seguro."<br> [Efvo: $seguroefvo + Cta Cte: $segurocc ]"; ?> </div>
	</div>
  
  <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_art"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo $totalart."<br> [Efvo: $artefvo + Cta Cte: $artcc ]"; ?> </div>
	</div>
	
  <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_mudanza"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo $totalmudanza."<br> [Efvo: $mudanzaefvo + Cta Cte: $mudanzacc ]"; ?> </div>
	</div>
  
 
  
  <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_porcentaje_ctacte"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo $total_porcentajecc."<br> [Efvo: $porcentaje_ctacteefvo + Cta Cte: $porcentaje_ctactecc ]"; ?> </div>
	</div>
  
  <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_iva"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo $total_iva."<br> [Efvo: $ivaefvo + Cta Cte: $ivacc ]"; ?> </div>
	</div>
  
	   <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_comisionar"); ?> : </label></div> 
      <div class="rowform-text"> <?php echo "Efvo: ".$total_parcial_efvo."   Cta.Cte.: ".$total_parcial_cc;?> </div>
	    </div>
	    
	    
	    <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_acliente"); ?> : </label></div> 
      <div class="rowform-text"> <?php echo "Efvo: ".$total_contado."   Cta.Cte.: ".$totalcc;?> </div>
	    </div>
	    
	    
     
	  <?php  }
	   
   if ( $this->Current_User->isHabilitado("PRINTGRAL") ) {
     ?>
	    <a href="<?php echo site_url()."reporte/pdfgral/$opciones";?>"> <img src="<?php echo base_url()."images/img/pdf_icon.png";?>" width="50" height="50" alt="pdf" />
	    </a>
	    <?php } ?>
	</div>
	
</div>

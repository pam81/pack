<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
  if (code.toString() == 80 && e.altKey ) //alt+p pdf
       document.location.href='<?php echo site_url()."reporte/pdfgral/$opciones";?>';
                     
    
});



</script>


<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("title_list_viaje");?></h2> 
  <div class="link_reporte_rendir">  <a href="<?php echo site_url()."reporte/aRendir";?>">Reporte A Rendir</a></div>
  <div class="link_reporte_rendir" style="margin-right: 10px">  <a href="<?php echo site_url()."reporte/mensual";?>">Rendición Mensual</a></div>
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
        
         <td> <?php if(isset($u["total_efvo"])) {echo number_format($u["total_efvo"],2,".",'') ; $efvo += $u["total_efvo"];}?> </td>
        
         <td> <?php if (isset($u["total_ctacte"])) {echo number_format($u["total_ctacte"],2,".",''); $ctacte += $u["total_ctacte"]; }?> </td>          
        
         <td><?php if (isset($u["total_peon"])) {echo  "Efvo: ".number_format($u["total_peon_efvo"],2,".",'')." <br> CC: ".number_format($u["total_peon_cc"],2,".",''); $peones += $u["total_peon"]; $peonescc += $u["total_peon_cc"]; $peonesefvo += $u["total_peon_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_espera"])) {echo "Efvo: ".number_format($u["total_espera_efvo"],2,".",'')." <br> CC: ".number_format($u["total_espera_cc"],2,".",''); $espera += $u["total_espera"]; $esperacc += $u["total_espera_cc"]; $esperaefvo += $u["total_espera_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_peaje"])) {echo  "Efvo: ".number_format($u["total_peaje_efvo"],2,".",'')." <br> CC: ".number_format($u["total_peaje_cc"],2,".",'');$peaje += $u["total_peaje"]; $peajecc += $u["total_peaje_cc"]; $peajeefvo += $u["total_peaje_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_estac"])) {echo "Efvo: ".number_format($u["total_estac_efvo"],2,".",'')." <br> CC: ".number_format($u["total_estac_cc"],2,".",''); $estacionamiento += $u["total_estac"]; $estaccc+=$u["total_estac_cc"]; $estacefvo += $u["total_estac_efvo"];  }?>  </td>
         <td><?php if (isset($u["total_otro"])) {echo "Efvo: ".number_format($u["total_otro_efvo"],2,".",'')." <br> CC: ".number_format($u["total_otro_cc"],2,".",''); $otros += $u["total_otro"]; $otroscc += $u["total_otro_cc"]; $otrosefvo += $u["total_otro_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_seguro"])) {echo "Efvo: ".number_format($u["total_seguro_efvo"],2,".",'')." <br> CC: ".number_format($u["total_seguro_cc"],2,".",''); $seguro += $u["total_seguro"]; $segurocc += $u["total_seguro_cc"]; $seguroefvo += $u["total_seguro_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_mudanza"])) {echo number_format($u["total_mudanza"],2,".",''); $totalmudanza += $u["total_mudanza"];  }?>  </td>
         <td><?php if (isset($u["total_iva"])) {echo "Efvo: ".number_format($u["total_iva_efvo"],2,".",'')." <br> CC: ".number_format($u["total_iva_cc"],2,".",''); $total_iva += $u["total_iva"]; $ivacc += $u["total_iva_cc"]; $ivaefvo += $u["total_iva_efvo"]; }?>  </td>
         
         
         <td><?php if (isset($u["total_porcentajecc"])) {echo " CC: ".number_format($u["total_porcentajecc_cc"],2,".",''); $total_porcentajecc += $u["total_porcentajecc"]; $porcentaje_ctactecc += $u["total_porcentajecc_cc"];  }?>  </td>
        
          <td><?php if (isset($u["total_art"])) {echo "Efvo: ".number_format($u["total_art_efvo"],2,".",'')." <br> CC: ".number_format($u["total_art_cc"],2,".",''); $totalart += $u["total_art"]; $artcc += $u["total_art_cc"]; $artefvo += $u["total_art_efvo"]; }?>  </td>
          
         <td>
           <?php echo "Efvo:"; ?>
           <?php if (isset($u["parcial_efvo"])) echo number_format($u["parcial_efvo"],2,".",''); $total_parcial_efvo +=$u["parcial_efvo"];  ?>
          
           <?php echo "<br> CC:"; ?>
          <?php if (isset($u["parcial_cc"])) echo number_format($u["parcial_cc"],2,".",''); $total_parcial_cc +=$u["parcial_cc"];  ?> 
         
         </td>
         
         <td>
           <?php echo "Efvo:"; ?>
           <?php if (isset($u["total_contado"])) echo number_format($u["total_contado"],2,".",''); $total_contado +=$u["total_contado"];  ?>
          
           <?php echo "<br> CC:"; ?>
          <?php if (isset($u["totalcc"])) echo number_format($u["totalcc"],2,".",''); $totalcc +=$u["totalcc"];  ?> 
         
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
      <div class="rowform-text">  <?php echo "$ ".number_format($efvo,2,".",'');?> </div>
	  </div>
	  
     <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_ctacte"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo "$ ".number_format($ctacte,2,".",'');?> </div>
	    </div>
	  
	
	<div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_peones"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo "$ ".number_format($peones,2,".",'')." <br> [Efvo: $ ".number_format($peonesefvo,2,".",'') ." + Cta Cte: $ ".number_format($peonescc,2,".",'')."  ]"; ?> </div>
      
	</div>
	<div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_tespera"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo "$ ".number_format($espera,2,".",'')."<br> [Efvo:  $ ".number_format($esperaefvo,2,".",'') ." + Cta Cte: $ ".number_format($esperacc,2,".",'')." ]"; ?> </div>
	</div>
	<div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_peaje"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo "$ ".number_format($peaje,2,".",'')."<br> [Efvo:  $ ".number_format($peajeefvo,2,".",'') ." + Cta Cte: $ ".number_format($peajecc,2,".",'')."  ]"; ?> </div>
     
      
	</div>
	<div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_estacionamiento"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo "$ ".number_format($estacionamiento,2,".",'')."<br> [Efvo: $ ".number_format($estacefvo,2,".",'') ." + Cta Cte: $ ".number_format($estaccc,2,".",'')." ]"; ?> </div>
	</div>
	<div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_otros"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo "$ ".number_format($otros,2,".",'')."<br> [Efvo:  $ ".number_format($otrosefvo,2,".",'') ." + Cta Cte: $ ".number_format($otroscc,2,".",'')." ]"; ?> </div>
	</div>
	<div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_seguro"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo "$ ".number_format($seguro,2,".",'')."<br> [Efvo:  $ ".number_format($seguroefvo,2,".",'') ." + Cta Cte: $ ".number_format($segurocc,2,".",'')." ]"; ?> </div>
	</div>
  
  <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_art"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo "$ ".number_format($totalart,2,".",'')."<br> [Efvo:  $ ".number_format($artefvo,2,".",'') ." + Cta Cte: $ ".number_format($artcc,2,".",'')." ]"; ?> </div>
	</div>
	
  <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_mudanza"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo "$ ".number_format($totalmudanza,2,".",''); ?> </div>
	</div>
  
 
  
  <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_porcentaje_ctacte"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo "$ ".number_format($total_porcentajecc,2,".",'')."<br> [Efvo:  $ ".number_format($porcentaje_ctacteefvo,2,".",'') ." + Cta Cte: $ ".number_format($porcentaje_ctactecc,2,".",'')." ]"; ?> </div>
	</div>
  
  <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_iva"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo "$ ".number_format($total_iva,2,".",'')."<br> [Efvo:  $ ".number_format($ivaefvo,2,".",'') ." + Cta Cte: $ ".number_format($ivacc,2,".",'')." ]"; ?> </div>
	</div>
  
	   <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_comisionar"); ?> : </label></div> 
      <div class="rowform-text"> <?php echo "Efvo: "."$ ".number_format($total_parcial_efvo,2,".",'')."   Cta.Cte.: "."$ ".number_format($total_parcial_cc,2,".",'');?> </div>
	    </div>
	    
	    
	    <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_acliente"); ?> : </label></div> 
      <div class="rowform-text"> <?php echo "Efvo: "."$ ".number_format($total_contado,2,".",'')."   Cta.Cte.: "."$ ".number_format($totalcc,2,".",'');?> </div>
	    </div>
	    
	    
     
	  <?php  }
	   
   if ( $this->Current_User->isHabilitado("PRINTGRAL") ) {
     ?>
	    <a href="<?php echo site_url()."reporte/pdfgral/$opciones";?>"> <img src="<?php echo base_url()."images/img/pdf_icon.png";?>" width="50" height="50" alt="pdf" />
	    </a>
      <a href="<?php echo site_url()."pdf/makeExcellgral/$opciones";?>"><img src="<?php echo base_url()."images/img/excell.jpg";?>" width="50" height="50" alt="excell" /></a>
	    <?php } ?>
	</div>
	
</div>

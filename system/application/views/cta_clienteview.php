<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
  if (code.toString() == 80 && e.altKey ) //alt+p pdf
       document.location.href='<?php echo site_url()."reporte/pdfctaCliente/$opciones";?>';
  
  if(code.toString() == 78 && e.altKey)  //alt + n accesar viaje por numero
       flete.findViaje('<?php echo site_url()."viaje/visualiza/";?>');               
    
});

</script>


<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("cta_x_cliente");?></h2>
  
  </div>
   <hr class="separador">
   
   
   
   	<div class="resumen_recaudacion">
	   <div class="rowform1">
	   <div class="rowform-label"> <label> Cliente: </label> </div> 
     <div class="rowform-text"> <?php if (isset($cliente[0])) echo mb_convert_case($cliente[0]->name,MB_CASE_TITLE);?> </div>
	    <div class="rowform-label"> <label> CUIT: </label> </div> 
	    <div class="rowform-text"> <?php if (isset($cliente[0])) echo $cliente[0]->cuit;?> </div>
     </div>
     
	   <div class="rowform1">
	    <div class="rowform-label"> <label> Teléfono: </label></div> 
      <div class="rowform-text"> <?php if (isset($cliente[0])) echo $telefono;?> </div>
      <div class="rowform-label"> <label> Observaciones: </label></div> 
      <div class="rowform-text"> <?php if (isset($cliente[0])) echo $cliente[0]->observaciones;?> </div>
	    </div>
	 
	   <div class="rowform1">
	    <div class="rowform-label"> <label> Dirección: </label></div> 
      <div class="rowform-text"> <?php if (isset($cliente[0])) echo $cliente[0]->address;?> </div>
	    </div>
	   
	   <div class="rowform1">
	    <div class="rowform-label"> <label> Desde Fecha: </label></div> 
      <div class="rowform-text"> <?php
      $year=substr($fdesde,0,4);
                   $mes=substr($fdesde,4,2);
                   $day=substr($fdesde,6,2);
         echo $day."-".$mes."-".$year;
      
      ;?> </div>
	    
	    <div class="rowform-label"> <label> Hasta Fecha: </label></div> 
      <div class="rowform-text"> <?php 
      $year=substr($fhasta,0,4);
                   $mes=substr($fhasta,4,2);
                   $day=substr($fhasta,6,2);
         echo $day."-".$mes."-".$year;
      
      ?> </div>
	    </div>
	    
	</div>
   
   
    
   <script type="text/javascript">
	jQuery.tableNavigation();
</script>
  <table  class="tablelist navigateable myTable02 tableReporte"  >
   <thead>
    <tr>
        <th > <?php echo mb_convert_case($this->lang->line("title_fecha"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th > <?php echo mb_convert_case($this->lang->line("title_hora"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th > <?php echo mb_convert_case($this->lang->line("nro_viaje"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th > <?php echo mb_convert_case($this->lang->line("title_movil"),MB_CASE_UPPER,"UTF-8");?> </th>
        
        <th > <?php echo mb_convert_case($this->lang->line("title_voucher"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th > <?php echo mb_convert_case($this->lang->line("title_ctacte"),MB_CASE_UPPER,"UTF-8");?> </th>
        
        <th > <?php echo substr(mb_convert_case($this->lang->line("title_contado"),MB_CASE_UPPER,"UTF-8"),0,4);?> </th>
      
        <th > <?php echo mb_convert_case($this->lang->line("title_peones"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th > <?php echo mb_convert_case($this->lang->line("title_peaje"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th > <?php echo substr(mb_convert_case($this->lang->line("title_estacionamiento"),MB_CASE_UPPER,"UTF-8"),0,6).".";?> </th>
        <th > <?php echo mb_convert_case($this->lang->line("title_espera"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th > <?php echo mb_convert_case($this->lang->line("title_otros"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th > <?php echo mb_convert_case($this->lang->line("title_seguro"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th > <?php echo mb_convert_case($this->lang->line("title_art"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th> <?php echo substr($this->lang->line("title_mudanza"),0,4);?></th>
       <th> %<?php echo substr($this->lang->line("title_mudanza"),0,4);?></th>
       <th><?php echo $this->lang->line("title_iva");?></th>
        <th > <?php echo mb_convert_case($this->lang->line("title_desde"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th > <?php echo mb_convert_case($this->lang->line("title_hasta"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th>Total</th>

        
        
        
    </tr>    
   </thead>
   <tbody>
     <?php
     
     $ctacte=0;
     $efvo=0; 
     $peaje=0;
     $peones=0;
     $estacionamiento=0;
     $espera=0;
     $otros=0;
     $seguro=0;
     $art=0;
     $mudanza=0;
     $porcentaje_mudanza=0;
     $iva=0;
     $total_subtotales=0;
      foreach($viajes as $v) {
           
     ?>
       <tr class="modotr">
         
         <td> <?php 
                   $year=substr($v->fecha_despacho,0,4);
                   $year=substr($year,2,2);
                   $mes=substr($v->fecha_despacho,4,2);
                   $day=substr($v->fecha_despacho,6,2);
         echo $day."-".$mes."-".$year; ?>    </td>
            <td>
          <?php $h=substr($v->habordo,0,2);
                $m=substr($v->habordo,2,2);
                echo "$h:$m";
          ?>
          </td>
         <td> <a href="<?php echo site_url()."viaje/visualiza/$v->viaje";?>" class="activation">  <?php  echo $v->viaje; ?>  </a>  </td>
          <td> <?php echo $v->movil;?> </td>
          
           <td> <?php echo $v->voucher;?> </td>
           <td> <?php if($v->forma_pago == 2) { 
                $ctacteTotal=$v->valor+$v->porcentaje_ctacte; //suma el precio % de cta cte
                echo $ctacteTotal; 
                $ctacte +=$ctacteTotal; }?> </td>
         
           <td> <?php if($v->forma_pago == 1) { echo $v->valor; $efvo +=$v->valor; }?> </td>
      
        <td> <?php echo $v->peones; $peones += $v->peones; ?></td>
        <td> <?php echo $v->peaje; $peaje += $v->peaje; ?></td>
        <td> <?php echo $v->estacionamiento; $estacionamiento += $v->estacionamiento;?></td>
        <td> <?php echo $v->espera; $espera += $v->espera;?></td>
        <td> <?php echo $v->otros; $otros += $v->otros;?></td>
        <td> <?php echo $v->seguro; $seguro += $v->seguro;?></td>
        <td> <?php echo $v->art_valor; $art += $v->art_valor;?></td>
        <td> <?php echo $v->mudanza; $mudanza += $v->mudanza;?></td>
        <td> <?php echo $v->porcentaje_mudanza; $porcentaje_mudanza += $v->porcentaje_mudanza;?></td>
        <td> <?php echo $v->iva; $iva += $v->iva;?></td>
         <td> <?php echo substr($v->desde,0,30);?> </td>
         <td> <?php echo substr($v->destino,0,30);?> </td>
         <td> <?php $subtotal= $v->valor + $v->peones + $v->peaje + $v->estacionamiento+$v->espera + $v->otros
                     + $v->seguro + $v->art_valor ;   //no suma mudanza ni % mudanza
                     if ($v->forma_pago == 2){  // suma el % cta cte
                       $subtotal += $v->porcentaje_ctacte;
                     }else{
                       $subtotal +=$v->iva; //solo en efvo suma el iva 
                     }
                    echo $subtotal; 
                    $total_subtotales += $subtotal; 
                       ?></td>
        
         
         
       </tr>
     <?php 
          
     
     }?>
   </tbody>
  </table>
  

	<div class="resumen_recaudacion">
	 <?php 
   if ( $this->Current_User->isHabilitado("TOTALCTACLIENTE") )
    { ?>
	   <div class="rowform">
	   <div class="rowform-label"> <label> Viajes Realizados: </label> </div> 
     <div class="rowform-text"> <?php echo count($viajes);?> </div>
	   </div>
	 
     <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_efectivo"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $efvo;?> </div>
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
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_peaje"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $peaje;?> </div>
	    </div>
	    
	    <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_estacionamiento"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $estacionamiento;?> </div>
	    </div>
	    
	     <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_tespera"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $espera;?> </div>
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
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_porcentaje_mudanza"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $porcentaje_mudanza;?> </div>
	    </div>
      
      <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_iva"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $iva;?> </div>
	    </div>
	   
	    <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total"); ?> : </label></div> 
      <div class="rowform-text"> <?php echo $total_subtotales;?> </div>
	    </div>
	  	<?php  } 
      if ( $this->Current_User->isHabilitado("PRINTCTACLIENTE") ) {
    ?>
	    <a href="<?php echo site_url()."reporte/pdfctaCliente/$opciones";?>"> <img src="<?php echo base_url()."images/img/pdf_icon.png";?>" width="50" height="50" alt="pdf" />
	    </a>
	    <?php } ?>
	</div>

</div>

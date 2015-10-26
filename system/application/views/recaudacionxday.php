<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
  if (code.toString() == 80 && e.altKey ) //alt+p pdf
       document.location.href='<?php echo site_url()."reporte/pdfxday/$opciones";?>';
  
  if(code.toString() == 78 && e.altKey)  //alt + n accesar viaje por numero
       flete.findViaje('<?php echo site_url()."viaje/visualiza/";?>');               
    
});

</script>


<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("recaudacionxday");?></h2>
  
  </div>
   <hr class="separador">
    
   <script type="text/javascript">
	jQuery.tableNavigation();
</script>
  <table  class="tablelist navigateable myTable02 tableReporte"  >
   <thead>
    <tr>
        <th> <?php echo $this->lang->line("nro_viaje");?> </th>
        <th> <?php echo $this->lang->line("title_fecha");?> </th>
        <th> <?php echo $this->lang->line("title_hora");?> </th>
        <th> <?php echo $this->lang->line("title_movil");?> </th>
        <th> <?php echo $this->lang->line("title_desde");?> </th>
        <th> <?php echo $this->lang->line("title_hasta");?> </th>
        <th> <?php echo $this->lang->line("title_cliente");?> </th>
        
        <th> <?php echo substr($this->lang->line("title_contado"),0,4);?> </th>
       
        <th> <?php echo $this->lang->line("title_voucher");?> </th>
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
       <th><?php echo $this->lang->line("title_iva");?></th>
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
      
      $porcentaje_ctacte=0;
      $iva=0;
      foreach($viajes as $v) {
           
     ?>
       <tr class="modotr">
         <td> <a href="<?php echo site_url()."viaje/visualiza/$v->id";?>" class="activation">  <?php  echo $v->id; ?>  </a>  </td>
         <td> <?php 
                   $year=substr($v->fecha_despacho,0,4);
                   $mes=substr($v->fecha_despacho,4,2);
                   $day=substr($v->fecha_despacho,6,2);
         echo $day."-".$mes."-".$year; ?>    </td>
         <td>
          <?php $h=substr($v->habordo,0,2);
                $m=substr($v->habordo,2,2);
                echo "$h:$m";
          ?>
          </td>
         <td> <?php echo $v->movil;?> </td>
         <td> <?php echo $v->desde;?> </td>
         <td> <?php echo $v->destino;?> </td>
         <td> <?php echo $v->cliente;?> </td>
         
         <td> <?php if ($v->forma_pago == 1) { echo $v->valor; $efvo += $v->valor; }?> </td>
         
         <td> <?php echo $v->voucher;?> </td>
         <td> <?php if ($v->forma_pago == 2) { echo $v->valor; $ctacte += $v->valor; }?> </td>
    
      <td> <?php echo $v->peones; $peones += $v->peones; ?>  </td> 
      <td> <?php echo $v->espera; $espera += $v->espera; ?>  </td>
      <td> <?php echo $v->peaje; $peaje += $v->peaje; ?>  </td>
      <td> <?php echo $v->estacionamiento; $estacionamiento += $v->estacionamiento; ?>  </td>
      <td> <?php echo $v->otros; $otros += $v->otros; ?>  </td>
      <td> <?php echo $v->monto_excedente; $seguro += $v->monto_excedente; ?>  </td>
      <td> <?php echo $v->art_valor; $art += $v->art_valor; ?>  </td>
      <td><?php echo $v->mudanza; $mudanza +=$v->mudanza; ?></td>
     
     <td><?php echo $v->porcentaje_ctacte; $porcentaje_ctacte +=$v->porcentaje_ctacte; ?></td>
     <td><?php echo $v->iva; $iva +=$v->iva; ?></td>
       </tr>
     <?php 
          if ($v->cancelado == 1)
             $anulados++;
     
     }?>
   
   </tbody>
   
  </table>
  
  <div class="link_pages">
					
	</div>
	
	<div class="resumen_recaudacion">
	 <?php 
   if ( $this->Current_User->isHabilitado("TOTALRECMOVILDIA") ) {
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
      <div class="rowform-text">  <?php echo $efvo;?> </div>
	    </div>
	  
     <div class="rowform">
	    <div class="rowform-label"> <label> <?php echo $this->lang->line("title_total_ctacte"); ?>: </label></div> 
      <div class="rowform-text"> <?php echo $ctacte;?> </div>
	    </div>
	  
	    <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_peones"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo  $peones; ?> </div>
	    </div>
	    <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_tespera"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo  $espera; ?> </div>
	    </div>
	    <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_peaje"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo  $peaje; ?> </div>
	    </div>
	    <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_estacionamiento"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo  $estacionamiento; ?> </div>
	    </div>
	    <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_otros"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo  $otros; ?> </div>
	    </div>
	    <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_seguro"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo  $seguro; ?> </div>
	    </div>
	    <div class="rowform">
	    <div class="rowform-label"><label><?php echo $this->lang->line("title_total_art"); ?>: </label></div> 
      <div class="rowform-text">  <?php echo  $art; ?> </div>
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
      <div class="rowform-text">  <?php echo ($efvo + $ctacte + $peones+$espera+$peaje+$estacionamiento+$otros + $art + $seguro+$porcentaje_ctacte+$iva); ?> </div>
	    </div>
	 	<?php } if ( $this->Current_User->isHabilitado("PRINTRECDAY") ) { ?>
	    <a href="<?php echo site_url()."reporte/pdfxday/$opciones";?>"> <img src="<?php echo base_url()."images/img/pdf_icon.png";?>" width="50" height="50" alt="pdf" />
	    </a>
	  <?php } ?>  
	</div>

</div>

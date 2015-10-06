<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
  if (code.toString() == 80 && e.altKey ) //alt+p pdf
       document.location.href='<?php echo site_url()."reporte/pdfultimoviaje/$opciones";?>';
  
  
       
 
    
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
  
  <h2> <?php echo mb_convert_case($this->lang->line("title_ultimoviaje"),MB_CASE_TITLE,"utf-8"); ?></h2>
  
  </div>
   <hr class="separador">
    <div class="select-bar">
		 <form name="formsearch" id="formsearch" method="post" action="<?php echo site_url()."reporte/tiempoUltimoViaje";?>" >  
        
		  
      
			  
		   
		   
       
       <input type="radio" name="days" id="days1" tabindex="1" value="7" <?php if ( $tiempo == 7 ) echo 'checked="cheched"' ?> /> + 7 dias
       <input type="radio" name="days" id="days2" tabindex="2"  value="15" <?php if ( $tiempo == 15 ) echo 'checked="cheched"' ?> /> + 15 días    
       <input type="radio" name="days" id="days3" tabindex="3"  value="20" <?php if ( $tiempo == 20 ) echo 'checked="cheched"' ?> /> + 20 días
		   <input type="radio" name="days" id="days4" tabindex="4"  value="30" <?php if ( $tiempo == 30 ) echo 'checked="cheched"' ?> /> + 30 días
		   
		    
		   
		  
        
			<label>
			<input type="submit" tabindex="5" name="search" value="<?php echo $this->lang->line("button_search");?>" />
			</label>
		</form>	
		  </div>
   <script type="text/javascript">
	jQuery.tableNavigation();
</script>
  <table  class="tablelist navigateable myTable02"  >
   <thead>
    <tr>
      
        <th> <?php echo $this->lang->line("title_cliente");?> </th>
        <th> <?php echo $this->lang->line("title_fechaultimoviaje");?> </th>
        
    </tr>    
   </thead>
   <tbody>
     <?php 
     
         foreach($viajes as $v) {
         
         
         
         ?>
         
         
       <tr class="modotr">
          
        
         
         <td> <a href="<?php echo site_url()."cliente/mod/".$v->clienteid;?>"> <?php echo $v->nombre;?></a> </td>
         <td> <?php  $year=substr($v->fecha,0,4);
         
          $mes=substr($v->fecha,4,2);
          $dia=substr($v->fecha,6,2); echo $dia."-".$mes."-".$year; ?> </td>
         
        
                      
       </tr>
     <?php   }?>
   </tbody>
  </table>
   <?php  if ( $this->Current_User->isHabilitado("PRINTULTVIAJE") ){
      ?>
    <a href="<?php echo site_url()."reporte/pdfultimoviaje/$opciones";?>"> <img src="<?php echo base_url()."images/img/pdf_icon.png";?>" width="50" height="50" alt="pdf" />
	    </a>
   <?php } ?> 
</div>

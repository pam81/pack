<script type="text/javascript" >

/*$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
  if (code.toString() == 80 && e.altKey ) //alt+p pdf
       document.location.href='<?php echo site_url()."reporte/pdfmovil/$opciones";?>';
  
   
       
 if (code.toString() == 66 && e.altKey ) //alt+b buscar viaje
       $("#searchfield").focus();                    
    
});*/

function searching(e)
{
  var tecla = (document.all) ? e.keyCode : e.which;
  if (tecla.toString() == 13)
    $("#searchfield").focus();
} 

</script>






<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo "Sesiones de Usuarios ";?></h2>
  
  </div>
   <hr class="separador">
    <div class="select-bar">
		 <form name="formsearch" id="formsearch" method="post" action="<?php echo site_url()."reporte/sesiones";?>" >  
        <label> <?php echo mb_convert_case($this->lang->line("title_usuario"),MB_CASE_TITLE,"utf-8");?>
		    <input type="text" tabindex="1" name="user" id="searchfield" value="<?php if (isset($user)) echo $user;?>" onkeypress="searching(event); " />
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
  <table  class="tablelist navigateable myTable02"  >
   <thead>
    <tr>
         <th> <?php echo $this->lang->line("title_usuario");?> </th>
       
        <th> <?php echo $this->lang->line("title_hora_ingreso");?> </th>
        <th> <?php echo $this->lang->line("title_hora_egreso");?> </th>
       
        
    </tr>    
   </thead>
   <tbody>
   
    
     
        <?php foreach($sesiones as $u){  ?>
         
       <tr class="modotr">
         <td> <?php echo $u->username;?></td>
         <td> <?php 
          $year=substr($u->date_begin,0,4);
          $mes=substr($u->date_begin,4,2);
          $dia=substr($u->date_begin,6,2);
          $hora=substr($u->h_begin,0,2);
          $min=substr($u->h_begin,2,2);
          
         echo $dia."-".$mes."-".$year." ".$hora.":".$min;?> </td>
         
         <td> <?php 
          $year=substr($u->date_last_activity,0,4);
          $mes=substr($u->date_last_activity,4,2);
          $dia=substr($u->date_last_activity,6,2);
          $hora=substr($u->h_last_activity,0,2);
          $min=substr($u->h_last_activity,2,2);
          
         echo $dia."-".$mes."-".$year." ".$hora.":".$min;?> </td>
         
         
          
         
          
                    
       </tr>
     <?php   }?>
   </tbody>
  </table>
   
  
  

</div>

<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
    
    if (code.toString() == 78 && e.altKey ) //alt+n agregar nueva reserva
       document.location.href='<?php echo site_url()."reserva/add";?>';

    if (code.toString() == 80 && e.altKey ) //alt+p repetir programadas
       document.location.href='<?php echo site_url()."reserva/repetir";?>';
    
    if (code.toString() == 66 && e.altKey ) //alt+b buscar reserva
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
  <a href="<?php echo site_url()."reserva/add";?>" accesskey="n" class="button"><?php echo $this->lang->line("title_add_new");?> </a>
  <a href="<?php echo site_url()."reserva/listado";?>"  class="button"><?php echo $this->lang->line("title_listado");?> </a>
  <h2> <?php echo $this->lang->line("title_list_reserva");?></h2>
  
  </div>
   <hr class="separador">
    <div class="select-bar">
		 <form name="formsearch" id="formsearch" method="post" action="<?php echo site_url()."reserva/index";?>" onsubmit="return flete.validarSearch(1);">  
        <label> <?php echo mb_convert_case($this->lang->line("title_phone"),MB_CASE_TITLE,"utf-8");?>
		    <input size="10" tabindex="1" type="text" name="searchfield" id="searchfield" value="<?php if (isset($search)) echo set_value("searchfield",$search);?>" onkeypress="searching(event); " />
		    </label>
		    <label> <?php echo "Código";?>
		    <input size="10" tabindex="11" type="text" name="code" id="code" value="<?php if (isset($code)) echo set_value("code",$code);?>"  />
		    </label>
		    <label> <?php echo mb_convert_case($this->lang->line("title_only_repetir"),MB_CASE_TITLE,"utf-8");?>
		    <input tabindex="2" type="checkbox" name="repetir" id="repetir" value="1" <?php if (isset($only) && $only==1) echo "checked=\"checked\""; ?> />
		    </label>
		    <label> <?php echo mb_convert_case("todas",MB_CASE_TITLE,"utf-8");?>
		    <input tabindex="3" type="checkbox" name="despachadas" id="despachadas" value="1" <?php if (isset($despachadas) && $despachadas==1) echo "checked=\"checked\""; ?> />
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
		   
		   <input tabindex="4" type="text" name="desde_day" id="desde_day" tabindex="2" size="2" maxsize="2" value="<?php echo set_value("desde_day",$dia);?>" />
       <input tabindex="5" type="text" name="desde_month" id="desde_month" tabindex="3" size="2" maxsize="2" value="<?php echo set_value("desde_month",$mes);?>" />    
       <input tabindex="6" type="text" name="desde_year" id="desde_year" tabindex="4" size="4" maxsize="4" value="<?php echo set_value("desde_year",$year);?>" />
	
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
        
         <input tabindex="7" type="text" name="hasta_day" id="hasta_day" tabindex="5" size="2" maxsize="2" value="<?php echo set_value("hasta_day",$dia);?>" />
       <input tabindex="8" type="text" name="hasta_month" id="hasta_month" tabindex="6" size="2" maxsize="2" value="<?php echo set_value("hasta_month",$mes);?>" />    
       <input tabindex="9" type="text" name="hasta_year" id="hasta_year" tabindex="7" size="4" maxsize="4" value="<?php echo set_value("hasta_year",$year);?>" />
	
		    </label>
		    
		    <label>
			<input tabindex="10" type="submit" name="search" value="<?php echo $this->lang->line("button_search");?>" />
			</label>
			
		</form>	
		  </div>
   <script type="text/javascript">
	jQuery.tableNavigation(
  

  );
</script>
  <table  class="tablelist navigateable myTable02"  >
   <thead>
    <tr>
       <th width="32"> <?php echo  mb_convert_case($this->lang->line("title_hora_salida"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="45"> <?php echo mb_convert_case($this->lang->line("title_fecha"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="36"> <?php echo mb_convert_case($this->lang->line("title_puerta"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="100"> <?php echo mb_convert_case($this->lang->line("title_name"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="55"> <?php echo mb_convert_case($this->lang->line("title_phone"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="150"> <?php echo mb_convert_case($this->lang->line("title_desde"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="150"> <?php echo mb_convert_case($this->lang->line("title_hasta"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th > <?php echo mb_convert_case($this->lang->line("title_observacion"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="35"> <?php echo mb_convert_case($this->lang->line("title_categoria"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="40"> <?php echo mb_convert_case($this->lang->line("title_forma_pago"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="25"> <?php echo mb_convert_case($this->lang->line("title_despachar"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="25"> <?php echo mb_convert_case($this->lang->line("title_mod"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="25"> <?php echo mb_convert_case($this->lang->line("title_cancelar"),MB_CASE_UPPER,"UTF-8");?> </th>
          <th width="25"> <?php echo mb_convert_case($this->lang->line("title_bloqueado"),MB_CASE_UPPER,"UTF-8");?> </th>
        
    </tr>    
   </thead>
   <tbody>
     <?php 
          
         foreach($reservas as $u) {?>
       <tr class="modotr 
       <?php   
          $year=substr($u->fecha,0,4);
          $year=substr($year,2,2);
          $mes=substr($u->fecha,4,2);
          $dia=substr($u->fecha,6,2);
          $today=date("Ymd");
          
       if ($u->cancelado==1) 
                   echo "borrado";
               else{
               if ($u->despachado == 0){
               //las reservas de hoy se ponen en verde
                 if ( ($u->hsalida-15) > date("Hi") && $today == $u->fecha)
                   echo "green";
               //15 minutos antes de la hora de alarma
                  if ( ($u->hsalida - 15) <= date("Hi") && date("Hi") < $u->hsalida && $today == $u->fecha)
                   echo "green2";   
               //si paso la alarma se pone en rojo
                    
                 if ( $today == $u->fecha && $u->hsalida <= date("Hi") && $u->hpuerta > date("Hi") )
                    echo "red";  
               //si paso la hora en puerta se pone en negro
                 if ( $today == $u->fecha && $u->hpuerta <= date("Hi")  )
                    echo "incumplido";   
                }
               }    
       
       ?>   
       
       ">
       <td> <?php 
         $h=substr($u->hsalida,0,2);
         $m=substr($u->hsalida,2,2);
         
         echo $h.":".$m;
       ?></td>
         <td> <?php 
         
         echo $dia."-".$mes."-".$year;?> </td>
         <td> <?php 
         $h=substr($u->hpuerta,0,2);
         $m=substr($u->hpuerta,2,2);
         echo $h.":".$m;?></td>
         
         <td> <a href="<?php echo site_url()."cliente/mod/".$u->clienteid;?>"> <?php echo mb_substr($u->name,0,15);?> </a> </td>
          <td> <?php echo $u->phone;?></td>
         <td> <?php echo mb_substr($u->desde,0,20);?> </td>
         <td> <?php echo mb_substr($u->destino,0,20); ?> </td>
         <td> <?php echo mb_substr($u->observaciones,0,20);?> </td>
         <td> <?php echo $u->categoria;?> </td>
         <td> <?php 
           if ($u->forma_pago ==1 )
              echo $this->lang->line("title_contado");
           else
              echo $this->lang->line("title_ctacte"); 
              ?> </td>
         <td>  
          <?php if ($u->cancelado != 1 && $u->despachado == 0) { ?>
         <a href="<?php  echo site_url()."viaje/despachar/$u->id";?>" > <img src="<?php echo base_url()."images/img/camion4.jpg";?>" width="20" height="20" alt="despachar" title="despachar" /> </a>
         <?php } else {
                 if ($u->despachado == 1)
                       echo "<img src=\"".base_url()."images/img/tilde.png\" width=\"16\" height=\"16\" alt=\"despachada\" />";}?>
         </td>         
         <td> 
         
         <a href="<?php  if ($u->cancelado == 1) {echo site_url()."reserva/seecancel/$u->id/".$this->uri->segment(3);} else { echo site_url()."reserva/mod/$u->id/".$this->uri->segment(3);}?>"  class="activation"> <img src="<?php echo base_url()."images/img/edit-icon.gif";?>" width="16" height="16" alt="modificar" title="modificar" /> </a> 
         
         </td>
         <td>
         <?php if ($u->cancelado != 1 && $u->despachado == 0){ ?>
          <a href="<?php echo site_url()."reserva/cancelar/$u->id/".$this->uri->segment(3);?>" onclick=" return confirm('<?php echo $this->lang->line("ask_cancel_reserva");?>') ;" > <img src="<?php echo base_url()."images/img/hr.gif";?>" width="16" height="16" alt="cancelar" title="cancelar" /> </a> 
          <?php } else{
           if ($u->cancelado == 1)
                   echo "<img src=\"".base_url()."images/img/resta.png\" width=\"16\" height=\"16\" alt=\"cancelada\" title=\"cancelada\" /> ";
                   
                   }?>
         </td>  
          <td>
           <?php if ($u->bloqueado == 1){ ?>
           <a href="<?php echo site_url()."reserva/unlock/$u->id/".$this->uri->segment(3);?>" onclick=" return confirm('<?php echo $this->lang->line("ask_debloquear_reserva");?>') ;" > <img src="<?php echo base_url()."images/img/lock.png";?>" width="16" height="16" alt="bloqueado por <?php echo $u->bloqueado_by;?>" /> </a>
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

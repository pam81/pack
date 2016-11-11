<div id="header">
  
  <div id="header_left">
   <a class="header_link" href="<?php echo site_url();?>">  <?php echo $this->lang->line("name_empresa");?>  </a>
   </div>
   <div id="header_right"> 
       <div class="info_top">
        <div class="username">
         <?php $username=$this->Current_User->getUsername(); 
         if (isset($username) && $username!= '' ){
         if ( $this->Current_User->isHabilitado("BACKUP") ) {
         echo "<a href=\"".site_url()."backup\"> <img src=\"".base_url()."images/img/s_host.png\" width=\"16\" height=\"16\" alt=\"".$this->lang->line("title_backup")."\" title=\"".$this->lang->line("title_backup")."\" /></a>  ";  
         }
         echo $username." | ";?>
         <a accesskey="0" href="<?php echo site_url()."home/logout";?>"><?php echo $this->lang->line("salir");?></a>
         <?php } ?>
          
         </div>
         <div class="fecha">
         <?php echo date("d/m/Y");?>  
         </div>
       </div>
       <div class="recuadro3">
        
          <form name="reloj24">
          <input type="text" class="hora" size="8" name="digitos">
          </form>
          
          </div>
      
          
        
         <div class="estadistica_header">
       <a target="_blank" href="<?php echo base_url()."Tutorial_Fletpack.pdf";?>"><img src="<?php echo base_url()."images/help.png";?>" width="16" height="16" alt="ayuda" title="ayuda"/></a>
        Viajes 
        Total: <?php echo $this->flete_model->getReservasTotal();?>
        Cerrados: <?php echo $this->flete_model->getViajesRealizados();?>
        
        Cancelados:<?php echo $this->flete_model->getViajesCancelados();?>
       </div >
         
   </div>
   <?php if (isset($username) && $username!= '' ) {  ?>
   <div id="menu">
      <ul id="listado" >
          <li><a accesskey="1" href="<?php echo site_url();?>"><?php echo "1 - ".$this->lang->line("panel");?></a> | </li>
          <li><a accesskey="2" href="<?php echo site_url()."cliente";?>"><?php echo "2 - ".$this->lang->line("clientes");?></a> | </li>
          <li><a accesskey="3" href="<?php echo site_url()."chofer";?>"><?php echo "3 - ".$this->lang->line("moviles");?></a> | </li>
          <li><a accesskey="4" href="<?php echo site_url()."reserva";?>"><?php echo "4 - ".$this->lang->line("reservas");?></a> | </li>
          <li><a accesskey="5" href="<?php echo site_url()."base";?>"><?php echo "5 - ".$this->lang->line("bases");?></a> | </li>
          <li><a accesskey="6" href="<?php echo site_url()."viaje";?>"><?php echo "6 - ".$this->lang->line("viajes");?></a> | </li>
          <li><a accesskey="7" href="<?php echo site_url()."usuario";?>"><?php echo "7 - ".$this->lang->line("usuarios");?></a> | </li>
          <li><a accesskey="8" href="<?php echo site_url()."costo";?>"><?php echo "8 - ".$this->lang->line("title_seteos");?></a> | </li>
          <li><a accesskey="9" href="<?php echo site_url()."reporte";?>"><?php echo "9 - ".$this->lang->line("reportes");?></a> | </li>
          <li><a href="<?php echo site_url()."localidad";?>"><?php echo "L - ".$this->lang->line("localidades");?></a> | </li>
          <li><a href="<?php echo site_url()."search";?>"><?php echo $this->lang->line("button_search");?></a> | </li>
          
          
        </ul>
   </div>
   <?php }?>
</div>



<div id="header">
  
  <div id="header_left">
   <a class="header_link" href="<?php echo site_url();?>">  <?php echo $this->lang->line("name_empresa");?>  </a>
   </div>
   <div id="header_right"> 
       <div class="info_top">
        <div class="username">
         <?php $username=$this->Current_User->getUsername(); if (isset($username)) echo $username;?>
         <a accesskey="0" href="<?php echo site_url()."home/logout";?>"><?php echo $this->lang->line("salir");?></a>
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
      <ul id="listado">
          <li><a accesskey="1" href="<?php echo site_url();?>"><?php echo "1 - ".$this->lang->line("panel");?></a></li>
          <li><a accesskey="2" href="<?php echo site_url()."reporte/recaudacion";?>"><?php echo "2 - ".$this->lang->line("title_reporte_viajes");?></a></li>
          <li><a accesskey="3" href="<?php echo site_url()."reporte/recaudacionxday";?>"><?php echo "3 - ".$this->lang->line("recaudacionxday");?></a></li>
          <li><a accesskey="4" href="<?php echo site_url()."reporte/recaudaciongral";?>"><?php echo "4 - ".$this->lang->line("recaudaciongral");?></a></li>
          <li><a accesskey="5" href="<?php echo site_url()."reporte/ctaCliente";?>"><?php echo "5 - ".$this->lang->line("cta_x_cliente");?></a></li>
          <li><a accesskey="6" href="<?php echo site_url()."reporte/seguro";?>"><?php echo "6 - Seguro";?></a></li>
          <li><a accesskey="7" href="<?php echo site_url()."reporte/movil";?>"><?php echo "7 - Moviles";?></a></li>
          <li><a accesskey="8" href="<?php echo site_url()."reporte/ranking";?>"><?php echo "8 - Ranking";?></a></li>
          <li><a accesskey="9" href="<?php echo site_url()."reporte/rankingCliente";?>"><?php echo "9 - Ranking Cliente";?></a></li>
          <li><a accesskey="u" href="<?php echo site_url()."reporte/tiempoUltimoViaje";?>"><?php echo "U - ultimo viaje";?></a></li>
          <li><a accesskey="s" href="<?php echo site_url()."reporte/sesiones";?>"><?php echo "S - Sesiones";?></a></li>
        </ul>
   </div>
   <?php }?>
</div>



<div id="header">
  
  <div class="header_left col-md-2">
   <a class="header_link" href="<?php echo site_url();?>">  <?php echo $this->lang->line("name_empresa");?>  </a>
   </div>
   <div class="col-md-10"> 

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
          <li class="li-menu">
              <a accesskey="1" href="<?php echo site_url();?>"><?php echo "1 - ".$this->lang->line("panel");?></a> 
          | </li>
          <li class="li-menu"><a accesskey="2" href="<?php echo site_url()."cliente";?>"><?php echo "2 - ".$this->lang->line("clientes");?></a> | </li>
          <li class="li-menu"><a accesskey="3" href="<?php echo site_url()."chofer";?>"><?php echo "3 - ".$this->lang->line("moviles");?></a> | </li>
          <li class="li-menu"><a accesskey="4" href="<?php echo site_url()."reserva";?>"><?php echo "4 - ".$this->lang->line("reservas");?></a> | </li>

          <li class="li-menu">

             <div class="dropdown">
                  <a accesskey="5" id="dBase" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo "5 - ".$this->lang->line("bases");?>
                    <span class="caret"></span>
                  </a> |
                      <ul class="dropdown-menu" aria-labelledby="dBase">
                        <li><a href="<?php echo site_url()."base";?>"><?php echo $this->lang->line("bases");?></a></li>
                        <li><a  href="<?php echo site_url()."base/ingresaBase";?>"><?php echo $this->lang->line("ingresa_vehiculo");?></a></li>
                        <li><a  href="<?php echo site_url()."base/egresaBase";;?>"><?php echo $this->lang->line("egresa_vehiculo");?></a></li>
                        <li><a href="<?php echo site_url()."base/ordenaBase";;?>"><?php echo $this->lang->line("ordena_vehiculo");?></a></li>
                        <li><a href="<?php echo site_url()."base/cambiaBase";;?>"><?php echo $this->lang->line("cambia_vehiculo");?></a></li>
                        
                        <li><a href="<?php echo site_url()."base/nueva";?>"><?php echo $this->lang->line("nueva_bases");?></a></li>
                        <li><a href="<?php echo site_url()."base/mod";?>"><?php echo $this->lang->line("mod_bases");?></a></li>
                      </ul>
                  </div>

          </li>
          <li class="li-menu"><a accesskey="6" href="<?php echo site_url()."viaje";?>"><?php echo "6 - ".$this->lang->line("viajes");?></a> | </li>
          <li class="li-menu"><a accesskey="7" href="<?php echo site_url()."usuario";?>"><?php echo "7 - ".$this->lang->line("usuarios");?></a> | </li>
          <li class="li-menu">
              <div class="dropdown">
                  <a accesskey="8" id="dPrecio" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo "8 - ".$this->lang->line("title_costos");?>
                    <span class="caret"></span>
                  </a> |
                      <ul class="dropdown-menu" aria-labelledby="dPrecio">
                          
                          <li><a accesskey="2" href="<?php echo site_url()."costo";?>"><?php echo $this->lang->line("precio_hora");?></a></li>
                          <li><a accesskey="3" href="<?php echo site_url()."costo/seguro";?>"><?php echo $this->lang->line("precio_seguro");?></a></li>
                          <li><a accesskey="4" href="<?php echo site_url()."categoria";?>"><?php echo $this->lang->line("title_categorias");?></a></li>
                          <li><a accesskey="5" href="<?php echo site_url()."costo/comision";?>"><?php echo $this->lang->line("title_comision");?></a></li>
                      </ul>
                  </div>

         </li>
          <li class="li-menu">
                 <div class="dropdown">
                  <a accesskey="9" id="dLabel" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo "9 - ".$this->lang->line("reportes");?>
                    <span class="caret"></span>
                  </a> |
                      <ul class="dropdown-menu" aria-labelledby="dLabel">
                        <li><a accesskey="2" href="<?php echo site_url()."reporte/recaudacion";?>"><?php echo $this->lang->line("title_reporte_viajes");?></a></li>
                        <li><a accesskey="3" href="<?php echo site_url()."reporte/recaudacionxday";?>"><?php echo $this->lang->line("recaudacionxday");?></a></li>
                        <li><a accesskey="4" href="<?php echo site_url()."reporte/recaudaciongral";?>"><?php echo $this->lang->line("recaudaciongral");?></a></li>
                        <li><a accesskey="5" href="<?php echo site_url()."reporte/ctaCliente";?>"><?php echo $this->lang->line("cta_x_cliente");?></a></li>
                        <li><a accesskey="6" href="<?php echo site_url()."reporte/seguro";?>"><?php echo "Seguro";?></a></li>
                        <li><a accesskey="7" href="<?php echo site_url()."reporte/movil";?>"><?php echo "Moviles";?></a></li>
                        <li><a accesskey="8" href="<?php echo site_url()."reporte/ranking";?>"><?php echo "Ranking";?></a></li>
                        <li><a accesskey="9" href="<?php echo site_url()."reporte/rankingCliente";?>"><?php echo "Ranking Cliente";?></a></li>
                        <li><a accesskey="u" href="<?php echo site_url()."reporte/tiempoUltimoViaje";?>"><?php echo "ultimo viaje";?></a></li>
                        <li><a accesskey="s" href="<?php echo site_url()."reporte/sesiones";?>"><?php echo "Sesiones";?></a></li>
                      </ul>
                  </div>
          </li>
          <li class="li-menu"><a href="<?php echo site_url()."localidad";?>"><?php echo "L - ".$this->lang->line("localidades");?></a> | </li>
          <li class="li-menu"><a href="<?php echo site_url()."search";?>"><?php echo $this->lang->line("button_search");?></a> | </li>
          
          
        </ul>
   </div>
   <?php }?>
</div>



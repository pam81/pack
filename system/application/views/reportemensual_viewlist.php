

<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("title_list_viaje"). " Rendición Mensual";?></h2> 
  <div class="link_reporte_rendir">  <a class="btn btn-primary" href="<?php echo site_url()."caja";?>">A cuenta</a></div>
  
  </div>
   <hr class="separador">
   
		 <form name="formsearch" class="form-inline formMensual" id="formsearch" method="post" action="<?php echo site_url()."reporte/mensual";?>" 
     onsubmit="return flete.validarMensual();">  
        <div class="form-group">
			  <label> Seleccion Mes</label>
		    <select name="month" tabindex="1" id="month" class="form-control">
		      <option value="1" <?php if ($month == 1) {echo "selected";} ?>>Enero</option>
          <option value="2" <?php if ($month == 2) {echo "selected";} ?>>Febrero</option>
          <option value="3" <?php if ($month == 3) {echo "selected";} ?>>Marzo</option>
          <option value="4" <?php if ($month == 4) {echo "selected";} ?>>Abril</option>
          <option value="5" <?php if ($month == 5) {echo "selected";} ?>>Mayo</option>
          <option value="6" <?php if ($month == 6) {echo "selected";} ?>>Junio</option>
          <option value="7" <?php if ($month == 7) {echo "selected";} ?>>Julio</option>
          <option value="8" <?php if ($month == 8) {echo "selected";} ?>>Agosto</option>
          <option value="9" <?php if ($month == 9) {echo "selected";} ?>>Septiembre</option>
          <option value="10" <?php if ($month == 10) {echo "selected";} ?>>Octubre</option>
          <option value="11" <?php if ($month == 11) {echo "selected";} ?>>Noviembre</option>
          <option value="12" <?php if ($month == 12) {echo "selected";} ?>>Diciembre</option>
		   </select>
		   
	
		    </div>
		     <div class="form-group">
        <label> Seleccione Año</label>

           
          <input type="text" class="form-control" name="year" id="year" tabindex="2" size="4" maxsize="4" value="<?php echo set_value("year",$year);?>" />
   
		    </div>
       <div class="form-group">
        <label> Seleccione Movil</label>
       
           
          <input type="text" class="form-control" name="movil" id="movil" tabindex="3" size="10" maxsize="10" value="<?php echo set_value("movil",$movil);?>" />
   
       </div>
		  
			<div class="form-group">
			<button type="submit" tabindex="4" name="search" class="btn btn-primary" ><?php echo $this->lang->line("button_search");?></button>
		  </div>
		</form>	
		 
  <input type="hidden" name="url" id="url" value="<?php echo site_url()?>">
  <table  class="tablelist "  >
   <thead>
    <tr>
        <th>Día</th>
        <th>Recaud.</th>
        <th>Porcentaje</th>
        <th>Radio</th>
        <th>P Movil</th>
        <th>P Agencia</th>
        <th>C/ CO</th>
        <th>Peón</th>
        <th>Peaje</th>
        <th>Estacionam.</th>
        <th>Mudanza</th>
        <th>IVA</th>
        <th>ART</th>
        <th>Saldo</th>
        
    </tr>    
   </thead>
   <tbody>
     <?php 
     
      
         foreach($listado as $k=>$v) {
          
         ?> 
          <tr class="modotr">
            <td class="view_viajes" data-dia="<?php echo $k?>" ><?php echo $k; ?></td>
            <td><?php echo $v["recauda"]; ?></td>
            <td><?php echo $v["porcentaje"]; ?></td>
            <td><?php echo $v["radio"]; ?></td>
            <td><?php echo $v["pmovil"]; ?></td>
            <td><?php echo $v["pagencia"]; ?></td>
            <td><?php echo $v["cco"]; ?></td>
            <td><?php echo $v["peon"]; ?></td>
            <td><?php echo $v["peaje"]; ?></td>
            <td><?php echo $v["cochera"]; ?></td>
            <td><?php echo $v["mudanza"]; ?></td>
            <td><?php echo $v["iva"]; ?></td>
            <td><?php echo $v["art"]; ?></td>
            <td><?php echo $v["saldo"]; ?></td>
            

          </tr> 
         
         
       
    <?php } ?>
   </tbody>
  </table>
  
	
	
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">viajes del movil <span id="modal_movil"></span> para la fecha <span id="modal_fecha"></span></h4>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-bordered">
          <thead>
              <th>ID</th>
              <th>Origen</th>
              <th>Destino</th>
              <th>Subtotal</th>
              <th>Espera</th>
              <th>IVA</th>
              <th>Peon</th>
              <th>Peaje</th>
              <th>Estacio.</th>
              <th>Art</th>
              <th>Contado</th>
          </thead>
          <tbody id="list_viajes">
            

          </tbody>
        </table>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
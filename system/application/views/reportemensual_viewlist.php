

<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("title_list_viaje"). " Rendición Mensual";?></h2> 
  <div class="link_reporte_rendir">  <a href="<?php echo site_url()."caja";?>">A cuenta</a></div>
  
  </div>
   <hr class="separador">
    <div class="select-bar">
		 <form name="formsearch" id="formsearch" method="post" action="<?php echo site_url()."reporte/mensual";?>" 
     onsubmit="return flete.validarMensual();">  
      
			  <label> Seleccion Mes
		    <select name="month" tabindex="1" id="month">
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
		   
	
		    </label>
		  
        <label> Seleccione Año

           
          <input type="text" name="year" id="year" tabindex="2" size="4" maxsize="4" value="<?php echo set_value("year",$year);?>" />
   
		    </label>

        </label>
      
        <label> Seleccione Movil
       
           
          <input type="text" name="movil" id="movil" tabindex="3" size="10" maxsize="10" value="<?php echo set_value("movil",$movil);?>" />
   
        </label>
		  
			<label>
			<input type="submit" tabindex="4" name="search" value="<?php echo $this->lang->line("button_search");?>" />
			</label>
		</form>	
		  </div>

  <table  class="tablelist "  >
   <thead>
    <tr>
        <th>Día</th>
        <th>Recaudación</th>
        <th>Porcentaje</th>
        <th>Radio</th>
        <th>P Movil</th>
        <th>P Agencia</th>
        <th>C/ CO</th>
        <th>Peón</th>
        <th>Peaje</th>
        <th>Cochera</th>
        <th>ART</th>
        <th>Saldo</th>
        
    </tr>    
   </thead>
   <tbody>
     <?php 
     
      
         foreach($listado as $k=>$v) {
          
         ?> 
          <tr class="modotr">
            <td><?php echo $k; ?></td>
            <td><?php echo $v["recauda"]; ?></td>
            <td><?php echo $v["porcentaje"]; ?></td>
            <td><?php echo $v["radio"]; ?></td>
            <td><?php echo $v["pmovil"]; ?></td>
            <td><?php echo $v["pagencia"]; ?></td>
            <td><?php echo $v["cco"]; ?></td>
            <td><?php echo $v["peon"]; ?></td>
            <td><?php echo $v["peaje"]; ?></td>
            <td><?php echo $v["cochera"]; ?></td>
            <td><?php echo $v["art"]; ?></td>
            <td><?php echo $v["saldo"]; ?></td>
            

          </tr> 
         
         
       
    <?php } ?>
   </tbody>
  </table>
  
	
	
</div>

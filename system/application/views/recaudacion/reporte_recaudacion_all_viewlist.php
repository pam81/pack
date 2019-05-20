
<div id="content">

  <div id="top-bar">
    <h2> Rendición Todos los Móviles</h2> 
  </div>
  <hr class="separador">
   
  <form name="formsearch" class="form-inline formMensual" 
          id="formsearch" method="post" 
          action="<?php echo site_url()."reporte/rendicionAll";?>" 
    >  
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
      <input type="text" class="form-control" name="year" id="year" 
            tabindex="2" size="4" maxsize="4" value="<?php echo set_value("year",$year);?>" />
    </div>
       
    <div class="form-group">
			<button type="submit" tabindex="4" name="search" class="btn btn-primary" >
        <?php echo $this->lang->line("button_search");?></button>
    </div>
    <div class="form-group">
			<a class="btn btn-primary" style="color: #fff;" href="<?php echo site_url()."reporte/rendicionAllPdf/".$opciones;?>" >Exportar</a>
     
    </div>
  </form>	
		 
  <input type="hidden" name="url" id="url" value="<?php echo site_url()?>">

  <table  class="tablelist "  >
   <thead>
    <tr>
        <th>Al Día</th>
        <th>Movil</th> 
        <th>Saldo</th>

    </tr>    
   </thead>
   <tbody>
     <?php 
     
      
         foreach($listado as $v) {
          
          $fecha = strtotime($v->fecha);
         ?> 
          <tr class="modotr">
            <td class="view_viajes" data-dia="<?php echo date("d",$fecha)?>" >
              <?php echo date("d-m-Y",$fecha); ?>
            </td>
            <td><?php echo $v->movil; ?></td>
            <td><?php echo $v->saldo; ?></td>
          
          </tr> 
    <?php } ?>
   </tbody>
  </table>
</div>

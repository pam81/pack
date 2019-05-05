<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
    
    if (code.toString() == 78 && e.altKey ) //alt+n agregar nuevo cliente
       document.location.href='<?php echo site_url()."caja/add";?>';

    if (code.toString() == 66 && e.altKey ) //alt+b buscar cliente
       $("#searchfield").focus();               
    
});



function searching(e)
{
  var tecla = (document.all) ? e.keyCode : e.which;
  if (tecla.toString() == 13)
     document.getElementById("search").focus();  
}

</script>



<div id="content">

  <div id="top-bar">
  <a href="<?php echo site_url()."caja/add";?>" accesskey="n" class="button"><?php echo $this->lang->line("title_add_new");?> </a>
  <h2> Listado Cuenta Chofer</h2>
  
  </div>
   <hr class="separador">
    <div class="select-bar">
		 <form name="formsearch" id="formsearch" method="post" action="<?php echo site_url()."caja";?>" onsubmit="return flete.validarSearch(3);">  
        <label> <?php echo mb_convert_case($this->lang->line("title_movil"),MB_CASE_TITLE,"utf-8");?>
        <input type="text" tabindex="1" name="movil" id="searchfield" value="<?php if (isset($movil)) echo $movil;?>" onkeypress="searching(event); " />
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
       </label>
      
      <label>
      <input type="submit" tabindex="4" name="search" value="<?php echo $this->lang->line("button_search");?>" />
      </label>
		</form>	
		  </div>
   <script type="text/javascript">
	jQuery.tableNavigation();
</script>
  <table  class="tablelist  "  >
   <thead>
    <tr>
        <th width="30"> <?php echo mb_convert_case("fecha",MB_CASE_UPPER,"UTF-8");?> </th>
        
        <th width="80"> <?php echo mb_convert_case($this->lang->line("title_descripcion"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="80"> <?php echo mb_convert_case($this->lang->line("title_monto"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="80"> <?php echo mb_convert_case($this->lang->line("created_by"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="80"> <?php echo mb_convert_case($this->lang->line("title_type"),MB_CASE_UPPER,"UTF-8");?> </th>
    </tr>    
   </thead>
   <tbody>
     <?php 
          
         foreach($cajas as $u) {
         
         ?>
       <tr class="modotr <?php if ($u->borrado==1) echo "borrado";?>">
         <td> <?php 
         $year=substr($u->created_at,0,4);
          $mes=substr($u->created_at,4,2);
          $dia=substr($u->created_at,6,2);
          
          
         echo $dia."-".$mes."-".$year;?> </td>
          <td> <?php  echo $u->descripcion;?></td>
         
        
         <td> <?php echo $u->monto;?></td>
         <td> <?php echo $u->created_by;?></td>
         <td>
           <?php 
            if ($u->tipo == 1){
              echo "PAGA AGENCIA";
            }
            if ($u->tipo == 2){
              echo "PAGA MOVIL";

            }
            if ($u->tipo == 3){
              echo "IVA";
            }
            if ($u->tipo == 4){
              echo "AJUSTE";
            }
           ?>
         </td>
        
        
         
       </tr>
     <?php   }?>
   </tbody>
  </table>
  
  
</div>

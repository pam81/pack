<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
    
    if (code.toString() == 66 && e.altKey ) //alt+b buscar token
       $("#searchfield").focus();               
    
});



function searching(e)
{
  var tecla = (document.all) ? e.keyCode : e.which;
  if (tecla.toString() == 13)
  { 
    document.getElementById("search").focus();       
  }
}

</script>





<div id="content">

  <div id="top-bar">
  
  <h2> Listado de Tokens </h2>
  
  </div>
   <hr class="separador">
    <div class="select-bar">
		  <!--<form name="formsearch" id="formsearch" method="get" action="<?php echo site_url()."token/listado";?>" >  
 		     <label> <?php echo mb_convert_case("Máquina",MB_CASE_TITLE,"utf-8");?>
		      <input type="text" name="maquina" id="maquina" 
            value="<?php if (isset($maquina)) echo set_value("maquina",$maquina);?>" maxlength="100"  />
		    </label>
        <label>
			    <input type="submit" name="search" id="search" value="<?php echo $this->lang->line("button_search");?>" />
  			</label>
		  </form>	-->
    </div>
    <script type="text/javascript">
	    jQuery.tableNavigation();
    </script>
  <table  class="tablelist navigateable myTable02"  >
   <thead>
    <tr>
        <th width="80"> <?php echo mb_convert_case("máquina",MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="60"> <?php echo mb_convert_case("creado",MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="60"> <?php echo mb_convert_case("expira",MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="25"> <?php echo mb_convert_case($this->lang->line("title_active"),MB_CASE_UPPER,"UTF-8");?> </th>
    </tr>    
   </thead>
   <tbody>
     <?php 
          
         foreach($tokens as $u) {?>
       <tr class="modotr" >
         <td > <?php echo mb_convert_case($u->maquina,MB_CASE_TITLE,"utf-8");?> </td>
         <td > <?php echo date("d-m-Y",strtotime($u->created_at)); ?> </td>
         <td > <?php  echo date("d-m-Y",strtotime($u->expired_at)); ?>  </td>
         <td > <?php  if (strtotime($u->expired_at) > strtotime('today')){
                       echo '<a href="'.site_url()."token/desactivar/".$u->id.'/'.$this->uri->segment(3).'">Activado</a>';     
                      }else{
                        echo 'Desactivado'; 
                      }   ?>   </td>
       </tr>
     <?php   }?>
   </tbody>
  </table>
  
  <div class="link_pages">
					<?php echo $this->pagination->create_links(); ?>
	</div>
</div>
<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
    
    if (code.toString() == 78 && e.altKey ) //alt+n agregar nuevo cliente
       document.location.href='<?php echo site_url()."chofer/add";?>';

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
  <a href="<?php echo site_url()."chofer/add";?>" accesskey="n" class="button"><?php echo $this->lang->line("title_add_new");?> </a>
  <h2> <?php echo $this->lang->line("title_list_choferes");?></h2>
  
  </div>
   <hr class="separador">
    <div class="select-bar">
		 <form name="formsearch" id="formsearch" method="post" action="<?php echo site_url()."chofer/search";?>" onsubmit="return flete.validarSearchChofer();">  
        <label> <?php echo mb_convert_case($this->lang->line("title_movil"),MB_CASE_TITLE,"utf-8");?>
		    <input type="text" tabindex="1" name="searchfield" id="searchfield" value="<?php if (isset($search)) echo set_value("searchfield",$search);?>" onkeypress="searching(event); " />
		    </label>
		    <label> <?php echo mb_convert_case($this->lang->line("title_name"),MB_CASE_TITLE,"utf-8");?>
		    <input type="text" tabindex="2" name="name" id="name" value="<?php if(isset($name) && $name!=0) echo set_value("name",$name);?>"  />
		    </label>
		    <label> <?php echo mb_convert_case($this->lang->line("title_patente"),MB_CASE_TITLE,"utf-8");?>
		    <input type="text" tabindex="3" name="patente" id="patente" value="<?php if (isset($patente) && $patente!=0) echo set_value("patente",$patente);?>"  />
		    </label>
        <label>
			<input type="submit" tabindex="4" name="search" value="<?php echo $this->lang->line("button_search");?>" />
			</label>
		</form>	
		  </div>
   <script type="text/javascript">
	jQuery.tableNavigation();
</script>
  <table  class="tablelist navigateable myTable02 "  >
   <thead>
    <tr>
        <th width="30"> <?php echo mb_convert_case($this->lang->line("title_movil"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="80"> <?php echo mb_convert_case($this->lang->line("title_descripcion"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="80"> <?php echo mb_convert_case($this->lang->line("title_name"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="80"> <?php echo mb_convert_case($this->lang->line("title_phone"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="100"> <?php echo mb_convert_case($this->lang->line("title_address"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="130"> <?php echo mb_convert_case($this->lang->line("title_observacion_chofer"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="130"> <?php echo mb_convert_case($this->lang->line("title_observacion_movil"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="25"> <?php echo mb_convert_case($this->lang->line("title_mod"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="25"> <?php echo mb_convert_case($this->lang->line("title_active"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="25"> <?php echo mb_convert_case($this->lang->line("title_del"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="25"> <?php echo mb_convert_case($this->lang->line("title_bloqueado"),MB_CASE_UPPER,"UTF-8");?> </th>
        
    </tr>    
   </thead>
   <tbody>
     <?php 
          
         foreach($choferes as $u) {
         
         ?>
       <tr class="modotr <?php if ($u->borrado==1) echo "borrado";?>">
         <td> <?php  echo $u->movil;?></td>
          <td> <?php  echo $u->marca;?></td>
         <td> <?php echo mb_convert_case($u->name." ".$u->lastname,MB_CASE_TITLE,"utf-8");?> </td>
         <td> <?php 
                echo $u->telefono."<br>";
                echo $u->celular."<br>";
                echo $u->radio;
             ?>   
         </td>
         <td> <?php echo $u->address." - ".$u->localidad_name;?></td>
         <td> <?php echo $u->observacion;?></td>
         <td> <?php echo $u->observacion_movil;?></td>
         <td> <a href="<?php echo site_url()."chofer/mod/$u->id/".$this->uri->segment(3);?>" class="activation"> <img src="<?php echo base_url()."images/img/edit-icon.gif";?>" width="16" height="16" alt="modificar" title="modificar" /> </a>  </td>
         <td> <?php if ($u->active == 1) {?> 
              <a href="<?php echo site_url()."chofer/noactive/$u->id/".$this->uri->segment(3);?>"> <img src="<?php echo base_url()."images/img/tilde.png";?>" width="16" height="16" alt="activo" title="activo" /> </a>
              <?php } else {?>
              <a href="<?php echo site_url()."chofer/active/$u->id/".$this->uri->segment(3);?>"> <img src="<?php echo base_url()."images/img/resta.png";?>" width="16" height="16" alt="no_activo" title="no activo" /> </a>
              <?php }?>  
          </td>
          
          <td> 
          <?php if ($u->borrado != 1){ ?>
          <a href="<?php echo site_url()."chofer/del/$u->id/".$this->uri->segment(3);?>" onclick=" return confirm('<?php echo $this->lang->line("ask_del_chofer");?>') ;" > <img src="<?php echo base_url()."images/img/hr.gif";?>" width="16" height="16" alt="borrar" title="borrar"/> </a> 
          <?php }
            else{
          ?>
          <a href="#" onclick="flete.reactivarMovil('<?php echo site_url()."chofer/reactivar/$u->id/"; ?>','<?php echo $u->exmovil;?>') " > <img src="<?php echo base_url()."images/img/add-icon.gif";?>" width="16" height="16" alt="reactivar" title="reactivar" /> </a>
          <?php }?>
          </td>
           <td>
           <?php if ($u->bloqueado == 1){ ?>
           <a href="<?php echo site_url()."chofer/unlock/$u->id/".$this->uri->segment(3);?>" onclick=" return confirm('<?php echo $this->lang->line("ask_debloquear_movil");?>') ;" > <img src="<?php echo base_url()."images/img/lock.png";?>" width="16" height="16" alt="bloqueado" title="bloqueado por <?php echo $u->bloqueado_by;?>" /> </a>
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

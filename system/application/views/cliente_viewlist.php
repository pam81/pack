<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
    
    if (code.toString() == 78 && e.altKey ) //alt+n agregar nuevo cliente
       document.location.href='<?php echo site_url()."cliente/add";?>';

    if (code.toString() == 66 && e.altKey ) //alt+b buscar cliente
       $("#searchfield").focus();               
    
});



function searching(e)
{
  var tecla = (document.all) ? e.keyCode : e.which;
  if (tecla.toString() == 13)
  { 
       
           //document.getElementById("formsearch").submit();
           document.getElementById("search").focus();       
    
       
  }
}

</script>





<div id="content">

  <div id="top-bar">
  <a href="<?php echo site_url()."cliente/add";?>" accesskey="n" class="button btn btn-primary"><?php echo $this->lang->line("title_add_new");?> </a>
  <h2> <?php echo $this->lang->line("title_list_cliente");?></h2>
  
  </div>
   <hr class="separador">
    <div class="select-bar">
		 <form name="formsearch" id="formsearch" method="post" action="<?php echo site_url()."cliente/search";?>" >  
        <label> <?php echo mb_convert_case($this->lang->line("title_phone"),MB_CASE_TITLE,"utf-8");?>
		    <input type="text" name="searchfield" id="searchfield" value="<?php if (isset($search)) echo set_value("searchfield",$search);?>" maxlength="8" onkeypress="searching(event); " />
		    </label>
		    <label> <?php echo mb_convert_case($this->lang->line("title_name"),MB_CASE_TITLE,"utf-8");?>
		    <input type="text" name="name" id="name" value="<?php if (isset($name)) echo set_value("name",$name);?>" maxlength="100"  />
		    </label>
		     <label> <?php echo mb_convert_case($this->lang->line("title_address"),MB_CASE_TITLE,"utf-8");?>
		    <input type="text" name="direccion" id="direccion" value="<?php if (isset($dir)) echo set_value("direccion",$dir);?>" maxlength="100"  />
		    </label>
        <label>
			<button type="submit" class="btn btn-primary" name="search" id="search"> <?php echo $this->lang->line("button_search");?> </button>
			</label>
		</form>	
		  </div>
   <script type="text/javascript">
	jQuery.tableNavigation();
</script>
  <table  class="tablelist navigateable myTable02"  >
   <thead>
    <tr>
        <th width="80"> <?php echo mb_convert_case($this->lang->line("title_name"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="60"> <?php echo mb_convert_case($this->lang->line("title_phone"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="200"> <?php echo mb_convert_case($this->lang->line("title_address"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="200"> <?php echo mb_convert_case($this->lang->line("title_entrecalles"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="200"> <?php echo mb_convert_case($this->lang->line("title_observacion"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="25"> <?php echo mb_convert_case($this->lang->line("title_ctacte"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="25"> <?php echo mb_convert_case($this->lang->line("title_active"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="25"> <?php echo mb_convert_case($this->lang->line("title_mod"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="25"> <?php echo mb_convert_case($this->lang->line("title_del"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="25"> <?php echo mb_convert_case($this->lang->line("title_bloqueado"),MB_CASE_UPPER,"UTF-8");?> </th>
        
    </tr>    
   </thead>
   <tbody>
     <?php 
          
         foreach($clientes as $u) {?>
       <tr class="modotr <?php if ($u->borrado==1) echo "borrado";?>" >
         <td > <?php echo mb_substr(mb_convert_case($u->name,MB_CASE_TITLE,"utf-8"),0,10);?> </td>
         <td > <?php 
            
          
          foreach($phones as $p)
          {
             if ($p->clienteid == $u->id)
               echo mb_substr($p->phone,0,8);
          }
                     
          ?></td>
         <td > <?php echo mb_substr($u->address,0,30);?></td>
         <td > <?php echo mb_substr($u->entrecalles,0,30);?> </td>
         <td > <?php echo mb_substr($u->observaciones,0,30);?> </td>
         <td> <?php if ($u->ctacte == 's'){?>
                <a href="<?php echo site_url()."cliente/noctacte/$u->id/".$this->uri->segment(3);?>"> <img src="<?php echo base_url()."images/img/tilde.png";?>" width="16" height="16" alt="activo" title="cta.cte." /> </a>
              <?php } else {?>
                <a href="<?php echo site_url()."cliente/ctacte/$u->id/".$this->uri->segment(3);?>"> <img src="<?php echo base_url()."images/img/resta.png";?>" width="16" height="16" alt="no_activo" title="no cta.cte" /> </a>         
                <?php }?>
          </td>
         <td> <?php if ($u->active == 1) {?> 
              <a href="<?php echo site_url()."cliente/noactive/$u->id/".$this->uri->segment(3);?>"> <img src="<?php echo base_url()."images/img/tilde.png";?>" width="16" height="16" alt="activo" title="activo" /> </a>
              <?php } else {?>
              <a href="<?php echo site_url()."cliente/active/$u->id/".$this->uri->segment(3);?>"> <img src="<?php echo base_url()."images/img/resta.png";?>" width="16" height="16" alt="no_activo" title="no activo" /> </a>
              <?php }?>  
          </td>
          <td> <a href="<?php echo site_url()."cliente/mod/$u->id/".$this->uri->segment(3);?>" class="activation"> <img src="<?php echo base_url()."images/img/edit-icon.gif";?>" width="16" height="16" alt="modificar" title="modificar cliente" /> </a>  </td>
          <td> 
          <?php if ($u->borrado != 1){?>
          <a href="<?php echo site_url()."cliente/del/$u->id/".$this->uri->segment(3);?>" onclick=" return confirm('<?php echo $this->lang->line("ask_del_cliente");?>') ;" > <img src="<?php echo base_url()."images/img/hr.gif";?>" width="16" height="16" alt="borrar" title="borrar cliente" /> </a> 
          <?php } else{ ?>
          <a href="<?php echo site_url()."cliente/undel/$u->id/".$this->uri->segment(3);?>" onclick=" return confirm('<?php echo $this->lang->line("ask_undel_cliente");?>') ;" > <img src="<?php echo base_url()."images/img/undo.png";?>" width="16" height="16" alt="borrar" title="recuperar cliente" /> </a>
          <?php } ?>
          </td>
          <td>
           <?php if ($u->bloqueado == 1){ ?>
           <a href="<?php echo site_url()."cliente/unlock/$u->id/".$this->uri->segment(3);?>" onclick=" return confirm('<?php echo $this->lang->line("ask_debloquear_cliente");?>') ;" > <img src="<?php echo base_url()."images/img/lock.png";?>" width="16" height="16" alt="bloqueado" title="bloqueado por <?php echo $u->bloqueado_by;?>" /> </a>
           <?php }?>
          </td>
       </tr>
     <?php   }?>
   </tbody>
  </table>
  
  <div class="link_pages pagination">
					<?php echo $this->pagination->create_links(); ?>
	</div>
</div>

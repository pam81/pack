<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
    
    if (code.toString() == 78 && e.altKey ) //alt+n agregar nuevo usuario
       document.location.href='<?php echo site_url()."usuario/add";?>';

    if (code.toString() == 66 && e.altKey ) //alt+b buscar usuario
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
  <a href="<?php echo site_url()."usuario/add";?>" accesskey="n" class="button btn btn-primary"><?php echo $this->lang->line("title_add_new");?> </a>
  <h2> <?php echo $this->lang->line("title_list_usuario");?></h2>
  
  </div>
   <hr class="separador">
    <div class="select-bar">
    <form name="formsearch" id="formsearch" method="post" action="<?php echo site_url()."usuario/search";?>" onsubmit="return flete.validarSearch();">
		    <label> <?php echo mb_convert_case($this->lang->line("title_username"),MB_CASE_TITLE,"utf-8");?>
		    <input type="text" name="searchfield" id="searchfield" value="<?php if (isset($search)) echo set_value("searchfield",$search);?>" onkeypress="searching(event); "/>
		    </label>
		    <label>
			<button type="submit" name="search" class="btn btn-primary"><?php echo $this->lang->line("button_search");?></button>
			</label>
		</form>	
		  </div>
   <script type="text/javascript">
	jQuery.tableNavigation();
</script>
  <table  class="tablelist navigateable myTable02"  >
   <thead>
    <tr>
        <th> <?php echo mb_convert_case($this->lang->line("title_name"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th> <?php echo mb_convert_case($this->lang->line("title_lastname"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th> <?php echo mb_convert_case($this->lang->line("title_username"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="30"> <?php echo mb_convert_case($this->lang->line("title_mod"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="30"> <?php echo mb_convert_case($this->lang->line("title_active"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="30"> <?php echo mb_convert_case($this->lang->line("title_del"),MB_CASE_UPPER,"UTF-8");?> </th>
        
    </tr>    
   </thead>
   <tbody>
     <?php foreach($admusers as $u) {?>
       <tr class="modotr">
         <td> <?php echo mb_substr(mb_convert_case($u->name,MB_CASE_TITLE,"utf-8"),0,30);?> </td>
         <td> <?php echo mb_substr(mb_convert_case($u->lastname,MB_CASE_TITLE,"utf-8"),0,30);?></td>
         <td> <?php echo mb_substr($u->username,0,30);?></td>
         <td> <a href="<?php echo site_url()."usuario/mod/$u->id/".$this->uri->segment(3);?>" class="activation"> <img src="<?php echo base_url()."images/img/edit-icon.gif";?>" width="16" height="16" alt="modificar" title="modificar"/> </a>  </td>
         <td> <?php if ($u->active == 1) {?> 
              <a  href="<?php echo site_url()."usuario/noactive/$u->id/".$this->uri->segment(3);?>" > <img src="<?php echo base_url()."images/img/tilde.png";?>" width="16" height="16" alt="activo" title="activo" /> </a>
              <?php } else {?>
              <a   href="<?php echo site_url()."usuario/active/$u->id/".$this->uri->segment(3);?>" > <img src="<?php echo base_url()."images/img/resta.png";?>" width="16" height="16" alt="no_activo" title="no activo" /> </a>
              <?php }?>  
          </td>
          
          <td> <a  href="<?php echo site_url()."usuario/del/$u->id/".$this->uri->segment(3);?>" onclick=" return confirm('<?php echo $this->lang->line("ask_del_usuario");?>') ;" > <img src="<?php echo base_url()."images/img/hr.gif";?>" width="16" height="16" alt="borrar" title="borrar" /> </a> </td>
       </tr>
     <?php }?>
   </tbody>
  </table>
  
  <div class="link_pages pagination">
					<?php echo $this->pagination->create_links(); ?>
	</div>
</div>

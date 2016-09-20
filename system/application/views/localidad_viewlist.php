<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
    
    if (code.toString() == 78 && e.altKey ) //alt+n agregar nuevo cliente
       document.location.href='<?php echo site_url()."localidad/add";?>';

    if (code.toString() == 66 && e.altKey ) //alt+b buscar localidad
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
  <a href="<?php echo site_url()."localidad/add";?>" accesskey="n" class="button btn btn-primary"><?php echo $this->lang->line("title_add_new");?> </a>
  <h2> <?php echo $this->lang->line("title_list_localidades");?></h2>
  
  </div>
   <hr class="separador">
    <div class="select-bar">
		 <form name="formsearch" class="form-inline" id="formsearch" method="post" action="<?php echo site_url()."localidad/index";?>" >  
         <label> <?php echo mb_convert_case($this->lang->line("title_provincia"),MB_CASE_TITLE,"utf-8");?>
		    
        <select name="provincia" class="form-control">
         <?php foreach($provincias as $p){
            $select=false;
            if ($p->id == $provincia)
             $select=true;
          ?>
           <option value="<?php echo $p->id;?>" <?php echo set_select("provincia",$p->id,$select);?>  ><?php echo $p->name;?></option>
         <?php }?>
        </select>
		    
		    </label>
        <label> <?php echo mb_convert_case($this->lang->line("title_localidad"),MB_CASE_TITLE,"utf-8");?>
		    
        <input type="text" class="form-control" name="searchfield" id="searchfield" value="<?php  echo set_value("searchfield",$search);?>" maxsize="8" onkeypress="searching(event); " />
		    
		    </label>
		    <label>
		    
			<button type="submit" class="btn btn-primary" name="search" id="search" class="btn btn-primary"><?php echo $this->lang->line("button_search");?></button>
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
        <th width="25"> <?php echo mb_convert_case($this->lang->line("title_mod"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="25"> <?php echo mb_convert_case($this->lang->line("title_del"),MB_CASE_UPPER,"UTF-8");?> </th>
        
        
    </tr>    
   </thead>
   <tbody>
     <?php 
          
         foreach($localidades as $l) {?>
       <tr class="modotr" >
         <td > <?php echo mb_convert_case($l->name,MB_CASE_UPPER,"utf-8");?> </td>
         
          <td> <a href="<?php echo site_url()."localidad/mod/$l->id/".$this->uri->segment(3);?>" class="activation"> <img src="<?php echo base_url()."images/img/edit-icon.gif";?>" width="16" height="16" alt="modificar" title="modificar" /> </a>  </td>
          <td> 
          
          <a href="<?php echo site_url()."localidad/del/$l->id/".$this->uri->segment(3);?>" onclick=" return confirm('<?php echo $this->lang->line("ask_del_localidad");?>') ;" > <img src="<?php echo base_url()."images/img/hr.gif";?>" width="16" height="16" alt="borrar" title="borrar" /> </a> 
          
          </td>
         
       </tr>
     <?php   }?>
   </tbody>
  </table>
  
  <div class="link_pages pagination">
					<?php echo $this->pagination->create_links(); ?>
	</div>
</div>

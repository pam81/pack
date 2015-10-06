<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
    
    if (code.toString() == 78 && e.altKey ) //alt+n agregar nuevo cliente
       document.location.href='<?php echo site_url()."categoria/add";?>';

               
    
});



</script>





<div id="content">

  <div id="top-bar">
  <a href="<?php echo site_url()."categoria/add";?>" accesskey="n" class="button"><?php echo $this->lang->line("title_add_new");?> </a>
  <h2> <?php echo $this->lang->line("title_categorias");?></h2>
  
  </div>
   <hr class="separador">
   <br> <br>
   <script type="text/javascript">
	jQuery.tableNavigation();
</script>
  <table  class="tablelist navigateable myTable02"  >
   <thead>
    <tr>
        <th > <?php echo mb_convert_case($this->lang->line("title_categorias"),MB_CASE_UPPER,"UTF-8");?> </th>
         <th width="25"> <?php echo mb_convert_case($this->lang->line("title_mod"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th width="25"> <?php echo mb_convert_case($this->lang->line("title_del"),MB_CASE_UPPER,"UTF-8");?> </th>
        
    </tr>    
   </thead>
   <tbody>
     <?php 
          
         foreach($categorias as $u) {?>
       <tr class="modotr" >
          <td > <?php echo mb_convert_case($u->name,MB_CASE_TITLE,"utf-8");?> </td>
         
        
        <td> <a href="<?php echo site_url()."categoria/mod/$u->id/".$this->uri->segment(3);?>" class="activation"> <img src="<?php echo base_url()."images/img/edit-icon.gif";?>" width="16" height="16" alt="modificar" title="modificar" /> </a>  </td>
          <td> 
          
          <a href="<?php echo site_url()."categoria/del/$u->id/".$this->uri->segment(3);?>" onclick=" return confirm('<?php echo $this->lang->line("ask_del_categoria");?>') ;" > <img src="<?php echo base_url()."images/img/hr.gif";?>" width="16" height="16" alt="borrar" title="borrar" /> </a> 
          
          </td>
         
      
       </tr>
     <?php   }?>
   </tbody>
  </table>
  
  <div class="link_pages">
					
	</div>
</div>

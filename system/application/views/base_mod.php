
<script type="text/javascript">
	jQuery.tableNavigation();
</script>

<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("mod_bases");?></h2>
  
  </div>
   <hr class="separador">
  
  
  <div>  
  <table class="tablelist navigateable" style="width: 400px; margin-top:10px;"  cellspacing="0" cellpadding="0">
  <thead>
  <tr>
        <th width="200"> <?php echo $this->lang->line("title_base");?> </th>
        <th width="50"> <?php echo $this->lang->line("title_mod");?> </th>
        <th width="50"> <?php echo $this->lang->line("title_del");?> </th>
  </tr>      
  </thead>
  <tbody>
   <?php foreach($bases as $b){ 
   echo "<tr class=\"modotr\">
    <td > $b->name </td> 
    <td> <a href=\"".site_url()."base/modBase/$b->id/".$this->uri->segment(3)."\" class=\"activation\"> <img src=\"".base_url()."images/img/edit-icon.gif\" width=\"16\" height=\"16\" alt=\"modificar\" title=\"modificar\" /> </a>   </td>
    <td> <a href=\"".site_url()."base/del/$b->id/".$this->uri->segment(3)."\" onclick=\" return confirm('".$this->lang->line("ask_del_base")."') ;\" > <img src=\"".base_url()."images/img/hr.gif\" width=\"16\" height=\"16\" alt=\"borrar\" title=\"borrar\" /> </a> </td>
    </tr>";
   
   
   } ?>
   </tbody>
  </table>
 </div>
  
  
</div>

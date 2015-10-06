<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#name").focus();
 });

</script>



<div id="content">

 
   <div id="top-bar">
    <h2> <?php echo $this->lang->line("title_add_usuario");?></h2>
    </div>
   <hr class="separador">
  <form name="formusuario" id="formusuario"  class="form_col" method="post" action="<?php echo site_url()."usuario/addnew";?>" onsubmit="return flete.validarRegistrarUsuario();" >
   <?php echo validation_errors('<p class="error">','</p>'); ?>
   <div class="rowform">
   <div class="rowform-label"> <label for="name"> <?php echo $this->lang->line("title_name"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="1"  accesskey="n" name="name" id="name" value="<?php echo set_value("name");?>" maxsize="100" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="lastname"> <?php echo $this->lang->line("title_lastname"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="2" accesskey="l" name="lastname" id="lastname" value="<?php echo set_value("lastname");?>" maxsize="100" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="username"> <?php echo $this->lang->line("user"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="3" accesskey="u" name="username" id="username" value="<?php echo set_value("username");?>" maxsize="100" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="password"> <?php echo $this->lang->line("password"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="password" tabindex="4" accesskey="p" name="password" id="password" value="<?php echo set_value("password",'');?>" maxsize="100" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="confirm"> <?php echo $this->lang->line("confirm_password"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="password" tabindex="5"  accesskey="c" name="confirm" id="confirm" value="<?php echo set_value("confirm",'');?>" maxsize="100" />
   </div>
   </div>
   <div id="permisos">
   <div class="rowform-permiso">
   <div class="rowform-label"> <label > Todos  </label>
   </div>
    <div class="rowform-input-permiso">
   <input type="checkbox" tabindex="6" id="todos" name="todos"  value="" onclick="flete.allPermisos(this.form);" />
   </div>
   </div>
   <?php 
      $i=7;
    foreach($permisos as $p){
    if ($p->parentid == ''){
    ?>
   <div class="rowform-permiso <?php if($p->reporte == 1) echo "divreporte"; ?>">
   <div class="rowform-label"> <label > <?php echo $p->name;?>  </label>
   </div>
    <div class="rowform-input-permiso">
   <input type="checkbox" tabindex="<?php echo $i;?>"  name="<?php echo "permiso".$p->id;?>"  value="<?php echo $p->id;?>"  />
   </div>
   <?php $subpermiso=$this->flete->getSubpermisos($p->macro);
                 
                  foreach($subpermiso as $s){
                    $i++;
                        
             ?> 
             <div class="divsubpermisos">
                <div class="rowform-label subpermiso"> <label ><?php echo $s->name;?></label></div>
               <div class="rowform-input-permiso">
               <input type="checkbox" tabindex="<?php echo $i;?>" name="<?php echo "permiso".$s->id;?>" value="<?php echo $s->id;?>" />
               </div>
             </div>
            <?php } ?>
   
   </div>
    
   <?php 
     $i++;
     }
   }?>
   </div> <!-- permisos -->
    <div class="rowform">
    <input type="submit" tabindex="<?php echo $i; $i++; ?>" id="send" accesskey="e" name="send" value="<?php echo $this->lang->line("button_send");?>" onclick="return confirm('<?php echo $this->lang->line("ask_add_usuario");?>'); " />
    <input type="reset" tabindex="<?php echo $i;?>" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" />
   </div>
   
  </form>
  
</div>

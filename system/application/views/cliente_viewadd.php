<script type="text/javascript">
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#telefono").focus();
 });


</script>



<div id="content">

 
   <div id="top-bar">
    <h2> <?php echo $this->lang->line("title_add_cliente");?></h2>
    </div>
   <hr class="separador">
  <form name="formusuario" class="form-horizontal col-md-12" method="post" action="<?php echo site_url()."cliente/addnew";?>">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
   <div class="col-md-6">
    <div class="form-group">
      <label for="telefono" class="col-md-4 control-label"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   
      <div class="col-md-8">
        <input type="text" class="form-control" tabindex="1" id="telefono"  name="telefono" value="<?php echo set_value("telefono");?>" maxlength="8" />
      </div>
   </div>
   <div class="form-group">
    <label for="name" class="col-md-4 control-label"> <?php echo $this->lang->line("title_name"); ?>  </label>
    
    <div class="col-md-8">
      <input type="text" class="form-control" tabindex="2" id="name" name="name" value="<?php echo set_value("name");?>" maxsize="250" />
    </div>
   </div>
    <div class="form-group">
    <label for="provincia" class="col-md-4 control-label"> <?php echo $this->lang->line("title_provincia"); ?>  </label>
  
    <div class="col-md-8">
   <select class="selector form-control" tabindex="3" name="provincia" id="provincia" onchange="flete.getLocalidad('<?php echo site_url()."localidad/getLocalidades";?>');" >
   <option value="-1"><?php echo $this->lang->line("select_option");?> </option>
   <?php
     foreach($provincias as $p)
     { 
        $seleccionar=false;
        if($p->id == $this->config->item("provincia"))
          $seleccionar=true;
        
          echo "<option value=\"$p->id\" ".set_select('provincia',$p->id,$seleccionar).">$p->name </option>";
     }
   ?>
   </select>
   </div>
   </div>
   <div class="form-group">
    <label for="localidad" class="col-md-4 control-label"> <?php echo $this->lang->line("title_localidad"); ?>  </label>
   
    <div class="col-md-8">
   <select class="selector form-control" name="localidad" id="localidad" tabindex="4">
   
   <?php
     foreach($localidades as $l)
     {  $seleccionar=false;
        if ($l->id == $this->config->item("localidad"))
         $seleccionar=true;
         
       echo "<option value=\"$l->id\" ".set_select('localidad',$l->id,$seleccionar).">$l->name </option>";
     }
   ?>
   </select>
   </div>
   </div>
   <div class="form-group">
    <label for="calle" class="col-md-4 control-label"> <?php echo $this->lang->line("title_street"); ?>  </label>
   <div class="col-md-8">
   <input type="text" tabindex="5" class="form-control"  id="calle" name="calle" value="<?php echo set_value("calle");?>" maxsize="200" />
   </div>
   </div>
   <div class="form-group">
    <label for="altura" class="col-md-4 control-label"> <?php echo $this->lang->line("title_altura"); ?>  </label>
   <div class="col-md-8">
   <input type="text" tabindex="6" class="form-control" id="altura" name="altura" value="<?php echo set_value("altura");?>" maxsize="10" />
   </div>
   </div>
   <div class="form-group">
    <label for="piso" class="col-md-4 control-label"> <?php echo $this->lang->line("title_piso"); ?>  </label>
   <div class="col-md-8">
   <input type="text" tabindex="7" class="form-control" id="piso"  name="piso" value="<?php echo set_value("piso");?>" maxsize="50" />
   </div>
   </div>
   <div class="form-group">
    <label for="dpto" class="col-md-4 control-label"> <?php echo $this->lang->line("title_dpto"); ?>  </label>
   <div class="col-md-8">
   <input type="text" tabindex="8" class="form-control" id="dpto"  name="dpto" value="<?php echo set_value("dpto");?>" maxsize="10" />
   </div>
   </div>
   <div class="form-group">
   <label for="entrecalle1" class="col-md-4 control-label"> <?php echo $this->lang->line("title_entrecalle1"); ?>  </label>
    <div class="col-md-8">
   <input type="text" tabindex="9" class="form-control" id="entrecalle1"  name="entrecalle1" value="<?php echo set_value("entrecalle1");?>" maxsize="250" />
   </div>
   </div>
   <div class="form-group">
    <label for="entrecalle2" class="col-md-4 control-label"> <?php echo $this->lang->line("title_entrecalle2"); ?>  </label>
   <div class="col-md-8">
   <input type="text" tabindex="10" class="form-control" id="entrecalle2"   name="entrecalle2" value="<?php echo set_value("entrecalle2");?>" maxsize="250" />
   </div>
   </div>
   
   
    <div class="form-group">
    <label for="banner" class="col-md-4 control-label"> <?php echo $this->lang->line("title_banner"); ?>  </label>
   <div class="col-md-8">
   <textarea name="banner" id="banner"  class="form-control" tabindex="11" rows="4" cols="15"><?php echo set_value("banner");?></textarea>
   </div>
   </div>
   <div class="form-group">
    
    <div class="checkbox">
      <label class="col-md-offset-4 control-label">
      <input type="checkbox" tabindex="12" id="showbanner"   name="showbanner" value="1"  /> <?php echo $this->lang->line("title_showbanner"); ?>
        </label>
    </div>
  </div>
   </div>
   <div class="col-md-6">
  
  
   
   <div class="form-group">
    <label for="email" class="col-md-4 control-label"> <?php echo $this->lang->line("title_email"); ?>  </label>
   <div class="col-md-8">
   <input type="text" class="form-control" tabindex="13" id="email"   name="email" value="<?php echo set_value("email");?>" maxsize="250" />
   </div>
   </div>
    <div class="form-group">
    <label for="cuit" class="col-md-4 control-label"> <?php echo $this->lang->line("title_cuit"); ?>  </label>
    <div class="col-md-8">
   <input type="text" class="form-control" tabindex="14" id="cuit"  name="cuit" value="<?php echo set_value("cuit");?>" maxsize="50" />
   </div>
   </div>
    <div class="form-group">
    <label for="iva" class="col-md-4 control-label"> <?php echo $this->lang->line("title_iva"); ?>  </label>
   <div class="col-md-8">
   <select name="iva" id="iva" tabindex="15" class="form-control">
   <option value="-1"><?php echo $this->lang->line("select_option");?> </option>
    <?php 
           foreach($iva as $v)
           echo "<option value=\"$v->id\" ".set_select('iva',$v->id)."  >$v->name</option>";
     ?>      
   </select>
   </div>
   </div>
    <div class="form-group">
   <label for="mensaje" class="col-md-4 control-label"> <?php echo $this->lang->line("title_mensaje"); ?>  </label>
  <div class="col-md-8">
   <input type="text" tabindex="16" class="form-control"  id="mensaje"  name="mensaje" value="<?php echo set_value("mensaje");?>" maxsize="250" />
   </div>
   </div>
   <div class="form-group">
    <label for="observacion" class="col-md-4 control-label"> <?php echo $this->lang->line("title_observacion"); ?>  </label>
   <div class="col-md-8">
   <textarea name="observacion" class="form-control" tabindex="17" rows="8" cols="35"><?php echo set_value("observacion");?></textarea>
   </div>
   </div>
   <div class="subtitle"> <?php echo $this->lang->line("title_phone_adicionales");?> </div>
   <div class="form-group">
    <label for="phone1" class="col-md-4 control-label"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   <div class="col-md-8">
   <input type="text" tabindex="18" class="form-control"  id="phone1"  name="phone1" value="<?php echo set_value("phone1");?>" maxsize="250" />
   </div>
   </div>
    <div class="form-group">
    <label for="phone2" class="col-md-4 control-label"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   <div class="col-md-8">
   <input type="text" tabindex="19" class="form-control"  id="phone2"  name="phone2" value="<?php echo set_value("phone2");?>" maxsize="250" />
   </div>
   </div>
    <div class="form-group">
    <label for="phone3" class="col-md-4 control-label"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   <div class="col-md-8">
   <input type="text" tabindex="20" class="form-control" id="phone3"  name="phone3" value="<?php echo set_value("phone3");?>" maxsize="250" />
   </div>
   </div>
    <div class="form-group">
    <label for="phone4" class="col-md-4 control-label"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   <div class="col-md-8">
   <input type="text" tabindex="21" class="form-control" id="phone4"  name="phone4" value="<?php echo set_value("phone4");?>" maxsize="250" />
   </div>
   </div>
    <div class="form-group">
    <label for="phone5" class="col-md-4 control-label"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   <div class="col-md-8">
   <input type="text" tabindex="22" class="form-control" id="phone5"  name="phone5" value="<?php echo set_value("phone5");?>" maxsize="250" />
   </div>
   </div>
   </div>
   <div class="form-group">
   <button type="submit" tabindex="23" id="send" class="btn btn-primary col-md-offset-4" accesskey="a" name="send"  onclick="return confirm('<?php echo $this->lang->line("ask_add_cliente");?>'); "><?php echo $this->lang->line("button_add");?> </button>
    <button type="reset" class="btn btn-warning" tabindex="24" id="clean" accesskey="l" name="clean" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); "><?php echo $this->lang->line("button_clean");?></button>
   </div>
  </form>
  
</div>

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
  <form name="formusuario" method="post" action="<?php echo site_url()."cliente/addnew";?>">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
   <div id="form_left">
    <div class="rowform">
   <div class="rowform-label"> <label for="telefono"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="1" id="telefono"  name="telefono" value="<?php echo set_value("telefono");?>" maxlength="8" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="name"> <?php echo $this->lang->line("title_name"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="2" id="name" name="name" value="<?php echo set_value("name");?>" maxsize="250" />
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="provincia"> <?php echo $this->lang->line("title_provincia"); ?>  </label>
   </div>
    <div class="rowform-input">
   <select class="selector" tabindex="3" name="provincia" id="provincia" onchange="flete.getLocalidad('<?php echo site_url()."localidad/getLocalidades";?>');" >
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
   <div class="rowform">
   <div class="rowform-label"> <label for="localidad"> <?php echo $this->lang->line("title_localidad"); ?>  </label>
   </div>
    <div class="rowform-input">
   <select class="selector" name="localidad" id="localidad" tabindex="4">
   
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
   <div class="rowform">
   <div class="rowform-label"> <label for="calle"> <?php echo $this->lang->line("title_street"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="5"  id="calle" name="calle" value="<?php echo set_value("calle");?>" maxsize="200" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="altura"> <?php echo $this->lang->line("title_altura"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="6" id="altura" name="altura" value="<?php echo set_value("altura");?>" maxsize="10" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="piso"> <?php echo $this->lang->line("title_piso"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="7" id="piso"  name="piso" value="<?php echo set_value("piso");?>" maxsize="50" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="dpto"> <?php echo $this->lang->line("title_dpto"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="8" id="dpto"  name="dpto" value="<?php echo set_value("dpto");?>" maxsize="10" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="entrecalle1"> <?php echo $this->lang->line("title_entrecalle1"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="9" id="entrecalle1"  name="entrecalle1" value="<?php echo set_value("entrecalle1");?>" maxsize="250" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="entrecalle2"> <?php echo $this->lang->line("title_entrecalle2"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="10" id="entrecalle2"   name="entrecalle2" value="<?php echo set_value("entrecalle2");?>" maxsize="250" />
   </div>
   </div>
   
   
    <div class="rowform">
   <div class="rowform-label"> <label for="banner"> <?php echo $this->lang->line("title_banner"); ?>  </label>
   </div>
   <textarea name="banner" id="banner" tabindex="11" rows="4" cols="15"><?php echo set_value("banner");?></textarea>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="showbanner"> <?php echo $this->lang->line("title_showbanner"); ?>  </label>
   </div>
   <input type="checkbox" tabindex="12" id="showbanner"   name="showbanner" value="1"  />
   </div>
  
   </div>
   <div id="form_rigth">
  
  
   
   <div class="rowform">
   <div class="rowform-label"> <label for="email"> <?php echo $this->lang->line("title_email"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="13" id="email"   name="email" value="<?php echo set_value("email");?>" maxsize="250" />
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="password"> <?php echo $this->lang->line("password"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="password" tabindex="13" id="password"   name="password" value="" maxsize="100" />
   </div>
   </div>

    <div class="rowform">
   <div class="rowform-label"> <label for="cuit"> <?php echo $this->lang->line("title_cuit"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="14" id="cuit"  name="cuit" value="<?php echo set_value("cuit");?>" maxsize="50" />
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="iva"> <?php echo $this->lang->line("title_iva"); ?>  </label>
   </div>
    <div class="rowform-input">
   <select name="iva" id="iva" tabindex="15">
   <option value="-1"><?php echo $this->lang->line("select_option");?> </option>
    <?php 
           foreach($iva as $v)
           echo "<option value=\"$v->id\" ".set_select('iva',$v->id)."  >$v->name</option>";
     ?>      
   </select>
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="mensaje"> <?php echo $this->lang->line("title_mensaje"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="16"  id="mensaje"  name="mensaje" value="<?php echo set_value("mensaje");?>" maxsize="250" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="observacion"> <?php echo $this->lang->line("title_observacion"); ?>  </label>
   </div>
    <div class="rowform-input">
   <textarea name="observacion" tabindex="17" rows="8" cols="35"><?php echo set_value("observacion");?></textarea>
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="comision"> <?php echo $this->lang->line("title_comision"); ?>  </label>
   </div>
   <input type="text" tabindex="17"  id="comision"  name="comision" value="<?php echo set_value("comision");?>" maxsize="10" />
   </div>
   <div class="subtitle"> <?php echo $this->lang->line("title_phone_adicionales");?> </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="phone1"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="18"  id="phone1"  name="phone1" value="<?php echo set_value("phone1");?>" maxsize="250" />
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="phone2"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="19"  id="phone2"  name="phone2" value="<?php echo set_value("phone2");?>" maxsize="250" />
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="phone3"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="20"  id="phone3"  name="phone3" value="<?php echo set_value("phone3");?>" maxsize="250" />
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="phone4"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="21"  id="phone4"  name="phone4" value="<?php echo set_value("phone4");?>" maxsize="250" />
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="phone5"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="22"  id="phone5"  name="phone5" value="<?php echo set_value("phone5");?>" maxsize="250" />
   </div>
   </div>
   </div>
   <div class="rowform-button">
   <input type="submit" tabindex="23" id="send" accesskey="a" name="send" value="<?php echo $this->lang->line("button_add");?>" onclick="return confirm('<?php echo $this->lang->line("ask_add_cliente");?>'); " />
    <input type="reset" tabindex="24" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
   </div>
  </form>
  
</div>

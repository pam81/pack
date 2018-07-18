<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#telefono").focus();
 });
	
</script>



<div id="content">

 
   <div id="top-bar">
    <h2> <?php echo $this->lang->line("title_mod_cliente");?></h2>
    </div>
   <hr class="separador">
  <form name="formusuario" method="post" action="<?php echo site_url()."cliente/update/".$cliente[0]->id;?>"
      onsubmit="return flete.validarModCliente(); " autocomplete="off"   >
   <?php echo validation_errors('<p class="error">','</p>'); ?>
   <div id="form_left">
    <div class="rowform">
   <div class="rowform-label"> <label for="telefono"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="1" id="telefono"  name="telefono" value="<?php if(isset($phone_principal[0]) ) {   echo set_value("telefono",$phone_principal[0]->phone);   } ?>" maxlength="8" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="name"> <?php echo $this->lang->line("title_name"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="2" id="name" name="name" value="<?php if(isset($cliente[0]) ) echo set_value("name",$cliente[0]->name); ?>" maxsize="250" />
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="provincia"> <?php echo $this->lang->line("title_provincia"); ?>  </label>
   </div>
    <div class="rowform-input">
   <select class="selector" tabindex="3" name="provincia" id="provincia" onchange="flete.getLocalidad('<?php echo site_url()."localidad/getLocalidades";?>');"  >
   <option value="-1"><?php echo $this->lang->line("select_option");?> </option>
   <?php
     foreach($provincias as $p)
     { 
        $seleccionar=false;
        if($p->id == $cliente[0]->provincia )
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
     {
        $seleccionar=false;
        if ($cliente[0]->localidad == $l->id)
          $seleccionar=true;
        
          echo "<option value=\"$l->id\" ".set_select('localidad',$l->id).">$l->name </option>";
      }
   ?>
   </select>
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="calle"> <?php echo $this->lang->line("title_street"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="5"  id="calle" name="calle" value="<?php if(isset($cliente[0]) ) echo set_value("calle",$cliente[0]->calle); ?>" maxsize="200" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="altura"> <?php echo $this->lang->line("title_altura"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="6" id="altura" name="altura" value="<?php if(isset($cliente[0]) ) echo set_value("altura",$cliente[0]->numero); ?>" maxsize="10" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="piso"> <?php echo $this->lang->line("title_piso"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="7" id="piso"  name="piso" value="<?php if(isset($cliente[0]) ) echo set_value("piso",$cliente[0]->piso); ?>" maxsize="50" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="dpto"> <?php echo $this->lang->line("title_dpto"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="8" id="dpto"  name="dpto" value="<?php if(isset($cliente[0]) ) echo set_value("dpto",$cliente[0]->dpto); ?>" maxsize="10" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="entrecalle1"> <?php echo $this->lang->line("title_entrecalle1"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="9" id="entrecalle1"  name="entrecalle1" value="<?php if(isset($cliente[0]) ) echo set_value("entrecalle1",$cliente[0]->entrecalle1); ?>" maxsize="250" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="entrecalle2"> <?php echo $this->lang->line("title_entrecalle2"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="10" id="entrecalle2"   name="entrecalle2" value="<?php if(isset($cliente[0]) ) echo set_value("entrecalle2",$cliente[0]->entrecalle2); ?>" maxsize="250" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="address"> <?php echo $this->lang->line("title_address"); ?>  </label>
   </div>
   <textarea name="address" tabindex="11" rows="6" cols="22" readonly="true"><?php if(isset($cliente[0]) ) echo $cliente[0]->address." entre ".$cliente[0]->entrecalles; ?></textarea>
   </div>
  
    <div class="rowform">
   <div class="rowform-label"> <label for="banner"> <?php echo $this->lang->line("title_banner"); ?>  </label>
   </div>
   <textarea name="banner" id="banner" tabindex="12" rows="4" cols="15"><?php echo set_value("banner",$cliente[0]->banner);?></textarea>
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="showbanner"> <?php echo $this->lang->line("title_showbanner"); ?>  </label>
   </div>
   <input type="checkbox" tabindex="13" id="showbanner" <?php if (isset($cliente[0]) && ($cliente[0]->show_banner == 1) ) echo "checked";?>   name="showbanner" value="1"  />
   </div>
   <?php if ($inhabilitar_permiso){ ?>
   <div class="rowform">
      <div class="rowform-label"> 
        <label for="deudor"> <?php echo $this->lang->line("title_bannerdeudor"); ?>  </label>
   </div>
        <input type="checkbox" tabindex="27" id="deudor" 
              <?php if (isset($cliente[0]) && ($cliente[0]->deudor == 1) ) echo "checked";?>   
              name="deudor" value="1"  />
        <input type="hidden" name="deudor_value" id="deudor_value" value="<?php echo $cliente[0]->deudor?>">
        <input type="password" name="pass" id="pass" value="" placeholder="Ingrese su password"  >
   </div>
  <?php } ?>

  <div class="rowform">
    <div class="rowform-label"> 
      <label for="conoce"> Cómo nos conoce? </label>
    </div>
    <select name="conoce">
      <option value="email" <?php if (isset($referidos[0]) && $referidos[0]->tipo == 'email'){ echo "selected"; } ?> >Email</option>
      <option value="web" <?php if (isset($referidos[0]) && $referidos[0]->tipo == 'web'){ echo "selected"; } ?>>Web</option>
      <option value="referido" <?php if (isset($referidos[0]) && $referidos[0]->tipo == 'referido'){ echo "selected"; } ?>>Referido</option>
      <option value="otro" <?php if ( isset($referidos[0]) && $referidos[0]->tipo == 'otro'){ echo "selected"; } ?>>Otro</option>
    </select> 
   </div>
   <div class="rowform">
    <input type="text" name="conoce_otro" value="<?php if (isset($referidos[0])) { echo $referidos[0]->texto;} ?>" placeholder="Indique cliente u otro medio">
   </div>
  
   </div>
   <div id="form_rigth">
  
  
   
   <div class="rowform">
   <div class="rowform-label"> <label for="email"> <?php echo $this->lang->line("title_email"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="14" id="email"   name="email" value="<?php if(isset($cliente[0]) ) echo set_value("email",$cliente[0]->email); ?>" maxsize="250" />
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="cuit"> <?php echo $this->lang->line("title_cuit"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="15" id="cuit"  name="cuit" value="<?php if(isset($cliente[0]) ) echo set_value("email",$cliente[0]->cuit); ?>" maxsize="50" />
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="iva"> <?php echo $this->lang->line("title_iva"); ?>  </label>
   </div>
    <div class="rowform-input">
   <select name="iva" id="iva" tabindex="16">
   <option value="-1"><?php echo $this->lang->line("select_option");?> </option>
    <?php 
           foreach($iva as $v)
           {
             $seleccionar=false;
             if(isset($cliente[0]) && $cliente[0]->iva_tipo == $v->id)
              $seleccionar=true;
             
              echo "<option value=\"$v->id\" ".set_select('iva',$v->id,$seleccionar).">$v->name</option>";
           }
     ?>      
   </select>
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="mensaje"> <?php echo $this->lang->line("title_mensaje"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="17"  id="mensaje"  name="mensaje" value="<?php if(isset($cliente[0]) ) echo set_value("mensaje",$cliente[0]->mensaje); ?>" maxsize="250" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="observacion"> <?php echo $this->lang->line("title_observacion"); ?>  </label>
   </div>
    <div class="rowform-input">
   <textarea name="observacion" tabindex="18" rows="4" cols="15"><?php if(isset($cliente[0]) ) echo set_value("observacion",$cliente[0]->observaciones); ?></textarea>
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="comision"> <?php echo $this->lang->line("title_comision"); ?>  </label>
   </div>
   <input type="text" tabindex="19"  id="comision"  name="comision" value="<?php echo set_value("comision");?>" maxsize="10" />
   </div>
   <div class="subtitle"> <?php echo $this->lang->line("title_phone_adicionales");?> </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="phone1"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="20"  id="phone1"  name="phone1" value="<?php if (isset($phones[0])) echo set_value("phone1",$phones[0]->phone); ?>" maxsize="250" />
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="phone2"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="21"  id="phone2"  name="phone2" value="<?php if (isset($phones[1])) echo set_value("phone2",$phones[1]->phone); ?>" maxsize="250" />
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="phone3"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="22"  id="phone3"  name="phone3" value="<?php if (isset($phones[2])) echo set_value("phone3",$phones[2]->phone); ?>" maxsize="250" />
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="phone4"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="23"  id="phone4"  name="phone4" value="<?php if (isset($phones[3])) echo set_value("phone4",$phones[3]->phone); ?>" maxsize="250" />
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="phone5"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
    <div class="rowform-input">
   <input type="text" tabindex="24"  id="phone5"  name="phone5" value="<?php if (isset($phones[4])) echo set_value("phone5",$phones[4]->phone); ?>" maxsize="250" />
   </div>
   </div>
   </div>
   <div class="rowform-button">
   <input type="submit" tabindex="25" id="send" accesskey="e" name="send" value="<?php echo $this->lang->line("button_mod");?>" onclick="return confirm('<?php echo $this->lang->line("ask_mod_cliente");?>'); "/>
    <input type="reset" tabindex="26" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
   </div>
  </form>
  
</div>

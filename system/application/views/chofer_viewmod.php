<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#name").focus();
 });

</script>




<div id="content">

 
   <div id="top-bar">
    <h2> <?php echo $this->lang->line("title_mod_chofer");?></h2>
    </div>
   <hr class="separador">
  <form name="formusuario" method="post" action="<?php echo site_url()."chofer/update/".$this->uri->segment(3);?>" onsubmit="return flete.validateModMovil();">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
   <div id="form_left">
   <div class="rowform">
   <div class="rowform-label"> <label for="name"> <?php echo $this->lang->line("title_name"); ?>  </label>
   </div>
   <input type="text" tabindex="1"  name="name" id="name" value="<?php if (isset($chofer[0])) echo set_value("name",$chofer[0]->name);?>" maxsize="150" />
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="lastname"> <?php echo $this->lang->line("title_lastname"); ?>  </label>
   </div>
   <input type="text" tabindex="2"  name="lastname" id="lastname" value="<?php if (isset($chofer[0])) echo set_value("lastname",$chofer[0]->lastname);?>" maxsize="150" />
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="fecnac"> <?php echo $this->lang->line("title_fechanac"); ?>  </label>
   </div>
   <?php 
       if(isset($chofer[0]))
         {
           $d_nac=substr($chofer[0]->fecha_nac,6,2);
           $m_nac=substr($chofer[0]->fecha_nac,4,2);
           $y_nac=substr($chofer[0]->fecha_nac,0,4);
         }
   ?>
   <input type="text" name="fecnac_day" id="fecnac_day" tabindex="3" size="2" maxsize="2" value="<?php echo set_value("fecnac_day",$d_nac);?>" />
   <input type="text" name="fecnac_month" id="fecnac_month" tabindex="4" size="2" maxsize="2" value="<?php echo set_value("fecnac_month",$m_nac);?>" />    
   <input type="text" name="fecnac_year" id="fecnac_year" tabindex="5" size="4" maxsize="2" value="<?php echo set_value("fecnac_year",$y_nac);?>" />
   <span> <?php echo $this->lang->line("fecha_formato");?></span>
   
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="tipodoc"> <?php echo $this->lang->line("title_tipodoc"); ?>  </label>
   </div>
   <select  name="tipodoc" id="tipodoc" tabindex="6">
    <?php foreach($tipodoc as $t)
          {
           $seleccionar=false;
           if (isset($chofer[0]) && $chofer[0]->tipo_doc == $t->id )
              $seleccionar=true;
           
              echo "<option value=\"$t->id\" ".set_select("tipodoc",$t->id,$seleccionar)."> $t->name </option>";
          }
    ?>
   </select>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="nrodoc"> <?php echo $this->lang->line("title_nrodoc"); ?>  </label>
   </div>
   <input type="text" tabindex="7"  name="nrodoc" id="nrodoc" value="<?php if (isset($chofer[0])) echo set_value("nrodoc",$chofer[0]->nro_doc);?>" maxsize="10" />
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="provincia"> <?php echo $this->lang->line("title_provincia"); ?>  </label>
   </div>
   <select class="selector" name="provincia" id="provincia" tabindex="8" onchange="flete.getLocalidad('<?php echo site_url()."localidad/getLocalidades";?>');">
   <option value="-1" ><?php echo $this->lang->line("select_option");?> </option>
   <?php
     foreach($provincias as $p)
     {
       $seleccionar=false;
       if ( isset($chofer[0]) && $chofer[0]->provincia == $p->id)
       $seleccionar=true;
       
         echo "<option value=\"$p->id\" ".set_select("provincia",$p->id,$seleccionar).">$p->name </option>";
     } 
   ?>
   </select>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="localidad"> <?php echo $this->lang->line("title_localidad"); ?>  </label>
   </div>
   <select class="selector" name="localidad" id="localidad" tabindex="9">
   
    <?php
     foreach($localidades as $p)
    {  
      $seleccionar=false;
      if( isset($chofer[0]) && $chofer[0]->localidad == $p->id)
      $seleccionar=true;
      
        echo "<option value=\"$p->id\" ".set_select("localidad",$p->id,$seleccionar).">$p->name </option>";
     } 
   ?>
   </select>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="calle"> <?php echo $this->lang->line("title_street"); ?>  </label>
   </div>
   <input type="text" tabindex="10" id="calle"  name="calle" value="<?php if (isset($chofer[0])) echo set_value("calle",$chofer[0]->calle);?>" maxsize="200" />
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="altura"> <?php echo $this->lang->line("title_altura"); ?>  </label>
   </div>
   <input type="text" tabindex="11" id="altura" name="altura" value="<?php if (isset($chofer[0])) echo set_value("altura",$chofer[0]->altura);?>" maxsize="10" />
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="piso"> <?php echo $this->lang->line("title_piso"); ?>  </label>
   </div>
   <input type="text" tabindex="12" id="piso" name="piso" value="<?php if (isset($chofer[0])) echo set_value("piso",$chofer[0]->piso);?>" maxsize="50" />
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="dpto"> <?php echo $this->lang->line("title_dpto"); ?>  </label>
   </div>
   <input type="text" tabindex="13" id="dpto"  name="dpto" value="<?php if (isset($chofer[0])) echo set_value("dpto",$chofer[0]->dpto);?>" maxsize="50" />
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="telefono"> <?php echo $this->lang->line("title_telefono"); ?>  </label>
   </div>
   <input type="text" tabindex="14" id="telefono"  name="telefono" value="<?php if (isset($chofer[0])) echo set_value("telefono",$chofer[0]->telefono);?>" maxsize="50" />
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="celular"> <?php echo $this->lang->line("title_celular"); ?>  </label>
   </div>
    <input type="text" tabindex="15" id="celular"  name="celular" value="<?php if (isset($chofer[0])) echo set_value("celular",$chofer[0]->celular);?>" maxsize="10" />
   </div>
  
   
   </div>
   <div id="form_rigth">
     
    <div class="rowform">
   <div class="rowform-label"> <label for="radio"> <?php echo $this->lang->line("title_radio"); ?>  </label>
   </div>
   <input type="text" tabindex="16" id="radio"  name="radio" value="<?php if (isset($chofer[0])) echo set_value("radio",$chofer[0]->radio);?>" maxsize="20" />
   </div>  
     
    <div class="rowform">
   <div class="rowform-label"> <label for="email"> <?php echo $this->lang->line("title_email"); ?>  </label>
   </div>
   <input type="text" tabindex="17" id="email"  name="email" value="<?php if (isset($chofer[0])) echo set_value("email",$chofer[0]->email);?>" maxsize="200" />
   </div>
     
   <div class="rowform">
   <div class="rowform-label"> <label for="referente"> <?php echo $this->lang->line("title_referente"); ?>  </label>
   </div>
   <input type="text" tabindex="18" id="referente"  name="referente" value="<?php if (isset($chofer[0])) echo set_value("referente",$chofer[0]->referente);?>" maxsize="200" />
   </div>
   
  
    
   <div class="rowform">
   <div class="rowform-label"> <label for="comefvo"> <?php echo $this->lang->line("title_comisionefvo"); ?>  </label>
   </div>
   <input type="text" tabindex="19" id="comefvo"  name="comefvo" value="<?php if (isset($chofer[0])) echo set_value("comefvo",$chofer[0]->comision);?>" maxsize="50" />
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="comctacte"> <?php echo $this->lang->line("title_comisionctacte"); ?>  </label>
   </div>
   <input type="text" tabindex="20" id="comctacte"  name="comctacte" value="<?php if (isset($chofer[0])) echo set_value("comctacte",$chofer[0]->comisionctacte);?>" maxsize="50" />
   </div>
   
     <div class="rowform">
   <div class="rowform-label"> <label for="nroregistro"> <?php echo $this->lang->line("title_nroregistro"); ?>  </label>
   </div>
   <input type="text" tabindex="21" id="nroregistro"   name="nroregistro" value="<?php if (isset($chofer[0])) echo set_value("nroregistro",$chofer[0]->nroregistro);?>" maxsize="50" />
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="venceregistro"> <?php echo $this->lang->line("title_vence_registro"); ?>  </label>
   </div>
   <?php 
        if(isset($chofer[0]))
         {
           $d_reg=substr($chofer[0]->vence_registro,6,2);
           $m_reg=substr($chofer[0]->vence_registro,4,2);
           $y_reg=substr($chofer[0]->vence_registro,0,4);
         }
   ?>
   <input type="text" name="venceregistro_day" id="venceregistro_day" tabindex="22" size="2" maxsize="2" value="<?php echo set_value("venceregistro_day",$d_reg);?>" />
   <input type="text" name="venceregistro_month" id="venceregistro_month" tabindex="23" size="2" maxsize="2" value="<?php echo set_value("venceregistro_month",$m_reg);?>" />
   <input type="text" name="venceregistro_year" id="venceregistro_year" tabindex="24" size="4" maxsize="2" value="<?php echo set_value("venceregistro_year",$y_reg);?>" />
   <span> <?php echo $this->lang->line("fecha_formato");?></span> 
  
   </div>
    <div class="rowform">
  
   <input type="checkbox" <?php if (isset($chofer[0]) && $chofer[0]->foto4x4 == 's' ) echo "checked=\"checked\""; ?> tabindex="25" id="foto4x4"   name="foto4x4" onkeypress="flete.checkElement(this,event); " />
     <label for="foto4x4"> <?php echo $this->lang->line("title_foto4x4"); ?>  </label>
  
   </div>
    <div class="rowform">
    <input type="checkbox" <?php if (isset($chofer[0]) && $chofer[0]->fotoregistro == 's' ) echo "checked=\"checked\""; ?> tabindex="26" id="fotoregistro"  name="fotoregistro" onkeypress="flete.checkElement(this,event); " />
    <label for="fotoregistro"> <?php echo $this->lang->line("title_fotoregistro"); ?>  </label>
  
   
   </div>
    <div class="rowform">
   <div > <label for="observacion"> <?php echo $this->lang->line("title_observacion"); ?>  </label>
   </div>
   <textarea name="observacion" id="observacion" tabindex="27" rows="6" cols="30"><?php if (isset($chofer[0])) echo set_value("observacion",$chofer[0]->observacion);?></textarea>
   </div>
   </div>
   <div>
     <div id="top-bar">
    <h2> <?php echo $this->lang->line("title_mod_movil");?></h2>
    </div>
   <hr class="separador">
   <div id="form_left">
    <div class="rowform">
   <div class="rowform-label"> <label for="movil"> <?php echo $this->lang->line("title_movil"); ?>  </label>
   </div>
   <input type="text" <?php if (isset($movil[0]) && $movil[0]->movil == -1) echo "readonly=\"readonly\""; ?> tabindex="28" id="movil" name="movil" value="<?php if(isset($movil[0])) echo set_value("movil",$movil[0]->movil);?>" maxsize="10" />
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="patente"> <?php echo $this->lang->line("title_patente"); ?>  </label>
   </div>
   <input type="text" tabindex="29" id="patente"  name="patente" value="<?php if(isset($movil[0])) echo set_value("patente",$movil[0]->patente);?>" maxsize="50" />
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="categoria"> <?php echo $this->lang->line("title_categoria"); ?>  </label>
   </div>
   <select  name="categoria" id="categoria" tabindex="30">
   <?php 
       foreach($categorias as $m){
        
         $seleccionar=false;
         if(isset($movil[0]) && $movil[0]->categoriaid == $m->id)
          $seleccionar=true;
         
          echo "<option value=\"$m->id\" ".set_select("categoria",$m->id,$seleccionar).">$m->name </option>";
        
        }
   ?>
   </select>
   </div>
 

   
   <div class="rowform">
   <div class="rowform-label"> <label for="marca"> <?php echo $this->lang->line("title_marca"); ?>  </label>
   </div>
   <input type="text" tabindex="31" id="marca" name="marca" value="<?php if(isset($movil[0])) echo set_value("marca",$movil[0]->marca);?>" maxsize="250" />
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="medidas"> <?php echo $this->lang->line("title_medidas"); ?>  </label>
   </div>
   <input type="text" tabindex="32" id="medidas" name="medidas" value="<?php if(isset($movil[0])) echo set_value("medidas",$movil[0]->medidas);?>" maxsize="250" />
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="factura"> <?php echo $this->lang->line("title_factura"); ?>  </label>
   </div>
   <input type="text" tabindex="33" id="factura" name="factura" value="<?php if(isset($movil[0])) echo set_value("factura",$movil[0]->factura);?>" maxsize="250" />
   </div>
   
    
   <div class="rowform">
   <div class="rowform-label"> <label for="nroseguro"> <?php echo $this->lang->line("title_nroseguro"); ?>  </label>
   </div>
   <input type="text" tabindex="34" id="nroseguro" name="nroseguro" value="<?php if(isset($movil[0])) echo set_value("nroseguro",$movil[0]->seguro);?>" maxsize="200" />
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="company"> <?php echo $this->lang->line("title_company"); ?>  </label>
   </div>
   <input type="text" tabindex="35" id="company"  name="company" value="<?php if(isset($movil[0])) echo set_value("company",$movil[0]->company);?>" maxsize="200" />
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="venceseguro"> <?php echo $this->lang->line("title_venceseguro"); ?>  </label>
   </div>
      <?php 
      if(isset($movil[0]))
         {
           $d_seg=substr($movil[0]->vence_seguro,6,2);
           $m_seg=substr($movil[0]->vence_seguro,4,2);
           $y_seg=substr($movil[0]->vence_seguro,0,4);
         }
      ?>
      <input type="text" name="venceseguro_day" id="venceseguro_day" tabindex="36" value="<?php echo set_value("venceseguro_day",$d_seg); ?>" size="2" />
      <input type="text" name="venceseguro_month" id="venceseguro_month" tabindex="37" value="<?php echo set_value("venceseguro_month",$m_seg); ?>"  size="2" />
      <input type="text" name="venceseguro_year" id="venceseguro_year" tabindex="38" value="<?php echo set_value("venceseguro_year",$y_seg); ?>" size="4" />  
      <span> <?php echo $this->lang->line("fecha_formato");?></span> 
       
  
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="venceruta"> <?php echo $this->lang->line("title_venceruta"); ?>  </label>
   </div>
    <?php 
       if(isset($movil[0]))
         {
           $d_ruta=substr($movil[0]->vence_ruta,6,2);
           $m_ruta=substr($movil[0]->vence_ruta,4,2);
           $y_ruta=substr($movil[0]->vence_ruta,0,4);
         }
    ?>
      <input type="text" name="venceruta_day" id="venceruta_day" tabindex="39" value="<?php echo set_value("venceruta_day",$d_ruta); ?>" size="2" />
      <input type="text" name="venceruta_month" id="venceruta_month" tabindex="40" value="<?php echo set_value("venceruta_month",$m_ruta); ?>" size="2" />
      <input type="text" name="venceruta_year" id="venceruta_year" tabindex="41" value="<?php echo set_value("venceruta_year",$y_ruta); ?>" size="4" />
      <span> <?php echo $this->lang->line("fecha_formato");?></span> 
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="vencesacta"> <?php echo $this->lang->line("title_vencesacta"); ?>  </label>
   </div>
    <?php 
    if(isset($movil[0]))
         {
           $d_sacta=substr($movil[0]->vence_sacta,6,2);
           $m_sacta=substr($movil[0]->vence_sacta,4,2);
           $y_sacta=substr($movil[0]->vence_sacta,0,4);
         }
    ?>
      <input type="text" name="vencesacta_day" id="vencesacta_day" tabindex="42" value="<?php echo set_value("vencesacta_day",$d_sacta); ?>" size="2" />
      <input type="text" name="vencesacta_month" id="vencesacta_month" tabindex="43" value="<?php echo set_value("vencesacta_month",$m_sacta); ?>" size="2" />
      <input type="text" name="vencesacta_year" id="vencesacta_year" tabindex="44" value="<?php echo set_value("vencesacta_year",$y_sacta); ?>" size="4" />
      <span> <?php echo $this->lang->line("fecha_formato");?></span> 
  
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="vencevtv"> <?php echo $this->lang->line("title_vencevtv"); ?>  </label>
   </div>
   
      <?php 
      if(isset($movil[0]))
         {
           $d_vtv=substr($movil[0]->vence_vtv,6,2);
           $m_vtv=substr($movil[0]->vence_vtv,4,2);
           $y_vtv=substr($movil[0]->vence_vtv,0,4);
         }
      ?>
      <input type="text" name="vencevtv_day" id="vencevtv_day" tabindex="45" value="<?php echo set_value("vencevtv_day",$d_vtv); ?>" size="2" />
      <input type="text" name="vencevtv_month" id="vencevtv_month" tabindex="46" value="<?php echo set_value("vencevtv_month",$m_vtv); ?>" size="2" />
      <input type="text" name="vencevtv_year" id="vencevtv_year" tabindex="47" value="<?php echo set_value("vencevtv_year",$y_vtv); ?>" size="4" />
      <span> <?php echo $this->lang->line("fecha_formato");?></span>
      
       
   
   </div>
   
   <div class="rowform">
   <div class="rowform-label"> <label for="vencemoy"> <?php echo $this->lang->line("title_vencemoy"); ?>  </label>
   </div>
   <?php 
   if(isset($movil[0]))
         {
           $d_moy=substr($movil[0]->vence_moyano,6,2);
           $m_moy=substr($movil[0]->vence_moyano,4,2);
           $y_moy=substr($movil[0]->vence_moyano,0,4);
         }
   ?>
      <input type="text" name="vencemoy_day" id="vencemoy_day" tabindex="48" value="<?php echo set_value("vencemoy_day",$d_moy); ?>" size="2" />
      <input type="text" name="vencemoy_month" id="vencemoy_month" tabindex="49" value="<?php echo set_value("vencemoy_month",$m_moy); ?>" size="2" />
      <input type="text" name="vencemoy_year" id="vencemoy_year" tabindex="50" value="<?php echo set_value("vencemoy_year",$y_moy); ?>" size="4" />
      <span> <?php echo $this->lang->line("fecha_formato");?></span> 
   
   </div>
   
   
   </div> 
   <div id="form_rigth">
    <div class="rowform">
     <input type="checkbox" <?php if(isset($movil[0]) && $movil[0]->propio == 's') echo "checked=\"checked\"";?> id="propio" tabindex="51"   name="propio" onkeypress="flete.checkElement(this,event); " />
    <label for="propio"> <?php echo $this->lang->line("title_propio"); ?>  </label>
   </div>
    <div class="rowform">
     <input type="checkbox" <?php if(isset($movil[0]) && $movil[0]->fotocedula == 's') echo "checked=\"checked\"";?> id="fotocedula" tabindex="52"   name="fotocedula" onkeypress="flete.checkElement(this,event); " />
    <label for="fotocedula"> <?php echo $this->lang->line("title_fotocedula"); ?>  </label>
   </div>
   
    <div class="rowform">
   <input type="checkbox" tabindex="53" <?php if(isset($movil[0]) && $movil[0]->fototarjeta == 's') echo "checked=\"checked\"";?>  name="fototarjeta" id="fototarjeta" onkeypress="flete.checkElement(this,event); " />
    <label for="fototarjeta"> <?php echo $this->lang->line("title_fototarjeta"); ?>  </label>
   </div>
   
    <div class="rowform">
    <input type="checkbox" tabindex="54" <?php if(isset($movil[0]) && $movil[0]->fototitulo == 's') echo "checked=\"checked\"";?>  name="fototitulo"  id="fototitulo" onkeypress="flete.checkElement(this,event); " />
   <label for="fototitulo"> <?php echo $this->lang->line("title_fototitulo"); ?>  </label>
    </div>
   
    <div class="rowform">
    <input type="checkbox" tabindex="55"  <?php if(isset($movil[0]) && $movil[0]->fotoseguro == 's') echo "checked=\"checked\"";?> name="fotoseguro" id="fotoseguro" onkeypress="flete.checkElement(this,event); " />
   <label for="fotoseguro"> <?php echo $this->lang->line("title_fotoseguro"); ?>  </label>
    </div>
    
    <?php if ( $this->Current_User->isHabilitado("DOC_MOVIL") ){ ?>
    <div class="rowform">
      <input type="checkbox" tabindex="56"  <?php if(isset($movil[0]) && $movil[0]->noverifica_documentacion == 1) echo "checked=\"checked\"";?> name="verifica" id="verifica" onkeypress="flete.checkElement(this,event); " />
      <label for="verifica"> <?php echo $this->lang->line("title_noverifica_documentacion"); ?>  </label>
    </div>
    <?php }?>

    <div class="rowform">
        <div > 
          <label for="observacion2"> <?php echo $this->lang->line("title_observacion"); ?>  </label>
        </div>
        <textarea name="observacion2" id="observacion2" tabindex="57" rows="6" cols="30">
        <?php if(isset($movil[0])) echo set_value("observacion2",$movil[0]->observacion_movil);?>
        </textarea>
   </div>
   <div class="rowform"> 
      <div> <label for="passdocu">Código Modificar</label> </div>
      <input type="text" name="passdocu" value="" />
   </div>
   </div>
   </div>
   <div class="rowform">
   <input type="submit" tabindex="58" id="send" accesskey="e" name="send" value="<?php echo $this->lang->line("button_mod");?>" onclick="return confirm('<?php echo $this->lang->line("ask_mod_chofer");?>'); " />
    <input type="reset" tabindex="59" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
   </div>

  </form>
  
</div>

<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#movil").focus();
 });

</script>




<div id="content">

 
   <div id="top-bar">
    <h2> <?php echo $this->lang->line("title_mod_caja");?></h2>
    </div>
   <hr class="separador">
  <form name="formusuario" method="post" action="<?php echo site_url()."caja/update/".$this->uri->segment(3);?>" onsubmit="return flete.validarCaja();">
   <?php echo validation_errors('<p class="error">','</p>'); ?>
    <div id="form_left">
       <div class="rowform">
          <div class="rowform-label"> 
              <label for="name"> <?php echo $this->lang->line("title_movil"); ?>  </label>
          </div>
          <select name="movil" tabindex="1" id="movil">
            <option value="0">Seleccione Movil</option>
            <?php foreach($moviles as $m){ 
                  $seleccionar=false;
                  if (isset($caja[0]) && $caja[0]->idmovil == $m->id )
                      $seleccionar=true;
              ?>
                  <option <?php echo "value=\"".$m->id."\""; echo set_select("movil",$m->id,$seleccionar);?>><?php echo $m->movil;?></option>
            <?php }?>
          </select>
       </div>
    <div class="rowform">
   
   <div class="rowform-label"> <label for="monto"> <?php echo $this->lang->line("title_monto"); ?>  </label>
   </div>
   <input type="text" tabindex="2"  name="monto" id="monto" value="<?php if (isset($caja[0])) echo set_value("monto",$caja[0]->monto);?>" maxsize="150" />
   </div>

    <div class="rowform">
   <div class="rowform-label"> <label for="fecha"> <?php echo $this->lang->line("title_fecha"); ?>  </label>
   </div>
   <?php 
       if(isset($caja[0]))
         {
           $d=substr($caja[0]->created_at,6,2);
           $m=substr($caja[0]->created_at,4,2);
           $y=substr($caja[0]->created_at,0,4);
         }
   ?>
   <input type="text" name="fecha_day" id="fecha_day" tabindex="3" size="2" maxsize="2" value="<?php echo set_value("fecha_day",$d);?>" />
   <input type="text" name="fecha_month" id="fecha_month" tabindex="4" size="2" maxsize="2" value="<?php echo set_value("fecha_month",$m);?>" />    
   <input type="text" name="fecha_year" id="fecha_year" tabindex="5" size="4" maxsize="2" value="<?php echo set_value("fecha_year",$y);?>" />
   <span> <?php echo $this->lang->line("fecha_formato");?></span>
   
   </div>

   <div class="rowform">
      <div class="rowform-label"> 
          <label for="type"> <?php echo $this->lang->line("title_type"); ?>  </label>
      </div>
      <select name="type" id="type" tabindex="6">
        <option value="1" <?php if ($caja[0]->tipo == 1){ echo "selected";}?> >PAGA AGENCIA</option>
        <option value="2" <?php if ($caja[0]->tipo == 2){ echo "selected";}?>>PAGA MOVIL</option>
        <option value="3" <?php if ($caja[0]->tipo == 3){ echo "selected";}?>>C/CO</option>
        <option value="3" <?php if ($caja[0]->tipo == 4){ echo "selected";}?>>ANTERIOR</option>
      </select>
   
   </div>

   <div class="rowform">
      <div class="rowform-label"> 
          <label for="descripcion"> <?php echo $this->lang->line("title_descripcion"); ?>  </label>
      </div>
      <textarea name="descripcion" tabindex="7"  id="descripcion" rows="6" cols="30"><?php if (isset($caja[0])) echo set_value("descripcion",$caja[0]->descripcion);?></textarea>
   
   </div>

   
   
  
   <div class="rowform">
   <input type="submit" tabindex="8" id="send" accesskey="e" name="send" value="<?php echo $this->lang->line("button_add");?>" onclick="return confirm('<?php echo $this->lang->line("ask_mod_caja");?>'); "/>
    <input type="reset" tabindex="9" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean");?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean");?>'); " />
   </div>
   
 </div>
   

  </form>
  
</div>

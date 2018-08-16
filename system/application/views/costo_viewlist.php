<script>
//al entrar pongo foco en primer campo
$(document).ready(function(){
  $("#categoria").focus();
 });

</script>



<div id="content">

  
   <div id="top-bar">
    <h2> <?php echo $this->lang->line("title_mod_costos");?></h2>
    </div>
   <hr class="separador">
  <form name="formusuario"  class="form_col" method="post" action="<?php echo site_url()."costo/add";?>" onsubmit=" var categoria=document.getElementById('categoria'); if (categoria.options[categoria.selectedIndex].value  == 0){ swal('Debe seleccionar una categoria'); return false} else return true;" >
   <?php echo validation_errors('<p class="error">','</p>'); ?>
   <div class="rowform">
   <div class="rowform-label"> <label for="categoria"> <?php echo $this->lang->line("title_categorias"); ?>  </label>
   </div>
   <div class="rowform-input">
   <select name="categoria" id="categoria" onchange="indice = this.selectedIndex; window.location='<?php echo site_url()."costo/index/";?>'+this.options[indice].value;">
   <option value="0"><?php echo $this->lang->line("select_option");?> </option>
   <?php foreach($categorias as $c){
     echo "<option value=\"$c->id\" ".set_select("categoria",$c->id)."> $c->name </option>";
    }?>
   </select>
   <script type="text/javascript">
    			//esto es porque sino al volver atras no actualiza el id de raza
          function preloadForm(id) {
    				
            var select = document.getElementById("categoria");
    			 for (var itemIndex = 0; itemIndex < select.length; itemIndex++)
					{
					 
						if (select[itemIndex].value == id) {
					
								select.options[itemIndex].selected = true;
							}
					}
           
    												
    			}
    			window.onload = preloadForm(<?php echo $categoriaid;?>);
    		</script>
    </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="fraccion"> <?php echo $this->lang->line("title_fraccion"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="2" name="fraccion" id="fraccion"  value="<?php if(isset($valor[0]->fraccion)) echo set_value("fraccion",$valor[0]->fraccion); ?>" maxsize="10" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="cant_hora"> <?php echo $this->lang->line("title_cant_hora"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="3"  name="cant_hora" id="cant_hora" value="<?php if(isset($valor[0]->primerciclo)) echo set_value("cant_hora",$valor[0]->primerciclo); ?>" maxsize="10" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="valor_hora"> <?php echo $this->lang->line("title_valor_hora"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="4"  name="valor_hora" id="valor_hora" value="<?php if(isset($valor[0]->valorhora)) echo set_value("valor_hora",$valor[0]->valorhora); ?>" maxsize="10" />
   </div>
   </div>
    <div class="rowform">
   <div class="rowform-label"> <label for="cant_hora2"> <?php echo $this->lang->line("title_cant2_hora"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="5"  name="cant_hora2" id="cant_hora2" value="<?php if(isset($valor[0]->segundociclo)) echo set_value("cant_hora2",$valor[0]->segundociclo); ?>" maxsize="10" />
   </div>
   </div>
   <div class="rowform">
   <div class="rowform-label"> <label for="valor_hora2"> <?php echo $this->lang->line("title_valor_hora2"); ?>  </label>
   </div>
   <div class="rowform-input">
   <input type="text" tabindex="6"  name="valor_hora2" id="valor_hora2" value="<?php if(isset($valor[0]->valorhora2)) echo set_value("valor_hora2",$valor[0]->valorhora2); ?>" maxsize="10" />
   </div>
   </div>
  
   
    <div class="rowform">
   <input type="submit" tabindex="7" accesskey="e" id="send" name="send" value="<?php echo $this->lang->line("button_send");?>" onclick="return confirm('<?php echo $this->lang->line("ask_mod_costo");?>'); "/>
    <input type="reset" tabindex="8" accesskey="l" id="clear" name="clean" value="<?php echo $this->lang->line("button_clean");?>" />
   </div>
  </form>
  
</div>

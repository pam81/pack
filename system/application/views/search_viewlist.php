
<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("title_search");?></h2>
  
  </div>
   <hr class="separador">
    <div class="select-bar">
		 <form name="formsearch" id="formsearch" method="post" action="<?php echo site_url()."search/viaje";?>" onsubmit="return flete.validarSearch(3);">  
        
     <div class="rowform">  
        <div class="rowform-label">
        <label> <?php echo mb_convert_case($this->lang->line("title_movil"),MB_CASE_TITLE,"utf-8");?><label>
        </div>
		    <input type="text" tabindex="1" name="movil" id="movil" value="<?php echo set_value("movil",0);?>" />
		 </div>   
		 <div class="rowform">     
			  <div class="rowform-label">
        <label> <?php echo mb_convert_case($this->lang->line("title_fecha"),MB_CASE_TITLE,"utf-8");?></label>
        </div>
		   
		   <?php 
       $dia=date("d");
       $mes=date("m");
       $year=date("Y");
       ?>
		   
		   <input type="text" name="desde_day" id="desde_day" tabindex="2" size="2" maxsize="2" value="<?php echo set_value("desde_day");?>" />
       <input type="text" name="desde_month" id="desde_month" tabindex="3" size="2" maxsize="2" value="<?php echo set_value("desde_month");?>" />    
       <input type="text" name="desde_year" id="desde_year" tabindex="4" size="4" maxsize="4" value="<?php echo set_value("desde_year");?>" />
	

		 </div>
   
	<div class="rowform">
	<div class="rowform-label">
  <label><?php echo $this->lang->line("title_cliente");?></label>
  </div>
	<input type="text" tabindex="5" name="cliente" id="cliente" value="<?php echo set_value("cliente");?>"/>
	</div>
	<div class="rowform">
	<div class="rowform-label">
	<label><?php echo $this->lang->line("title_phone");?></label>
	</div>
	<input type="text" tabindex="6" name="phone" id="phone" value="<?php echo set_value("phone");?>"/>
	</div>
	<div class="rowform">
	<div class="rowform-label">
	<label><?php echo $this->lang->line("title_desde");?></label>
	</div>
	<input type="text" tabindex="7" name="desde" id="desde" value="<?php echo set_value("desde");?>"/>
	</div>
	<div class="rowform">
	<div class="rowform-label">
	<label><?php echo $this->lang->line("title_hasta");?></label>
	</div>
	<input type="text" tabindex="8" name="hasta" id="hasta" value="<?php echo set_value("hasta");?>"/>
	</div>
		<div class="rowform">
	<div class="rowform-label">
	<label><?php echo $this->lang->line("title_excedente_codigo");?></label>
	</div>
	<input type="text" tabindex="9" name="seguro" id="seguro" value="<?php echo set_value("seguro");?>"/>
	</div>
	
  <div class="rowform">
	<div class="rowform-label">
	<label><?php echo $this->lang->line("title_voucher");?></label>
	</div>
	<input type="text" tabindex="10" name="voucher" id="voucher" value="<?php echo set_value("voucher");?>"/>
	</div>
	
	 <div class="rowform">
	<div class="rowform-label">
	<label><?php echo $this->lang->line("nro_viaje");?></label>
	</div>
	<input type="text" tabindex="11" name="nroviaje" id="nroviaje" value="<?php echo set_value("nroviaje");?>"/>
	</div>
	
  <div style="clear:both; text-align:left;">
			
			<button type="submit" tabindex="12" name="search" class="btn btn-primary" ><?php echo $this->lang->line("button_search");?></button>
			
	</div>
	
		</form>	
		  </div>
   
  
 
</div>

<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
  if (code.toString() == 80 && e.altKey ) //alt+p pdf
       document.location.href='<?php echo site_url()."reporte/pdfrankingcliente/$opciones";?>';
  
  
       
 
    
});

function searching(e)
{
  var tecla = (document.all) ? e.keyCode : e.which;
  if (tecla.toString() == 13)
    $("#searchfield").focus();
}

</script>


<script type="text/javascript" src="<?php echo base_url();?>js/Chart.min.js"></script>



<div id="content">

  <div id="top-bar">
  
  <h2> <?php echo $this->lang->line("title_list_ranking_cliente");?></h2>
  
  </div>
   <hr class="separador">
    <div class="select-bar">
		 <form name="formsearch" id="formsearch" method="post" action="<?php echo site_url()."reporte/rankingCliente";?>" >  
        
		  
      
			  <label> <?php echo mb_convert_case($this->lang->line("title_fecha_desde"),MB_CASE_TITLE,"utf-8");?>
		   
		   <?php 
       $dia=date("d");
        if (isset($fdesde)){
           $dia=substr($fdesde,6,2);
        }
        
        $mes=date("m");
        if (isset($fdesde))
        {
         $mes=substr($fdesde,4,2);
        }
        $year=date("Y");
        if (isset($fdesde)) 
         $year=substr($fdesde,0,4);
        
       ?>
       
       <input type="text" name="desde_day" id="desde_day" tabindex="2" size="2" maxsize="2" value="<?php echo set_value("desde_day",$dia);?>" />
       <input type="text" name="desde_month" id="desde_month" tabindex="3" size="2" maxsize="2" value="<?php echo set_value("desde_month",$mes);?>" />    
       <input type="text" name="desde_year" id="desde_year" tabindex="4" size="4" maxsize="4" value="<?php echo set_value("desde_year",$year);?>" />
		   
		   
		    
		    </label>
		  
        <label> <?php echo mb_convert_case($this->lang->line("title_fecha_hasta"),MB_CASE_TITLE,"utf-8");?>
		   
       <?php 
         $dia=date("d");
        if (isset($fhasta)){
           $dia=substr($fhasta,6,2);
        }
        
        $mes=date("m");
        if (isset($fhasta))
        {
         $mes=substr($fhasta,4,2);
        }
        $year=date("Y");
        if (isset($fhasta)) 
         $year=substr($fhasta,0,4);
        
        ?>
        
        <input type="text" name="hasta_day" id="hasta_day" tabindex="5" size="2" maxsize="2" value="<?php echo set_value("hasta_day",$dia);?>" />
       <input type="text" name="hasta_month" id="hasta_month" tabindex="6" size="2" maxsize="2" value="<?php echo set_value("hasta_month",$mes);?>" />    
       <input type="text" name="hasta_year" id="hasta_year" tabindex="7" size="4" maxsize="4" value="<?php echo set_value("hasta_year",$year);?>" />
       
        
		    </label>
		  
			<label>
			<input type="submit" tabindex="1" name="search" value="<?php echo $this->lang->line("button_search");?>" />
			</label>
		</form>	
		  </div>
   <script type="text/javascript">
	jQuery.tableNavigation();
</script>
  <table  class="tablelist navigateable myTable02"  >
   <thead>
    <tr>
        <th> <?php echo mb_convert_case($this->lang->line("title_cliente"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th> <?php echo mb_convert_case($this->lang->line("title_telefono"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th> <?php echo mb_convert_case($this->lang->line("cant_viajes"),MB_CASE_UPPER,"UTF-8");?> </th>
        <th> <?php echo mb_convert_case($this->lang->line("title_total"),MB_CASE_UPPER,"UTF-8");?> </th>
    </tr>    
   </thead>
   <tbody>
     <?php 
     
         foreach($listado as $k) {
         
         
         
         ?>
         
         
       <tr class="modotr">
          
        
         
         <td> <a href="<?php echo site_url()."cliente/mod/".$k->clienteid;?>"><?php echo $k->cliente;?></a></td>
         <td> <?php echo $k->tel;?></td>
         
         <td> <?php if (isset($k->cantidad)) echo $k->cantidad;?> </td>
         <td> <?php if (isset($k->total)) echo $k->total; ?> </td>
                      
       </tr>
     <?php   }?>
   </tbody>
  </table>
   <?php  if ( $this->Current_User->isHabilitado("PRINTRKCLIENTE") ){
      ?>
    <a href="<?php echo site_url()."pdf/makepdfrankingcliente/$opciones";?>"> <img src="<?php echo base_url()."images/img/excell.jpg";?>" width="50" height="50" alt="excell" />
	    </a>
    <?php } ?> 
    <div style="width: 600px">
      <canvas id="myChart" ></canvas>
    </div>
    <script>
      var ctx = document.getElementById("myChart").getContext('2d');
      data = {
            datasets: [{ 
                data: [
                  <?php $value= isset($referidos["email"]) ? $referidos["email"]:0; echo $value; ?>, 
                  <?php $value= isset($referidos["web"]) ? $referidos["web"]:0; echo $value;?>, 
                  <?php $value= isset($referidos["referido"]) ? $referidos["referido"]:0; echo $value;?>, 
                  <?php $value= isset($referidos["otro"]) ? $referidos["otro"]:0; echo $value;?>]
                  ,
            
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(100, 100, 100, 0.2)'
					  ]
            
            }],
            
            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                'Email',
                'Web',
                'Referido',
                'Otro'
            ]
        };
      
      var myPieChart = new Chart(ctx,{
          type: 'pie',
          data: data,
         // options: options
      });

    </script>
</div>

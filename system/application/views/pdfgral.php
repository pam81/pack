<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->lang->line('name_empresa');?></title>
<style>

.listado {
 border: 1px solid #333;

}

.listado thead tr th{
 border-bottom: 1px solid #333;
 
}

.listado tr td{
 text-align: center;
 border-bottom: 1px solid #333;
 font-size: 12px;
 
}

</style>
</head>
  <body>
  <h2> <?php echo $this->lang->line("title_list_viaje"); ?></h2>
  <br>
  <br>
  <table>
  <tr>
   <td> Desde :</td> <td> <?php  echo substr($fdesde,6,2)."-".substr($fdesde,4,2)."-".substr($fdesde,0,4); ?>   </td>
  </tr>
  <tr>
   <td> Hasta : </td> <td> <?php  echo substr($fhasta,6,2)."-".substr($fhasta,4,2)."-".substr($fhasta,0,4); ?> </td>
   </tr>
  </table>
  <br>
  <br>
  <table class="listado" cellspacing="0" cellpadding="0" >
   <thead>
    <tr>
        <th> <?php echo $this->lang->line("cant_viajes");?> </th>
        <th> <?php echo $this->lang->line("choferes");?> </th>
        <th> <?php echo $this->lang->line("title_movil");?> </th>
      
         <th> <?php echo $this->lang->line("title_contado");?> </th>
      
         <th> <?php echo $this->lang->line("title_ctacte");?> </th>
       
         <th> <?php echo $this->lang->line("title_peones");?> </th>
          <th> <?php echo $this->lang->line("title_espera");?> </th>
        <th> <?php echo $this->lang->line("title_peaje");?> </th>
        <th> <?php echo $this->lang->line("estacionamiento_short");?> </th>
        <th> <?php echo $this->lang->line("title_otros");?> </th>
        <th> <?php echo $this->lang->line("title_seguro");?> </th>
        <th> <?php echo substr($this->lang->line("title_mudanza"),0,4);?></th>
       <th><?php echo $this->lang->line("title_iva");?></th>
       <th>% <?php echo $this->lang->line("title_ctacte");?></th>
       <th> <?php echo $this->lang->line("title_art");?> </th>
       <th> %<?php echo substr($this->lang->line("title_mudanza"),0,4);?></th>
       <th> <?php echo $this->lang->line("title_comisionar");?> </th>
        <th><?php echo $this->lang->line("title_acliente");?></th>
      
        
    </tr>    
   </thead>
   <tbody>
     <?php 
     
      $totalviajes=0;
      $efvo=0;
      $ctacte=0;
      $peones=0;
      $peonescc=0;
      $peonesefvo=0;
      $espera=0;
      $esperaefvo=0;
      $esperacc=0;
      $peaje=0;
      $peajeefvo=0;
      $peajecc=0;
      $estacionamiento=0;
      $estacefvo=0;
      $estaccc=0;
      $otros=0;
      $otrosefvo=0;
      $otroscc=0;
      $seguro=0;
      $seguroefvo=0;
      $segurocc=0;
      $totalcc=0;
      $artcc=0;
      $artefvo=0;
      $mudanzacc=0;
      $mudanzaefvo=0;
      $porcentaje_mudanzacc=0;
      $porcentaje_mudanzaefvo=0;
      $porcentaje_ctactecc=0;
      $porcentaje_ctacteefvo=0;
      $ivacc=0;
      $ivaefvo=0;
      $total_iva=0;
      $totalart=0;
      $totalmudanza=0;
      $total_porcentajemudanza=0;
      $total_porcentajecc=0;
      $total_contado=0;
      $total_parcial_efvo = 0;
      $total_parcial_cc = 0;
         foreach($viajes as $u) {
          
         ?> 
           
         
         
       <tr >
        
         <td> <?php if (isset($u["cant_viajes"])) { echo $u["cant_viajes"]; $totalviajes += $u["cant_viajes"];}?> </td>
         <td> <?php if (isset($u["chofer"])) echo $u["chofer"];?></td>
         <td> <?php if (isset($u["movil"])) echo $u["movil"];?></td>
        
         <td> <?php if(isset($u["total_efvo"])) {echo $u["total_efvo"]; $efvo += $u["total_efvo"];}?> </td>
        
         <td> <?php if (isset($u["total_ctacte"])) {echo $u["total_ctacte"]; $ctacte += $u["total_ctacte"]; }?> </td>
         
         <td><?php if (isset($u["total_peon"])) {echo  "Efvo: ".$u["total_peon_efvo"]." <br> CC: ".$u["total_peon_cc"]; $peones += $u["total_peon"]; $peonescc += $u["total_peon_cc"]; $peonesefvo += $u["total_peon_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_espera"])) {echo "Efvo: ".$u["total_espera_efvo"]." <br> CC: ".$u["total_espera_cc"]; $espera += $u["total_espera"]; $esperacc += $u["total_espera_cc"]; $esperaefvo += $u["total_espera_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_peaje"])) {echo "Efvo: ".$u["total_peaje_efvo"]." <br> CC: ".$u["total_peaje_cc"]; $peaje += $u["total_peaje"]; $peajecc += $u["total_peaje_cc"]; $peajeefvo += $u["total_peaje_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_estac"])) {echo "Efvo: ".$u["total_estac_efvo"]." <br> CC: ".$u["total_estac_cc"]; $estacionamiento += $u["total_estac"]; $estaccc+=$u["total_estac_cc"]; $estacefvo += $u["total_estac_efvo"];  }?>  </td>
         <td><?php if (isset($u["total_otro"])) {echo "Efvo: ".$u["total_otro_efvo"]." <br> CC: ".$u["total_otro_cc"]; $otros += $u["total_otro"]; $otroscc += $u["total_otro_cc"]; $otrosefvo += $u["total_otro_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_seguro"])) {echo "Efvo: ".$u["total_seguro_efvo"]." <br> CC: ".$u["total_seguro_cc"]; $seguro += $u["total_seguro"]; $segurocc += $u["total_seguro_cc"]; $seguroefvo += $u["total_seguro_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_mudanza"])) {echo "Efvo: ".$u["total_mudanza_efvo"]." <br> CC: ".$u["total_mudanza_cc"]; $totalmudanza += $u["total_mudanza"]; $mudanzacc += $u["total_mudanza_cc"]; $mudanzaefvo += $u["total_mudanza_efvo"]; }?>  </td>
          <td><?php if (isset($u["total_iva"])) {echo "Efvo: ".$u["total_iva_efvo"]." <br> CC: ".$u["total_iva_cc"]; $total_iva += $u["total_iva"]; $ivacc += $u["total_iva_cc"]; $ivaefvo += $u["total_iva_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_porcentajecc"])) {echo "Efvo: 0 <br> CC: ".$u["total_porcentajecc_cc"]; $total_porcentajecc += $u["total_porcentajecc"]; $porcentaje_ctactecc += $u["total_porcentajecc_cc"];  }?>  </td>
         <td><?php if (isset($u["total_art"])) {echo "Efvo: ".$u["total_art_efvo"]." <br> CC: ".$u["total_art_cc"]; $totalart += $u["total_art"]; $artcc += $u["total_art_cc"]; $artefvo += $u["total_art_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_porcentajemudanza"])) {echo "Efvo: ".$u["total_porcentajemudanza_efvo"]." <br> CC: ".$u["total_porcentajemudanza_cc"]; $total_porcentajemudanza += $u["total_porcentajemudanza"]; $porcentaje_mudanzacc += $u["total_porcentajemudanza_cc"]; $porcentaje_mudanzaefvo += $u["total_porcentajemudanza_efvo"]; }?>  </td> 
           <td>
           <?php echo "Efvo:"; ?>
           <?php if (isset($u["parcial_efvo"])) echo $u["parcial_efvo"]; $total_parcial_efvo +=$u["parcial_efvo"];  ?>
          
           <?php echo "<br> CC:"; ?>
          <?php if (isset($u["parcial_cc"])) echo $u["parcial_cc"]; $total_parcial_cc +=$u["parcial_cc"];  ?> 
         
         </td>
          
          <td>
           <?php echo "Efvo:"; ?>
           <?php if (isset($u["total_contado"])) echo $u["total_contado"]; $total_contado +=$u["total_contado"];  ?>
          
           <?php echo "<br> CC:"; ?>
          <?php if (isset($u["totalcc"])) echo $u["totalcc"]; $totalcc +=$u["totalcc"];  ?> 
         
         </td>
         
                      
       </tr>
    <?php } ?>
   </tbody>
  </table>
  <br>
  <br>
  <?php if ($see == 1 ) { ?>
    <table>
    <tr>
     <td>  Viajes Realizados:</td> <td> <?php echo $totalviajes ;?> </td>
    </tr>
    
    <tr>
     <td> <?php echo $this->lang->line("title_total_efectivo"); ?>: </td> <td> <?php echo $efvo;?>  </td>
    </tr>
    <tr>
     <td>  <?php echo $this->lang->line("title_total_ctacte"); ?>:</td> <td><?php echo $ctacte;?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_peones"); ?>:</td> <td><?php echo $peones." <br> [Efvo: $peonesefvo + Cta Cte: $peonescc  ]";?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_tespera"); ?>:</td> <td><?php echo $espera."<br> [Efvo: $esperaefvo + Cta Cte: $esperacc ]";?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_peaje"); ?>:</td> <td><?php echo $peaje."<br> [Efvo: $peajeefvo + Cta Cte: $peajecc  ]";?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_estacionamiento"); ?>:</td> <td><?php echo $estacionamiento."<br> [Efvo: $estacefvo + Cta Cte: $estaccc; ]";?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_otros"); ?>:</td> <td><?php echo $otros."<br> [Efvo: $otrosefvo + Cta Cte: $otroscc ]";?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_seguro"); ?>:</td> <td><?php echo $seguro."<br> [Efvo: $seguroefvo + Cta Cte: $segurocc ]";?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_art"); ?>:</td> <td><?php echo $totalart."<br> [Efvo: $artefvo + Cta Cte: $artcc ]";?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_mudanza"); ?>:</td> <td><?php echo $totalmudanza."<br> [Efvo: $mudanzaefvo + Cta Cte: $mudanzacc ]"; ?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_porcentaje_mudanza"); ?>:</td> <td><?php echo $total_porcentajemudanza."<br> [Efvo: $porcentaje_mudanzaefvo + Cta Cte: $porcentaje_mudanzacc ]"; ?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_porcentaje_ctacte"); ?>:</td> <td><?php echo $total_porcentajecc."<br> [Efvo: $porcentaje_ctacteefvo + Cta Cte: $porcentaje_ctactecc ]"; ?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_iva"); ?>:</td> <td><?php echo $total_iva."<br> [Efvo: $ivaefvo + Cta Cte: $ivacc ]"; ?></td>
    </tr>
     <tr>
     <td>  <?php echo $this->lang->line("title_comisionar"); ?>:</td> <td><?php echo "Efvo: ".$total_parcial_efvo."   Cta.Cte.: ".$total_parcial_cc;?> </td>
    </tr>
     <tr>
     <td>  <?php echo $this->lang->line("title_acliente"); ?> :</td> <td><?php echo "Efvo: ".$total_contado."   Cta.Cte.: ".$totalcc;?> </td>
    </tr>
    
    
    </table>
    <?php } ?>
</body>
</html>

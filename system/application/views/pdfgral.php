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
      
     
      $porcentaje_ctactecc=0;
      $porcentaje_ctacteefvo=0;
      $ivacc=0;
      $ivaefvo=0;
      $total_iva=0;
      $totalart=0;
      $totalmudanza=0;
    
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
        
         <td> <?php if(isset($u["total_efvo"])) {echo number_format($u["total_efvo"],2,".",''); $efvo += $u["total_efvo"];}?> </td>
        
         <td> <?php if (isset($u["total_ctacte"])) {echo number_format($u["total_ctacte"],2,".",''); $ctacte += $u["total_ctacte"]; }?> </td>
         
         <td><?php if (isset($u["total_peon"])) {echo  "Efvo: ".number_format($u["total_peon_efvo"],2,".",'')." <br> CC: ".number_format($u["total_peon_cc"],2,".",''); $peones += $u["total_peon"]; $peonescc += $u["total_peon_cc"]; $peonesefvo += $u["total_peon_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_espera"])) {echo "Efvo: ".number_format($u["total_espera_efvo"],2,".",'')." <br> CC: ".number_format($u["total_espera_cc"],2,".",''); $espera += $u["total_espera"]; $esperacc += $u["total_espera_cc"]; $esperaefvo += $u["total_espera_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_peaje"])) {echo "Efvo: ".number_format($u["total_peaje_efvo"],2,".",'')." <br> CC: ".number_format($u["total_peaje_cc"],2,".",''); $peaje += $u["total_peaje"]; $peajecc += $u["total_peaje_cc"]; $peajeefvo += $u["total_peaje_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_estac"])) {echo "Efvo: ".number_format($u["total_estac_efvo"],2,".",'')." <br> CC: ".number_format($u["total_estac_cc"],2,".",''); $estacionamiento += $u["total_estac"]; $estaccc+=$u["total_estac_cc"]; $estacefvo += $u["total_estac_efvo"];  }?>  </td>
         <td><?php if (isset($u["total_otro"])) {echo "Efvo: ".number_format($u["total_otro_efvo"],2,".",'')." <br> CC: ".number_format($u["total_otro_cc"],2,".",''); $otros += $u["total_otro"]; $otroscc += $u["total_otro_cc"]; $otrosefvo += $u["total_otro_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_seguro"])) {echo "Efvo: ".number_format($u["total_seguro_efvo"],2,".",'')." <br> CC: ".number_format($u["total_seguro_cc"],2,".",''); $seguro += $u["total_seguro"]; $segurocc += $u["total_seguro_cc"]; $seguroefvo += $u["total_seguro_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_mudanza"])) {echo number_format($u["total_mudanza"],2,".",''); $totalmudanza += $u["total_mudanza"];  }?>  </td>
          <td><?php if (isset($u["total_iva"])) {echo "Efvo: ".number_format($u["total_iva_efvo"],2,".",'')." <br> CC: ".number_format($u["total_iva_cc"],2,".",''); $total_iva += $u["total_iva"]; $ivacc += $u["total_iva_cc"]; $ivaefvo += $u["total_iva_efvo"]; }?>  </td>
         <td><?php if (isset($u["total_porcentajecc"])) {echo " CC: ".number_format($u["total_porcentajecc_cc"],2,".",''); $total_porcentajecc += $u["total_porcentajecc"]; $porcentaje_ctactecc += $u["total_porcentajecc_cc"];  }?>  </td>
         <td><?php if (isset($u["total_art"])) {echo "Efvo: ".number_format($u["total_art_efvo"],2,".",'')." <br> CC: ".number_format($u["total_art_cc"],2,".",''); $totalart += $u["total_art"]; $artcc += $u["total_art_cc"]; $artefvo += $u["total_art_efvo"]; }?>  </td>
          
           <td>
           <?php echo "Efvo:"; ?>
           <?php if (isset($u["parcial_efvo"])) echo number_format($u["parcial_efvo"],2,".",''); $total_parcial_efvo +=$u["parcial_efvo"];  ?>
          
           <?php echo "<br> CC:"; ?>
          <?php if (isset($u["parcial_cc"])) echo number_format($u["parcial_cc"],2,".",''); $total_parcial_cc +=$u["parcial_cc"];  ?> 
         
         </td>
          
          <td>
           <?php echo "Efvo:"; ?>
           <?php if (isset($u["total_contado"])) echo number_format($u["total_contado"],2,".",''); $total_contado +=$u["total_contado"];  ?>
          
           <?php echo "<br> CC:"; ?>
          <?php if (isset($u["totalcc"])) echo number_format($u["totalcc"],2,".",''); $totalcc +=$u["totalcc"];  ?> 
         
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
     <td> <?php echo $this->lang->line("title_total_efectivo"); ?>: </td> <td> <?php echo "$ ".number_format($efvo,2,".",'');?>  </td>
    </tr>
    <tr>
     <td>  <?php echo $this->lang->line("title_total_ctacte"); ?>:</td> <td><?php echo "$ ".number_format($ctacte,2,".",'');?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_peones"); ?>:</td> <td><?php echo "$ ".number_format($peones,2,".",'')." <br> [Efvo: $ ".number_format( $peonesefvo,2,".",'')." + Cta Cte: $ ".number_format($peonescc,2,".",'')." ]";?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_tespera"); ?>:</td> <td><?php echo "$ ".number_format($espera,2,".",'')."<br> [Efvo: $ ".number_format( $esperaefvo,2,".",'')." + Cta Cte: $ ".number_format($esperacc,2,".",'')." ]";?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_peaje"); ?>:</td> <td><?php echo "$ ".number_format($peaje,2,".",'')."<br> [Efvo: $ ".number_format( $peajeefvo,2,".",'')." + Cta Cte: $ ".number_format($peajecc,2,".",'')."  ]";?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_estacionamiento"); ?>:</td> <td><?php echo "$ ".number_format($estacionamiento,2,".",'')."<br> [Efvo: $ ".number_format( $estacefvo,2,".",'')." + Cta Cte: $ ".number_format($estaccc,2,".",'')." ]";?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_otros"); ?>:</td> <td><?php echo "$ ".number_format($otros,2,".",'')."<br> [Efvo: $ ".number_format( $otrosefvo,2,".",'')." + Cta Cte: $ ".number_format($otroscc,2,".",'')." ]";?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_seguro"); ?>:</td> <td><?php echo "$ ".number_format($seguro,2,".",'')."<br> [Efvo: $ ".number_format( $seguroefvo,2,".",'')." + Cta Cte: $ ".number_format($segurocc,2,".",'')." ]";?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_art"); ?>:</td> <td><?php echo "$ ".number_format($totalart,2,".",'')."<br> [Efvo: $ ".number_format( $artefvo,2,".",'')." + Cta Cte: $ ".number_format($artcc,2,".",'')." ]";?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_mudanza"); ?>:</td> <td><?php echo "$ ".number_format($totalmudanza,2,".",''); ?> </td>
    </tr>
    
    <tr>
     <td> <?php echo $this->lang->line("title_total_porcentaje_ctacte"); ?>:</td> <td><?php echo "$ ".number_format($total_porcentajecc,2,".",'')."<br> [Efvo: $ ".number_format( $porcentaje_ctacteefvo,2,".",'')." + Cta Cte: $ ".number_format($porcentaje_ctactecc,2,".",'')." ]"; ?> </td>
    </tr>
    <tr>
     <td> <?php echo $this->lang->line("title_total_iva"); ?>:</td> <td><?php echo "$ ".number_format($total_iva,2,".",'')."<br> [Efvo: $ ".number_format( $ivaefvo,2,".",'')." + Cta Cte: $ ".number_format($ivacc,2,".",'')." ]"; ?></td>
    </tr>
     <tr>
     <td>  <?php echo $this->lang->line("title_comisionar"); ?>:</td> <td><?php echo "Efvo: "."$ ".number_format($total_parcial_efvo,2,".",'')."   Cta.Cte.: $ ".number_format($total_parcial_cc,2,".",'');?> </td>
    </tr>
     <tr>
     <td>  <?php echo $this->lang->line("title_acliente"); ?> :</td> <td><?php echo "Efvo: "."$ ".number_format($total_contado,2,".",'')."   Cta.Cte.: $ ".number_format($totalcc,2,".",'');?> </td>
    </tr>
    
    
    </table>
    <?php } ?>
</body>
</html>

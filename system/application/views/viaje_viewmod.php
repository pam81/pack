<script>
  //al entrar pongo foco en primer campo

  $(document).ready(function() {
    <?php if ($abordo) { ?>

      $("#hora_regreso").focus();

    <?php } else { ?>


      $("#abordo_button").focus();

    <?php } ?>


    <?php if ($viaje[0]->show_banner) { ?>

      swal("<?php echo str_replace("\r\n", " ", $viaje[0]->banner); ?>");
    <?php } ?>

    <?php if ($viaje[0]->art) { ?>

      swal("<?php echo  "VIAJE CON ART: $" . $viaje[0]->art_valor; ?>");
    <?php } ?>
  });
</script>




<div id="content">


  <div id="top-bar">
    <h2> <?php echo $this->lang->line("title_mod_viaje"); ?></h2>
    <?php if ($abordo) { ?>
      <div class="tiempo_abordo">
        <div> TIEMPO DESDE ABORDO : <?php if (isset($tiempo)) {
                                      if ($tiempo["dias"] != 0) echo $tiempo["dias"] . " días ";
                                      if ($tiempo["horas"] != 0) echo $tiempo["horas"] . " hs ";
                                      if ($tiempo["minutos"] != 0) echo $tiempo["minutos"] . " min ";
                                      if ($tiempo["segundos"] != 0) echo $tiempo["segundos"] . " seg ";
                                    } ?> </div>
      </div>
      <div class="tiempo_abordo">
        <div> TOTAL= $ <?php if (isset($total_viaje)) echo $total_viaje; ?>

        </div>
      </div>

    <?php } ?>
  </div>
  <hr class="separador">
  <form name="formusuario" id="formViajeClose" method="post" action="<?php if ($abordo) {
                                                                        echo site_url() . "viaje/update/" . $this->uri->segment(3);
                                                                      } else {
                                                                        echo site_url() . "viaje/abordo/" . $this->uri->segment(3);
                                                                      } ?>">
    <?php echo validation_errors('<p class="error">', '</p>'); ?>

    <div class="first_row">
      <div class="form_left">
        <div class="rowform">
          <div class="rowform-label"> <label for="fecha"> <?php echo $this->lang->line("title_fecha"); ?> </label>
          </div>
          <div class="rowform-text">
            <?php
            $year = substr($viaje[0]->fecha_despacho, 0, 4);
            $month = substr($viaje[0]->fecha_despacho, 4, 2);
            $day = substr($viaje[0]->fecha_despacho, 6, 2);
            echo $day . "-" . $month . "-" . $year; ?>
          </div>
        </div>
        <div class="rowform">
          <div class="rowform-label"> <label for="phone"> <?php echo $this->lang->line("title_phone"); ?> </label>
          </div>
          <div class="rowform-text"><?php echo $viaje[0]->phone; ?></div>
        </div>
        <div class="rowform">
          <div class="rowform-label"> <label for="name"> <?php echo $this->lang->line("title_name"); ?> </label>
          </div>

          <div class="rowform-text"> <?php echo $viaje[0]->cliente; ?> </div>
        </div>
        <div class="rowform">
          <div class="rowform-label"> <label for="desde"> <?php echo $this->lang->line("title_desde"); ?> </label>
          </div>
          <div class="rowform-text"> <?php echo $viaje[0]->desde; ?>
            <input type="hidden" name="desde" id="desde" value="<?php echo $viaje[0]->desde; ?> " />
            <input type="button" name="udesde" id="udesde" value="Ubicar" onclick="flete.showLugar('<?php echo base_url() . "mapa.php"; ?>','desde');" />
          </div>
        </div>

        <div class="rowform">
          <div class="rowform-label"> <label for="hasta"> <?php echo $this->lang->line("title_hasta"); ?> </label>
          </div>
          <div class="rowform-text"> <?php echo $viaje[0]->destino; ?>
            <input type="hidden" name="destino" id="destino" value="<?php echo $viaje[0]->destino; ?>" />
            <input type="button" name="udesde" id="udesde" value="Ubicar" onclick="flete.showLugar('<?php echo base_url() . "mapa.php"; ?>','destino');" />

          </div>
        </div>

        <div class="rowform">
          <div class="rowform-label"> <label for="movil"> <?php echo $this->lang->line("title_movil"); ?> </label>
          </div>
          <div class="rowform-text"><?php echo $viaje[0]->movil . " " . $viaje[0]->marca; ?></div>

        </div>
        <div class="rowform">
          <div class="rowform-label"> <label for="chofer"> <?php echo $this->lang->line("title_chofer"); ?> </label>
          </div>
          <div class="rowform-text"> <?php echo $viaje[0]->name . " " . $viaje[0]->lastname; ?> </div>

        </div>

        <div class="rowform">
          <div class="rowform-label"> <label for="chofer"> <?php echo $this->lang->line("title_categoria"); ?> </label>
          </div>
          <div class="rowform-text"> <?php echo $viaje[0]->categoria; ?> </div>

        </div>

        <div class="rowform">
          <div class="rowform-label"> <label for="presupuesto"> <?php echo $this->lang->line("title_presupuesto_aprox"); ?> </label>
          </div>
          <div class="rowform-text"> <?php echo "$" . $viaje[0]->presupuesto_aprox; ?> </div>
        </div>

        <div class="rowform">
          <div class="rowform-label"> <label> <?php echo $this->lang->line("title_valor_mercaderia"); ?> </label>
          </div>
          <div class="rowform-text"> <?php echo $viaje[0]->valor_mercaderia; ?> </div>
        </div>

        <div class="rowform">
          <div class="rowform-label"> <label> <?php echo $this->lang->line("title_excedente_mercaderia"); ?> </label>
          </div>
          <div class="rowform-text"> <?php echo $viaje[0]->mercaderia_excedente; ?> </div>
        </div>

        <div class="rowform">
          <div class="rowform-label"> <label> <?php echo $this->lang->line("title_excedente_monto"); ?> </label>
          </div>
          <div class="rowform-text"> <?php echo $viaje[0]->monto_excedente; ?> </div>
        </div>

        <div class="rowform">
          <div class="rowform-label"> <label> <?php echo $this->lang->line("title_excedente_codigo"); ?> </label>
          </div>
          <div class="rowform-text"> <?php echo $viaje[0]->codigo_excedente; ?> </div>
        </div>

        <div class="rowform">
          <div class="rowform-label"> <label for="observacion"> <?php echo $this->lang->line("title_observacion"); ?> </label>
          </div>
          <div class="rowform-input">
            <textarea name="observacion" tabindex="9"><?php echo set_value("observacion", $viaje[0]->observaciones); ?></textarea>
          </div>
        </div>


      </div>

      <div class="form_rigth">


        <div class="rowform">
          <div class="rowform-label"> <label for="viaje"> <?php echo $this->lang->line("nro_viaje"); ?> </label>
          </div>
          <div class="rowform-text"><?php echo $viaje[0]->id; ?></div>
        </div>

        <div class="rowform">
          <div class="rowform-label"> <label for="nroreserva"> <?php echo $this->lang->line("nro_reserva"); ?> </label>
          </div>
          <div class="rowform-text"><?php echo $viaje[0]->nro_reserva; ?></div>
        </div>
        <div class="rowform">
          <div class="rowform-label"> <label for="hora_despacho"> <?php echo $this->lang->line("hora_despacho"); ?> </label>
          </div>
          <div class="rowform-text"><?php
                                    $h = substr($viaje[0]->hora_despacho, 0, 2);
                                    $m = substr($viaje[0]->hora_despacho, 2, 2);
                                    echo "$h:$m"; ?></div>
        </div>
        <div class="rowform">
          <div class="rowform-label"> <label for="hora_puerta"> <?php echo $this->lang->line("hora_exacta_puerta"); ?> </label>
          </div>
          <div class="rowform-text"><?php
                                    $h = substr($viaje[0]->hexacta_puerta, 0, 2);
                                    $m = substr($viaje[0]->hexacta_puerta, 2, 2);
                                    echo "$h:$m"; ?></div>
        </div>
        <div class="rowform">
          <div class="rowform-label"> <label for="hora_abordo"> <?php echo $this->lang->line("hora_abordo"); ?> </label>
          </div>

          <?php if ($abordo) { ?>
            <div class="rowform-text"><?php
                                      $h = substr($viaje[0]->habordo, 0, 2);
                                      $m = substr($viaje[0]->habordo, 2, 2);
                                      echo "$h:$m"; ?></div>
          <?php } else { ?>
            <div class="rowform-input">

              <input type="text" size="2" readonly="true" name="hora_abordo" id="hora_abordo" value="<?php echo date("H"); ?>" />

              : <input type="text" size="2" readonly="true" name="min_abordo" id="min_abordo" value="<?php echo date("i"); ?>" />

            </div>
          <?php } ?>

        </div>
        <?php if ($abordo) { ?>
          <div class="rowform">
            <div class="rowform-label"> <label for="hora_regreso"> <?php echo $this->lang->line("hora_regreso"); ?> </label>
            </div>
            <div class="rowform-input">
              <?php

              $h = date("H");
              if ($viaje[0]->hregreso != '') {
                $h = substr($viaje[0]->hregreso, 0, 2);
              }
              $m = date("i");
              if ($viaje[0]->hregreso != '') {
                $m = substr($viaje[0]->hregreso, 2, 2);
              }

              ?>
              <input type="text" size="2" name="hora_regreso" tabindex="3" id="hora_regreso" value="<?php echo set_value("hora_regreso", $h); ?>" />

              : <input type="text" size="2" name="min_regreso" tabindex="4" id="min_regreso" value="<?php echo set_value("min_regreso", $m); ?>" />


            </div>
          </div>
          <div class="rowform">
            <div class="rowform-label"> <label for="fecha"> <?php echo $this->lang->line("title_fecha_regreso"); ?> </label>
            </div>
            <div class="rowform-input">
              <?php
              $yr = date("Y");
              $mr = date("m");
              $dr = date("d");

              if ($viaje[0]->fecha_regreso != '') {
                $yr = substr($viaje[0]->fecha_regreso, 0, 4);
                $mr = substr($viaje[0]->fecha_regreso, 4, 2);
                $dr = substr($viaje[0]->fecha_regreso, 6, 2);
              }
              ?>
              <input type="text" size="2" name="regreso_day" tabindex="5" id="regreso_day" value="<?php echo set_value("regreso_day", $dr); ?>" />
              <input type="text" size="2" name="regreso_month" tabindex="6" id="regreso_month" value="<?php echo set_value("regreso_month", $mr); ?>" />
              <input type="text" size="4" name="regreso_year" tabindex="7" id="regreso_year" value="<?php echo set_value("regreso_year", $yr); ?>" />



            </div>
          </div>


          <div class="rowform">
            <div class="rowform-label"> <label for="hora_libera"> <?php echo $this->lang->line("title_hora_libera"); ?> </label>
            </div>
            <div class="rowform-input">
              <?php

              $h = '';
              if ($viaje[0]->hlibera != '') {
                $h = substr($viaje[0]->hlibera, 0, 2);
              }
              $m = '';
              if ($viaje[0]->hlibera != '') {
                $m = substr($viaje[0]->hlibera, 2, 2);
              }

              ?>
              <input type="text" size="2" name="hora_libera" tabindex="7" id="hora_libera" value="<?php echo set_value("hora_libera", $h); ?>" />

              : <input type="text" size="2" name="min_libera" tabindex="7" id="min_libera" value="<?php echo set_value("min_libera", $m); ?>" />


            </div>
          </div>


          <div class="rowform">
            <div>
              <?php if ($viaje[0]->forma_pago == 2) { ?>
                <label for="comefvo"> <?php echo $this->lang->line("pago_ctacte"); ?> </label>
              <?php } else { ?>
                <label for="comefvo"> <?php echo $this->lang->line("pago_efvo"); ?> </label>
              <?php } ?>
            </div>

          </div>

        <?php } ?>

        <div class="buttons">
          <?php if ($abordo && $viaje[0]->cancelado != 1) { ?>
            <?php if ($viaje[0]->forma_pago == 2) { ?>
              <input type="button" tabindex="8" id="change" accesskey="c" name="change" value="<?php echo $this->lang->line("title_change_efvo"); ?>" onclick="if(confirm('<?php echo $this->lang->line("ask_mod_forma_pago"); ?>')) {form.action='<?php echo site_url() . "viaje/change/1/" . $viaje[0]->id; ?>'; form.submit();  } " />
            <?php }
            if ($viaje[0]->forma_pago == 1) { ?>
              <input type="button" tabindex="8" id="change" accesskey="c" name="change" value="<?php echo $this->lang->line("title_change_ctacte"); ?>" onclick="if(confirm('<?php echo $this->lang->line("ask_mod_forma_pago"); ?>')) {form.action='<?php echo site_url() . "viaje/change/2/" . $viaje[0]->id; ?>'; form.submit(); }" />
            <?php } ?>
          <?php } ?>

          <?php if ($abordo) { ?>
            <?php if ($viaje[0]->cerrado == 0) { ?>
              <input type="button" tabindex="22" id="send" accesskey="e" name="send" value="<?php echo $this->lang->line("title_close"); ?>" onclick="flete.validarCloseViaje('<?php echo $this->lang->line("ask_close_viaje"); ?>','<?php echo $viaje[0]->forma_pago; ?>'); " />
            <?php } ?>
          <?php } else { ?>
            <input type="submit" tabindex="1" id="abordo_button" accesskey="a" name="abordo" value="<?php echo $this->lang->line("button_abordo"); ?>" onclick="return confirm('<?php echo $this->lang->line("ask_abordo_viaje"); ?>'); " />
          <?php } ?>

          <input type="reset" tabindex="23" id="clean" accesskey="l" name="clean" value="<?php echo $this->lang->line("button_clean"); ?>" onclick="return confirm('<?php echo $this->lang->line("ask_clean"); ?>'); " />
          <input type="button" tabindex="24" id="changemovil" name="changemovil" value="<?php echo $this->lang->line("button_changemovil"); ?>" onclick="if ( confirm('<?php echo $this->lang->line("ask_change_movil"); ?>')) { form.action='<?php echo site_url() . "viaje/changemovil/" . $viaje[0]->id; ?>'; form.submit();} " />
          <input type="button" tabindex="25" id="save" name="save" value="<?php echo $this->lang->line("button_save"); ?>" onclick="if ( confirm('<?php echo $this->lang->line("ask_save_dataviaje"); ?>')) { form.action='<?php echo site_url() . "viaje/changeData/" . $viaje[0]->id; ?>'; form.submit();} " />
          <input type="button" tabindex="26" id="replicar" name="replicar" value="<?php echo $this->lang->line("button_replicar"); ?>" onclick="if ( confirm('<?php echo $this->lang->line("ask_viaje_toreserva"); ?>')) { form.action='<?php echo site_url() . "viaje/toreserva/" . $viaje[0]->id; ?>'; form.submit();} " />
          <input type="button" tabindex="27" id="moddatos" name="moddatos" value="Modificar Datos" onclick=" window.location.href='<?php echo site_url() . "reserva/mod/" . $viaje[0]->nro_reserva; ?>'" />
          <input type="button" name="ruta" id="ruta" value="Calcular ruta" onclick="flete.showRuta('<?php echo base_url() . "ruta.php"; ?>')" />
        </div> <!-- buttons -->

      </div> <!-- rigth-->

    </div> <!-- up row -->

    <div class="form_left">
      <?php if ($abordo) { ?>
        <div class="rowformMiddle">

          <span class="span_total_viaje">TOTAL $</span>
          <span class="span_total_viaje" id="total_viaje">
            <?php
            $total= $viaje[0]->valor + $viaje[0]->espera + $viaje[0]->peones + $viaje[0]->km +
            $viaje[0]->estacionamiento + $viaje[0]->peaje +   $viaje[0]->art_valor + $viaje[0]->otros +
            $viaje[0]->iva;
            
            echo $total;
            
            ?>
          </span>
          <?php if ($viaje[0]->forma_pago == 2) {
            $total_ctacte = $total + $viaje[0]->porcentaje_ctacte;

            echo "<br><span class=\"span_total_viaje\">TOTAL Cta. Cte. = $</span><span class=\"span_total_viaje\" id=\"total_viaje_ctacte\"> $total_ctacte</span>";
          } ?>

          <?php if ($viaje[0]->hasMudanza) {
            $total_mudanza = $total - $viaje[0]->mudanza;
            echo '<input type="hidden" name="comision_mudanza" id="comision_mudanza" value="' . $comision->mudanza . '">';
            echo "<br><span class=\"span_total_viaje\">TOTAL Chofer = $</span><span class=\"span_total_viaje\" id=\"total_viaje_mudanza\"> $total_mudanza</span>";
          } ?>

        </div>

        <div class="rowform">
          <div class="rowform-label">
            <label for="subtotal"> <?php echo $this->lang->line("title_subtotal") . " $"; ?> </label>
          </div>
          <div class="rowform-input">
            <input type="text" id="subtotal" name="subtotal" value="<?php echo set_value("subtotal", $viaje[0]->valor); ?>" tabindex="10" onKeyUp="getTotal()" />
          </div>
        </div>
        <div class="rowform">
          <div class="rowform-label">
            <label for="espera"> <?php echo $this->lang->line("title_espera") . " $"; ?> </label>
          </div>
          <div class="rowform-input">
            <input type="text" id="espera" name="espera" value="<?php echo set_value("espera", $viaje[0]->espera); ?>" tabindex="11" onKeyUp="getTotal()" />
          </div>
        </div>

        <div class="rowform">
          <div class="rowform-label">
            <label for="km"> <?php echo $this->lang->line("title_km") . " $"; ?> </label>
          </div>
          <div class="rowform-input">
            <input type="text" id="km" name="km" value="<?php echo set_value("km", $viaje[0]->km); ?>" tabindex="12" onKeyUp="getTotal()" />
          </div>
        </div>
        <div class="rowform">
          <div class="rowform-label">
            <label for="cantkm"> <?php echo $this->lang->line("title_cantkm"); ?> </label>
          </div>
          <div class="rowform-input">
            <input type="text" id="cantkm" name="cantkm" value="<?php echo set_value("cantkm", $viaje[0]->cant_km); ?>" tabindex="13" />
          </div>
        </div>



        <div class="rowform">
          <div class="rowform-label"> <label for="iva"> <?php echo $this->lang->line("title_iva") . " $"; ?> </label>
          </div>
          <div class="rowform-input">
            <input type="text" id="iva" name="iva" value="<?php echo set_value("iva", $viaje[0]->iva); ?>" tabindex="14" onKeyUp="getTotal()" />
          </div>
        </div>

        <div class="rowform">
          <div class="rowform-label"> <label for="mudanza"> - <?php echo $this->lang->line("title_mudanza") . " $"; ?> </label>
          </div>
          <div class="rowform-input">
            <input type="text" name="mudanza" readonly id="mudanza" value="<?php echo set_value("mudanza", $viaje[0]->mudanza); ?>" tabindex="15" onKeyUp="getTotal()" />
          </div>
        </div>


      <?php } ?>
      <div class="rowform">
        <div class="rowform-label"> <label for="reservado"> <?php echo $this->lang->line("title_reserved_by"); ?> </label>
        </div>
        <div class="rowform-text"><?php echo $viaje[0]->reservo; ?></div>
      </div>

      <div class="rowform">
        <div class="rowform-label"> <label for="despacho"> <?php echo $this->lang->line("title_despached_by"); ?> </label>
        </div>
        <div class="rowform-text"><?php echo $viaje[0]->despacho; ?></div>
      </div>
      <div class="rowform">
        <div class="rowform-label"> <label for="reserva"> <?php echo $this->lang->line("title_reserva_take"); ?> </label>
        </div>
        <div class="rowform-text"> <?php
                                    $year = substr($viaje[0]->fecha_reserva, 0, 4);
                                    $month = substr($viaje[0]->fecha_reserva, 4, 2);
                                    $day = substr($viaje[0]->fecha_reserva, 6, 2);
                                    $h = substr($viaje[0]->hora_reserva, 0, 2);
                                    $m = substr($viaje[0]->hora_reserva, 2, 2);
                                    echo "$day-$month-$year  a las $h:$m"; ?></div>
      </div>
      <?php  if ($viaje[0]->cerrado == 1) { ?>
      <div class="rowform">
        <div class="rowform-label"> 
        <label for="cerrado_by"> <?php echo $this->lang->line("title_cerrado_by"); ?></label>
        </div>
      <div class="rowform-text"><?php echo $viaje[0]->cerrado_by;?></div>
      </div> 
      <?php } ?>
    </div> <!-- left2 -->
    <div class="form_right">
      <?php if ($abordo) { ?>


        <div class="rowform">
          <div class="rowform-label"> <label for="peones"> <?php echo $this->lang->line("title_peones") . " $"; ?> </label>
          </div>
          <div class="rowform-input">
            <input type="text" id="peones" name="peones" value="<?php echo set_value("peones", $viaje[0]->peones); ?>" tabindex="16" onKeyUp="getTotal()" />
          </div>
        </div>

        <div class="rowform">
          <div class="rowform-label"> <label for="estacionamiento"> <?php echo $this->lang->line("title_estacionamiento") . " $"; ?> </label>
          </div>
          <div class="rowform-input">
            <input type="text" id="estacionamiento" name="estacionamiento" value="<?php echo set_value("estacionamiento", $viaje[0]->estacionamiento); ?>" tabindex="17" onKeyUp="getTotal()" />
          </div>
        </div>

        <div class="rowform">
          <div class="rowform-label"> <label for="peaje"> <?php echo $this->lang->line("title_peaje") . " $"; ?> </label>
          </div>
          <div class="rowform-input">
            <input type="text" id="peaje" name="peaje" value="<?php echo set_value("peaje", $viaje[0]->peaje); ?>" tabindex="18" onKeyUp="getTotal()" />
          </div>
        </div>

        <div class="rowform">
          <div class="rowform-label"> <label for="art"> <?php echo $this->lang->line("title_art"); ?> </label>
          </div>
          <div class="rowform-text">
            <input type="text" readonly name="art" id="art" value="<?php echo set_value("art", $viaje[0]->art_valor); ?> " />
          </div>
        </div>






        <div class="rowform">
          <div class="rowform-label"> <label for="otro"> <?php echo $this->lang->line("title_otros") . " $"; ?> </label>
          </div>
          <div class="rowform-input">
            <input type="text" name="otro" id="otro" value="<?php echo set_value("otro", $viaje[0]->otros); ?>" tabindex="19" onKeyUp="getTotal()" />
          </div>
        </div>

        <div class="rowform">
          <div class="rowform-label"> <label for="pendiente"> Pendiente Pago </label>
          </div>
          <div class="rowform-text">
            <input type="checkbox" name="pendiente" id="pendiente" value="1" <?php if ($viaje[0]->pendiente == 1) {
                                                                                echo "checked";
                                                                              } ?> />
          </div>
        </div>
        <?php if ($viaje[0]->forma_pago == 1) { ?>
          <div class="rowform">
            <div class="rowform-label"> <label for="fecha_pago_day"> Fecha Pago </label>
            </div>
            <div class="rowform-text">
              <?php
              if ($viaje[0]->fecha_pago != '') {

                $yr = substr($viaje[0]->fecha_pago, 0, 4);
                $mr = substr($viaje[0]->fecha_pago, 4, 2);
                $dr = substr($viaje[0]->fecha_pago, 6, 2);
              } else {
                $yr = '';
                $mr = '';
                $dr = '';
              }

              ?>
              <input type="text" name="fecha_pago_day" id="fecha_pago_day" size="2" value="<?php echo set_value("fecha_pago_day", $dr); ?>" />
              <input type="text" name="fecha_pago_month" id="fecha_pago_month" size="2" value="<?php echo set_value("fecha_pago_month", $mr); ?>" />
              <input type="text" name="fecha_pago_year" id="fecha_pago_year" size="4" value="<?php echo set_value("fecha_pago_year", $yr); ?>" />

            </div>
          </div>

          <div class="rowform">
            <div class="rowform-label"> <label for="descripcion_pago"> Descripción Pago </label>
            </div>
            <div class="rowform-text">
              <textarea name="descripcion_pago" id="descripcion_pago"><?php echo set_value("descripcion_pago", $viaje[0]->descripcion_pago); ?></textarea>
            </div>
          </div>

        <?php } ?>

        <?php if ($viaje[0]->forma_pago == 2) { ?>
          <div class="rowform">
            <div class="rowform-label"> <label for="porcentaje_ctacte"> %<?php echo $this->lang->line("title_cta_cte"); ?> $ </label>
            </div>
            <div class="rowform-input">
              <input type="text" readonly="true" id="porcentaje_ctacte" name="porcentaje_ctacte" value="<?php echo set_value("porcentaje_ctacte", $viaje[0]->porcentaje_ctacte); ?>" tabindex="20" />
              <input type="hidden" name="comision_ctacte" id="comision_ctacte" value="<?php if (!$viaje[0]->client_comision) {
                                                                                        echo $comision->cta_cte;
                                                                                      } else {
                                                                                        echo $viaje[0]->client_comision;
                                                                                      } ?>">
            </div>
          </div>
          <div class="rowform">
            <div class="rowform-label"> <label for="voucher"> <?php echo $this->lang->line("title_voucher"); ?> </label>
            </div>
            <div class="rowform-input">
              <input type="text" id="voucher" name="voucher" value="<?php echo set_value("voucher", $viaje[0]->voucher); ?>" tabindex="21" />
            </div>
          </div>
        <?php } ?>

      <?php } ?>
    </div> <!-- right2 -->





  </form>

</div>
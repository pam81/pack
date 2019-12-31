<?php

class Viaje extends Controller
{

  function __construct()
  {
    parent::Controller();
    $this->lang->load("fletpack_site");
    $this->load->library('form_validation');
    $this->load->helper(array('form'));
    $this->load->library('pagination');
    $this->load->model("Current_User");
    $this->load->model("User_model");
    $this->load->model("Flete_model", "flete");
    $this->load->model("Viaje_model");
    $this->load->config("site");
    $this->User_model->verified_login();
  }



  public function index()
  {
    $urlarray = $this->uri->uri_to_assoc(2);
    $movil = 0;
    $code = '';
    $cancelado = 0;
    $pendiente = 0;
    $art = 0;
    $fdesde = date("Ymd");
    $fhasta = date("Ymd");

    if ($this->input->post("searchfield"))
      $movil = $this->db->escape_str($this->input->post("searchfield"));
    else {
      if (isset($urlarray["find"]))
        $movil = $this->db->escape_str($urlarray["find"]);
    }
    $data["movil"] = $movil;

    if ($this->input->post("code"))
      $code = $this->db->escape_str($this->input->post("code"));
    else {
      if (isset($urlarray["code"]))
        $code = $this->db->escape_str($urlarray["code"]);
    }
    $data["code"] = $code;


    if ($this->input->post("checkcancel"))
      $cancelado = $this->db->escape_str($this->input->post("checkcancel"));
    else {
      if (isset($urlarray["checkcancel"]))
        $cancelado = $this->db->escape_str($urlarray["checkcancel"]);
    }
    $data["cancelado"] = $cancelado;

    if ($this->input->post("checkpendiente"))
      $pendiente = $this->db->escape_str($this->input->post("checkpendiente"));
    else {
      if (isset($urlarray["checkpendiente"]))
        $pendiente = $this->db->escape_str($urlarray["checkpendiente"]);
    }
    $data["pendiente"] = $pendiente;


    if ($this->input->post("checkart"))
      $art = $this->db->escape_str($this->input->post("checkart"));
    else {
      if (isset($urlarray["checkart"]))
        $art = $this->db->escape_str($urlarray["checkart"]);
    }
    $data["art"] = $art;

    if ($this->input->post("desde_day") && $this->input->post("desde_month") && $this->input->post("desde_year"))
      $fdesde = $this->db->escape_str($this->input->post("desde_year")) . str_pad($this->db->escape_str($this->input->post("desde_month")), 2, "0", STR_PAD_LEFT) . str_pad($this->db->escape_str($this->input->post("desde_day")), 2, "0", STR_PAD_LEFT);
    else {
      if (isset($urlarray["fdesde"]))
        $fdesde = $this->db->escape_str($urlarray["fdesde"]);
    }
    $data["fdesde"] = $fdesde;

    if ($this->input->post("hasta_day") && $this->input->post("hasta_month") && $this->input->post("hasta_year"))
      $fhasta = $this->db->escape_str($this->input->post("hasta_year")) . str_pad($this->db->escape_str($this->input->post("hasta_month")), 2, "0", STR_PAD_LEFT) . str_pad($this->db->escape_str($this->input->post("hasta_day")), 2, "0", STR_PAD_LEFT);
    else {
      if (isset($urlarray["fhasta"]))
        $fhasta = $this->db->escape_str($urlarray["fhasta"]);
    }
    $data["fhasta"] = $fhasta;
    $array = array("find" => $movil, "fdesde" => $fdesde, "fhasta" => $fhasta);
    $urlarray = $this->uri->uri_to_assoc(2);




    $sql = "select v.*,r.desde, r.destino,m.movil, r.art_valor from viajes v, reservas r, movil m where 
            v.reservaid = r.id";

    if ($movil)
      $sql .= " and m.movil=$movil ";

    if ($cancelado)
      $sql .= " and v.cancelado=1 ";
    if ($pendiente)
      $sql .= " and v.pendiente = 1";
    if ($art)
      $sql .= " and r.art=1 ";
    if ($code)
      $sql .= " and r.codigo_excedente = '$code'";

    $sql .= "    and v.movilid=m.id
                and v.fecha_despacho between $fdesde and $fhasta
          order by r.fecha desc, r.hsalida asc  ";




    $query = $this->db->query($sql);
    $viajes = $query->result();
    $data["viajes"] = $viajes;


    $query = $this->db->get("meses");
    $data["meses"] = $query->result();

    $data["content"] = "viaje_viewlist";
    $this->load->view("index", $data);
  }

  public function despachar($reserva = 0)
  {

    if ($this->Current_User->isHabilitado("ADD_VIAJE")) {



      if ($this->uri->segment(3))
        $reservaid = $this->db->escape_str($this->uri->segment(3));
      else
        $reservaid = $reserva;



      if ($reservaid) {

        if ($this->flete->reservalock($reservaid)) {
          $sql = "select r.*,c.name,c.show_banner,c.banner,p.phone, cat.name as categoria from reservas r, 
       clientes c, phones p, categorias cat
        where r.clienteid=c.id and p.clienteid=c.id and
        p.principal=1 and r.id=$reservaid
        and r.categoriaid = cat.id
       ";
          $query = $this->db->query($sql);
          $reserva = $query->result();

          if ($reserva[0]->despachado == 1) {
            $data["content"] = "message";
            $data["message"] = $this->lang->line("reserva_just_despachada");
            $this->load->view("index", $data);
          } else {
            $data["reserva"] = $reserva;
            $data["content"] = "viaje_viewadd";
            $this->load->view("index", $data);
          }
        } else {
          $data["content"] = "lockeado";
          $data["dir_desbloquea"] = site_url() . "reserva/unlock/" . $reservaid;
          $data["message"] = $this->lang->line("reserva_lockeado");
          $this->load->view("index", $data);
        }
      } else
        show_404();
    } else
      redirect("inicio/denied");
  }

  public function nuevo()
  {

    if ($this->flete->postBlock($this->input->post('postID'))) {

      if ($this->_submit_validateViaje() === FALSE) {
        $this->despachar($this->db->escape_str($this->input->post("reservaid")));
        return;
      } else {

        $query = $this->db->get_where("movil", array("movil" => $this->db->escape_str($this->input->post("movil"))));
        $movil = $query->result();
        $query = $this->db->get_where("reservas", array("id" => $this->db->escape_str($this->input->post("reservaid"))));
        $reserva = $query->result();
        $query = $this->db->get_where("clientes", array("id" => $this->db->escape_str($this->input->post("clienteid"))));
        $cliente = $query->result();
        if (isset($movil[0])) {
          if (isset($reserva[0]) && $reserva[0]->despachado != 1) {

            $record = array(
              'clienteid' => $this->db->escape_str($this->input->post("clienteid")),
              'reservaid' => $this->db->escape_str($this->input->post("reservaid")),
              'observaciones' => $this->input->post("observacion"),
              'despacho' => $this->Current_User->getUsername(),
              'fecha_despacho' => date("Ymd"),
              'hora_despacho' => date("Hi"),
              'movilid' => $movil[0]->id,
              'hllegada_aprox' => $this->db->escape_str($this->input->post("aprox_hour")) . $this->db->escape_str($this->input->post("aprox_min")),
              'forma_pago' => $this->db->escape_str($this->input->post("pago")),
              'hexacta_puerta' => $this->db->escape_str($this->input->post("hpuerta"))
            );

            $this->db->insert("viajes", $record);
            $nroviaje = $this->db->insert_id();

            $this->sendEmailDespacho($this->input->post("clienteid"));

            //coloca la reserva como despachada y desbloqueada
            $this->db->update("reservas", array("despachado" => 1, "bloqueado" => 0, "bloqueado_by" => ''), array("id" => $this->db->escape_str($this->input->post("reservaid"))));
            //coloco al movil como en viaje
            $this->db->update("movil", array("baseid" => -1, "ordenbase" => 0), array("id" => $movil[0]->id));
            //debo reordenar los moviles en la base
            $this->flete->ordenamiento($movil[0]->baseid);

            //verificar si no fue ingresado en una base debo ingresarlo

            $sql = "select * from movil_trabaja where idmovil=" . $movil[0]->id . " and fecha_ingreso=" . date("Ymd") . " and hora_egreso is null";
            $query = $this->db->query($sql);

            $mt = $query->result();
            if (!isset($mt[0])) {
              $record = array(
                'idmovil' => $movil[0]->id,
                'fecha_ingreso' => $record["fecha_despacho"],
                'hora_ingreso' => $record["hora_despacho"],
                'movil' => $movil[0]->movil
              );
              $this->db->insert("movil_trabaja", $record);
            }
            redirect("viaje/success/$nroviaje");
          } else {
            $data["message"] = $this->lang->line("reserva_just_despachada");
            $data["content"] = "noaccess";
            $this->load->view("index", $data);
          }
        } else {
          $data["message"] = $this->lang->line("no_movil_found");
          $data["content"] = "noaccess";
          $this->load->view("index", $data);
        }
      }
    } else {
      $data["message"] = $this->lang->line("reserva_just_despachada");
      $data["content"] = "noaccess";
      $this->load->view("index", $data);
    }
  }

  public function sendEmailDespacho($clienteid)
  {
    $query = $this->db->get_where("clientes", array("id" => $clienteid));
    $cliente = $query->result();
    $this->config->load('site');
    $config['mailtype'] = $this->config->item("mail_type");
    $config['smtp_host'] = $this->config->item("smtp_host");
    $config['smtp_user'] = $this->config->item("smtp_user");
    $config['smtp_pass'] = $this->config->item("smtp_pass");
    $config['smtp_port'] = $this->config->item("smtp_port");
    $config['protocol'] = $this->config->item("protocol");
    $config['validate'] = $this->config->item("validate");
    $this->load->library('email', $config);
    $this->email->set_newline("\r\n");
    $this->email->from($this->config->item("email_send"), $this->config->item("name_from"));
    $this->email->to($cliente[0]->email);
    $this->email->subject("Confirmación de Envió de Móvil - Fletpack");

    $message = "<p>Hola " . $cliente[0]->name . "</p> 
          <p>Queremos informarte que ya se ha enviado el móvil</p>
           <br /> <br />
          <p>Saludos <br> Fletpack</p>
        ";

    $this->email->message($message);
    if (@$this->email->send()) {
      return true;
    } else {
      //echo $this->email->print_debugger();
      return false;
    }
  }

  public function success()
  {
    $nro_viaje = $this->uri->segment(3);
    $data["content"] = "success";
    $data["message"] = $this->lang->line("message_success_add_viaje") . " " . $nro_viaje;
    $data["url_back"] = site_url() . "inicio";
    $this->load->view("index", $data);
  }

  //verificar que el movil este activo 

  public function _submit_validateViaje()
  {

    $this->form_validation->set_rules('movil', $this->lang->line('title_movil'), 'trim|required|max_lenght[50]|callback_existMovil|callback_notDocMovil|callback_limitSaldoMovil');
    $this->form_validation->set_message('existMovil', $this->lang->line("error_notexist_movil"));
    $this->form_validation->set_message('notDocMovil', $this->lang->line("error_notdocumentacion_movil"));
    $this->form_validation->set_message('limitSaldoMovil', $this->lang->line("error_limit_saldo_movil"));
    return $this->form_validation->run();
  }
  //ver que el movil existe
  function existMovil()
  {
    $nromovil = $this->db->escape_str($this->input->post("movil"));
    $query = $this->db->get_where("movil", array("active" => 1, "movil" => $nromovil));
    $movil = $query->result();
    if (count($movil) > 0)
      return true;
    else
      return false;
  }
  //verificar que la documentacion este bien
  function notDocMovil()
  {    //si pone el codigo y valido no valido directamente asigna
    //sino valida
    if (!$this->validPassword()) {
      $nromovil = $this->db->escape_str($this->input->post("movil"));
      return $this->flete->verificaDocMovil($nromovil);
    } else {
      return true;
    }
  }

  function limitSaldoMovil()
  {
    $movil = $this->db->escape_str($this->input->post("movil"));
    $sql = "select r.* from recaudacion r inner join movil m on m.id = r.idmovil where 
    m.movil=" . $movil . " order by r.fecha desc limit 0,1";
    $query = $this->db->query($sql);
    $recaudacion = $query->result();
    if (count($recaudacion) == 1) {
      $saldoMovil = $recaudacion[0]->saldo;
      $query = $this->db->get("comision");
      $comision = $query->result();  //cuando le debemos la movil esta en negativo
      if ($saldoMovil > $comision[0]->saldo) {
        return false;
      } else {
        return true;
      }
    } else { //no hay recaudacion definida
      return true;
    }
  }

  //verificar password para asignar movil sin documentación al día
  public function validPassword()
  {
    $codigo = $this->input->post("passmovil");
    $pass = sha1($codigo);
    $this->db->where("tipo", "asignar_viaje");
    $query = $this->db->get("passwords");
    $password = $query->row(0);
    $expire = strtotime($password->expire);
    $today = strtotime("now");

    if ($pass == $password->codigo && $today < $expire) {
      return true;
    } else {
      return false;
    }
  }

  function diferenciaTime($hora, $fecha, $regreso, $fecha_regreso)
  {
    $h = substr($hora, 0, 2);
    $m = substr($hora, 2, 2);
    $year = substr($fecha, 0, 4);
    $month = substr($fecha, 4, 2);
    $day = substr($fecha, 6, 2);
    //hasta ahora siempre que no este seteada fecha de regreso 
    $timestamp1 = mktime($h, $m, 0, $month, $day, $year);
    //si la hora de regreso != 0000 ver si hay fecha de regreso
    if ($regreso == '') {

      $timestamp2 = strtotime("now");
    } else {
      $year = substr($fecha_regreso, 0, 4);
      $month = substr($fecha_regreso, 4, 2);
      $day = substr($fecha_regreso, 6, 2);
      $hr = substr($regreso, 0, 2);
      $mr = substr($regreso, 2, 2);
      $timestamp2 = mktime($hr, $mr, 0, $month, $day, $year);
    }
    $s = 0;
    $m = 0;
    $h = 0;
    $d = 0;

    $date1 = date('Y-m-d H:i:s', $timestamp1);
    $date2 = date('Y-m-d H:i:s', $timestamp2);
    if ($date1 < $date2) {
      $s = strtotime($date2) - strtotime($date1);

      $d = intval($s / 86400);
      $s -= $d * 86400;
      $h = intval($s / 3600);
      $s -= $h * 3600;
      $m = intval($s / 60);
      $s -= $m * 60;
    }

    $tiempo = array(
      'segundos' => $s,
      'minutos' => $m,
      'horas' => $h,
      'dias' => $d
    );

    return $tiempo;
  }

  function estimarValor($viajeid, $tiempo)
  {
    $sql = "select v.* from valores v, viajes vi, reservas r
      where vi.reservaid = r.id and r.categoriaid = v.categoriaid
      and vi.id=$viajeid
     ";
    $query = $this->db->query($sql);
    $valor = $query->result();

    $horas_totales = ($tiempo["dias"] * 24) + $tiempo["horas"];
    $minutos_totales = $tiempo["minutos"];


    if ($horas_totales == 0) {
      return $valor[0]->valorhora; //cobro una hora no se fracciona

    } else {
      //mientras se este debajo del primer ciclo se cobra la hora entera sin fraccionar
      if ($horas_totales == $valor[0]->primerciclo && $minutos_totales == 0)
        return ($horas_totales * $valor[0]->valorhora);
      else {
        //esta en el primer ciclo y se puede comenzar a fraccionar 
        if ($horas_totales >= $valor[0]->primerciclo && $horas_totales < $valor[0]->segundociclo) {
          $cant = ceil($minutos_totales / $valor[0]->fraccion);
          $add = ($cant * $valor[0]->fraccion * $valor[0]->valorhora) / 60;
          return ($horas_totales * $valor[0]->valorhora) + $add;
        }  //esta en el segundo ciclo cobro horas del primer ciclo y el segundo
        else {

          $cant = ceil($minutos_totales / $valor[0]->fraccion);
          $add = ($cant * $valor[0]->fraccion * $valor[0]->valorhora2) / 60;
          //si son 3 o mas horas debo cobrar con valorhora2
          return ((($horas_totales - $valor[0]->primerciclo) * $valor[0]->valorhora2) + ($valor[0]->primerciclo * $valor[0]->valorhora) + $add);
        }
      }
    }
  }


  public function lock($id)
  {
    $this->db->trans_start();
    $query = $this->db->get_where("viajes", array("id" => $id));
    $viaje = $query->result();
    $lockeo = false;
    if (isset($viaje[0]) && $viaje[0]->bloqueado == 0) {
      $record = array(
        'bloqueado' => 1,
        'bloqueado_by' => $this->Current_User->getUsername()
      );
      $this->db->update("viajes", $record, array("id" => $id));
      $lockeo = true;
    } else { //si soy yo el que lo lockeo me debe permitir ingresar
      if (isset($viaje[0]) && $viaje[0]->bloqueado == 1 && $viaje[0]->bloqueado_by == $this->Current_User->getUsername())
        $lockeo = true;
    }
    $this->db->trans_complete();
    return $lockeo;
  }

  public function unlock()
  {
    $id = $this->db->escape_str($this->uri->segment(3));
    $retorna = array("status" => "ok", "msg" => '');
    if ($id) {
      $this->db->trans_start();
      $query = $this->db->get_where("viajes", array("id" => $id));
      $viaje = $query->result();

      if (isset($viaje[0]) && $viaje[0]->bloqueado == 1) {
        $record = array(
          'bloqueado' => 0,
          'bloqueado_by' => ''
        );
        $this->db->update("viajes", $record, array("id" => $id));
      }
      $this->db->trans_complete();
    } else {
      $retorna["estatus"] = "error";
      $retorna["msg"] = "No se definio ID del viaje";
    }
    echo json_encode($retorna);
  }



  function mod()
  {
    if ($this->Current_User->isHabilitado("ADD_VIAJE")) {

      $id = $this->db->escape_str($this->uri->segment(3));
      if ($id) {
        if ($this->lock($id)) {
          $sql = "select v.*,c.name as cliente,c.comision as client_comision,c.show_banner,c.banner,p.phone,r.fecha as fecha,
           r.id as nro_reserva,r.presupuesto_aprox, r.hasMudanza, 
           r.reservo,r.fecha_reserva,r.hora_reserva, r.desde, r.destino,r.valor_mercaderia,r.art, r.art_valor,
           r.mercaderia_excedente,r.monto_excedente,r.codigo_excedente,m.marca,
            ch.name,ch.lastname,m.movil, u.name as categoria
            from viajes v,clientes c, phones p,
            reservas r, movil m, movil_chofer mc, choferes ch,
            categorias u
            where v.clienteid = c.id and p.clienteid = c.id and p.principal=1
            and v.reservaid = r.id  and v.movilid=m.id
            and mc.movilid=m.id and ch.id=mc.choferid
            and r.categoriaid = u.id
            and v.id = $id
            ";
          $query = $this->db->query($sql);
          $viaje = $query->result();
          $data["viaje"] = $viaje;
          $abordo = false;
          if ($viaje[0]->fecha_abordo != '')
            $abordo = true;
          $data["abordo"] = $abordo;

          $this->db->order_by("id");
          $query = $this->db->get("meses");
          $data["meses"] = $query->result();
          //si el viaje se cancelo  no calculo  el tiempo 
          if ($abordo  && $viaje[0]->cancelado != 1) {
            $tiempo = $this->diferenciaTime($viaje[0]->habordo, $viaje[0]->fecha_abordo, $viaje[0]->hregreso, $viaje[0]->fecha_regreso);
            $data["tiempo"] = $tiempo;
            $data["total_viaje"] = round($this->estimarValor($id, $tiempo), 2);
          }
          $query = $this->db->query("select * from comision");
          $comision = $query->result();
          $data["comision"] = $comision[0];

          $data["dir_desbloquea"] = site_url() . "viaje/unlock/" . $id;
          $data["content"] = "viaje_viewmod";
          $this->load->view("index", $data);
        } else {
          $data["content"] = "lockeado";
          $data["dir_desbloquea"] = site_url() . "viaje/unlock/" . $id;
          $data["message"] = $this->lang->line("viaje_lockeado");
          $this->load->view("index", $data);
        }
      } else
        show_404();
    } else
      redirect("inicio/denied");
  }

  function abordo()
  {

    $id = $this->db->escape_str($this->uri->segment(3));
    if ($id) {

      $record = array();
      $record["habordo"] = $this->db->escape_str($this->input->post("hora_abordo")) . $this->db->escape_str($this->input->post("min_abordo"));
      $record["fecha_abordo"] = date("Ymd");
      $this->db->update("viajes", $record, array("id" => $id));
      redirect("inicio");
    } else
      show_404();
  }

  function change()
  {
    $id = $this->db->escape_str($this->uri->segment(4));
    $forma = $this->db->escape_str($this->uri->segment(3));
    if ($id) {
      $record = array();
      $record["forma_pago"] = $forma;
      $this->db->update("viajes", $record, array("id" => $id));
      redirect("viaje/mod/$id");
    } else
      show_404();
  }

  function update()
  {
    $id = $this->db->escape_str($this->uri->segment(3));


    if ($id)  //se cierra el viaje
    {
      $record = array();

      $record["fecha_regreso"] = $this->db->escape_str($this->input->post("regreso_year")) . str_pad($this->db->escape_str($this->input->post("regreso_month")), 2, "0", STR_PAD_LEFT) . str_pad($this->db->escape_str($this->input->post("regreso_day")), 2, "0", STR_PAD_LEFT);
      $record["hregreso"] = str_pad($this->db->escape_str($this->input->post("hora_regreso")), 2, "0", STR_PAD_LEFT) . str_pad($this->db->escape_str($this->input->post("min_regreso")), 2, "0", STR_PAD_LEFT);
      if ($this->input->post("hora_libera"))
        $record["hlibera"] = str_pad($this->db->escape_str($this->input->post("hora_libera")), 2, "0", STR_PAD_LEFT) . str_pad($this->db->escape_str($this->input->post("min_libera")), 2, "0", STR_PAD_LEFT);
      $record["observaciones"] = $this->input->post("observacion");

      if ($this->input->post("subtotal"))
        $record["valor"] = $this->input->post("subtotal");
      else
        $record["valor"] = 0;

      if ($this->input->post("km"))
        $record["km"] = $this->input->post("km");
      else
        $record["km"] = 0;

      if ($this->input->post("cantkm"))
        $record["cant_km"] = $this->input->post("cantkm");
      else
        $record["cant_km"] = 0;

      if ($this->input->post("peaje"))
        $record["peaje"] = $this->input->post("peaje");
      else
        $record["peaje"] = 0;

      if ($this->input->post("estacionamiento"))
        $record["estacionamiento"] = $this->input->post("estacionamiento");
      else
        $record["estacionamiento"] = 0;

      if ($this->input->post("peones"))
        $record["peones"] = $this->input->post("peones");
      else
        $record["peones"] = 0;

      if ($this->input->post("otro"))
        $record["otros"] = $this->input->post("otro");
      else
        $record["otros"] = 0;

      if ($this->input->post("espera"))
        $record["espera"] = $this->input->post("espera");
      else
        $record["espera"] = 0;

      if ($this->input->post("mudanza"))
        $record["mudanza"] = $this->input->post("mudanza");
      else
        $record["mudanza"] = 0;

      if ($this->input->post("porcentaje_mudanza"))
        $record["porcentaje_mudanza"] = $this->input->post("porcentaje_mudanza");
      else
        $record["porcentaje_mudanza"] = 0;

      if ($this->input->post("porcentaje_ctacte"))
        $record["porcentaje_ctacte"] = $this->input->post("porcentaje_ctacte");
      else
        $record["porcentaje_ctacte"] = 0;

      if ($this->input->post("iva"))
        $record["iva"] = $this->input->post("iva");
      else
        $record["iva"] = 0;

      if ($this->input->post("pendiente"))
        $record["pendiente"] = $this->input->post("pendiente");
      else
        $record["pendiente"] = 0;

      if ($this->input->post('descripcion_pago')) {
        $record["descripcion_pago"] = $this->input->post('descripcion_pago');
      }

      if ($this->input->post("fecha_pago_year")) {
        $record["fecha_pago"] = $this->db->escape_str($this->input->post("fecha_pago_year")) . str_pad($this->db->escape_str($this->input->post("fecha_pago_month")), 2, "0", STR_PAD_LEFT) . str_pad($this->db->escape_str($this->input->post("fecha_pago_day")), 2, "0", STR_PAD_LEFT);
      }

      $record["voucher"] = $this->db->escape_str($this->input->post("voucher"));
      $record["cerrado"] = 1;
      $record["cerrado_by"] = $this->Current_User->getUsername();

      $sql = "select c.* from clientes c inner join viajes v on v.clienteid=c.id where v.id=$id";
      $query = $this->db->query($sql);
      $cliente = $query->result();
      if (!$cliente[0]->diferido) { //si no es un cliente diferido comisiona el mismo dia del cierre del viaje
        $record["fecha_comisionar"] = date("Ymd");
        $this->db->update("viajes", $record, array("id" => $id));
        $this->Viaje_model->updateDiaria($id);
      } else {
        $this->db->update("viajes", $record, array("id" => $id));
      }


      redirect("viaje/asignarBase/$id");
    } else
      show_404();
  }

  public function cancelar()
  {
    if ($this->Current_User->isHabilitado("CANCEL_VIAJE")) {

      $nroviaje = $this->db->escape_str($this->uri->segment(3));
      if ($nroviaje) {
        $data["content"] = "viaje_viewcancelar";
        $data["nroviaje"] = $nroviaje;
        $this->load->view("index", $data);
      } else
        show_404();
    } else
      redirect("inicio/denied");
  }

  public function cancel()
  {

    $nroviaje = $this->db->escape_str($this->uri->segment(3));
    if ($nroviaje) {
      $record = array(
        'cancelado' => 1,
        'cancelo' => $this->Current_User->getUsername(),
        'fecha_cancel' => date("Ymd"),
        'hora_cancel' => date("Hi"),
        'causa_cancel' => $this->input->post("motivo"),
        'fecha_abordo' => date("Ymd"),
        'habordo' => date("Hi")
      );
      $this->db->update("viajes", $record, array("id" => $nroviaje));
      redirect("viaje/asignarBase/$nroviaje/1");
    } else
      show_404();
  }

  public function asignarBase()
  {
    $nroviaje = $this->db->escape_str($this->uri->segment(3));
    if ($nroviaje) {
      $sql = "select m.movil,v.id as viajeid from movil m, viajes v where v.id=$nroviaje
               and v.movilid = m.id";
      $query = $this->db->query($sql);

      $data["movil"] = $query->result();
      $query = $this->db->get("bases");
      $data["bases"] = $query->result();
      if ($this->uri->segment(4))
        $data["position"] = $this->uri->segment(4);
      else
        $data["position"] = 0;
      $data["content"] = "asignarbase_cambiar";
      $this->load->view("index", $data);
    } else
      show_404();
  }


  public function regresando()
  {
    $id = $this->db->escape_str($this->uri->segment(3));
    if ($id) {

      $this->db->update("viajes", array("regresando" => 1, "regresando_desde" => $this->db->escape_str($this->input->post("regresando"))), array("id" => $id));
      redirect("inicio");
    } else
      show_404();
  }

  public function redirect()
  {


    $movil = $this->db->escape_str($this->uri->segment(3));
    if ($movil) {
      $fecha = date("Ymd");
      //Ver si el viaje esta cerrado pero en realidad el movil regresando
      //permitir asignar a una base el movil
      $sql = "select v.id from viajes v, movil m where v.movilid=m.id
            and fecha_despacho=$fecha and m.movil = $movil and regresando=1";

      $query = $this->db->query($sql);
      $viaje = $query->result();
      if (isset($viaje[0]) && $viaje[0]->id != '') {
        redirect("viaje/retornaBase/" . $viaje[0]->id);
      } else {
        //que el viaje no este cerrado, que no este cancelado
        // que sea de hoy



        $sql = "select v.id, max(hora_despacho) from viajes v, movil m where v.movilid=m.id and
             fecha_despacho=$fecha and m.movil = $movil and cerrado=0
             and cancelado=0 ";
        $query = $this->db->query($sql);
        $viaje = $query->result();
        if (isset($viaje[0]) && $viaje[0]->id != '')
          redirect("viaje/mod/" . $viaje[0]->id);
        else {
          $data["content"] = "success";
          $data["message"] = $this->lang->line("not_movil_en_viaje");
          $data["url_back"] = site_url() . "inicio";
          $this->load->view("index", $data);
        }
      }
    } else
      redirect("inicio");
  }

  public function retornaBase()
  {
    $nroviaje = $this->db->escape_str($this->uri->segment(3));
    if ($nroviaje) {
      $sql = "select m.movil,v.id as viajeid from movil m, viajes v where v.id=$nroviaje
               and v.movilid = m.id";
      $query = $this->db->query($sql);

      $data["movil"] = $query->result();
      $query = $this->db->get("bases");
      $data["bases"] = $query->result();
      $data["content"] = "retorna_base";
      $this->load->view("index", $data);
    } else
      show_404();
  }


  public function visualiza()
  {


    $id = $this->db->escape_str($this->uri->segment(3));
    if ($id) {
      redirect("viaje/mod/$id");
      /*if ($this->lock($id)) {


        $sql = "select v.*,c.name as cliente,p.phone,r.fecha as fecha,r.id as nro_reserva,r.presupuesto_aprox,
           r.reservo,r.fecha_reserva,r.hora_reserva, r.desde, r.destino,r.valor_mercaderia,r.art, r.art_valor,
           r.mercaderia_excedente,r.monto_excedente,r.codigo_excedente,m.marca,r.hasMudanza,
            ch.name,ch.lastname,m.movil, u.name as categoria
            from viajes v,clientes c, phones p,
            reservas r, movil m, movil_chofer mc, choferes ch,
            categorias u
            where v.clienteid = c.id and p.clienteid = c.id and p.principal=1
            and v.reservaid = r.id  and v.movilid=m.id
            and mc.movilid=m.id and ch.id=mc.choferid
            and r.categoriaid = u.id
            and v.id = $id
            ";
        $query = $this->db->query($sql);
        $viaje = $query->result();
        $data["viaje"] = $viaje;


        $this->db->order_by("id");
        $query = $this->db->get("meses");
        $data["meses"] = $query->result();
        $abordo = false;
        if ($viaje[0]->fecha_abordo != '')
          $abordo = true;
        //si el viaje se cancelo no calculo nada el tiempo  
        if ($abordo && $viaje[0]->cancelado != 1) {
          $tiempo = $this->diferenciaTime($viaje[0]->habordo, $viaje[0]->fecha_abordo, $viaje[0]->hregreso, $viaje[0]->fecha_regreso);
          $data["tiempo"] = $tiempo;
          $data["total_viaje"] = round($this->estimarValor($id, $tiempo), 2);
        }

        $query = $this->db->query("select * from comision");
        $comision = $query->result();
        $data["comision"] = $comision[0];

        $data["dir_desbloquea"] = site_url() . "viaje/unlock/" . $id;
        //$data["content"] = "viaje_viewchange";

        $data["abordo"] = $abordo;
        $data["content"] = "viaje_viewmod";
        $this->load->view("index", $data);
      } else {
        $data["content"] = "lockeado";
        $data["dir_desbloquea"] = site_url() . "viaje/unlock/" . $id;
        $data["message"] = $this->lang->line("viaje_lockeado");
        $this->load->view("index", $data);
      }*/
    } else
      show_404();
  }

  public function changeData()
  {
    $id = $this->db->escape_str($this->uri->segment(3));
    if ($id) {
      $record = array();
      $sql = " select * from viajes WHERE id=" . $id;
      $query = $this->db->query($sql);
      $viaje = $query->result();

      $record["fecha_regreso"] = $this->db->escape_str($this->input->post("regreso_year")) . str_pad($this->db->escape_str($this->input->post("regreso_month")), 2, "0", STR_PAD_LEFT) . str_pad($this->db->escape_str($this->input->post("regreso_day")), 2, "0", STR_PAD_LEFT);

      $record["hregreso"] = str_pad($this->db->escape_str($this->input->post("hora_regreso")), 2, "0", STR_PAD_LEFT) . str_pad($this->db->escape_str($this->input->post("min_regreso")), 2, "0", STR_PAD_LEFT);
      $record["habordo"] = str_pad($this->db->escape_str($this->input->post("hora_abordo")), 2, "0", STR_PAD_LEFT) . str_pad($this->db->escape_str($this->input->post("min_abordo")), 2, "0", STR_PAD_LEFT);

      $record["observaciones"] = $this->input->post("observacion");
      if ($this->input->post("comisionar_year") && $this->input->post("comisionar_month") && $this->input->post("comisionar_day")) {
        $record["fecha_comisionar"] = $this->db->escape_str($this->input->post("comisionar_year")) .
          str_pad($this->db->escape_str($this->input->post("comisionar_month")), 2, "0", STR_PAD_LEFT)
          . str_pad($this->db->escape_str($this->input->post("comisionar_day")), 2, "0", STR_PAD_LEFT);
      }
      if ($this->input->post("subtotal"))
        $record["valor"] = $this->input->post("subtotal");
      else
        $record["valor"] = 0;

      if ($this->input->post("km"))
        $record["km"] = $this->input->post("km");
      else
        $record["km"] = 0;

      if ($this->input->post("cantkm"))
        $record["cant_km"] = $this->input->post("cantkm");
      else
        $record["cant_km"] = 0;

      if ($this->input->post("peaje"))
        $record["peaje"] = $this->input->post("peaje");
      else
        $record["peaje"] = 0;

      if ($this->input->post("estacionamiento"))
        $record["estacionamiento"] = $this->input->post("estacionamiento");
      else
        $record["estacionamiento"] = 0;

      if ($this->input->post("peones"))
        $record["peones"] = $this->input->post("peones");
      else
        $record["peones"] = 0;

      if ($this->input->post("otro"))
        $record["otros"] = $this->input->post("otro");
      else
        $record["otros"] = 0;

      if ($this->input->post("espera"))
        $record["espera"] = $this->input->post("espera");
      else
        $record["espera"] = 0;

      if ($this->input->post("mudanza"))
        $record["mudanza"] = $this->input->post("mudanza");
      else
        $record["mudanza"] = 0;

      if ($this->input->post("porcentaje_mudanza"))
        $record["porcentaje_mudanza"] = $this->input->post("porcentaje_mudanza");
      else
        $record["porcentaje_mudanza"] = 0;

      if ($this->input->post("porcentaje_ctacte"))
        $record["porcentaje_ctacte"] = $this->input->post("porcentaje_ctacte");
      else
        $record["porcentaje_ctacte"] = 0;

      if ($this->input->post("iva"))
        $record["iva"] = $this->input->post("iva");
      else
        $record["iva"] = 0;

      $record["voucher"] = $this->input->post("voucher");
      $record["causa_cancel"] = $this->input->post("cancelado");

      $this->db->update("viajes", $record, array("id" => $id));

      $sql = " select * from viajes WHERE id=" . $id;
      $query = $this->db->query($sql);
      $viaje = $query->result();

      //al modificar en estado cerrado debo actualizar el saldo de recaudacion chofer
      //si fecha_comisionar no esta seteada no debo actualizar recaudaciones
      if ($viaje[0]->cerrado == 1 && $viaje[0]->fecha_comisionar) {
        $this->Viaje_model->diffDiaria($id);
      }

      redirect("viaje/index/$id/" . $this->uri->segment(4));
    } else
      show_404();
  }

  function changemovil()
  {
    $id = $this->db->escape_str($this->uri->segment(3));
    if ($id) {
      if ($this->lock($id)) {
        $sql = "select v.*,c.name as cliente,p.phone,r.fecha as fecha,r.id as nro_reserva,r.presupuesto_aprox,
           r.reservo,r.fecha_reserva,r.hora_reserva, r.desde, r.destino,m.marca,
            ch.name,ch.lastname,m.movil
            from viajes v,clientes c, phones p,
            reservas r, movil m, movil_chofer mc, choferes ch
            where v.clienteid = c.id and p.clienteid = c.id and p.principal=1
            and v.reservaid = r.id  and v.movilid=m.id
            and mc.movilid=m.id and ch.id=mc.choferid
            and v.id = $id
            ";

        $query = $this->db->query($sql);
        $data["viaje"] = $query->result();
        $data["content"] = "viaje_changemovil";
        $this->load->view("index", $data);
      } else {
        $data["content"] = "lockeado";
        $data["dir_desbloquea"] = site_url() . "viaje/unlock/" . $id;
        $data["message"] = $this->lang->line("viaje_lockeado");
        $this->load->view("index", $data);
      }
    } else
      show_404();
  }


  //al cambiar el movil pido donde enviar el que estaba
  //y saco de la base el movil
  //verificar que el movil pueda asginarse a un viaje
  function updatemovil()
  {

    $id = $this->db->escape_str($this->uri->segment(3));
    if ($id) {
      if ($this->_submit_validateViaje() === FALSE) {
        $this->changemovil();
        return;
      } else {


        $sql = "select m.id as movilid,v.id as viajeid from movil m, viajes v where v.id=$id
               and v.movilid = m.id";
        $query = $this->db->query($sql);
        $viaje = $query->result();
        if (isset($viaje[0])) {
          $movil_anterior = $viaje[0]->movilid;

          $query = $this->db->get_where("movil", array("movil" => $this->db->escape_str($this->input->post("movil"))));
          $movil = $query->result();
          if (isset($movil[0])) {
            $record = array();
            $record["movilid"] = $movil[0]->id;
            $this->db->where("id", $id);
            $this->db->update("viajes", $record);
          }

          //el movil asignado quitarlo de la base si esta
          $this->db->update("movil", array("baseid" => -1, "ordenbase" => 0), array("id" => $movil[0]->id));
          //debo reordenar los moviles en la base
          $this->flete->ordenamiento($movil[0]->baseid);

          //asinar el movil anterior a una base
          redirect("viaje/asignarBaseChange/$movil_anterior");
        } else
          show_404();
      }
    } else
      show_404();
  }

  public function asignarBaseChange()
  {
    $movil = $this->uri->segment(3);
    $sql = "select m.movil from movil m where 
                m.id=$movil";
    $query = $this->db->query($sql);

    $data["movil"] = $query->result();
    $query = $this->db->get("bases");
    $data["bases"] = $query->result();
    $data["content"] = "reasignarbase_cambiar";
    $this->load->view("index", $data);
  }

  public function saveData()
  {

    $id = $this->uri->segment(3);
    if ($id) {
      $record = array();
      $record["observaciones"] = $this->input->post("observacion");
      $record["pendiente"] = $this->input->post('pendiente');
      if ($this->input->post('descripcion_pago')) {
        $record["descripcion_pago"] = $this->input->post('descripcion_pago');
      }
      if ($this->input->post("fecha_pago_year")) {
        $record["fecha_pago"] = $this->db->escape_str($this->input->post("fecha_pago_year")) . str_pad($this->db->escape_str($this->input->post("fecha_pago_month")), 2, "0", STR_PAD_LEFT) . str_pad($this->db->escape_str($this->input->post("fecha_pago_day")), 2, "0", STR_PAD_LEFT);
      }
      if ($this->input->post("hora_libera"))
        $record["hlibera"] = str_pad($this->db->escape_str($this->input->post("hora_libera")), 2, "0", STR_PAD_LEFT) . str_pad($this->db->escape_str($this->input->post("min_libera")), 2, "0", STR_PAD_LEFT);
      $this->db->update("viajes", $record, array("id" => $id));
      redirect("inicio");
    } else
      show_404();
  }

  public function toreserva()
  {
    if ($this->Current_User->isHabilitado("CANCEL_VIAJE")) {
      $id = $this->uri->segment(3);
      if ($id) {
        $sql = "select r.*,p.phone,c.name from reservas r, viajes v, phones p, clientes c
        where v.id=$id and r.id=v.reservaid and p.clienteid=v.clienteid 
        and c.id=v.clienteid";
        $query = $this->db->query($sql);

        $data["reserva"] = $query->result();
        $query = $this->db->get("categorias");
        $data["categorias"] = $query->result();
        $data["content"] = "toreserva_view";
        $this->load->view("index", $data);
      } else
        show_404();
    } else
      redirect("inicio/denied");
  }

  public function replicar()
  {
    $record = array(
      'fecha' => $this->db->escape_str($this->input->post("reserva_year")) . str_pad($this->db->escape_str($this->input->post("reserva_month")), 2, "0", STR_PAD_LEFT) . str_pad($this->db->escape_str($this->input->post("reserva_day")), 2, "0", STR_PAD_LEFT),
      'clienteid' => $this->db->escape_str($this->input->post("clienteid")),
      'hsalida' => str_pad($this->db->escape_str($this->input->post("alarma_hour")), 2, "0", STR_PAD_LEFT) . str_pad($this->db->escape_str($this->input->post("alarma_min")), 2, "0", STR_PAD_LEFT),
      'hpuerta' => str_pad($this->db->escape_str($this->input->post("puerta_hour")), 2, "0", STR_PAD_LEFT) . str_pad($this->db->escape_str($this->input->post("puerta_min")), 2, "0", STR_PAD_LEFT),
      'desde' => $this->input->post("desde"),
      'destino' => $this->input->post("destino"),
      'empresa' => $this->input->post("name"),
      'observaciones' => $this->input->post("observacion"),
      'reservo' => $this->Current_User->getUsername(),
      'fecha_reserva' => date("Ymd"),
      'hora_reserva' => date("Hi"),
      'forma_pago' => $this->db->escape_str($this->input->post("pago")),
      'categoriaid' => $this->db->escape_str($this->input->post("categoria"))
    );
    if ($this->input->post("presupuesto")) {
      $record['presupuesto_aprox'] = $this->db->escape_str($this->input->post("presupuesto"));
    }

    $this->db->insert("reservas", $record);

    redirect("viaje/cancelar/" . $this->uri->segment(3));
  }

  public function getViajes()
  {
    $day = date("d");
    if ($this->input->post("day")) {
      $day = $this->input->post("day");
    }
    $month = date("m");
    if ($this->input->post("month")) {
      $month = $this->input->post("month");
    }
    $year = date("Y");
    if ($this->input->post("year")) {
      $year = $this->input->post("year");
    }

    $movil = $this->input->post("movil");
    $fecha = $year . str_pad($month, 2, 0, STR_PAD_LEFT) . str_pad($day, 2, 0, STR_PAD_LEFT);

    $sql = "select v.*,r.desde, r.destino,r.art_valor, m.movil from viajes v, reservas r, movil m where 
            v.reservaid = r.id and v.movilid=m.id ";


    $sql .= " and m.movil=$movil ";


    $sql .= " and v.cerrado = 1 and v.fecha_comisionar='$fecha' ";


    $sql .= " order by r.fecha desc, r.hsalida asc  ";




    $query = $this->db->query($sql);
    $viajes = $query->result();
    echo json_encode($viajes);
  }

  public function getDiaria()
  {
    $day = date("d");
    if ($this->input->post("day")) {
      $day = $this->input->post("day");
    }
    $month = date("m");
    if ($this->input->post("month")) {
      $month = $this->input->post("month");
    }
    $year = date("Y");
    if ($this->input->post("year")) {
      $year = $this->input->post("year");
    }

    $movil = $this->input->post("movil");
    $fecha = $year . str_pad($month, 2, 0, STR_PAD_LEFT) . str_pad($day, 2, 0, STR_PAD_LEFT);

    $sql = "select d.* from diaria d , movil m where m.id = d.idmovil and m.movil=" . $movil .
      " and d.fecha='" . $fecha . "'";

    $query = $this->db->query($sql);
    $diaria = $query->result();


    $sql = "select c.* from cajas c , movil m where m.id = c.idmovil and m.movil=" . $movil .
      " and c.created_at='" . $fecha . "'";

    $query = $this->db->query($sql);
    $ajustes = $query->result();

    $resultados = array();
    $resultados["diaria"] = $diaria;
    $resultados["ajustes"] = $ajustes;
    echo json_encode($resultados);
  }

  public function processDiaria()
  {
    $fechaInicio = $this->uri->segment(3);
    $fechaFin = $this->uri->segment(4);
    $sql = "select * from viajes where cerrado=1 and fecha_comisionar between '$fechaInicio' and '$fechaFin' ";
    $query = $this->db->query($sql);
    $viajes = $query->result();
    foreach ($viajes as $v) {
      $this->Viaje_model->updateDiaria($v->id);
    }
  }
}

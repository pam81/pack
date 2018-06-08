<?php

class Reserva extends Controller {

   function __construct()
   {
    parent::Controller();
    $this->lang->load("fletpack_site");
    $this->load->library('form_validation');
    $this->load->helper(array('form'));
    $this->load->library('pagination');
    $this->load->model("Current_User");
    $this->load->model("User_model");
    $this->load->model("Flete_model");
    $this->load->config("site");
    $this->User_model->verified_login();
   
   
   }
   
  
   
   public function index()
   {
    $urlarray = $this->uri->uri_to_assoc(3);
    $search='';
    $code='';
    $only=0;
    $fdesde=date("Ymd");
    $fhasta=date("Ymd");
    $despachadas=0;
   
    if ($this->input->post("searchfield"))
       $search=$this->db->escape_str($this->input->post("searchfield"));
    else
    {     if (isset($urlarray["find"]))
           $search=$this->db->escape_str($urlarray["find"]);
         else
           $search=0;  
     }
     
     if ($this->input->post("code"))
       $code=$this->db->escape_str($this->input->post("code"));
    else
    {     if (isset($urlarray["code"]))
           $code=$this->db->escape_str($urlarray["code"]);
         else
           $code='';  
     } 
   
   if ($this->input->post("repetir"))
      $only=1;
   else
   {
        if (isset($urlarray["only"]))
          $only=$this->db->escape_str($urlarray["only"]);
        else
          $only=0;  
   }
   if ($this->input->post("despachadas"))
      $despachadas=1;
   else
   {
        if (isset($urlarray["despachadas"]))
          $despachadas=$this->db->escape_str($urlarray["despachadas"]);
        else
          $despachadas=0;  
   }
   if ($this->input->post("desde_day") && $this->input->post("desde_month") && $this->input->post("desde_year"))
       $fdesde=$this->db->escape_str($this->input->post("desde_year")).str_pad($this->db->escape_str($this->input->post("desde_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("desde_day")),2,"0",STR_PAD_LEFT);
    else
    {     if (isset($urlarray["fdesde"]))
           $fdesde=$this->db->escape_str($urlarray["fdesde"]);
          
     }
     $data["fdesde"]=$fdesde;
    
    if ($this->input->post("hasta_day") && $this->input->post("hasta_month") && $this->input->post("hasta_year"))
       $fhasta=$this->db->escape_str($this->input->post("hasta_year")).str_pad($this->db->escape_str($this->input->post("hasta_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("hasta_day")),2,"0",STR_PAD_LEFT);
    else
    {     if (isset($urlarray["fhasta"]))
           $fhasta=$this->db->escape_str($urlarray["fhasta"]);
          
     }
   $data["fhasta"]=$fhasta;    
        
    
    
    
    $array=array("find"=>$search,"only"=>$only,"fdesde"=>$fdesde,"fhasta"=>$fhasta,"code"=>$code);
      
    //$urlarray = $this->uri->uri_to_assoc(2);
    
    $limit = 20;
    $inicio=0;
     if (isset($urlarray["page"]) && $urlarray["page"]!= '')
      $inicio=$urlarray["page"];
       
    
    
    
    
    $sql="  SELECT  
    r.id,r.fecha,r.hsalida,r.hpuerta,r.destino,r.desde,r.observaciones,
          r.empresa as name,r.clienteid,r.despachado, r.forma_pago,c.name as categoria,
          r.cancelado, r.bloqueado,r.bloqueado_by, t.phone
    
    
                  FROM   reservas r,phones t, categorias c";
    if ($only == 1)  
         $sql .=" ,repeticion e ";
         
    $sql .="              WHERE 
                   t.principal=1
                  and t.clienteid = r.clienteid
                   and r.categoriaid = c.id";
    if ($only == 1)
        $sql .=" and e.reservaid = r.id ";           
    
    if ($despachadas != 1)
        $sql .=" and r.despachado = 0 ";
    
    if ($code)
        $sql .= "   and r.codigo_excedente = '".$code."' ";
             
    if ($search)
        $sql.="                and t.phone='".$search."' ";
                  
    $sql .=" and r.fecha between $fdesde and $fhasta
                  order by r.fecha desc ,r.hsalida asc 
                  
    ";
       
    $sql_aux=$sql; 
          
     //$sql .=" limit $inicio,$limit";
    
    $query=$this->db->query($sql);
    $clientes=$query->result(); 
    $data["reservas"]= $clientes;
    
    $query=$this->db->query($sql_aux);
    
  
    $data["search"]=$search;
    $data["code"]=$code;
    $data["only"]=$only;
    $data["despachadas"]=$despachadas;
    $data["content"]="reserva_viewlist";
    $this->load->view("index",$data);
    
   
   
   }
   
   public function add()
   {
   if ( $this->Current_User->isHabilitado("ADD_RESERVA") )
    {
   
            $query=$this->db->get("categorias");
            $data["categorias"]=$query->result();
            $this->db->order_by("id");
            $query=$this->db->get("meses");
            $data["meses"]=$query->result();      
            
            $data["content"]="reserva_viewadd";
            $this->load->view("index",$data);
   }
   else
      redirect("inicio/denied"); 
   
   }
   
   
   
   public function addnew()
   { 
     if ($this->Flete_model->postBlock($this->input->post('postID'))) {
      
      if ($this->_submit_validateReserva() === FALSE) {
            $this->add();
            return;
       }
       else
       {
          $art_valor = $this->input->post("art_valor") ? $this->input->post("art_valor"): 0;
          $record=array(
          'fecha'=>$this->db->escape_str($this->input->post("reserva_year")).str_pad($this->db->escape_str($this->input->post("reserva_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("reserva_day")),2,"0",STR_PAD_LEFT),
          'clienteid'=>$this->db->escape_str($this->input->post("clienteid")),
          'hsalida'=>str_pad($this->db->escape_str($this->input->post("alarma_hour")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("alarma_min")),2,"0",STR_PAD_LEFT),
          'hpuerta'=>str_pad($this->db->escape_str($this->input->post("puerta_hour")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("puerta_min")),2,"0",STR_PAD_LEFT),
          'desde'=>$this->input->post("desde"),
          'destino'=>$this->input->post("destino"),
          'empresa'=>$this->input->post("name"),
          'observaciones'=>$this->input->post("observacion"),
          'reservo'=>$this->Current_User->getUsername(),
          'fecha_reserva'=>date("Ymd"),
          'hora_reserva'=>date("Hi"),
          'forma_pago'=>$this->db->escape_str($this->input->post("pago")),
          'categoriaid'=>$this->db->escape_str($this->input->post("categoria")),
          'repeticion_desde'=>$this->db->escape_str($this->input->post("r_desde_year")).str_pad($this->db->escape_str($this->input->post("r_desde_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("r_desde_day")),2,"0",STR_PAD_LEFT),
          'repeticion_hasta'=>$this->db->escape_str($this->input->post("r_hasta_year")).str_pad($this->db->escape_str($this->input->post("r_hasta_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("r_hasta_day")),2,"0",STR_PAD_LEFT),
          'valor_mercaderia'=>$this->input->post("valor_mercaderia"),
          'mercaderia_excedente'=>$this->input->post("excedente_mercaderia"),
          'monto_excedente'=>$this->input->post("excedente_monto"),
          'art'=>$this->input->post("art"),
          'art_valor'=>$art_valor,
          'hasMudanza'=>$this->input->post("hasMudanza")
          );
         $codigo=0;
         if ($this->input->post("excedente_monto"))
         {
          $record['codigo_excedente']=$this->getCodigo();
          $codigo=$record['codigo_excedente'];
         } 
          
          if ($this->input->post("presupuesto"))
          {
            $record['presupuesto_aprox']=$this->db->escape_str($this->input->post("presupuesto"));
          }
          
          $this->db->insert("reservas",$record);
          $reservaid=$this->db->insert_id();
          $this->repeticion($reservaid);
          $this->doRepeticion($reservaid);
          if ($this->uri->segment(3))
             redirect("viaje/cancelar/".$this->uri->segment(3));
          else
             redirect("reserva/success/".$reservaid."/".$codigo);
       }
    }
    else{
      $data["content"]="success";
      $data["message"]=$this->lang->line("just_reserva_made");
      $data["url_back"]=site_url()."reserva";
      $this->load->view("index",$data);
   
    }
    
   }
   
   public function repeticion($reservaid)
   {
      foreach($_POST as $key=>$value)
      {
         if (preg_match('/^day[0-9]*/',$key))
         {
          
           $record=array(
           'dia'=>$this->db->escape_str($value),
           'reservaid'=>$reservaid
          );
          
          $this->db->insert("repeticion",$record);
         }
       
      
      }
     
   }
   
   function doRepeticion($reservaid)
   {
      $query=$this->db->get_where("reservas",array("id"=>$reservaid));
      $reserva=$query->result();
      if (isset($reserva[0]))
      {
            $query=$this->db->get_where("repeticion",array("reservaid"=>$reservaid));
            $days=$query->result();
         if (count($days) > 0)
         {
           $dias=array();
            foreach($days as $d)
              $dias[]=$d->dia;
         
                $date=date("Ymd",strtotime($reserva[0]->repeticion_desde));
                $end=date("Ymd",strtotime($reserva[0]->repeticion_hasta));
                
                while ($date <= $end)
                {
                   
                   $nro=date("N",strtotime($date));
                   
                   if (in_array($nro,$dias))
                   {
                    
                   $record=array();
                    $record["fecha"]=$date;
                    $record["repeticionid"]=$reserva[0]->id;
                    $record["clienteid"]=$reserva[0]->clienteid;
                    $record["hsalida"]=$reserva[0]->hsalida;
                    $record["hpuerta"]=$reserva[0]->hpuerta;
                    $record["destino"]=$reserva[0]->destino;
                    $record["empresa"]=$reserva[0]->empresa;
                    $record["observaciones"]=$reserva[0]->observaciones;
                    $record["desde"]=$reserva[0]->desde;
                    $record["forma_pago"]=$reserva[0]->forma_pago;
                    $record["categoriaid"]=$reserva[0]->categoriaid;
                    $record["presupuesto_aprox"]=$reserva[0]->presupuesto_aprox;
                    $record["reservo"]=$this->Current_User->getUsername();
                    $record["fecha_reserva"]=date("Ymd");
                    $record["hora_reserva"]=date("Hi");
                    $record['valor_mercaderia']=$reserva[0]->valor_mercaderia;
                    $record['mercaderia_excedente']=$reserva[0]->mercaderia_excedente;
                    $record['monto_excedente']=$reserva[0]->monto_excedente; 
                    $record['art']=$reserva[0]->art;
                    $record['art_valor']=$reserva[0]->art_valor;
                    
                    if ($reserva[0]->monto_excedente)
                    {
                       $record['codigo_excedente']=$this->getCodigo();
          
                    }    
                          
                   $this->db->insert("reservas",$record);
                   }
                   $date = date('Ymd',strtotime("$date +1 day"));
                
                }
         
         
         }        
      
      }
         
   }
   
  
   
   
   public function success()
   {
      $nro_reserva=$this->uri->segment(3);
      $data["content"]="success";
      $data["message"]=$this->lang->line("message_success_add_reserva")." ".$nro_reserva;
      if ($this->uri->segment(4))
        $data["message"] .=" <br> Código Seguro del Viaje ".$this->uri->segment(4);
      $data["url_back"]=site_url()."reserva";
      $this->load->view("index",$data);
   
   }
   
   public function successMod()
   {
      
      $data["content"]="success";
      $data["message"]=$this->lang->line("message_success_mod_reserva");
      if ($this->uri->segment(3))
        $data["message"] .=" <br> Código Seguro del Viaje ".$this->uri->segment(3);
      $data["url_back"]=site_url()."reserva";
      $this->load->view("index",$data);
   
   }
   
   public function successRepeticion()
   {
   
      $data["content"]="success";
      $data["message"]=$this->lang->line("message_success_add_reserva_repeticion");
      $data["url_back"]=site_url()."reserva";
      $this->load->view("index",$data);
   
   }
   
   public function _submit_validateReserva(){
   
   $this->form_validation->set_rules('telefono', $this->lang->line('title_telefono'),'trim|required|max_lenght[50]');
   $this->form_validation->set_rules('desde', $this->lang->line('title_desde'),'trim|required|max_lenght[250]');
   $this->form_validation->set_rules('destino', $this->lang->line('title_hasta'),'trim|required|max_lenght[250]');
   
   $this->form_validation->set_rules('reserva_day', '','trim|required');
   $this->form_validation->set_rules('reserva_month', '','trim|required');
   $this->form_validation->set_rules('reserva_year', '','trim|required|callback_fechaMayor');
   
   $this->form_validation->set_rules('clienteid', '','');
   $this->form_validation->set_rules('puerta_hour', $this->lang->line("title_hora_puerta"),'callback_horaMayor');
   $this->form_validation->set_rules('puerta_min', '','');
   $this->form_validation->set_rules('alarma_hour', $this->lang->line("title_hora_alarma"),'');
   $this->form_validation->set_rules('alarma_min', '','');
   $this->form_validation->set_rules('name', '','');
   $this->form_validation->set_rules('presupuesto', '','');
   $this->form_validation->set_rules('valor_mercaderia', '','');
   $this->form_validation->set_rules('observacion', '','');
   $this->form_validation->set_rules('categoria', '','');
   $this->form_validation->set_rules('contado', '','');
   $this->form_validation->set_rules('ctacte', '','');
   $this->form_validation->set_rules('art', '','');
   $this->form_validation->set_rules('art_valor', '','');
   
   $this->form_validation->set_rules('r_desde_day', '','');
   $this->form_validation->set_rules('r_desde_month', '','');
   $this->form_validation->set_rules('r_desde_year', '','');
   
   $this->form_validation->set_rules('r_hasta_day', '','');
   $this->form_validation->set_rules('r_hasta_month', '','');
   $this->form_validation->set_rules('r_hasta_year', '','');
   
   $this->form_validation->set_message('fechaMayor',$this->lang->line("error_fecha_mayor"));
   $this->form_validation->set_message('horaMayor',"La hora de alarma debe ser anterior a la hora en puerta");
   
   return $this->form_validation->run();
   
   }
   
   
  public function horaMayor()
  {
    $hora_alarma=$this->input->post("alarma_hour").$this->input->post("alarma_min");
    $hora_puerta=$this->input->post("puerta_hour").$this->input->post("puerta_min");
    if ($hora_alarma >= $hora_puerta)
     return false;
    else
     return true; 
  } 
  
   public function fechaMayor()
   {
       $dateActual=date("Ymd");
       $fechaReserva=$this->input->post("reserva_year").$this->input->post("reserva_month").$this->input->post("reserva_day");
        if ($fechaReserva >= $dateActual)
          return true;
        else
         return false;  
   }
   
   public function cancelar()
   {
     if ( $this->Current_User->isHabilitado("CANCEL_RESERVA") )
    {  
      
      $nroreserva=$this->db->escape_str($this->uri->segment(3));
     if ($nroreserva)
     { 
       $data["content"]="reserva_viewcancelar";
       $data["nroreserva"]=$nroreserva;
       $this->load->view("index",$data);
     }
     else
       show_404();
    }
    else
         redirect("inicio/denied");   
   }
   
   
   public function cancel()
   {
     
          $id = $this->db->escape_str($this->uri->segment(3));
          if ($id)
          {
            
            $record=array(
             'cancelado'=>1,
             'cancelo'=>$this->Current_User->getUsername(),
             'fecha_cancel'=>date("Ymd"),
             'hora_cancel'=>date("Hi"),
             'causa_cancel'=>$this->input->post("motivo")
            );
            
            $this->db->where("id",$id);
            $this->db->update("reservas",$record);
          }
          redirect('reserva/index/'.$this->uri->segment(4));
      
       
   }
   
   public function lock($id)
   {
      $this->db->trans_start();
      $query=$this->db->get_where("reservas",array("id"=>$id));
      $reserva=$query->result();
      $lockeo=false;
      if (isset( $reserva[0]) && $reserva[0]->bloqueado == 0)
      {
         $record=array(
          'bloqueado'=>1,
          'bloqueado_by'=>$this->Current_User->getUsername()
         );
         $this->db->update("reservas",$record,array("id"=>$id));
         $lockeo=true;
      }
      else{ //si soy yo el que lo lockeo me debe permitir ingresar
        if (isset($reserva[0]) && $reserva[0]->bloqueado == 1 && $reserva[0]->bloqueado_by == $this->Current_User->getUsername())
           $lockeo=true;
      }
      $this->db->trans_complete();
      return $lockeo;
   }
   
   public function unlock()
   {
     $id=$this->db->escape_str($this->uri->segment(3));
     if ($id)
     { 
      $this->db->trans_start();
      $query=$this->db->get_where("reservas",array("id"=>$id));
      $reserva=$query->result();
      
      if (isset( $reserva[0]) && $reserva[0]->bloqueado == 1)
      {
         $record=array(
          'bloqueado'=>0,
          'bloqueado_by'=>''
         );
         $this->db->update("reservas",$record,array("id"=>$id));
       
      }
      $this->db->trans_complete();
     }
      redirect('reserva/index/'.$this->uri->segment(4));
   }
	
  public function seecancel()
  {
  
   $id = $this->db->escape_str($this->uri->segment(3));
   if ($id)
    {
         $sql=" select r.*,t.phone,c.id as clienteid,c.name, c.ctacte, c.observaciones as cobser, c.mensaje from reservas r, phones t, clientes c where
                 t.principal=1 and  
            c.id=t.clienteid and r.clienteid=c.id     
           and r.id=$id ";
          $query=$this->db->query($sql); 
          $reserva=$query->result();
          $data["reserva"]=$reserva;
          $query=$this->db->get("categorias");
          $data["categorias"]=$query->result();
          
          $data["content"]="reserva_viewcancel";
          $this->load->view("index",$data);
    }
  
  }
      
   
   
   //TODO: verificar que si otro esta modificando no puede ingresar otro
   //si esta despachado no se puede modificar salvo el administrador
   public function mod()
   {
    if ( $this->Current_User->isHabilitado("MOD_RESERVA") )
    {  
       $id = $this->db->escape_str($this->uri->segment(3));
        if ($id)
        {
         if ( $this->lock($id) )
        { 
          
          $this->db->order_by("id");
          $query=$this->db->get("meses");
          $data["meses"]=$query->result();
          $sql=" select r.*,t.phone,c.id as clienteid,c.name, c.ctacte, c.observaciones as cobser, c.mensaje from reservas r, phones t, clientes c where
                 t.principal=1 and  
            c.id=t.clienteid and r.clienteid=c.id     
           and r.id=$id ";
          $query=$this->db->query($sql); 
          $reserva=$query->result();
          $data["reserva"]=$reserva;
          $query=$this->db->get("categorias");
          $data["categorias"]=$query->result();
           $data["dir_desbloquea"]=site_url()."reserva/unlock/".$id;
           
           $query=$this->db->get_where("repeticion",array("reservaid"=>$id));
           $data["repeticion"]=$query->result();
           
          $data["content"]="reserva_viewmod";
          $this->load->view("index",$data);
         }
         else
      {  
          $data["content"]="lockeado";
          $data["message"]=$this->lang->line("reserva_lockeado");
          $this->load->view("index",$data);
      }  
        }
        else
           redirect('reserva');
   }
   else
     redirect("inicio/denied"); 
   
   }
   
   public function update()
   {
   $id = $this->db->escape_str($this->uri->segment(3));
    if (/*$this->input->post("send") && */$id)
    {
        $record=array();
        
        $record['fecha']=$this->db->escape_str($this->input->post("reserva_year")).str_pad($this->db->escape_str($this->input->post("reserva_month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("reserva_day")),2,"0",STR_PAD_LEFT);
        $record['hsalida']=str_pad($this->db->escape_str($this->input->post("alarma_hour")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("alarma_min")),2,"0",STR_PAD_LEFT);
        $record['hpuerta']=str_pad($this->db->escape_str($this->input->post("puerta_hour")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("puerta_min")),2,"0",STR_PAD_LEFT);
        $record['desde']=$this->input->post("desde");
        $record['destino']=$this->input->post("destino");
        $record['observaciones']=$this->input->post("observacion");
        $record['forma_pago']=$this->db->escape_str($this->input->post("pago"));
        $record['categoriaid']=$this->db->escape_str($this->input->post("categoria"));
        $record['presupuesto_aprox']=$this->db->escape_str($this->input->post("presupuesto"));
        $record['modifico']=$this->Current_User->getUsername();
        $record['fecha_mod']=date("Ymd");
        $record['hora_mod']=date("Hi");
        $record["valor_mercaderia"]=$this->input->post("valor_mercaderia");
        $record['mercaderia_excedente']=$this->input->post("excedente_mercaderia");
        $record['monto_excedente']=$this->input->post("excedente_monto");
        $record['codigo_excedente']=$this->input->post("excedente_codigo");
        $record['art']=$this->input->post("art");
        $record['hasMudanza']=$this->input->post("hasMudanza");
        $record['art_valor']=$this->input->post("art_valor");
        $record["bloqueado"]=0;
        $record["bloqueado_by"]=''; 
        //verificar  antes que no tenga codigo asignado previamente
        if ($this->input->post("excedente_monto") && !$this->input->post("excedente_codigo"))
         {
          $record['codigo_excedente']=$this->getCodigo();
          $codigo=$record['codigo_excedente'];
         } 
        
        $this->db->where("id",$id);
        $this->db->update("reservas",$record);  
        //$this->updateRepeticion($id);      
        redirect('reserva/successMod'."/".$codigo);
        
                
    }
    else
      show_404(); 
   
   }
   
   public function updateRepeticion($reservaid)
   {
    $query = $this->db->get_where("repeticion",array("reservaid"=>$reservaid));
    $repeticiones = $query->result();//obtengo las repeticiones de la reserva
    $exist_repeticiones=array();
    foreach($repeticiones as $row)
    {
      $exist_repeticiones[]=$row->dia;
    }
    
    $new_repeticiones=array();
    
    foreach( $_POST as $key=>$value)
    {
         if (preg_match('/^day[0-9]*/',$key))
         { 
           $new_repeticiones[]=$value;
           
         }
    }
    //deben quedar las new_edades - si esta en exist_edades -> la quito de los dos arrays
    //                            - si no esta en exist_edades -> la debo inserta y quito de exist edades
    //                            - las que quedan en exist_edades las debo borrar
    // new_edades quedan las que debo insertar  
    $i=0;
    foreach($new_repeticiones as $new)
    {  $j=0;
      foreach($exist_repeticiones as $exist)
      {
        if ($new == $exist)
        { $new_repeticiones[$i]=0;
          $exist_repeticiones[$j]=0; 
        }
        $j++; 
      } 
      $i++;
    }  
    
    foreach($new_repeticiones as $new)
    {
      if($new != 0)
      {
        $record=array(
        'reservaid'=>$reservaid,
        'dia'=>$new
       );
       $this->db->insert("repeticion",$record);
      }
    }
    
    foreach($exist_repeticiones as $exist)
    {
       if($exist != 0)
       {
        $this->db->where("reservaid",$reservaid);
        $this->db->where("dia",$exist);
        $this->db->delete("repeticion");
       }
    }
  
   
   }
   
   function listado()
   {
       $data["content"]="reserva_listado";
        $this->load->view("index",$data);
   
   }
   
   
   function getClientReservas()
   {
   
   //si se despacho la reserva se muestra
   //si se despacho y luego se cancelo el viaje tmb se muestra
     $clienteid=$this->input->post("cliente");
     $fdesde = date("Ymd");
      
    $sql="  SELECT  
            r.id,r.fecha,r.hpuerta,r.destino,r.desde,
            c.name as categoria
            FROM   reservas r, categorias c
            WHERE 
                   r.categoriaid = c.id
                   and r.clienteid = $clienteid
                   and r.cancelado = 0
                   and r.fecha >= $fdesde 
                  order by r.fecha asc ,r.hpuerta asc 
    ";
       
   
    
    $query=$this->db->query($sql);
    $clientes=$query->result(); 
     
     
     echo json_encode($clientes);
     
   
   }
   
   function generateListado()
   {
    
    $fdesde=date("Ymd");
    $fhasta=date("Ymd");
   if ($this->input->post("day") && $this->input->post("month") && $this->input->post("year"))
       $fdesde=$this->db->escape_str($this->input->post("year")).str_pad($this->db->escape_str($this->input->post("month")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("day")),2,"0",STR_PAD_LEFT);
    
   if ($this->input->post("hday") && $this->input->post("hmonth") && $this->input->post("hyear"))
       $fhasta=$this->db->escape_str($this->input->post("hyear")).str_pad($this->db->escape_str($this->input->post("hmonth")),2,"0",STR_PAD_LEFT).str_pad($this->db->escape_str($this->input->post("hday")),2,"0",STR_PAD_LEFT);
     
     $this->load->plugin('to_pdf');
     $html = file_get_contents(site_url()."pdf/makereservaListado/$fdesde/$fhasta");
     pdf_create($html, "Listado_$fdesde");
     
   }
   
   function repetir()
   {
        $data["content"]="reserva_viewrepeticion";
        $this->load->view("index",$data);
   
   }
   
   function makeRepeticion()
   {
     $day=str_pad($this->db->escape_str($this->input->post("repeticion_day")),2,0,STR_PAD_LEFT);
     $month=str_pad($this->db->escape_str($this->input->post("repeticion_month")),2,0,STR_PAD_LEFT);
     $year=$this->db->escape_str($this->input->post("repeticion_year"));
     $nro=date("N",mktime(0,0,0,$month,$day,$year));
     //$query=$this->db->get_where("repeticion",array("dia"=>$nro));
     $sql="select e.* from repeticion r, reservas e where e.id=r.reservaid and r.dia=$nro";
     $query=$this->db->query($sql);
     $repeticiones=$query->result(); //obtengo los id de las reservas que debo repetir
     $fecha=$year.$month.$day;
     foreach($repeticiones as $r)
     {
          $query=$this->db->get_where("reservas",array("fecha"=>$fecha,"repeticionid"=>$r->id));
          $reservas=$query->result();
          if (count($reservas) == 0)
          {  //debo agregar la repeticion porque no fue creada
              
              $record=array();
              $record["fecha"]=$fecha;
              $record["repeticionid"]=$r->id;
              $record["clienteid"]=$r->clienteid;
              $record["hsalida"]=$r->hsalida;
              $record["hpuerta"]=$r->hpuerta;
              $record["destino"]=$r->destino;
              $record["empresa"]=$r->empresa;
              $record["observaciones"]=$r->observaciones;
              $record["desde"]=$r->desde;
              $record["forma_pago"]=$r->forma_pago;
              $record["categoriaid"]=$r->categoriaid;
              $record["presupuesto_aprox"]=$r->presupuesto_aprox;
              $record["reservo"]=$this->Current_User->getUsername();
              $record["fecha_reserva"]=date("Ymd");
              $record["hora_reserva"]=date("Hi");
              $record["art"]=$r->art;
              $record["art_valor"]=$r->art_valor;
                          
              $this->db->insert("reservas",$record);
          } 
          //sino paso a la siguiente porque ya hay una reserva de ese dia  
          //generada por la repeticion
          
          
     }
     redirect("reserva/successRepeticion");          
     
   }
   
   public function getCodigo()
   {
     $sql="select max(codigo_excedente) as code from reservas";
     $query=$this->db->query($sql);
     $codigo=$query->result();
     if (isset($codigo[0]->code) && $codigo[0]->code != '')
     {
       $code=$codigo[0]->code;
       $letra=mb_substr($code,0,3);
       $numero=mb_substr($code,3,3);
       if ($numero < 999)
       {
          $n=$numero+1;
          $numero=str_pad($n,3,0,STR_PAD_LEFT);
       }
       else{
         $numero="000"; //vuelvo a empezar
         $letra++;
         $letra=str_pad($letra,3,"A",STR_PAD_LEFT);
         
       }
       return $letra.$numero;
     }
     else
       return "AAA000"; //el primero que se genera
   
   }
   
   public function getExcedente()
   {
      $query=$this->db->get("seguro");
      $seguro=$query->result();
      $excedente=array();
      if (isset($seguro[0]))
      {
        
         $monto=($this->input->post("excedente")*$seguro[0]->valor)/$seguro[0]->monto;
         $codigo=$this->getCodigo();
         $excedente["resultado"]="ok";
         $excedente["monto"]=$monto;
         $excedente["codigo"]=$codigo;
             
      }
      else
      {  $excedente["resultado"]="no_ok";
         $excedente["monto"]="";
         $excedente["codigo"]="";
      }
        
        echo json_encode($excedente);
   
   }
   
   
   
   
 }  
?>

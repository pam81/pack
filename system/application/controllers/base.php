<?php

class Base extends Controller {

   function __construct()
   {
    parent::Controller();
    $this->lang->load("fletpack_site");
    $this->load->library('form_validation');
    $this->load->helper(array('form'));
    $this->load->library('pagination');
    $this->load->model("Current_User");
    $this->load->model("User_model");
    $this->load->model("Flete_model","flete");
    $this->load->config("site");
    $this->User_model->verified_login();
   
   }
   
   function index()
   {
   
        $query=$this->db->get("bases");
        $data["bases"]=$query->result();
        $this->db->select("movil,baseid,ordenbase");
        $this->db->orderby("baseid,ordenbase");
        $query=$this->db->get_where("movil",array("active"=>1));
        $data["moviles"]=$query->result();
        
        $sql="select m.*, c.id as choferid, c.name, c.lastname
               from movil m, movil_chofer mc, choferes c
              where 
              m.baseid=-1 and 
              m.id = mc.movilid
              and  c.id = mc.choferid
              order by movil";
        $query=$this->db->query($sql);
        $data["enviaje"]=$query->result();
        
        $data["content"]="base_viewlist";
        $this->load->view("baseindex",$data);
    
   }
   
   function egresaBase()
   {
   
        if ( $this->Current_User->isHabilitado("EGRESA_BASE") )
    {
       $query=$this->db->get("bases");
        $data["bases"]=$query->result();
        $this->db->select("movil,baseid,ordenbase");
        $this->db->orderby("baseid,ordenbase");
        $query=$this->db->get_where("movil",array("active"=>1));
        $data["moviles"]=$query->result();
       
       $data["content"]="base_egresa";
       $this->load->view("baseindex",$data);
     }
     else
        redirect("inicio/denied");   
   
   }
   
   function egresa()
   {
   
     $movil=$this->db->escape_str($this->input->post("movil"));
     
     if ($this->_submit_validateEgresar() === FALSE) {
            $this->egresaBase();
            return;
       }
    else{
         
         $query=$this->db->get_where("movil",array("movil"=>$movil));
         $m=$query->result();
         if (isset($m[0]))
         {
           $this->db->update("movil",array("baseid"=>-2,"ordenbase"=>0),array("id"=>$m[0]->id));
         //actualizo que el movil salio de la base
         
         $this->db->select_max("id");
         $query=$this->db->get_where("movil_trabaja",array("movil"=>$movil));
         $mt=$query->result();
         
         $record=array(
         'fecha_egreso'=>date("Ymd"),
         'hora_egreso'=>date("Hi")
         );
         
         $this->db->update("movil_trabaja",$record,array("id"=>$mt[0]->id));
         
         //ordeno la base
           $this->flete->ordenamiento($m[0]->baseid);
         }
     
     }
      redirect("base");
   
   }
   
   
   
   function _submit_validateEgresar()
   {
      $this->form_validation->set_rules('movil', $this->lang->line('title_movil'),'trim|required|max_lenght[10]|callback_notEgresaMovilBase');
      $this->form_validation->set_message('notEgresaMovilBase',$this->lang->line("error_notresta_movil_base"));
     
      return $this->form_validation->run();
   }
   
   function notEgresaMovilBase()
   {
     $nromovil=$this->db->escape_str($this->input->post("movil"));
     $query=$this->db->get_where("movil",array("movil"=>$nromovil));
     $movil=$query->result();
     
     if ( isset($movil[0]) && $movil[0]->baseid > 0 )
     {
        
            return true; //esta asignado a una base
            
     }
     
         return false; //no esta asignado a una base
   
   
   }
   
   
   function ingresaBase()
   {
        if ( $this->Current_User->isHabilitado("INGRESA_BASE") )
    { 
      
      $query=$this->db->get("bases");
       $data["bases"]=$query->result();
       
      
        $this->db->select("movil,baseid,ordenbase");
        $this->db->orderby("baseid,ordenbase");
        $query=$this->db->get_where("movil",array("active"=>1));
        $data["moviles"]=$query->result();
       
       
       $data["content"]="base_ingresa";
       $this->load->view("baseindex",$data);
   }
   else
      redirect("inicio/denied"); 
   
   }
   //agrega a la base al final
   //solo si el movil no esta en viaje ni en otra base
   function addmovil()
   {
      if ($this->_submit_validateIngresar() === FALSE) {
            $this->ingresaBase();
            return;
       }
       else{
            $movil=$this->db->escape_str($this->input->post("movil"));
            $base=$this->db->escape_str($this->input->post("base"));
            
            
            
            $this->db->trans_start();
           
            
            $this->flete->ordenamiento($base);
            
             
            $this->db->select_max('ordenbase'); 
            $query = $this->db->get_where("movil",array("active"=>1,"baseid"=>$base));
            $maximo=$query->result();
            $orden=$maximo[0]->ordenbase+1;
           
            $this->db->where("movil",$movil);
            $this->db->update("movil",array("ordenbase"=>$orden,"baseid"=>$base));
            
            /*indico que el movil ingreso en la base*/
                       
            $query=$this->db->get_where("movil",array("movil"=>$movil));
            $m=$query->result();
           
            $record=array(
            'idmovil'=> $m[0]->id,
            'fecha_ingreso'=>date("Ymd"),
            'hora_ingreso'=>date("Hi"),
            'movil'=>$movil
            );
            $this->db->insert("movil_trabaja",$record);
            
            $this->db->trans_complete();
                      
         
         redirect("base");      
      }
      
   
   }
   
   function _submit_validateIngresar()
   {
     $this->form_validation->set_rules('movil', $this->lang->line('title_movil'),'trim|required|max_lenght[10]|callback_notAddMovilBase|callback_notDocMovil');
     $this->form_validation->set_rules('base', $this->lang->line('title_base'),'trim|required|is_natural_no_zero');
     
     
     $this->form_validation->set_message('notAddMovilBase',$this->lang->line("error_notadd_movil_base"));
     $this->form_validation->set_message('notDocMovil',$this->lang->line("error_notdocumentacion_movil"));
      return $this->form_validation->run();
   
   }
   //verificar que el movil este no asignado o viajando
   // que este activo 
   function notAddMovilBase()
   {
     $nromovil=$this->db->escape_str($this->input->post("movil"));
     
     $query = $this->db->get_where("movil",array("movil"=>$nromovil,"baseid"=>-2,"active"=>1));
     $movil=$query->result();
     if (count($movil) != 0)
     {
        //if ($movil[0]->baseid == -2) //no esta asignado a una base
            return true;
        //else
          //  return false;     //esta asignado a alguna base    
     }
     else 
         return false; //no esta activo o no encontro el numero de movil
   
   }
   //verifica la documentacion del movil
    function notDocMovil()
   {
        $nromovil=$this->db->escape_str($this->input->post("movil"));
        return $this->flete->verificaDocMovil($nromovil);    
    
   }
   
   
   
   
   function ordenaBase()
   {
      if ( $this->Current_User->isHabilitado("ORDER_BASE") )
    { 
       $query=$this->db->get("bases");
       $data["bases"]=$query->result();
       
       $this->db->select("movil,baseid,ordenbase");
        $this->db->orderby("baseid,ordenbase");
        $query=$this->db->get_where("movil",array("active"=>1));
        $data["moviles"]=$query->result();
       
       $data["content"]="base_ordenar";
       $this->load->view("baseindex",$data);
     }
     else
         redirect("inicio/denied"); 
   
   }
   
   function ordenar()
   {
   
   if ($this->_submit_validateOrdenar() === FALSE) {
            $this->ordenaBase();
            return;
       }
       else{
            
            $this->db->trans_start();
            $nromovil=$this->db->escape_str($this->input->post("movil"));
            $orden=$this->db->escape_str($this->input->post("position"));
            $query=$this->db->get_where("movil",array("movil"=>$nromovil));
            $movil=$query->result();
            $ascendente=true;
            if (isset($movil[0]))
            {
              if ($orden < $movil[0]->ordenbase )
                $ascendente=false;
                
              $this->db->order_by("ordenbase");
              $query=$this->db->get_where("movil",array("baseid"=>$movil[0]->baseid,"active"=>1));
              
              foreach($query->result() as $row)
              {
                if ($row->movil == $nromovil)
                 $this->db->update("movil",array("ordenbase"=>$orden),array("id"=>$movil[0]->id));  
                else
                {
                  if ($ascendente)
                  {
                  
                  if ( $row->ordenbase <= $orden && $row->ordenbase > $movil[0]->ordenbase)
                     {
                      
                          $this->db->update("movil",array("ordenbase"=>($row->ordenbase -1)),array("id"=>$row->id));
                      
 
                     }
                  
                  }
                  else  
                  {
                  
                  if ( $row->ordenbase >= $orden && $row->ordenbase < $movil[0]->ordenbase)
                           
                        $this->db->update("movil",array("ordenbase"=>($row->ordenbase +1)),array("id"=>$row->id));                  
                  
                  } 
                     
                 } 
               
              }
            
            }
            
            $this->db->trans_complete();
            
      }
      redirect("base");
   
   
   }
   
   function _submit_validateOrdenar()
   {
     $this->form_validation->set_rules('movil', $this->lang->line('title_movil'),'trim|required|max_lenght[10]|callback_notOrdenarMovilBase');
     $this->form_validation->set_rules('position', $this->lang->line('title_movil_position'),'trim|required|is_natural_no_zero|callback_notPositionBase');
     
     $this->form_validation->set_message('notOrdenarMovilBase',$this->lang->line("error_notordernar_movil_base"));
     
     $this->form_validation->set_message('notPositionBase',$this->lang->line("error_notposition_movil_base"));
      return $this->form_validation->run();
   
   }
 
  function notPositionBase()
  {
  $nromovil=$this->db->escape_str($this->input->post("movil"));
  $position=$this->db->escape_str($this->input->post("position"));
  $query = $this->db->get_where("movil",array("movil"=>$nromovil,"active"=>1));
  $movil=$query->result();
  if (count($movil) != 0)
  {   
  $baseid=$movil[0]->baseid;
  $sql="select max(ordenbase) as maximo from movil where baseid=$baseid and active=1";
  $query=$this->db->query($sql);
  $maximo=$query->result();
  if (isset($maximo[0]))
  {
    if ($position <= $maximo[0]->maximo)
      return true;
    else
     return false;  
  }
   else 
     return false; 
  }
  else 
    return false;
  
  }
 
   
   function notOrdenarMovilBase()
   {
     $nromovil=$this->db->escape_str($this->input->post("movil"));
     
     $query = $this->db->get_where("movil",array("movil"=>$nromovil,"active"=>1));
     $movil=$query->result();
     if (count($movil) != 0)
     {
        if ($movil[0]->baseid > 0 ) // esta asignado a una base
            return true;
        else
            return false;     //no esta asignado a alguna base    
     }
     else 
         return false; //no esta activo o no encontro el numero de movil
   
   }
   
   function restar()
   {
     $base=$this->db->escape_str($this->uri->segment(3));
     $movil=$this->db->escape_str($this->uri->segment(4));
     if ($base && $movil)
     {
        $query=$this->db->get_where("movil",array("active"=>1,"movil"=>$movil,"baseid"=>$base));
        $unidad=$query->result();
        if (isset($unidad[0]))
        {
           $orden=$unidad[0]->ordenbase;
           //si es 1 es el primero no se puede restar
           if ($orden > 1)
           {
              $nuevoorden=$orden-1; //resto una posicion
               $query=$this->db->get_where("movil",array("baseid"=>$base,"active"=>1,"ordenbase"=>$nuevoorden));
              $resulta = $query->result();
              
              $record=array(
               'ordenbase'=>$nuevoorden
              );
              $this->db->where("id",$unidad[0]->id);
              $this->db->update("movil",$record);
               //el que tenia esta nueva posicion la cambio al lugar anterior
              $record=array(
               'ordenbase'=>$orden
              );
              $this->db->where("id",$resulta[0]->id);
              $this->db->update("movil",$record);   
           }
        }
             
     }
     
       redirect("base");
   
   }
   
   function aumentar()
   {
     $base=$this->db->escape_str($this->uri->segment(3));
     $movil=$this->db->escape_str($this->uri->segment(4));
     
     if ($base && $movil)
     {
        $query=$this->db->get_where("movil",array("active"=>1,"movil"=>$movil,"baseid"=>$base));
        $unidad=$query->result();
        if (isset($unidad[0]))
        {
           $orden=$unidad[0]->ordenbase;
           $this->db->select_max('ordenbase');
           $query = $this->db->get_where("movil",array("active"=>1,"baseid"=>$base));
           $resultado = $query->result();
                     
           //si no es el ultimo lo puedo aumentar
           if ($orden < $resultado[0]->ordenbase )
           {
              $nuevoorden=$orden+1; //sumo una posicion
             
              $query=$this->db->get_where("movil",array("baseid"=>$base,"active"=>1,"ordenbase"=>$nuevoorden));
              $resulta = $query->result();
                
             
             
              $this->db->where("id",$unidad[0]->id);
              $this->db->update("movil",array("ordenbase"=>$nuevoorden));
              
              $this->db->where("id",$resulta[0]->id);
              $this->db->update("movil",array("ordenbase"=>$orden));
             
              
           }
        }
             
     }
     
       redirect("base");
   
   
   }
   
   function cambiaBase()
   {
      if ( $this->Current_User->isHabilitado("CHANGE_BASE") )
    {  
       
       $query=$this->db->get("bases");
       $data["bases"]=$query->result();
       $this->db->select("movil,baseid,ordenbase");
        $this->db->orderby("baseid,ordenbase");
        $query=$this->db->get_where("movil",array("active"=>1));
        $data["moviles"]=$query->result();
       
       $data["content"]="base_cambiar";
       $this->load->view("baseindex",$data);
     }
     else
         redirect("inicio/denied");
   }
   
   function cambiar() 
   {
      if ($this->_submit_validateCambiar() === FALSE) {
            $this->cambiaBase();
            return;
       }
       else{
            
            $this->db->trans_start();
            $nromovil=$this->db->escape_str($this->input->post("movil"));
            $base=$this->db->escape_str($this->input->post("base"));
            
            $query=$this->db->get_where("movil",array("movil"=>$nromovil));
            $movil=$query->result();
            $base_before=$movil[0]->baseid;
            if ($this->input->post("position"))
               $orden=$this->db->escape_str($this->input->post("position"));
            else
            { //si no indico position va a ultimo lugar
            
            $sql="select max(ordenbase) as maximo from movil where active=1 and baseid=$base";
            
            $query=$this->db->query($sql);
            $maximo=$query->result();
            $orden=$maximo[0]->maximo+1;
            }   
            
              
          
                  
            $this->db->order_by("ordenbase");
            $query=$this->db->get_where("movil",array("baseid"=>$base,"active"=>1));
                       
            
             foreach($query->result() as $row)
              {
               
                  
                  //solo sumo una posicion a los que estan detras de la posicion 
                  if ( $row->ordenbase >= $orden )
                     {
                      
                          $this->db->update("movil",array("ordenbase"=>($row->ordenbase +1)),array("id"=>$row->id));
                      
 
                     }
                  
                   
                  
               
              }
            
            
            $this->db->update("movil",array("ordenbase"=>$orden,"baseid"=>$base),array("id"=>$movil[0]->id));
           
            if ($base_before > 0)
                 $this->flete->ordenamiento($base_before); //reordeno la base en la que estaba
           
            
            $this->db->trans_complete();
            
      }
      redirect("base");
   
   }
   
   function _submit_validateCambiar()
   {
     $this->form_validation->set_rules('movil', $this->lang->line('title_movil'),'trim|required|max_lenght[10]|callback_notChangeMovilBase|callback_notDocMovil');
     $this->form_validation->set_rules('base', $this->lang->line('title_base'),'trim|required|is_natural_no_zero');
     $this->form_validation->set_rules('position', $this->lang->line('title_position'),'trim|is_natural|callback_notPosition');
     
     $this->form_validation->set_message('notChangeMovilBase',$this->lang->line("error_notchange_movil_base"));
     $this->form_validation->set_message('notDocMovil',$this->lang->line("error_notdocumentacion_movil"));
     $this->form_validation->set_message('notPosition',$this->lang->line("error_notposition_movil_base"));
      return $this->form_validation->run();
   
   }
   
   function notPosition()
   {
     $base=$this->input->post("base");
     $sql="select max(ordenbase) as maximo from movil where active=1 and baseid=$base";
            
     $query=$this->db->query($sql);
     $maximo=$query->result();
     if (isset($maximo[0]))
     {
      $posicion=$this->input->post("position");
      $max=$maximo[0]->maximo + 1;
      if ($posicion <= $max)
        return true;
      else
        return false;  
       
     }
     else
       return false;
   
   
   }
   
   function notChangeMovilBase(){
     $nromovil=$this->db->escape_str($this->input->post("movil"));
     $query=$this->db->get_where("movil",array("active"=>1,"movil"=>$nromovil));
     $movil=$query->result();
     if (count($movil) != 0)
     {
        if ($movil[0]->baseid > 0) //esta asignado a alguna base
            return true;
        else
            return false;     //    no esta asignado a una base
     }
     else 
         return false; //no esta activo o no encontro el numero de movil
   
   }
   
   
    function asignar() 
   {
     if ($this->uri->segment(3))
     {
        $nroviaje=$this->db->escape_str($this->uri->segment(3));
        $this->db->update("viajes",array("regresando"=>0,"regresando_desde"=>''),array("id"=>$nroviaje));
     
     }
            
            $this->db->trans_start();
            $nromovil=$this->db->escape_str($this->input->post("movil"));
            $base=$this->db->escape_str($this->input->post("base"));
            
            $query=$this->db->get_where("movil",array("movil"=>$nromovil));
            $movil=$query->result();
            
            if ($this->input->post("position"))
               $orden=$this->db->escape_str($this->input->post("position"));
            else
            { //si no indico position va a ultimo lugar
            
            $sql="select max(ordenbase) as maximo from movil where active=1 and baseid=$base";
            
            $query=$this->db->query($sql);
            $maximo=$query->result();
            $orden=$maximo[0]->maximo+1;
            }   
            
              
          
                  
            $this->db->order_by("ordenbase");
            $query=$this->db->get_where("movil",array("baseid"=>$base,"active"=>1));
                       
            
             foreach($query->result() as $row)
              {
               
                  
                  //solo sumo una posicion a los que estan detras de la posicion 
                  if ( $row->ordenbase >= $orden )
                     {
                      
                          $this->db->update("movil",array("ordenbase"=>($row->ordenbase +1)),array("id"=>$row->id));
                      
 
                     }
                  
                   
                  
               
              }
            
            
            $this->db->update("movil",array("ordenbase"=>$orden,"baseid"=>$base),array("id"=>$movil[0]->id));
           
            
            
            $this->db->trans_complete();
      redirect("inicio");
   
   }
   
   
   
   
   
   function nueva()
   {
       
     if ( $this->Current_User->isHabilitado("ADD_BASE") )
    {   
       
       $data["content"]="base_nueva";
       $this->load->view("baseindex",$data);
     }
     else
       redirect("inicio/denied");
   
   }
   
   function addbase()
   {
    if ($this->_submit_validateNuevaBase() === FALSE) {
            $this->nueva();
            return;
       }
    else{
         $record=array(
          'name'=>$this->input->post("name")
          
         );
            
         $this->db->insert("bases",$record);   
            
      }
      
      redirect("base");
   
   }
   
   function _submit_validateNuevaBase()
   {

      $this->form_validation->set_rules('name', $this->lang->line('title_base'),'trim|required|max_lenght[200]|xss_clean');
    
      return $this->form_validation->run();
   
   }
   
   function mod()
   {
      
      if ( $this->Current_User->isHabilitado("MOD_BASE") )
    { 
       $query=$this->db->get("bases");
       $data["bases"]=$query->result();
   
       $data["content"]="base_mod";
       $this->load->view("baseindex",$data);
     }
     else
         redirect("inicio/denied"); 
   }
   //no se puede borrar una base si hay moviles asignados a la misma
   function del()
   {
     if ( $this->Current_User->isHabilitado("DEL_BASE") )
     {
         $id = $this->db->escape_str($this->uri->segment(3));
          if ($id)
          {
           $query=$this->db->get_where("moviles",array("baseid"=>$id));
           $moviles=$query->result();
           if (count($moviles) == 0)
           {
             $this->db->where("id",$id);
             $this->db->delete("bases");
           } 
          }
          redirect('base/index/'.$this->uri->segment(4));
     }
     else
         redirect("inicio/denied"); 
   }
   
   function modBase()
   {
   $id = $this->db->escape_str($this->uri->segment(3));
    if ($id)
    {
       $query=$this->db->get_where("bases",array("id"=>$id));
       $data["base"]=$query->result();
   
       $data["content"]="base_modview";
       $this->load->view("baseindex",$data);
    }
    else
    redirect('base/index/'.$this->uri->segment(4));   
   
   }
   
   function change()
   {
     if ($this->_submit_validateNuevaBase() === FALSE) {
            $this->modBase();
            return;
       }
    else{
         $record=array(
          'name'=>$this->input->post("name")
          
         );
            
         $this->db->update("bases",$record,array("id"=>$this->db->escape_str($this->uri->segment(3))));   
            
      }
      
      redirect('base/index/'.$this->uri->segment(4));   
   
   
   }
   
   
 }  
?>

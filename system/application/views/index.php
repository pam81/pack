<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $this->lang->line('name_empresa');?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="www.mizusoft.com.ar" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo base_url()."images/favicon.ico";?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."css/styles.css";?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/shadowbox/shadowbox.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/apprise.min.css" type="text/css" />
    <link href="<?php echo base_url();?>css/defaultTheme.css" rel="stylesheet" media="screen" />
    <link href="<?php echo base_url();?>vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

 
    <script type="text/javascript" src="<?php echo base_url();?>js/yahoo/yahoo/yahoo-min.js"></script>  
    <script type="text/javascript" src="<?php echo base_url();?>js/yahoo/event/event-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/yahoo/connection/connection-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()."js/ajaxClass.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/flete.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/language/es/messages.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/json.js"></script>
   <!-- <script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>-->
   <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

 <script src="http://code.jquery.com/jquery-migrate-1.1.0.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.table_navigation.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/apprise-1.5.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/shadowbox/shadowbox.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.fixedheadertable.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/demo.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>vendors/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" >

      Shadowbox.init();

      $('*').keyup(function(e){
          code = e.keyCode ? e.keyCode : e.which;
          
          
          
          if (code.toString() == 27 ) //ESC
             document.location.href='<?php echo site_url()."home";?>';
          if (code.toString() == 49 && e.altKey) //alt+1
             document.location.href='<?php echo site_url()."home";?>';   
          if (code.toString() == 50 && e.altKey ) //alt+2
             document.location.href='<?php echo site_url()."cliente";?>';
          if (code.toString() == 51 && e.altKey) //alt+3
             document.location.href='<?php echo site_url()."chofer";?>';
         if (code.toString() == 52 && e.altKey) //alt+4
             document.location.href='<?php echo site_url()."reserva";?>';
         if (code.toString() == 53 && e.altKey) //alt+5
             document.location.href='<?php echo site_url()."base";?>'; 
          if (code.toString() == 54 && e.altKey) //alt+6
             document.location.href='<?php echo site_url()."viaje";?>';      
          if (code.toString() == 55 && e.altKey ) //alt+7
             document.location.href='<?php echo site_url()."usuario";?>';
          if (code.toString() == 56 && e.altKey) //alt+8
             document.location.href='<?php echo site_url()."costo";?>';
          if (code.toString() == 57 && e.altKey) //alt+9
             document.location.href='<?php echo site_url()."reporte/recaudacion";?>';       
          if (code.toString() == 48 && e.altKey) //alt+0
             document.location.href='<?php echo site_url()."home/logout";?>';                
          if (code.toString() == 90 && e.altKey) //alt +z
             $("#send").click();
          if (code.toString() == 88 && e.altKey) //alt +x
             $("#clean").click(); 
         if (code.toString() == 76 && e.altKey) //alt +l
             document.location.href='<?php echo site_url()."localidad";?>'; 
          if (code.toString() == 37 && e.altKey) //alt + <-
             window.location=document.getElementById('prev').firstChild.href;
         if (code.toString() == 39 && e.altKey) //alt + ->
             window.location=document.getElementById('next').firstChild.href; 
         if (code.toString() == 71 && e.altKey) //alt + g  
             flete.changeTablaReserva();
          if (code.toString() == 72 && e.altKey) //alt + h
             flete.changeTablaViaje();  
         if (code.toString() == 82 && e.altKey) //alt + r
             document.location.href='<?php echo site_url()."reserva/add";?>';
         if (code.toString() == 113) //alt + r
             document.location.href='<?php echo site_url()."reserva/add";?>';     
         if(code.toString() == 81 && e.altKey)  //alt + q redireccion para busqueda de movil en viaje actual
             flete.findMovil('<?php echo site_url()."viaje/redirect/";?>');
         if(code.toString() == 112)  //F1 redireccion para busqueda de movil en viaje actual
             flete.findMovil('<?php echo site_url()."viaje/redirect/";?>');      
                               
      });


      </script>

  </head>

  <body 	<?php  
               if (isset($dir_desbloquea)){
                 echo " onunload=\"flete.unlock('".$dir_desbloquea."');\" ";
              } 
        ?>        

>

<?php $this->load->view("header");?>
<div id="container">

<?php $this->load->view($content);?>

<?php $this->load->view("footer");?>
  
</div>
  </body>
</html>

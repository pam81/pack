<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()."css/styles.css";?>" />
<meta name="author" content="www.mizusoft.com.ar" />
<link rel="shortcut icon" href="<?php echo base_url()."images/icono.jpg";?>">

<script type="text/javascript" src="<?php echo base_url();?>js/yahoo/yahoo/yahoo-min.js"></script>  
<script type="text/javascript" src="<?php echo base_url();?>js/yahoo/event/event-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/yahoo/connection/connection-min.js"></script>
<script type="text/javascript" src="<?php echo base_url()."js/ajaxClass.js"; ?>"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/flete.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/language/es/messages.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/json.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.table_navigation.js"></script>

<title><?php echo $this->lang->line('name_empresa');?></title>

<script type="text/javascript" >

$('*').keyup(function(e){
    code = e.keyCode ? e.keyCode : e.which;
    
    
    
    if (code.toString() == 27 ) //ESC
       document.location.href='<?php echo site_url()."home";?>';
    if (code.toString() == 49 && e.altKey) //alt+1
       document.location.href='<?php echo site_url()."home";?>';   
    if (code.toString() == 50 && e.altKey ) //alt+2
       document.location.href='<?php echo site_url()."costo";?>';
    if (code.toString() == 51 && e.altKey) //alt+3
       document.location.href='<?php echo site_url()."costo/seguro";?>';
   if (code.toString() == 90 && e.altKey) //alt +z
       $("#send").click();
       
    if (code.toString() == 88 && e.altKey) //alt +x
       $("#clean").click();                       
    
});


</script>

</head>

<body>

<?php $this->load->view("header_costo");?>
<div id="container">

<?php $this->load->view($content);?>

<?php $this->load->view("footer");?>

</div>
</body>
</html>

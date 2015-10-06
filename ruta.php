<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="author" content="www.mizusoft.com.ar">
  <title>CALCULAR RUTA</title>
  
  <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?sensor=false">
    </script>
  
  <script type="text/javascript">
  
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;

function initialize() {
var rendererOptions = {
  draggable: true
};

  directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
  var bsas = new google.maps.LatLng(-34.608418,-58.373161);
  var mapOptions = {
    zoom:7,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: bsas
  }
  map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
  directionsDisplay.setMap(map);
  directionsDisplay.setPanel(document.getElementById("directionsPanel"));
}

function calcRoute() {
  var desde = document.getElementById("desde").value;
  var hasta = document.getElementById("hasta").value;
  
   if ( desde.indexOf(",") == -1)
   {  desde +=", Buenos Aires, Ciudad Autónoma de Buenos Aires";
    }
 
    desde +=", Argentina";
   if ( hasta.indexOf(",") == -1)
   {  hasta +=", Buenos Aires, Ciudad Autónoma de Buenos Aires";
    }
 
    hasta +=", Argentina"; 
    
  
  var request = {
    origin:desde,
    destination:hasta,
    travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
 
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
    if (status == google.maps.DirectionsStatus.NOT_FOUND) {
      alert("Origen o Destino no han podido localizarse");
    }
    if (status == google.maps.DirectionsStatus.ZERO_RESULTS){
      alert("No se encontro una ruta válida entre las direcciones");
    }
    if (status == google.maps.DirectionsStatus.OVER_QUERY_LIMIT){
      alert("Se han superado las consultas permitidas");
    }
  });
}
  
  </script>
  </head>
  <body style="background-color:#fff;" onload="initialize();calcRoute();" >


 
  <input type="hidden" id="desde" name="desde" value="<?php echo $_GET["d"];?>" />
  
  
  <input type="hidden" id="hasta" name="hasta" value="<?php echo $_GET["h"];?>" />
  
 

<div id="map-canvas" style="float:left;width:70%; height:100%"></div>
<div id="directionsPanel" style="float:right;width:30%;height 100%"></div>

  </body>
</html>

<!DOCTYPE HTML >
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="author" content="amautasoft.com">
  <title>UBICAR LUGAR</title>
  
  <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkjlcWB75mEf0524bDQFP6tbLYCFmpPOY&sensor=false">
    </script>
    
    <script type="text/javascript">
  
var geocoder;
var map;
function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.608418,-58.373161);
    var myOptions = {
      zoom: 12,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    
  }
  
  function geocodificar(address)
  {
   
    if ( address.indexOf(",") == -1)
   {  address +=", Buenos Aires, Ciudad Autónoma de Buenos Aires";
    }
 
    address +=", Argentina";
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      
        
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map, 
            position: results[0].geometry.location
        });
      } else {
        alert("No se pudo Geocodificar la dirección. Deberá buscar la ubicación en el mapa.");
        
      }
    });
  }
  
  
  </script>
    
 </head>
 <body style="background-color:#fff;" onload="initialize();geocodificar('<?php echo $_GET["d"];?>')">
 <div id="map_canvas" style="height:400px;width:400px;"></div>
 
 </body>
 </html>

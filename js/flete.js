//RELOJ 24 HORAS

var RelojID24 = null
var RelojEjecutandose24 = false

function DetenerReloj24 (){
	if(RelojEjecutandose24)
		clearTimeout(RelojID24)
	RelojEjecutandose24 = false
}

function MostrarHora24 () {
	var ahora = new Date()
	var horas = ahora.getHours()
	var minutos = ahora.getMinutes()
	var segundos = ahora.getSeconds()
	var ValorHora

	//establece las horas
	if (horas < 10)
	     	ValorHora = "0" + horas
	else
		ValorHora = "" + horas

	//establece los minutos
	if (minutos < 10)
		ValorHora += ":0" + minutos
	else
		ValorHora += ":" + minutos

	//establece los segundos
	if (segundos < 10)
		ValorHora += ":0" + segundos
	else
		ValorHora += ":" + segundos
        
	document.reloj24.digitos.value = ValorHora
	//si se desea tener el reloj en la barra de estado, reemplazar la anterior por esta
	//window.status = ValorHora

	RelojID24 = setTimeout("MostrarHora24()",1000)
	RelojEjecutandose24 = true
}

function IniciarReloj24 () {
	DetenerReloj24()
	MostrarHora24()
}

window.onload = IniciarReloj24;
if (document.captureEvents) {			//N4 requiere invocar la funcion captureEvents
	document.captureEvents(Event.LOAD)
}

function doLoad()
{
IniciarReloj24();
setTimeout( "refresh()", 15*1000 );


 showAviso();

}

function showAviso()
{
 var dataString='';
 $.ajax({
            type: "GET",
            url: 'inicio/showAviso',
            dataType: 'json',
            data: dataString,
            success: function(data) {
            
             
             $.each(data, function(i) {
             if (i != 'resultado')
                $("#list_aviso").append('<li class="'+data[i].className+'">'+data[i].texto+'</li>');
             
          
 	        });
            
             if (data["resultado"]== "ok")
                 $("#div_aviso").show();
            }
          });


}

function refresh()
{
   window.location.reload();
}

     

var flete ={
 
  findMovil:function(dir){
    var movil = prompt('Número de Movil','');
    
    if(movil != null)
       window.location.href=dir+movil; 
  
  },
  findViaje:function(dir){
  var viaje = prompt('Número de Viaje','');
    
    if (viaje != null)
      window.location.href=dir+viaje;
  },
  reactivarMovil:function(dir,exmovil)
  {
    var movil = prompt("Ingrese Nro. de Movil",exmovil);
    if (movil != null)
         window.location.href=dir+movil;
  
  },
 
 validarEmail:function(valor) {
  
   if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(valor))
   {
    
    return true;
   } 
   else {
    
    return false;
   }

   },
   
 

 esNumero:function(numero){
   if (!/^([0-9])*$/.test(numero))
       return false;
   else
       return true;     
},
validarRegistrarUsuario:function()
 {
 
   var name=document.getElementById("name");
 
   if(name.value == '')
   {
      swal({ text: messages.name_not_valid, icon: "warning"});
      name.focus();
      return false;
   }
   
   var lastname=document.getElementById("lastname");
 
   if(lastname.value == '')
   {
      swal({ text:messages.lastname_not_valid, icon: "warning"});
      lastname.focus();
      return false;
   }
 

   
   var username=document.getElementById("username");
 
   if(username.value == '')
   {
      swal({ text:messages.username_not_valid, icon: "warning"});
      username.focus();
      return false;
   }
   
   var pass=document.getElementById("password");
   var confirmpass=document.getElementById("confirm");
   if (pass.value == '')
   {
     swal({ text:messages.pass_not_valid, icon: "warning"});
     pass.focus();
     return false;
   }
   
   if(pass.value != confirmpass.value)
   {
     swal({ text:messages.not_confirm_pass, icon: "warning"});
     pass.focus();
     return false;
   }
   
   return true;
 
 },
 validarModificarUsuario:function()
 {
 var name=document.getElementById("name");
 
   if(name.value == '')
   {
      swal({ text:messages.name_not_valid, icon: "warning"});
      name.focus();
      return false;
   }
   
   var lastname=document.getElementById("lastname");
 
   if(lastname.value == '')
   {
      swal({ text:messages.lastname_not_valid, icon: "warning"});
      lastname.focus();
      return false;
   }
 

   
   var username=document.getElementById("username");
 
   if(username.value == '')
   {
      swal({ text:messages.username_not_valid, icon: "warning"});
      username.focus();
      return false;
   }
   
   var pass=document.getElementById("password");
   var confirmpass=document.getElementById("change");
   
   if (pass.value != '' )
   {
      
   if(pass.value != confirmpass.value)
   {
     swal({ text:messages.not_confirm_pass, icon: "warning"});
     pass.focus();
     return false;
   }
   
   }
   
   return true;
 
 },
    validarFecha:function(dia,mes,anio)
{  
    
     if (isNaN(anio) || anio.length<4 || parseFloat(anio)<1900)
     {  
      //       ('Año inválido')  
         return false  
     }  
  
     if (isNaN(mes) || parseFloat(mes)<1 || parseFloat(mes)>12)
     {  
        // ('Mes inválido')  
         return false  
     }  
  
     if (isNaN(dia) || parseInt(dia, 10)<1 || parseInt(dia, 10)>31)
     {  
        // ('Día inválido')  
         return false  
     }  
     
     if (mes==4 || mes==6 || mes==9 || mes==11) 
     {  
         if (dia>30) 
         {  
          //   ('Día inválido')  
             return false  
         }  
     }
     // MES FEBRERO
     if(mes == 2)
     {
      if(this.esBisiesto(anio))
      {
        if(parseInt(dia) > 29)
        {
             return false;
        }
      }
      else
      {
        if(parseInt(dia) > 28)
        {
              return false;
        } 
      }
    }
    
    return true;         
},

esBisiesto:function(anio)
{
  var BISIESTO;
  if(parseInt(anio)%4==0)
  {
  
    if(parseInt(anio)%100==0)
    {
    
      if(parseInt(anio)%400==0)
      {
          BISIESTO=true;
      }
      else
      {
        BISIESTO=false;
      }
   }
   else
   {
    BISIESTO=true;
   }
 }
 else
  BISIESTO=false;
  
  return BISIESTO;
},
 validarPassword:function(pass){  
      
   var espacios = false;
   var cont = 0;
   
   if (pass.length < 6 || pass.length > 16)
   {
     swal({ text:messages.error_pass_long, icon: "warning"});
     return false;
   }
   
   while (!espacios && (cont < pass.length)) {
   
      if (pass.charAt(cont) == " ")
   
      espacios = true;
   
      cont++;
   
      }
   if (espacios) {
  
      swal({ text:messages.error_pass_space, icon: "warning"});
  
      return false;
    }
    
   return true; 
},

unlock:function(dir)
{
  
    var callAjax=new callbackClass();
    callAjax.argument=["unlock"];
    
    var ajax=ajaxClass.asyncRequest(dir,0,callAjax,'');
},

 getLocalidad:function(dir)
 {
    
    var provincia=document.getElementById("provincia");
    var valor=provincia.options[provincia.selectedIndex].value;
    var localidad=document.getElementById("localidad");
    
    if (valor != -1)
    {
    localidad.length=0;
    var nuevaOpcion=document.createElement("option"); 
    nuevaOpcion.value=0;
    nuevaOpcion.innerHTML="Cargando...";
		localidad.appendChild(nuevaOpcion);
    localidad.disabled=true; 
    var callAjax=new callbackClass();
    callAjax.argument=["listLocalidad"];
    arg='provincia='+valor;
    var ajax=ajaxClass.asyncRequest(dir,0,callAjax,arg);
    }
    else
      localidad.length=0;
   
      
 },
 listLocalidad:function(oajax)
 {

 var localidad=document.getElementById("localidad");
    localidad.disabled=false;
    
    localidad.length=0;
    
    myData = JSON.parse(oajax.responseText,function(key,value){
    if (key != "")
    {
     e=document.createElement('option');
     e.value=key;
     e.innerHTML=value;
     
     localidad.appendChild(e);
     }
   
   } );
     
     this.ordenar(localidad);
 
 },
 ordenar:function(o) {
  
 
    var v=new Array();
    
    for (var i=0; i<o.options.length; i++) {
        
        v[v.length]=new Array(o[i].text,o[i].value);
    }
    v.sort();
    
    
    for (var i=0; i<o.options.length; i++) {
        o[i]=new Option(v[i][0],v[i][1],false,false);
        if (v[i][1] == -1)
          o[i].selected=true;
    }
    
},
validarCaja:function(){

  var movil=document.getElementById("movil");
  if (movil.value == 0){
    swal({ text:messages.movil_not_valid, icon: "warning"});
    movil.focus();
    return false;
  }

  var monto=document.getElementById("monto");
  if (monto.value == ''){
   swal({ text:messages.monto_empty, icon: "warning"});
    monto.focus();
    return false;
  }else{
    val = parseFloat(monto);
    valInt = parseInteger(monto);
    if(isNaN(val) && isNaN(valInt)){
      swal({ text:messages.monto_not_valid, icon: "warning"});
      monto.focus();
      return false;
    }
  }

   var dian=document.getElementById("fecha_day");
   var mesn=document.getElementById("fecha_month");
   var yearn=document.getElementById("fecha_year");
   if (!this.validarFecha( dian.value,mesn.value,yearn.value))
   {
       swal({ text:messages.fecha_not_valid, icon: "warning"});
       dian.focus();
       return false;   
   }

   var descripcion=document.getElementById("descripcion");
   if (descripcion.value == ''){
      swal({ text:messages.description_empty, icon: "warning"});
      descripcion.focus();
      return false;
   }

   return true;
},
validarAddChofer:function()
{
  var name=document.getElementById("name");
 
   if(name.value == '')
   {
      swal({ text:messages.name_not_valid, icon: "warning"});
      name.focus();
      return false;
   }
   
   var lastname=document.getElementById("lastname");
 
   if(lastname.value == '')
   {
      swal({ text:messages.lastname_not_valid, icon: "warning"});
      lastname.focus();
      return false;
   }
   var dian=document.getElementById("fecnac_day");
   var mesn=document.getElementById("fecnac_month");
   var yearn=document.getElementById("fecnac_year");
   if (!this.validarFecha( dian.value,mesn.value,yearn.value))
   {
       swal({ text:messages.fecha_nac_not_valid, icon: "warning"});
       dian.focus();
       return false;   
   }
   var nrodoc=document.getElementById("nrodoc");
 
   if(nrodoc.value == '')
   {
      swal({ text:messages.dni_not_valid, icon: "warning"});
      nrodoc.focus();
      return false;
   }
   var provincia=document.getElementById("provincia");
   if (provincia.options[provincia.selectedIndex].value == -1)
   {
       swal({ text:messages.provincia_not_selected, icon: "warning"});
       provincia.focus();
       return false;
   
   }
   
   var localidad=document.getElementById("localidad");
   if (localidad.options[localidad.selectedIndex].value == -1)
   {
       swal({ text:messages.localidad_not_selected, icon: "warning"});
       localidad.focus();
       return false;
   
   }
   var comefvo=document.getElementById("comefvo");
 
   if(comefvo.value == '')
   {
      swal({ text:messages.comefvo_not_valid, icon: "warning"});
      comefvo.focus();
      return false;
   }
   
   var comctacte=document.getElementById("comctacte");
 
   if(comctacte.value == '')
   {
      swal({ text:messages.comctacte_not_valid, icon: "warning"});
      comctacte.focus();
      return false;
   }
   
   var diar=document.getElementById("venceregistro_day");
   var mesr=document.getElementById("venceregistro_month");
   var yearr=document.getElementById("venceregistro_year");
   if (!this.validarFecha( diar.value,mesr.value,yearr.value))
   {
       swal({ text:messages.fecha_vreg_not_valid, icon: "warning"});
       diar.focus();
       return false;   
   }
   
   var movil=document.getElementById("movil");
 
   if(movil.value == '')
   {
      swal({ text:messages.movil_not_valid, icon: "warning"});
      movil.focus();
      return false;
   }
   
    var patente=document.getElementById("patente");
   if(patente.value == '')
   {
      swal({ text:messages.patente_not_valid, icon: "warning"});
      patente.focus();
      return false;
   }
   
   var dias=document.getElementById("venceseguro_day");
   var mess=document.getElementById("venceseguro_month");
   var years=document.getElementById("venceseguro_year");
   if (!this.validarFecha( dias.value,mess.value,years.value ))
   {
       swal({ text:messages.fecha_vseg_not_valid, icon: "warning"});
       dias.focus();
       return false;   
   }
   
   var diaru=document.getElementById("venceruta_day");
   var mesru=document.getElementById("venceruta_month");
   var yearru=document.getElementById("venceruta_year");
   if (!this.validarFecha( diaru.value,mesru.value,yearru.value ))
   {
       swal({ text:messages.fecha_vrut_not_valid, icon: "warning"});
       diaru.focus();
       return false;   
   }
   
   var diasacta=document.getElementById("vencesacta_day");
   var messacta=document.getElementById("vencesacta_month");
   var yearsacta=document.getElementById("vencesacta_year");
   if (!this.validarFecha( diasacta.value,messacta.value,yearsacta.value))
   {
       swal({ text:messages.fecha_vsacta_not_valid, icon: "warning"});
       diasacta.focus();
       return false;   
   }
   
   var diavtv=document.getElementById("vencevtv_day");
   var mesvtv=document.getElementById("vencevtv_month");
   var yearvtv=document.getElementById("vencevtv_year");
   if (!this.validarFecha( diavtve.value,mesvtv.value,yearvtv.value ))
   {
       swal({ text:messages.fecha_vvtv_not_valid, icon: "warning"});
       diavtv.focus();
       return false;   
   }
   
   var diamoy=document.getElementById("vencemoy_day");
   var mesmoy=document.getElementById("vencemoy_month");
   var yearmoy=document.getElementById("vencemoy_year");
   if (!this.validarFecha( diamoy.value,mesmoy.value,yearmoy.value ))
   {
       swal({ text:messages.fecha_vmoy_not_valid, icon: "warning"});
       diamoy.focus();
       return false;   
   }
   
   
   return true;

},

validateModMovil:function()
{
var name=document.getElementById("name");
 
   if(name.value == '')
   {
      swal({ text:messages.name_not_valid, icon: "warning"});
      name.focus();
      return false;
   }
   
   var lastname=document.getElementById("lastname");
 
   if(lastname.value == '')
   {
      swal({ text:messages.lastname_not_valid, icon: "warning"});
      lastname.focus();
      return false;
   }
   var dian=document.getElementById("fecnac_day");
   var mesn=document.getElementById("fecnac_month");
   var yearn=document.getElementById("fecnac_year");
   if (!this.validarFecha( dian.value,mesn.value,yearn.value))
   {
       swal({ text:messages.fecha_nac_not_valid, icon: "warning"});
       dian.focus();
       return false;   
   }
   var nrodoc=document.getElementById("nrodoc");
 
   if(nrodoc.value == '')
   {
      swal({ text:messages.dni_not_valid, icon: "warning"});
      nrodoc.focus();
      return false;
   }
   
   var provincia=document.getElementById("provincia");
   if (provincia.options[provincia.selectedIndex].value == -1)
   {
       swal({ text:messages.provincia_not_selected, icon: "warning"});
       provincia.focus();
       return false;
   
   }
   
   var localidad=document.getElementById("localidad");
   if (localidad.options[localidad.selectedIndex].value == -1)
   {
       swal({ text:messages.localidad_not_selected, icon: "warning"});
       localidad.focus();
       return false;
   
   }
   
   
   var comefvo=document.getElementById("comefvo");
 
   if(comefvo.value == '')
   {
      swal({ text:messages.comefvo_not_valid, icon: "warning"});
      comefvo.focus();
      return false;
   }
   
   var comctacte=document.getElementById("comctacte");
 
   if(comctacte.value == '')
   {
      swal({ text:messages.comctacte_not_valid, icon: "warning"});
      comctacte.focus();
      return false;
   }
   
   var diar=document.getElementById("venceregistro_day");
   var mesr=document.getElementById("venceregistro_month");
   var yearr=document.getElementById("venceregistro_year");
   if (!this.validarFecha( diar.value,mesr.value,yearr.value ))
   {
       swal({ text:messages.fecha_vreg_not_valid, icon: "warning"});
       diar.focus();
       return false;   
   }
   
   var movil=document.getElementById("movil");
 
   if(movil.value == '')
   {
      swal({ text:messages.movil_not_valid, icon: "warning"});
      movil.focus();
      return false;
   }
    var patente=document.getElementById("patente");
   if(patente.value == '')
   {
      swal({ text:messages.patente_not_valid, icon: "warning"});
      patente.focus();
      return false;
   }
   
   var dias=document.getElementById("venceseguro_day");
   var mess=document.getElementById("venceseguro_month");
   var years=document.getElementById("venceseguro_year");
   if (!this.validarFecha( dias.value,mess.value,years.value ))
   {
       swal({ text:messages.fecha_vseg_not_valid, icon: "warning"});
       dias.focus();
       return false;   
   }
   
   var diaru=document.getElementById("venceruta_day");
   var mesru=document.getElementById("venceruta_month");
   var yearru=document.getElementById("venceruta_year");
   if (!this.validarFecha( diaru.value,mesru.value,yearru.value ))
   {
       swal({ text:messages.fecha_vrut_not_valid, icon: "warning"});
       diaru.focus();
       return false;   
   }
   
   var diasacta=document.getElementById("vencesacta_day");
   var messacta=document.getElementById("vencesacta_month");
   var yearsacta=document.getElementById("vencesacta_year");
   if (!this.validarFecha( diasacta.value,messacta.value,yearsacta.value ))
   {
       swal({ text:messages.fecha_vsacta_not_valid, icon: "warning"});
       diasacta.focus();
       return false;   
   }
   
   var diavtv=document.getElementById("vencevtv_day");
   var mesvtv=document.getElementById("vencevtv_month");
   var yearvtv=document.getElementById("vencevtv_year");
   if (!this.validarFecha( diavtv.value,mesvtv.value,yearvtv.value ))
   {
       swal({ text:messages.fecha_vvtv_not_valid, icon: "warning"});
       diavtv.focus();
       return false;   
   }
   
   var diamoy=document.getElementById("vencemoy_day");
   var mesmoy=document.getElementById("vencemoy_month");
   var yearmoy=document.getElementById("vencemoy_year");
   if (!this.validarFecha( diamoy.value,mesmoy.value,yearmoy.value ))
   {
       swal({ text:messages.fecha_vmoy_not_valid, icon: "warning"});
       diamoy.focus();
       return false;   
   }
   
   
   return true;

},
//se le pasa un caracter para verificar si es un digito entre 0 y 9
    isDigit:function (c)
    {  
       return ((c >= "0") && (c <= "9"))

    },
 isInteger:function (s)
    {   
        
        var i;
        for (i = 0; i < s.length; i++)
        {   
            var c = s.charAt(i);
           
            if( i != 0 ) {
                if (! this.isDigit(c)) return false;
            } else { 
                if (! this.isDigit(c)) return false;
            }
        }
        
        return true;
    },
    
validarSearchChofer:function()
{
   var g=document.getElementById('searchfield');
   var name=document.getElementById('name');
   var patente=document.getElementById('patente');
   if (g.value == '' && name.value == '' && patente.value == '')
   {
         swal({ text:messages.error_search_empty, icon: "warning"});
         g.focus();
         return false;
   }
  
  
  if (g.value != ''){  
     if (! this.isInteger(g.value) )
     {   swal({ text:messages.not_numeric, icon: "warning"});
         g.focus();
         return false;
     }
  }
  
  
     
  return true;
},
    
validarSearch:function(type)
{
  
  var s = document.getElementById('searchfield');
  if( s.value == '')
  {
         swal({ text:messages.error_search_empty, icon: "warning"});
         s.focus();
         return false;
  } 
  
  if (type== 1 )
  {
     var s=document.getElementById('searchfield').value;
     if (s.length > 8 )
     {   swal({ text:messages.max_length_phone, icon: "warning"});
         
         return false;
     }
        
  }
  
  if (type == 2)
  {
     
     
     
     var g=document.getElementById('searchfield');
     if (! this.isInteger(g.value) )
     {   swal({ text:messages.not_numeric, icon: "warning"});
         g.focus();
         return false;
     }
  
  }
  
  if (type == 3)
  {

    
     var g=document.getElementById('searchfield');
     if (! this.isInteger(g.value) )
     {   
        
         swal({ text:messages.movil_not_numeric, icon: "warning"});
         g.focus();
         return false;
     }
    
    dia_desde=document.getElementById('desde_day');
    mes_desde=document.getElementById('desde_month');
    year_desde=document.getElementById('desde_year');
    
    if (!this.validarFecha( dia_desde.value,mes_desde.value,year_desde.value))
   {
      
       swal({ text:messages.fecha_desde_not_valid, icon: "warning"});
       dia_desde.focus();
       return false;   
   } 
  
    dia_hasta=document.getElementById('hasta_day');
    mes_hasta=document.getElementById('hasta_month');
    year_hasta=document.getElementById('hasta_year');
    if (!this.validarFecha( dia_hasta.value,mes_hasta.value,year_hasta.value))
   {
       swal({ text:messages.fecha_hasta_not_valid, icon: "warning"});
       dia_hasta.focus();
       return false;   
   }
  
  }
  
  
  
    return true;

},

validarRecaudacionGral:function()
{
  dia_desde=document.getElementById('desde_day');
    mes_desde=document.getElementById('desde_month');
    year_desde=document.getElementById('desde_year');
    if (!this.validarFecha( dia_desde.value,mes_desde.value,year_desde.value))
   {
       swal({ text:messages.fecha_desde_not_valid, icon: "warning"});
       dia_desde.focus();
       return false;   
   } 
  
    dia_hasta=document.getElementById('hasta_day');
    mes_hasta=document.getElementById('hasta_month');
    year_hasta=document.getElementById('hasta_year');
    if (!this.validarFecha( dia_hasta.value,mes_hasta.value,year_hasta.value))
   {
       swal({ text:messages.fecha_hasta_not_valid, icon: "warning"});
       dia_hasta.focus();
       return false;   
   }

  return true;
},

validarMensual:function(){
  
  var year=document.getElementById('year');
  var movil=document.getElementById('movil');
  if(year.value == ''){
    swal({ text:"Debe ingresar un año", icon: "warning"});
    return false;
  }
  if (movil.value == ''){
    swal({ text:"Debe ingresar un número de movil", icon: "warning"});
    return false;
  }
  return true;
},

validarCtacte:function()
{
 var tel=document.getElementById('telefono');
 if(tel.value == '') 
 { 
    swal({ text:'Debe ingresar un telefono', icon: "warning"});
    tel.focus(); 
    return false; 
 } 
  
    dia_desde=document.getElementById('day');
    mes_desde=document.getElementById('month');
    year_desde=document.getElementById('year');
    if (!this.validarFecha( dia_desde.value,mes_desde.value,year_desde.value))
   {
       swal({ text:messages.fecha_desde_not_valid, icon: "warning"});
       dia_desde.focus();
       return false;   
   } 
  
    dia_hasta=document.getElementById('hday');
    mes_hasta=document.getElementById('hmonth');
    year_hasta=document.getElementById('hyear');
    if (!this.validarFecha( dia_hasta.value,mes_hasta.value,year_hasta.value))
   {
       swal({ text:messages.fecha_hasta_not_valid, icon: "warning"});
       dia_hasta.focus();
       return false;   
   }
    
  return true;

},

validarReservaListado:function()
{
 
  
    dia_desde=document.getElementById('day');
    mes_desde=document.getElementById('month');
    year_desde=document.getElementById('year');
    if (!this.validarFecha( dia_desde.value,mes_desde.value,year_desde.value))
   {
       swal({ text:messages.fecha_desde_not_valid, icon: "warning"});
       dia_desde.focus();
       return false;   
   } 
  
    dia_hasta=document.getElementById('hday');
    mes_hasta=document.getElementById('hmonth');
    year_hasta=document.getElementById('hyear');
    if (!this.validarFecha( dia_hasta.value,mes_hasta.value,year_hasta.value))
   {
       swal({ text:messages.fecha_hasta_not_valid, icon: "warning"});
       dia_hasta.focus();
       return false;   
   }
    
  return true;

},

validarRecaudacionxday:function()
{
  

  var g=document.getElementById('movil');
 
  if ( g.value == '' || ! this.isInteger(g.value) )
     {   swal({ text:messages.movil_not_numeric, icon: "warning"});
         g.focus();
         return false;
     }
   var dia_desde=document.getElementById('day');
   var mes_desde=document.getElementById('month');
   var year_desde=document.getElementById('year');
    if (!this.validarFecha( dia_desde.value,mes_desde.value,year_desde.value))
   {
       swal({ text:messages.fecha_not_valid, icon: "warning"});
       dia_desde.focus();
       return false;   
   }   
     
  return true;   

},
checkElement:function(element,e)
{
   var tecla = (document.all) ? e.keyCode : e.which;
   
  if (tecla.toString() == 32){
      if (element.checked)
         element.checked=true;
      else
        element.checked=false; 
   } 

},
getMovil:function(dir)
{
 
   if (document.getElementById('movil').value != '')
   { 
    dir +=document.getElementById('movil').value;
  
    var call=new callbackClass();
    call.argument=["showMovil"];
    var ajax=ajaxClass.asyncRequest(dir,0,call,'');
   }
},
showMovil:function(o)
{

var myData = JSON.parse(o.responseText,function(key,value){
    if (key == "marca")
    {
      document.getElementById("marca").innerHTML=value;
    }
    if (key == "name")
    {
      document.getElementById("chofer").innerHTML=value;
     }
     if (key == "lastname")
    {
      document.getElementById("chofer").innerHTML +=' '+value;
     } 
       if (key == "movilid")
     {
      document.getElementById("movilid").value = value;
     } 
    
   } );
},
getCliente:function(dir,ventana,title)
{
   
   if (document.getElementById('telefono').value != '')
   { 
    
    dir +=document.getElementById('telefono').value;
  
    var call=new callbackClass();
    ventana +=document.getElementById('telefono').value;
    call.argument=["showClienteReserva",ventana,title];
    
    
    var ajax=ajaxClass.asyncRequest(dir,0,call,'');
    $("#previus_reservas").hide();
   }

},



showClienteReserva:function(o)
{
    
    switch(o.responseText){
      case "no_exist":
                      document.getElementById("name").value='';
                      document.getElementById("desde").value='';
                      document.getElementById("observaciones").innerHTML='';
                      document.getElementById("mensaje").innerHTML='';
                      document.getElementById("info_ctacte").innerHTML='';
                      params="height=500,width=850,menubar=no,status=no,resizable=yes,scrollbars=yes,toolbar=no";
                      var addcliente=window.open(o.argument[1],"addcliente",params);   
                      document.getElementById("telefono").focus();  
                      break;
      case "client_no_active":

                              $("#banner_msg").html("No puede asignarle una reserva. El cliente esta suspendido.");
                              $("#banner_red").show();
                              $("#send").attr('disabled','disabled');
                              setTimeout( function(){ window.location.href="../inicio"; },4000);
                              break;
      case "client_borrado":
                              $("#banner_msg").html("No puede asignarle una reserva. El cliente esta borrado.");
                              $("#banner_red").show();
                              $("#send").attr('disabled','disabled');
                              setTimeout( function(){ window.location.href="../inicio"; },4000);
                            break;

      case "client_deudor":
                              $("#banner_msg").html("No puede asignarle una reserva. El cliente tiene deuda.");
                              $("#banner_red").show();
                              $("#send").attr('disabled','disabled');
                              setTimeout( function(){ window.location.href="../inicio"; },4000);
                            break; 

      default:
     
        
                var show_banner=0;
                var banner = '';
        
                myData = JSON.parse(o.responseText,function(key,value){
                    if (key == "show_banner")
                    {
                         show_banner = value;
                    }
        
                    if ( key == "banner" )
                    { 
                        banner = value;
                    }
        
                    if (key == "name")
                    {
                      document.getElementById("name").value=value;
                    }
                    if (key == "id")
                    {
                      document.getElementById("clienteid").value=value;
                      getPreviusReservas(value);
                    } 
                    if(key == "address")
                    {
                      document.getElementById("desde").value=value;
                    } 
                    if (key == "observaciones")
                    {
                      document.getElementById("observaciones").innerHTML=value;
                    }
                    if (key == "mensaje")
                    {
                      document.getElementById("mensaje").innerHTML=value;
                    }
                    if (key == "ctacte" )
                    {
                        if (value =="s"){
                          document.getElementById("info_ctacte").innerHTML=messages.ctacte_habilitada;
                          document.getElementById("ctacte").checked = true;
                        } else { 
                          document.getElementById("info_ctacte").innerHTML=messages.solo_efectivo;
                          document.getElementById("contado").checked = true;
                       }
                    }
                });
       
                if (show_banner == 1 ){
                  swal({ text:banner, icon: "warning"});
                }
        
                            

    };
 
 
  
},


getCliente2:function(dir,ventana,title)
{
   
   if (document.getElementById('telefono').value != '')
   { 
    
    dir +=document.getElementById('telefono').value;
  
    var call=new callbackClass();
    ventana +=document.getElementById('telefono').value;
    call.argument=["showClienteReserva2",ventana,title];
    
    
    var ajax=ajaxClass.asyncRequest(dir,0,call,'');
    $("#previus_reservas").hide();
   }

},



showClienteReserva2:function(o)
{
    
    switch(o.responseText){
      case "no_exist":    
                        document.getElementById("name").value='';
                        document.getElementById("desde").value='';
                        document.getElementById("observaciones").innerHTML='';
                        document.getElementById("mensaje").innerHTML='';
                        document.getElementById("info_ctacte").innerHTML='';
                        params="height=500,width=850,menubar=no,status=no,resizable=yes,scrollbars=yes,toolbar=no";
                        var addcliente=window.open(o.argument[1],"addcliente",params);   
                        document.getElementById("telefono").focus();  
                        break;
      case "client_no_active" : 
                        $("#banner_msg").html("No puede asignarle una reserva. El cliente esta suspendido");
                        $("#banner_red").show();
                        $("#send").attr('disabled','disabled');
                        setTimeout( function(){ window.location.href="../inicio"; },4000);
                        break;
      case "client_borrado":
                        $("#banner_msg").html("No puede asignarle una reserva. El cliente esta borrado");
                        $("#banner_red").show();
                        $("#send").attr('disabled','disabled');
                        setTimeout( function(){ window.location.href="../inicio"; },4000);
                        break;
      case "client_deudor":
                              $("#banner_msg").html("No puede asignarle una reserva. El cliente tiene deuda.");
                              $("#banner_red").show();
                              $("#send").attr('disabled','disabled');
                              setTimeout( function(){ window.location.href="../inicio"; },4000);
                            break;

      default:

                        var show_banner=0;
                        var banner = '';
        
                        myData = JSON.parse(o.responseText,function(key,value){
    
   
                            if (key == "show_banner")
                            {
                             
                                 show_banner = value;
                            
                            }
                            
                            if ( key == "banner" )
                            { 
                                banner = value;
                            }
                            
                            
                            if (key == "id")
                            {
                            
                              getPreviusReservas(value);
                             } 
                            
                            
                            if (key == "mensaje")
                            {
                              document.getElementById("mensaje").innerHTML=value;
                            }
                            if (key == "ctacte" )
                            {
                                if (value =="s")
                                {
                                document.getElementById("info_ctacte").innerHTML=messages.ctacte_habilitada;
                                document.getElementById("ctacte").checked = true;
                                }
                                else
                               { document.getElementById("info_ctacte").innerHTML=messages.solo_efectivo;
                                  document.getElementById("contado").checked = true;
                               }
                            }
                        } );
       
                        if (show_banner == 1 ){
                          swal({ text:banner, icon: "warning"});
                        }
        
        

    };
 
  
},







fechaMayor:function(year,month,day)
{
 var fecReserva=new Date();
 fecReserva.setFullYear(year,month-1,day);
 var fecActual=new Date(); 
 
 if(fecReserva >= fecActual)  
         return true;  
     else  
         return false;
      
},
validarHorario:function(hh,mm)
{
var a=hh.charAt(0); //<=2
var b=hh.charAt(1); //<4

var c=mm.charAt(0); //<=5
var d=mm.charAt(1); 

if ((a==2 && b>3) || (a>2)){
   swal({ text:messages.hora_not_valid, icon: "warning"});
   return false;
}

if (c>5)
{
   swal({ text:messages.minuto_not_valid, icon: "warning"});
   return false;
}

 return true;
},
validarRepetirReserva:function()
{
   var dia=document.getElementById("repeticion_day");
   var mes=document.getElementById("repeticion_month");
   var year=document.getElementById("repeticion_year");
   if (!this.validarFecha( dia.value,mes.value,year.value))
   {
       swal({ text:messages.fecha_reserva_not_valid, icon: "warning"});
       dia.focus();
       return false;   
   }
   
   if (!this.fechaMayor(year.value,mes.value,dia.value))
   {
       swal({ text:messages.fecha_reserva_menor, icon: "warning"});
       dia.focus();
       return false;
   }
   
   return true;
   
},

validarReserva:function()
{
 
  var tel=document.getElementById("telefono");
   if (tel.value == '')
   {
       swal({ text:messages.tel_empty, icon: "warning"});
       tel.focus();
       return false;
   }
   var dia=document.getElementById("reserva_day");
   var mes=document.getElementById("reserva_month");
   var year=document.getElementById("reserva_year");
   if (!this.validarFecha( dia.value,mes.value,year.value))
   {
       swal({ text:messages.fecha_reserva_not_valid, icon: "warning"});
       dia.focus();
       return false;   
   }
   
   
  /* if (!this.fechaMayor(year.value,mes.value,dia.value))
   {
       alert(messages.fecha_reserva_menor);
       dia.focus();
       return false;
   }*/
   
   var hora=document.getElementById("puerta_hour");
   var minuto=document.getElementById("puerta_min");
   if (hora.value == '' || minuto.value == '')
   {
        swal({ text:messages.horario_not_valid, icon: "warning"});
        hora.focus();
        return false;
        
   }
   else
   {
     if (!this.validarHorario(hora.value,minuto.value))
     {
          hora.focus(); 
          return false;
     }   
   
   }
   
   
   var hAlarma=document.getElementById("alarma_hour");
   var mAlarma=document.getElementById("alarma_min");
   if (hAlarma.value == '' || mAlarma.value == '')
   {
        swal({ text:messages.horario_not_valid, icon: "warning"});
        hAlarma.focus();
        return false;
        
   }
   else
   {
     if (!this.validarHorario(hAlarma.value,mAlarma.value))
     {
          hAlarma.focus(); 
          return false;
     }   
   
   }
   
  
 
   var desde=document.getElementById("desde");
   if (desde.value == '')
   {
       swal({ text:messages.desde_empty, icon: "warning"});
       desde.focus();
       return false;
   }
   var destino=document.getElementById("destino");
   if (destino.value == '')
   {
       swal({ text:messages.destino_empty, icon: "warning"});
       destino.focus();
       return false;
   }
   
   /* var mercaderia=document.getElementById("valor_mercaderia");
   if (mercaderia.value == '')
   {
      alert(messages.valor_mercaderia_not_empty);
      mercaderia.focus();
      return false;
   } */
   
   var art=document.getElementById("art");
   var art_valor=document.getElementById("art_valor");
   
   if (art_valor.value != '' && art_valor.value != 0 )
   {
      art.checked=true;
      if ( !confirm("El viaje tiene ART. Seguro quiere guardar la reserva con ART? ")){
             return false;
       }
   }
   
   
   var contado=document.getElementById("contado");
   var ctacte = document.getElementById("ctacte");
   if (contado.checked && ctacte.checked)
   {
       swal({ text:messages.one_way_pay, icon: "warning"});
       contado.focus();
       return false;
   }
   if (!contado.checked && !ctacte.checked)
   {
       swal({ text:messages.one_way_pay, icon: "warning"});
       contado.focus();
       return false;
   }
   
   var dia=document.getElementById("r_desde_day");
   var mes=document.getElementById("r_desde_month");
   var year=document.getElementById("r_desde_year");
   if (dia.value != '' ){
   if (!this.validarFecha( dia.value,mes.value,year.value))
   {
       swal({ text:messages.fecha_desde_not_valid, icon: "warning"});
       dia.focus();
       return false;   
   }
   }
   
   var dia=document.getElementById("r_hasta_day");
   var mes=document.getElementById("r_hasta_month");
   var year=document.getElementById("r_hasta_year");
   if (dia.value != '' ){
   if (!this.validarFecha( dia.value,mes.value,year.value))
   {
       swal({ text:messages.fecha_hasta_not_valid, icon: "warning"});
       dia.focus();
       return false;   
   }
   }
   
   
   
    return true;

},

validarModCliente: function(){
  //si se modifica el dato de cliente deudor debo verificar la password antes de cambiarlo
  var original = document.getElementById("deudor_value");
  var change = document.getElementById("deudor");
  if ((original.value == "0" && change.checked) || (original.value == "1" && !change.checked)){
    
    var pass = document.getElementById("pass");
    if (pass.value == ''){
      swal({ text:"Debe ingresar su password", icon: "warning"});
      return false;
    }else{
      return true;
    }
    
  }
  return true;
},



validarViaje:function()
{

var movil=document.getElementById("movil");
   if (movil.value == '')
   {
       swal({ text:messages.movil_empty, icon: "warning"});
       movil.focus();
       return false;
   }
var hh=document.getElementById();
var mm=document.getElementById();   
   if (!this.validarHorario(hh.value,mm.value ) )
   {
       
       hh.focus();
       return false;
   
   }    
   
  return true;

},
validarAsignarBase:function()
{
   var base=document.getElementById("base");
   if (base.options[base.selectedIndex].value == 0)
   {     swal({ text:messages.base_empty, icon: "warning"});
         base.focus();
         return false;
   }  
   
   var position=document.getElementById("position");
   if (position.value == '')
   {
       swal({ text:messages.position_empty, icon: "warning"});
       position.focus();
       return false;
   }
   return true;
},
allPermisos:function(form)
    {
    
     var input = form.getElementsByTagName('input');
    var check_all = document.getElementById('todos');
    
     for(i=0;i<input.length;i++)
     {
        name=input[i].name;
        if (name.match(/permiso[0-9]*/))
         {  
           if (check_all.checked)
             input[i].checked=true;
           else
             input[i].checked=false; 
              
         }
     }    
    },
allDays:function(form)
    {
    
     var input = form.getElementsByTagName('input');
    var check_all = document.getElementById('todos');
    
     for(i=0;i<input.length;i++)
     {
        name=input[i].name;
        if (name.match(/day[0-9]*/))
         {  
           if (check_all.checked)
             input[i].checked=true;
           else
             input[i].checked=false; 
              
         }
     }    
    },    
    
 changeTablaReserva:function()
 {
    
    var tabla = document.getElementById('tablereserva');
     tabla.tBodies[0].rows[0].getElementsByTagName("a")[0].focus();
 
 },
 changeTablaViaje:function()
 {
    
    var tabla = document.getElementById('tableviaje');
     tabla.tBodies[0].rows[0].getElementsByTagName("a")[0].focus();
 
 },
 validarCloseViaje:function(texto,pago)
 {
   var voucher=document.getElementById("voucher");
   
   if (pago == 2 && voucher.value == '')
   {
      swal({ text:messages.voucher_empty, icon: "warning"});
      voucher.focus();
      return false;
   }
   
   return confirm(texto);
  
 },
 
 getExcedente:function(dir)
 {

   var excedente=document.getElementById("excedente_mercaderia");
    
         
    if (excedente.value != '')
    {
    document.getElementById("excedente_monto").value='';
    var callAjax=new callbackClass();
    callAjax.argument=["showExcedente"];
    arg='excedente='+excedente.value;
    var ajax=ajaxClass.asyncRequest(dir,0,callAjax,arg);
    }
   
 
 },
 
 showExcedente:function(oajax)
 {
  var monto=document.getElementById("excedente_monto");
  
  myData = JSON.parse(oajax.responseText,function(key,value){
    if (key == "monto")
    {
     monto.value=value;
     }
     
  
     
   
   } );
 
   
 },
  

 closeAviso:function(){
   
    $("#div_aviso").hide();
  },  
 
 showRuta:function(dir){
 var desde = $("#desde").val();
 var hasta = $("#destino").val();
 if (desde != '' && hasta != '')
 {
 dir +="?d="+desde+"&h="+hasta; 
 
 Shadowbox.open({
        content:    dir,
        player:     "iframe",
        title: "Calcular Ruta"
        
    });
 }
 else{
   swal({ text:"Debe ingresar la dirección origen y destino", icon: "warning"});
 }
 },
 
 showLugar:function(dir,idElement){
 var address = $("#"+idElement).val();

   
 if ( address != '' )
    {

   dir +="?d="+address; 
   Shadowbox.open({
          content:    dir,
          player:     "iframe",
          title: "Ubicar Lugar - "+address,
          width: 400,
          height: 400
          
      });
  
    }
  else
     swal({ text:'Previamente debe ingresar la dirección', icon: "warning"});
 
 }
 
};

function getPreviusReservas(clienteid)
{
   var url=$("#clienteid").data("url");
  var server=$("#clienteid").data("server");
  var dataString = 'cliente='+clienteid;
      
   $("#table_previus_reservas").find('tbody').empty();
   
    $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: dataString,
            success: function(data) {
            if (data == '')
            $("#table_previus_reservas").find('tbody')
                  .append($('<tr>')
                      .append($('<td span="5">') 
                              .text("No hay reservas") 
                           )
                       );    
            else{
            
              $.each(data, function(i) {
              
             var y=data[i].fecha.substr(0,4);
             var m=data[i].fecha.substr(4,2);
             var d=data[i].fecha.substr(6,2);
             var f=d+"/"+m+"/"+y;
             
             var link="<a href='"+server+"reserva/mod/"+data[i].id+"'>"+f+"</a>";
             var hh=data[i].hpuerta.substr(0,2);
             var mm=data[i].hpuerta.substr(2,2);
             var h=hh+":"+mm;
             
             $("#table_previus_reservas").find('tbody')
                  .append($('<tr>')
                      .append($('<td>') 
                              .html(link) 
                           )
                      .append($('<td>') 
                              .text(h) 
                           ) 
                      .append($('<td>') 
                              .text(data[i].categoria) 
                           )     
                      .append($('<td>') 
                              .text(data[i].desde) 
                           )   
                      .append($('<td>') 
                              .text(data[i].destino) 
                           )     
                                
                      )
                  });
              }    
             $("#previus_reservas").show();
            }
          }); 
  

}

function getTotal(){
 
 var subtotal = ( $("#subtotal").val() !='' ) ? parseFloat($("#subtotal").val()).toFixed(2) : 0;
 var espera = ($("#espera").val() != '') ? parseFloat($("#espera").val()).toFixed(2) : 0;
 var peones = ($("#peones").val() != '') ? parseFloat($("#peones").val()).toFixed(2) : 0;
 var estacionamiento = ($("#estacionamiento").val() != '') ? parseFloat($("#estacionamiento").val()).toFixed(2) : 0;
 var peaje = ($("#peaje").val() != '') ? parseFloat($("#peaje").val()).toFixed(2) : 0;
 var art = ($("#art").val() != '') ? parseFloat($("#art").val()).toFixed(2) : 0;
 var iva = ($("#iva").val() != '') ? parseFloat($("#iva").val()).toFixed(2) : 0;
 var otro = ($("#otro").val() != '') ? parseFloat($("#otro").val()).toFixed(2) : 0;
 var km = ($("#km").val() != '') ? parseFloat($("#km").val()).toFixed(2) : 0;
 
 
 var porcentaje_mudanza = 0;
 if ($("#comision_mudanza").val()){
   var comision_mudanza = ($("#comision_mudanza").val() != '') ? parseFloat($("#comision_mudanza").val()).toFixed(2) : 0; 
   porcentaje_mudanza = ((parseFloat(subtotal) + parseFloat(peones) + parseFloat(otro) + parseFloat(espera)) * comision_mudanza) / 100;
   $("#mudanza").val(parseFloat(porcentaje_mudanza).toFixed(2));
 }else{
    $("#mudanza").val('');
 }
 
 var porcentaje_ctacte = 0; 
 var total1 = parseFloat(subtotal) + parseFloat(espera) + parseFloat(km) + parseFloat(peones)  + parseFloat(estacionamiento) + parseFloat(peaje) + parseFloat(art) + parseFloat(otro) +  parseFloat(iva);
 var suma_ctacte = parseFloat(subtotal) + parseFloat(espera) + parseFloat(peones)  +  parseFloat(otro)  ; 
 if ($("#comision_ctacte").val()){
    var comision_ctacte = ($("#comision_ctacte").val() != '') ? parseFloat($("#comision_ctacte").val()).toFixed(2)  : 0;
    porcentaje_ctacte = ( suma_ctacte * comision_ctacte) / 100;
    $("#porcentaje_ctacte").val(parseFloat(porcentaje_ctacte).toFixed(2));
 }
 
 
 var total = parseFloat(total1) + parseFloat(porcentaje_ctacte);
  
  $("#total_viaje").text(parseFloat(total1).toFixed(2));
  $("#total_viaje_ctacte").text(parseFloat(total).toFixed(2));
  
  var total_chofer = total1 - porcentaje_mudanza;
  
  $("#total_viaje_mudanza").text(parseFloat(total_chofer).toFixed(2));

}




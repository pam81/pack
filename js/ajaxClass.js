//*********************************************************************//
//                   //
//  Autor: Pamela A. Pereyra                                           //
//*********************************************************************//
// ajaxClass.js : Clase para el manejo de ajax 


//Clase encargada de manejar la conexion AJAX
var ajaxClass = {
 //Comienza un pedido asincronico de ajax
 // url: servicio al que se llama del servidor
 //type: el metodo a utilizar para pasar parametros 0: POST 1: GET
 //callback: objeto que indica que funciones atienden la respuesta
 //arg: argumentos a pasar al servicio, se usan en el metodo POST
 //retorna el id de la transacion comenzada
 asyncRequest:function(url,type,callback,arg)
 {  
     if (type ==0)
         var transaction = YAHOO.util.Connect.asyncRequest('POST', url, callback,arg);
      else
         var transaction = YAHOO.util.Connect.asyncRequest('GET', url, callback,null);       
      return transaction;
 },  
 
 //Comienza un pedido asincronico de ajax enviando un formulario
 //url: direccion del servicio al que se llama 
 //formObject: objeto formulario que se pasara
 //callback: objeto que indica que funciones atienden la respuesta
 //retorna el id de la transacion comenzada 
 asyncRequestForm:function(url,formObject,callback)
 {    
     YAHOO.util.Connect.setForm(formObject); 
    
     var transaction = YAHOO.util.Connect.asyncRequest('POST', url, callback);
      
     return transaction;
 },
//Indica el estado del pedido de servicio
//transaction: se le pasa el id de la transaccion realizada
//retorna el numero que representa el estado de la transacion
 statusRequest:function(transaction)
 {
      var callStatus = YAHOO.util.Connect.isCallInProgress(transaction);
      return callStatus;
 },
//Funcion encargada de procesar la respuesta en caso de exito
//recibe el objeto con la informacion de la respuesta pasado por la 
//biblioteca de yahoo y la deriva a alguna función que se indica por argumento
//al momento de enviar el pedido ajax
 responseSuccess:function(o)
 {   
      
       switch(o.argument[0])
      { 
          case "listLocalidad": 
                            
                            flete.listLocalidad(o);
                            break;
         case "showClienteReserva":
                            flete.showClienteReserva(o);
                            break; 
         case "showClienteReserva2":
                            flete.showClienteReserva2(o);
                            break;                            
         case "showMovil":
                          flete.showMovil(o);
                          break;  
         case "unlock" : break;    
         case "showExcedente":
                          flete.showExcedente(o);
                          break;  
         default:
                
                 alert('Error funci\u00F3n no indicada');
                 break;                                   
      }  
 },   
//Funcion encargada de procesar la respuesta en caso de fallo
//recibe el objeto con la informacion de la respuesta pasado por la 
//biblioteca de yahoo
 responseFailure:function(o)
 {   
      
     if (o.status == -1)
        alert(" Congesti\u00F3n en Red. Timeout ");
    /* else
        alert(" Error Conexi\u00F3n: "+ o.statusText);*/
 }
 
}; 

//Clase encargada de pasar informacion para la clase de ajax
//argument recibe nombre_function_success - nombre_idorigen - nombre_iddestino  
//success: indica la funcion que se llama en caso de exito
//failure: indica la funcion que se llama en caso de error
//scope: para tener el scope del objeto ajaxClass en esta funcion
//timeout: si la transaccion no se completa en x milisegundos se aborta    

function callbackClass()
{};

callbackClass.prototype.success=ajaxClass.responseSuccess;   
callbackClass.prototype.failure=ajaxClass.responseFailure;
callbackClass.prototype.timeout=150000; //2,5 minutos
callbackClass.prototype.argument='notDefine';
callbackClass.prototype.scope=ajaxClass;
  


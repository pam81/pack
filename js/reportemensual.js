$(document).ready(function(){
	$(".view_viajes").on("click",function(){
		var dia=$(this).data("dia");
		var mes=$("#month").val();
		var year=$("#year").val();
		var movil=$("#movil").val();
		var url = $("#url").val();
		$.ajax({
		  url: url+"viaje/getViajes",
		  dataType: 'json',
		  method: 'POST',
		  data: {movil: movil, day: dia, month: mes, year: year}
		}).done(function(response) {
			$("#list_viajes").empty();
			$("#modal_movil").text(movil);
			$("#modal_fecha").text(dia+"-"+mes+"-"+year);
			var listado = '';
			$.each(response, function(i, item){
				var contado='';
				if (item.forma_pago == 1){
					contado = "SI";
				}
				listado += "<tr><td><a href='"+url+"viaje/visualiza/"+item.id+"'>"+item.id+"</a></td><td>"+item.desde+"</td><td>"+item.destino+"</td>";
				listado += "<td>"+item.valor+"</td><td>"+item.km+"</td><td>"+item.espera+"</td><td>"+item.iva+"</td>";
				listado += "<td>"+item.peaje+"</td><td>"+item.peones+"</td><td>"+item.estacionamiento+"</td>";
				listado +="<td>"+item.art_valor+"</td><td>"+contado+"</td></tr>";
			});
			$("#list_viajes").html(listado);
			$('#myModal').modal('show');
		}).fail(function(){
			swal({ text:"error no se pudieron obtener los datos", icon: "warning"});
		});

	});

	$(".view_diaria").on("click",function(){
		var dia=$(this).data("dia");
		var mes=$("#month").val();
		var year=$("#year").val();
		var movil=$("#movil").val();
		var url = $("#url").val();
		$.ajax({
		  url: url+"viaje/getDiaria",
		  dataType: 'json',
		  method: 'POST',
		  data: {movil: movil, day: dia, month: mes, year: year}
		}).done(function(response) {
			$("#list_diaria").empty();
			$("#diaria_movil").text(movil);
			$("#diaria_fecha").text(dia+"-"+mes+"-"+year);
			var listado = '';
			$.each(response, function(i, item){
				
				listado += "<tr><td>"+item.recaudacion+"</td><td>"+item.comision+"</td>";
				listado += "<td>"+item.porcentaje+"</td><td>"+item.cco+"</td><td>"+item.iva+"</td>";
				listado += "<td>"+item.peon+"</td><td>"+item.peaje+"</td><td>"+item.estacionamiento+"</td>";
				listado +="<td>"+item.art+"</td><td>"+item.mudanza+"</td><td>"+item.total+"</td><td>"+item.descripcion+"</td></tr>";
			});
			$("#list_diaria").html(listado);
			$('#myDiariaModal').modal('show');
		}).fail(function(){
			swal({ text:"error no se pudieron obtener los datos", icon: "warning"});
		});

	});

	$(".caja").on("click", function(){
		var movil=$("#movil").val();
		var fecha = $(this).data("fecha");
		$("#caja_movil").text(movil);
		$("#fechaCaja").val(fecha);
		$('#myCajaModal').modal('show');
	});


	$("#saveCaja").on("click", function(){
		var description = $("#descripcionCaja").val();
		var typeCaja = $("#typeCaja").val();
		var montoCaja = $("#montoCaja").val();
		var movil=$("#movil").val();
		var url = $("#url").val();
		var fecha = $("#fechaCaja").val();
		if (!montoCaja){
			swal({ text:"Debe ingresar un monto.", icon: "warning"});
			return false;
		}
		if (!description){
			swal({ text:"Debe ingresar una descripción.", icon: "warning"});
			return false;
		}
	
		$.ajax({
		  url: url+"caja/addCaja",
		  dataType: 'json',
		  method: 'POST',
		  data: {movil: movil, type: typeCaja,monto: montoCaja,descripcion: description, fecha: fecha }
		}).done(function(response) {
			$('#myCajaModal').modal('hide');
			location.reload();
		}).fail(function(){
			swal({ text:"No se ha podido agregar el movimiento de caja.", icon: "warning"});
		});

	});

});
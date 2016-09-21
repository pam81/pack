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
			$("#modal_movil").text(movil);
			$("#modal_fecha").text(dia+"-"+mes+"-"+year);
			$.each(response, function(i, item){
				var contado='';
				if (item.forma_pago == 1){
					contado = "SI";
				}
				listado += "<tr><td><a href='"+url+"viaje/visualiza/"+item.id+"'>"+item.id+"</a></td><td>"+item.desde+"</td><td>"+item.destino+"</td>";
				listado += "<td>"+item.valor+"</td><td>"+item.espera+"</td><td>"+item.iva+"</td>";
				listado += "<td>"+item.peaje+"</td><td>"+item.peones+"</td><td>"+item.estacionamiento+"</td>";
				listado +="<td>"+item.art_valor+"</td><td>"+contado+"</td></tr>";
			});
			$("#list_viajes").html(listado);
		  	$('#myModal').modal('show');
		}).fail(function(){
			alert("error no se pudieron obtener los datos");
		});

	});

});
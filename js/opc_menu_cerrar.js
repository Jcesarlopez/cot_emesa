function cerrar()
{
	
	if(parseInt(mostrarStatusCambios()) == 1)
	{			
		var htmlGuardar = '<a href="#!" onclick="guardar('+"'Cerrar'"+')" class="modal-action modal-close waves-effect waves-green btn-flat">Guardar</a>';
		$('#divaGuardarAntesAccion').html(htmlGuardar);

		var htmlContinuar = '<a href="#!" onclick="cerrarCotizacionesPaso2();" class="modal-action modal-close waves-effect waves-green btn-flat">Continuar sin guardar</a>';
		$('#divaCotinuarAntesAccion').html(htmlContinuar);

		$('#modalCambios').openModal();
		
	}
	else
	{
		cerrarCotizacionesPaso2();
		
	}
}
function cerrarCotizacionesPaso2()
{	
	$.ajax({
		url:'Controlador/ControladorCerrar.php',
		type:'POST',
		data:'accion=cerrarCot'
		});


	$("#divFondo").css("visibility", "visible");	
 	$("#basicos").css("visibility","hidden");
	$("#DivPlanta").css("visibility","hidden");
	$("#divGraficaPTARIncluNoIncluEntrega").css("visibility","hidden");
	$("#divInfoAdicionalMaterial").css({"display":"none"});


	$('.button-collapse').sideNav('hide');
	$("#divStatusCot").html("<br>COTIZACIONES");
	cambiarTipoCot(0,true);
}
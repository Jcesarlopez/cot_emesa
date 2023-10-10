function nuevaCot()
{
	verificarSession(true);
	$.ajax({
		url:'Controlador/control.php',
		type:'POST',
		data:'Accion=mostrarStatus'		
	}).done(function(resp){

		if(parseInt(resp)==1) // Si hay cambios entonces preguntamos si los desea guardar
		{
			var htmlGuardar = '<a href="#!" onclick="guardar('+"'Nuevo'"+')" class="modal-action modal-close waves-effect waves-green btn-flat">Guardar</a>';
			$('#divaGuardarAntesAccion').html(htmlGuardar);

			var htmlContinuar = '<a href="#!" onclick="nuevaCothtml()" class="modal-action modal-close waves-effect waves-green btn-flat">Continuar sin guardar</a>';
			$('#divaCotinuarAntesAccion').html(htmlContinuar);
		
			$('#modalCambios').openModal();
		}else
		{
			nuevaCothtml();
		}
	});

}




function nuevaCothtml()
{		
 	$("#divFondo").css("visibility", "hidden");
 	$("#basicos").css("visibility","visible");
	$("#DivPlanta").css("visibility","visible");
	$("#divGraficaPTARIncluNoIncluEntrega").css("visibility","visible");
	$("#divInfoAdicionalMaterial").css({"display":"none"});


	


	// Quitamos texto del cliente
	$('#spanNomEmpresacliente').html('');
	$('#spanNomContactocliente').html('');

	// Poner Fecha por default	
	var $input = $('#birthdate').pickadate();	
	var picker = $input.pickadate('picker');
	picker.set('select', new Date());



	//Quitamos la referencia
	$('#referencia').val('');

	//Restauramos el div de la planta
	var	planta = '<div class="col s12 m12 l12 ">';
		 planta+='<div class="card blue darken-2 white-text">';
	        planta+='<div class="card-content CardsPTAR center-align">';
	        	planta+='<span class="card-title">Tipo de cotizaci&oacute;n</span>';
	          	//planta+='<div class="titleCard">';
	          	 
	          	 /*planta+='<div class="titleCard">';*/

	         	 planta+='<br><br><p><a href="#modalPTAR" onclick="selPTAR(1,0,0,0)" class="modal-trigger waves-effect waves-light btn blue darken-4 btn-large">Planta de Tratamiento</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp';
	         	 planta+='<a href="#"  onclick="adaptarMaterial();" class="waves-effect waves-light btn blue darken-4 btn-large">Equipo y material</a></p>';
	          //planta+='</div>';
	        planta+='</div>';
	      planta+='</div>';
	planta+='</div>';
	$('#DivPlanta').html(planta);


	//Div de la grafica incluye y no incluye	
	var	grafINE='<div class="row">';
    	grafINE+='<div class="col m12 l8" id="divGraficaPTAR">&nbsp;</div>';
    	grafINE+='<div class="col m12 l4" id="divIncluNoincluEntregaPTAR">&nbsp;</div>';
   		grafINE+='</div>';	

    // Agregamos el script para reactivar los modals
	grafINE+='<script>';
	grafINE+='$(document).ready(function(){';

 	grafINE+="$('.modal-trigger').leanModal();";
	grafINE+='});'; 
	grafINE+='</script>'; 


	$("#txtFrancoBordo").val("");
	$("#txtVigencia").val("30 DIAS");
	$("#txtCondiciones").val("DE CONTADO");
	$("#txtEntrega").val("");		


	

	$('#divStatusCot').html('<br>Nueva cotizaci&oacute;n');   

	$('#divGraficaPTARIncluNoIncluEntrega').html(grafINE);
	$('.button-collapse').sideNav('hide');

	$.ajax({
	url:'Controlador/ControladorNuevo.php',
	type:'POST',
	data:'Accion=Nuevo'
	});
	
	

}
	

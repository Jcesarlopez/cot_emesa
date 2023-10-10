function nuevaCot()
{
	$.ajax({
	url:'Controlador/ControladorNuevo.php',
	type:'POST',
	data:'Accion=Nuevo'
	}).done(function(resp){				
		alert(resp);
		//MostrarCotizacionesHtml(eval(resp));
	});


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
	var	planta = '<div class="col m12 l12 ">';
		 planta+='<div class="card cyan darken-3 white-text">';
	        planta+='<div class="card-content CardsPTAR valign-wrapper">';
	          planta+='<div class="titleCard">';
	         	 planta+='<a href="#modalPTAR"  onclick="selPTAR(1,0,0,0)" class="modal-trigger waves-effect waves-light btn orange">Planta de Tratamiento</a>';
	          planta+='</div>';
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

	$('#divStatusCot').html('Nueva cotizaci&oacute;n - Planta de Tratamiento');   

	$('#divGraficaPTARIncluNoIncluEntrega').html(grafINE);
	$('.button-collapse').sideNav('hide');


}

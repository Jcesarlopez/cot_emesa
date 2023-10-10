function mostrarVendedores($IdVenDefault)
{
	
	$.ajax({
		url:'Controlador/Controlador.php',
		type:'POST',
		data:'accion=mostrarVendedores&IdUsuario='+$IdVenDefault
		}).done(function(resp){
						
			var datos = '<select id="selVenderor" onchange="statusCambios(1,true)" class="bordeSelect">'+resp+'</select>';
			

			$('#selVenderor').material_select('destroy');
			$("#pselVendedor").html(datos);

			// Al cambiar el select tenemos que ejecutar este script para regenerarlo
			$(document).ready(function() {
    		$('select').material_select();
 			 });

		});

}
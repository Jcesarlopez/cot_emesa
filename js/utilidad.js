function cambiarUtilidad(utilidad,tipo)
{
	$.ajax({
	url:'Controlador/utilidad.php',
	type:'POST',
	data:'accion=Cambiar&utilidad='+utilidad+'&TipoUtilidad='+tipo
	}).done(function(resp){		
		var json = JSON.parse(resp);	
		var html='<i class="material-icons left">library_books</i>Utilidad '+json.utilidad+'%</a>';
		$('#aUtilidad').html(html);



		$.ajax({
		url:'Controlador/ControladorPlantaPartidas.php',
		type:'POST',
		data:'accion=Mostrar'
		}).done(function(resp){
				mostrarPartidasHtml(resp);				
				mostrarTotales();				
		});

		
	});

	

	
}
function ajaxUtilidad()
{

	$.ajax({
	url:'Controlador/utilidad.php',
	type:'POST',
	async: false,
	data:'accion=Mostrar'
	}).done(function(resp){
		json = JSON.parse(resp);		
	});
	return json;

}
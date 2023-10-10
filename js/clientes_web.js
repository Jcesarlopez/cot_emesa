function filtarClweb(valor)
{
	if(valor.length>2)
	{
		$.ajax({
			url:'Controlador/ControladorClientesWeb.php',
			type:'POST',
			data: 'Accion=filtrar'+"&Valor="+valor
			}).done(function(resp){
				llenarListaClientesWebHtml(resp);							
		});

	}

}


function selectClienteWeb(IdClWeb)
{
	$('#modalBuscaClienteWeb').closeModal();
	$.ajax({
			url:'Controlador/ControladorClientesWeb.php',
			type:'POST',
			data: 'Accion=unCliente'+"&IdClWeb="+IdClWeb
			}).done(function(resp){
				var jsonClienteWeb = JSON.parse(resp);				

				$('#h5EditCliente').html("Nuevo cliente");
				$("#ClNombre").prop('disabled', false);
				$('#ClNombre').val(jsonClienteWeb.cliente);
				$('#ClContacto').val(jsonClienteWeb.atencion);
				$('#ClTel1').val(jsonClienteWeb.telefono);
				$('#ClTel2').val(jsonClienteWeb.movil);
				$('#ClPais').val(jsonClienteWeb.pais);
				$('#ClEstado').val(jsonClienteWeb.estado);
				$('#ClCiudad').val(jsonClienteWeb.ciudad);
				$('#ClDireccion').val(jsonClienteWeb.direccion);
				$('#ClRFC').val("");
				$('#ClCorreo').val(jsonClienteWeb.correo);
				$('#ClCP').val("");
				$('#statusFormCliente').val("Nuevo");				
				$('#modalEditCliente').openModal();
	});
}

function masInfoClWeb()
{

	var mensaje = "cesar<br>Lopez<br>Ocampo"
	Materialize.toast(mensaje, 10000,'',function(){});

}

function llenarListaClientesWebHtml(resp)
{
	var jsonClienteWeb = JSON.parse(resp);
	var datos = '<ul class="collection with-header">';	

	datos+= "<style>#spanNomClWeb{font-size:.7rem;font-weight:bold}#spanAtnClWeb{font-size:.7rem;}";

	datos+=".iconClienteWebPeq{font-size:1.2rem!important;color:#777777!important;cursor:default}";
	datos+=".iconClienteWebPeq:hover{color:#999999!important;}";
	datos+="</style>";



	for(var i in jsonClienteWeb){

		coment=jsonClienteWeb[i].comentarios;
		lugar=jsonClienteWeb[i].direccion+", "+jsonClienteWeb[i].estado+", "+jsonClienteWeb[i].ciudad+", "+jsonClienteWeb[i].pais;    	
    	datos+='<li class="liLista collection-item">';
			   datos+='<div><span id="spanNomClWeb">'+jsonClienteWeb[i].cliente+'</span><span id="spanAtnClWeb"> ('+jsonClienteWeb[i].atencion+')</span>';			   
					datos+='<a href="#!" class="up4px secondary-content">';
						datos+='<i title="'+lugar+'"  class="iconCliente iconClienteWebPeq material-icons blue-text">place</i>';
						datos+='<i title="'+coment+'"  class="iconCliente iconClienteWebPeq material-icons blue-text">comment</i>&nbsp;';
						datos+='<i title="Elegir este cliente"  onclick="selectClienteWeb('+jsonClienteWeb[i].numero+')" class="iconCliente material-icons blue-text">send</i>';
					datos+='</a>';
				datos+='</div>';
			datos+='</li>';

	}

	datos +="</ul>";
								
	$("#ListaClientesWeb").html(datos);


					

}
function ListaClientesWeb()
{

	$.ajax({
			url:'Controlador/ControladorClientesWeb.php',
			type:'POST',
			data: 'Accion=ListaDefault'
			}).done(function(resp){
				llenarListaClientesWebHtml(resp);			
	});
	
	
}
function nuevoClienteForm()
{
	$('#h5EditCliente').html("Nuevo cliente");
	$("#ClNombre").prop('disabled', false);
	$('#ClNombre').val("");
	$('#ClContacto').val("");
	$('#ClContacto2').val("");
	$('#ClContacto3').val("");
	$('#ClTel1').val("");
	$('#ClTel2').val("");
	//$('#ClPais').val("M&eacute;xico");
	$('#ClEstado').val("");
	$('#ClCiudad').val("");
	$('#ClDireccion').val("");
	$('#ClRFC').val("");
	$('#ClCorreo').val("");
	$('#ClCP').val("");
	$('#statusFormCliente').val("Nuevo");
}

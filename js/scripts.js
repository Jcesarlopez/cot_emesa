function truncarCadena(cadena,numero)
{

	if(cadena.length >= numero)
	{
		cadena = cadena.substring(0,numero)+"...";
	}
	return cadena;
}

function cambiarUSD(valor,asincrono)
{
	if(valor)	
	{
		valor=1;
	}else
	{
		valor=0;
	}

	$.ajax({
		url:'Controlador/control.php',
		type:'POST',		
		data:'Accion=cambiaUSD&valor='+valor,
		async: asincrono
		}).done(function(resp){
			statusCambios(1,true);
		});		

}

function mostrarDolar()
{


}
function recargarModals()
{
	$(document).ready(function(){
		$('.modal-trigger').leanModal();
	});	
}
function soloNumeros(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function cambiarTipoCot(tipo,asincrono)
{
		// tipo 0 no esta definido, tipo 1 no esta planta, tipo 2 no esta material y equipo 
		$.ajax({
			url:'Controlador/control.php',
			type:'POST',		
			data:'Accion=cambiarTipoCot&tipo='+tipo,
			async: asincrono
		})		
}
function mostrarTipoCot()
{		
		// tipo 0 no esta definido, tipo 1 planta, tipo 2 material y equipo 
		$.ajax({
			url:'Controlador/control.php',
			type:'POST',			
			async: false,
			data:'Accion=MostrarTipoCot'
		}).done(function(resp){
			dato = eval(resp);			
		});		
		return dato;
}



function verificarSession(asyncResp)
{
	$.ajax({
			url:'Controlador/control.php',
			type:'POST',		
			data:'Accion=estadoSession',
			async: asyncResp
		}).done(function(resp){
			if(resp!="Activo") 
			{
				window.location.href="./index.php?param1=SessionExpire";
			}
		})	
}

function miles2(valor)
{
	valorConDecimales = "";
	contarMiles=-2;

	for(i=valor.length;i>-1;i--)	
	{
		contarMiles++;
		if(contarMiles==3 && i!=valor.length)
		{
			valorConDecimales=","+valorConDecimales;
			contarMiles=0;
		}
		valorConDecimales=valor.charAt(i)+valorConDecimales;			
	}
	return valorConDecimales;
}
function cerrarModal(id)
{
	$('#'+id).closeModal();
}
function statusCambios(valor,async)
{
	$.ajax({
		url:'Controlador/control.php',
		type:'POST',
		async: async,
		data:'Accion=CambiarStatus&status='+valor
	});
}
function mostrarStatusCambios()
{
	$.ajax({
		url:'Controlador/control.php',
		type:'POST',
		async:false,		
		data:'Accion=mostrarStatus'		
	}).done(function(resp){
		valor = resp;	
	});
	return valor;
}
function cambiarEstado(valor)
{
	$.ajax({		
		url:'Controlador/control.php',
		type:'POST',
		async: false,
		data:'Accion=cambiarEstado&Estado='+valor
	});	
}
function mostrarEstado()
{
	$.ajax({		
		url:'Controlador/control.php',
		type:'POST',
		async: false,
		data:'Accion=mostrarEstado'
	}).done(function(resp){
		estado = resp;
	});
	return estado;

}
function cambiarEstadoNotaPartida(valor,async)
{
	asincrono = async;
	statusCambios(1,true);
	$.ajax({
		url:'Controlador/control.php',type:'POST',async: asincrono,data:'Accion=cambiarEstadoNotaPartida&NotaPartida='+valor
	});
}
function cambiarEstadoIlustrativa(valor,async)
{
	statusCambios(1,true);
	if(valor){valor = 1;}else{valor = 0;}
	asincrono = async;
	$.ajax({
		url:'Controlador/control.php',type:'POST',async: asincrono,data:'Accion=cambiarEstadoIlustrativa&Ilustrativa='+valor
	})
	

}




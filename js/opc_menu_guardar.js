function guardar(callbefore) //Callbefore indica de que lugar fue invocatada la funcion guardar
{
	verificarSession(true);
	// Fecha
	var $input = $('#birthdate').pickadate();
	var picker = $input.pickadate('picker');
	var Fecha  = picker.get('highlight', 'yyyy/mm/dd');	
	var IdVend = $("#selVenderor").val();
	
	// Extrañamente los &nbsp; de la cadena truncaba la misma al momento de manipularla en el php, y la funcion replace de java script solamente sustituye una instancia
	// por eso tengo que repetirla varias veces, pa' que amarre!.
	var clAtn = $("#spanNomContactocliente").html().replace("&nbsp;"," ");	
	
	var clAtn = clAtn.replace("&nbsp;"," ");	
	var clAtn = clAtn.replace("&nbsp;"," ");	
	var clAtn = clAtn.replace("&nbsp;"," ");	
	var clAtn = clAtn.replace("&nbsp;"," ");
	var clAtn = clAtn.replace("&nbsp;"," ");	
	var clAtn = clAtn.replace("&nbsp;"," ");	
	var clAtn = clAtn.replace("&nbsp;"," ");	
	var clAtn = clAtn.replace("&nbsp;"," ");	
	var clAtn = clAtn.replace("&nbsp;"," ");		
	var clAtn = clAtn.replace("&nbsp;"," ");	
	var clAtn = clAtn.replace("&nbsp;"," ");	
	var clAtn = clAtn.replace("&nbsp;"," ");	
	var clAtn = clAtn.replace("&nbsp;"," ");	
	

	
	var Ref = $("#referencia").val();
	var IVA = $("#hiddenIVA").val();

	//alert(mostrarEstado());
	if(mostrarEstado()=="Cerrar")
	{
		Materialize.toast("No se esta editando actualmente una cotizaci&oacute;n",4000,'',function(){$('.button-collapse').sideNav('hide')})
		return ;
	}

	


	var FrancoBordo = $("#txtFrancoBordo").val();
	var Vigencia = $("#txtVigencia").val();
	var Condiciones = $("#txtCondiciones").val();
	var Entrega = $("#txtEntrega").val();


	var tipoCot = mostrarTipoCot();
	
	
	
	campos = '&IVA='+IVA+"&Fecha="+Fecha+"&Ref="+Ref+"&IdVend="+IdVend+"&clAtn="+clAtn;			
	
	// Si se trata de material, se agregan estos campos
	if(tipoCot==2)
	{
		campos+= "&Franco="+FrancoBordo+"&Vigencia="+Vigencia+"&Condiciones="+Condiciones+"&Entrega="+Entrega;		
		tipoCotTxt = "Equipo y Material";
	}
	// Si es una planta la cotizacion
	if(tipoCot==1)
	{
		tipoCotTxt = "Planta de Tratamiento";
	}
	


	


	$.ajax({
	url:'Controlador/ControladorGuardar.php',
	type:'POST',
	data:'Accion=Guardar'+campos
	}).done(function(resp){
		
		
		var parametros = JSON.parse(resp);

		
		Materialize.toast(parametros.Mensaje, 4000,'',function(){$('.button-collapse').sideNav('hide')})
		if(!parametros.Error)
		{
			cambiarEstado("Cambios");
			statusCambios(0,true);

			if(callbefore=='Nuevo') // Si se invoco al tratar de hacer una nueva cotizacion
			{
				nuevaCothtml();
				$("#divStatusCot").html("<br>Nueva cotizaci&oacute;n - "+tipoCotTxt);
			}
			if(callbefore=='Abrir') // Si se invoco al tratar de abrir una cotizacion
			{
				abrirCotizacionesPaso2();
				$("#divStatusCot").html("<br>Cotizaciones - "+tipoCotTxt);
			}
			if(callbefore=='Menu') // Si se invoco directamente del menu la opcion guardar
			{
				$("#divStatusCot").html("<br>Editando cotizaci&oacute;n "+parametros.Cotizacion+" - "+tipoCotTxt);
			}
			if(callbefore=='Cerrar') // Si se invoco al tratar de cerrar
			{
				cerrarCotizacionesPaso2();
			}
			if(callbefore=='Word') // Si se invoco directamente del menu->opcion Word
			{
				word();
				$("#divStatusCot").html("<br>Editando cotizaci&oacute;n "+parametros.Cotizacion+" - "+tipoCotTxt);


			}
		}
	});
}
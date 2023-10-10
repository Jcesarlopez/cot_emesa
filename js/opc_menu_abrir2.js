function abrirCotizaciones()
{
	if(parseInt(mostrarStatusCambios()) == 1)
	{			
		var htmlGuardar = '<a href="#!" onclick="guardar('+"'Abrir'"+')" class="modal-action modal-close waves-effect waves-green btn-flat">Guardar</a>';
		$('#divaGuardarAntesAccion').html(htmlGuardar);

		var htmlContinuar = '<a href="#!" onclick="abrirCotizacionesPaso2();" class="modal-action modal-close waves-effect waves-green btn-flat">Continuar sin guardar</a>';
		$('#divaCotinuarAntesAccion').html(htmlContinuar);

		$('#modalCambios').openModal();
		
	}
	else
	{
		abrirCotizacionesPaso2();
		
	}
}
function abrirCotizacionesPaso2()
{
	nuevaCothtml();
	$("#divFondo").css("visibility", "visible");
	$('.button-collapse').sideNav('hide');
	$('#modalAbrirCot').openModal();
	cotizacionesDefecto();
}
function cotizacionesDefecto()
{
		$.ajax({
		url:'Controlador/ControladorCotizaciones.php',
		type:'POST',
		data:'Accion=Defecto'
		}).done(function(resp){	
			
			MostrarCotizacionesHtml(eval(resp));


			
			
		});
}

function MostrarCotizacionesHtml(valores)
{

	var datos = "<style>.sTexAbrir{font-size:.7em;}";
	datos+= ".rowAbrir{height:2.5em;margin-top:0px;margin-bottom:0px;padding-top:.5em;cursor:pointer;}";
	datos+= ".rowAbrirHead{height:2.5em;margin-top:0px;margin-bottom:0px;padding-top:.5em;}";
	datos+= ".rowAbrir:hover{background-color:#ddd;}"
	datos+="</style>";

	var DR='<div onclick="" class="row rowAbrir">';
	var DRHead='<div onclick="" class="row rowAbrirHead blue darken-2 white-text">';
	var s="</span>";
	var E="</div>";	
	$ancho = $(window).width();

	
	//if($ancho>=1301)
	//{
		var DC1='<div class="col l1"><span class="sTexAbrir">';
		var DC2='<div class="col l3"><span class="sTexAbrir">';
		var DC3='<div class="col l3"><span class="sTexAbrir">';
		var DC4='<div class="col l2"><span class="sTexAbrir">';
		var DC5='<div class="col l2"><span class="sTexAbrir">';
		var DC6='<div class="col l1"><span class="sTexAbrir">';

		//Encabezados
		datos+=DRHead;//Row		
			datos+=DC1+"<strong>NO. COT</strong>"+s+E;
			datos+=DC2+"<strong>REFERENCIA</strong>"+s+E;
			datos+=DC3+"<strong>CLIENTE</strong>"+s+E;
			datos+=DC4+"<strong>CONTACTO</strong>"+s+E;
			datos+=DC5+"<strong>PLANTA</strong>"+s+E;
			datos+=DC6+"<strong>FECHA</strong>"+s+E;
		datos+=E;

	DRHead='<div onclick="" class="row rowAbrirHead">';


	for(i=0;i<valores.length;i++)
	{		
		if(valores[i]['PlantSerie']=="1")
		{
			var serie = "Sel.";
		}
		if(valores[i]['PlantSerie']=="2")
		{
			var serie = "Urb.";
		}
		if(valores[i]['PlantTipo']=="2")
		{
			var tipo = "O.C ";
		}else
		{
			var tipo = "PK ";
		}
		var planta = tipo+serie+" "+valores[i]['LPS']+" LPS";

		var ArrayFecha  = valores[i]['Fecha'].split("-");

		var strFecha = ArrayFecha[2]+"/"+ArrayFecha[1]+"/"+ArrayFecha[0];



		datos+='<div onclick="abrirCot('+valores[i]['IdCot']+','+valores[i]['PlantTipo']+')" class="row rowAbrir">';//Row		
			datos+=DC1+valores[i]['IdCot']+s+E;
			datos+=DC2+valores[i]['Ref']+s+E;
			datos+=DC3+valores[i]['NomCl']+s+E;
			datos+=DC4+valores[i]['AtnCl']+s+E;
			datos+=DC5+planta+s+E;
			datos+=DC6+strFecha+s+E;			 
		datos+=E;//Cerramos el row
	}
	statusCambios(0,true);
	$('#lista_cotizaciones').html(datos);
}
function buscarCots(cadena)
{

	if(cadena.length>=3)
	{
		$.ajax({
		url:'Controlador/ControladorCotizaciones.php',
		type:'POST',
		data:'Accion=Buscar&Cadena='+cadena
		}).done(function(resp){				
			MostrarCotizacionesHtml(eval(resp));
		});
	}
}
function abrirCot(IdCotizacion,Tipo)
{

	$("#divStatusCot").html("<br>Editando cotizaci&oacute;n "+IdCotizacion+" - Planta de Tratamiento");
	$("#divFondo").css("visibility", "hidden");
	$("#basicos").css("visibility","visible");
	$("#DivPlanta").css("visibility","visible");
	$("#divGraficaPTARIncluNoIncluEntrega").css("visibility","visible");

	var divsPartProp='<div id="divPartidasPTAR" class="col m12 l8 "></div>';
		divsPartProp+='<div id="divPropiedadesPTAR" class="col m12 l4 "></div>';
		$('#DivPlanta').html(divsPartProp);	

	    

	// Datos basicos planta
	$.ajax({
	url:'Controlador/ControladorDatosBasicosPlanta.php',
	type:'POST',
	async:false,
	data:'accion=TraerBasicos&IdCotizacion='+IdCotizacion
	}).done(function(resp){
		jsonDatBasic = JSON.parse(resp);
		plantaTipo = parseInt(jsonDatBasic.PlantaTipo);
		$("#referencia").val(jsonDatBasic.Referencia); // Referencia
		SeleCliente(jsonDatBasic.IdCl); // Cliente
		
		////////////// Fecha
		var $input = $('#birthdate').pickadate();	
		var picker = $input.pickadate('picker');
		picker.set('select', new Date(jsonDatBasic.Fecha.split("-")));
		
		////////////////

		mostrarVendedores(jsonDatBasic.IdUser);
		statusCambios(0,true); // Cambiamos el status	      				


		var IVA = jsonDatBasic.IVA;
		var Utilidad = jsonDatBasic.Utilidad;

		
		
		if (jsonDatBasic.TipoUtil == 1)
		{			
			var TipoUtilidad = true;
		}else
		{
			var TipoUtilidad = false;
		}
		

		cambiarUtilidad(Utilidad,TipoUtilidad);
		

		$('#hiddenIVA').val(IVA);

		


		// Partidas planta
		$.ajax({
		url:'Controlador/ControladorPlantaPartidas.php',
		type:'POST',
		data:'accion=TraerPartidasCot&IdCotizacion='+IdCotizacion
		}).done(function(respPart){	
			mostrarPartidasHtml(respPart);
			statusCambios(0,true); // Cambiamos el status	      				
		});




	});



	// Propiedades planta
	$.ajax({
		url:'Controlador/ControladorPlantaPropiedades.php',
		type:'POST',
		data:'accion=TraerPropiedadesCot&IdCotizacion='+IdCotizacion
	}).done(function(propPTAR){
		mostrarPropiedadesHtml(propPTAR);
		statusCambios(0,true); // Cambiamos el status	      				
	});


	var divsPartProp='<div id="divPartidasPTAR" class="col m12 l8 "></div>';
	divsPartProp+='<div id="divPropiedadesPTAR" class="col m12 l4 "></div>';
	$('#DivPlanta').html(divsPartProp);	



	



	var divsGrafica = '<div class="row">';
	if(plantaTipo  == 2)
	{
		divsGrafica+='<div class="col s12 m12 l8" id="divGraficaPTAR">&nbsp;</div>';
    	divsGrafica+='<div class="col s12 m12 l4" id="divIncluNoincluEntregaPTAR">&nbsp;</div>';
	}else
	{
		divsGrafica+='<div class="col s12 m12 l12" id="divIncluNoincluEntregaPTAR">&nbsp;</div>';
	}
	divsGrafica+='</div>';


	$("#divGraficaPTARIncluNoIncluEntrega").html(divsGrafica);

	// Grafica
	if(plantaTipo  == 2)
	{		
		$.ajax({
			url:'Controlador/ControladorPlantaGrafica.php',
			type:'POST',
			data:'Accion=TraerGraficaCot&IdCotizacion='+IdCotizacion
		}).done(function(respGraf){
			mostrarGraficaHTML(respGraf);
			statusCambios(0,true); // Cambiamos el status	      				
		});		
	}








	
	$.ajax({
		url:'Controlador/control.php',
		type:'POST',		
		data:'Accion=mostrarNoCotVerweb'		
	}).done(function(resp){		
		
		// Con esto exluimos las plantas de obra civil inferiores al NoCot Version que no es Web.
		if(IdCotizacion >= parseInt(resp) || Tipo!=2)
		{
			crearListaIncluNoincluEntrega(Tipo,1);					
			//Incluye
			$.ajax({
			url:'Controlador/ControladorPlantaIncluye.php',
			type:'POST',
			data:'Accion=TraerIncluCot'+'&IdCotizacion='+IdCotizacion
			}).done(function(respIn){						
		      	mostrarIncluyeHTML(respIn); 
		      	statusCambios(0,true); // Cambiamos el status	      				
			});


			//NoIncluye
			$.ajax({
			url:'Controlador/ControladorPlantaNoIncluye.php',
			type:'POST',
			data:'Accion=TraerNoIncluCot'+'&IdCotizacion='+IdCotizacion
			}).done(function(respNoIn){						
		      	mostrarNoIncluyeHTML(respNoIn);	
		      	statusCambios(0,true); // Cambiamos el status	      				
			});



			if(Tipo==2) //Entregar
			{						
				$.ajax({
				url:'Controlador/ControladorPlantaEntregar.php',
				type:'POST',
				data:'Accion=TraerEntregaCot'+'&IdCotizacion='+IdCotizacion
				}).done(function(resp){						
			      	mostrarEntregarHTML(resp);
			      	statusCambios(0,true); // Cambiamos el status	      				
				});						
			}
		}
		else
		{
			crearListaIncluNoincluEntrega(Tipo,0);					
		}
	});


	



	
	
	$('#modalAbrirCot').closeModal();	

	
	
	// Cambiamos el estado
	$.ajax({
		url:'Controlador/control.php',
		type:'POST',
		data:'Accion=cambiarEstado&Estado=Cambios'
	});	
	statusCambios(0,false); // Cambiamos el status

}

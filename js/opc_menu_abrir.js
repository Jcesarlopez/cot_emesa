function abrirCotizaciones()
{
	verificarSession(true);
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
	$('#divStatusCot').html('<br>COTIZACIONES');  
	cotizacionesDefecto();
}
function cotizacionesDefecto()
{
		$.ajax({
		url:'Controlador/ControladorCotizaciones.php',
		type:'POST',
		data:'Accion=Defecto'
		}).done(function(resp){		
			MostrarCotizacionesHtml(resp);

		});
}
 
function MostrarCotizacionesHtml(valores)
{
	
	

	
	var datos = "<style>.sTexAbrir{font-size:.83em;font-weight:bold}";
	datos+= ".rowAbrir{height:2.5em;margin-top:0px;margin-bottom:0px;padding-top:.5em;cursor:pointer;}";
	datos+= ".rowAbrirHead{height:2.5em;margin-top:0px;margin-bottom:0px;padding-top:.5em;}";
	datos+= ".rowAbrir:hover{background-color:#ddd;}"
	datos+="</style>";

	var DR='<div onclick="" class="row rowAbrir">';
	var DRHead='<div onclick="" class="row rowAbrirHead blue darken-2 white-text">';
	var s="</span>";
	var E="</div>";	
	$ancho = $(window).width();
	FactorTruncarRef = Math.trunc($ancho/27);
	FactorTruncarClContac = Math.trunc($ancho/16);


	
	//if($ancho>=1301)
	//{
		var DC1='<div class="col l4"><span class="sTexAbrir">';
		//var DC2='<div class="col l3"><span class="sTexAbrir">';
		var DC3='<div class="col l5"><span class="sTexAbrir">';
		//var DC4='<div class="col l3"><span class="sTexAbrir">';
		var DC5='<div class="col l2"><span class="sTexAbrir">';
		var DC6='<div class="col l1"><span class="sTexAbrir">';

		//Encabezados
		datos+=DRHead;//Row		
			datos+=DC1+"<strong>NO. COT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REFERENCIA</strong>"+s+E;
			//datos+=DC2+"<strong>REFERENCIA</strong>"+s+E;
			datos+=DC3+"<strong>CLIENTE & CONTACTO</strong>"+s+E;
			//datos+=DC4+"<strong>CONTACTO</strong>"+s+E;
			datos+=DC5+"<strong>TIPO</strong>"+s+E;
			datos+=DC6+"<strong>FECHA</strong>"+s+E;
		datos+=E;

	DRHead='<div onclick="" class="row rowAbrirHead">';
		
	//console.log(valores);
	try
	{
		valores = eval(valores);
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

			if(valores[i]['LPS']>0)
			{
				var tipoCotTxt = tipo+serie+" "+valores[i]['LPS']+" LPS";				
			}else
			{
				var tipoCotTxt = "MATERIAL";				
			}

			var ArrayFecha  = valores[i]['Fecha'].split("-");

			var strFecha = ArrayFecha[2]+"/"+ArrayFecha[1]+"/"+ArrayFecha[0];



			datos+='<div onclick="abrirCot('+valores[i]['IdCot']+','+valores[i]['PlantTipo']+')" class="row rowAbrir">';//Row	
				titleRef = " title='"+valores[i]['Ref']+"' ";
				datos+=DC1+valores[i]['IdCot']+"<span"+titleRef+" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+truncarCadena(valores[i]['Ref'].toUpperCase(),FactorTruncarRef)+s+s+E;
				//datos+=DC2+valores[i]['Ref'].toUpperCase()+s+E;
				datos+=DC3+truncarCadena(valores[i]['NomCl'].toUpperCase()+"&nbsp;&&nbsp;" +valores[i]['AtnCl'].toUpperCase(),FactorTruncarClContac)+s+E;
				//datos+=DC4+valores[i]['AtnCl'].toUpperCase()+s+E;
				datos+=DC5+tipoCotTxt+s+E;
				datos+=DC6+strFecha+s+E;			 
			datos+=E;//Cerramos el row
		}
	}
	catch(err) 
	{
    	datos+='<div class="row rowAbrir"><div class="col s12 m12 l12">No hay resultados por mostrar</div></div>';
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
			MostrarCotizacionesHtml(resp);		

		});
	}
}
function abrirCot(IdCotizacion,Tipo)
{
	verificarSession(true);
	$('#modalAbrirCot').closeModal();





	
	$("#divFondo").css("visibility", "hidden");
	$("#basicos").css("visibility","visible");
	$("#DivPlanta").css("visibility","visible");
	$("#divGraficaPTARIncluNoIncluEntrega").css("visibility","visible");

	var divsPartProp='<div id="divPartidasPTAR" class="col m12 l8 "></div>';
		divsPartProp+='<div id="divPropiedadesPTAR" class="col m12 l4 "></div>';
		$('#DivPlanta').html(divsPartProp);	

	    


	//  Cambiar datosbasicosplanta por datosbasicos
	//  Trear tambien los datos del electromecanico, como franco abordo, vigencia, etc.
	//  Traer sus partidas



	// Datos basicos planta, partiendo de ellos mostramos los demas datos de la planta o el materialñ
	$.ajax({
	url:'Controlador/ControladorDatosBasicosCot.php',
	type:'POST',
	async:false,
	data:'accion=TraerBasicos&IdCotizacion='+IdCotizacion
	}).done(function(resp){		
		jsonDatBasic = JSON.parse(resp);


		plantaTipo = parseInt(jsonDatBasic.PlantaTipo);
		$("#referencia").val(jsonDatBasic.Referencia); // Referencia
		

		// Estos dos datos son tomados de la tabla de la cotizacion y no de la tabla de clientes, esto para poner el contacto que se grabo en su momento.		
		$("#spanNomEmpresacliente").html(jsonDatBasic.NombreCl);


		// Este codigo arregla un problema donde las cotizaciones de material no tomaba el contacto de la tabla cotizaciones_indice si no de la tabla clientes_indice.
		if(jsonDatBasic.AtnCl != "")
		{$("#spanNomContactocliente").html(jsonDatBasic.AtnCl)}
		else
		{$("#spanNomContactocliente").html(jsonDatBasic.ContactoCatalogoClientes);statusCambios(1,true);} // Obligamos al usuario a guardar los cambios, 
			

		// Tomamos los tres contactos de este cliente para poder cambiarlos si el vendedor asi lo desea
		$.ajax({
		url:'Controlador/Controlador.php',
		type:'POST',
		async:true,
		data:'Accion=DatosCliente&IdCliente='+jsonDatBasic.IdCl
		}).done(function(respContac){
			jsonContac = JSON.parse(respContac);
			
			if(jsonContac.Contacto == "")
			{
				$('#pContacto1').css('visibility', 'hidden');
			}else
			{
				$('#pContacto1').css('visibility', 'visible');
				$("#labelContacto1").html(jsonContac.Contacto.toUpperCase());
			}

			if(jsonContac.Contacto2 == "")
			{
				$('#pContacto2').css('visibility', 'hidden');
			}else
			{
				$('#pContacto2').css('visibility', 'visible');
				$("#labelContacto2").html(jsonContac.Contacto2.toUpperCase());
			}
			
			if(jsonContac.Contacto3 == "")
			{
				$('#pContacto3').css('visibility', 'hidden');
			}else
			{
				$('#pContacto3').css('visibility', 'visible');
				$("#labelContacto3").html(jsonContac.Contacto2.toUpperCase());
			}


			
		});





		//SeleCliente(jsonDatBasic.IdCl); // esto es obsoleto



		//Lab,Vigencia,ConPago,Entrega
		$("#txtFrancoBordo").val(jsonDatBasic.Lab);
		$("#txtVigencia").val(jsonDatBasic.Vigencia);
		$("#txtCondiciones").val(jsonDatBasic.ConPago);

		// Todo esto es por compatibilidad con el sistema anterior donde se capturaba el tiempo de entrega de dos formas, aqui solo se usa una sola.
		var Entrega = "";
		if(jsonDatBasic.Entrega == "" && (jsonDatBasic.EntregaDias!="0" || jsonDatBasic.EntregaSemanas!="0"))
		{
			if(jsonDatBasic.EntregaSemanas!="0") // Semanas
			{
				if(jsonDatBasic.EntregaSemanas=="1"){Entrega+="UNA SEMANA ";}
				else{Entrega+= jsonDatBasic.EntregaSemanas+" SEMANAS ";	}									
			}
			if(jsonDatBasic.EntregaDias!="0") // Dias
			{
				Entrega+= jsonDatBasic.EntregaDias+" DÍAS ";
			}
			statusCambios(1,true); // Obligamos al usuario a guardar los cambios, 
		}else
		{
			Entrega+=jsonDatBasic.Entrega;
		}
		// Aqui acaba codigo de compatibilidad
		
		


		$("#txtEntrega").val(Entrega);		


		TipoCot = (jsonDatBasic.TipoCot);


		//planta','material
		
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
		


		if(TipoCot=='planta')
		{
			cambiarUtilidad(Utilidad,TipoUtilidad);
		}
		

		$('#hiddenIVA').val(IVA);

		if(TipoCot=='material')
		{
			$("#divStatusCot").html("<br>Editando Cotizaci&oacute;n "+IdCotizacion+" - Equipo y Material");
			// Establecemos que el tipo de cotizacion  es para material y equipo
			cambiarTipoCot(2,true);
			$("#divGraficaPTARIncluNoIncluEntrega").css({"display":"none"});
			$("#divInfoAdicionalMaterial").css({"display":"inherit"});
			$("#divInfoAdicionalMaterial").css({"margin-top":"-.8rem"});
			/*$("#divStatusCot").html("<br>Nueva cotización - Equipo y material");
			$("#txtVigencia").val("30 DIAS");
			$("#txtCondiciones").val("DE CONTADO");*/
			objPartMat.cabezaTablaHtmlVacia();



			$.ajax({
			url:'Controlador/Controlador_MatPartidas.php',
			type:'POST',
			data:'Accion=CrearPartidasDB&IdCotizacion='+IdCotizacion
			}).done(function(respPart){
				if(respPart=="ok")
				{
					objPartMat.ajaxMostrarPart(true);					
				}				
				statusCambios(0,true); // Cambiamos el status
				$.ajax({
					url:'Controlador/control.php',
					type:'POST',
					data:'Accion=cambiarEstado&Estado=Cambios'
				});		      				
			});


			// Si el tipo de moneda es 2 son dolares
			if(jsonDatBasic.Moneda==2)
			{
				$("#chkUSD").prop('checked',true);
			}else
			{
				$("#chkUSD").prop('checked',false);
			}

		}else
		{
			cambiarTipoCot(1,true);
		}



		// Si es planta de tratamiento hacemos todo esto
		if(TipoCot=='planta')
		{
			$("#divStatusCot").html("<br>Editando Cotizaci&oacute;n "+IdCotizacion+" - Planta de Tratamiento");

			$("#divGraficaPTARIncluNoIncluEntrega").css({"display":"initial"});

			// Partidas planta
			$.ajax({
			url:'Controlador/ControladorPlantaPartidas.php',
			type:'POST',
			data:'accion=TraerPartidasCot&IdCotizacion='+IdCotizacion
			}).done(function(respPart){	
				mostrarPartidasHtml(respPart);
				statusCambios(0,true); // Cambiamos el status
				$.ajax({
					url:'Controlador/control.php',
					type:'POST',
					data:'Accion=cambiarEstado&Estado=Cambios'
				});		      				
			});









			
			$("#DivPlanta").css("visibility", "visible");


			var divsPartProp='<div id="divPartidasPTAR" class="col m12 l8 "></div>';
			divsPartProp+='<div id="divPropiedadesPTAR" class="col m12 l4 "></div>';
			$('#DivPlanta').html(divsPartProp);	


		

			
			$.ajax({
				url:'Controlador/ControladorPlantaPropiedades.php',
				type:'POST',		
				data:'accion=TraerPropiedadesCot&IdCotizacion='+IdCotizacion
			}).done(function(propPTAR){
				mostrarPropiedadesHtml(propPTAR);
				statusCambios(0,true); // Cambiamos el status
				$.ajax({
						url:'Controlador/control.php',
						type:'POST',
						data:'Accion=cambiarEstado&Estado=Cambios'
				});		      				
			});		
		

		



			var divsGrafica = '<div class="row">';
			if(Tipo == 2)
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
			if(Tipo == 2) 
			{		
				$.ajax({
					url:'Controlador/ControladorPlantaGrafica.php',
					type:'POST',			
					data:'Accion=TraerGraficaCot&IdCotizacion='+IdCotizacion
				}).done(function(respGraf){
					mostrarGraficaHTML(respGraf);
					statusCambios(0,true); // Cambiamos el status
					$.ajax({
						url:'Controlador/control.php',
						type:'POST',
						data:'Accion=cambiarEstado&Estado=Cambios'
					});		      				
				});		
			}

			crearListaIncluNoincluEntrega(Tipo);

			// Incluye
			if(Tipo!=15)
			{
				$.ajax({
						url:'Controlador/ControladorPlantaIncluye.php',
						type:'POST',				
						data:'Accion=TraerIncluCot'+'&IdCotizacion='+IdCotizacion
						}).done(function(respIn){				
							if(respIn=="null")
							{
								//Incluye
								$.ajax({
								url:'Controlador/ControladorPlantaIncluye.php',
								type:'POST',						
								data:'Accion=Crear'+'&TipoPlanta='+Tipo
								}).done(function(resp){							
							      	mostrarIncluyeHTML(resp);
								});
							}
							else
							{					
							   	mostrarIncluyeHTML(respIn);
							}
							statusCambios(0,true); // Cambiamos el status
							$.ajax({
								url:'Controlador/control.php',
								type:'POST',
								data:'Accion=cambiarEstado&Estado=Cambios'
							});	
						});		
			}

			// NoIncluye
			$.ajax({
			url:'Controlador/ControladorPlantaNoIncluye.php',
			type:'POST',	
			data:'Accion=TraerNoIncluCot'+'&IdCotizacion='+IdCotizacion
			}).done(function(respNoIn){			
			if(respNoIn=="null")
				{			
					$.ajax({
					url:'Controlador/ControladorPlantaNoIncluye.php',
					type:'POST',			
					data:'Accion=Crear'+'&TipoPlanta='+Tipo
					}).done(function(resp){						
				      	mostrarNoIncluyeHTML(resp);					
					});
				}
				else
				{
					mostrarNoIncluyeHTML(respNoIn);					
				}	
				statusCambios(0,true); // Cambiamos el status
				$.ajax({
					url:'Controlador/control.php',
					type:'POST',
					data:'Accion=cambiarEstado&Estado=Cambios'
				});	

			});


			if(Tipo==2 ) //Entrega (Solo en obra civil)
			{						
				$.ajax({
				url:'Controlador/ControladorPlantaEntregar.php',
				type:'POST',		
				data:'Accion=TraerEntregaCot'+'&IdCotizacion='+IdCotizacion
				}).done(function(respEntrega){			
					if(respEntrega=="null")						
					{
						$.ajax({
						url:'Controlador/ControladorPlantaEntregar.php',
						type:'POST',				
						data:'Accion=Crear'+'&TipoPlanta='+Tipo
						}).done(function(resp){					
					      	mostrarEntregarHTML(resp);
					      	// Cambiamos el estado
							$.ajax({
								url:'Controlador/control.php',
								type:'POST',
								data:'Accion=cambiarEstado&Estado=Cambios'
							});	
						});		
					}
					else
					{				
						mostrarEntregarHTML(respEntrega);					
					}
					statusCambios(0,true);	      		      	
				});						
			}
		}






		//$("#chkUSD").prop('checked',true);






	});



	

	statusCambios(0,false); // Cambiamos el status
}
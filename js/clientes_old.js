
function enviarDatosCl(ClNombre,ClContacto,ClContacto2,ClContacto3,ClTel1,ClTel2,ClPais,ClEstado,ClCiudad,ClDireccion,ClRFC,ClCorreo,ClCP,Selecionar)
{
	if(validarCl(ClNombre,ClContacto,ClTel1,ClTel2,ClPais,ClEstado,ClCiudad,ClDireccion,ClCorreo))
	{
		var variables = "&ClNombre="+ClNombre;
		variables+="&ClContacto="+ClContacto;
		variables+="&ClContacto2="+ClContacto2;
		variables+="&ClContacto3="+ClContacto3;
		variables+="&ClTel1="+ClTel1;
		variables+="&ClTel2="+ClTel2;
		variables+="&ClPais="+ClPais;
		variables+="&ClEstado="+ClEstado;
		variables+="&ClCiudad="+ClCiudad;
		variables+="&ClDireccion="+ClDireccion;
		variables+="&ClRFC="+ClRFC;
		variables+="&ClCorreo="+ClCorreo;
		variables+="&ClCP="+ClCP;
		variables+="&Selec="+Selecionar;
		variables+="&IdClienteCambios="+$('#ihClienteCambios').val();

		if($('#statusFormCliente').val()=="Nuevo")
		{
			Accion="ClienteNuevo";
		}
		if($('#statusFormCliente').val()=="Cambios")
		{
			Accion="ClienteCambios";
		}

		$.ajax({
			url:'Controlador/Controlador.php',
			type:'POST',
			data: 'Accion='+Accion+variables
			}).done(function(resp){						
				if(resp>0)
				{
					if(Accion=="ClienteNuevo")
					{
						mensaje = "El cliente fue dado de alta";
						IdCliente = resp;
					}
				}
				if(resp=="cambio realizado")
				{
					mensaje = "Los datos fueron actualizados";
					IdCliente=$('#ihClienteCambios').val();
				}



				if(Selecionar==1)
				{
					Materialize.toast(mensaje, 2000,'',function(){$('#modalEditCliente').closeModal();SeleCliente(IdCliente);})	
				}
				else
				{
					Materialize.toast(mensaje, 2000,'',function(){$('#modalEditCliente').closeModal();})		
				}

			
			});
	}
}
function editCliente(IdCliente)
{

	$('#modalCliente').closeModal();
	$.ajax({
			url:'Controlador/Controlador.php',
			type:'POST',
			data: 'Accion=DatosCliente&IdCliente='+IdCliente
			}).done(function(resp){				
				var jsonCliente = JSON.parse(resp);

				$('#h5EditCliente').html("Modificar datos del cliente");
				$("#ClNombre").prop('disabled', true);
				$('#ClNombre').val(jsonCliente.Nombre);
				$('#ClContacto').val(jsonCliente.Contacto);
				$('#ClContacto2').val(jsonCliente.Contacto2);
				$('#ClContacto3').val(jsonCliente.Contacto3);
				$('#ClTel1').val(jsonCliente.Telefono1);
				$('#ClTel2').val(jsonCliente.Telefono2);
				$('#ClPais').val(jsonCliente.Pais);
				$('#ClEstado').val(jsonCliente.Estado);
				$('#ClCiudad').val(jsonCliente.Ciudad);
				$('#ClDireccion').val(jsonCliente.Calle);
				$('#ClRFC').val(jsonCliente.RFC);
				$('#ClCorreo').val(jsonCliente.Correo);
				$('#ClCP').val(jsonCliente.CP);
				$('#statusFormCliente').val("Cambios");
				$('#ihClienteCambios').val(IdCliente);
				$('#modalEditCliente').openModal();

			});

}
function validarCl(ClNombre,ClContacto,ClTel1,ClTel2,ClPais,ClEstado,ClCiudad,ClDireccion,ClCorreo)
{
	var error = false;
	var memsaje ="";
	var focus = "";
	if(ClNombre.length<3)	
	{
		memsaje = "Debe escribir el nombre del cliente ";
		error = true;
		focus = "ClNombre";
	}

	if(ClContacto.length<3 && !error)	
	{
		memsaje = "El primer contacto debe estar lleno";
		error = true;
		focus = "ClContacto";
	}
	if((ClTel1.length+ClTel2.length)<3  && !error)	
	{
		memsaje = "Debe escribir minimo un telefono ";
		error = true;
		focus = "ClTel1";
	}
	if(ClPais.length<2 && !error)	
	{
		memsaje = "Debe escribir el pais";
		error = true;
		focus = "ClPais";
	}
	if(ClEstado.length<2 && !error)	
	{
		memsaje = "Debe escribir el estado";
		error = true;
		focus = "ClEstado";
	}
	if(ClCiudad.length<3 && !error)	
	{
		memsaje = "Debe escribir la ciudad";
		error = true;
		focus = "ClCiudad";
	}
	if(ClDireccion.length<3 && !error)	
	{
		memsaje = "Debe escribir la direccion";
		error = true;
		focus = "ClDireccion";
	}
	if(ClCorreo.length<3 && !error)	
	{
		memsaje = "Debe escribir el correo";
		error = true;
		focus = "ClCorreo";
	}
	if(error)
	{
		Materialize.toast(memsaje, 2000,'',function(){$('#'+focus).focus()});
		return false;					
	}else{
		return true;					
	}
}
function MostrarClientes(valor){
	
	$.ajax({
		url:'Controlador/Controlador.php',
		type:'POST',
		data:'valorCliente='+valor	
	}).done(function(resp){		
		$('#lista_clientes').html(resp); 
	});
}


function SeleCliente(IdCliente){
$.ajax({
		url:'Controlador/Controlador.php',
		type:'POST',
		data:'IdClienteSelect='+IdCliente
	}).done(function(resp){
		valores = eval(resp);
		for(i=0;i<valores.length;i++)
		{			
			statusCambios(1,true);
			$('#spanNomEmpresacliente').html(valores[i]['Nombre']);
			$('#spanNomContactocliente').html(valores[i]['Contacto']);		
		}
		cerrarModal('modalCliente');		
	});
}
function selPTAR(paso,tipo,serie,lps,idPTAR,eptar,epret,ocptar,ocpret,fp,ls)
{

	verificarSession(true);
	if(paso==5)
	{			
		varsPost='idPTAR='+idPTAR;
		alert("Serie:"+serie);
		alert("Tipo antes:"+tipo);
		alert("Id:"+idPTAR);
		// Tipo 1=PK, serie 2  = urbana serie 1 = selector
		
		if(tipo==1 && serie == 1 && eval(lps)<=.25) // Selector
		{
			tipo=15;
		}

		if(tipo==1 && serie == 2 && eval(lps)<=.35) // Urbana
		{
			tipo=15;
		}
		alert("Tipo ahora:"+tipo);
	}else
	{
		varsPost='paso='+paso+'&tipo='+tipo+'&serie='+serie;
	}


	
	



	$.ajax({
		url:'Controlador/Controlador.php',
		type:'POST',		
		data: varsPost
	}).done(function(resp){
		var contS="Planta de tratamiento ";		
		if(paso>1)
		{			
				if(tipo==1)
				{
					contS+="Tipo PK ";
				}				
				if(tipo==2)
				{
					contS+="Tipo Obra Civl ";
				}				
				if(serie==1)
				{
					contS+="Serie selector ";
				}
				if(serie==2)
				{
					contS+="Serie urbana ";					
				}
				if(paso==4)
				{
					contS+=lps+" LPS.";
				}
		}

		var pasoSig=paso+1;

		/*Tipo de planta PK OC*/
		if(paso==1)
			{
				cont='<div class="input-field col s6 m6 l6">';		      	
				      	cont+='<div class="card-panel white point" onclick="selPTAR('+pasoSig+',1,0,0,0,0,0,0,0);">';
					      	 cont+='<div class="divImgTipoPTAR">';
					      		cont+='<img src="imagenes/pkPTAR.png" >';				      					      	
					     	 cont+='</div>';
						 	 cont+='<div class="pTipoPtar center-align grey-text text-darken-2">Tipo PK</div>';				      						      
			      		cont+='</div>';
			    cont+='</div>';
			    cont+='<div class="input-field col s6 m6 l6">';		      	
				      	cont+='<div class="card-panel white point" onclick="selPTAR('+pasoSig+',2,0,0,0,0,0,0,0);">';
					      	 cont+='<div class="divImgTipoPTAR">';
					      		cont+='<img src="imagenes/ocPTAR.png" >';				      					      	
					     	 cont+='</div>';
						 	 cont+='<div class="pTipoPtar center-align grey-text text-darken-2">Obra civil</div>';				      						      
			      		cont+='</div>';
			    cont+='</div>';
			}

			/*Serie de planta Urbana o Selector*/
			if(paso==2)
			{
				cont='<div class="input-field col s6 m6 l6">';		      	
				      	cont+='<div class="card-panel white point" onclick="selPTAR('+pasoSig+','+tipo+',2,0,0,0,0,0,0,0);">';
					      	 cont+='<div class="divImgTipoPTAR">';
					      		cont+='<img src="imagenes/urbana.png" >';				      					      	
					     	 cont+='</div>';
						 	 cont+='<div class="pTipoPtar center-align grey-text text-darken-2">Urbana</div>';				      						      
			      		cont+='</div>';
			    cont+='</div>';
			    cont+='<div class="input-field col s6 m6 l6">';		      	
				      	cont+='<div class="card-panel white point" onclick="selPTAR('+pasoSig+','+tipo+',1,0,0,0,0,0,0,0);">';
					      	 cont+='<div class="divImgTipoPTAR">';
					      		cont+='<img src="imagenes/selector.png" >';				      					      	
					     	 cont+='</div>';
						 	 cont+='<div class="pTipoPtar center-align grey-text text-darken-2">Selector</div>';				      						      
			      		cont+='</div>';
			    cont+='</div>';
			}
			if(paso==3)
			{
				cont="<br>";
				valores = eval(resp);
				for(i=0;i<valores.length;i++)
				{					
					var cap = valores[i]['Capacidad'].toString();

					var idPlanta = valores[i]['IdPlanta'].toString();

					cont+='<style>.divlps{margin:6px;margin-top:0;height:3em;text-align:center;padding:0;}.divlps:hover{background-color:#ff9800}';
					cont+='.divlps:hover{background-color:#00897b!important;}</style>';
					cont+='<div class="col s3 m2 l1 center-align teal lighten-1 center-align white-text text-darken-2 divlps valign-wrapper point" onclick="selPTAR('+pasoSig+','+tipo+','+serie+','+"'"+cap+"'"+','+idPlanta+',0,0,0,0,0,0);">'+cap+'</div>';
				}	
			}
			if(paso==4)
			{
				disabled="";
				checked="";

				checkedOC=""; // Para obra civil


				if(tipo==1)// SI ES PK
				{

					disabled="disabled";
				
				}else
				{
					checkedOC="checked";
					checked="checked";
				}

				cont="";
				cont+='<style>.lblPartida{text-align:center;margin-bottom:.5em;}';
				cont+='.divPartCot{margin-top:1em;}#divBotonFinalzar{margin-top:3em;}.divImgTipoPTAR img{cursor:auto}';				
				cont+='</style>';
				cont+='<div class="row">&nbsp;</div>';		

				cont+='<div class="row">';		
					cont+='<div class="col s12 m6 l6 divPartCot">';					
						cont+='<div class="left-align"><input type="checkbox" class="filled-in" value="ok" id="chkeptar"  checked><label for="chkeptar">Equip. Planta de tratamiento</label></div>';
					cont+='</div>';	

					cont+='<div class="col s12 m6 l6 divPartCot">';					
						cont+='<div class="left-align"><input type="checkbox" class="filled-in" value="ok" id="chkepret" checked><label for="chkepret">Equip. Pretratamiento</label></div>';
					cont+='</div>';		
				cont+='</div>';							


				cont+='<div class="row">';	
					cont+='<div class="col s12 m6 l6 divPartCot">';					
						cont+='<div class="left-align"><input type="checkbox" class="filled-in" value="ok" id="chkocptar" '+checked+' '+disabled+'><label for="chkocptar">Obra civil PTAR</label></div>';
					cont+='</div>';				
					cont+='<div class="col s12 m6 l6 divPartCot">';					
						cont+='<div class="left-align"><input type="checkbox" class="filled-in" value="ok" id="chkocpret" '+checked+' '+disabled+'><label for="chkocpret">Obra civil Pretratamiento</label></div>';
					cont+='</div>';	
				cont+='</div>';	

				cont+='<div class="row">';
					cont+='<div class="col s12 m6 l6 divPartCot">';					
						cont+='<div class="left-align"><input type="checkbox" class="filled-in" value="ok" id="chkfiltro" '+checkedOC+' '+disabled+'><label for="chkfiltro">Filtro prensa</label></div>';
					cont+='</div>';		
					cont+='<div class="col s12 m6 l6 divPartCot">';					
						cont+='<div class="left-align"><input type="checkbox" class="filled-in" value="ok" id="chklecho" '+checkedOC+' '+disabled+'><label for="chklecho">Lecho de sec.</label></div>';
					cont+='</div>';
				cont+='<div>';

				cont+='<div id="divBotonFinalzar" class="col s12 m12 l12 center-align">';

				
				// Boton finalizar
				cont+='<a class="waves-effect waves-light btn orange"';
				cont+='onclick="selPTAR('+pasoSig+','+tipo+','+serie+','+lps+','+idPTAR+',chkeptar.checked,chkepret.checked,chkocptar.checked,chkocpret.checked,chkfiltro.checked,chklecho.checked);">';
				cont+='Finzalizar</a></div>';
			}
			if(paso==5)
			{					
					var divsPartProp='<div id="divPartidasPTAR" class="col m12 l8 "></div>';
					divsPartProp+='<div id="divPropiedadesPTAR" class="col m12 l4 "></div>';
					$('#DivPlanta').html(divsPartProp);	


					var divsGrafica = '<div class="row">';
					if(tipo==2)
					{
						divsGrafica+='<div class="col s12 m12 l8" id="divGraficaPTAR">&nbsp;</div>';
				    	divsGrafica+='<div class="col s12 m12 l4" id="divIncluNoincluEntregaPTAR">&nbsp;</div>';
					}else{divsGrafica+='<div class="col s12 m12 l12" id="divIncluNoincluEntregaPTAR">&nbsp;</div>';}

					divsGrafica+='</div>';
					

					$("#divGraficaPTARIncluNoIncluEntrega").html(divsGrafica);





		
		


					// Partidas					
					$.ajax({
						url:'Controlador/ControladorPlantaPartidas.php',
						type:'POST',
						data:'accion=Crear&idPTAR='+idPTAR+"&eptar="+eptar+"&epret="+epret+"&ocptar="+ocptar+"&ocpret="+ocpret+"&fp="+fp+"&ls="+ls
					}).done(function(resp){						
						mostrarPartidasHtml(resp);						
						mostrarTotales();													
					});

					// Propiedades
					$.ajax({
						url:'Controlador/ControladorPlantaPropiedades.php',
						type:'POST',
						data:'accion=Crear&idPTAR='+idPTAR
					}).done(function(propPTAR){
						mostrarPropiedadesHtml(propPTAR);
					});

					
					// Solo obra civil lleva grafica
					if(tipo==2)
					{	
						// Grafica
						$.ajax({
						url:'Controlador/ControladorPlantaGrafica.php',
						type:'POST',
						data:'Accion=Crear'+'&IdPlanta='+idPTAR
						}).done(function(resp){							
							mostrarGraficaHTML(resp);						
						});
					}
					


					// Creamos los divs que contendran las listas de incluye / No incluye y entrega
					crearListaIncluNoincluEntrega(tipo);
					
					
					//Incluye todos menos las plantas caseras
					if(tipo!=15)
					{											
						$.ajax({
						url:'Controlador/ControladorPlantaIncluye.php',
						type:'POST',
						data:'Accion=Crear'+'&TipoPlanta='+tipo
						}).done(function(resp){						
					      	mostrarIncluyeHTML(resp);					
						});						
					}


					// No incluye
					$.ajax({
					url:'Controlador/ControladorPlantaNoIncluye.php',
					type:'POST',
					data:'Accion=Crear'+'&TipoPlanta='+tipo
					}).done(function(resp){						
				      	mostrarNoIncluyeHTML(resp);					
					});



					if(tipo==2) //Entregar
					{						
						$.ajax({
						url:'Controlador/ControladorPlantaEntregar.php',
						type:'POST',
						data:'Accion=Crear'+'&TipoPlanta='+tipo
						}).done(function(resp){						
					      	mostrarEntregarHTML(resp);					
						});						
					}


					cerrarModal('modalPTAR');	


				contS="";
				cont="";
				statusCambios(1,true);
			}
			
			$('#divSeleccionadoPTAR').html(contS);		
			$('#divSelPTAR').html(cont);					
	});
}


function delPart(indice)
{
	$.ajax({
	url:'Controlador/ControladorPlantaPartidas.php',
	type:'POST',
	data:'accion=Borrar&Indice='+indice
	}).done(function(resp){
			mostrarPartidasHtml(resp);
			
			mostrarTotales();
	});
}

function mostrarPartidasHtml(resp)
{

	valores = eval(resp);
	
	ContPTAR='<style>.sinPadMar{padding:0px!important;margin-top:0px;margin-bottom:.2em;}.sinMarSup{margin-top:0px!important;}';
	ContPTAR+='.altoPrimFil{height:2.5em!important;padding-top:.6em;margin-bottom:0px!important;}</style>';
	ContPTAR+='<div class="card blue darken-2 white-text">';	
		ContPTAR+='<div class="row blue darken-3 altoPrimFil">';
			ContPTAR+='<div class="col m6 l6"><strong>&nbsp;Descripci&oacute;n</strong></div>';
			ContPTAR+='<div class="col m2 l2 center-align"><strong> Cantidad</strong></div>';
			ContPTAR+='<div class="col m2 l2 right-align"><strong> Precio </strong></div>';
			ContPTAR+='<div class="col m2 l2 right-align"><strong>Total </strong></div>';
		ContPTAR+='</div>'
		ContPTAR+='<div class="card-content CardsPart sinMarSup">';
		


		// Utilidad
		jsonUtil = ajaxUtilidad();
		//console.log(jsonUtil);


		Util = jsonUtil.utilidad;		
		UtilTipo = jsonUtil.tipoUtilidad;


		if(json.utilidad==0){var UtilText="";}else{var UtilText=Util+" %";}

		

		// Utilidad
		subtotal = ajaxSubtotal();

		// Recorremos el json para saber la suma de las partidas del equipamiento
		equipSubtotal=0;
		for(i=0;i<valores.length;i++)
		{		
			if(valores[i].label=="empl")
			{
				
				equipSubtotal=equipSubtotal+(valores[i].CUnitario*valores[i].Cantidad);
			}
			if(valores[i].label=="empr")
			{
				
				equipSubtotal=equipSubtotal+(valores[i].CUnitario*valores[i].Cantidad);
			}
		}

		var factorUtilidad = 1+(Util/100); //Es la utilidad neta en fraccion (.5 : 50%)
		utilidadGral = subtotal * (Util/100); 


		var ce=0; // Contador elemento para estar a la par del array asosiativo php.
		for(c=0;c<valores.length;c++)
		{			
			ce=ce+1;
			var c2="'"+ce+"'";
			clickPart='onclick="delPart('+c2+')"';
			i='<i class="material-icons c_pointer iconPart" '+clickPart+' title="Eliminar partida">delete</i>';
			a='<a href="#modalEditPartida" onclick="mostrarPartida('+c2+');" class="modal-trigger PointNormal"><span class="textNormalBlanco">';

			partidaTotal = valores[c].CUnitario*valores[c].Cantidad;		

			
			if(UtilTipo==1)
			{
				if(valores[c].label=="empl" || valores[c].label=="empr")
				{
					var partidaTotal = partidaTotal+(partidaTotal/equipSubtotal)*utilidadGral;			
				}			
			}else
			{
				var partidaTotal = (factorUtilidad*partidaTotal);			
			}

			var partidaUnitario = (partidaTotal/valores[c].Cantidad);

			
		

			//ContPTAR+='SpanUtil{SpanFlatBtn:color}</style>';

			ContPTAR+='<div class="row sinPadMar">';
		 	
				ContPTAR+='<div class="col m6 l6 sinPadMar">'+i+a+valores[c].Descripcion+'</span></a>'+'</div>';
				ContPTAR+='<div class="col m2 l2 sinPadMar center-align">'+valores[c].Cantidad+'</div>';
				/*ContPTAR+='<div class="col m2 l2 sinPadMar right-align">'+miles(parseInt(partidaUnitario)).toFixed()+'</div>';
				ContPTAR+='<div class="col m2 l2 sinPadMar right-align">'+miles(parseInt(partidaTotal)).toFixed()+'</div>';
				*/
				ContPTAR+='<div class="col m2 l2 sinPadMar right-align">'+miles2(parseInt(partidaUnitario).toFixed())+'</div>';
				ContPTAR+='<div class="col m2 l2 sinPadMar right-align">'+miles2(parseInt(partidaTotal).toFixed())+'</div>';
				
			ContPTAR+='</div>';
				
		}

		// botones al final de las partidas y el subtotal
		ContPTAR+='<div class="row sinPadMar">&nbsp;</div>';
		ContPTAR+='<div class="row sinPadMar">';
			ContPTAR+='<div class="col m8 l8 sinPadMar">';
				
		    	ContPTAR+='<a href="#modalEditPartida" class="modal-trigger btn-floating waves-effect waves-light blue darken-4" onclick="mostrarPartida(0)"><i class="material-icons">add</i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		    	
		    																														  
		    	ContPTAR+='<a href="#modalPTAR"  onclick="selPTAR(1,0,0,0)" class="modal-trigger waves-effect waves-light btn blue darken-4">';
		    	ContPTAR+='<i class="material-icons left white-text">compare_arrows</i><span class="spanBoton">Cambiar planta</span></a>&nbsp;&nbsp;&nbsp;';
				
		    	
				ContPTAR+='<a href="#modalDato" id="aUtilidad" onclick="abrirModalDato('+"'"+'utilidad'+"'"+','+"'"+'Porcentaje de utilidad'+"'"+','+"'"+Util+"'"+','+UtilTipo+')" class="modal-trigger waves-effect waves-light btn blue darken-4">';
				ContPTAR+='<i class="material-icons left white-text">library_books</i><span class="spanBoton">Utilidad '+UtilText+'</span></a>';


			ContPTAR+='</div>';
			ContPTAR+='<div class="col m2 l2 sinPadMar right-align">SUBTOTAL</div>';
			ContPTAR+='<div id="divSubtotal" class="col m2 l2 sinPadMar right-align">$ 000</div>';
		ContPTAR+='</div>';

		// IVA
		if(document.getElementById('hiddenIVA')){		
			var IVA=document.getElementById('hiddenIVA').value;
		}else{var IVA=16;}
		
		ContPTAR+="<style>#divLabelIVA{text-decoration:none!important;color:white;}</style>";


		


		ContPTAR+='<div class="row subirIVA sinPadMar">';
		ContPTAR+='<input id="hiddenIVA" type="hidden" name="opcion" value="'+IVA+'">';
			
			ContPTAR+='<a href="#modalDato" class="modal-trigger" onclick="abrirModalDato('+"'"+'IVA'+"'"+','+"'"+'Porcentaje de IVA'+"'"+',hiddenIVA.value,0)">';
			ContPTAR+='<div  id="divLabelIVA" class="col m2 l2 offset-m8 offset-l8 sinPadMar divTotales1 Pointer right-align">';
				
				ContPTAR+='IVA '+IVA+'%';
			ContPTAR+='</div></a>';
			ContPTAR+='<div id="divIVA" class="col m2 l2 divTotales2 right-align sinPadMar">$ 0.00</div>';
		ContPTAR+='</div>';

		


			
		// TOTAL
		ContPTAR+='<div class="row sinPadMar">';
			ContPTAR+='<div id="divNotaIlustrativa1" class="col m8 l8 sinPadMar left-align">';
			ContPTAR+='</div>';

			ContPTAR+='<div class="col m2 l2 divTotales1 right-align sinPadMar">TOTAL</div>';
			ContPTAR+='<div id="divTotal" class="col m2 l2 divTotales2 right-align sinPadMar">$ 0.00</div>';
		ContPTAR+='</div>';
		ContPTAR+='<div class="row sinPadMar">';
			ContPTAR+='<div id="divNotaIlustrativa2" class="col s12 m12 l12 sinPadMar left-align">';
			ContPTAR+='</div>';
		ContPTAR+='</div>';


	ContPTAR+='</div>';
	ContPTAR+='</div>';
	

	ContPTAR+='<script>';
	ContPTAR+='$(document).ready(function(){';

 	ContPTAR+="$('.modal-trigger').leanModal();";
	ContPTAR+='});'; 
	ContPTAR+='</script>';   



	$('#divPartidasPTAR').html(ContPTAR);	

	// Traemos el tipo de planta
	$.ajax({
		url:'Controlador/control.php',
		type:'POST',		
		data:'Accion=mostrarPropiedadPTAR&Propiedad=3'
		}).done(function(resp){			
			if(parseInt(resp)==2) // Si es obra civil
			{				
				INotalustrativa1 = '<input type="checkbox" class="filled-in rellenoCheck" onclick="cambiarEstadoIlustrativa(this.checked,true)" id="chkIlustrativa" ><label for="chkIlustrativa" class="white-text">Obra civil solo ilustrativa</label>';
				$("#divNotaIlustrativa1").html(INotalustrativa1);

				checkIlustrativa = "";
				$.ajax({url:'Controlador/control.php',type:'POST',async: true,data:'Accion=mostrarEstadoIlustrativa'}).done(function(respI){
					
					if(parseInt(respI)==1)
					{
						$("#chkIlustrativa").attr('checked',true)
					}else
					{
						$("#chkIlustrativa").attr('checked',false)
					}
				}) 


			}else
			{
				INotalustrativa1 = "Pretratamiento del equipamiento como:";
				INotalustrativa2 ='<input name="rdNotaPartida" class="rellenoRadio with-gap" onclick="cambiarEstadoNotaPartida(0,true)" type="radio" id="RdNota" value="0" />';
      			INotalustrativa2+='<label for="RdNota" class="white-text">Nota</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
      			INotalustrativa2+='<input name="rdNotaPartida" class="rellenoRadio with-gap" onclick="cambiarEstadoNotaPartida(1,true)" type="radio" id="RdPartida" value="1" />';
      			INotalustrativa2+='<label for="RdPartida" class="white-text">Partida</label>';	 


				$("#divNotaIlustrativa2").html(INotalustrativa2);
				checkedNota="";
				checkedPartida="";		
				$.ajax({
					url:'Controlador/control.php',
					type:'POST',				
					async: true,
					data:'Accion=mostrarEstadoNotaPartida'
				}).done(function(resp){					
					if(parseInt(resp)==1)
					{
						$("#RdPartida").attr("checked",true);								
					}else
					{
						$("#RdNota").attr("checked",true);
					}
				});				
			}
			$("#divNotaIlustrativa1").html(INotalustrativa1);								
		});



}
function abrirModalDato(id,label,valor,valor2)
{

	var h5="<h5>"+label+"</h5>";
	$('#divh5ModalDato').html(h5);		
	document.getElementById('textModalDato').value=valor;

	datosExtra="";
	if(id=='utilidad')
	{
		var checked = "";
		if(valor2==1)		
		{
			var checked = "checked";
		}
		var click='onclick="cambiarUtilidad(textModalDato.value,checkUtilEquip.checked)"';
		datosExtra+='<div class="col s16 m14 l12">';
  		datosExtra+='<input type="checkbox" class="filled-in" id="checkUtilEquip" '+checked+'/>';
  		datosExtra+='<label for="checkUtilEquip">Aplicar solo al equipamiento</label>';
  		datosExtra+='</div>';
	}

	if(id=='IVA')
	{
		var click='onclick="cambiarIVA(textModalDato.value)"';
	}

	var content='<a href="#!" '+click+' class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>';
	content+='<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>';

	$('#divFooterModalDato').html(content);
	$('#divExtraModalDato').html(datosExtra);
	statusCambios(1,true);	
}

function cambiarIVA(IVA)
{
	document.getElementById('hiddenIVA').value=IVA;	
	$('#divLabelIVA').html('IVA '+IVA+'%');
	mostrarTotales();
}
function ajaxSubtotal()
{
	$.ajax({
		url:'Controlador/ControladorPlantaPartidas.php',
		type:'POST',
		async: false,		
		data:'accion=Totalizar'
		}).done(function(resp){		
			subtotal = parseInt(resp);
		});
		return subtotal;
}
function mostrarTotales()
{
	if(document.getElementById('hiddenIVA'))
	{var IVA = document.getElementById('hiddenIVA').value;}else
	{var IVA = 16;}

	subtotal = ajaxSubtotal();	
	jsonUtil = ajaxUtilidad();
	
	var utilidad = jsonUtil.utilidad;		
	var subtotal=subtotal*(1+(utilidad/100));
	var total = subtotal*(1+(IVA/100));

	$('#divSubtotal').html("$ "+miles2(parseInt(subtotal).toFixed()));//miles2(parseInt(partidaTotal).toFixed())	//
	$('#divIVA').html("$ "+miles2(parseInt(subtotal*IVA/100).toFixed()))	;//miles2(parseInt(partidaTotal).toFixed())	
	$('#divTotal').html("$ "+miles2(parseInt(total).toFixed()));//miles2(parseInt(partidaTotal).toFixed())


		

}
function ajaxAreaRequerida()
{

	// 		
	$.ajax({
	url:'Controlador/AreaRequerida.php',
	type:'POST',	
	async: false,
	data:'accion=Calcular'
	}).done(function(resp){
		resultado = resp;

		
	});	
	return resultado;
}
function aceptarDatoPropPlanta(idspam,dato)
{

	//idspam es el nombre del campo con el prefijo prop
	//dato: es el valor que se establecio



	var valor = dato;

	var campo = idspam.substr(4, );
	// Actualizamos la variable de session
	$.ajax({
		url:'Controlador/ControladorPlantaPropiedades.php',
		type:'POST',
		data:'accion=CambiarDato'+'&campo='+campo+"&valor="+valor
	}).done(function(resp){
		mostrarPropiedadesHtml(resp);		
	});

	



	$('#hi'+idspam).val(dato); // Campo oculto
	$("#span"+idspam).html(dato);	// Spam a cambiar 
}
function cambiarDatoPlanta(dato,lbl,obj)
{	

	
	
	var lbl = '<h5>'+lbl+'</h5>';



	
	


	document.getElementById('hiModalDatoPropPlanta').value=obj;	
	document.getElementById('textModalDatoPlanta').value=dato;	
	$('#divh5ModalPropPlanta').html(lbl);	
	
}



function mostrarPropiedadesHtml(propPTAR)
{
	var json = JSON.parse(propPTAR);
	function crearPropiedadPTAR(s,m,l,disabled,idObj,label,dato)
	{		
		var campoculto = "";
		var DisabledFormat= "";
		if(disabled=="disabled")	
		{
			FormatSpam="spanDatoPlantaDis";
		}else
		{
			FormatSpam="white-text spanDatoPlanta";

			var lblClick="'"+label+"'";
			var textIdObj = "'"+idObj+"'";

			var click='cambiarDatoPlanta(hi'+idObj+'.value,'+lblClick+','+"'"+idObj+"'"+')';
			var href='modalPropPlanta';
			var trigger = 'modal-trigger';
			$('#hiModalDatoPropPlanta').val(idObj);
			campoculto = '<input id="hi'+idObj+'" type="hidden" value="'+dato+'">';
		}





		datos='<div class="row sinPadMar">';
			datos+='<style>.spanDatoPlanta:hover{color:#0A3260!important}.spanDatoPlantaDis{color:#aaaaaa}</style>';
			datos+='<div class="col l7">'+label+'</div>';			
			datos+='<div class="col l5">'+campoculto;
			datos+='<a href="#'+href+'" onclick="'+click+'" class="spanDatoPlanta '+trigger+'" ><span id="span'+idObj+'" class="'+FormatSpam+'">'+dato+'</span></a></div>';		
		datos+='</div>'; //Este div es del ROW modalPropPlanta

		datos+='<script>';
		datos+='$(document).ready(function(){';

 		datos+="$('.modal-trigger').leanModal();";
		datos+='});'; 
		datos+='</script>';    

		return datos;
	}

	



	var AreaPlanta = (json.LargoPlanta*json.AnchoPlanta);
	var AreaPlanta = AreaPlanta.toFixed(2);

	var AreaCarcamo = (json.LargoCarcamo*json.AnchoCarcamo);
	var AreaCarcamo = AreaCarcamo.toFixed(2);

	
	//var AreaTotalReq = ;

	var jsonArearReq  = JSON.parse(ajaxAreaRequerida());


	var LargoCarcamo=json.LargoCarcamo;
	var AnchoCarcamo=json.AnchoCarcamo;
	var AltoCarcamo=json.AltoCarcamo;
	var Lechosm2=json.Lechosm2;
	var disabledCarcamo = "";

	if(jsonArearReq.Carcamo==false)
	{
		LargoCarcamo="N/A";
		AnchoCarcamo="N/A";
		AltoCarcamo="N/A";
		disabledCarcamo = "disabled";
		AreaCarcamo="N/A";
	}


	var disabledLecho = "";
	if(jsonArearReq.Lecho==false)
	{		
		Lechosm2="N/A";
		disabledLecho = "disabled";		
	}

	/*var AreaTotalReq = (json.LargoPlanta*json.AnchoPlanta)+(json.LargoCarcamo*json.AnchoCarcamo)+(json.Lechosm2*1);
	var AreaTotalReq = parseFloat(AreaTotalReq).toFixed(2);*/

	contProp = "<div class='textoCuadro1 headGrid'>&nbsp;</div>";

	datos = "";	
	if(json.IdTipo==2)
	{
		datos = crearPropiedadPTAR("s6","m3","l12","disabled","PropSerie","Serie",json.DescModelo);
		datos+= crearPropiedadPTAR("s6","m3","l12","","PropCapacidad","Gasto (LPS)",json.Capacidad);
		datos+= crearPropiedadPTAR("s6","m3","l12","","PropHPPlanta","Potencia Instalada (HP&#8216;S)",json.HPPlanta);
		datos+= crearPropiedadPTAR("s6","m3","l12","","PropBHPPlanta","Potencia Utilizada (BHP&#8216;S)",json.BHPPlanta);
		datos+= crearPropiedadPTAR("s6","m3","l12","","PropLargoPlanta","Largo Planta (m)",json.LargoPlanta);
		datos+= crearPropiedadPTAR("s6","m3","l12","","PropAnchoPlanta","Ancho Planta (m)",json.AnchoPlanta);
		datos+= crearPropiedadPTAR("s6","m3","l12","disabled","PropAreaPlanta","Area planta (m2)",AreaPlanta);
		datos+= crearPropiedadPTAR("s6","m3","l12","","PropAltoPlanta","Alto planta (m)",json.AltoPlanta);
		datos+= crearPropiedadPTAR("s6","m3","l12",disabledCarcamo,"PropLargoCarcamo","Largo carcamo (m)",LargoCarcamo);
		datos+= crearPropiedadPTAR("s6","m3","l12",disabledCarcamo,"PropAnchoCarcamo","Ancho carcamo (m)",AnchoCarcamo);
		datos+= crearPropiedadPTAR("s6","m3","l12",disabledCarcamo,"PropAltoCarcamo","Profundidad del carcamo (m)",AltoCarcamo);
		datos+= crearPropiedadPTAR("s6","m3","l12","disabled","PropAreaCarcamo","Area carcamo (m2)",AreaCarcamo);
		datos+= crearPropiedadPTAR("s6","m3","l12",disabledLecho,"PropAreaLodos","Area lecho lodos (m2)",Lechosm2);
		datos+= crearPropiedadPTAR("s6","m3","l12","disabled","PropAreaTotal","Area total (m2)",jsonArearReq.AreaRequerida);
		datos+= crearPropiedadPTAR("s6","m3","l12","","PropLodosSecos","Lodos al mes (m3)",json.LodosSecos);
	}else
	{
		datos = crearPropiedadPTAR("s6","m3","l12","disabled","PropSerie","Serie",json.DescModelo);
		datos+= crearPropiedadPTAR("s6","m3","l12","","PropCapacidad","Gasto (LPS)",json.Capacidad);
	
		datos+= crearPropiedadPTAR("s6","m3","l12","","PropHPPlanta","Potencia Instalada (HP&#8216;S)",json.HPPlanta);
		datos+= crearPropiedadPTAR("s6","m3","l12","","PropBHPPlanta","Potencia Utilizada (BHP&#8216;S)",json.BHPPlanta);
		datos+= crearPropiedadPTAR("s6","m3","l12","","PropDiametroPlanta","Diametro",json.DiametroPlanta);	
		datos+= crearPropiedadPTAR("s6","m3","l12","","PropAltoPlanta","Alto planta (m)",json.AltoPlanta);
		datos+= crearPropiedadPTAR("s6","m3","l12",disabledCarcamo,"PropLargoCarcamo","Largo carcamo (m)",LargoCarcamo);
		datos+= crearPropiedadPTAR("s6","m3","l12",disabledCarcamo,"PropAnchoCarcamo","Ancho carcamo (m)",AnchoCarcamo);		
		datos+= crearPropiedadPTAR("s6","m3","l12",disabledCarcamo,"PropAltoCarcamo","Profundidad del carcamo (m)",AltoCarcamo);
		
		datos+= crearPropiedadPTAR("s6","m3","l12","disabled","PropAreaCarcamo","Area carcamo (m2)",AreaCarcamo);
		//datos+= crearPropiedadPTAR("s6","m3","l12","disabled","PropAreaLodos","Area lecho lodos (m2)",json.Lechosm2);

		datos+= crearPropiedadPTAR("s6","m3","l12","disabled","PropAreaTotal","Area total (m2)",jsonArearReq.AreaRequerida);
		datos+= crearPropiedadPTAR("s6","m3","l12","","PropLodosSecos","Lodos al mes (m3)",json.LodosSecos);
	}
	

	


	var StrTipoPl = "";
	if(json.IdTipo!=2)
	{
		StrTipoPl="PK";
	}



	contProp='<div class="card blue darken-2 white-text">';
		contProp+='<div class="row blue darken-3 altoPrimFil">';
			contProp+='<div class="col m12 l12"><strong>&nbsp;Propiedades PTAR '+json.DescModelo+' '+StrTipoPl+' Modelo '+json.ModeloLPS+'</strong></div>';				
		contProp+='</div>'			
		contProp+='<div class="card-content CardsPart">';
			contProp+='<div class="row">'+datos+'</div>';
		contProp+='</div>';
	contProp+='</div>';	

	//contProp+='<div class="col m12 l4">'+datos+'</div>';

	$('#divPropiedadesPTAR').html(contProp);

	

}
function mostrarPartida(Indice)
{	
	if(Indice>0)
	{

		$.ajax({
		url:'Controlador/ControladorPlantaPartidas.php',
		type:'POST',
		data:'accion=MostrarP&Indice='+Indice
		}).done(function(partida){	
			var json = JSON.parse(partida);
		
			document.getElementById('tareaDescrip').value=json.Descripcion;		
			document.getElementById('inputCant').value=json.Cantidad;
			document.getElementById('inputCosto').value=json.CUnitario;
			document.getElementById('tareaInfoAdicional').value=json.InfoAdicional;	
			document.getElementById('hiPartida').value=Indice;
			$('#h5EditPartida').html('Modificar partida');	
						
			//Campo oculto id de la partida//
		});
	}else
	{
			document.getElementById('tareaDescrip').value="";		
			document.getElementById('inputCant').value=1;
			document.getElementById('inputCosto').value="";
			document.getElementById('tareaInfoAdicional').value="";	
			document.getElementById('hiPartida').value="";
			$('#h5EditPartida').html('Agregar partida');
			//	
	}
	
}
function AddCambiarPartida(Descrip,Cant,Costo,InfoAdicional,Partida)
{	

	var acc="Agregar";
	if(Partida>0){var acc="Cambiar";}
	

	$.ajax({
		url:'Controlador/ControladorPlantaPartidas.php',
		type:'POST',
		data:'accion='+acc+'&Descrip='+Descrip+'&Cant='+Cant+'&Costo='+Costo+'&InfoAdicional='+InfoAdicional+'&Indice='+Partida
		}).done(function(resp){	
			mostrarPartidasHtml(resp);
			var IVA = document.getElementById('hiddenIVA').value;
			mostrarTotales();
		});
}

objPartMat = new PartidasMaterial();
objIVA = new IVAMat();

function IVAMat()
{
	this.editar = function(asincrono)
	{
		$('#modalIVAMat').openModal();	
		$.ajax({
			url:'Controlador/Controlador_MatPartidas.php',
			type:'POST',
			async:asincrono,			
			data:'Accion=ObtenerIVA'
		}).done(function(resp){
			$("#textModalIVAMat").val(eval(resp));		
		})
	}
	this.cambiar = function(valor,asincrono)
	{
		$('#modalIVAMat').openModal();	
		$.ajax({
			url:'Controlador/Controlador_MatPartidas.php',
			type:'POST',
			async:asincrono,			
			data:'Accion=CambiarIVA&valorIVA='+valor
		}).done(function(resp){
			$("#divIvaMat").html("IVA "+resp+"%");		
			objPartMat.totalesPartidas(true);
			statusCambios(1,true);
		})
	}
}


function adaptarMaterial()
{

	// Establecemos que el tipo de cotizacion  es para material y equipo
	cambiarTipoCot(2,true);
	$("#divGraficaPTARIncluNoIncluEntrega").css({"display":"none"});
	$("#divInfoAdicionalMaterial").css({"display":"inherit"});
	$("#divInfoAdicionalMaterial").css({"margin-top":"-.8rem"});
	$("#divStatusCot").html("<br>Nueva cotización - Equipo y material");
	$("#txtVigencia").val("30 DIAS");
	$("#txtCondiciones").val("DE CONTADO");
	objPartMat.cabezaTablaHtmlVacia();



}
function EditPartidaMat(valor)
{
	if(valor==0)
	{
		$('#tituloEditPartidas').html("Agregar partida");
	}

	if(valor==1)
	{
		$('#tituloEditPartidas').html("Modificar partida");
	}	
}
function PartidasMaterial()
{

	this.totalesPartidas = function(asincrono)
	{
		$.ajax({
			url:'Controlador/Controlador_MatPartidas.php',
			type:'POST',
			async:asincrono,			
			data:'Accion=TotalesPartidas'
		}).done(function(resp){			
			json = JSON.parse(resp);
			$("#divSubtotalMatPart").html(json.subtotal);
			$("#divIVAMatPart").html(json.IVA);
			$("#divTotalMatPart").html(json.total);
		})


	}

	this.limpiarCamposAddPartMat = function()
	{
		$("#EtareaDescrip").val("");
		$("#EinputCant").val("");
		$("#EinputCosto").val("");
		$("#EtareaInfoAdicional").val("");
		var spanAcep='<a href="#!" class="modal-action waves-effect waves-green btn-flat"';
		 	spanAcep+='onclick="objPartMat.ajaxAddPart(EtareaDescrip.value,EinputCant.value,selUnidad.value,EinputCosto.value,';
		 	spanAcep+='EtareaInfoAdicional.value,EhiPartida.value,true)">Aceptar</a>';
			$("#spanModalAcepPartMat").html(spanAcep);			

		objPartMat.ajaxUnidades(true,"PZA");
	}

	this.divPartidasMat = '<div id="divPartidasMat" class="col m12 l12 "></div>';
	
	this.cabezaTablaHtmlVacia = function()
	{
		datos='<div class="card blue darken-2 white-text">';	
			datos+='<div class="row blue darken-3 altoPrimFil">';
				datos+='<div class="col m6 l6"><strong>&nbsp;Descripci&oacute;n</strong></div>';
				datos+='<div class="col m2 l1 center-align"><strong> Cantidad</strong></div>';
				datos+='<div class="col m2 l1 center-align"><strong> Unidad</strong></div>';
				datos+='<div class="col m2 l2 right-align"><strong> Precio </strong></div>';
				datos+='<div class="col m2 l2 right-align"><strong>Total </strong></div>';
			datos+='</div>';
			datos+='<div id="divContPartidasMat">';
		datos+='</div>';

			// Para agregar partidas
		datos+='<div class="card-content CardsPart sinMarSup">';
			datos+='<a href="#modalEditPartidaMaterial" onclick="objPartMat.limpiarCamposAddPartMat()" title="Agregar partida"';
			datos+='class="modal-trigger btn-floating waves-effect pulse waves-light blue darken-4"';
			datos+=' onclick="EditPartidaMat(0)">';
			datos+='<i class="material-icons">add</i></a>&nbsp;';
		datos+='</div>';

		// Totales
			

			datos+='<style>#divIvaMat{cursor:pointer;}</style>';
			datos+='<div class="row altoPrimFil">';				
				datos+='<div class="col m2 l2 offset-l8 right-align"><strong>SUBTOTAL</strong></div>';
				datos+='<div id="divSubtotalMatPart" class="col m2 l2 right-align"><strong>$ 0.00</strong></div>';
			datos+='</div>';
			datos+='<div class="row altoPrimFil">';				
				datos+='<div onclick="objIVA.editar(true)" id="divIvaMat" class="col m2 l2 offset-l8 right-align" title="Cambiar porcentaje de IVA"><strong>IVA 16%</strong></div>';
				datos+='<div id="divIVAMatPart" class="col m2 l2 right-align"><strong>$ 0.00</strong></div>';
			datos+='</div>';
			datos+='<div class="row altoPrimFil">';				
				datos+='<div class="col m2 l2 offset-l8 right-align"><strong>TOTAL</strong></div>';
				datos+='<div id="divTotalMatPart" class="col m2 l2 right-align"><strong>$ 0.00</strong></div>';
			datos+='</div>'
			datos+='<div class="row altoPrimFil">';
				var clickUSD=' oncheck(alert(this.value))';			
				datos+='<div class="col m4 l4 offset-l8 right-align"><input onclick="cambiarUSD(this.checked,true)" id="chkUSD" type="checkbox" '+clickUSD+' class="rellenoCheck filled-in" />';
      			datos+='<label for="chkUSD" class="white-text">Precios en USD</label></div>';				
			datos+='</div>';
			datos+='<div class="row altoPrimFil">';					
				datos+='<div class="col m4 l4 offset-l8 right-align">&nbsp;</div>';				
			datos+='</div>';

		



			
		$('#DivPlanta').html(this.divPartidasMat);	
		$('#divPartidasMat').html(datos);

		$('.CardsPart').css('min-height', '1.3rem');
		
		recargarModals();
	}
	this.ajaxMostrarPart = function(asincrono)
	{
	
		$.ajax({
			url:'Controlador/Controlador_MatPartidas.php',
			type:'POST',
			async:asincrono,			
			data:'Accion=MostrarPartidas'
		}).done(function(resp){
			var utilidad = 1;

			json = JSON.parse(resp);

			
			datos = "";
			for(i in json)
			{
				var totalPartida = (json[i].Cantidad*json[i].Costo)*utilidad;
				var cantidad = json[i].Cantidad;
				var unidad = json[i].Unidad;
				var costo = json[i].Costo;




				datos+='<style>#divDescMat{cursor:pointer;}</style>';

				datos+='<div class="row altoPrimFil">';
					var clickPart='onclick="objPartMat.ajaxDelPart('+i+',true)"';
					var tit = 'title="Click para editar la partida"';
					var del = '<i class="material-icons c_pointer iconPart" '+clickPart+' title="Eliminar partida">delete</i>';
					var edit = '<span onclick="objPartMat.ajaxEditPart('+i+',true)">'+json[i].Descripcion+'</span>';

					datos+='<div id="divDescMat" class="col m6 l6" '+tit+' >&nbsp;'+del+edit+'</div>';



					datos+='<div class="col m2 l1 right-align"> '+miles2(cantidad)+'</div>';

					/*datos+='<div class="col m2 l1 center-align"> '+json[i].Cantidad+'</div>';*/
					datos+='<div class="col m2 l1 center-align"> '+unidad+'</div>';



					//datos+='<div class="col m2 l1 center-align"> '+miles2(parseInt(json[i].Cantidad).toFixed())+'</div>';
					//datos+='<div class="col m2 l1 center-align"> '+miles2(parseInt(json[i].Unidad).toFixed())+'</div>';


					datos+='<div class="col m2 l2 right-align"> '+miles2(parseInt(costo).toFixed())+'</div>';
					datos+='<div class="col m2 l2 right-align">$ '+miles2(parseInt(totalPartida).toFixed())+'</div>';
				datos+='</div>';
			}

			$("#divContPartidasMat").html(datos);
			objPartMat.totalesPartidas(true);
		});		
	}
	

	
	
	this.validarPartida = function(Descrip,Cant,Costo)
	{
		var msg='';
		if(Descrip==''){msg="Falto la descripci&oacute;n";}
		if(Costo==''){msg="Falto el costo";}
		if(Cant==''){msg="Falto la cantidad";}

		return(msg);
	}
	this.ajaxCambiarPart = function(Descrip,Cant,Unidad,Costo,InfoAdicional,IdPartida,asincrono)
	{
		statusCambios(1,true);		
		var msg = this.validarPartida(Descrip,Cant,Costo);
		if(msg!='')
		{
			Materialize.toast(msg,3000,'')							
		}else
		{
			$('#modalEditPartidaMaterial').closeModal();
			$.ajax({
				url:'Controlador/Controlador_MatPartidas.php',
				type:'POST',
				async:asincrono,			
				data:'Accion=CambiarPartida&Descripcion='+Descrip+'&Cantidad='+Cant+'&Unidad='+Unidad+'&Costo='+Costo+'&InfoAdicional='+InfoAdicional+"&IdPartida="+IdPartida
			}).done(function(resp){								
				objPartMat.ajaxMostrarPart(true);
			});		
		}
	}
	this.ajaxAddPart = function(Descrip,Cant,Unidad,Costo,InfoAdicional,Partida,asincrono)
	{
		statusCambios(1,true);
		var msg = this.validarPartida(Descrip,Cant,Costo);
		if(msg!='')
		{
			Materialize.toast(msg,3000,'')							
		}else
		{		
			$('#modalEditPartidaMaterial').closeModal();
			$.ajax({
				url:'Controlador/Controlador_MatPartidas.php',
				type:'POST',
				async:asincrono,			
				data:'Accion=AddPart&Descripcion='+Descrip+'&Cantidad='+Cant+'&Unidad='+Unidad+'&Costo='+Costo+'&InfoAdicional='+InfoAdicional
			}).done(function(resp){				
				var json = JSON.parse(resp);
				if(json.estado==0)
				{				
					objPartMat.ajaxMostrarPart(true);
				}
			});			
		}
	}
	
	this.ajaxDelPart = function(indexPartida,asincrono)
	{
		statusCambios(1,true);
		$.ajax({
				url:'Controlador/Controlador_MatPartidas.php',
				type:'POST',
				async:asincrono,			
				data:'Accion=DelPart&IdPartida='+indexPartida
			}).done(function(resp){	
				if(eval(resp)>0)
				{
					objPartMat.ajaxMostrarPart(true);					
				}else
				{
					$("#divContPartidasMat").html("");
				}				
			});						
	}
	this.ajaxEditPart = function(indexPartida,asincrono)
	{

		$.ajax({
			url:'Controlador/Controlador_MatPartidas.php',
			type:'POST',
			async:asincrono,			
			data:'Accion=MostrarPartida&IdPartida='+indexPartida
		}).done(function(resp){			
			json = JSON.parse(resp);
			objPartMat.ajaxUnidades(true,json.Unidad);
			$("#EtareaDescrip").val(json.Descripcion);
			$("#EinputCant").val(json.Cantidad);			
			$("#EinputCosto").val(json.Costo);
			$("#EtareaInfoAdicional").val(json.Adicional);
			
			$("#EhiPartida").val(indexPartida); // Este campo oculto guarda el valor de la partida que se esta cambiando
			$('#modalEditPartidaMaterial').openModal();	



			

			var spanAcep='<a href="#!" class="modal-action waves-effect waves-green btn-flat"';
			 	spanAcep+='onclick="objPartMat.ajaxCambiarPart(EtareaDescrip.value,EinputCant.value,selUnidad.value,EinputCosto.value,';
			 	spanAcep+='EtareaInfoAdicional.value,EhiPartida.value,true)">Aceptar</a>';
				$("#spanModalAcepPartMat").html(spanAcep);

			
		});	
	}
	this.ajaxUnidades = function(asincrono,selected)
	{				
		$.ajax({
			url:'Controlador/Controlador_MatPartidas.php',
			type:'POST',
			async:asincrono,			
			data:'Accion=MostrarUnidades'
		}).done(function(resp){

			var resp = eval(resp);			
			var datos = '<label for="selUnidad">Unidad</label>';			
			datos+= '<select id="selUnidad">';
			for(i in resp)
			{
				//alert(resp[i]['unidad']+": "+selected);
				var id = resp[i]['IdUnidad'];
				var unidad = resp[i]['unidad'];
				if(resp[i]['unidad']==selected)
				{
					
					datos+='<option value="'+unidad+'" selected>'+unidad+'</option>'
				}
				else
				{
					datos+='<option value="'+unidad+'" >'+unidad+'</option>'
				}				
			}
      		datos+= '</select>';
      		
			$("#divUnidades").html(datos);
			// Al cambiar el select tenemos que ejecutar este script para regenerar
			$(document).ready(function(){
    			$('select').material_select();
 			 });

			
		});
	}
}



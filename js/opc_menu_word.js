function word()
{
	verificarSession(true);


	
	$.ajax({
		url:'Controlador/control.php',
		type:'POST',		
		data:'Accion=mostrarEstado'
	}).done(function(status){
		if(status!="Cerrar") // Si el status es diferente a cerrar enconces continuamos si no no hacemos nada de plano
		{			
			$.ajax({
			url:'Controlador/control.php',
			type:'POST',		
			data:'Accion=mostrarStatus'
			}).done(function(estado){				
				if(parseInt(estado)==0 && status=="Nuevo") // Si No hay cambios y la cotizacion esta nueva
				{
					Materialize.toast("La cotizaci&oacute;n est&aacute; vacia",4000,'',function(){$('.button-collapse').sideNav('hide')})					
				}
				if(parseInt(estado)==1) // Si hay cambios
				{
					// Preguntamos si desea guardar los cambios mediante el modal
					htmlGuardarWord = '<a href="#!" onclick="guardar('+"'Word'"+')" class="modal-action modal-close waves-effect waves-green btn-flat">Guardar</a>';
					$('#divaGuardarAntesAccion').html(htmlGuardarWord);

					htmlContinuarWord = '';
					$('#divaCotinuarAntesAccion').html(htmlContinuarWord);

					$('#modalCambios').openModal();
				}

				if(parseInt(estado)==0 && status=="Cambios") // Si No hay cambios y la cotizacion esta nueva
				{ // En este estado solamente se puede mandar directamente a la rutina de Word
					var $input = $('#birthdate').pickadate();
					var picker = $input.pickadate('picker');
					var Fecha  = picker.get('highlight', 'yyyy/mm/dd');	
					var IdVend = $("#selVenderor").val();	
					var Ref = $("#referencia").val();	
					var IVA = $("#hiddenIVA").val();

				

					var LAB =  $("#txtFrancoBordo").val();
					var Vigencia = $("#txtVigencia").val();
					var Condiciones = $("#txtCondiciones").val();
					var Entrega = $("#txtEntrega").val();

					//var ClAtn = $("#spanNomContactocliente").html();


					var ClAtn = $("#spanNomContactocliente").html().replace("&nbsp;"," ");	
	
					ClAtn = ClAtn.replace("&nbsp;"," ");	
					ClAtn = ClAtn.replace("&nbsp;"," ");	
					ClAtn = ClAtn.replace("&nbsp;"," ");	
					ClAtn = ClAtn.replace("&nbsp;"," ");
					ClAtn = ClAtn.replace("&nbsp;"," ");	
					ClAtn = ClAtn.replace("&nbsp;"," ");	
					ClAtn = ClAtn.replace("&nbsp;"," ");	
					ClAtn = ClAtn.replace("&nbsp;"," ");	
					ClAtn = ClAtn.replace("&nbsp;"," ");		
					ClAtn = ClAtn.replace("&nbsp;"," ");	
					ClAtn = ClAtn.replace("&nbsp;"," ");	
					ClAtn = ClAtn.replace("&nbsp;"," ");	
					ClAtn = ClAtn.replace("&nbsp;"," ");
					



					VarsMat = "&LAB="+LAB+"&Vigencia="+Vigencia+"&Condiciones="+Condiciones+"&Entrega="+Entrega; 		
					
					window.location.href="word.php?Fecha="+Fecha+"&IdVend="+IdVend+"&Ref="+Ref+"&ClAtn="+ClAtn+VarsMat;	
					Materialize.toast("Se genero Documento", 4000,'',function(){$('.button-collapse').sideNav('hide')})							
				}
			});
		}else
		{
			Materialize.toast("Es necesario abrir una cotización o crear una nueva",4000,'',function(){$('.button-collapse').sideNav('hide')})
		}
	});
}
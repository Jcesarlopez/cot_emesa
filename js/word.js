function word()
{


	// Fecha
	var $input = $('#birthdate').pickadate();
	var picker = $input.pickadate('picker');
	var Fecha  = picker.get('highlight', 'yyyy/mm/dd');	
	var IdVend = $("#selVenderor").val();	
	var Ref = $("#referencia").val();
	var IVA = $("#hiddenIVA").val();


	$.ajax({
	url:'word.php',
	type:'POST',
	data:'Accion=Guardar&IVA='+IVA+"&Fecha="+Fecha+"&Ref="+Ref+"&IdVend="+IdVend
	}).done(function(resp){				
		Materialize.toast(resp, 4000,'',function(){$('.button-collapse').sideNav('hide')})
	});


}
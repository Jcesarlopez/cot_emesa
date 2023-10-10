
function crearGrafica(idplanta)
{
		$.ajax({
		url:'Controlador/ControladorPlantaGrafica.php',
		type:'POST',
		data:'Accion=Crear'+'&IdPlanta='+idplanta
		}).done(function(resp){	
			valores = eval(resp);			
		});
}
function mostrarGraficaHTML(resp)
{

	function recortarConcepto(concepto)
	{

			var anchoPantalla = window.innerWidth;			
			var carMax = (anchoPantalla * 0.0197);			

			if(carMax<concepto.length)
			{
				concepto = concepto.substring(0,carMax)+"...";
			}
			return concepto;
	}		
	var json = JSON.parse(resp);	
		


	    Graf='<div class="card blue darken-2 white-text">';
	    Graf+='<div class="card-content CardsGrafInNoEn">';
	    
	    Graf+='<div class="row">';//Row2
		    Graf+='<div class="col s7 m4 l6 left-align">Conceptos</div>'; //Encabezado	
		    Graf+='<div class="col s12 m5 l6 left-align">Gr&aacute;fica (Quincenas)</div>';//Encabezado		    
	    Graf+='</div>'; // Row2

		    
			var filas = Object.keys(json).length;


			Graf+='<style>.sinMaPa{margin:0!important;padding:0!important;}.bordeInf{border-bottom:1px solid #999}';
			Graf+='.divFilaGraf{display:inline;border:2px solid #1976d2;border-left:0px;}';
			Graf+='.dp{border-left:1px solid #1976d2;}'; // Primera celda
			Graf+='.marFilGra{margin-top:.6em;}'; // Margen fila grafica
			Graf+='.db{background-color:#1565c0;color:#1565c0;width:3em!important;}#aMasPartGraf{transform:translateY(10px);}';
			Graf+='.dg{background-color:#0d47a1;color:#0d47a1;width:3em!important;}';
			Graf+='</style>';	

			for(i=0;i < filas;i++)
			{



				var click='editConceptoGraf('+json[i].orden+')';
				var clickDel = 'borrarPartGraf('+json[i].orden+')';
				var clickUp = 'upPartGraf('+json[i].orden+')';
				var clickDown = 'downPartGraf('+json[i].orden+')';
				
				if(i==0)
				{
					clickUp = "";					
				}

				if(i==filas-1)
				{
					clickDown="";
				}
				

				Graf+='<div class="row sinMaPa">';
					// Controles y concepto
					Graf+='<div class="col s12 m12 l6 left-align sinMaPa">';
						Graf+='<i class="Small material-icons iconPart c_pointer" onclick="'+clickUp+'" title="Subir nivel">keyboard_arrow_up</i>';
						Graf+='<i class="Small material-icons iconPart c_pointer" onclick="'+clickDown+'" title="Bajar nivel">keyboard_arrow_down</i>';
						Graf+='<i class="Small material-icons iconPart c_pointer" onclick="'+clickDel+'" title="Eliminar concepto">delete</i>';			
						Graf+='<a href="#modalCpncepGrafica" class="textNormalBlanco modal-trigger" onclick="'+click+'">'+recortarConcepto(json[i].concepto)+'</a>';
					Graf+='</div>';
					// Controles numericos para las semanas
					Graf+='<div class="col s12 m12 l6 left-align marFilGra">';
						for(c=1;c<=18;c++)
						{					
							var primera="";
							if(c==1){primera = "dp";}

							var inicio = parseInt(json[i].inicio);
							var duracion = parseInt(json[i].duracion);
							
							var color = "db";
							var final = inicio+duracion-1;
							
							if((c>=inicio) && (c<=final)){var color = "dg";}					
							Graf+='<div class="'+color+' '+primera+' divFilaGraf">&nbsp;aa</div>';
						}				
					Graf+='</div>';		
				Graf+='</div>';
			}
		    // Fila para mostrar el boton para agregar partida
			Graf+='<div class="row sinMaPa">';			
				Graf+='<div class="col s12 m12 l12 left-align sinMaPa">';
					Graf+='<a href="#modalCpncepGrafica" id="aMasPartGraf" class="modal-trigger btn-floating waves-effect waves-light blue darken-4" onclick="editConceptoGraf(0)"><i class="material-icons">add</i></a>';
				Graf+='</div>'; // card-content				
			Graf+='</div>'; // card-content
	    Graf+='</div>'; // card-content
	    Graf+='</div>'; // card	

	    Graf+='<script>';
		Graf+='$(document).ready(function(){';

 		Graf+="$('.modal-trigger').leanModal();";
		Graf+='});'; 
		Graf+='</script>';    


	$('#divGraficaPTAR').html(Graf);
}
function editConceptoGraf(Orden)
{

	// Si orden es igual a cero quiere decir que vamos a agregar una partida

	Orden = parseInt(Orden);
	
	if(Orden==0)	
	{
		document.getElementById('h5TitleModalGraf').innerHTML="Agregar concepto";	
	}else
	{
		document.getElementById('h5TitleModalGraf').innerHTML="Editar concepto";	
	}
	
	


	if(Orden>0)	
	{
		//Mostrar datos grafica
		$.ajax({
		url:'Controlador/ControladorPlantaGrafica.php',
		type:'POST',
		data:'Accion=Mostrar'+'&Orden='+Orden
		}).done(function(resp){

			var json = JSON.parse(resp);
			

			document.getElementById('txtConcepGraf').value=json.concepto;
			document.getElementById('txtInicioGraf').value=json.inicio;
			document.getElementById('txtDuracionGraf').value=json.duracion;
			document.getElementById('hidOrdenGraf').value=json.orden; //Campo oculto que indica el orden que usamos como clave para relacionar al array
			


		});
	}else 
	{
		document.getElementById('txtConcepGraf').value="";
		document.getElementById('txtInicioGraf').value="";
		document.getElementById('txtDuracionGraf').value="";
		document.getElementById('hidOrdenGraf').value=""; //Campo oculto que indica el orden que usamos como clave para relacionar al array	
	}

	statusCambios(1,true);

}
function cambiarConcepGraf(Concepto,Inicio,Duracion,Orden)
{

	if(Orden==0)
	{
		var Accion = "Agregar";
	}else
	{
		var Accion = "Cambiar";
	}

	//Mostrar datos grafica	
	$.ajax({
	url:'Controlador/ControladorPlantaGrafica.php',
	type:'POST',
	data:'Accion='+Accion+'&Concepto='+Concepto+'&Inicio='+Inicio+'&Duracion='+Duracion+'&Orden='+Orden
	}).done(function(resp){		
		mostrarGraficaHTML(resp);
	});
	

}
function borrarPartGraf(Orden)
{

	$.ajax({
	url:'Controlador/ControladorPlantaGrafica.php',
	type:'POST',
	data:'Accion=Borrar'+'&Orden='+Orden
	}).done(function(resp){		
		mostrarGraficaHTML(resp);
	});


}
function downPartGraf(Orden)
{
	$.ajax({
	url:'Controlador/ControladorPlantaGrafica.php',
	type:'POST',
	data:'Accion=Down'+'&Orden='+Orden
	}).done(function(resp){		
		mostrarGraficaHTML(resp);
	});

}
function upPartGraf(Orden)
{

	$.ajax({
	url:'Controlador/ControladorPlantaGrafica.php',
	type:'POST',
	data:'Accion=Up'+'&Orden='+Orden
	}).done(function(resp){		
		mostrarGraficaHTML(resp);
	});

}
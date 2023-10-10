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
			$('#p_nom_cliente').html(valores[i]['Nombre']);
			$('#p_contac_cliente').html(valores[i]['Contacto']);		
		}
		cerrarModal('modalCliente');		
	});
}



function selPTAR(paso,tipo,serie,lps,idPTAR,eptar,epret,ocptar,ocpret,fp,ls)
{
	if(paso==5)
	{
		varsPost='idPTAR='+idPTAR;
	}else
	{
		varsPost='paso='+paso+'&tipo='+tipo+'&serie='+serie;
	}
	/*data:'paso='+paso+'&tipo='+tipo+'&serie='+serie*/

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
				cont='<div class="input-field col s12 m6 l6">';		      	
				      	cont+='<div class="card-panel white point" onclick="selPTAR('+pasoSig+',1,0,0,0,0,0,0,0);">';
					      	 cont+='<div class="divImgTipoPTAR">';
					      		cont+='<img src="imagenes/pkPTAR.png" >';				      					      	
					     	 cont+='</div>';
						 	 cont+='<div class="pTipoPtar center-align grey-text text-darken-2">Tipo PK</div>';				      						      
			      		cont+='</div>';
			    cont+='</div>';
			    cont+='<div class="input-field col s12 m6 l6">';		      	
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
				cont='<div class="input-field col s12 m6 l6">';		      	
				      	cont+='<div class="card-panel white point" onclick="selPTAR('+pasoSig+','+tipo+',2,0,0,0,0,0,0,0);">';
					      	 cont+='<div class="divImgTipoPTAR">';
					      		cont+='<img src="imagenes/urbana.png" >';				      					      	
					     	 cont+='</div>';
						 	 cont+='<div class="pTipoPtar center-align grey-text text-darken-2">Urbana</div>';				      						      
			      		cont+='</div>';
			    cont+='</div>';
			    cont+='<div class="input-field col s12 m6 l6">';		      	
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

					/*cont+='<div class="input-field col s12 m1 l1" onclick="selPTAR('+pasoSig+','+tipo+',1,0);>'+valores[i]['Capacidad']+'aa</div>';*/
					/*cont+='<div class="input-field col s6 m2 l2 center-align" onclick="selPTAR('+pasoSig+','+tipo+',1,0);"><div class="card-panel white point teal lighten-1 center-align white-text text-darken-2">'+cap+'</div></div>';*/

					cont+='<style>.divlps{margin:6px;margin-top:0;height:3em;text-align:center;padding:0;}.divlps:hover{background-color:#ff9800}</style>';
					cont+='<div class="col s4 m2 l1 center-align teal lighten-1 center-align white-text text-darken-2 divlps valign-wrapper point" onclick="selPTAR('+pasoSig+','+tipo+','+serie+','+cap+','+idPlanta+',0,0,0,0,0,0);">'+cap+'</div>';
				}	
			}
			if(paso==4)
			{

				disabled="";
				checked="";
				if(tipo==1)
				{
					disabled="disabled";
				
				}else
				{
					checked="checked";
				}

				cont="";
				cont+='<style>.lblPartida{text-align:center;margin-bottom:.5em;}';
				cont+='.divPartCot{margin-top:1em;margin-bottom:1em;}#divBotonFinalzar{margin-top:3em;}.divImgTipoPTAR img{cursor:auto}</style>';
				



				cont+='<div class="col s6 m4 l3 divPartCot">';
					cont+='<div class="divImgTipoPTAR"><img src="imagenes/ePTAR.png"></div>';
					cont+='<div class="lblPartida">Equip. PTAR</div>';
					cont+='<div class="switch center-align"><label>Si<input value="ok" id="chkeptar" type="checkbox" checked><span class="lever"></span>No</label></div>';
				cont+='</div>';	


				cont+='<div class="col s6 m4 l3 divPartCot">';
					cont+='<div class="divImgTipoPTAR"><img src="imagenes/ePTAR.png"></div>';
					cont+='<div class="lblPartida">Equip. Pretratamiento</div>';
					cont+='<div class="switch center-align"><label>Si<input value="ok" id="chkepret" type="checkbox" checked><span class="lever"></span>No</label></div>';
				cont+='</div>';		

				cont+='<div class="col s6 m4 l3 divPartCot">';
					cont+='<div class="divImgTipoPTAR"><img src="imagenes/ocPTAR2.png"></div>';
					cont+='<div class="lblPartida">Obra civil PTAR</div>';
					cont+='<div class="switch center-align"><label>Si<input value="ok" id="chkocptar" type="checkbox" '+checked+' '+disabled+'><span class="lever"></span>No</label></div>';
				cont+='</div>';		
				cont+='<div class="col s6 m4 l3 divPartCot">';
					cont+='<div class="divImgTipoPTAR"><img src="imagenes/ocPTAR2.png"></div>';
					cont+='<div class="lblPartida">Obra civil Pretratamiento</div>';
					cont+='<div class="switch center-align"><label>Si<input value="ok" id="chkocpret" type="checkbox" '+checked+' '+disabled+'><span class="lever"></span>No</label></div>';
				cont+='</div>';		

				cont+='<div class="col s6 m4 l3 offset-l3 divPartCot">';
					cont+='<div class="divImgTipoPTAR"><img src="imagenes/filtroBanda.png"></div>';
					cont+='<div class="lblPartida">Filtro prensa</div>';
					cont+='<div class="switch center-align"><label>Si<input value="ok" id="chkfiltro" type="checkbox" '+disabled+'><span class="lever"></span>No</label></div>';
				cont+='</div>';		
				cont+='<div class="col s6 m4 l3 divPartCot">';
					cont+='<div class="divImgTipoPTAR"><img src="imagenes/lecho.png"></div>';
					cont+='<div class="lblPartida">Lecho de sec.</div>';
					cont+='<div class="switch center-align"><label>Si<input value="ok" id="chklecho" type="checkbox" '+disabled+'><span class="lever"></span>No</label></div>';
				cont+='</div>';

				cont+='<div id="divBotonFinalzar" class="col s12 m12 l12 center-align">';

				/*Aqui generamos el boton finalizar que envia los valores de lo seleccionado atravez de 
				  del asistente y el valor de los checkboxes que indica las partidas de la planta de tratamiento
				  que usuario seleciono */

				

				cont+='<a class="waves-effect waves-light btn orange"';
				cont+='onclick="selPTAR('+pasoSig+','+tipo+','+serie+','+lps+','+idPTAR+',chkeptar.checked,chkepret.checked,chkocptar.checked,chkocpret.checked,chkfiltro.checked,chklecho.checked);">';
				cont+='Finzalizar</a></div>';
			}


			if(paso==5)
			{

					//idPTAR,eptar,epret,ocptar,ocpret,fp,ls
					$.ajax({
						url:'Controlador/ControladorPlantaPartidas.php',
						type:'POST',
						data:'accion=Crear&idPTAR='+idPTAR+"&eptar="+eptar+"&epret="+epret+"&ocptar="+ocptar+"&ocpret="+ocpret+"&fp="+fp+"&ls="+ls
					}).done(function(resp){

						mostrarPartidasHtml(resp);
					});

					

					

				//$('#divPartidasPTAR').html(contPart+contParam);
				contS="";
				cont="";
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
	});
}
function mostrarPartidasHtml(resp)
{
	valores = eval(resp);					
	
	contPart="";
    divDesc='<div class="col s6 m6 l6 left-align">';
    divCant='<div class="col s2 m2 l2 center-align">';
    divPrec='<div class="col s2 m2 l2 right-align">';
    divTot='<div class="col s2 m2 l2 right-align">';

    divend="</div>";
    contPart+="<style>.headColums{font-size:20px;color:white; height:2.5em;padding-top:.4em !important;}.headGrid{height:2em;}";
    contPart+=".rowPartidas{height:3.5em !important;margin-top:.2em; margin-bottom:.2em;padding-top:.2em !important;padding-bottom:0 !important;}";
    contPart+=".iconDel{transform:translate(0px,5px);color:#009688;cursor:pointer;}";
    contPart+=".iconDel:hover{color:#ff9800}";
    contPart+=".PointNormal{cursor:default}";
    contPart+=".rowPartidas:hover{background-color:#eeeeee;}</style>";
    contPart+="<div class='textoCuadro1 headGrid'>Partidas Planta de Tratamiento</div>";
	contPart+='<div class="colorRecuadro card-reveal center"><div class="row">';
	contPart+='<div class="col s6 m6 l6 teal lighten-1 left-align textoCuadro1 headColums">'+"Descripci&oacute;n"+divend;
	contPart+='<div class="col s2 m2 l2 teal lighten-1 center-align textoCuadro1 headColums">'+"Cantidad"+divend;
	contPart+='<div class="col s2 m2 l2 teal lighten-1 right-align textoCuadro1 headColums">'+"Precio"+divend;
	contPart+='<div class="col s2 m2 l2 teal lighten-1 right-align textoCuadro1 headColums">'+"Total"+divend;							
	contPart+=divend;
	
	var ce=0; // Contador elemento para estar a la par del array asosiativo php.
	for(c=0;c<valores.length;c++)
	{
		ce=ce+1;
		var c2="'"+ce+"'";
		clickPart='onclick="delPart('+c2+')"';
		i='<i class="material-icons iconDel" '+clickPart+' title="Eliminar partida">delete</i>';
		a='<a href="#modalEditPartida" onclick="mostrarPartida('+c2+');" class="modal-trigger PointNormal">';
		

		//class="modal-trigger PointNormal"
		contPart+='<div class="row rowPartidas">';
			contPart+=divDesc+i+a+valores[c].Descripcion+'</a>'+divend;
			contPart+=divCant+valores[c].Cantidad+divend;
			contPart+=divPrec+"$ "+miles(valores[c].CUnitario)+" "+divend;
			contPart+=divTot+"$ "+miles(valores[c].Total)+" "+divend;
		contPart+='</div></a>';
	}
	contPart+='<script>';
	contPart+='$(document).ready(function(){';

 	contPart+="$('.modal-trigger').leanModal();";
	contPart+='});'; 
	contPart+='</script>';         

	cerrarModal('modalPTAR');
	$('#divPartidasPTAR').html(contPart);	
}
function mostrarPartida(Indice)
{	
	$.ajax({
		url:'Controlador/ControladorPlantaPartidas.php',
		type:'POST',
		data:'accion=MostrarP&Indice='+Indice
		}).done(function(partida){	
			var json = JSON.parse(partida);
			console.log(json);
			document.getElementById('tareaDescrip').value=json.Descripcion;		
			document.getElementById('inputCant').value=json.Cantidad;
			document.getElementById('inputCosto').value=json.CUnitario;
			document.getElementById('tareaInfoAdicional').value=json.InfoAdicional;	
			document.getElementById('hiPartida').value=Indice;	
						
			//Campo oculto id de la partida//
		});
}
function cambiarPartida(Descrip,Cant,Costo,InfoAdicional,Partida)
{
	$.ajax({
		url:'Controlador/ControladorPlantaPartidas.php',
		type:'POST',
		data:'accion=Cambiar&Descrip='+Descrip+'&Cant='+Cant+'&Costo='+Costo+'&InfoAdicional='+InfoAdicional+'&Indice='+Partida
		}).done(function(resp){	
			mostrarPartidasHtml(resp);
		});
}
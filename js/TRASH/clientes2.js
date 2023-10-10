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
					cerrarModal('modalPTAR');				
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
					
					/*textoCuadro1 headColums
					textoCuadro1 headColums
					textoCuadro1 headColums
					textoCuadro1 headColums*/
					
					contPart+=divend

				for(i=0;i<valores.length;i++)
				{	

					/*en el ultimo de los casos truncamos los dos ultimos caracteres de la cadena que son los ceros*/
					var PTAREquip = Number(valores[i]['PlantaEquipo']).toFixed();
					var PTARObra = valores[i]['PlantaObra'];
					var Filtro = valores[i]['CostoFiltro'];
					var Lecho = valores[i]['CostoLecho'];
					var CarEquip = valores[i]['EquipoCarcamo'];
					var CarObra = valores[i]['ObraCarcamo'];					

					

					part=0;
					if(eptar==true)
					{
						part++;
						clickPart='onclick="delPart('+part+')"';
						i='<i class="material-icons iconDel" '+clickPart+' title="Eliminar partida">delete</i>';
						a='<a href="#modalPartidaSelAccion PointNormal" class="modal-trigger">';

						contPart+='<div class="row rowPartidas">';
							contPart+=divDesc+i+a+"Planta de Tratamiento Serie Selector"+'</a>'+divend;
							contPart+=divCant+"1"+divend;
							contPart+=divPrec+"$ "+miles(PTAREquip)+" "+divend;
							contPart+=divTot+"$ "+miles(PTAREquip)+" "+divend;
						contPart+='</div></a>';
					}
					if(epret==true)
					{
						part=part+1;
						clickPar='onclick="delPart('+part+')"';
						i='<i class="material-icons iconDel" '+clickPart+' title="Eliminar partida">delete</i>';
						a='<a href="#modalPartidaSelAccion PointNormal" class="modal-trigger">';


						contPart+='<div class="row rowPartidas">';
							contPart+=divDesc+i+a+"Equipamiento para el pretratamiento de la planta"+'</a>'+divend;
							contPart+=divCant+"1"+divend;
							contPart+=divPrec+"$ "+miles(CarEquip)+" "+divend;							
							contPart+=divTot+"$ "+miles(CarEquip)+" "+divend;							
						contPart+='</div></a>';	
					}
					if(ocptar==true)
					{
						part++;
						clickPar='onclick="delPart('+part+')"';
						i='<i class="material-icons iconDel" '+clickPart+' title="Eliminar partida">delete</i>';
						a='<a href="#modalPartidaSelAccion PointNormal" class="modal-trigger">';


						contPart+='<div class="row rowPartidas">';
							contPart+=divDesc+i+a+"Obra Civil Planta de tratamiento"+'</a>'+divend;
							contPart+=divCant+"1"+divend;
							contPart+=divPrec+"$ "+miles(PTARObra)+" "+divend;
							contPart+=divTot+"$ "+miles(PTARObra)+" "+divend;
						contPart+='</div></a>';							
					}
					if(ocpret==true)
					{
						part++;
						clickPar='onclick="delPart('+part+')"';
						i='<i class="material-icons iconDel" '+clickPart+' title="Eliminar partida">delete</i>';
						a='<a href="#modalPartidaSelAccion PointNormal" class="modal-trigger">';


						contPart+='<div class="row rowPartidas">';
							contPart+=divDesc+i+a+"Obra Civil Pretratamiento"+'</a>'+divend;
							contPart+=divCant+"1"+divend;
							contPart+=divPrec+"$ "+miles(CarObra)+" "+divend;														
							contPart+=divTot+"$ "+miles(CarObra)+" "+divend;							
						contPart+='</div></a>';													
					}

					if(fp==true)
					{
						part++;
						clickPar='onclick="delPart('+part+')"';
						i='<i class="material-icons iconDel" '+clickPart+' title="Eliminar partida">delete</i>';
						a='<a href="#modalPartidaSelAccion PointNormal" class="modal-trigger">';


						contPart+='<div class="row rowPartidas">';
							contPart+=divDesc+i+a+"Filtro prensa"+'</a>'+divend;
							contPart+=divCant+"1"+divend;
							contPart+=divPrec+"$ "+miles(Filtro)+" "+divend;
							contPart+=divTot+"$ "+miles(Filtro)+" "+divend;
						contPart+='</div></a>';							
					}
					if(ls==true)
					{
						part++;
						clickPar='onclick="delPart('+part+')"';
						i='<i class="material-icons iconDel" '+clickPart+' title="Eliminar partida">delete</i>';
						a='<a href="#modalPartidaSelAccion PointNormal" class="modal-trigger">';


						contPart+='<div class="row rowPartidas">';
							contPart+=divDesc+i+a+"Lecho de secado de lodos"+'</a>'+divend;
							contPart+=divCant+"1"+divend;
							contPart+=divPrec+"$ "+miles(Lecho)+" "+divend;
							contPart+=divTot+"$ "+miles(Lecho)+" "+divend;
						contPart+='</div></a>';							
					}

					 contPart+='<div id="modalPartidaSelAccion" class="modal">';
					 	contPart+='<div class="col s12 m3 l3">';
					 		contPart+='<a href="#modalPTAR" id="tbnCliente" onclick="selPTAR(1,0,0,0)" class="waves-effect waves-light btn modal-trigger z-depth-0">Modificar</a>';
				    	contPart+='</div>';
				    	contPart+='<div class="col s12 m3 l3">';
					 		contPart+='<a href="#modalPTAR" id="tbnCliente" onclick="selPTAR(1,0,0,0)" class="waves-effect waves-light btn modal-trigger z-depth-0">Eliminar</a>';
				    	contPart+='</div>';
				    	contPart+='<div class="col s12 m3 l3">';
					 		contPart+='<a href="#modalPTAR" id="tbnCliente" onclick="selPTAR(1,0,0,0)" class="waves-effect waves-light btn modal-trigger z-depth-0">Editar</a>';
				    	contPart+='</div>';
				 	contPart+='</div>';

				 	contPart+='<script>';
			 		 contPart+='$(document).ready(function(){';

			   	 	contPart+="$('.modal-trigger').leanModal();";
			  		contPart+='});'; 
			  		contPart+='</script>';         





					contPart+='</div>';
					contParam="";
					contParam+="<div class='textoCuadro1 headGrid'>Especificaciones de la Planta</div>";
					contParam+='<div class="colorRecuadro card-reveal center"><div class="row">';

					contParam+='<div class="col s12 m6 l4 center-align"><div class="collection">';
    					contParam+='<a href="#!" class="collection-item">Serie: Selector'; 
    					contParam+='</a></div></div>';

    				contParam+='<div class="col s12 m6 l4 center-align"><div class="collection">';
    					contParam+='<a href="#!" class="collection-item">Gasto: 1.25'; 
    					contParam+='</a></div></div>';

    				contParam+='<div class="col s12 m6 l4 center-align"><div class="collection">';
    					contParam+='<a href="#!" class="collection-item">HPS Instalados: 4'; 
    					contParam+='</a></div></div>';

    				contParam+='<div class="col s12 m6 l4 center-align"><div class="collection">';
    					contParam+='<a href="#!" class="collection-item">HPS Utilizados: 3'; 
    					contParam+='</a></div></div>';

    				contParam+='<div class="col s12 m6 l4 center-align"><div class="collection">';
    					contParam+='<a href="#!" class="collection-item">Diametro: 3'; 
    					contParam+='</a></div></div>';


					contParam+='<div class="col s12 m6 l4 center-align"><div class="collection">';
    					contParam+='<a href="#!" class="collection-item">Alto planta: 3'; 
    					contParam+='</a></div></div>';

    					contParam+='<div class="col s12 m6 l4 center-align"><div class="collection">';
    					contParam+='<a href="#!" class="collection-item">Largo planta: 3'; 
    					contParam+='</a></div></div>';

    					contParam+='<div class="col s12 m6 l4 center-align"><div class="collection">';
    					contParam+='<a href="#!" class="collection-item">Produndidad pretrat.: 3'; 
    					contParam+='</a></div></div>';
						
						contParam+='<div class="col s12 m6 l4 center-align"><div class="collection">';
    					contParam+='<a href="#!" class="collection-item">Area carcamo: 3'; 
    					contParam+='</a></div></div>';

    					contParam+='<div class="col s12 m6 l4 center-align"><div class="collection">';
    					contParam+='<a href="#!" class="collection-item">Total area: 3'; 
    					contParam+='</a></div></div>';

    					contParam+='<div class="col s12 m6 l4 center-align"><div class="collection">';
    					contParam+='<a href="#!" class="collection-item">Lodos producidos al mes: 3';
    					contParam+='</a></div></div>';

 						$(document).ready(function(){
    						$('.modal-trigger').leanModal();

    					});     



						contParam+=divend+divend;
				}
				




				$('#divPartidasPTAR').html(contPart+contParam);
				contS="";
				cont="";
			}
			$('#divSeleccionadoPTAR').html(contS);		
			$('#divSelPTAR').html(cont);					
	});

}
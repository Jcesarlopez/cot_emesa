<?php
session_start()	;
if($_SESSION['Sesion']!=='Activo')
{
	header('Location: index.php');		
}
else
{
	// Volvemos a cargar la configuracion
	require "Controlador/config.php";	
}

require "Controlador/Controlador.php";	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	  <title>Desarrollo de sistemas - Sia Web - Cotizaciones 3.0</title>
	  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
      <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">	  
	  <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />	  	
	  <script type="text/javascript" src="js/clientes.js"></script>
	  <script type="text/javascript" src="js/vendedores.js"></script>
	  <script type="text/javascript" src="js/utilidad.js"></script>
	  <script type="text/javascript" src="js/grafica.js"></script>
	  <script type="text/javascript" src="js/incluNoincluEntrega.js"></script>	  
	  <script type="text/javascript" src="js/scripts.js"></script>
	  <script type="text/javascript" src="js/opc_menu_nuevo.js"></script>
	  <script type="text/javascript" src="js/opc_menu_abrir.js"></script>
	  <script type="text/javascript" src="js/opc_menu_guardar.js"></script>
	  <script type="text/javascript" src="js/opc_menu_cerrar.js"></script>
	  <script type="text/javascript" src="js/opc_menu_word.js"></script>

</head>
<script>
function loadPage()
{
	cotizacionesDefecto();
	MostrarClientes("");

	<?php echo "mostrarVendedores(".$_SESSION['IdUser'].")"; ?>	
}
</script>
<link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
<body onload="loadPage();">
	  <header>	  	
	  	<div id="DivmenuSup" class="row blue darken-2 white-text center-align">

	  		<div id="divMenuBtn" class="col s2 m2 l1 left-align">
	  			<a href="#" data-activates="slide-out" class=" button-collapse btn-floating btn-large waves-effect waves-light blue darken-4"><i class="material-icons">menu</i></a>
	  		</div>

	  		<div id="divUsuario" class="col s4 m4 l4 left-align"><br>
	  			<?php 
	  			$nom = iconv("UTF-8", "ISO-8859-1", $_SESSION['NomUser']);
	  			$app = iconv("UTF-8", "ISO-8859-1", $_SESSION['ApPatUser']);
	  			$apm = iconv("UTF-8", "ISO-8859-1", $_SESSION['ApMatUser']);	  			
	  			echo $nom.' '.$app.' '.$apm;
	  			echo "<br>".$_SESSION['MailUser'];
	  			?>
	  		</div>

	  		<div id="divStatusCot" class="col s6 m6 l7 left-align"><br>
	  			Cotizaciones - Plantas de Tratamiento
	  		</div>


	  	</div>
	  	
	  	
	  </header>
	  <style>

	  		.menos2emmargen{transform: translateY(-1.5em);}	  		
	  		.toast{background-color: #ef6c00;}
	  		#divFondo img{width: 100%;position: absolute;z-index: 50;margin-top: -1.2rem};
	  		#referencia{border: 1px solid white!important};

	  		#basicos{visibility: hidden;}
			#DivPlanta{visibility: hidden;}
			#divGraficaPTARIncluNoIncluEntrega{visibility: hidden;}
	  	</style>
	  <div id="divFondo" >
	  		<img src="imagenes/fondo.jpg">
	  </div>
	<div id="basicos" class="row">	 	
	 	<div class="col s12 m6 l4">	 		
	          <div class="card blue darken-2 white-text">
	            <div class="card-content CardsSup">
	              <div class="titleCard">
	              	<a href="#modalCliente" class="modal-trigger"><span class="textNormalBlanco"><i class="fa fa-user-o" aria-hidden="true"></i>&nbsp;Seleccionar cliente</span></a>
	              </div>
	              <style>
	              	#iconsCliente{position: relative;left: 85%;top: -30px;}
	              	.imgIconsCliente{width: 7%};

	              </style>
	              <div id="iconsCliente">
	              		<input id="statusFormCliente" type="hidden" value="Nuevo"> 
	              		<a href="#modalEditCliente" class="modal-trigger white-text" title="Capturar nuevo cliente" onclick="nuevoClienteForm()"><img class="imgIconsCliente" src="imagenes/icons/new_user.png"></a>
						&nbsp;<a href="#modalBuscaClienteWeb" class="modal-trigger white-text" title="Importar cliente registrado p&aacute;gina Web" onclick="ListaClientesWeb()"><img class="imgIconsCliente" src="imagenes/icons/user_web.png"></a>
	              </div>

	              
	              <p class="center-align menos2emmargen">		              	
	              	<span id="spanNomEmpresacliente">
	              		&nbsp;
	              	</span><br>
	              	<span id="spanNomContactocliente">
	              		&nbsp;
	              	</span>
	              </p>
	            </div>	            
	          </div>
	 	</div> 		
		<div  class="col s12 m6 l2">	 		
			 <div class="card blue darken-2 white-text">
		            <div class="card-content CardsSup">
		              <div class="titleCard">
		              	<span class="textNormalBlanco"><i class="fa fa-calendar-o" aria-hidden="true"></i>&nbsp;Fecha</span>
		              </div>
		              <p >		              	
						  
				          <input id="birthdate" type="text" onclick="$('#dp').datepicker();$('#dp').datepicker('show');" class="colorBordeInput datepicker picker__input picker__input--active center-align" readonly="" tabindex="-1" aria-haspopup="true" aria-expanded="true" aria-readonly="false" aria-owns="birthdate_root">

		              </p>
		            </div>	            
		          </div>

		</div> 		
		<div class="col s12 m6 l3">	 		
			<div class="card blue darken-2 white-text">
		            <div class="card-content CardsSup">
		              <div class="titleCard">
		              	<i class="fa fa-map-signs" aria-hidden="true"></i>&nbsp;Referencia</span>
		              </div>
		              <p>
		              	<input value="" id="referencia" type="text" onblur="statusCambios(1,true)" class="validate">		              	
		              </p>
		            </div>	            
		          </div>
		</div> 		
		<div class="col s12 m6 l3">	 		
			 <div class="card blue darken-2 white-text">
	            <div class="card-content CardsSup">
	              <div class="titleCard">
	              	<i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;Vendedor</span></a>
	              </div>
	              <p id="pselVendedor" class="textSelect">
	                 <select id="selVenderor" class="bordeSelect">
				    	<?php  //MostrarVendedores::mostrar($_SESSION['IdUser']);?>
				    </select>			              	
	              </p>
	            </div>	            
	          </div>

		</div> 
</div>
<div class="row" id="DivPlanta">
	<div class="col s12 m12 l12 ">
		 <div class="card blue darken-2 white-text">
	        <div class="card-content CardsPTAR valign-wrapper">
	          <div class="titleCard">
	         	 <a href="#modalPTAR"  onclick="selPTAR(1,0,0,0)" class="modal-trigger waves-effect waves-light btn red">Planta de Tratamientos</a>   	
	          </div>	         
	        </div>	            
	      </div>
	</div> 
</div>			 
<div id="divGraficaPTARIncluNoIncluEntrega">
	<div class="row">
    	<div class="col m12 l8" id="divGraficaPTAR">&nbsp;</div>
    	<div class="col m12 l4" id="divIncluNoincluEntregaPTAR">&nbsp;</div>
    </div>
</div>


				    
</div>



 <!-- Modal Editar Partida-->
 <div id="modalEditPartida" class="modal">	
 	<form id="formPartidasPTAR">
	 	<h5 id="h5EditPartida" class="center-align">Modificar partida</h5>
		 <div class="row">
		 	<div class="col s12 m9 l9">
		 		<label for="tareaDescrip">Descripci&oacute;n</label>	 	
		 		<textarea id="tareaDescrip" class="browser-default"></textarea>
		 		
		 	</div>
		 	<div class="col s6 m1 l1">
		 		<label for="inputCant" class="browser-default">Cantidad</label>
		 		<input id="inputCant" type="text" class="browser-default">
	          	
		 	</div>
		 	<div class="col s6 m2 l2">
		 		<label for="inputCosto" class="browser-default">Costo</label>
		 		<input id="inputCosto" type="text" class="browser-default">
	          	
		 	</div>
		 </div>
		 <div class="row">
		 	<div class="col s112 m12 l12">
			 	<label for="tareaInfoAdicional" class="browser-default">Adicional</label>	 	
			 	<textarea id="tareaInfoAdicional" class="browser-default"></textarea>
			 </div>	 	
		 </div>
		 <input type="hidden" id="hiPartida" name="opcion" value="0">
	</form>
	 <div class="modal-footer">
      	<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" onclick="AddCambiarPartida(tareaDescrip.value,inputCant.value,inputCosto.value,tareaInfoAdicional.value,hiPartida.value
      	)">Aceptar</a>
      	<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
    </div>
 </div>

  <!-- Modal Planta de tratamiento-->
 <div id="modalPTAR" class="modal">	
	  <div id="divBandaCerrarModal" class="grey darken-3 right-align">
	  		<span class="white-text point" onclick="cerrarModal('modalPTAR');">X&nbsp;</span>
	  </div>
	    <div class="modal-content">	     
	      <h5 class="center-align">Elegir planta de Tratamiento</h5>
	      <div id="divSeleccionadoPTAR" class="center-align">&nbsp;</div>
	      <div id="divSelPTAR" class="row">&nbsp;</div>

		  <div id="divConceptosPTAR" class="row">&nbsp;</div>
	    </div>	    
 </div>


 	<!-- Modal abrir cot-->
 	<style>#modalAbrirCot{width: 99%;}</style>
	  <div id="modalAbrirCot" class="modal">
	    <div class="modal-content">			
			<div class="row">
			    <div class="input-field col s12 m12 l12">
			      <input value="" id="first_name2" onkeyup="buscarCots(this.value);" type="text" class="validate">
			      <label class="active" for="first_name2">Escriba parte del nombre de la empresa o cont&aacute;cto</label>
			    </div>
			</div>
	  	<div class="row">
		  	<div id="lista_cotizaciones" class="collection">			    
		  		
			</div>
	  	</div>
	    </div>
	    <div class="modal-footer">	      	      
	      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
	    </div>
	  </div>

 	 <!-- Modal Cliente-->
	  <div id="modalCliente" class="modal">
	    <div class="modal-content">
			<!--<h5>Elegir cliente para la cotizaci&oacute;n</h5>!-->	      	      	
			<div class="row">
			    <div class="input-field col s12 m12 l12">
			      <i class="material-icons prefix">search</i>
			      <input value="" id="first_name2" type="text" class="validate" onkeyup="MostrarClientes(this.value)">
			      <label class="active" for="first_name2">Escriba parte den nombre de empresa o cont&aacute;cto</label>
			    </div>			    
			    <div class="input-field col s12 m2 l6">
			    <!--Agregar cliente Cliente registrado!-->			    						
				</div>
			</div>			
				
			
	  	<div class="row">
		  	<div id="lista_clientes" >			    
		  		<?php //MostrarCleintes::mostrar(); ?>			
			</div>
	  	</div>
	    </div>
	    <div class="modal-footer">	      	      
	      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
	    </div>
	  </div>

	  <!-- Modal Dato-->
	  <div id="modalDato" class="modal">
	    <div id="divh5ModalDato" class="modal-content">
			<h5>%Dato%</h5>	      	      			
	    </div>
	    <div class="row divTextModalDato">	    	
	    	<div class="col s16 m14 l2">	    			    		
				<input id="textModalDato" type="text" class="browser-default right-align" >
	    	</div>		  	
	    	<div id="divPostModalDato" class="col s16 m14 l2">%</div>
	  	</div>
	  	<div id="divExtraModalDato" class="row divTextModalDato">
	  		
	  	</div>
	    <div id="divFooterModalDato" class="modal-footer">	      	      
	      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
	      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
	      
	    </div>
	  </div>

	  <!-- Modal DatoPlanta-->
	  <style>#modalPropPlanta{width: 400px;height: 300px}</style>
	  <div id="modalPropPlanta" class="modal modal-fixed-footer">
	    <div class="modal-content">
			 <div class="row divTextModalDato">	  
		     	<div class="col s12 m12 l12" id="divh5ModalPropPlanta" >
					<h5>%Dato%</h5>	      	      			
		     	</div>
		    	 <div class="col s112 m10 l8">
		    		<input id="hiModalDatoPropPlanta" type="hidden" value="">
					<input id="textModalDatoPlanta" type="text" class="browser-default right-align" value="">
		    	 </div>		  		    	
	  		 </div>	    
	    </div>
	   	
	  	<div id="divExtraModalDato" class="row divTextModalDato">
	  		
	  	</div>
	    <div id="divFooterModalDato" class="modal-footer">	      	      
	      <a href="#!" onclick="aceptarDatoPropPlanta(hiModalDatoPropPlanta.value,textModalDatoPlanta.value)" class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
	      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
	      
	    </div>
	  </div>
	    <!-- Modal Dato-->
	  <div id="modalCpncepGrafica" class="modal">
	    <div id="divh5ModalDato" class="modal-content">
			<h5 id="h5TitleModalGraf">Editar concepto grafica</h5>	      	      			
	    </div>
	    <div class="row divTextModalDato">	    		    	
	    	<div class="col s12 m8 l6">	    			    		
				<label for="txtConcepGraf" class="browser-default">Concepto</label>
				<input id="txtConcepGraf" type="text" class="browser-default" value="">	
	    	</div>		  	
	    	<div class="col s6 m4 l3">	    			    		
				<label for="txtInicioGraf" class="browser-default">Inicio</label>
				<input id="txtInicioGraf" type="text" class="browser-default" value="">	
	    	</div>		  	
	    	<div class="col s6 m4 l3">	    			    		
				<label for="txtDuracionGraf" class="browser-default">Duracion</label>
				<input id="txtDuracionGraf" type="text" class="browser-default" value="">
	    	</div>
	    	<input type="hidden" name="hidOrdenGraf" id="hidOrdenGraf" value="">		  		
	  	</div>
	  	<div id="divExtraModalDato" class="row divTextModalDato">
	  		
	  	</div>
	    <div id="divFooterModalDato" class="modal-footer">	      	      
	      <a href="#!" onclick="cambiarConcepGraf(txtConcepGraf.value,txtInicioGraf.value,txtDuracionGraf.value,hidOrdenGraf.value)" class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</a>
	      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
	      
	    </div>
	  </div>
	   <!-- Modal Editar Partida-->
	  
	 <div id="modalEditCliente" class="modal">
	 	<form id="formPartidasPTAR">
		 	<h5 id="h5EditCliente" class="center-align">Registrar cliente</h5><br>
			 <form id="formPartidasPTAR">			 	
				 <div class="row">
				 	<div class="col s12 m12 l7">
				 		
					 		<label for="ClNombre" class="browser-default">* Nombre (Empresa, Dependencia)</label>
					 	<div id="divInputClNombre"><!-- Este div lo uso para desabilitar este campo!-->
					 		<input id="ClNombre" type="text">
				 		</div>
				 		
				 	</div>
				 	<div class="col s12 m12 l5">
				 		<label for="ClContacto" class="browser-default">* Contacto</label>
				 		<input id="ClContacto" type="text" class="browser-default">
			          	
				 	</div>
				 	<div class="col s12 m6 l3">
				 		<label for="ClTel1" class="browser-default">* Tel&eacute;fono 1</label>
				 		<input id="ClTel1" type="text" class="browser-default">
			          	
				 	</div>
				 	<div class="col s12 m6 l3">
				 		<label for="ClTel2" class="browser-default">Tel&eacute;fono 2</label>
				 		<input id="ClTel2" type="text" class="browser-default">	          	
				 	</div>				 	
				 	<div class="col s12 m6 l2">
				 		<label for="ClPais" class="browser-default">* Pa&iacute;s</label>
				 		<input id="ClPais" type="text" class="browser-default" value="M&eacute;xico">	          	
				 	</div>
				 	<div class="col s12 m6 l2">
				 		<label for="ClEstado" class="browser-default">* Estado</label>
				 		<input id="ClEstado" type="text" class="browser-default">	          	
				 	</div>
				 	<div class="col s12 m6 l2">
				 		<label for="ClCiudad" class="browser-default">* Ciudad</label>
				 		<input id="ClCiudad" type="text" class="browser-default">	          	
				 	</div>
				 	<div class="col s12 m6 l4">
				 		<label for="ClDireccion" class="browser-default">* Direcci&oacute;n</label>
				 		<input id="ClDireccion" type="text" class="browser-default">	          	
				 	</div>
				 	<div class="col s12 m6 l3">
				 		<label for="ClRFC" class="browser-default">RFC</label>
				 		<input id="ClRFC" type="text" class="browser-default">	          	
				 	</div>
				 	<div class="col s12 m6 l3">
				 		<label for="ClCorreo" class="browser-default">* Correo</label>
				 		<input id="ClCorreo" type="text" class="browser-default">	          	
				 	</div>
				 	<div class="col s12 m6 l2">
				 		<label for="ClCP" class="browser-default">C.P.</label>
				 		<input id="ClCP" type="text" class="browser-default">	          	
				 	</div>
				 	
				 </div>
		 <input type="hidden" id="ihClienteCambios" name="opcion" value="0">
			</form>			 
		</form>
		 <div class="modal-footer">
		 <a href="#!" class="modal-action waves-effect waves-green btn-flat " onclick="enviarDatosCl(ClNombre.value,ClContacto.value,ClTel1.value,ClTel2.value,ClPais.value,ClEstado.value,ClCiudad.value,ClDireccion.value,ClRFC.value,ClCorreo.value,ClCP.value,0
	      	)">Solo guardar</a>
	      	<a href="#!" class="modal-action waves-effect waves-green btn-flat " onclick="enviarDatosCl(ClNombre.value,ClContacto.value,ClTel1.value,ClTel2.value,ClPais.value,ClEstado.value,ClCiudad.value,ClDireccion.value,ClRFC.value,ClCorreo.value,ClCP.value,1
	      	)">Guardar y seleccionar</a>
	      	<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
	    </div>
	 </div>


  <div id="modalCambios" class="modal">
	    <div class="modal-content">
	      <!--<h5>Modal Header</h4>!-->
	      <p><strong>Antes de continuar...</strong><br><br><div id="divMsgAntesAccion">&#191;Desea guardar los cambios de la cotizaci&oacute;n&#63;</div></p>
	    </div>
	    <div class="modal-footer">
	      <div id="divaGuardarAntesAccion"></div>

	      <div id="divaCotinuarAntesAccion"></div>
	      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
	    </div>
  </div>
	 	   <!-- Modal Editar Partida-->
	  
	 <div id="modalBuscaClienteWeb" class="modal">
	 	<form id="formPartidasPTAR">
		 	<h5 id="h5EditCliente" class="center-align">Clientes registrados pagina Web</h5><br>
			 <form id="formPartidasPTAR">			 	
				 <div class="row">
				 	<div class="col s12 m12 l12">
				 			<i class="material-icons prefix">search</i>				 		
					 		<label for="ClNombreWeb" class="browser-default">* Nombre (Empresa, Dependencia)</label>
						 	<div id="divInputClNombre"><!-- Este div lo uso para desabilitar este campo!-->
						 		<input id="ClNombreWeb" type="text" onkeyup="filtarClweb(this.value)">
					 		</div>					 		
				 	</div>				 	
				 </div>
				 <div class="row" id="ListaClientesWeb">				
				 	<div class="col s12 m12 l12">				 			

				 	</div>			 		
				 </div>		 		 
			 </form>			     
		</form>
		 <div class="modal-footer">		 
	      	<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
	    </div>
	 </div>

	   <ul id="slide-out" class="side-nav">
	    <li><div class="userView">
	      <div class="background">
	        <img src="imagenes/logo.jpg">
	      </div>	      
	    </div></li>	    
    	
    	<li><div class="divider"></div></li>
    	
    	<li><a class="waves-effect" href="#!" onclick="nuevaCot();"><i class="fa fa-file-text" aria-hidden="true"></i> Nueva cotizaci&oacute;n</a></li>
    	<li><div class="divider"></div></li>
    	<li><a class="waves-effect" href="#!" onclick="abrirCotizaciones();"> <i class="fa fa-folder-open" aria-hidden="true"></i> Abrir</a></li>

    	<li><div class="divider"></div></li>
    	<li><a class="waves-effect" onclick="guardar('Menu')" href="#!"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</a></li>
    	<li><div class="divider"></div></li>


    	<li><a class="waves-effect" href="#!" onclick="cerrar();"><i class="fa fa-window-close-o" aria-hidden="true"></i> Cerrar</a></li>
    	<li><div class="divider"></div></li>


    	<li><a class="waves-effect" onclick="word()" href="#!"><i class="fa fa-file-word-o" aria-hidden="true"></i> Descargar</a></li>
    	<li><div class="divider"></div></li>
    	<li><a class="waves-effect" href="index.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Salir</a></li>
    	<li><div class="divider"></div></li>
	  </ul>

 	<!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>

 	<script>




 		$(".button-collapse").sideNav();

 		 $(document).ready(function(){
   		 // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
   	 	$('.modal-trigger').leanModal();
   	 	$('.tooltipped').tooltip({delay: 50});
   	 	

  		});          

 		 $('.datepicker').pickadate({
 		 	monthsFull: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
			monthsShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
			weekdaysFull: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
			weekdaysShort: ['Dom','Lun','Mart','Mier','Juev','Vie','sab'],
			weekdaysLetter: [ 'D', 'L', 'M', 'M', 'J', 'V', 'S' ],
			month_prev: '&#9664;',
			month_next: '&#9654;',
			today: 'Hoy',
  			clear: 'Limpiar',
  			close: 'Cerrar',
  			closeOnSelect: true,
		    selectMonths: true, // Creates a dropdown to control month
		    selectYears: 10 // Creates a dropdown of 15 years to control year
		  });

 		  $(document).ready(function() {
    		$('select').material_select();
  		});

 		  function cerrar_modal(id_modal)
 		  {
 		  	  $('#modalCliente').closeModal();
 		  } 	

 		  // Ponemos la fecha de hoy por defaultg
 		  var $input = $('#birthdate').pickadate();
		  // Use the picker object directly.
		  var picker = $input.pickadate('picker');
		  picker.set('select', new Date());	
		  

		  $('#birthdate').change(function(){		  	
     			statusCambios(1,false);
			});

 	</script>



 	
</body>
</html>
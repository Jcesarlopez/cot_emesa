<!DOCTYPE html>
<html lang="es">
<head>
	<link href="https://fonts.googleapis.com/css?family=Dosis|Roboto:300,400" rel="stylesheet">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<meta charset="UTF-8">
	<!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
	  
	<style>
		* { padding: 0; margin: 0; }
		html, body, #fondo {width: 100%;min-height: 100% !important;height: 100%;font-family: 'Roboto', sans-serif;}
		#fondo {background: #0277bd;}
		#divBienvenido{width: 100%;background-color: red;}
		
		#divCentro{width: 425px;height: 450px;background-color:white;margin:auto;top:20%;position: relative;}
		#divCentro{box-shadow: 2px 2px 10px #333;}
		.fila{width: 80%;margin: auto;text-align: center;height: 50px;padding-top: 30px;}
		.sinTop{padding-top:0;}

		.inputText{text-decoration: none;width: 97%;height: 45px;padding-left: 3%;font-size: 1em;color: #555}
		.inputText{border: 0;background-color:#b3e5fc}
		#divAceptar{width: 70%;background-color: #0277bd;cursor: pointer;margin:auto;height: 43px;color: white;padding-top: .29em;font-size: 1.5em;}
		#divAceptar{font-family: 'Dosis', sans-serif;letter-spacing: .01em;}
		#divAceptar:hover{background-color:#039be5}

		#spanTitulo{font-size: 2em;color: #555;}
		#divFoot{color: #555;font-size: .7em;width: 90%;margin: auto;}
		#divMensajes{font-size: .9em;color: #e65100;width: 90%;margin: auto;text-align: center;margin-bottom: 1em;}

	</style>

	<script>
		function perderFoco(obj)
		{
			if (obj.value=='')
			{
				if(obj.id=='textUsuario')
				{
					obj.value="Usuario";
				}
				if(obj.id=='textPass')
				{
					obj.value="Contraseña";
				}				
			}			
		}
		function login(user,pass)
		{		
			$.ajax({
				url:'Controlador/Controlador.php',
				type:'POST',
				data:'user='+user+'&pass='+pass	
			}).done(function(resp){
				$('#divMensajes').html(resp);
			});
		}

	</script>
</head>
<body>
	<div id="fondo" class="valign-wrapper center-align mwhite-text">		
			<div id="divCentro">
				<div class="fila"><span id="spanTitulo">Bienvenido</span></div>
				<div id="divMensajes">Mensaje de error</div>
					<form>
						<div class="fila sinTop">
							<input id="textUsuario" type="text" class="inputText" value="Usuario" onclick="this.value='';" onblur="perderFoco(this)">
						</div>
						<div class="fila">
							<input id="textPass" type="password" class="inputText" value="Contrase&ntilde;a" onclick="this.value='';" onblur="perderFoco(this)">
						</div>
						<div class="fila">
							<div onclick="login(textUsuario.value,textPass.value)" id="divAceptar">
								ACEPTAR
							</div>

						</div>
					</form>
				<div id="divFoot" class="fila">
					Programa de Cotizaciones Ver. 1.0<br>Equipos Mec&aacute;nicos y Electromecanicos S.A. Grupo emesa 
				</div>
			</div> 		
	</div>
</body>
</html>

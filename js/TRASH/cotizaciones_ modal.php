
<?

	
	//Variables de entorno
	$path_imgs="imagenes/";


	//Estilos propios css
	$cssSelf='
	<style>
		.Logo{width:170px;margin-left:1em;margin-top:.1em}
		
		.collection a i{
			-ms-transform: translate(1px,5px); /* IE 9 */
		   	-webkit-transform: translate(1px,5px); /* Safari */
		    transform: translate(1px,5px);
		  }
	     #divContenedor{float:left;margin-top:5em;}





	     #menuLateral{width:18%;float:left;margin-top:-5px;height:100%;}
	     #menuLateral collection{height:100%}


		 @media (max-width: 992px)
		 {
			#menuLateral{width:15%;}
		 }
		 @media (max-width: 600px)
		 {
			#menuLateral{width:12%;}		
		 }	
	</style>';



	$headMaterealize='
	  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>';

    $jsMaterealize='
	  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    ';


	$menuSup='
	<!-- Dropdown Structure -->
	<ul id="dropdown1" class="dropdown-content blue darken-4">
	  <li><a href="#!">Salir</a></li>
	  
	
	</ul>
	<nav id="navMenusup">
	  <div class="nav-wrapper blue darken-4">
	    <a href="#!" class="brand-logo"><img class="responsive-img Logo" src="'.$path_imgs.'logo-emesa.png"></a>	    
	    <ul class="right hide-on-med-and-down">
	      <li><a class="dropdown-button" href="#!" data-activates="dropdown1">&nbsp;<i class="material-icons right">lock</i></a></li>	    
	    </ul>
	  </div>
	</nav>';

	$menuLateral='
	<div id="menuLateral">
		 <div class="collection">
   			<a href="#!" class="collection-item"><i class="material-icons">description</i> Nuevo</a>
		    <a href="#!" class="collection-item"><i class="material-icons">folder_open</i> Abrir</a>
		    <a href="#!" class="collection-item"><i class="material-icons">cloud</i> Guardar</a>
		    <a href="#!" class="collection-item"><i class="material-icons">mode_edit</i> Modificar</a>
		    <a href="#!" class="collection-item"><i class="material-icons">file_download</i> Descargar Word</a>
		    <a href="#!" class="collection-item"><i class="material-icons">mail</i> Enviar por correo</a>
 		</div>
	</div>';


?>
<!DOCTYPE html>
<html lang="es">
<head>
	  <title>Desarrollo de sistemas - Sia Web - Cotizaciones 3.0</title>
	  <?echo $headMaterealize;?>
	  <? echo $cssSelf;?>
</head>
<body>
	  
	  <?echo $menuSup;?>


	  <?echo $menuLateral;?>
	 <div id="divContenedor" class="container center" >
		 <div class="container">
			 <div class="row">
					 <div class="teal lighten-5 col s12 m6 l6">
					 	<div class="card-reveal">
	                        <span class="card-title grey-text text-darken-4">Cliente <i class="mdi-navigation-close right"></i></span>
	                        <p>
	                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
	                        </p>
                    	</div>
                    </div>
					 <div class="teal lighten-4 col s12 m6 l6">
					 	<div class="card-reveal">
	                        <span class="card-title grey-text text-darken-4">Cliente <i class="mdi-navigation-close right"></i></span>
	                        <p>
	                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
	                        </p>
                    	</div>
					 </div>					 
			 </div>
			 <div class="row">
					 <div class="col s12 m12 l12">
					 		<a href="#modal1" class="waves-effect waves-light btn modal-trigger">Elegir Planta de Tratamiento</a>					 	
							<ul class="collapsible" data-collapsible="accordion">							   
							    <li>
							      <div class="collapsible-header left-align"><i class="material-icons">place</i>Partidas Planta de Tratamiento</div>
							      <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
							    </li>
							    <li>
							      <div class="collapsible-header left-align"><i class="material-icons">whatshot</i>Propiedades de la Planta de Tratamiento</div>
							      <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
							    </li>
							    <li>
							      <div class="collapsible-header left-align"><i class="material-icons">whatshot</i>Incluye / No incluye</div>
							      <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
							    </li>
							    <li>
							      <div class="collapsible-header left-align"><i class="material-icons">whatshot</i>Grafica</div>
							      <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
							    </li>
							    <li>
							      <div class="collapsible-header left-align"><i class="material-icons">whatshot</i>Observaciones</div>
							      <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
							    </li>
							 </ul>                    	
                    </div>
					 			 
			 </div> 

			
          











		</div>
 	</div>


 <!-- Modal Structure -->
	  <div id="modal1" class="modal">
	    <div class="modal-content">
	      <h4>Modal Header</h4>
	      <p>A bunch of text</p>
	    </div>
	    <div class="modal-footer">
	      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
	    </div>
	  </div>

 	<!--Import jQuery before materialize.js-->
    <?echo $jsMaterealize;?>
 	<script>
 		 $(document).ready(function(){
   		 // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
   	 	$('.modal-trigger').leanModal();
  		});          
 	</script>

</body>
</html>
<?
function filtrar_clientes($texto)
{	
	$respuesta = new xajaxResponse();
	$link=CrearConexionDB();
	$querystring='SELECT *  FROM clientes_indice WHERE Nombre like "%'.$texto.'%" ORDER BY Nombre ASC LIMIT 8';
	$query = mysqli_query($link,$querystring);

	
	
	while($av = mysqli_fetch_array($query, MYSQL_BOTH))
	{	

	/*					
    $datos.='<li class="collection-item avatar">
      <i class="material-icons circle red c_pointer modal-close" onclick="xajax_selec_cliente('.$av[IdCliente].')">account_box</i>
      <span class="title"><strong>'.$av[Nombre].'</strong></span>
      <p>'.$av[Contacto].'<br>
         '.$av[Ciudad].', '.$av[Estado].'
      </p>
      <a href="#!" class="secondary-content"><i class="material-icons">mode_edit</i></a>
    </li>'; */

    $datos.='
	        <li class="collection-item dismissable">
	        	<div>'.$av[Nombre].' ('.$av[Contacto].')<a href="#!" class="secondary-content"><i class="material-icons" onclick="xajax_selec_cliente('.$av[IdCliente].')">send</i></a></div>
	        </li>';
	        


    }    
    
    $respuesta->addassign("lista_clientes","innerHTML",utf8_encode($datos));
	return $respuesta;	
}
function selec_cliente($id_cliente)
{

	$respuesta = new xajaxResponse();
	$link=CrearConexionDB();
		

	$querystring='SELECT *  FROM clientes_indice WHERE IdCliente='.$id_cliente.' ORDER BY Nombre ASC LIMIT 5';
	$query = mysqli_query($link,$querystring);
	while($av = mysqli_fetch_array($query, MYSQL_BOTH))
	{
		$nom_cl="<strong>".$av[Nombre]."</strong>";	
		$contac_cl=$av[Contacto];	
	}	
	$respuesta->addassign("p_nom_cliente","innerHTML",utf8_encode($nom_cl));		                   
	$respuesta->addassign("p_contac_cliente","innerHTML",utf8_encode($contac_cl));		                   
    $respuesta->addScript("$('#modal2').closeModal();");
	return $respuesta;	

}
function mostrar_tipo_ptar($valor)
{
	$respuesta = new xajaxResponse();
	$link=CrearConexionDB();
	if ($valor!="0")
	{
		$valor='"'.$valor.'"';
		$datos.='<div class="input-field col s12 m4 l4">
		    		<select id="selec_grupo_ptar" onchange="xajax_mostrar_capacidad_ptar(this.value,selec_tipo_ptar.value);">
		    		<option value="" disabled selected>Serie</option>';
		$querystring='SELECT *  FROM plantas_grupos WHERE IdTipo='.$valor.' ORDER BY Descripcion ASC';
		$query = mysqli_query($link,$querystring);
		while($av = mysqli_fetch_array($query, MYSQL_BOTH))
		{				
			$datos.='<option value="'.$av[IdModelo].'">'.$av[Descripcion].'</option>';												     
		}
		$datos.='</select>	    		
	  			</div>';
	}
	else
	{
			$respuesta->addScript("alert('nada');");			
	}



	$lpsVacio='<div class="input-field col s12 m4 l4">
				    		<select id="selec_lps_ptar">
								<option value="" disabled selected>Capacidad</option>							
				    		</select>	    		
			  	</div>';
	
	$respuesta->addassign("div_lps_ptar","innerHTML",utf8_encode($lpsVacio));


	$respuesta->addassign("divConceptosPTAR","innerHTML",utf8_encode(""));	


	$respuesta->addScript("$('select').material_select('destroy');");


	$respuesta->addassign("div_grupo_ptar","innerHTML",utf8_encode($datos));
	
	$parte1='$(document).ready(function(){$'."('select')";
	$parte2='.material_select();});';
	
	$respuesta->addScript($parte1.$parte2);
	return $respuesta;	
}
function mostrar_capacidad_ptar($modelo,$tipo)
{
	$respuesta = new xajaxResponse();

	$link=CrearConexionDB();	
	/*$modelo='"'.$modelo.'"';*/

	if($tipo=="2")
	{
		$whereTipo=" IdTipo=2 ";	
	}
	else
	{
		$whereTipo=" IdTipo!=2 ";		
	}
	

	$datos.='<div class="input-field col s12 m4 l4">
		    		<select id="selec_capacidad" onchange="xajax_mostrarConceptosPTAR(this.value)">
		    		<option value="" selected>Capacidad</option>';

	/*Tipo 1 y 15 es paquete 2 es Obra civil*/
	$querystring='SELECT *  FROM plantas_indice WHERE IdModelo='.$modelo.' and '.$whereTipo.' ORDER BY Capacidad ASC';
	$query = mysqli_query($link,$querystring);
	while($av = mysqli_fetch_array($query, MYSQL_BOTH))
	{				
		$datos.='<option value="'.$av[IdPlanta].'">'.$av[Capacidad].' L.P.S</option>';		
	}
	$datos.='</select>	    		
	  			</div>';
	$respuesta->addScript("$('select').material_select('destroy');");
	$respuesta->addassign("div_lps_ptar","innerHTML",utf8_encode($datos));
	/*$respuesta->addassign("div_lps_ptar","innerHTML",$querystring);*/
	$parte1='$(document).ready(function(){$'."('select')";
	$parte2='.material_select();});';
	$respuesta->addScript($parte1.$parte2);


	return $respuesta;
}
function mostrarConceptosPTAR($idPlanta)
{
	
	$respuesta = new xajaxResponse();
	$link=CrearConexionDB();
	$querystring='SELECT *  FROM plantas_indice WHERE IdPlanta='.$idPlanta;
	$query = mysqli_query($link,$querystring);
	while($av = mysqli_fetch_array($query, MYSQL_BOTH))
	{				

			$conceptos='
			<div class="input-field col s12 m12 l6">
		  			<p>
				      <input type="checkbox" class="filled-in" id="filled-in-box1" checked="checked" />
				      <label for="filled-in-box1">Equipamiento planta de tratamiento</label>
				    </p>
				</div>
				<div class="input-field col s12 m12 l6">
				    <p>
				      <input type="checkbox" class="filled-in" id="filled-in-box2" checked="checked" />
				      <label for="filled-in-box2">Equipamiento pretratamiento</label>
				    </p>
				</div>';
				if($av['IdTipo']==2)				
				{
					$conceptos.='
					<div class="input-field col s12 m12 l6">
					    <p>
					      <input type="checkbox" class="filled-in" id="filled-in-box3" checked="checked" />
					      <label for="filled-in-box3">Obra planta de tratamiento</label>
					    </p>
					</div>
					<div class="input-field col s12 m12 l6">
					    <p>
					      <input type="checkbox" class="filled-in" id="filled-in-box4" checked="checked" />
					      <label for="filled-in-box4">Obra civil pretratamiento</label>
					    </p>
					</div>';				
					
				}
				
				$conceptos.='<div class="input-field col s12 m12 l6">
				    <p>
				      <input type="checkbox" class="filled-in" id="filled-in-box5" checked="checked" />
				      <label for="filled-in-box5">Filtro prensa</label>
				    </p>
				</div>
				<div class="input-field col s12 m12 l6">
				    <p>
				      <input type="checkbox" class="filled-in" id="filled-in-box6" checked="checked" />
				      <label for="filled-in-box6">Lecho de secados de lodos</label>
				    </p>
		  		</div>';

	}



	$respuesta->addassign("divConceptosPTAR","innerHTML",utf8_encode($conceptos));		                   
	return $respuesta;
}
function aceptarPTAR($idPlanta)
{
	$respuesta = new xajaxResponse();	
	
	$divDescPTAR='<div class="col s7 m7 l8 center-align teal lighten-2">';
	$divCantPTAR='<div class="col s1 m1 l1 center-align pink accent-2">';
	$divPrecPTAR='<div class="col s2 m2 l2 center-align lime darken-3">';

	/*ENCABEZADOS*/
	$datos='<div class="row">
		      	 <div class="col s1 m1 l1 center-align light-blue accent-4">
		      	 	<!--<i class="material-icons circle">delete</i><i class="material-icons circle">mode_edit</i>!-->
		      	 	&nbsp;
		      	 </div>';
		  $datos.=$divDescPTAR."DESCRIPCION"."</div>";
		  $datos.=$divCantPTAR."CANTIDAD"."</div>";
		  $datos.=$divPrecPTAR."PRECIO"."</div>";	      	 
	$datos.='</div>';
    /*EQUIPAMIENTO PLANTA*/
	$datos.='<div class="row">
	      	 <div class="col s1 m1 l1 center-align light-blue accent-4">
	      	 	<!--<i class="material-icons circle">delete</i><i class="material-icons circle">mode_edit</i>!-->
	      	 	&nbsp;
	      	 </div>';
	      $datos.=$divDescPTAR."PLANTA EMESA"."</div>";
		  $datos.=$divCantPTAR."1"."</div>";
	      $datos.=$divPrecPTAR."PRECIO"."</div>";	      	 
	$datos.='</div>';
	/*EQUIPAMIENTO CARCAMO*/
	$datos.='<div class="row">
	      	 <div class="col s1 m1 l1 center-align light-blue accent-4">
	      	 	<!--<i class="material-icons circle">delete</i><i class="material-icons circle">mode_edit</i>!-->
	      	 	&nbsp;
	      	 </div>
	      	 <div class="col s7 m7 l8 center-align teal lighten-2">
	      	 	EQUIPO PARA EL PRETRATAMIENTO DE LA PLANTA
	      	 </div>
	      	 <div class="col s1 m1 l1 center-align pink accent-2">
	      	 	1
	      	 </div>
	      	 <div class="col s2 m2 l2 center-align lime darken-3">
	      	 	Precio
	      	 </div>
	    </div>';
	/*OBRA CIVIL PLANTA*/
	$datos.='<div class="row">
	      	 <div class="col s1 m1 l1 center-align light-blue accent-4">
	      	 	<!--<i class="material-icons circle">delete</i><i class="material-icons circle">mode_edit</i>!-->
	      	 	&nbsp;
	      	 </div>
	      	 <div class="col s7 m7 l8 center-align teal lighten-2">
	      	 	OBRA CIVIL PLANTA EMESA
	      	 </div>
	      	 <div class="col s1 m1 l1 center-align pink accent-2">
	      	 	1
	      	 </div>
	      	 <div class="col s2 m2 l2 center-align lime darken-3">
	      	 	Precio
	      	 </div>
	    </div>';
	/*OBRA CIVIL CARCAMO*/
	$datos.='<div class="row">
	      	 <div class="col s1 m1 l1 center-align light-blue accent-4">
	      	 	<!--<i class="material-icons circle">delete</i><i class="material-icons circle">mode_edit</i>!-->
	      	 	&nbsp;
	      	 </div>
	      	 <div class="col s7 m7 l8 center-align teal lighten-2">
	      	 	OBRA CIVIL CARCAMO CON PRETRATAMIENTO
	      	 </div>
	      	 <div class="col s1 m1 l1 center-align pink accent-2">
	      	 	1
	      	 </div>
	      	 <div class="col s2 m2 l2 center-align lime darken-3">
	      	 	Precio
	      	 </div>
	    </div>';
	/*FILTRO PRENSA*/
	$datos.='<div class="row">
	      	 <div class="col s1 m1 l1 center-align light-blue accent-4">
	      	 	<!--<i class="material-icons circle">delete</i><i class="material-icons circle">mode_edit</i>!-->
	      	 	&nbsp;
	      	 </div>
	      	 <div class="col s7 m7 l8 center-align teal lighten-2">
	      	 	FILTRO PRENSA
	      	 </div>
	      	 <div class="col s1 m1 l1 center-align pink accent-2">
	      	 	1
	      	 </div>
	      	 <div class="col s2 m2 l2 center-align lime darken-3">
	      	 	Precio
	      	 </div>
	    </div>';
	/*LECHO DE SECADOS*/
	$datos.='<div class="row">
	      	 <div class="col s1 m1 l1 center-align light-blue accent-4">
	      	 	<!--<i class="material-icons circle">delete</i><i class="material-icons circle">mode_edit</i>!-->
	      	 	&nbsp;
	      	 </div>
	      	 <div class="col s7 m7 l8 center-align teal lighten-2">
	      	 	LECHO DE SECADOS DE LODOS
	      	 </div>
	      	 <div class="col s1 m1 l1 center-align pink accent-2">
	      	 	1
	      	 </div>
	      	 <div class="col s2 m2 l2 center-align lime darken-3">
	      	 	Precio
	      	 </div>
	    </div>';
	$respuesta->addassign("divPartidasPTAR","innerHTML",utf8_encode($datos));		 
	return $respuesta;
}	
?>
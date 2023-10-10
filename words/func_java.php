<? 
function CrearConexionDB()
	{

		mysql_connect("localhost","emesa_cesar","smartkey");


		$MySQLServidor="localhost";
		$MySQLUser="emesa_cesarnew";
		$MySQLPass="Equipos123#";
		$MySQLDB="emesa_sap";
		

		$link = mysqli_connect($MySQLServidor,$MySQLUser,$MySQLPass,$MySQLDB);
		if (mysqli_connect_errno()) 
		{
		    printf("Conexión fallida: %s\n", mysqli_connect_error());
		    exit();
		}
		return($link);

	}
	function init_clientes()
	{
			$link=CrearConexionDB();
			$querystring='SELECT *  FROM clientes_indice WHERE Nombre != "." ORDER BY Nombre ASC LIMIT 8';
			$query = mysqli_query($link,$querystring);


 echo '
 <div class="input-field col s12 m12 l12">
		<ul id="lista_clientes" class="collection">';
			while($av = mysqli_fetch_array($query, MYSQL_BOTH))
			{						
		   echo '
	        <li class="collection-item dismissable">
	        	<div>'.$av[Nombre].' ('.$av[Contacto].')<a href="#!" class="secondary-content"><i class="material-icons">send</i></a></div>
	        </li>';
		    }		   		
echo '</ul></div>';
}
?>